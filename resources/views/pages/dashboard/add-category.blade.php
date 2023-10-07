@section('title')
    إضافة قسم
@endsection
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
        <form action="{{ route('dashboard.add-category') }}" method="POST" class="sitting">
            @csrf
            <h2 class="title-table">إضافة قسم</h2>
            <label for="title">اسم القسم:</label>
            <input type="text" name="title" id="title" placeholder="اسم المنتيج">
            <label for="slug">الرابط:</label>
            <input type="text" name="slug" id="slug" placeholder="phons" dir="ltr">
            <label for="desc">الوصف:</label>
            <input type="text" name="desc" id="desc" placeholder="الوصف">
            <label for="tags">العلامات الوصفية:</label>
            <input type="text" name="tags" id="tags" placeholder="هاتف ابل، هاتف ايفون">
            <input type="hidden" name="id" value="" id="id">
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-auto container mx-auto">
            <h2 class="title-table">الأقسام</h2>
            <table class="overflow-auto list mb-8" data-url-remove="{{ route('removeSec') }}">
                <thead>
                    <tr>
                        <th class="link"><a
                                href="{{ route('dashboard.add-category', ['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a>
                        </th>
                        <th>الاسم</th>
                        <th>المسار</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!is_string($sections))
                        @foreach ($sections as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->url }}</td>
                                <td>
                                    <span class="edit" data-id="{{ $s->id }}">تعديل</span>
                                </td>
                                <td>
                                    <button class="button-red remove-admin" data-delete="{{ $s->id }}">حذف</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @php
                            print_r([$sections]);
                        @endphp
                    @endif
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('pages.home')
