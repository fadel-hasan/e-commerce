@section('title')
    لوحة التحكم
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    {{--     4 Box for information data
    last users
    last product
    last order --}}
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <section class="boxs relative">
            @foreach ($boxs as $box)
                <div class="box">
                    <span class="icon">
                        <i class="{{ $box['icon'] }}"></i>
                    </span>
                    <div>
                        <h3>{{ $box['title'] }}</h3>
                        <p>{{ $box['number'] }}</p>
                    </div>
                </div>
            @endforeach
        </section>
        <section class="boxs lg:grid-cols-2 xl:grid-cols-2 mt-8">
            <div>
                <h3 class="title-table">أخر الأعضاء</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>اسمي</td>
                            <td>email@gmail.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>اسمي</td>
                            <td>email@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h3 class="title-table">أخر الطلبات</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>منتج</td>
                            <td>20$</td>
                            <td><x-status-text /></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>منتج</td>
                            <td>20$</td>
                            <td><x-status-text type="pending" message="جاري" /></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>منتج</td>
                            <td>20$</td>
                            <td><x-status-text type="fail" message="ملغي" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
