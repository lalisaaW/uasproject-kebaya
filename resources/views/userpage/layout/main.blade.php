<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Userpage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="{{ asset('assets2/img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets2/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/css/style.css') }}" rel="stylesheet">
</head>


<body data-spy="scroll" data-target=".navbar" data-offset="51">
    @include('userpage.layout.navbar')

    @yield('content')
    @include('userpage.layout.footer')
    <i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i>
    <a href="#" class="btn btn-outline-dark px-0 back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets2/lib/typed/typed.min.js') }}"></script>
    <script src="{{ asset('assets2/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets2/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets2/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets2/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets2/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets2/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('assets2/mail/contact.js') }}"></script>
    <script src="{{ asset('assets2/js/main.js') }}"></script>
</body>

</html>
