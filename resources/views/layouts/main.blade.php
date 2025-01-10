<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body class="d-flex flex-column min-vh-100">
    @include('components.toaster')
    @include('components.navbar')
    <main class="flex-grow-1 mt-5">
        @yield('container')
    </main>
    @include('components.footer')
    @include('components.js')
</body>

</html>
