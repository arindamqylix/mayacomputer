{{-- Expects $certificate with sc_typing_speed_hindi, sc_typing_speed_english, sc_typing_speed (legacy), sc_typing_accuracy --}}
@php
    $h = isset($certificate->sc_typing_speed_hindi) ? (string) $certificate->sc_typing_speed_hindi : '';
    $e = isset($certificate->sc_typing_speed_english) ? (string) $certificate->sc_typing_speed_english : '';
    $legacy = $certificate->sc_typing_speed ?? null;
@endphp
@if($h !== '' || $e !== '')
    Having attained a typing speed of <b>Hindi: {{ $h }} WPM</b> and <b>English: {{ $e }} WPM</b>
    with an accuracy of <b>{{ $certificate->sc_typing_accuracy ?? '100' }}%</b>
@elseif($legacy)
    @if(preg_match('/Hindi\s*:/i', (string) $legacy) || preg_match('/English\s*:/i', (string) $legacy))
        Having attained typing performance: <b>{{ $legacy }}</b>
        with an accuracy of <b>{{ $certificate->sc_typing_accuracy ?? '100' }}%</b>
    @else
        Having attained a typing speed of <b>{{ $legacy }} WPM</b>
        with an accuracy of <b>{{ $certificate->sc_typing_accuracy ?? '100' }}%</b>
    @endif
@else
    Successfully completed the typing course from our authorised Study Centre
@endif
