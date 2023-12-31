<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../css/DoctorCss/style.css">
    <!-- Favicons -->
    <link href="asset/img/features/feature-04.jpg" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../asset/css/bootstrap.min1.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="../asset/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../asset/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../asset/css/style2.css">


    {{-- side bar --}}
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />


    <title>AdminHub</title>


</head>

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')


    {{-- <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="HomeDoctor.html" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Doctor Dashboard</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="HomeDoctor.html">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="DoctorProfile.html">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">My Profile</span>
                </a>
            </li>
            <li>
                <a href="patientListDoctor.html">
                    <i class='bx bxs-group'></i>
                    <span class="text">Patients</span>
                </a>
            </li>
            <li>
                <a href="emergencyList.html">
                    <i class='bx bxs-alarm-exclamation'></i>
                    <span class="text">Emergency</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Messages</span>
                </a>
            </li>
            <li>
                <a href="loginDoctor.html">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
            <li>
                <a href="lock-screen.html">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">lock-screen</span>
                </a>
            </li>


        </ul>


    </section> --}}
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        {{-- <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <!-- <div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div> -->
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <!-- <a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a> -->
            <a href="#" class="profile">
                <img src="../asset\img\profiles/doc-6.jpg">
            </a>
        </nav> --}}
        <!-- NAVBAR -->
        <!-- Page Content -->
        <div class="content" style="margin-top:45px; margin-left: -50px;" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="chat-window">

                            <!-- Chat Left -->
                            <div class="chat-cont-left">
                                <div class="chat-header">
                                    <span>Chats</span>
                                    <a href="javascript:void(0)" class="chat-compose">
                                        <i class="material-icons">control_point</i>
                                    </a>
                                </div>
                                <form class="chat-search">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                </form>
                                <div class="chat-users-list">
                                    <div class="chat-scroll">
                                        <a href="javascript:void(0);" class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-away">
                                                    <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Richard Wilson</div>
                                                    <div class="user-last-chat">Hey, How are you?</div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">2 min</div>
                                                    <div class="badge badge-success badge-pill">15</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat active">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="../asset/img/patients/patient1.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Charlene Reed</div>
                                                    <div class="user-last-chat">I'll call you later </div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">8:01 PM</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-away">
                                                    <img src="../asset/img/patients/patient2.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Travis Trimble </div>
                                                    <div class="user-last-chat">Give me a full explanation about our project
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">7:30 PM</div>
                                                    <div class="badge badge-success badge-pill">3</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="../asset/img/patients/patient3.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Carl Kelly</div>
                                                    <div class="user-last-chat">That's very good UI design</div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">6:59 PM</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-offline">
                                                    <img src="../asset/img/patients/patient4.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Michelle Fairfax</div>
                                                    <div class="user-last-chat">Yesterday i completed the task</div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">11:21 AM</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="../asset/img/patients/patient5.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Gina Moore</div>
                                                    <div class="user-last-chat">What is the major functionality?</div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">10:05 AM</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-away">
                                                    <img src="../asset/img/patients/patient6.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Elsie Gilley</div>
                                                    <div class="user-last-chat">This has allowed me to showcase not only my technical skills</div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">Yesterday</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-offline">
                                                    <img src="../asset/img/patients/patient7.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Joan Gardner</div>
                                                    <div class="user-last-chat">Let's talk briefly in the evening.
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">Sunday</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="../asset/img/patients/patient8.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Daniel Griffing</div>
                                                    <div class="user-last-chat">Do you have any collections? If so, what of?
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">Saturday</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="media read-chat">
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-away">
                                                    <img src="../asset/img/patients/patient9.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">Walter Roberson</div>
                                                    <div class="user-last-chat">Connect the two modules with in 1 day.
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="last-chat-time block">Friday</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Chat Left -->

                            <!-- Chat Right -->
                            <div class="chat-cont-right">
                                <div class="chat-header">
                                    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                        <i class="material-icons">chevron_left</i>
                                    </a>
                                    <div class="media">
                                        <div class="media-img-wrap">
                                            <div class="avatar avatar-online">
                                                <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="user-name">Richard Wilson</div>
                                            <div class="user-status">online</div>
                                        </div>
                                    </div>
                                    <div class="chat-options">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#voice_call">
                                            <i class="material-icons">local_phone</i>
                                        </a>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#video_call">
                                            <i class="material-icons">videocam</i>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                    </div>
                                </div>
                                <div class="chat-body">
                                    <div class="chat-scroll">
                                        <ul class="list-unstyled">
                                            <li class="media sent">
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>Hello. What can I do for you?</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:30 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media received">
                                                <div class="avatar">
                                                    <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>I'm just looking around.</p>
                                                            <p>Will you tell me something about yourself?</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:35 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>Are you there? That time!</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:40 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div>
                                                            <div class="chat-msg-attachments">
                                                                <div class="chat-attachment">
                                                                    <img src="../asset/img/img-02.jpg" alt="Attachment">
                                                                    <div class="chat-attach-caption">placeholder.jpg
                                                                    </div>
                                                                    <a href="#" class="chat-attach-download">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="chat-attachment">
                                                                    <img src="../asset/img/img-03.jpg" alt="Attachment">
                                                                    <div class="chat-attach-caption">placeholder.jpg
                                                                    </div>
                                                                    <a href="#" class="chat-attach-download">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:41 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media sent">
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>Where?</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:42 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:42 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div>
                                                            <div class="chat-msg-attachments">
                                                                <div class="chat-attachment">
                                                                    <img src="../asset/img/img-04.jpg" alt="Attachment">
                                                                    <div class="chat-attach-caption">placeholder.jpg
                                                                    </div>
                                                                    <a href="#" class="chat-attach-download">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:50 AM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media received">
                                                <div class="avatar">
                                                    <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>You wait for notice.</p>
                                                            <p>Consectetuorem ipsum dolor sit?</p>
                                                            <p>Ok?</p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>8:55 PM</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-date">Today</li>
                                            <li class="media received">
                                                <div class="avatar">
                                                    <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                            </p>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>10:17 AM</span>
                                                                    </div>
                                                                </li>
                                                                <li><a href="#">Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media sent">
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <p>Lorem ipsum dollar sit</p>
                                                            <div class="chat-msg-actions dropdown">
                                                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fe fe-elipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <ul class="chat-msg-info">
                                                                <li>
                                                                    <div class="chat-time">
                                                                        <span>10:19 AM</span>
                                                                    </div>
                                                                </li>
                                                                <li><a href="#">Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media received">
                                                <div class="avatar">
                                                    <img src="../asset/img/patients/patient.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                    <div class="msg-box">
                                                        <div>
                                                            <div class="msg-typing">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-footer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="btn-file btn">
                                                <i class="fa fa-paperclip"></i>
                                                <input type="file">
                                            </div>
                                        </div>
                                        {{-- <form> --}}
                                        <input type="text" class="input-msg-send form-control" placeholder="Type something">
                                        {{-- <input type="submit" value="submit"> --}}
                                    {{-- </form> --}}
                                        <div class="input-group-append">
                                            <button type="button" class="btn msg-send-btn"><i
											class="fab fa-telegram-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Chat Right -->

                        </div>
                    </div>
                </div>
                <!-- /Row -->

            </div>

        </div>
        <!-- /Page Content -->

        <!-- Footer -->
        {{-- <footer class="footer">

            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src="../asset/img/footer-logo.png" alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>





                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <p> 3556 Beech Street, San Francisco,<br> California, CA 94108 </p>
                                    </div>
                                    <p>
                                        <i class="fas fa-phone-alt"></i> +1 315 369 5943
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-envelope"></i> doccure@example.com
                                    </p>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- /Footer Top -->

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container-fluid">

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0"><a href="templateshub.net">Templates Hub</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="term-condition.html">Terms and Conditions</a></li>
                                        <li><a href="privacy-policy.html">Policy</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </div>
            <!-- /Footer Bottom -->

        </footer> --}}
        <!-- /Footer -->

        </div>
        <!-- /Main Wrapper -->

        <!-- Voice Call Modal -->
        <div class="modal fade call-modal" id="voice_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Outgoing Call -->
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img alt="User Image" src="../asset/img/patients/patient.jpg" class="call-avatar">
                                        <h4>Richard Wilson</h4>
                                        <span>Connecting...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="voice-call.html" class="btn call-item call-start"><i
									class="material-icons">call</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Outgoing Call -->

                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /Voice Call Modal -->


        <!-- jQuery -->
        <script src="../asset/js/jquery.min.js"></script>

        <!-- Bootstrap Core JS -->
        <script src="../asset/js/popper.min.js"></script>
        <script src="../asset/js/bootstrap.min.js"></script>

        <!-- Custom JS -->
        <script src="../asset/js/script.js"></script>
        <script src="../js/DoctorJS/script.js"></script>
</body>

</html>
