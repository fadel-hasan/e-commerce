@section('title', 'السجلات')
@section('app')
    <h2 class="mt-4 title-table">السجلات</h2>
    <section class="max-w-[90%] overflow-scroll container mx-auto">
        <table class="overflow-auto">
            <thead>
                <tr>
                    <th class="link"><a
                            href="{{ route('user.history', ['sort_by' => 'id', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">#</a>
                    </th>
                    <th>المنتج</th>
                    <th>التاريخ</th>
                    <th class="link"><a
                            href="{{ route('user.history', ['sort_by' => 'money', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">المبلغ</a>
                    </th>
                </tr>
            </thead>
            @php
                // $i = ($members->currentPage() - 1) * $members->perPage();
            @endphp
            <tbody>
                <tr>
                    <td>1</td>
                    <td>سيرفر 2</td>
                    <td>2022/1/1</td>
                    <td>100$</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>سيرفر 3</td>
                    <td>2022/1/1</td>
                    <td>100$</td>
                </tr>
            </tbody>
        </table>
    </section>
    {{-- <div class="flex justify-center">
        @if ($members->previousPageUrl())
            <a href="{{ $members->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i class="fa-solid fa-angle-right"></i>
                السابق</a>
        @endif

        @if ($members->nextPageUrl())
            <a href="{{ $members->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                    class="fa-solid fa-angle-right rotate-180"></i></a>
        @endif
    </div> --}}
@endsection
@include('pages.home')
