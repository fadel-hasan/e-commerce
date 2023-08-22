@php
    if ($type == 'success') {
        $class = 'bg-green-600 text-white border border-green-700';
        $close = 'bg-green-700 text-white border border-green-800  hover:border-green-900 hover:bg-green-800 transition-colors duration-200';
    } else if ($type == 'fail') {
        $class = 'bg-red-600 text-white border border-red-700';
        $close = 'bg-red-700 text-white border border-red-800 hover:border-red-900 hover:bg-red-800 transition-colors duration-200';
    }
@endphp
<div class="my-4 alert">
    <div class="w-[90%] max-w-3xl mx-auto px-4 py-2 rounded-md relative {{ $class }}">
        <h3 class="text-xl font-bold py-2">{{ $title }}</h3>
        <hr class="border">
        <p class="py-2">
           {{ $message }}
        </p>
        <span class="close-alert {{ $close }} w-8 h-8 text-center pt-1 block rounded-full absolute top-2 left-2 cursor-pointer">
            <i class="fa-solid fa-close"></i>
        </span>
    </div>
</div>