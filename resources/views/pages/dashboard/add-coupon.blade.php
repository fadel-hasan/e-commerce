@section('title', 'إضافة قسم')
@section('app')
    @include('layouts.navbarLeft')
    @if (session()->has('error'))
        @if (is_array(session()->get('error')->getMessages()))
            @foreach (session()->get('error')->getMessages() as $error)
                <x-alert message="{{ $error[0] }}" type='fail' title="خطأ" />
            @endforeach
        @else
            <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />

        @endif
        {{ session()->forget('error') }}
    @endif
    <div class="dashboard">
        <form action="{{ route('dashboard.add-coupon') }}" method="POST" class="sitting">
            @csrf
            <h2 class="title-table">إضافة كود خصم:</h2>
            <label for="code">الكود:</label>
            <input type="text" name="code" id="code" placeholder="free2024">
            <label for="discount">النسبة:</label>
            <input type="number" step="0.01" name="discount" id="discount" placeholder="10%" dir="ltr">
            <label for="count">عدد المستفيدين:</label>
            <input type="number" name="count" id="count" placeholder="100">
            <label for="expire_date">تاريخ الإنتهاء:</label>
            <input type="date" name="expire_date" id="expire_date" placeholder="2024/1/1" dir="rtl">
            <input type="hidden" name="id" value="" id="id">
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-auto container mx-auto">
            <h2 class="title-table">الخصومات الحالية:</h2>
            <table class="overflow-auto list mb-8" data-url-remove="{{ route('removeCoupon') }}" {{-- Route Remove Coipon --}}>
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.add-coupon', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>الرمز</th>
                        <th>النسبة</th>
                        <th>عدد المستفيدين</th>
                        <th>تاريخ انتهاء كود الخصم</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($copons as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->code }}</td>
                            <td>{{ $c->discount }}%</td>
                            <td>{{ $c->count }}</td>
                            <td>{{ $c->expire_date }}</td>
                            <td>
                                <button class="button-red remove-admin" data-delete="{{ $c->id }}">حذف</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('pages.home')
