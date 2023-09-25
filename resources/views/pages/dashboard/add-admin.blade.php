@section('title')
إضافة أدمن
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <h2 class="title-table">المشرفين</h2>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <table class="overflow-auto min-w-[600px]">
                <thead>
                    <tr>
                        <th class="link"><a href="{{ route('dashboard.add-admin',['order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">#</a></th>
                        <th>المستخدم</th>
                        <th>تاريخ التسجل</th>
                        <th>صلاحية</th>
                        <th>عدد المنتجات</th>
                        <th>عدد المبيعات</th>
                    </tr>
                </thead>
                <tbody class="hisroty">
                    @php
                        $i=0
                    @endphp

                    @foreach ($admins as $d )

                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $d->u_name }}</td>
                        <td>{{ $d->updated_at }}</td>
                        <td>{{ $d->r_name }}</td>
                        <td>{{ $d->product_count }}</td>
                        <td>{{ $d->sold_count }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>2</td>
                        <td>User</td>
                        <td>2022/5/1</td>
                        <td>2023/8/28</td>
                        <td>10</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <h2 class="title-table mt-8">إضافة مشرف</h2>
        <form action="{{ route('post.dashboard.add-admin') }}" method="POST" class="auth min-h-fit forgot">
            @csrf
            <label for="email">البريد الإلكتروني:</label>
            <input type="text" name="email" id="email">
            <select name="rule" id="rule" required>
                    <option value="admin">admin</option>
                    <option value="saller">saller</option>
                {{-- <option value="2">view</option> --}}
            </select>
            <input type="submit" value="إضافة" id="buttonAuth" disabled>
        </form>
    </div>
@endsection
@include('pages.home')
