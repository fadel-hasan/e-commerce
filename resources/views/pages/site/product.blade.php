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
    {{-- Products --}}
    <section id="products" class="scroll-mt-[73px] md:scroll-mt-[80px]">
        <h2 class="text-2xl my-2 text-center title-table">منتاجات قد تعجبك</h2>
        {{--
            -------------------------------------
            مهم
            -------------------------------------
            جلب 4 منتجات من نفس القسم و منتجان تم شرائهم بكثرة ومنتجان بشكل عشوائي
            في حال عدم وجود منتج  من نفس القسم او قام بشرائها يتم عرض منتج عشوائي
            --}}
        <div class="products mt-8">
            @for ($i = 0; $i <= 6; $i++)
                <article>
                    <div class="img">
                        <a href="{{ route('user.product', ['uri' => 'test']) }}">
                            <img src="https://placehold.co/600x400.png" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{ route('user.product', ['uri' => 'test']) }}">
                            <h3>سيرفر رام 4</h3>
                        </a>
                        <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي.
                        </p>
                        <a href="{{ route('user.product', ['uri' => 'test']) }}" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <a class="category" href="{{ route('user.product', ['uri' => 'test']) }}">سيرفرات</a>
                </article>
            @endfor
        </div>
    </section>
@endsection
@include('pages.home')
