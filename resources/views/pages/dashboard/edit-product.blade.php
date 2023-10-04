@section('title', 'تعديل منتج')
@section('app')
    @include('layouts.navbarLeft')
    @if (session()->has('error'))
        @if (is_array(session()->get('error')->getMessages()))
            @foreach (session()->get('error')->getMessages() as $error)
                <x-alert message="{{ $error[0] }}" type='fail' title="خطأ" />
            @endforeach
        @else
            <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />

                @endif
                {{ session()->forget('error') }}
    @endif
    <div class="dashboard">
        @if (count($sections) == 0)
            <x-alert title="خطء" message="قم بإضافة قسم اولا" type="fail" />
        @else
            <form action="{{ route('dashboard.edit-product',['idProduct'=>$idProduct]) }}" method="POST" class="sitting" enctype="multipart/form-data">
                @csrf
                <h2 class="title-table">تعديل منتج</h2>
                <input type="hidden" name="idProdcvt" name="idproduct" value="{{ $idProduct }}">
                <label for="title">اسم المنتج:</label>
                <input type="text" name="title" id="title" placeholder="اسم المنتيج">
                <label for="slug">اسم لطيف:</label>
                <input type="text" name="slug" id="slug" placeholder="phons" dir="ltr">
                <label for="price">السعر:</label>
                <input type="number" step="0.01" name="price" id="price" placeholder="20" dir="ltr" min="0">
                <label for="price">الكمية:</label>
                <input type="number" name="quantity" id="quantity" placeholder="20" dir="ltr" min="0">
                <label for="desc">الوصف:</label>
                <input type="text" name="desc" id="desc" placeholder="الوصف">
                <label for="paymetner">تعليمات المشتري:</label>
                <input type="text" name="paymetner" id="paymetner" placeholder="تعليمات تطلب من المشتري بعد شراء المنتج">
                <label for="tags">العلامات الوصفية:</label>
                <input type="text" name="tags" id="tags" placeholder="هاتف ابل، هاتف ايفون">
                <label for="file">صورة المنتج</label>
                <input type="file" name="file" id="file" placeholder="اي صورة توضيحية">
                <label for="category">القسم:</label>
                <select name="category" id="category">
                    @foreach ($sections as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                <input type="submit" value="تعديل" class="button-blue w-fit mx-auto px-12 mb-4">
            </form>
            <hr>
            <form action="" method="post" class="sitting">
                @csrf
                <div class="flex flex-col my-6">
                    <h2 class="title-table">التطويرات</h2>
                    <span class="button-blue w-fit self-center text-lg" id="addMore">إضافة تطوير</span>
                    {{-- عدد التطويرات الموجود --}}
                    <div id="more" class="my-2" data-count="2">
                        {{-- تطويرات --}}
                        @for ($i=1;$i<=2;$i++)
                            <div class="flex flex-col">
                                <label class="text font-bold cursor-pointer" for="name#{{ $i }}">التطويرة #{{ $i }}:</label>
                                <input type="text" name="name#{{ $i }}" id="name#{{ $i }}" placeholder="التطويرة {{ $i }}">
                                <label class="text font-bold cursor-pointer" for="price#{{ $i }}">سعرها :</label>
                                <input type="number" name="price#{{ $i }}" step="0.01" id="price#{{ $i }}" placeholder="20$" dir="ltr">
                                <span class="button-red mb-3">حذف التطويرة</span>
                                <hr>
                            </div>
                        @endfor
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
@include('pages.home')
