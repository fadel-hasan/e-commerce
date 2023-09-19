@section('title')
خطء 400
@endsection
@section('description')
خطء 400.عذرا، حدث فشل في الاتصال.لا يمكن الاتصال بالخدمة المطلوبة من الخادم!
@endsection
@section('author')
GitHub
@endsection
@section('app')
<main class="flex justify-center items-center min-h-screen container flex-col md:flex-row m-auto text-center max-w-[1200px] px-2">
    <div class="w-[75%] md:w-1/2">
        <img src="{{ asset('') }}errors/image/400.svg" alt="خطء 400" class="w-full">
    </div>
    <div class="w-full md:w-1/2 mt-4 md:mt-0">
        <h2 class="text-yallow font-bold text-6xl">خطء 400</h2>
        <h5 class="text-light text-3xl mt-1">عذرا، حدث فشل في الاتصال.</h5>
        <p class="text-white text-2xl mt-2">لا يمكن الاتصال بالخدمة المطلوبة من الخادم!</p>
    </div>
</main>
@endsection
@include('errors.home')