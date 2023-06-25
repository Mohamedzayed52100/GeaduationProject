<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="/image/support.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Approval</title>
    <link rel="stylesheet" href="/RelativeCSS/style.css">
</head>

<body>
    <div class="login-div flex-column-centered">
        @if(session('success'))<div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Success! </strong>{{ session('success') }}
        </div>@endif
        <div class="login-comps">

            <h1 style="text-align: center;font-size: 1.6em;">Hello! Before we go complete these steps first</h1>
            <form method="post" action="/patient_Approval" class="flex-column-centered">
                @csrf
                @if(session('error'))<div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('error') }}
                </div>@endif
                <input type="password" name="MRN" id="MRN" placeholder="Enter Patient MRN" required>
                @error('MRN')<p class="error">You Have already requested to follow this patient</p>@enderror
                <select name="relativity_degree" style="height:auto;font: .9em sans-serif;margin: .8rem auto; margin-bottom: 4rem;color: white;" required value="{{ old('relativity_degree') }}">
                    <option value="" disabled selected hidden>Choose Relativity Degree </option>
                    <option style="background-color:#b7eaf3;color:black;" value="first">First Degree Relative</option>
                    <option style="background-color:#b7eaf3;color:black;" value="second">Second Degree Relative</option>
                    <option style="background-color:#b7eaf3;color:black;" value="other">Other</option>
                </select>
                <button type="submit">Take Approval</button>

            </form>
            <a href="/RegisterRelative"><button style="background: #b7eaf3;
                color: rgb(34, 22, 22);
                border-radius: 10px;
                margin: .1rem auto;
                margin-left: 34%;
                font-size: .9em;
                padding: 0.7rem;
                width: 180px;
                font-weight: bold;
                border: none;">Back</button></a>

        </div>
    </div>
</body>

</html>