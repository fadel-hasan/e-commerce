@section('title')
إضافة أدمن
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <h2 class="title-table">المشرفين</h2>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>المستخدم</th>
                        <th>تاريخ التسجل</th>
                        <th>اخر ظهور</th>
                        <th>عدد المنتجات</th>
                        <th>عدد المبيعات</th>
                    </tr>
                </thead>
                <tbody class="hisroty">
                    <tr>
                        <td>1</td>
                        <td>Admin</td>
                        <td>2022/1/1</td>
                        <td>2023/8/28</td>
                        <td>50</td>
                        <td>230</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>User</td>
                        <td>2022/5/1</td>
                        <td>2023/8/28</td>
                        <td>10</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <h2 class="title-table mt-8">إضافة مشرف</h2>
        <form action="{{ route('dashboard.add-admin') }}" method="POST" class="auth min-h-fit forgot">
            @csrf
            <label for="email">البريد الإلكتروني:</label>
            <input type="text" name="email" id="email">
            <input type="submit" value="إضافة" id="buttonAuth" disabled>
        </form>
    </div>
@endsection
@include('pages.home')
