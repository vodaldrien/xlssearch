<!doctype html>
<html lang="en">
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ mix('js/xls.js') }}" defer></script>

    <link rel="stylesheet" href="{{ mix('css/xls.css') }}">
</head>`
<body>
    <input type="text" id="xls_search" placeholder="@lang('xls.search')"/>
    <blockquote>@lang('xls.triplestar')</blockquote>
    <div id="results"></div>
    <hr>

    <form action="{{ route('xls.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="xls">
        <input type="submit" value="@lang('xls.upload')">
    </form>
    <hr>
    @foreach($xls as $x)
        <form method="POST" action="{{ route('xls.delete') }}" class="file-box">
            @csrf
            @method('DELETE')
            <button>@lang('xls.delete')</button>
            <input class="file-selector" type="checkbox" checked="checked" value="{{ $x }}">
            <input type="hidden" name="filename" value="{{ $x }}">
            File: {{ $x }}
        </form>
    @endforeach
    <hr>


</body>
</html>
