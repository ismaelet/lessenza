<?php

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

test('contact messages use the environment notification recipients', function (string $environment, string $recipient) {
    config(['app.env' => $environment]);
    config(['custom' => require config_path('custom.php')]);
    config(['app.env' => 'testing']);
    Mail::fake();

    $this->withSession(['_token' => 'contact-test-token'])->from('/contacts')->post(route('contacts.store'), [
        '_token' => 'contact-test-token',
        'name' => 'Test Contact',
        'email' => 'visitor@example.com',
        'text' => 'A test contact message.',
    ])->assertRedirect('/contacts')->assertSessionHas('success');

    Mail::assertSent(ContactMail::class, fn (ContactMail $mail) =>
        $mail->hasTo($recipient) && count($mail->to) === 1
    );
    Mail::assertSentCount(1);
})->with([
    'development' => ['local', 'ismaele.tuffanelli@gmail.com'],
    'production' => ['production', 'commerciale@lessenza.net'],
]);
