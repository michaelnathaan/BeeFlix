<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Beeflix</h1>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <style>
        .responsive-image {
            display: block; 
            margin: 0 auto; 
            width: 40%; 
            max-width: 100%;
            height: auto; 
        }
        .container-content {
            align-items: center;
            justify-content: center;
            height: 100vh; 
            margin: 0;
            background-color: #f5f5f5;
        }
        .d-flex .btn {
        width: 40%; 
        max-width: 100%;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a href="/" class="navbar-brand">Beeflix</a>
    </div>
</nav>

<div class="container-content">
@yield('content')
</div>
  

</body>
</html>