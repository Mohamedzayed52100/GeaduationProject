@extends('relative_pages.main_template_relative')
@section('main')
<style>
    .buttonView{
            border: none;
            color: var(--blue);
            padding: 2px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-style: bold;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
</style>
<div class="home-content">
    @if(session('success'))<div class="success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success! </strong>{{ session('success') }}
    </div>@endif

    <div class="overview-boxes">
        <div class="box" style="margin-top:-15px;width: 100%; height: 100%;">
            <div class="setting-wrapper" style="background-image: linear-gradient(#70e1f5, #f3bf7a);">
                <h4 class="card-title">Lab Results For All Patients That You Follow-Up</h4>

                <div class="page-content page-container" id="page-content">
                    <div class="padding" >
                        <div class="row" >
                            <div class="col-sm-6"  >
                                <div class="list list-row block"  style="width:800px;">
                                @if (count($Lab_result)>0)
                                    <div class="formbold-form-input">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0" >
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">Patient Name</th>
                                                        <th style="text-align:center;">Test Name</th>
                                                        <th style="text-align:center;">Test File</th>
                                                        <th style="text-align:center;">Upload Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Lab_result as $key=>$test)
                                                        <tr>
                                                        <td style="width:200px; text-align:center;">{{$test->name}}</td> 
                                                            <td style="width:350px; text-align:center;">{{$test->test_name}}</td> 
                                                            <td style="text-align:center; width:110px;"> 
                                                                <a href="{{ url('/viewImage',['file' => $test->image_name] ) }}" target="_blank"><button type="button" class="buttonView">View</button></a>
                                                            </td> 
                                                            <td>
                                                                <!--convert date which is return in string format into date format-->
                                                                @php
                                                                $appointmentDate = new DateTime( $test->upload_date);
                                                                @endphp
                                                                {{$appointmentDate->format('Y-m-d')}}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div style="margin-left:220px;">
                                                @if($Lab_result instanceof \Illuminate\Pagination\AbstractPaginator )
                                                    {{ $Lab_result->links('relative_pages.Relative_pagination') }} 
                                                @endif  
                                            </div>
                                            @else
                                                <p style="text-align:center; font-size:30px;">No Tests Available</p>
                                            @endif     
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection