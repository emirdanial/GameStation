@component('mail::message')

Thank you. We'll get back to you!

@component('mail::button', ['url' => ''])
Enter
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
