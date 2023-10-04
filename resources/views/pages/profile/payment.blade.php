@section('title', 'دفع المعاملة '.$order_id)
@section('app')
    @if ($payment == 'info' and isset($listPayment))
    <h2 class="title-table mt-4">الرجاء إختيار وسيلة الدفع</h2>
    <p id="error" class="text-center text-red-800 font-bold"></p>
    <script>
        let price = {{ $price }};
    </script>
        <form action="{{ route('user.payment.pay',['paymentOrder'=>$order_id]) }}" method="post" class="sitting"  data-api="{{ route('copon.api',['hash'=>$hash]) }}">
            @csrf
            <label for="price">السعر:</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ $price }}" readonly required>
            <label for="quantity">الكمية</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->quantity  }}" required>
            <label for="copone">كود الخصم:</label>
            <div class="mt-2 gap-x-2 border px-2 flex flex-row justify-center rounded-lg py-2 items-center">
                <input type="text" name="copone" id="copone" placeholder="كود الخصم">
                <span class="button-blue inline-block h-fit py-2" id="applyCopone">تطبيق</span>
            </div>
            <nav class="container mx-auto flex flex-row justify-center gap-x-6 gap-y-6 flex-wrap mt-6">
                @foreach ($listPayment as $paymentValue)
                    <input type="submit" name="method" value="{{ $paymentValue }}" class="button-blue">
                @endforeach
            </nav>
        </form>
    @else
        <div class="container mx-auto px-2 sm:px-4 mt-6">
            @include('pages.payment.'.$payment)
        </div>
    @endif
@endsection
@include('pages.home')
