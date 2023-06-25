@extends('relative_pages.main_template_relative')
@section('main')
<div class="home-content">
    @if(session('success'))<div class="success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Awsoume! </strong>{{ session('success') }}
    </div>@endif
    @if(session('error'))<div class="erroralert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('error') }}
    </div>@endif
    <div class="overview-boxes">

        <div class="profile-card js-profile-card">
            <div class="profile-card__img">
            </div>
            <div class="profile-card__cnt js-profile-cnt">
                @foreach($patient_data as $patient)
                <img src="{{ asset('PatientImages/'. $patient->patient_image) }}" style="width: 140px; height: 140px;  margin-top: -90px; border-radius: 80px;" alt="profile">
                <div class="profile-card__name" style="margin-bottom:2%;margin-top:45px">
                    {{ $patient->name }}
                </div>
                @endforeach
                <div class="profile-card__txt">
                    Patient have @foreach($patient_disease as $patient)
                    {{ $patient->disease_name }},
                    @endforeach disease/s<strong>

                        <div class="profile-card-inf">

                            <div class="profile-card-inf__item" style="margin-left:2%">
                                <div class="profile-card-inf__title"><strong> Age </strong></div>
                                <div class="profile-card-inf__txt">
                                    @foreach($patient_data as $patient)
                                    @php
                                    $age = Carbon\Carbon::parse($patient->birth_of_date)->diff(Carbon\Carbon::now()->addMinutes(120))->format('%y years');
                                    @endphp
                                    {{$age}}
                                    @endforeach

                                </div>
                            </div>

                            <div class="profile-card-inf__item">
                                <div class="profile-card-inf__title"><strong> Phone </strong></div>
                                <div class="profile-card-inf__txt">
                                    @foreach($patient_data as $patient)
                                    {{ $patient->phone }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="profile-card-inf__item">
                                <div class="profile-card-inf__item">
                                    <div class="profile-card-inf__title"><strong> Current Location </strong></div>
                                    <div class="profile-card-inf__txt">
                                        @foreach($patient_data as $patient)
                                        {{ $patient->street }}, {{ $patient->city }}, {{ $patient->country }}
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="profile-card-ctr" style="margin-top: -10px;">
                <a href="/chatify/{{ \App\Models\User::where('email', $patient->email)->first()->id }}">
                        <button class="profile-card__button button--blue js-message-btn">Message</button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    @endsection