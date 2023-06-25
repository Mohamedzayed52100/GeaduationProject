@component('mail::message')
<h1> Hello!</h1>
<p>  You are receiving this email because Someone called <strong>{{$name}}</strong> want to be your relative with <strong>{{$relatively_degree}}</strong> relativity degree and want to Follow-up your medical case if you ok with that please click the button below to approve his/her request.</p>
<br>
<p>@component('mail::button', ['url' => 'http://127.0.0.1:8000/approval_form_after_mail'])
Approve {{$name}}
@endcomponent </p>
 
 
 
Thanks,<br>
{{ config('app.name') }}<br>

@endcomponent
