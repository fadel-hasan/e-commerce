@section('title','الأعضاء')
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <h2 class="title-table">الأعضاء</h2>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto">
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.member', ['sort_by' => 'num', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">#</a>
                        </th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>العنوان</th>
                        <th class="link"><a
                                href="{{ route('dashboard.member', ['sort_by' => 'money', 'sort_order' => $sort_order == 'desc' ? 'asc' : 'desc']) }}">المدفوعات</a>
                        </th>
                    </tr>
                </thead>
                {{-- @dd($members) --}}
                @php
                    $i = ($members->currentPage() - 1) * $members->perPage();
                @endphp
                <tbody>
                    @foreach ($members as $m)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->email }}</td>
                            <td>{{ $m->country }}</td>
                            <td>{{ $m->money }}$</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="flex justify-center">
            @if ($members->previousPageUrl())
                <a href="{{ $members->previousPageUrl() }}" class="button-blue mx-2 mt-4"><i
                        class="fa-solid fa-angle-right"></i> السابق</a>
            @endif

            @if ($members->nextPageUrl())
                <a href="{{ $members->nextPageUrl() }}" class="button-blue mx-2 mt-4">التالي <i
                        class="fa-solid fa-angle-right rotate-180"></i></a>
            @endif
        </div>
    </div>
@endsection
@include('pages.home')
