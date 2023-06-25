<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/Lablogin.png">
    <!--Icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Space+Mono|Muli">
    <!--Cards-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/Lab_css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/Lab_css/font-awesome.min.css">
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="/Lab_css/feathericon.min.css">
    <!-- custom css file link  -->
    @section('css')
    <link rel="stylesheet" href="/Lab_css/LabDashboard.css">
    @show
</head>

<body>

    <!---- Sweet alert---->
    @include('sweetalert::alert')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <div class="header">
            <!-- Header Right Menu -->

            <ul class="nav user-menu">


                <!-- Search -->
                <li class="nav-item ">
                    <a class=" nav-link" href="/LabSearch" title="Search"><img style="width:32px; height:33px; margin-right:0px;" alt="Search Icon" src="/Lab_images/searchIcon.png"></a>
                </li>
                
                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="/Lab_images/adminIcon.jpg" width="31" alt="admin"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="user-text">
                                <p class="text-muted mb-0"><i class="fa fa-lock" aria-hidden="true"></i> Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="/LabDash"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        <a class="dropdown-item" href="/LabLogout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                    </div>
                </li>
                <!-- /User Menu -->

            </ul>
            <!-- /Header Right Menu -->


            <!--  Middle Header -->
            <div class="middleHeader">
                <h4 id="text" name="pageName" class="pagetxt">@yield('pageTitle')</h4>
            </div>
            <!-- / Middle Header -->


            <!--  Left Header -->
            <div class="leftHeader">
                <img src="/Lab_images/lablogo.jpg" alt="Lab Logo" />
                <h4 id="text" name="labName" class="Labtxt">{{session('labName')}}</h4>
            </div>
            <!-- / Left Header -->

        </div>





        @section('MainSection')

        <!--  Page  -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">@yield('Welcomepage')</h3>
                            <!--  A breadcrumb navigation provide links back to each previous page the user navigated through--> 
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item "><i class="material-icons" style="font-size: 20px;">home</i><a @class(['active'=>Request::is('LabDash')]) href="/LabDash"> {{session('labName')}} - Dashboard </a></li>
                                <li class="breadcrumb-item "><i class="material-icons" style="font-size: 20px;">event</i><a @class(['active'=>Request::is('LabBookedAppointment')]) href="/LabBookedAppointment"> Booked Appointments</a></li>
                                <li class="breadcrumb-item "><i class="material-icons" style="font-size: 22px;">attachment</i><a @class(['active'=>Request::is('LabUploads')]) href="/LabUploads"> Required Uploads </a></li>
                                <li class="breadcrumb-item"><i class="fa fa-commenting-o"></i><a @class(['active'=>Request::is('LabChat')]) href="/chatify">Contact Patient</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->




                <!-- Main Content -->
                @yield('main')

            </div>
        </div>
        @show
        <!-- Bootstrap Core JS -->
        <script src="/Lab_js/popper.min.js"></script>

        @section('customJS')
        <!-- jQuery -->
        <script src="/Lab_js/jquery-3.2.1.min.js"></script>
        <script src="/Lab_js/bootstrap.min.js"></script>

        @show
</body>

</html>