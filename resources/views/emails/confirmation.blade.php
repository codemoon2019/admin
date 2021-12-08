@component('mail::message')
# Welcome to Pure Happilife PH!

You are successfully registered to pure PH. You can use this password to login your account in Pure PH.

<h1>{{ $email_data['password'] }}</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
