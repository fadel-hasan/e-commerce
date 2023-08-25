@section('title')
    الأعضاء
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <h2 class="title-table">الأعضاء</h2>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto">
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>العنوان</th>
                        <th class="link"><a href="#">المدفوعات</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>اسمي</td>
                        <td>email@gmail.com</td>
                        <td>سوريا</td>
                        <td>10$</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>اسمي</td>
                        <td>email@gmail.com</td>
                        <td>سوريا</td>
                        <td>20$</td>
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
