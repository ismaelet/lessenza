<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactsController extends Controller
{
    /**
     * Display the contacts page.
     */
    public function index(): View
    {
        return view('contacts', [
            'title' => 'Contatti',
            'location' => 'contacts',
        ]);
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text' => 'required|string|max:1000',
        ]);

        $name = trim($request->name);
        $clientEmail = trim($request->email);
        $mailText = trim($request->text);

        try {
            Mail::to(config('custom.notification_emails'))
                ->send(new ContactMail(
                    email: $clientEmail,
                    name: $name,
                    text: $mailText
                ));

            return redirect()->back()->with([
                'success' => 'Messaggio inviato, ti risponderemo al più presto',
                'meta_contact' => true,
            ]);
        } catch (TransportExceptionInterface $e) {
            return redirect()->back()->withInput()->withErrors([
                'spam' => '<span class="font-bold">Errore</span>: il messaggio non ha superato i nostri filtri anti-spam. Puoi comunque a scriverci direttamente a
							<a href="'.config('custom.contacts.email.url').'" class="font-bold">'.config('custom.contacts.email.label').'</a>, invece di usare questo formulario.',
            ]);
        }
    }
}
