<div class="checkbox">
    <label for="{{ $name }}" class="ml-2 cursor-pointer">{!! $title !!}</label>
    <label for="{{ $name }}" class="flex items-center cursor-pointer">
        <!-- toggle -->
        <div class="relative">
            <!-- input -->
            <input type="checkbox" name="{{ $name }}" id="{{ $name }}">
            <!-- line -->
            <div class="line"></div>
            <!-- dot -->
            <div class="dot">
            </div>
        </div>
    </label>
</div>
