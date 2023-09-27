@section('title')
    إضافة قسم
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <form action="" method="POST" class="sitting">
            @csrf
            <h2 class="title-table">إضافة قسم</h2>
            <label for="title">اسم القسم:</label>
            <input type="text" name="title" id="title" placeholder="اسم المنتيج">
            <label for="slug">الرابط:</label>
            <input type="text" name="slug" id="slug" placeholder="phons" dir="ltr">
            <label for="desc">الوصف:</label>
            <input type="text" name="desc" id="desc" placeholder="الوصف">
            <label for="tags">العلامات الوصفية:</label>
            <input type="text" name="tags" id="tags" placeholder="هاتف ابل، هاتف ايفون">
            <input type="hidden" name="id" value="" id="id">
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <h2 class="title-table">الأقسام</h2>
            <table class="overflow-auto list mb-8"
            data-url-remove="{{ route('removeAdmin') }}"
            {{-- Route Remove category --}}
            >
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>الاسم</th>
                        <th>المسار</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ايفون</td>
                        <td>apple</td>
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
