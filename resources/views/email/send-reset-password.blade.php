@component('mail::message')
# Halo {{ $user->fullname_client }}
klik link berikut untuk reset password
<a href="{{ route('client.password.reset', [$user->email_client, $token]) }}">Reset Password</a>


Terima kasih,<br>
{{ config('app.name') }}
@endcomponent