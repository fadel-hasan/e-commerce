@section('title','لوحة التحكم')
@section('app')
    @include('layouts.navbarLeft')
    {{--     4 Box for information data
    last users
    last product
    last order --}}
    <div class="dashboard">
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
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h3 class="title-table">أخر الطلبات</h3>
                <table>
                    <thead>
                        @php
                            $i = 0;
                        @endphp
                        <tr>
                            <th>#</th>
                            <th>اسم المستخدم</th>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->u_name }}</td>
                                <td>{{ $order->p_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}$</td>
                                @if ($order->status == 0)
                                    <td><x-status-text type="fail" message="ملغي" /></td>
                                @elseif ($order->status == 1)
                                    <td><x-status-text /></td>
                                @else
                                    <td><x-status-text type="pending" message="جاري" /></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
