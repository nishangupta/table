@component('mail::message')
# Our Quotation

Please checkout this the product quotation details below.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
