<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{asset('custom/css/bootstrap.min.css')}}" rel="stylesheet">

    @yield('css')

    <title>@yield('title', 'Link Generator')</title>
</head>
<body>
    <!-- Standard Header -->
    <header class="bg-dark text-white py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h5">Link Generator</h1>
            <nav>
                <a href="/" class="text-white text-decoration-none mx-2">Home</a>
                <a href="/url-link/list" class="text-white text-decoration-none mx-2">View Links</a>
                <a href="/contact" class="text-white text-decoration-none mx-2">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Standard Footer -->
    <footer class="bg-dark text-center text-white py-3">
        <div class="container">
            &copy; {{ date('Y') }} Link Generator. All Rights Reserved by {Him}.
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @yield('js')
</body>
</html>
