@section('title',"قسم: {$res['section']->name}")
@section('app')
    {{-- Search About --}}
    <section class="py-32 lg:container mx-auto">
        <h2 class="text-center text-2xl">قسم: <span class="font-bold text-blue-600">{{ $res['section']->name }}</span></h2>
        <p class="text-center max-w-[1200px] text-gray-900 leading-8 mt-2 font-bold mx-auto">{{ $res['section']->desc }}</p>
    </section>
    {{-- products --}}
    <section id="products" data-url-products="{{ route('productSectionGet',['uri'=>$res['section']->url]) }}">
        <div class="products">
            @foreach ($res['product'] as $p)
            <article>
                <div class="img">
                    <a href="{{ route('user.product',['uri'=>$p->cool_name]) }}">
                        <img src="{{ asset($p->url_image) }}" alt="العنوان" loading="lazy">
                    </a>
                </div>
                <div class="content">
                    <a href="{{ route('user.product',['uri'=>$p->cool_name]) }}"><h3>{{ $p->name }}</h3></a>
                    <p>{{ $p->description }}</p>
                    <a href="{{ route('user.product',['uri'=>$p->cool_name]) }}" class="button-blue">المزيد من المعلومات</a>
                </div>
                <a class="category" href="{{ route('user.category',['uri'=>$res['section']->url]) }}">{{ $res['section']->name }}</a>
            </article>
            @endforeach
        </div>
        <button class="block w-fit mx-auto mt-4 button-blue px-6" id="moreProducts">
            المزيد
            <span class="hidden">
                <i class="fa-solid fa-spinner animate-spin"></i>
            </span>
        </button>
    </section>
@endsection
@include('pages.home')
