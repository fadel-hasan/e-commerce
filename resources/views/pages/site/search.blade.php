@section('title', "نتائج البحث عن: {$searchOut}")
@section('app')
    {{-- Search About --}}
    <section class="py-32">
        <h2 class="text-center text-2xl">نتائج البحث عن: <span class="font-bold">{{ $searchOut }}</span></h2>
    </section>
    {{-- Error --}}
    @isset($products)
        <x-alert type="fail" title="بحث خاطء" message="عذراً المنتج الذي تريده غير متوفر على هذا المتجر" />
        <meta http-equiv="refresh" content="5; url={{ url()->previous() }}">
    @endisset
    {{-- products --}}
    <section id="products">
        <div class="products">
            @foreach ($products as $p)
                <article>
                    <div class="img">
                        <a href="{{ route('user.product', ['uri' => $p->cool_name]) }}">
                            <img src="{{ asset($p->url_image) }}" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{ route('user.product', ['uri' => $p->cool_name]) }}">
                            <h3>{{ $p->name }}</h3>
                        </a>
                        <p>{{ $p->description }}</p>
                        <a href="{{ route('user.product', ['uri' => $p->cool_name]) }}" class="button-blue">المزيد من
                            المعلومات</a>
                    </div>
                    <a class="category" href="{{ route('user.category', ['uri' => $p->url]) }}">{{ $p->s_name }}</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
@include('pages.home')
