<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Edit_productController extends Controller
{
    public static function date()
    {

        // dd(request()->all());
        // dd(old('dev'));

        if (count(request()->all()) != 0) {
            self::edit();
        }
        $p = DB::table('products', 'p')->where('p.id', request('idProduct'))
            ->join('sections as s', 'p.section_id', '=', 's.id')
            ->select('s.name as s_name', 'p.*')
            ->first('*');
        if ($p) {

            $dev = DB::table('product_devs')->where('product_id', $p->id)->select('id', 'name', 'price')
                ->get()->map(function ($item) {
                    return (object) [
                        'id'     => $item->id,
                        'name'   => $item->name,
                        'price'  => $item->price,
                    ];
                });
            $res = [
                'product' => $p,
                'dev' => $dev
            ];
            session()->flashInput($res);
        }
    }

    public static function edit()
    {
        // dd(old('dev')->{'name#' . $i});
        // dd(old('dev')[0]->id);
        // dd(request()->all());
        debug(request()->all());
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'slug' => 'required|regex:/^\S+$/|unique:sections,url',
            'price' => 'required',
            'desc' => 'required',
            'paymetner' => 'required',
            'tags' => 'required',
            'category' => 'required',
            'quantity' => 'required|min:1',
            'percent'=>'required|regex:/^[0-9]+$/',
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
        ]);
        // dd($validator);
        if ($validator->fails()) {
            $error = $validator->errors();
            session()->put('error', $error);
            return back();
        }
        else{
            DB::table('products')->where('id', request('idProduct'))->when(request('title') != old('product')->name, function ($u) {
                $u->update([
                    'name' => request('title')
                ]);
            })->when(request('slug') != old('product')->cool_name, function ($u) {
                $u->update([
                    'cool_name' => request('slug')
                ]);
            })->when(request('price') != old('product')->price, function ($u) {
                $u->update([
                    'price' => request('price')
                ]);
            })->when(request('quantity') != old('product')->quantity, function ($u) {
                $u->update([
                    'quantity' => request('quantity')
                ]);
            })->when(request('desc') != old('product')->description, function ($u) {
                $u->update([
                    'description' => request('desc')
                ]);
            })->when(request('paymetner') != old('product')->information, function ($u) {
                $u->update([
                    'information' => request('paymetner')
                ]);
            })
            ->when(request('tags') != old('product')->tags, function ($u) {
                $u->update([
                    'tags' => request('tags')
                    ]);
                })->when(request('percent') != old('product')->percent, function ($u) {
                    $u->update([
                        'percent' => request('percent')
                        ]);
                    })->when(request('category') != old('product')->section_id, function ($u) {
                    $u->update([
                        'section_id' => request('category')
                    ]);
                });

                if (count(request()->all()) > 11) {
                    $requestData = request()->all();
                    $slicedData = array_slice($requestData, 11);
                    $filteredData = array_filter($slicedData, function ($value, $key) {
                        return !is_a($value, 'Illuminate\Http\UploadedFile');
                    }, ARRAY_FILTER_USE_BOTH);
                    // dd(count($filteredData)/3);

                    for ($i = 0; $i < round(count($filteredData) / 3); $i++) {
                        // dd(old('dev')[$i]->name);
                        // dd(request('name#'.$i)!=old('dev')[$i]->name and request('id#'.$i)==old('dev')[$i]->id);
                        if (request('name#' . $i) and request('price#' . $i)) {
                            if ($i < count(old('dev'))) {
                                DB::table('product_devs')
                                    ->where('product_id', request('idProduct'))
                                    ->where('id', request('id#' . $i))
                                    ->update([
                                        'name' => request('name#' . $i),
                                        'price' => request('price#' . $i),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);
                            } else {
                                DB::table('product_devs')->insert([
                                    'product_id' => request('idProduct'),
                                    'name' => request('name#' . $i),
                                    'price' => request('price#' . $i),
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            }
                        }
                        else{
                            session()->put('error', 'الرجاء ملىء معلومات التطوير بشكل صحيح');

                        }
                    }
                }

            if (is_a(request('file'), 'Illuminate\Http\UploadedFile')) {
                $path = pathinfo(old('product')->url_image)['dirname'];
                $filename = pathinfo(old('product')->url_image)['basename'];
                $fullPath = $path . '/' . $filename;
                $fullPath = public_path() . $fullPath;
                debug($fullPath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                $validatorFile = Validator::make(request('file'), [
                    'file' => 'required|mimetypes:image/png,image/jpeg',
                ], [
                    'file.required' => 'يرجى تحميل صورة',
                    'file.mimetypes' => 'صيغة الصورة غير مدعومة، يرجى اختيار صيغة png أو jpeg',
                ]);
                // dd($validator);
                if ($validatorFile->fails()) {
                    $errorf = $validatorFile->errors();
                    session()->put('error', $errorf);
                    return back();
                }
                else{
                    $image = request()->file('file');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $imagePath = '/image_product/' . $imageName;
                    $image->move(public_path('image_product'), $imageName);
                    DB::table('products')->where('id', request('idProduct'))->update([
                        'url_image' => $imagePath
                    ]);

                }

            }
            return back();
        }
        }



        public function delete(Request $r)
    {
        $s = DB::table('product_devs')->delete($r->id);
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
