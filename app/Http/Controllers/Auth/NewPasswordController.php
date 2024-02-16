<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\PasswordResetToken;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request, $token)
    {
        $decodedToken = base64_decode($token);
        $reset = PasswordResetToken::firstWhere('token', $decodedToken);
        if (!$reset)
        {
            return redirect()->route('login');
        }
        return view('auth.reset-password', ['request' => $request, 'token' => $decodedToken]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->only('email');
        $token = $request->only('token');

        $reset = PasswordResetToken::where('token', $token)
                ->where('email', $email)->first();

        if(!$reset)
        {
            return back()->withInput($email)
                ->withErrors(['email' => __('passwords.token')]);
        }

        $user = User::firstWhere('email', $email);
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
            'google_id' => null,
        ])->save();

        event(new PasswordReset($user));

        $reset->delete();

        return redirect()->route('login')->with('status', __('passwords.reset'));
    }
}
