@section('title')
السجلات
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <h2 class="title-table">السجلات</h2>
        <form action="{{ route('dashboard.history') }}" method="POST" class="flex flex-col my-4 justify-center items-center">
            @csrf
            <h3 class="text-center text-xl mb-2 font-bold">بحث</h3>
            <input type="search" name="q" id="q" class="w-[80%] border outline-none bg-slate-100 py-1 px-2 rounded-md">
            <button type="submit" class="button-blue mt-4">
                بحث <i class="fa-solid fa-search"></i>
            </button>
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>المستخدم</th>
                        <th>الامر</th>
                        <th>الايبي</th>
                        <th>البلد</th>
                        <th>المسار</th>
                    </tr>
                </thead>
                <tbody class="hisroty">
                    <tr>
                        <td>1</td>
                        <td>Admin</td>
                        <td>إضافة منتج</td>
                        <td>127.0.0.1</td>
                        <td>سوريا</td>
                        <td>/admin/</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Yhya</td>
                        <td>تسجيل دخول</td>
                        <td>127.0.0.1</td>
                        <td>مصر</td>
                        <td>/auth/login/</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <div class="flex justify-center">
            <a href="#" class="button-blue mx-2 mt-4"><i class="fa-solid fa-angle-right"></i> السابق</a>
            <a href="#" class="button-blue mx-2 mt-4 px-5">التالي <i class="fa-solid fa-angle-right rotate-180"></i></a>
        </div>
    </div>
@endsection
@include('pages.home')
