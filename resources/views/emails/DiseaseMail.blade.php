<x-mail::message>
Hello!

You are receiving this email because we received adding disease request from user in your system in {{$date}} .<br><br><hr><br>
Requested Disease:<b> {{$disease}} </b> ,<br>
Patient Name: <b>{{$Name}} </b> ,<br>
MRN: <b> {{$MRN}}  </b>     ,<br>
Email: {{$Email}} <br><br><hr>
<x-mail::button :url="'http://127.0.0.1:8000/DiseaseApproval'" color="success">
Approval
</x-mail::button>

<x-mail::button :url="'http://127.0.0.1:8000/DiseaseDecline'" color="error">
Decline
</x-mail::button> 


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
