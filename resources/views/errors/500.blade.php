@section('title')
خطء 500
@endsection
@section('description')
خطء 500.آسف, الخدمة غير متوفرة.الخدمة غير متوفرة الآن، قد تعود للعمل قريبا أم لا!
@endsection
@section('author')
GitHub
@endsection
@section('app')
<main class="flex justify-center items-center min-h-screen container flex-col md:flex-row m-auto text-center max-w-[1200px] px-2">
    <div class="w-[75%] md:w-1/2">
        <img src="{{ asset('') }}errors/image/500.svg" alt="خطء 500" class="w-full">
    </div>
    <div class="w-full md:w-1/2 mt-4 md:mt-0">
        <h2 class="text-yallow font-bold text-6xl">خطء 500</h2>
        <h5 class="text-light text-3xl mt-1">آسف, الخدمة غير متوفرة.</h5>
        <p class="text-white text-2xl mt-2">الخدمة غير متوفرة الآن، قد تعود للعمل قريبا أم لا!</p>
    </div>
</main>
@endsection
@include('errors.home')