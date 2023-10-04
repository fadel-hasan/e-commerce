<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function get_product()
    {
        $order = request('order', 'desc');
        if (request()->isMethod('POST')) {
            $this->store_product();
        }
        if(auth()->user()->role_id == 3)
        {
            $p = DB::table('products')
                ->select('id', 'name', 'cool_name', 'price', 'quantity')
                ->where('role_id',auth()->user()->role_id)
                ->orderBy('id', $order)
                ->get();
        }
        else{
            $p = DB::table('products')
                ->select('id', 'name', 'cool_name', 'price', 'quantity')
                ->orderBy('id', $order)
                ->get();
        }
        return $p;
    }



    public function store_product()
    {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'slug' => 'required|regex:/^[a-zA-Z\s]+$/|unique:sections,url',
            'price' => 'required',
            'desc' => 'required',
            'paymetner' => 'required',
            'tags' => 'required',
            'category' => 'required',
            'quantity' => 'required|min:1',
            'percent'=>'required|regex:/^[0-9]+$/',
            'file' => 'required|mimetypes:image/png,image/jpeg',
        ], [
            'title.required' => 'حقل العنوان مطلوب',
            'slug.required' => 'حقل الرابط المختصر مطلوب',
            'slug.unique' => 'حقل الرابط المختصر مستخدم',
            'slug.regex' => 'حقل الرابط المختصر يجب أن يحتوي على أحرف فقط باللغة الإنجليزية',
            'desc.required' => 'حقل الوصف مطلوب',
            'tags.required' => 'حقل العلامات مطلوب',
            'price.required' => 'حقل السعر مطلوب',
            'paymetner.required' => 'حقل الشرح مطلوب',
            'category.required' => 'حقل القسم مطلوب',
            'quantity.required' => 'حقل الكمية مطلوب',
            'quantity.min' => 'اقل كمية ممكنة هي منتج واحد',
            'percent.required' => 'حقل نسبة الربح مطلوب',
            'percent.required'=>'نسبة الربح مطلوبة رجاءا',
            'percent.regex'=>'الرجاء ادخال ارقام فقط',
            'percent.min'=>'اقل نسبة ممكنة هي 10',
            'file.required' => 'يرجى تحميل صورة',
            'file.mimetypes' => 'صيغة الصورة غير مدعومة، يرجى اختيار صيغة png أو jpeg',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            $error = $validator->errors();
            session()->put('error', $error);
        } else {


            $image = request()->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = '/image_product/' . $imageName;
            $image->move(public_path('image_product'), $imageName);
            $data = [
                'name' => request('title'),
                'cool_name' => request('slug'),
                'description' => request('desc'),
                'tags' => request('tags'),
                'price' => request('price'),
                'information' => request('paymetner'),
                'section_id' => request('category'),
                'quantity' => request('quantity'),
                'url_image' => $imagePath,
                'user_id'=>auth()->user()->id,
                'percent' => request('percent'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (request('id')) {
                DB::table('products')->where('id', request('id'))->update($data);
            } else {
                DB::table('products')->insert($data);
                $p = DB::table('products')->select('id')->latest()->first();
            }
            if (count(request()->all()) > 11) {
                $requestData = request()->all();
                $slicedData = array_slice($requestData, 10);
                $filteredData = array_filter($slicedData, function ($value, $key) {
                    return !is_a($value, 'Illuminate\Http\UploadedFile');
                }, ARRAY_FILTER_USE_BOTH);
                // dd($filteredData);
                for ($i = 1; $i <= count($filteredData) / 2; $i++) {
                    DB::table('product_devs')->insert([
                        'product_id' => $p->id,
                        'name' => request('name#' . $i),
                        'price' => request('price#' . $i),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                }
            }
        }
        return;
    }

    public function get_section()
    {
        $s = DB::table('sections')->select('id', 'name')->get();
        return $s;
    }


    public function delete(Request $r)
    {

        $f=DB::table('product_devs')->where('product_id',$r->id)->delete();
        $s = DB::table('products')->delete($r->id);
        if ($s) {
            return response()->json(
                ['ok' => true],
                200
            );
        } else {
            return response()->json(
                ['ok' => false],
                422
            );
        }
    }
}
