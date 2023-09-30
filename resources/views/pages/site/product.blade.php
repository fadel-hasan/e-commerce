@section('title','الصفحة الرئيسية')
@section('app')
    {{-- Produtc --}}
    <section id="produtc" class="min-h-[calc(100vh-70px)] sm:min-h-[calc(100vh-77px)] flex flex-col gap-y-8 mt-16 md:mt-0 md:flex-row-reverse items-center justify-between sm:container px-4 mx-auto">
        <div class="img w-full md:w-1/2">
            <img src="https://placehold.co/800@2x.png" alt="{{ $name }}" class="rounded-xl object-cover aspect-video w-full">
        </div>
        <div class="content flex flex-col w-full md:w-1/2">
            <h1 class="text-3xl font-bold">{{ $name }}</h1>
            <p class="max-w-[90%] leading-8 my-6 text-gray-900">{{ $desProduct }}</p>
            <span class="text-3xl font-bold text-blue-700 text-center">{{ $price }}$</span>
            <h2 class="text-xl font-bold text-gray-900">التطويرات</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="{{ $id }}">
                @if (isset($more) and is_array($more))
                    @foreach ($more as $moreProduct)
                        <x-checkbox
                            title="{{ $moreProduct['name'] }} بمبلغ: <span class='font-bold'>{{ $moreProduct['price'] }}$</span>"
                            name="more#{{ $moreProduct['id'] }}" />
                    @endforeach
                @endif
                <input type="submit" value="شراء" class="button-green block w-[80%] mx-auto">
            </form>
        </div>
    </section>
@endsection
@include('pages.home')
