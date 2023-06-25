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
        <div class="box" style="margin-top:-15px; margin-left:10%;width: 80%; height: 100%;">
            <div class="setting-wrapper" style="background-image: linear-gradient(#70e1f5, #f3bf7a);">
                @error('image')<p class="erroralert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>{{ $message }}</p>@enderror
                <h4 class="pb-4 border-bottom">Account settings</h4>
                <form method="POST" action="/settingsRelative" class="flex-column-centered" enctype="multipart/form-data">
                    @csrf
                    <div class="setting-h4">
                        <div class="setting-wrapper" id="img-section">
                            <b>Profile Photo</b>
                            @foreach($relative_img as $relative)
                            <img class="setting-img1" src="{{ asset('relative_image/'. $relative->relative_img) }}" />
                            @endforeach
                            <p style="margin-bottom: 15px;">Accepted file type .png .jpg .jpeg</p>
                            <div class="upload-btn-wrapper">
                                <input type="file" name="image" accept=".jpg,.jpeg,.png">
                                <button class="upload-btn" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>

                    <div class="setting-wrapper">
                        <div class="setting-h4">
                            <div class="col-md-6">
                                <label for="name">Username </label>
                                @foreach($relative_data as $relative)
                                @error('username')<p class="erroralert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>{{ $message }}</p>@enderror
                                <input class="setting-form-control" type="text" name="username" id="username" value="{{$relative->name}}">
                                @endforeach
                            </div>
                            <div class="col-md-6 pt-md-0 pt-3">
                                @foreach($relative_data as $relative)
                                <label for="phone">Phone Number</label>
                                @error('phone')<p class="erroralert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>{{ $message }}</p>@enderror
                                <input class="setting-form-control" type="tel" name="phone" id="phone" value="{{$relative->phone}}">
                                @endforeach
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="col-md-6 pt-md-0 pt-3">
                                @foreach($relative_data as $relative)
                                <label for="city">City</label>
                                @error('city')<p class="erroralert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>{{ $message }}</p>@enderror
                                <input class="setting-form-control" type="text" name="city" id="city" value="{{$relative->city}}">
                                @endforeach
                            </div>
                            <div class="col-md-6 pt-md-0 pt-3">
                                @foreach($relative_data as $relative)
                                <label for="country">Country</label>
                                @error('country')<p class="erroralert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>{{ $message }}</p>@enderror
                                <input class="setting-form-control" type="text" name="country" id="country" value="{{$relative->country}}">
                                @endforeach
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mr-3" style="margin-left: 125px;">Save Changes</button>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection