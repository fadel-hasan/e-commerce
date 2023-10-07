@php
   if ($type == 'success') {
      $classFirst = 'border-green-600 text-green-800';
      $classLast = 'bg-green-900 animate-bounce';
   } else if ($type == 'pending') {
      $classFirst = 'border-yellow-600 text-yellow-800';
      $classLast = 'animate-spin';
   } else if ($type == 'fail') {
      $classFirst = 'border-red-600 text-red-800';
      $classLast = 'bg-red-900 animate-bounce';
   }
@endphp
<span
   class="border-2 px-2 py-1 my-px inline-flex items-center rounded-full font-bold {{ $classFirst }} min-w-[95px]">
   {{ $message }}
   @if ($type == 'pending')
      <span class="mr-2 rounded-full {{ $classLast }}"><i class="fa-solid fa-circle-notch"></i></span>
   @else
      <span class="block w-[10px] h-[10px] mr-2 rounded-full {{ $classLast }}"></span>
   @endif
</span>
