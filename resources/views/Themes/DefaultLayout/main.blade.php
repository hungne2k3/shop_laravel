<!DOCTYPE html>
<html lang="en">

<head>
    @include('Themes.DefaultLayout.head')
</head>

<body> {{-- class="animsition" --}}

    <!-- Header -->
    @include('Themes.Layouts.header')

    <!-- Cart -->
    @include('Themes.Layouts.cart')

    @yield('content')

    <!-- Footer -->
    @include('Themes.DefaultLayout.footer')

</body>

</html>
