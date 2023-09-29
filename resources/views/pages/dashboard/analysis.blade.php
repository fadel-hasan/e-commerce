@section('title','الإحصائيات')
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard">
        <script>
            var canvasData = [];
        </script>
        <h2 class="title-table">الإحصائيات</h2>
        {{-- Line Analysis --}}
        @php
            $date = [
                'label' => [],
                'date' => [],
                'label1' => [],
                'date1' => [],
                'label2' => [],
                'date2' => [],
                'label3' => [],
                'date3' => [],
            ];

            foreach ($visits as $visit) {
                $date['label'][] = $visit->day;
                $date['date'][] = $visit->count;
            }

            foreach ($sells as $s) {
                $date['label1'][] = $s->day;
                $date['date1'][] = $s->money;
            }
            foreach ($buys as $b) {
                $date['label2'][] = $b->name;
                $date['date2'][] = $b->count;
            }

            foreach ($countries as $c) {
                $date['label3'][] = $c->country;
                $date['date3'][] = $c->count;
            }
            $string = [
                1 => json_encode($date['date']),
                2 => json_encode($date['label']),
                3 => json_encode($date['date1']),
                4 => json_encode($date['label1']),
                5 => json_encode($date['date2']),
                6 => json_encode($date['label2']),
                7 => json_encode($date['date3']),
                8 => json_encode($date['label3']),
            ];
        @endphp
        <section class="boxs sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-1">
            <div class="max-h-[300px]">
                <h3 class="title-table text-xl">الزيارات الشهرية</h3>
                <x-chart-js datasets='{!! $string[1] !!}' id="monthlyVistors" title="الزيارات"
                    labels='{!! $string[2] !!}' />
            </div>
            <div class="max-h-[300px] mt-12 lg:mt-0">
                <h3 class="title-table text-xl">المدفوعات الشهرية</h3>
                <x-chart-js datasets='{!! $string[3] !!}' id="monthlyPayment" labels='{!! $string[4] !!}'
                    title="المدفوعات" />
            </div>
        </section>
        {{-- more Analysis --}}
        <section class="mt-20 grid-template mb-20">
            <div class="max-h-[300px]">
                <h3 class="title-table text-xl">مكان الزيارات</h3>
                <x-chart-js type="pie" datasets='{!! $string[7] !!}' labels='{!! $string[8] !!}'
                    id="countryVistors" title="الزيارات" />
            </div>
            <div class="max-h-[300px] mt-12 lg:mt-0 ">
                <h3 class="title-table text-xl">المبيعات الشهرية</h3>
                <x-chart-js datasets='{!! $string[5] !!}' labels='{!! $string[6] !!}' id="monthlyProducts"
                    type="bar" title="المبيعة" />
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
