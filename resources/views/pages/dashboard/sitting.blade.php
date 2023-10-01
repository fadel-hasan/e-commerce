@section('title','الإعدادات')
@section('app')
    @include('layouts.navbarLeft')
    <div class="dashboard">
        <h2 class="title-table">الاعدادات</h2>
        <form action="{{ route('dashboard.sitting') }}" method="POST" class="sitting">
            @csrf
            @foreach ($commands as $command)
                <label for="{{ $command['id'] }}">{{ $command['name'] }}:</label>
                @if ($command['type'] == 'textarea')
                    <textarea name="{{ $command['id'] }}" id="{{ $command['id'] }}" cols="25" rows="6" @required($command['required'])>{{ $command['value'] }}</textarea>
                @else
                    <input type="{{ $command['type'] }}" name="{{ $command['id'] }}" id="{{ $command['id'] }}" value="{{ $command['value'] }}" @required($command['required']) @class(['hidden' => ($command['type'] == 'file')])>
                @endif
                @if ($command['type'] == 'file')
                    <input type="text" disabled value="لا يوجد صورة" id="filePhoto">
                @endif
            @endforeach
            <input type="submit" value="حفظ" class="button-blue w-fit mx-auto px-12 mb-4">
        </form>
    </div>
@endsection
@include('pages.home')
