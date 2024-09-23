@php($welcomeHints = auth()->user()->getPendingWelcomeHints())

@if($welcomeHints)
    @foreach($welcomeHints as $welcomeHint)
        {!! $welcomeHint->html !!}
    @endforeach
@endif
