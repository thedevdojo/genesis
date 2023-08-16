<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function __invoke(string $id, string $hash): RedirectResponse
    {
        if (! hash_equals((string) $id, (string) Auth::user()->getKey())) {
            throw new AuthorizationException();
        }

        if (! hash_equals((string) $hash, sha1(Auth::user()->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        if (Auth::user()->markEmailAsVerified()) {
            event(new Verified(Auth::user()));
        }

        return redirect()->route('home');
    }
}
