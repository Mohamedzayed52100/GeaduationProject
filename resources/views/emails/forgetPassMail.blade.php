<x-mail::message>
Hello!

You are receiving this email because we received a password reset request for your account in {{$date}} .

<x-mail::button :url="$link" color="success">
Reset Password
</x-mail::button>

This password reset link will expire in 60 minutes.<br>
If you did not request a password reset, no further action is required.<br><br>

Thanks,<br>
{{ config('app.name') }}


</x-mail::message>



