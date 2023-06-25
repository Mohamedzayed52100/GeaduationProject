@extends('relative_pages.main_template_relative')
@section('main')
@foreach ($Doctor_data as $doctor)

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

        <div class="profile-card js-profile-card" style="margin-top: -10px;height:510px;margin-bottom:-10px">
            <div class="profile-card__img">
            </div>
            <div class="profile-card__cnt js-profile-cnt">

                <img src="{{ asset('DoctorImages/'. $doctor->doc_image) }}" style="width: 140px; height: 140px; margin-top: -90px; border-radius: 80px;" alt="profile">
                <div class="profile-card__name" style="margin-bottom:2%;margin-top:80px;">

                    Dr. {{ $doctor->name }}
                </div>
                <div class="profile-card__txt">
                    {{ $doctor->address }}
                    <strong>

                        <div class="profile-card-inf">
                            <div class="profile-card-inf__item">
                                <div class="profile-card-inf__title"><strong> Speciality </strong></div>
                                <div class="profile-card-inf__txt">
                                    {{ $doctor->speciality }}
                                </div>
                            </div>

                            <div class="profile-card-inf__item">
                                <div class="profile-card-inf__title"><strong> Exprience </strong></div>
                                <div class="profile-card-inf__txt">
                                    @php
                                    $exprience = Carbon\Carbon::parse($doctor->start_work)->diff(Carbon\Carbon::now()->addMinutes(120))->format('%y years');
                                    @endphp
                                    {{$exprience}}
                                </div>
                            </div>

                            <div class="profile-card-inf__item">
                                <div class="profile-card-inf__title"><strong> Phone </strong></div>
                                <div class="profile-card-inf__txt">
                                    {{ $doctor->phone }}
                                </div>
                            </div>
                        </div>
                </div>

                <div class="profile-card-ctr">
                    <a href="/chatify/{{ \App\Models\User::where('email', $doctor->email)->first()->id }}">
                        <button class="profile-card__button button--blue js-message-btn">Message</button>
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
<div style="margin-left:240px;">
    @if($paginator instanceof \Illuminate\Pagination\AbstractPaginator )
    {{ $paginator->links('relative_pages.Relative_pagination') }}
    @endif
</div>

@endforeach
@endsection