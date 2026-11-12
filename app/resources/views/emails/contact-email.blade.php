<x-layouts.email>
    <h2>Contatto tramite formulario</h2>

    <br />

    <p>Hai ricevuto una richiesta di informazioni da parte di <strong>{{ $name }}</strong> (<a href="mailto:{{ $email }}">{{ $email }}</a>) con la seguente domanda:<br><br>"{!! nl2br(e($text)) !!}"</p>
</x-layouts.email>
