@section('title', 'السجلات')
@section('app')
    <h2 class="mt-4 title-table">السجلات</h2>
    <section class="max-w-[90%] overflow-auto container mx-auto">
        <table class="overflow-auto">
            <thead>
                <tr>
                    <th class="link"><a
                            href="{{ route('user.history', ['sort_by' => 'num', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">#</a>
                    </th>
                    <th>المنتج</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                    <th class="link"><a
                            href="{{ route('user.history', ['sort_by' => 'money', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">المبلغ</a>
                    </th>
                </tr>
            </thead>
            @php
                $i = ($orders->currentPage() - 1) * $orders->perPage();
            @endphp
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $order->p_name }}</td>
                    @if ($order->status == 0)
                            <td><x-status-text type="fail" message="ملغي" /></td>
                        @elseif ($order->status == 1)
                            <td class=" cursor-pointer"><x-status-text /></td>
                        @else
                            <td><x-status-text type="pending" message="جاري" /></td>
                        @endif
                    <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                    <td>{{ $order->totalPrice }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </section>
    <div class="flex justify-center">
        @if ($orders->previousPageUrl())
            <a href="{{ $orders->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i class="fa-solid fa-angle-right"></i>
                السابق</a>
        @endif

        @if ($orders->nextPageUrl())
            <a href="{{ $orders->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                    class="fa-solid fa-angle-right rotate-180"></i></a>
        @endif
    </div>
@endsection
@include('pages.home')
