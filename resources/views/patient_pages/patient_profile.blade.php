<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

    <style>
        .submit{
            background-color: #007bff;
            border-radius: 10%;
            border:none;
            color: white;
            padding: 16px 30px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
        .image{
            font-weight: bold;
            color: dodgerblue;
            padding: 0.5em;
            border: thin solid grey;
            border-radius: 3px;
        }
        .not_match_password , .wrong_password{
            text-align: center;
            color: rgb(221, 38, 38);
            padding: 20px;
            background-color: #f1f5f9;
            border-radius: 15px;
        }

    </style>

</head>

<!-- patient_profile -->

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')

        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')
            <!-- End Head -->

            <h1 class="p-relative">Profile</h1>
            <div class="profile-page m-20">
                <!-- Start Overview -->
                <div class="overview bg-white rad-10 d-flex align-center">
                    <div class="avatar-box txt-c p-20">
                        <img class="rad-half mb-10" src="{{ asset('PatientImages') }}/{{ $patient_image }}" alt="" />
                        <h3 class="m-0">{{ session('patient_login')->name }}</h3>
                    </div>
                    <div class="info-box w-full txt-c-mobile">
                        <!-- Start Information Row -->
                        <div class="box p-20 d-flex align-center">
                            <h4 class="c-grey fs-15 m-0 w-full">General Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Full Name</span>
                                <span>{{ session('patient_login')->name }}</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Gender:</span>
                                <span>{{ session('patient_login')->sex }}</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Country:</span>
                                <span>{{ session('patient_login')->country }}</span>
                            </div>
                            <div class="fs-14">
                                <label>
                                  
                                </label>
                            </div>
                        </div>
                        
                        <div class="box p-20 d-flex align-center">
                            <h4 class="c-grey w-full fs-15 m-0">Personal Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Email:</span>
                                <span>{{ session('patient_login')->email }}</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Phone:</span>
                                <span>{{ session('patient_login')->phone }}</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Date Of Birth:</span>
                                <span>{{session('patient_login')->birth_of_date}}</span>
                            </div>
                            <div class="fs-14">
                                <label>

                                </label>
                            </div>
                        </div>
                    
                        <div class="box p-20 d-flex align-center">
                            <h4 class="c-grey w-full fs-15 m-0">Treated By</h4>
                            @foreach ($data as  $key => $value)
                            <div class="fs-14">
                                <span class="c-grey">Dr:</span>
                                <span>{{ $value->name }}</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Phone:</span>
                                <span>{{ $value->phone }}</span>
                            </div>
                            <div class="fs-14">
                              <a href="/chatify/{{ \App\Models\User::where('email', $value->email)->first()->id }}"> <span>Send Message to Dr /{{ $value->name }}</span></a>
                            </div>
                            
                            @endforeach
                        </div>
                        <!-- End Information Row -->
                    </div>
                </div>
                <!-- End Overview -->

                <!-- Start Other Data -->
                <div class="other-data d-flex gap-20">
                    <div class="activities p-20 bg-white rad-10 mt-20">
                        <div class="targets p-20 bg-white rad-10">
                            <div class="content w-full">
                                 <div class="settings-page m-20 d-grid gap-20">
                                    <!-- Start Settings Box -->
                                    <div class="p-20 bg-white rad-10" >
                                        <h2 class="mt-0 mb-10" style="text-align:center">Change Password</h2>
                                        <form  method="post" action="/change_patient_password">
                                            @csrf
                                            <input type="hidden"  name="MRN" value="{{ session('patient_login')->MRN}}" />
                                            <div class="mb-15">
                                                @if (Session::has('wrong_password'))
                                                    <p class="wrong_password">{{ Session::get('wrong_password') }}</p>                                           
                                                @endif
                                                <label class="" for="first">Old Password</label>
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" name="oldpassword" type="password" id="first" placeholder="Enter Old Password" />
                                            </div>
                                            <div class="mb-15">
                                                @if (Session::has('not_match_password'))
                                                    <p class="not_match_password">{{ Session::get('not_match_password') }}</p>                                           
                                                @endif
                                                <label class="" for="last">New Password</label>
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" name="newpassword1" id="last" type="password" placeholder="Enter New Password" pattern=".{9,}" title="Must contain at least 9 or more characters" />
                                            </div>
                                            <div class="mb-15">
                                                <label class="" for="last">Confirm Password</label>
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" name="newpassword2" id="last" type="password" placeholder="Confirm Password" />
                                            </div>
                                          
                                            <div style="text-align:center">
                                            <button type="submit" class="submit" style="margin-top:85px" >Change</button></div>
                                        </form>
                                    </div>
                                    <!-- End Settings Box -->
                                   
                                    <!-- Start Settings Box -->
                                    <form method="post" action="/change_g_info" enctype="multipart/form-data">
                                        @csrf
                                        <div class="p-20 bg-white rad-10">
                                            <h2 class="mt-0 mb-10" style="text-align:center">Edit Info</h2>
                                            <div class="mb-15">
                                                <label for="first">First Name</label>
                                                <input type="hidden"  name="MRN" value="{{ session('patient_login')->MRN}}" />
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" type="text" id="first" placeholder="Name" name="name"  value="{{ session('patient_login')->name }}" />
                                            </div>
                                            <div class="mb-15">
                                                <label for="last">Phone</label>
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" id="last" type="text" placeholder="Phone" name="phone" value="{{ session('patient_login')->phone }} "/>
                                            </div>
                                            <div class="mb-15">
                                                <label for="formFile" >Profile Image</label><br>
                                                <input type="file"  name="file" class="image  form-control" style="width:530px">
                                            </div>
                                            <div class="mb-15">
                                                <label class="" for="email">Email</label>
                                                <input class="b-none border-ccc p-10 rad-6 d-block w-full" id="email" type="email" placeholder="email" name="email" value="{{ session('patient_login')->email }} "/>
                                            </div>
                                            <div style="text-align:center">
                                            <button type="submit" class="submit">Change</button></div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Other Data -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    @if(Session::has('change_g_info'))
    <script>
        swal("Geart Job!","{!! Session::get('change_g_info') !!}",{
            button:"OK", })
    </script>
    @endif
    @if(Session::has('password_ok'))
    <script>
        swal("Geart Job!","{!! Session::get('password_ok') !!}",{
            button:"OK",})
        </script>

    @endif
    
    </body>

</html>
