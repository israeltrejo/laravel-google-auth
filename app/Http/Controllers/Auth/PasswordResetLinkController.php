<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function performStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status;
    }

    public function store(Request $request): RedirectResponse
    {
        $status = $this->performStore($request);

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->with('status', __(Password::RESET_LINK_SENT));
    }

    public function restore(Request $request): RedirectResponse
    {
        $status = $this->performStore($request);

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __('restore-password'))
            : back()->withErrors(['email' => __($status)]);
    }
}
