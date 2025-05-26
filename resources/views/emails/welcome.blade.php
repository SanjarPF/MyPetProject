@component('mail::message')
    # Welcome, {{ $user->name }}!

    Thank you for registering at {{ config('app.name') }}.

    We’re glad to have you on board!

    Thanks,
    {{ config('app.name') }} Team
@endcomponent
