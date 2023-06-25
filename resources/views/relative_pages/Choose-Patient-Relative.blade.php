<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/image/support.png">
    <title>Choose Patient</title>
    <link rel="stylesheet" href="/RelativeCSS/style.css">
</head>

<body>

    <div class="login-div flex-column-centered">
        <div class="login-comps">
            <h1 style="padding-top: 2rem;font-size: 1.6em;">Hello! Choose The Patient You Want To Follow-Up From Here</h1>

            <form method="post" action="/Choose-Patient-Relative" class="flex-column-centered">
                @csrf
                @if(session('error'))<div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('error') }}
                </div>@endif

                <select name="patient_MRN" id="patient_MRN" style="height:auto;font: 1.2em sans-serif;color:black;margin: 2rem auto; margin-bottom: 6rem;" required value="{{ old('Choose-Patient') }}">
                    <option value="" disabled selected hidden>Choose Patient Name </option>

                    @foreach($patients as $patient)
                    <option style="color:black;" value="{{ $patient->MRN }}" {{$patient->MRN == $patient->MRN  ? 'selected' : ''}}>{{ $patient->name}}</option>
                    @endforeach


                </select>

                <button type="submit">Show Patient Case</button>


            </form>



        </div>
    </div>
</body>

</html>