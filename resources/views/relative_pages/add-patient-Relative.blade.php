@extends('relative_pages.main_template_relative')
@section('main')
<div class="home-content">
    @if(session('success'))<div class="success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success! </strong>{{ session('success') }}
    </div>@endif

    <div class="overview-boxes">

        <div class="box" style="margin-top:-15px; margin-left:10%;width: 80%; height: 100%;">

            <div class="setting-wrapper" style="background-image: linear-gradient(#70e1f5, #f3bf7a);">
                <h4 class="pb-4 border-bottom">Patient Information</h4>

                <form method="post" action="/add-patient-Relative" class="flex-column-centered">
                    @csrf
                    <div class="setting-wrapper">
                        <div class="setting-h4">
                            <div class="row py-2">

                                <div class="col-md-6 pt-md-0 pt-3">
                                    <label for="MRN">MRN</label>
                                    @if(session('error'))<div class="erroralert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        {{ session('error') }}
                                    </div>@endif
                                    @error('MRN')<p class="erroralert"> <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        You Have already requested to follow this patient</p>@enderror
                                    <input type="password" name="MRN" id="MRN" class="setting-form-control" placeholder="Enter Patient MRN" required style="margin-bottom: 20px;">

                                </div>

                                <div class="row py-2">
                                    <div class="col-md-6 pt-md-0 pt-3" id="lang">
                                        <label for="Relativity_degree">Relativity Degree</label>
                                        <div class="arrow" style="margin-bottom: 20px;">
                                            <select name="relativity_degree" id="relativity_degree" class="setting-select" required value="{{ old('Relativity_degree') }}">
                                                <option value="" disabled selected hidden>Choose Relativity
                                                    Degree </option>
                                                <option style="background-color:#b7eaf3;color:black;" value="first">First Degree Relative</option>
                                                <option style="background-color:#b7eaf3;color:black;" value="second">Second Degree Relative</option>
                                                <option style="background-color:#b7eaf3;color:black;" value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($flag) && $flag === 1)
                                <div class="alert alert-success">add record successful</div>
                                @endif
                                <button type="submit" class="btn btn-primary mr-3" style="margin-left: 140PX;">Take Approval</button>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection