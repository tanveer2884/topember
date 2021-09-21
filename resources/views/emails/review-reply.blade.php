@component('mail::message')
# Response To Your Review {{ $review->title }}

Hi {{ $review->name }},

{{ $reviewMessage }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
