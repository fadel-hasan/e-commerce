@section('title',"نتائج البحث عن: {$searchOut}")
@section('app')
    {{-- Search About --}}
    <section class="py-32">
        <h2 class="text-center text-2xl">نتائج البحث عن: <span class="font-bold">{{ $searchOut }}</span></h2>
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
