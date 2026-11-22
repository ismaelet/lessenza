<x-layouts.email>
    <h2>{{ __('Contatto tramite formulario') }}</h2>

    <br />

    <p>{{ __('Hai ricevuto una richiesta di informazioni da parte di') }} <strong>{{ $name }}</strong> (<a href="mailto:{{ $email }}">{{ $email }}</a>{{ __(') con la seguente domanda:') }}<br><br>"{!! nl2br(e($text)) !!}"</p>
</x-layouts.email>
