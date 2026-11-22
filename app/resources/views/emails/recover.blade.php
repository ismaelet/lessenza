<h2 style="text-align: center; padding-bottom: 32px; font-weight: 600;">{{ __('Recupero dati') }}</h2>
<p>
    {{ __('L’indirizzo email associato al tuo account, necessario per accedere, è:') }}<br>
    {{ $email }}.<br><br>
    {{ __('Per resettare la tua password puoi usare questo link:') }}<br>
    <a href="{{ $resetEndpoint }}">{{ $resetEndpoint }}</a>
</p>
