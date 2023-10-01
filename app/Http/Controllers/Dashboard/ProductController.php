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

        if (request()->isMethod('POST')) {
            $this->store_product();
        }

        $p = DB::table('products')->select('id', 'name', 'cool_name', 'price', 'quantity')->get();
        return $p;
    }



    public function store_product()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'paymetner' => 'required',
            'tags' => 'required',
            'category' => 'required',
            'quantity' => 'required|min:1',
            'file' => 'required|mimetypes:image/png,image/jpeg',
        ], [
            'title.required' => 'حقل العنوان مطلوب',
            'slug.required' => 'حقل الرابط المختصر مطلوب',
            'desc.required' => 'حقل الوصف مطلوب',
            'tags.required' => 'حقل العلامات مطلوب',
            'price.required' => 'حقل السعر مطلوب',
            'paymetner.required' => 'حقل الشرح مطلوب',
            'category.required' => 'حقل القسم مطلوب',
            'quantity.required' => 'حقل الكمية مطلوب',
            'quantity.min' => 'اقل كمية ممكنة هي منتج واحد',
            'file.required' => 'يرجى تحميل صورة',
            'file.mimetypes' => 'صيغة الصورة غير مدعومة، يرجى اختيار صيغة png أو jpeg',
        ]);
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
                'percent' => 0,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];

            if (request('id')) {
                DB::table('products')->where('id', request('id'))->update($data);
            } else {
                DB::table('products')->insert($data);
                $p = DB::table('products')->select('id')->latest()->first();
                DB::table('product_users')->insert([
                    'product_id' => $p->id,
                    'user_id' => auth()->user()->id,
                    'is_sell' => 0,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
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
        $f=DB::table('product_users')->where('product_id',$r->id)->delete();
        $s = DB::table('products')->delete($r->id);
        if ($f and $s) {
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
