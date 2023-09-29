@section('title','الصفحة الرئيسية')
@section('app')
    {{-- Hero --}}
    <section class="container mx-auto min-h-[calc(100vh-70px)] sm:min-h-[calc(100vh-77px)]
    flex flex-row justify-center items-center flex-wrap px-2
    ">
        <div class="content w-full md:w-2/3 mt-6 md:mt-0">
            <h1 class="text-3xl font-bold text-blue-600 text-center md:text-start">العنوان</h1>
            <p class="max-w-[600px] text-center leading-8 text-gray-700 font-bold mt-4">معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. معجم شامل يحوي على معاني الكلمات العربية ومعاني الجمل ...</p>
        </div>
        <div class="image w-3/4 md:w-1/3">
            <img src="{{ asset('images/undraw_stripe_payments_re_chlm.svg') }}" alt="" class="w-full">
        </div>
    </section>
    {{-- products --}}
    <section id="products"
    data-url-products=""
    {{-- set route api for get products and limte in all pages 10
        example: domain.com/api/products/{pages}
    --}}
    >
        <div class="products">
            @for ($i=0;$i<=10;$i++)
                <article>
                    <div class="img">
                        <a href="#">
                            <img src="https://placehold.co/600x400.png" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="#"><h3>سيرفر رام 4</h3></a>
                        <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. </p>
                        <a href="#" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <span class="category">سيرفرات</span>
                </article>
            @endfor
        </div>
        <a href="#" class="block w-fit mx-auto mt-4 button-blue px-6" id="moreProducts">
            المزيد
            <span class="hidden">
                <i class="fa-solid fa-spinner animate-spin"></i>
            </span>
        </a>
    </section>
@endsection
@include('pages.home')
