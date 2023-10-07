@section('title','الطلبات الناجحة')
@section('app')
    @include('layouts.navbarLeft')
    <div class="dashboard">
        <h2 class="title-table">الطلبات الناجحة</h2>
        <section class="max-w-[90%] overflow-auto container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.orders', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>المستخدم</th>
                        <th>الإيميل</th>
                        <th>المنتج</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                    </tr>
                </thead>
                @php
                    $i = ($orders->currentPage() - 1) * $orders->perPage();
                @endphp
                <tbody class="hisroty">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->u_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->p_name }}</td>
                            @if ($order->status == 0)
                                    <td><x-status-text type="fail" message="ملغي" /></td>
                                @elseif ($order->status == 1)
                                    <td class=" cursor-pointer"><x-status-text /></td>
                                @else
                                    <td><x-status-text type="pending" message="جاري" /></td>
                                @endif
                            <td>{{ $record->ip }}</td>
                            <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                            <td>{{ date('H:i:s', strtotime($order->created_at)) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>1</td>
                        <td>syrians</td>
                        <td>syrians@gov.sy</td>
                        <td>سيرفر 1 رام</td>
                        <td>
                            <x-status-text type="fail" message="ملغي" />
                        </td>
                        <td>2020-5-5</td>
                        <td>20:21:25</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>syrians</td>
                        <td>syrians@gov.sy</td>
                        <td>سيرفر 1 رام</td>
                        <td>
                            <x-status-text type="pending" message="جاري" />
                        </td>
                        <td>2020-5-5</td>
                        <td>20:21:25</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>syrians</td>
                        <td>syrians@gov.sy</td>
                        <td>سيرفر 1 رام</td>
                        <td class=" cursor-pointer">
                            {{-- I can click here for view information --}}
                            <x-status-text />
                        </td>
                        <td>2020-5-5</td>
                        <td>20:21:25</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <div class="flex justify-center">
            @if ($orders->previousPageUrl())
                <a href="{{ $orders->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i
                        class="fa-solid fa-angle-right"></i> السابق</a>
            @endif

            @if ($orders->nextPageUrl())
                <a href="{{ $orders->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                        class="fa-solid fa-angle-right rotate-180"></i></a>
            @endif
        </div>
    </div>
@endsection
@include('pages.home')
