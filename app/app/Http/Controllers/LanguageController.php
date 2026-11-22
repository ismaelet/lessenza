<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, ['it', 'en'], true), 404);
        $returnTo = $request->input('return_to', '/');
        abort_unless(is_string($returnTo) && Str::startsWith($returnTo, '/') && ! Str::startsWith($returnTo, '//') && ! Str::contains($returnTo, ['\\', "\r", "\n"]), 422);
        $request->session()->put('locale', $locale);

        return redirect()->to($returnTo);
    }
}
