<!------ env منساش اعدادات البوشر في ملف ال  ------->
<!------  هشيل الكومنت من سطر البرودكاست سيرفس App.php منساش configاعدادات البوشر في ملف ال  ------->
<!-----   composer require pusher/pusher-php-server  ----->
<!-----   php artisan make:event NewNotification ----->

<div class="sidebar">
    <div class="logo-details">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" color="#333" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16">
            <path d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475Z" />
            <path d="M.88 8C-2.427 1.68 4.41-2 7.823 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z" />
        </svg>
        <span class="logo_name" style="margin-top: 8px;">TeleMedicine</span>
    </div>
    <ul class="nav-links">
        <li>
            <a @class(['active'=>Request::is('HomeRelative')]) href="/HomeRelative">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Home</span>
            </a>
        </li>

        <li>
            <a @class(['active'=>Request::is('patient_profile_Relative')])href="/patient_profile_Relative">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Patient Profile</span>
            </a>
        </li>

        <li>
            <a @class(['active'=>Request::is('Doctor_profile_Relative')])href="/Doctor_profile_Relative">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Doctor Profile</span>
            </a>
        </li>

        <li>
            <a @class(['active'=>Request::is('add-patient-Relative')])href="/add-patient-Relative">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Add New Patient</span>
            </a>
        </li>
        <li>
            <a @class(['active'=>Request::is('show_RelativeRequestLab')])href="/show_RelativeRequestLab">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-heart-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Request Lab</span>
            </a>
        </li>
        <li>
            <a @class(['active'=>Request::is('RelativeLabResult')])href="/RelativeLabResult">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-heart-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Lab Result</span>
            </a>
        </li>
        <li>
            <a @class(['active'=>Request::is('show_patient_list_Relative')])href="/show_patient_list_Relative">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Show Patient List</span>
            </a>
        </li>

        <li>
            <a @class(['active'=>Request::is('settingsRelative')]) href="/settingsRelative">
                <i class='bx bx-cog'></i>
                <span class="links_name">Settings</span>
            </a>
        </li>

        <li>
            <a @class(['active'=>Request::is('logoutRelative')]) href="/logoutRelative">
                <i>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                    </div>
                </i>
                <span class="links_name">Log out</span>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            @foreach($relative_data as $relative)

            <span class="dashboard"> {{ $relative->name }}</span>
            @endforeach
        </div>

        <div class="notification">
            <a href="#">
                <div class="notBtn" href="#">
                    <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
                    <div class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                            <span class="notif-count"></span>
                        </a>
                    </div>
                    <svg style="margin-left:  50px; margin-top:-60px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                    </svg>
                    <div class="boxnot">
                        <div class="display">
                            <div class="cont">
                                <h4 style="margin-left: 10px;margin-top:5px">New Notifications</h4>

                                <div class="sec">
                                    <div class="collapse navbar-collapse">

                                        <ul class="nav navbar-nav">
                                            <li class="dropdown dropdown-notifications">

                                                <div class="dropdown-container">
                                                    <div class="dropdown-toolbar">
                                                        @if($MRN_abnormalCase->isEmpty())
                                                        <div class="dropdown-toolbar-actions">
                                                            No New Notifications!
                                                        </div>
                                                        @endif
                                                        
                                                    </div>
                                                    <ul class="dropdown-menu">
                                                    </ul>
                                                    <div class="dropdown-footer text-center">
                                                    </div>
                                                </div>

                                            </li>

                                        </ul>

                                    </div>

                                </div>


                                <h4 style="margin-left: 10px;margin-top:5px">Old Notifications</h4>

                                @foreach($notification as $notification)
                                <div class="sec new">

                                    <div class="collapse navbar-collapse">

                                        <ul class="nav navbar-nav">
                                            <li class="dropdown dropdown-notifications">

                                                <div class="dropdown-container">
                                                    <a style="color:blue;">
                                                        <div class="media-body">

                                                            <p class="notification-text font-large-2 text-muted text-right" style="color:darkslategray;font-weight:bold;"> {{$notification->data}}

                                                        </div>

                                                        <a href="{{ route('notifications.delete',$notification->notification_id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{$notification->notification_id}}').submit();">

                                                            <button class="btn-notify" type="submit" class='centerMe' onclick="event.preventDefault();document.getElementById('delete-form-{{$notification->notification_id}}').submit();">
                                                                <span class="span-notify">DELETE</span>
                                                                <svg class="svgnotify" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                            <form id="delete-form-{{$notification->notification_id}}" + action="{{route('notifications.delete', $notification->notification_id)}}" method="post">
                                                                @csrf @method('DELETE')
                                                            </form>
                                                            <style>
                                                                .btn-notify {
                                                                    position: relative;
                                                                    margin-top: 5%;
                                                                    margin-bottom: 3%;
                                                                    margin-left: 5%;
                                                                    width: 40px;
                                                                    height: 40px;
                                                                    border-radius: 25px;
                                                                    border: 2px solid rgb(231, 50, 50);
                                                                    background-color: #fff;
                                                                    cursor: pointer;
                                                                    box-shadow: 0 0 10px #333;
                                                                    overflow: hidden;
                                                                    transition: .3s;
                                                                }

                                                                .btn-notify:hover {
                                                                    background-color: rgb(245, 207, 207);
                                                                    transform: scale(1.2);
                                                                    box-shadow: 0 0 4px #111;
                                                                    transition: .3s;
                                                                }

                                                                .svgnotify {
                                                                    color: rgb(231, 50, 50);
                                                                    position: absolute;
                                                                    top: 50%;
                                                                    left: 50%;
                                                                    transform: translate(-50%, -50%);
                                                                    transition: .3s;
                                                                }

                                                                .btn-notify:focus .svgnotify {
                                                                    opacity: 0;
                                                                    transition: .3s;
                                                                }

                                                                .span-notify {
                                                                    width: 130px;
                                                                    position: relative;
                                                                    margin-top: 10%;
                                                                    margin-left: 50%;
                                                                    opacity: 0;
                                                                    transform: translate(-50%, -50%);
                                                                    color: rgb(231, 50, 50);
                                                                    font-weight: 600;
                                                                    transition: .3s;
                                                                }

                                                                .btn-notify:focus {
                                                                    width: 130px;
                                                                    height: 30px;
                                                                    transition: .3s;
                                                                }

                                                                .btn-notify:focus .span-notify {
                                                                    opacity: 1;
                                                                    transition: .3s;
                                                                }
                                                            </style>
                                                        </a>

                                                </div>

                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        </div>
        <div class="wrapper">

            <div class="navbar">
                <div class="nav_right">
                    <ul class="nolist">
                        <li class="nr_li dd_main">
                            @foreach($relative_data as $relative)
                            <img class="setting-img" src="{{asset('relative_image/'. $relative->relative_img)}}">
                            @endforeach

                            <div class="dd_menu">

                                <div class="dd_right">
                                    <ul class="nolist">

                                        <li>
                                            <a href="/settingsRelative">
                                                <i class='bx bx-cog'></i>
                                                <span class="links_name">Settings</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="/logoutRelative">
                                                <i class='bx bx-log-out'></i>
                                                <span class="links_name">Log out</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                    </ul>
                </div>

            </div>
        </div>

    </nav>

    <script src="{{asset('js/ApexChart.js')}}"></script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('8007b724a7c01004ad11', {
            encrypted: false

        });
    </script>
    <script src="{{asset('js/pusherNotifications.js')}}"></script>

    <script>
        var dd_main = document.querySelector(".dd_main");

        dd_main.addEventListener("click", function() {
            this.classList.toggle("active");
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>