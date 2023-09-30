@section('title','الصفحة الرئيسية')
@section('app')
    {{-- Hero --}}
    <section id="hero" class="flex-page">
        <div class="content">
            <h1>العنوان</h1>
            <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. معجم شامل يحوي على معاني الكلمات العربية ومعاني الجمل ...</p>
        </div>
        <div class="image">
            <img src="{{ asset('images/undraw_stripe_payments_re_chlm.svg') }}" alt="العنوان">
        </div>
    </section>
    {{-- products --}}
    <section id="products" data-url-products="{{ route('productesGet') }}"
    {{-- set route api for get products and limte in all pages 10 example: domain.com/api/products?page=--}} >
        <div class="products">
            @for ($i=0;$i<=10;$i++)
                <article>
                    <div class="img">
                        <a href="{{ route('user.product',['uri'=>"test"]) }}">
                            <img src="https://placehold.co/600x400.png" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{ route('user.product',['uri'=>"test"]) }}"><h3>سيرفر رام 4</h3></a>
                        <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. </p>
                        <a href="{{ route('user.product',['uri'=>"test"]) }}" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <a class="category" href="{{ route('user.product',['uri'=>"test"]) }}">سيرفرات</a>
                </article>
            @endfor
        </div>
        <button class="block w-fit mx-auto mt-4 button-blue px-6" id="moreProducts">
            المزيد
            <span class="hidden">
                <i class="fa-solid fa-spinner animate-spin"></i>
            </span>
        </button>
    </section>
    {{-- What Our --}}
    <section class="flex-page min-h-[50vh]">
        <div class="content">
            <h2>لماذا نحن</h2>
            <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. معجم شامل يحوي على معاني الكلمات العربية ومعاني الجمل ...</p>
        </div>
        <div class="image">
            <img src="{{ asset('images/undraw_working_re_ddwy.svg') }}" alt="لماذا نحن">
        </div>
    </section>
@endsection
@include('pages.home')
