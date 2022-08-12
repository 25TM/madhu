@component('mail::message')
    
{{$emailContent}}
{{-- file --}}
@if($attachment)
    @component('mail::attachment', ['attachment' => $attachment])
        {{ $attachment->getClientOriginalName() }}
    @endcomponent
@else
    <p>No attachment</p>
@endif


this is a mail
@endcomponent
