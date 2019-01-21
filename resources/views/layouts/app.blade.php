<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/cropper.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-nav">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}">Recipe</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Master Data
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('/lihat-kategori')}}">Kategori</a>
                                <a class="dropdown-item" href="{{url('/lihat-bahan')}}">Bahan Resep</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
        
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/cropper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jsme.js') }}" type="text/javascript"></script>
        <script>
        var getingunit = "{{url('getingunit')}}"
            upimages = "{{url('upimages')}}"
            postrecing = "{{url('postrecing')}}"
            postediting = "{{url('postediting')}}"
            deling = "{{url('deling')}}"
            getcategory = "{{url('getcategory')}}"
            uprecipename = "{{url('uprecipename')}}"
            token = "{{ csrf_token() }}";
        </script>
    </body>
</html>