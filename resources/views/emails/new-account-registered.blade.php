@component('mail::message')

# Welcome to {{ config('app.name') }}

Thank you for signing up. Your account has been created successfully. <br>

If you are having any issues with your account, please don’t hesitate to contact us. <br>

Thanks! <br>
{{ config('app.name') }} <br>
{{ getGeneralSetting('store_contact_phone') }} <br>
{{ getGeneralSetting('store_contact_email') }} <br>
@endcomponent
