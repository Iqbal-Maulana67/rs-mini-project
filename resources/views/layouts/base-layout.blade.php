<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RS Mini Project</title>

    <!-- Favicon -->

    @vite(['resources/assets/css/backend-plugin.min.css', 'resources/assets/css/backend.css?v=1.0.0', 'resources/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css', 'resources/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css'])

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        @yield('content')
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @yield('js-script')
</body>

</html>
