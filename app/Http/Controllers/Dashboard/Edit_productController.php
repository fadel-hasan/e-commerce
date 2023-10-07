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
            'percent' => 'required|regex:/^[0-9]+$/',
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
            'percent.required' => 'نسبة الربح مطلوبة رجاءا',
            'percent.regex' => 'الرجاء ادخال ارقام فقط',
            'percent.min' => 'اقل نسبة ممكنة هي 10',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            $error = $validator->errors();
            session()->put('error', $error);
            return back();
        } else {
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
                    } else {
                        $image = request()->file('file');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $imagePath = '/image_product/' . $imageName;
                        $image->move(public_path('image_product'), $imageName);
                        DB::table('products')->where('id', request('idProduct'))->update([
                            'url_image' => $imagePath
                        ]);
                    }
                }


            $value = request()->except(['title', 'slug', 'desc', 'tags', 'price', 'paymetner', 'category', 'quantity', 'file', '_token', 'percent','idProdcvt']);
            // dd($value);
            if (count($value) > 0)
            {
                //get key array
                $keys = array_keys($value);

                //filter name and price without id
                $nameAndPriceKeys = array_filter($keys, function ($key) {
                    return strpos($key, 'name') !== false || strpos($key, 'price') !== false;
                });

                //make rule for every name or price
                $rules = array_reduce($nameAndPriceKeys, function ($rules, $key) {
                    $rules[$key] = 'required';
                    return $rules;
                }, []);

                //make messages for every name or price
                $messages = array_reduce($nameAndPriceKeys, function ($messages, $key) {
                    $messages[$key.'.required'] = 'عليك تعبئة حقل التطوير لا تتركه فارغا';
                    return $messages;
                }, []);

                $devValidator = Validator::make($value, $rules, $messages);

                if ($devValidator->fails())
                {
                    $error = $devValidator->errors();
                    session()->put('error', $error);
                    return back();
                }
                 else
                 {
                    $data = [];
                    $counter = 0;
                    $i = 0;
                    $ok=true;

                foreach ($value as $key => $val)
                {
                        $parts = explode('#', $key);
                        if ($parts[0] === 'name' || $parts[0] === 'price' || $parts[0]=='id') {
                            if (!isset($data[$i])) {
                                $data[$i] = [];
                            }
                            $data[$i][$parts[0]] = $val;
                            $counter++;

                            if($parts[0]=='id' )
                            {
                                $ok=true;
                            }
                            if($ok)
                            {
                                    if ($counter === 3)
                                    {
                                        $i++;
                                        $counter = 0;
                                        $ok =false;
                                    }
                            }
                            else
                            {
                                if ($counter === 2) {
                                    $i++;
                                    $counter = 0;
                            }
                        }
                    }
                }
                for ($i = 0; $i < count($data); $i++) {
                        // dd(count($data[$i]));
                        if(count($data[$i])==3)
                        {
                            DB::table('product_devs')
                            ->where('product_id', request('idProduct'))
                            ->where('id', $data[$i]['id'])
                            ->update([
                                'name' => $data[$i]['name'],
                                'price' => $data[$i]['price'],
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                        else
                        {
                            DB::table('product_devs')->insert([
                                'product_id' => request('idProduct'),
                                'name' => $data[$i]['name'],
                                'price' => $data[$i]['price'],
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
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
