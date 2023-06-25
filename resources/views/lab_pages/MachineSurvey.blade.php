<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Tele-Medicine Survey</title>
    <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/surveyIcon.png">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="/Lab_css/MachineSurvey.css">
    
  </head>
  <body>
    <div class="testbox">
        <form action="/predict" method="POST">
        @csrf
        <h1>Heart Disease Survey</h1>
        <p>We use the data you enter for analysis by using certain artificial intelligence algorithms to predict whether you are likely to have heart disease. Make sure to read the questions accurately and choose the appropriate answer for your health condition.</p>
        
        @if(session('error'))
        <div class="alert" style="color:red; text-align:center; font-size:20px; margin-top:13px; background-color:#f5f5ef; height:35px;">
            <strong>Error!</strong> {{ session('error') }}
        </div>
        @endif
        <div style="margin-top:40px;">
            <label>Enter your name:</label>
            <input type="text" name="name" placeholder="  Write here .." class="name" required pattern="[a-zA-Z ]+" title="Names only contain characters"/>
        </div>
        <!--BMI-->
        <div>
            <h4 style="margin-bottom:30px;">Enter your Body Mass Index (BMI) value:<span>*</span><span style="color:grey;"> (Between 18.5 and 39.9) <img src="{{ asset('Lab_images/Survey.png') }}" style="width: 160px; height: 50px; margin-left:220px;" alt="BMI"></span></h4>
            <ul>
                <li>Blow 18.5 (Underweight)</li>
                <li>18.5 - 24.9 (Healthy Weight)</li>
                <li>25.0 - 29.9 (Overweight)</li>
                <li>30.0 - 39.9 (Obesity)</li>
            </ul>
            <input type="number" id="BMI" name="BMI" min="18.5" max="39.9" step="0.1" placeholder="  Write here .." class="BMI" required/>
        </div>
            <!--Smoking-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Do you smoke ?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 279px;"><input type="radio" value="Yes" name="smoke" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="smoke" required />No</label>
            </div>
        </div>
            <!--stroke-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Have you had a stroke?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 227px;"><input type="radio" value="Yes" name="stroke" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="stroke" required />No</label>
            </div>
        </div>
               <!--Physical Health
        <div>
            <h4>Enter your Physical Health value:<span>*</span><span style="color:grey;"> (Between 0 and 30)</span></h4>
            <input type="number" id="physical" name="physical" min="0" max="30" placeholder="  Write here .." class="physical" required/>
        </div>-->
            <!--Mental Health
         <div>
            <h4>Enter your Mental Health value:<span>*</span><span style="color:grey;"> (Between 0 and 30)</span></h4>
            <input type="number" id="mental" name="mental" min="0" max="30" placeholder="  Write here .." class="mental" required/>
        </div>-->
             <!--Walking-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Do you practice walking?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 215px;"><input type="radio" value="Yes" name="walk" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="walk" required />No</label>
            </div>
        </div>
            <!--Sex-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Choose your sex:<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 270px;"><input type="radio" value="Male" name="sex" required/>Male</label>
                <label style="margin-left: 140px;"><input type="radio" value="Female" name="sex" required/>Female</label>
            </div>
        </div>

        <!--Age-->
        <div>
            <h4>Choose the age group you belong to :<span>*</span></h4>
            <select name="age" required>
                <option value="1">18-24</option>
                <option value="2">25-29</option>
                <option value="3">30-34</option>
                <option value="4">35-39</option>
                <option value="5">40-44</option>
                <option value="6">45-49</option>
                <option value="7">50-54</option>
                <option value="8">55-59</option>
                <option value="9">60-64</option>
                <option value="10">65-69</option>
                <option value="11">70-74</option>
                <option value="12">75-79</option>
                <option value="13">80 or older</option>
            </select>
        </div>

        <!--Race-->
        <div>
            <h4>What race do you belong to?<span>*</span></h4>
            <select name="race" required>
                <option value="1">White</option>
                <option value="2">Black</option>
                <option value="3">Asian</option>
                <option value="4">Hispanic</option>
                <option value="5">American Indian /Alaskan Native</option>
                <option value="6">Other</option>
            </select>
        </div>

        

        <!--Diabetic-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Are you diabetic patient?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 216px;"><input type="radio" value="Yes" name="diabetic" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="diabetic" required />No</label>
            </div>
        </div>
            <!--Asthma-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Have you had an asthma attack?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 160px;"><input type="radio" value="Yes" name="asthma" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="asthma"  required/>No</label>
            </div>
        </div>
        <!--Kidney-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Have you had any kidney disease?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 150px;"><input type="radio" value="Yes" name="kidney" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="kidney"  required/>No</label>
            </div>
        </div>
        
    
        <!--Skin Cancer-->
        <div style="margin-top:30px">
            <h4 style="display:inline;">Did you get skin cancer?<span>*</span></h4>
            <div class="custom_question-answer">
                <label style="margin-left: 220px;"><input type="radio" value="Yes" name="cancer" required />Yes</label>
                <label style="margin-left: 150px;"><input type="radio" value="No" name="cancer" required/>No</label>
            </div>
        </div>


        <div class="btn-block">
            <input type="submit" name="submit" class="submit" value="submit">
        </div>
    </form>
    </div>
  </body>
</html>