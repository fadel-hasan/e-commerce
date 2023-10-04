@php
    $price = 20;
@endphp
@section('title', 'دفع المعاملة '.$order_id)
@section('app')
    @if ($payment == 'info')
    <h2 class="title-table mt-4">الرجاء إختيار وسيلة الدفع</h2>
        <nav class="container mx-auto flex flex-row justify-center gap-x-6 gap-y-6 flex-wrap">
            @foreach ($listPayment as $paymentValue)
                <a href="{{ route('user.payment',['id'=>$order_id,'paymentMethod'=>$paymentValue]) }}" class="button-blue">{{ $paymentValue }}</a>
            @endforeach
        </nav>
    @else
        <div class="container mx-auto px-2 sm:px-4 mt-6">
            @include('pages.payment.'.$payment)
        </div>
    @endif
@endsection
@include('pages.home')
