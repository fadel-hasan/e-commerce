@section('title','الطلبات الناجحة')
@section('app')
    @include('layouts.navbarLeft')
    <div class="dashboard">
        <h2 class="title-table">الطلبات الناجحة</h2>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.orders', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>المستخدم</th>
                        <th>الإيميل</th>
                        <th>الكمية</th>
                        <th>المنتج</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                    </tr>
                </thead>
                @php
                    // $i = ($records->currentPage() - 1) * $records->perPage();
                @endphp
                <tbody class="hisroty">
                    {{-- @foreach ($records as $record)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $record->name ? $record->name : 'visit' }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->op }}</td>
                            <td>{{ $record->ip }}</td>
                            <td>{{ date('Y-m-d', strtotime($record->created_at)) }}</td>
                            <td>{{ date('H:i:s', strtotime($record->created_at)) }}</td>
                        </tr>
                    @endforeach --}}
                    <tr>
                        <td>1</td>
                        <td>syrians</td>
                        <td>syrians@gov.sy</td>
                        <td>2</td>
                        <td>سيرفر 1 رام</td>
                        <td>2020-5-5</td>
                        <td>20:21:25</td>
                    </tr>
                </tbody>
            </table>
        </section>
        {{-- <div class="flex justify-center">
            @if ($records->previousPageUrl())
                <a href="{{ $records->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i
                        class="fa-solid fa-angle-right"></i> السابق</a>
            @endif

            @if ($records->nextPageUrl())
                <a href="{{ $records->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                        class="fa-solid fa-angle-right rotate-180"></i></a>
            @endif
        </div> --}}
    </div>
@endsection
@include('pages.home')
