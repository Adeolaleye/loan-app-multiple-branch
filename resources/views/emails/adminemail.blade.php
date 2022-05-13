@component('mail::message')
@if( $data['type'] == 'welcome')

<p>Dear {{ $data['name'] }},</p>
<p>Welcome to Agape team, below are few of your details,<br>
    <strong>Role : </strong>{{ $data['role'] }}<br>
    <strong>Email : </strong> {{ $data['email'] }}<br>
    <strong>Password : </strong>{{ $data['password'] }}</p><br>
    <p>Kindly log in <a href="https://account.agapeglobal.com.ng/" target="_blank">here</a> to update and edit your profile, and reset password.
        If you have any difficulty, contact info@agapeglobal.com.ng</p><br>
        <p>Regards,<br>
        {{ config('app.name') }} Team.</p>
@endif
@endcomponent
