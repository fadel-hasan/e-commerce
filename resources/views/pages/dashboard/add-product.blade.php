@section('title', 'إضافة منتج')
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
        <form action="{{ route('dashboard.add-product') }}" method="POST" class="sitting" enctype="multipart/form-data">
            @csrf
            <h2 class="title-table">إضافة منتج</h2>
            <label for="title">اسم المنتج:</label>
            <input type="text" name="title" id="title" placeholder="اسم المنتيج">
            <label for="slug">اسم لطيف:</label>
            <input type="text" name="slug" id="slug" placeholder="phons" dir="ltr">
            <label for="price">السعر:</label>
            <input type="number" name="price" id="price" placeholder="20" dir="ltr" min="0">
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
            @if (count($sections) == 0)
                <a href="{{ route('dashboard.add-category') }}">قم بإضافة قسم اولا اضغط هنا</a>
            @else
                <select name="category" id="category">
                    @foreach ($sections as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            @endif
            <input type="hidden" name="id" value="" id="id">
            <div class="flex flex-col my-6">
                <span class="button-blue w-fit self-center text-lg" id="addMore">إضافة تطوير</span>
                <div id="more" class="my-2 flex flex-col"></div>
            </div>
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <h2 class="title-table">المنتجات</h2>
            <table class="overflow-auto list mb-8" data-url-remove="{{ route('removeProduct') }}" {{-- Route Remove Product --}}>
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.add-product', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>الاسم</th>
                        <th>رابط لطيف</th>
                        <th>السعر</th>
                        <th>لكمية المتوفر لديك</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->cool_name }}</td>
                            <td>{{ $p->price }}$</td>
                            <td>{{ $p->quantity }}$</td>
                            <td>
                                <span class="edit" data-id="{{ $p->id }}">تعديل</span>
                            </td>
                            <td>
                                <button class="button-red remove-admin" data-delete="{{ $p->id }}">حذف</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('pages.home')
