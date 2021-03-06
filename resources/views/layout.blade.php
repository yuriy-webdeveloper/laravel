<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Flyer</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/lity.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="/js/lity.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ProjectFlyer</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            @if($signedIn)
                <p class="navbar-text navbar-right">
                    Hello {{$user->name}}
                </p>
            @endif

        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container theme-showcase">
    @yield('content')
</div>

</body>

</html>