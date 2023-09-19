@section('title')
    خطء 404
@endsection
@section('description')
    خطء 404.عذرا، الصفحة غير موجودة.تعذر العثور على الخدمة المطلوب على هذا الخادم!
@endsection
@section('author')
    GitHub
@endsection
@section('app')
    <main
        class="flex justify-center items-center min-h-screen container flex-col md:flex-row m-auto text-center max-w-[1200px] px-2">
        <div class="w-[75%] md:w-1/2">
            <img src="{{ asset('') }}errors/image/404.svg" alt="خطء 404" class="w-full">
        </div>
        <div class="w-full md:w-1/2 mt-4 md:mt-0">
            <h2 class="text-yallow font-bold text-6xl">خطء 404</h2>
            <h5 class="text-light text-3xl mt-1">عذرا، الصفحة غير موجودة.</h5>
            <p class="text-white text-2xl mt-2">تعذر العثور على الخدمة المطلوب على هذا الخادم!</p>
        </div>
    </main>
@endsection
@include('errors.home')
