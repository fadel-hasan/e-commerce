@section('title', 'تعديل منتج')
@section('app')
    @include('layouts.navbarLeft')
    @if (session()->has('error'))
        @if (is_string(session()->get('error')))
            <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />
        @elseif (is_array(session()->get('error')->getMessages()))
            @foreach (session()->get('error')->getMessages() as $error)
                <x-alert message="{{ $error[0] }}" type='fail' title="خطأ" />
            @endforeach
        @else
            <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />

        @endif
        {{ session()->forget('error') }}
    @endif
    <div class="dashboard">
        {{-- @dd(is_emptyold('dev')) --}}
        {{-- @if (count($sections) == 0)
            <x-alert title="خطء" message="قم بإضافة قسم اولا" type="fail" />
        @else --}}
        <form action="{{ route('dashboard.edit-product', ['idProduct' => $idProduct]) }}" method="POST"
            class="sitting edit-product" enctype="multipart/form-data" data-api="{{ route('removeDev') }}">
            @csrf
            <h2 class="title-table">تعديل منتج</h2>
            <input type="hidden" name="idProdcvt" name="idproduct" value="{{ $idProduct }}">
            <label for="title">اسم المنتج:</label>
            <input type="text" name="title" id="title" value="{{ old('product')->name }}"
                placeholder="اسم المنتيج">
            <label for="slug">اسم لطيف:</label>
            <input type="text" name="slug" id="slug" value="{{ old('product')->cool_name }}" placeholder="phons"
                dir="ltr">
            <label for="price">السعر:</label>

            <input type="number" name="price" id="price" step="0.01" value="{{ old('product')->price }}"
                placeholder="20" dir="ltr" min="0">
            <label for="price">الكمية:</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('product')->quantity }}" placeholder="20"
                dir="ltr" min="0">
            <label for="percent">نسبة الربح:</label>
            <input type="number" name="percent" id="percent" placeholder="20" dir="ltr" min="0"
                value="{{ old('product')->percent }}">
            <label for="desc">الوصف:</label>
            <input type="text" name="desc" id="desc" value="{{ old('product')->description }}"
                placeholder="الوصف">
            <label for="paymetner">تعليمات المشتري:</label>
            <input type="text" name="paymetner" id="paymetner" value="{{ old('product')->information }}"
                placeholder="تعليمات تطلب من المشتري بعد شراء المنتج">
            <label for="tags">العلامات الوصفية:</label>
            <input type="text" name="tags" id="tags" value="{{ old('product')->tags }}"
                placeholder="هاتف ابل، هاتف ايفون">
            <div class="image-container relative">
                <label for="file">صورة المنتج</label>
                <div class="max-w-[600px] mx-auto">
                    <img class="cursor-pointer w-full" src="{{ asset(old('product')->url_image) }}" alt="صورة المنتج">
                </div>
                <a class="button-blue mb-4" onclick="document.getElementById('file').click()">تغيير الصورة</a>
                <input type="file" name="file" id="file" style="display:none">
                <input type="text" name="file" id="file" value="{{ old('product')->url_image }}"
                    style="display:none">
            </div>
            <label for="category">القسم:</label>
            <select name="category" id="category">
                {{-- @foreach ($sections as $s)
                        @endforeach --}}
                <option value="{{ old('product')->section_id }}">{{ old('product')->s_name }}</option>
            </select>
            <hr>
            @csrf
            <div class="flex flex-col my-6">
                <h2 class="title-table">التطويرات</h2>
                <span class="button-blue w-fit self-center text-lg" id="addMore">إضافة تطوير</span>
                {{-- عدد التطويرات الموجود --}}
                @if (count(old('dev')) > 0)
                    {{-- @dd(old('dev')[0]) --}}
                    @foreach (old('dev') as $key => $dev)
                        <div class="flex flex-col">

                            <input type="hidden" name="id#{{ $key }}" value="{{ $dev->id }}">
                            <label class="text font-bold cursor-pointer" for="name#{{ $key }}">التطويرة
                                #{{ $key }}:</label>
                            <input type="text" name="name#{{ $key }}" id="name#{{ $key }}"
                                placeholder="التطويرة {{ $key }}" value="{{ $dev->name }}">
                            <label class="text font-bold cursor-pointer" for="price#{{ $key }}">سعرها
                                :</label>
                            <input type="number" name="price#{{ $key }}" id="price#{{ $key }}"
                                placeholder="20$" dir="ltr" value="{{ $dev->price }}" step="0.01">
                            <span class="button-red mb-3" data-id="{{ $dev->id }}">حذف التطويرة</span>
                            <hr>
                        </div>
                    @endforeach
                @endif
                <div id="more" class="my-2" data-count="{{ count(old('dev')) - 1 }}">
                    {{-- تطويرات --}}
                    {{-- @for ($i = 1; $i <= 2; $i++)
                            <div class="flex flex-col">
                                <label class="text font-bold cursor-pointer" for="name#{{ $i }}">التطويرة
                                    #{{ $i }}:</label>
                                    <input type="text" name="name#{{ $i }}" id="name#{{ $i }}"
                                    placeholder="التطويرة {{ $i }}">
                                    <label class="text font-bold cursor-pointer" for="price#{{ $i }}">سعرها
                                        :</label>
                                        <input type="number" name="price#{{ $i }}" id="price#{{ $i }}"
                                        placeholder="20$" dir="ltr">
                                        <span class="button-red mb-3">حذف التطويرة</span>
                                        <hr>
                                    </div>
                                    @endfor --}}
                </div>
                <input type="submit" value="تعديل" class="button-blue w-fit mx-auto px-12 mb-4">
            </div>
        </form>
        {{-- @endif --}}
    </div>
@endsection
@include('pages.home')
