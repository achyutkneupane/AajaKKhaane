<x-mail::message>
# Hello {{ $name }}

Your account has been created in **Aaja K Khaane?**.

Details:

- Email: **{{ $email }}**
- Password: **{{ $password }}**

<x-mail::button :url="route('login')">
Login
</x-mail::button>

Thanks,<br />
{{ config('app.name') }}
</x-mail::message>
