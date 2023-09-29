@section('title','إضافة منتج')
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <form action="" method="POST" class="sitting">
            @csrf
            <h2 class="title-table">إضافة منتج</h2>
            <label for="title">اسم المنتج:</label>
            <input type="text" name="title" id="title" placeholder="اسم المنتيج">
            <label for="slug">اسم لطيف:</label>
            <input type="text" name="slug" id="slug" placeholder="phons" dir="ltr">
            <label for="price">السعر:</label>
            <input type="number" name="price" id="price" placeholder="20" dir="ltr" min="0">
            <label for="desc">الوصف:</label>
            <input type="text" name="desc" id="desc" placeholder="الوصف">
            <label for="paymetner">تعليمات المشتري:</label>
            <input type="text" name="paymetner" id="paymetner" placeholder="تعليمات تطلب من المشتري بعد شراء المنتج">
            <label for="tags">العلامات الوصفية:</label>
            <input type="text" name="tags" id="tags" placeholder="هاتف ابل، هاتف ايفون">
            <label for="category">القسم:</label>
            <select name="category" id="category">
                <option value="1">هواتف</option>
                <option value="2">لابتوبات</option>
            </select>
            <input type="hidden" name="id" value="" id="id">
            <div class="flex flex-col my-6">
                <span class="button-blue w-fit self-center text-lg" id="addMore">إضافة تطوية</span>
                <div id="more" class="my-2 flex flex-col"></div>
            </div>
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <h2 class="title-table">المنتجات</h2>
            <table class="overflow-auto list mb-8"
            data-url-remove="{{ route('removeAdmin') }}"
            {{-- Route Remove Product --}}
            >
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>الاسم</th>
                        <th>رابط لطيف</th>
                        <th>السعر</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ايفون</td>
                        <td>apple</td>
                        <td>10$</td>
                        <td>
                            <span class="edit" data-id="1">تعديل</span>
                        </td>
                        <td>
                            <button class="button-red remove-admin" data-delete="hereId">حذف</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>لابتوب</td>
                        <td>laptops</td>
                        <td>200$</td>
                        <td>
                            <span class="edit" data-id="2">تعديل</span>
                        </td>
                        <td>
                            <button class="button-red remove-admin" data-delete="hereId">حذف</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('pages.home')
