<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
  body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
    font-family: Arial, Helvetica, sans-serif;

  }

  h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 30px;
    margin-top: 10%;

  }

  input[type=password] {
    width: 50%;
    padding: 12px 10px;
    margin: 4px 0;
    box-sizing: border-box;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
    margin-bottom: 40px;

  }

  i {
    color: #54a754;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
    width: 700px;
    height: 400px;
  }


  /* Set a style for all buttons */
  button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin-left: 10px;
    border: none;
    cursor: pointer;
    width: 15%;
  }

  button:hover {
    opacity: 0.8;
  }

  /* Center the image and position the close button */
  .imgcontainer {
    text-align: center;
    margin: 20px 0 14px 0;
    position: relative;
  }

  /* Extra styles for the cancel button */
  .cancelbtn {
    width: 15%;
    padding: 14px 20px;
    margin-left: 90px;
    background-color: #f44336;
  }

  .container {
    padding: 45px;

  }

  span.psw {
    float: right;
    padding-top: 16px;
  }

  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
    padding-top: 60px;
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 55%;
    height: 55%;
    /* Could be more or less, depending on screen size */
  }

  /* The Close Button (x) */
  .close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: red;
    cursor: pointer;
  }

  /* Add Zoom Animation */
  .animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
  }

  @-webkit-keyframes animatezoom {
    from {
      -webkit-transform: scale(0)
    }

    to {
      -webkit-transform: scale(1)
    }
  }

  @keyframes animatezoom {
    from {
      transform: scale(0)
    }

    to {
      transform: scale(1)
    }
  }

  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
    span.psw {
      display: block;
      float: none;
    }

    .cancelbtn {
      width: 100%;
    }
  }

  .alert {
    padding: 20px;
    background-color: #00cc00;
    color: white;
    width: 50%;
    margin-left: 24%;
    margin-bottom: 1%;
  }

  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 25px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  .closebtn:hover {
    color: black;
  }


  .erroralert {
    padding: 13px;
    background-color: #f8594d;
    color: white;
    font-size: 1rem;
    margin-bottom: 10px;
    width: 50%;
    margin-left: 24%;
  }


</style>

<body>
  @if(session('success'))<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Success! </strong>{{ session('success') }}
  </div>@endif
  @if(session('error'))<div class="erroralert">
    {{ session('error') }}
  </div>@endif
  @error('MRN')<p class="erroralert">MRN field is required </p>@enderror


  <div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #e7eedd; margin:-30px auto;">
      <i class="checkmark">^<strong> ِِ</strong>^</i>
    </div>
    <h1>Welcome!</h1>
    <p>Please click this button to confirm the Approval</p>
    <button onclick="document.getElementById('id01').style.display='block'" style="margin-right:10px;font-size:medium;width:auto;"><strong>Confirm Approval</strong> </button>
  </div>
  <div id="id01" class="modal">
    <form method="post" action="/approval_form_after_mail" class="modal-content animate">
      @csrf

      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">&times;</span>

      </div>
      <label for="uname"><b>Are you sure! you want to Approve the mentioned person in the email!</b></label>

      <div class="container">
        <div class="container" style="background-color:#f1f1f1">
          <p><label for="fname">Please Enter Your MRN</label></p>
          <input type="password" id="MRN" name="MRN" placeholder="Your MRN.."><br><br>

          <button type="submit"><strong>Approve</strong></button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn"><strong>Cancel</strong></button>
        </div>

      </div>
    </form>
  </div>


  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>