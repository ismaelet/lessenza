<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\GenericMail;
use App\Models\User;
use App\Models\User\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoverController extends Controller
{
    /**
     * Render the recover page
     */
    public function index()
    {

        return view('auth.recover')
            ->with('location', 'recover')
            ->with('title', __('Recupero accesso'));
    }

    /**
     * Process the request
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Process the request
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            // Generate reset security code
            $passwordReset = PasswordResetToken::where('email', $user->email)->first();

            if ($passwordReset) {
                $token = $passwordReset->token;
            } else {
                $token = Str::random(64);

                PasswordResetToken::create(
                    [
                        'email' => $user->email,
                        'token' => $token,
                    ]
                );
            }

            // Generare the recovery endpoint
            $resetEndpoint = route('auth.reset', ['email' => $user->email, 'token' => $token]);

            // Generate the email
            $subject = __('Recupero dati di accesso');
            $content = view('emails.recover', compact('email', 'resetEndpoint'))->render();

            $mail = new GenericMail($subject, $content);

            // Send the email
            Mail::to($user)->send($mail);
        }

        return redirect()->route('auth.recover')
            ->with([
                'title' => __('Recupero accesso'),
                'submitted' => true,
                'email' => $email,
                'not_found' => ! $user,
            ]);
    }
}
