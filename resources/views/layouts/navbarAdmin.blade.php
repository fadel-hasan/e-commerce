<nav id="navbarAdmin">
    @foreach ($adminLinks as $link)
        <a href="{{ $link['to'] }}">
            <span class="icon">
                <i class="{{ $link['icon'] }}"></i>
            </span>
            <span class="title">{{ $link['title'] }}</span>
        </a>
    @endforeach
</nav>
