<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../css/DoctorCss/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="../asset/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="../asset/css/feathericon.min.css">

    <title>Doctor Profile</title>


</head>

<body>

    <!-- SIDEBAR -->
    @include('doctor_pages.component.sidebar')
    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <section id="content">
    <!-- NAVBAR -->
    @include('doctor_pages.component.navbar')
    <!-- NAVBAR -->
        <main>
        <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li><a href="#">Dashboard</a> </li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <!-- /Page Header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-auto profile-image">
                                    <a href="#"><img style="width:200px;" class="rounded-circle" alt="User Image"src="{{ asset('DoctorImages') }}/{{ $doctor->doc_image }}"></a>
                                </div>
                                <div class="col ml-md-n2 profile-user-info">
                                    <h4 class="user-name mb-0">{{ $doctor->name }}</h4>
                                    <h6 class="text-muted">{{ $doctor->email }}</h6>
                                    <div class="user-Location"><i class="fa fa-map-marker"></i> {{ $doctor->address }}</div>
                                    <div class="about-text"><h6 style="width:800px;"><i class="fa fa-stethoscope"></i> Speciality : {{ $doctor->speciality}}</h6></div>
                                    <div class="about-text"><h6 style="width:800px;"><i class="fa fa-heartbeat"></i> Follow-up: <span style="color:red;">{{ $paient_count }}</span> Patients</h6></div>
                                </div>
                                <div class="col-auto profile-btn"></div>
                            </div>
                        </div>

                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password_tab">Password</a></li>
                            </ul>
                        </div>
                        <div class="tab-content profile-tab-cont">
                            <!-- Personal Details Tab -->
                            <div class="tab-pane fade show active" id="per_details_tab">
                                <!-- Personal Details -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between"><span>Personal Details</span><a class="edit-link" data-toggle="modal"href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a></h5>
                                                <div class="row"><p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                                    <p class="col-sm-10">{{ $doctor->name }}</p>
                                                </div>
                                                <div class="row"><p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                                    <p class="col-sm-10">{{ $doctor->date_of_birthday }}</p>
                                                </div>
                                                <div class="row"><p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                                    <p class="col-sm-10">{{ $doctor->email }}</p>
                                                </div>
                                                <div class="row"><p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-10">{{ $doctor->phone }}</p>
                                                </div>
                                                <div class="row"><p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                                    <p class="col-sm-10 mb-0">{{ $doctor->address }} , {{ $doctor->country }}<br> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Details Modal -->
                                        <form method="POST" action="/editDoctorPersonalInfo" class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                        @csrf
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Personal Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="row form-row">
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="doctor_id" value="{{ $doctor->doctor_id }}">
                                                                        <label>Name</label>
                                                                        <input name="name" type="text"class="form-control" value="{{ $doctor->name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Speciality</label>
                                                                        <input name="speciality" type="text" class="form-control" value="{{ $doctor->speciality }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Date of Birth</label>
                                                                        <div class="cal-icon">
                                                                            <input name="date_of_birthday" type="text" class="form-control" value="{{ $doctor->date_of_birthday }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Email ID</label>
                                                                        <input name="email" type="email" class="form-control" value="{{ $doctor->email }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Mobile</label>
                                                                        <input name="phone" type="text" value="{{ $doctor->phone }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input name="address" type="text"  class="form-control" value="{{ $doctor->address }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <input name="country" type="text" class="form-control" value="{{ $doctor->country }}">
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                            <button type="submit"  class="btn btn-primary btn-block">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /Edit Details Modal -->
                                    </div>
                                </div>
                                <!-- /Personal Details -->
                            </div>
                            <!-- /Personal Details Tab -->
                            <!-- Change Password Tab -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="password_tab" class="tab-pane fade" action="changeDoctorPassword" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Change Password</h5>
                                        <div class="row">
                                            <div class="col-md-10 col-lg-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input type="hidden" name="doctor_id" value="{{ $doctor->doctor_id }}">
                                                        <input name="old" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input name="password" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input name="password_comfirmation" type="password" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /Change Password Tab -->
                        </div>
                    </div>
                </div>
        </main>
    </section>





    <!-- CONTENT -->
    <!-- jQuery -->
    <script src="../asset/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="../asset/js/popper.min.js"></script>



    <!-- Custom JS -->
    <script src="../asset/js/script.js"></script>
    <script src="../js/DoctorJS/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    <script>
        function previewFile(input) {
            var file = $('input[type=file]').get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr('src', reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>


    <script>
        function previewFile(input) {
            var file = $('input[type=file]').get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr('src', reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @if (Session::has('Doctor_personal_info'))
        <script>
            swal("Geart Job!", "{!! Session::get('Doctor_personal_info') !!}", {
                button: "OK",
            })
        </script>
    @endif

    @if (Session::has('password_updated'))
        <script>
            swal("Geart Job!", "{!! Session::get('password_updated') !!}", {
                button: "OK",
            })
        </script>
    @endif

</body>

</html>
