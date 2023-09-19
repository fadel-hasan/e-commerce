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
        {{-- Line Analysis --}}
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
        {{-- more Analysis --}}
        <section class="mt-20 grid-template mb-20">
            <div class="max-h-[300px]">
                <h3 class="title-table text-xl">مكان الزيارات</h3>
                <x-chart-js
                    type="pie"
                    datasets='["1500","1200","600","500"]'
                    labels='["سوريا","العراق","مصر","غير ذلك"]'
                    id="countryVistors"
                    title="الزيارات" />
            </div>
            <div class="max-h-[300px] mt-12 lg:mt-0 md:hover:bg-blue-500">
                <h3 class="title-table text-xl">المبيعات الشهرية</h3>
                <x-chart-js
                    datasets='["100","200","500","800","100","200","500","800"]'
                    labels='["مننتج 1","مننتج 2","مننتج 3","مننتج 4","مننتج 5","مننتج 6","مننتج 7","مننتج 8"]'
                    id="monthlyProducts"
                    type="bar"
                    title="المبيعة" />
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
