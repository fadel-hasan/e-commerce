@section('title','الصفحة الرئيسية')
@section('app')
    {{-- Produtc --}}
    <section id="produtc-page">
        <div class="img">
            <img src="https://placehold.co/800@2x.png" alt="{{ $name }}">
        </div>
        <div class="content">
            <h1>{{ $name }}</h1>
            <p>{{ $desProduct }}</p>
            <span class="price">{{ $price }}$</span>
            <h2>التطويرات</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="{{ $id }}">
                @if (isset($more) and is_array($more))
                    @foreach ($more as $moreProduct)
                        <x-checkbox
                            title="{{ $moreProduct['name'] }} بمبلغ: <span class='font-bold'>{{ $moreProduct['price'] }}$</span>"
                            name="more#{{ $moreProduct['id'] }}" />
                    @endforeach
                @endif
                <input type="submit" value="شراء" class="button-blue">
            </form>
        </div>
    </section>
@endsection
@include('pages.home')
