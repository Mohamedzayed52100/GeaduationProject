@extends('lab_pages.Lab-main-template')


<!--Website Title-->
@section('title')
Al-Mokhtaber - Chat Messages
@endsection

<!--Page Title-->
@section('pageTitle')
Chat
@endsection

<!--Website CSS-->
@section('css')
@parent
<link rel="stylesheet" href="/Lab_css/LabChat.css">
@endsection

 
<!--Main Section-->
@section('MainSection')
    <div class="page-wrapper">
        <div class="headerpage">
            <img src="/Lab_images/patient.jpg" alt="Patient Photo">
            <h4>Mostafa Ahmed</h4>
        </div>
        <aside>
            <header>
                <h2>Patients List</h2>
            </header>
            <ul>
                <li>
                    <img src="/Lab_images/patient.jpg" alt="Patient Photo">
                    <div>
                        <h2>Mostafa Ahmed</h2>
                        <h3>
                            <span class="status orange"></span> Not Registered
                        </h3>
                    </div>
                </li>
                <li>
                    <img src="/Lab_images/patient.jpg" alt="Patient Photo">
                    <div>
                        <h2>Mostafa Ahmed</h2>
                        <h3>
                            <span class="status green"></span> Registered
                        </h3>
                    </div>
                </li>
            </ul>
        </aside>

        <article>

            <div class="container darker">
                <img src="/Lab_images/lablogo.jpg" alt="Avatar" class="right" style="width:100%;">
                <p>Hello, sir! Can you give us more details about your address?</p>
                <span class="time-left">11:01</span>
            </div>

            <div class="container">
                <img src="/Lab_images/patient.jpg" alt="Avatar" style="width:100%;">
                <p>Of course , The Address is Benha Egypt.</p>
                <span class="time-right">11:02</span>
            </div>

            <div class="container darker">
                <img src="/Lab_images/lablogo.jpg" alt="Avatar" class="right" style="width:100%;">
                <p>Thank you!</p>
                <span class="time-left">11:05</span>
            </div>

            <div class="container darker">
                <img src="/Lab_images/lablogo.jpg" alt="Avatar" class="right" style="width:100%;">
                <p>Your appointment has been successfully booked.</p>
                <span class="time-left">11:08</span>
            </div>
            <div class="container">
                <img src="/Lab_images/patient.jpg" alt="Avatar" style="width:100%;">
                <p>Okay, Thank you.</p>
                <span class="time-right">11:10</span>
            </div>



        </article>
        <footer>
            <textarea placeholder="Type your message"></textarea>
            <button type="button" class="send"><i class="fa fa-paper-plane fa-2x" style="color: #fff;"></i></button>
        </footer>
    </div>
@endsection