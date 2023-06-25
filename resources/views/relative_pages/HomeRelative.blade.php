@extends('relative_pages.main_template_relative')

@section('main')

<div class="home-content">
    @if(session('success'))<div class="success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success! </strong>{{ session('success') }}
    </div>@endif

    <div class="overview-boxes">

        @foreach($vitalSign_data_today as $vitalSignToday)
        @if($vitalSignToday->systolic !=null)
        <div class="box" style="margin-left: 60px;">
            <div class="right-side">
                <div class="box-topic">Blood Pressure</div>
                <div class="number"><br>{{ $vitalSignToday->systolic }}/{{ $vitalSignToday->diastolic }} mmH</div><br>
                @foreach($vitalSign_data_yesterday as $vitalSignYesterday)
                <div class="indicator">
                    @if($vitalSignToday->systolic > $vitalSignYesterday->systolic || $vitalSignToday->diastolic > $vitalSignYesterday->diastolic)
                    @if ($vitalSignToday->systolic <= 120 && $vitalSignToday->diastolic <= 80 ) <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="Green" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                            </svg>
                            <span class="text"><strong style="margin-left: 10px;"> Better than yesterday</strong></span>

                            @elseif ($vitalSignToday->systolic > 120 && $vitalSignToday->diastolic > 80 )
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="brown" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                            </svg>
                            <span class="text"><strong style="margin-left: 10px;font-size: 14px;"> Worse than yesterday </strong></span>
                            @endif
                            @elseif($vitalSignToday->systolic < $vitalSignYesterday->systolic || $vitalSignToday->diastolic > $vitalSignYesterday->diastolic )
                                @if ($vitalSignToday->systolic <= 120 && $vitalSignToday->diastolic <= 80 ) <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="Green" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                                        </svg>
                                        <span class="text"><strong style="margin-left: 10px;"> Better than yesterday</strong></span>
                                        @elseif ($vitalSignToday->systolic > 120 && $vitalSignToday->diastolic > 80 )

                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="brown" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                                        </svg>
                                        <span class="text"><strong style="margin-left: 10px;"> Worse than yesterday </strong></span>
                                        @endif
                                        @else
                                        <div class="indicator">
                                            <i class="bx bx-left-arrow-alt equal"></i>
                                            <span class="text"><strong>Same As yesterday</strong></span>
                                        </div>

                                        @endif
                </div>
                @endforeach
            </div>
            <i class='bx cart ' style="background-color: transparent;">
                <svg viewBox="0 0 340 340" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <linearGradient gradientUnits="userSpaceOnUse" id="a" x1="135.257" x2="135.257" y1="114.919" y2="320.002">
                            <stop offset="0" stop-color="#e6714a" class="stop-color-ff6185"></stop>
                            <stop offset="1" stop-color="#69fae9" class="stop-color-e2407a"></stop>
                        </linearGradient>
                        <linearGradient id="b" x1="288.542" x2="288.542" xlink:href="#a" y1="194.81" y2="325.098">
                        </linearGradient>
                    </defs>
                    <path d="M220.453 118.782a59.991 59.991 0 0 0-12.2-4.67c-29.895-7.765-64.062 8.93-72.992 33-8.929-24.072-43.1-40.767-72.991-33a59.991 59.991 0 0 0-12.2 4.67c-42.963 21.931-47.403 81.824-8.8 110.736a104.224 104.224 0 0 0 10.513 6.894c56.66 32.614 83.474 67.556 83.474 67.556s26.815-34.942 83.475-67.556a104.224 104.224 0 0 0 10.513-6.894c38.602-28.912 34.163-88.805-8.792-110.736Z" fill="url(#a)" class="fillurl(-a)"></path>
                    <circle cx="266.546" cy="95.279" r="58.576" fill="#40e6ff" class="fill-ffffff"></circle>
                    <circle cx="266.546" cy="95.279" r="10.302" fill="#464965" class="fill-464965"></circle>
                    <circle cx="214.609" cy="202.873" r="3.717" fill="#40e6ff" class="fill-ffffff"></circle>
                    <path d="M134.043 229.958q-.508 0-1.025-.041a11.927 11.927 0 0 1-10.9-9.488l-8.071-36.6a5.141 5.141 0 0 0-9.446-1.507l-9.866 16.7A16.3 16.3 0 0 1 80.751 207H57.245a3.5 3.5 0 1 1 0-7h23.506a9.275 9.275 0 0 0 7.955-4.54l9.866-16.7a12.141 12.141 0 0 1 22.309 3.561l8.071 36.6a5.141 5.141 0 0 0 9.805.773l8.376-21.314a11.949 11.949 0 0 1 20.88-2.525 9.254 9.254 0 0 0 7.545 3.907h19.818a3.5 3.5 0 1 1 0 7h-19.818a16.259 16.259 0 0 1-13.262-6.868 4.949 4.949 0 0 0-8.648 1.047l-8.377 21.313a11.9 11.9 0 0 1-11.228 7.704Z" fill="#40e6ff" class="fill-ffffff"></path>
                    <path d="M310.27 237.889a342.928 342.928 0 0 1-17.589-51.366 4.272 4.272 0 0 0-8.278 0 342.834 342.834 0 0 1-17.59 51.366s-12.2 26.409-3.677 42.455q.129.242.26.479c10.921 19.778 39.371 19.778 50.292 0 .087-.158.174-.318.259-.479 8.525-16.044-3.677-42.455-3.677-42.455Z" fill="url(#b)" class="fillurl(-b)"></path>
                    <ellipse cx="277.024" cy="266.532" rx="7.682" ry="9.603" transform="rotate(-20.915 277.026 266.534)" fill="#40e6ff" class="fill-ffffff">
                    </ellipse>
                    <path d="M266.546 33.2a62.075 62.075 0 0 0-18.131 121.444c3.8 7.194 3.6 17.172 3.6 17.273v.307a62.348 62.348 0 0 1-24.873 53.82 100.845 100.845 0 0 1-10.16 6.662c-47.06 27.088-73.5 55.444-81.729 65.076-8.224-9.632-34.668-37.988-81.729-65.076a100.963 100.963 0 0 1-10.16-6.662 62.172 62.172 0 0 1-24.755-55.421 60.877 60.877 0 0 1 33.039-49.4 56.777 56.777 0 0 1 11.494-4.4c27.4-7.119 60.205 7.579 68.83 30.832a3.5 3.5 0 0 0 6.563 0c6.568-17.705 30.9-32.027 54.332-32.027h.306a3.5 3.5 0 0 0 .017-7h-.313c-23.126 0-47.153 12.823-57.569 29.8-13.046-22.348-46.049-35.62-73.927-28.376A63.82 63.82 0 0 0 48.47 115a67.834 67.834 0 0 0-36.832 55.033 69.137 69.137 0 0 0 27.534 61.622 108.438 108.438 0 0 0 10.865 7.125c55.309 31.837 82.18 66.311 82.445 66.655a3.5 3.5 0 0 0 5.551 0c.265-.344 27.136-34.818 82.445-66.654a108.265 108.265 0 0 0 10.865-7.126 69.331 69.331 0 0 0 27.672-59.7 52.091 52.091 0 0 0-2.255-15.372A62.075 62.075 0 1 0 266.546 33.2Zm0 117.152a55.076 55.076 0 1 1 55.077-55.076 55.138 55.138 0 0 1-55.077 55.079Z" fill="#464965" class="fill-464965"></path>
                    <path d="m286.71 60.112 2.532-5.461a3.5 3.5 0 1 0-6.35-2.945l-13.91 30a13.794 13.794 0 1 0 6.353 2.94l8.421-18.162a33.862 33.862 0 0 1 14.55 17.209 3.5 3.5 0 0 0 6.542-2.49 40.824 40.824 0 0 0-18.138-21.091Zm-13.361 35.167a6.8 6.8 0 1 1-7.525-6.763l-.157.339a3.5 3.5 0 1 0 6.351 2.945l.156-.337a6.76 6.76 0 0 1 1.175 3.816ZM268.632 61.863a3.5 3.5 0 1 0 .42-6.988 42.243 42.243 0 0 0-2.516-.076 40.934 40.934 0 0 0-38.887 28.009 3.5 3.5 0 1 0 6.641 2.215A33.942 33.942 0 0 1 266.536 61.8c.695 0 1.401.021 2.096.063ZM296.071 185.651a7.678 7.678 0 0 0-7.529-5.842 7.679 7.679 0 0 0-7.529 5.842 340.7 340.7 0 0 1-17.377 50.77c-.528 1.143-12.823 28.186-3.592 45.562.1.18.191.356.288.531a32.229 32.229 0 0 0 56.419 0c.1-.178.2-.357.287-.529 9.156-17.236-2.86-43.974-3.575-45.531a340.883 340.883 0 0 1-17.392-50.803Zm14.78 93.06-.227.42a25.23 25.23 0 0 1-44.165 0l-.232-.429c-7.6-14.307 3.65-39.1 3.792-39.407a348.036 348.036 0 0 0 17.773-51.9.773.773 0 0 1 1.5 0 347.766 347.766 0 0 0 17.773 51.9l.028.063c.115.247 11.385 24.998 3.758 39.353Z" fill="#464965" class="fill-464965"></path>
                </svg>
            </i>

        </div>
        @endif
        @endforeach

        @foreach($vitalSign_data_today as $vitalSignToday)
        @if($vitalSignToday->glucose !=null)
        <div class="box" style="margin-right: 130px;">
            <div class="right-side">
                <div class="box-topic">Blood Glucose</div>
                <div class="number"><br>{{ $vitalSignToday->glucose }} mg/dL</div>

                @foreach($vitalSign_data_yesterday as $vitalSignYesterday)

                @if($vitalSignToday->glucose > $vitalSignYesterday->glucose)
                <div class="indicator">

                    @if (in_array($vitalSignToday->glucose, range(70, 200)))
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="Green" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                    </svg>
                    <span class="text"><strong style="margin-left: 10px;"> Better than yesterday</strong></span>
                    @elseif (!in_array($vitalSignToday->glucose, range(70, 200)))
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="brown" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                    </svg>
                    <span class="text"><strong style="margin-left: 10px;"> Worse than yesterday </strong></span>
                    @endif
                </div>
                @elseif($vitalSignToday->glucose < $vitalSignYesterday->glucose)
                    <div class="indicator">
                        @if (in_array($vitalSignToday->glucose, range(70, 200)))
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="Green" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                        </svg>
                        <span class="text"><strong style="margin-left: 10px;"> Better than yesterday</strong></span>
                        @elseif (!in_array($vitalSignToday->glucose, range(70, 200)))
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="brown" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                        </svg>
                        <span class="text"><strong style="margin-left: 10px;"> Worse than yesterday </strong></span>
                        @elseif (!in_array($vitalSignToday->glucose, range(70, 200)))
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="brown" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                        </svg>
                        <span class="text"><strong style="margin-left: 10px;"> Worse than yesterday </strong></span>
                        @endif
                    </div>
                    @else
                    <div class="indicator">
                        <i class="bx bx-left-arrow-alt equal"></i>
                        <span class="text"><strong>Same As yesterday</strong></span>
                    </div>

                    @endif
                    @endforeach
            </div>
            <i class='bx cart three' style="background-color: transparent;">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <g>
                                    <circle style="fill:#F86E51;" cx="148.5" cy="148.5" r="148.5" />
                                </g>
                            </g>
                        </g>
                        <path style="fill:#D14D37;" d="M205.655,59.941C172.917,97.978,140.613,142.459,143.5,192.5
		c1.571,20.425,6.152,50.034-4.571,69.536l33.102,33.102c69.95-11.138,123.611-71.117,124.934-143.887L205.655,59.941z" />
                        <g>
                            <g>
                                <path style="fill:#345065;" d="M148.5,223.75L148.5,223.75c37.003,0,67-29.997,67-67V82.547
				c0-17.167-13.916-31.083-31.083-31.083h-71.834C95.416,51.464,81.5,65.38,81.5,82.547v74.203
				C81.5,193.753,111.497,223.75,148.5,223.75z" />
                            </g>
                            <g>
                                <rect x="138.929" y="204.607" style="fill:#ECF0F1;" width="19.143" height="57.429" />
                            </g>
                            <g>
                                <path style="fill:#ECF0F1;" d="M117.127,147.179h62.746c3.818,0,6.913-3.095,6.913-6.913V77.52c0-3.818-3.095-6.913-6.913-6.913
				h-62.746c-3.818,0-6.913,3.095-6.913,6.913v62.746C110.214,144.084,113.309,147.179,117.127,147.179z" />
                            </g>
                            <g>
                                <g>
                                    <path style="fill:#AEC1CF;" d="M146.76,157.62h-27.747c-4.859,0-8.798,3.939-8.798,8.798c0,11.8,9.566,21.366,21.366,21.366
					h15.179V157.62z" />
                                </g>
                                <g>
                                    <path style="fill:#AEC1CF;" d="M177.988,157.62H150.24v30.165h15.179c11.8,0,21.366-9.566,21.366-21.366
					C186.786,161.559,182.847,157.62,177.988,157.62z" />
                                </g>
                            </g>
                        </g>
                        <g>
                            <path style="fill:#D35400;" d="M132,115.5c0-9.113,16.5-33,16.5-33s16.5,23.887,16.5,33s-7.387,16.5-16.5,16.5
			S132,124.613,132,115.5z" />
                        </g>
                    </g>
                </svg>
            </i>
        </div>
        @endif
        @endforeach

    </div>

    <div class="charts-boxes">

        <div class="line-charts box">
            <div class="title" style="margin-bottom: 80px;">Pie Chart Of Abnormal Measures Throug Past Month </div>
            <!-- Pie CHART BLOCK (LEFT-CONTAINER) -->


            {!! $piechart->container() !!}

            <script src="{{ $piechart->cdn() }}"></script>
            {!! $piechart->script() !!}

        </div>
        <!-- Pie CHART BLOCK (LEFT-CONTAINER) -->


        <div class="line-charts box">
            <!----انا في الشارتس دي بعد عدد المرات اللي القياسات كانت مش طبيعيه فيهم------>
            <div class="title" style="margin-bottom: 50px;">Line Chart Of Abnormal Measures Throug Current Vs Past Month</div>
            <!-- LINE CHART BLOCK (LEFT-CONTAINER) -->
            <!-- partial:index.partial.html -->

            {!! $linechart->container() !!}

            <script src="{{ $linechart->cdn() }}"></script>
            {!! $linechart->script() !!}
            <!-- LINE CHART BLOCK (LEFT-CONTAINER) -->
        </div>


    </div>

    <div class="charts-boxes">
        <div class="line-charts box" style="margin-left: 20px;width:100%;padding-left:350px">
            <div class="title" style="margin-left: -30px;margin-top: 20px;margin-bottom: 100px;">Bar Chart Of Abnormal
                Measures Throug Past Month</div>
            <!-- Bar CHART BLOCK -->

            {!! $barchart->container() !!}

            <script src="{{ $barchart->cdn() }}"></script>
            {!! $barchart->script() !!}
            <!-- Bar CHART BLOCK -->

        </div>
    </div>

</div>

@endsection