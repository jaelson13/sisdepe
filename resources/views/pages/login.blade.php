<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />    
    <title>SISDEPE</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons
     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/now-ui-dashboard.css?v=1.0.1')}}" rel="stylesheet" />
    <!-- Custom -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>
<body style="background: #659999;background: -webkit-linear-gradient(to bottom, #f4791f, #659999);
background: linear-gradient(to bottom, #f4791f, #659999); 
">
<div id="app">    
    <login-component></login-component>
</div>
<!--   Core JS Files   -->
<script type="text/javascript" src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{asset('/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!-- Chart JS -->
<!--<script src="../assets/js/plugins/chartjs.min.js"></script>-->
<!--  Notifications Plugin    -->
<!--<script src="../assets/js/plugins/bootstrap-notify.js"></script>-->
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script type="text/javascript" src="{{asset('/js/now-ui-dashboard.js?v=1.0.1')}}"></script>
<!--<script src="../assets/demo/demo.js"></script>-->
</body>
</html>

