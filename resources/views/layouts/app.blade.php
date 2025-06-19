<!-- app.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>@yield('title')</title>
</head>
<body>
    @include('components.user.header')
    <div class="container">
        @include('components.user.sidebar')
        @yield('content') <!-- Nội dung chính sẽ được chèn vào đây -->
    </div>
    @include('components.user.footer')
    <script src="bootstrap/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 