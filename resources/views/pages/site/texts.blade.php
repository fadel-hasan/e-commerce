@section('title', 'الصفحة الرئيسية')
@section('app')
    <div class="pt-12">
        <h2 class="text-4xl text-center">{{ $title }}</h2>
        {{-- texts --}}
        <section class="max-w-[80%] mx-auto md:container markdown">
            {!! $text !!}
        </section>
    </div>
@endsection
@include('pages.home')
