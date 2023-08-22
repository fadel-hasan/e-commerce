@section('title')
    لوحة التحكم
@endsection
@section('app')
    @include('layouts.navbarAdmin')
    {{--     4 Box for information data
    last users
    last product
    last order --}}
    <div class="dashboard w-[calc(100%-4rem)] transition-all duration-300 ease-linear">
        <div class="boxs relative">
            <div class="box">
                <span class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </span>
                <div>
                    <h3>عدد المنتجات</h3>
                    <p>200</p>
                </div>
            </div>
            <div class="box">
                <span class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </span>
                <div>
                    <h3>title</h3>
                    <p>des</p>
                </div>
            </div>
            <div class="box">
                <span class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </span>
                <div>
                    <h3>title</h3>
                    <p>des</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('pages.home')
