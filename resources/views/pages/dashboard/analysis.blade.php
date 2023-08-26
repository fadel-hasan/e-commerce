@section('title')
الإحصائيات
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <script>
            var canvasData = [];
        </script>
        <h2 class="title-table">الإحصائيات</h2>
        <section class="boxs sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-1">
            <div class="max-h-[300px]">
                <h3 class="title-table text-xl">الزيارات الشهرية</h3>
                <x-chart-js
                    datasets='["1813", "8845", "2241", "390", "5496", "5962", "6164", "8212", "4024", "5842", "6318", "2401", "3581", "7885", "5938", "3170", "465", "7589", "8698", "5490", "9032", "9666", "9453", "151", "3393", "6734", "2433", "9874", "6246", "3267", "9870", "2254"]'
                    id="monthlyVistors"
                    title="الزيارات" />
            </div>
            <div class="max-h-[300px] mt-12 lg:mt-0">
                <h3 class="title-table text-xl">المدفوعات الشهرية</h3>
                <x-chart-js
                    datasets='["1813", "8845", "2241", "390", "5496", "5962", "6164", "8212", "4024", "5842", "6318", "2401", "3581", "7885", "5938", "3170", "465", "7589", "8698", "5490", "9032", "9666", "9453", "151", "3393", "6734", "2433", "9874", "6246", "3267", "9870", "2254"]'
                    id="monthlyPayment"
                    title="المدفوعات" />
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
