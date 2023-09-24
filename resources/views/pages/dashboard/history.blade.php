@section('title')
    السجلات
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <h2 class="title-table">السجلات</h2>
        <form action="{{ route('post.dashboard.history') }}" method="POST"
            class="flex flex-col my-4 justify-center items-center">
            @csrf
            <h3 class="text-center text-xl mb-2 font-bold">بحث</h3>
            <input type="search" name="q" id="q"
                class="w-[80%] border outline-none bg-slate-100 py-1 px-2 rounded-md">
            <button type="submit" class="button-blue mt-4">
                بحث <i class="fa-solid fa-search"></i>
            </button>
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.history', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>المستخدم</th>
                        <th>الإيميل</th>
                        <th>الامر</th>
                        <th>الايبي</th>
                        <th>البلد</th>
                        <th>المسار</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                    </tr>
                </thead>
                @php
                    $i = ($records->currentPage() - 1) * $records->perPage();
                @endphp
                <tbody class="hisroty">
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $record->name ? $record->name : 'visit' }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->op }}</td>
                            <td>{{ $record->ip }}</td>
                            <td>{{ $record->country }}</td>
                            <td>{{ $record->slug }}</td>
                            <td>{{ date('Y-m-d', strtotime($record->created_at)) }}</td>
                            <td>{{ date('H:i:s', strtotime($record->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="flex justify-center">
            @if ($records->previousPageUrl())
                <a href="{{ $records->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i
                        class="fa-solid fa-angle-right"></i> السابق</a>
            @endif

            @if ($records->nextPageUrl())
                <a href="{{ $records->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                        class="fa-solid fa-angle-right rotate-180"></i></a>
            @endif
        </div>
    </div>
@endsection
@include('pages.home')
