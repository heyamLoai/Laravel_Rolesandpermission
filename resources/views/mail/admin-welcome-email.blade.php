@component('mail::message')
 # Welcom {{$name}},{{--AdminName --}}

we are happy to see you here

@component('mail::panel')
your account pawwrod is : {{$password}}.
@endcomponent

@component('mail::button', ['url' => ''])
Open CMS.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
