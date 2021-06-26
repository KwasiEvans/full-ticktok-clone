@component('mail::message')
# Two Step Authentication

Here is 4-digit Verification Code:
{{ $user->two_factor }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
