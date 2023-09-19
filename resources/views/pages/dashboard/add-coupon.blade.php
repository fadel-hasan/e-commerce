@section('title')
    إضافة قسم
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <form action="" method="POST" class="sitting">
            @csrf
            <h2 class="title-table">إضافة كود خصم:</h2>
            <label for="code">الكود:</label>
            <input type="text" name="code" id="code" placeholder="free2024">
            <label for="discount">النسبة:</label>
            <input type="number" name="discount" id="discount" placeholder="10%" dir="ltr">
            <label for="count">عدد المستفيدين:</label>
            <input type="number" name="count" id="count" placeholder="100">
            <label for="expire_date">تاريخ الإنتهاء:</label>
            <input type="date" name="expire_date" id="expire_date" placeholder="2024/1/1" dir="rtl">
            <input type="hidden" name="id" value="" id="id">
            <input type="submit" value="إضافة" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
        <section class="max-w-[90%] overflow-scroll container mx-auto">
            <h2 class="title-table">الخصومات الحالية:</h2>
            <table class="overflow-auto list mb-8">
                <thead>
                    <tr>
                        <th class="link"><a href="#">#</a></th>
                        <th>الرمز</th>
                        <th>النسبة</th>
                        <th>عدد المستفيدين</th>
                        <th>عدد المستخدمين</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>free2024</td>
                        <td>10%</td>
                        <td>100</td>
                        <td>90</td>
                        <td><a href="#">حذف</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('pages.home')
