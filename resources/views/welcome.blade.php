<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
        @vite('resources/css/atlantis.css')
        @vite('resources/css/atlantis.css.map')
        @vite('resources/css/atlantis.min.css')
        @vite('resources/css/bootstrap.min.css')
        @vite('resources/css/demo.css')
        @vite('resources/css/fonts.css')
        @vite('resources/css/fonts.min.css')
    </head>
    <body>
        <div id="app"></div>


        
        @vite('resources/js/app.js')
        @vite('resources/js/CustomJS/core/jquery.3.2.1.min.js')
        @vite('resources/js/CustomJS/core/popper.min.js')
        @vite('resources/js/CustomJS/core/bootstrap.min.js')
        @vite('resources/js/CustomJS/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')
        @vite('resources/js/CustomJS/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')
        @vite('resources/js/CustomJS/plugin/jquery-scrollbar/jquery.scrollbar.min.js')
        @vite('resources/js/CustomJS/plugin/chart.js/chart.min.js')
        @vite('resources/js/CustomJS/plugin/jquery.sparkline/jquery.sparkline.min.js')
        @vite('resources/js/CustomJS/plugin/chart-circle/circles.min.js')
        @vite('resources/js/CustomJS/plugin/datatables/datatables.min.js')
        @vite('resources/js/CustomJS/plugin/bootstrap-notify/bootstrap-notify.min.js')
        @vite('resources/js/CustomJS/plugin/jqvmap/jquery.vmap.min.js')
        @vite('resources/js/CustomJS/plugin/jqvmap/maps/jquery.vmap.world.js')
        @vite('resources/js/CustomJS/plugin/sweetalert/sweetalert.min.js')
        @vite('resources/js/CustomJS/atlantis.min.js')
    </body>
</html>
