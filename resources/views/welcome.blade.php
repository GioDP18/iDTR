<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
    @vite('resources/js/CustomJS/atlantis.js')
    @vite('resources/js/CustomJS/atlantis.min.js')
</body>

</html>