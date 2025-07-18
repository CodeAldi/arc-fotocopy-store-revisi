<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>ARC FOTOCOPY</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing-assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('landing-assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('landing-assets/css/templatemo-hexashop.css') }}">

    <link rel="stylesheet" href="{{ asset('landing-assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('landing-assets/css/lightbox.css') }}">
    <!--TemplateMo 571 Hexashop https://templatemo.com/tm-571-hexashop -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css
    " rel="stylesheet">
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.landing.navbar')
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    @yield('content')

    <!-- ***** Footer Start ***** -->
    @include('layouts.partials.landing.footer')


    <!-- jQuery -->
    <script src="{{ asset('landing-assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('landing-assets/js/popper.js') }}"></script>
    <script src="{{ asset('landing-assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('landing-assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landing-assets/js/accordions.js') }}"></script>
    <script src="{{ asset('landing-assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('landing-assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/slick.js') }}"></script>
    <script src="{{ asset('landing-assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('landing-assets/js/isotope.js') }}"></script>
    <script src="{{ asset('landing-assets/js/quantity.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('landing-assets/js/custom.js')}}"></script>

    <script>
        
        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

</body>

</html>