<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>

    @include('layout.partial.link')
</head>

<body class="sb-nav-fixed">
    @include('theme.header')
    <div id="layoutSidenav">
        @include('theme.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('theme.footer')
        </div>
    </div>
    @include('layout.partial.script')
</body>

</html>
