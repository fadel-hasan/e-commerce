@section('title',"قسم: {$category}")
@section('app')
    {{-- Search About --}}
    <section class="py-32 lg:container mx-auto">
        <h2 class="text-center text-2xl">قسم: <span class="font-bold text-blue-600">{{ $category }}</span></h2>
        <p class="text-center max-w-[1200px] text-gray-900 leading-8 mt-2 font-bold mx-auto">{{ $desCategory }}</p>
    </section>
    {{-- products --}}
    <section id="products">
        <div class="products">
            @for ($i=1;$i<=5;$i++)
                <article>
                    <div class="img">
                        <a href="#">
                            <img src="https://placehold.co/600x400.png" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="#"><h3>سيرفر رام {{ $i }}</h3></a>
                        <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. </p>
                        <a href="#" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <a class="category" href="#">سيرفرات</a>
                </article>
            @endfor
        </div>
    </section>
@endsection
@include('pages.home')
