@component('mail::message')
Ім'я: <b>{{ $name }}</b><br/>
Email: <b>{{ $email }}</b><br/>
Повідомлення:
    @component('mail::panel')
        {{ $message }}
    @endcomponent
@endcomponent
