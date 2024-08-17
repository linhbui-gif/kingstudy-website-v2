<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<?php
$ver_js = \App\Helpers\General::get_version_js();
$ver_css = \App\Helpers\General::get_version_css();
$ac = \App\Helpers\General::get_controller_action();
$settings = \App\Helpers\General::get_settings();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (isset($title))
            {{ ucfirst($title).' :: '.config('app.name')}}
        @else
            @yield('title', 'Admin'){{' :: '.config('app.name')}}
        @endif
    </title>

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="/html/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/html/plugins/font-awesome/css/font-awesome.min.css?v=1">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="/html/css/nifty.min.css" rel="stylesheet">
    <link href="/html/css/nifty-custom.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="/html/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="/html/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!--Demo [ DEMONSTRATION ]-->
    <link href="/html/css/demo/nifty-demo.min.css" rel="stylesheet">

    <!--Morris.js [ OPTIONAL ]-->
    <link href="/html/plugins/morris-js/morris.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="/html/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="/html/plugins/select2/css/select2.min.css" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
    <link href="/html/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/html/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!--Switchery [ OPTIONAL ]-->
    <link href="/html/plugins/switchery/switchery.min.css" rel="stylesheet">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/html/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    <!-- pnotify -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/pnotify/pnotify.custom.min.css') }}">

    <!-- flag-icon -->
    <link rel="stylesheet" href="{{url('/css/flag-icon.min.css')}}">

    @stack('linkCss')
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="/html/plugins/pace/pace.min.css" rel="stylesheet">

    @yield('before_styles')
    <link rel="stylesheet" href="{{ asset('css/customs-admin.css?v='.$ver_css) }}">
    @yield('after_styles')

    <!-- Favicons -->
    <link rel="icon" href="/html/img/favicon.png" type="image/x-icon" sizes="32x32">

    <script type="text/javascript">
        var _base_url = '{{url('/')}}';
        var _is_login = {{auth()->check() ? 'true' : 'false'}};
    </script>

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">

    <!--NAVBAR-->
    <!--===================================================-->
    @include('admin::includes.header')
    <!--===================================================-->
    <!--END NAVBAR-->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->

        <div id="content-container">
            <!--Page content-->
            <!--===================================================-->
            @yield('content')
            <!--===================================================-->
            <!--End page content-->
        </div>

        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        <!--MAIN NAVIGATION-->
        <!--===================================================-->
        @include('admin::includes.navigation')
        <!--===================================================-->
        <!--END MAIN NAVIGATION-->

    </div>


    <!-- FOOTER -->
    <!--===================================================-->
    @include('admin::includes.footer')
    <!--===================================================-->
    <!-- END FOOTER -->

    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->

</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<script src="/html/plugins/pace/pace.min.js"></script>


<!--jQuery [ REQUIRED ]-->
<script src="/html/js/jquery.min.js"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="/html/js/bootstrap.min.js"></script>
<script src="{{ asset('/assets/plugins/moment/min/moment-with-locales.min.js') }}"></script>
<!--NiftyJS [ RECOMMENDED ]-->
<script src="/html/js/nifty.min.js"></script>
<!--=================================================-->

<!--Demo script [ DEMONSTRATION ]-->
<script src="/html/js/demo/nifty-demo.min.js"></script>

<!--Sparkline [ OPTIONAL ]-->
<script src="/html/plugins/sparkline/jquery.sparkline.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="/html/plugins/select2/js/select2.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('/html/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!--DataTables [ OPTIONAL ]-->
<script src="/html/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="/html/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/html/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Switchery [ OPTIONAL ]-->
<script src="/html/plugins/switchery/switchery.min.js"></script>

<!--DataTables Sample [ SAMPLE ]-->
<script src="/html/js/demo/tables-datatables.js"></script>
<script src="{{ asset('/assets/plugins/pnotify/pnotify.custom.min.js') }}"></script>
<script src="/js/jquery.validate.min.js"></script>
<script src="/js/numeral.min.js"></script>
<script src="/js/function.js?v={{$ver_js}}"></script>

<!-- page script -->
<script type="text/javascript">
    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('after_scripts')
@stack('stackJS')
</body>
</html>
