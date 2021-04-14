@component('mail::message')
# Halo {{ $user['name'] }}
klik link berikut untuk verifikasi email
<a href="{{ route('client.verifikasi.email', [$user['email'], $token]) }}">Verifikasi</a>


Terima kasih,<br>
{{ config('app.name') }}
@endcomponent