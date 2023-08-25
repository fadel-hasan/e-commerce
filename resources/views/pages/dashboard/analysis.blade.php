@section('title')
    لوحة التحكم
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <h2 class="title-table">الإحصائيات</h2>
        <section class="boxs sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-2">
            <div class="max-h-[40vh]">
                <h3 class="title-table text-xl">الزيارات الشهرية</h3>
                <canvas id="monthlyVistors" class=""></canvas>
            </div>
            <div class="max-h-[40vh]">
                <h3 class="title-table text-xl">الزيارات الشهرية</h3>
                <canvas id="monthlyVistors" class=""></canvas>
            </div>
        </section>
    </div>
@endsection
@include('pages.home')
