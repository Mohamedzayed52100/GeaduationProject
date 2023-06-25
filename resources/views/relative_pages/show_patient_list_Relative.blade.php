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
                <h4 class="card-title">All Patients That You Follow-Up</h4>

                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="list list-row block">
                                    @foreach($patient_details as $patient)
                                    <div class="list-item" data-id="1">

                                        <div><a data-abc="true"><span class="w-48 avatar gd-primary"><img src="https://img.icons8.com/color/48/000000/administrator-male.png" alt="."></span></a></div>
                                        <div class="flex">
                                            <a class="item-author text-color" data-abc="true"></a>
                                            <tbody>
                                                <tr>

                                                    <td>{{ $patient->name }}</td>
                                                    <td><a href="{{ route('patients.delete',$patient->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{$patient->id}}').submit();">
                                                            <div class="no-wrap">
                                                                <button type="submit" class='centerMe' onclick="event.preventDefault();document.getElementById('delete-form-{{$patient->id}}').submit();">
                                                                    <div class='icon'>
                                                                        <i class='fa fa-trash-o'></i>
                                                                    </div>
                                                                    <div class='text'>
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </button>
                                                                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

                                                            </div>
                                                        </a>
                                                    </td>
                                                    <form id="delete-form-{{$patient->id}}" + action="{{route('patients.delete', $patient->id)}}" method="post">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                </tr>
                                            </tbody>

                                        </div>

                                    </div>

                                    @endforeach
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