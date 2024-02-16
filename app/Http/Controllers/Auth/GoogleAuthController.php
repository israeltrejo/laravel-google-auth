<?php

namespace App\Http\Controllers\Auth;

use App\Lib\GoogleAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController
{
    public function authorize(Request $request)
    {
        $state = $request->state;
        $savedState = GoogleAuth::getSavedState();
        $isValidState = GoogleAuth::isValidState($state);
        if (!$isValidState)
        {
            return redirect($savedState->previous_url)->withErrors([
                'message' => 'Google authentication has an error, please try again.'
            ]);
        }

        $code = $request->code;
        $tokenResponse = GoogleAuth::getAccessToken($code);
        if (!isset($tokenResponse['id_token']))
        {
            return redirect($savedState->previous_url)->withErrors([
                'message' => 'Google authentication has an error, please try again.'
            ]);
        }

        $payload = GoogleAuth::decodeIdToken($tokenResponse['id_token']);

        if ($payload == null)
        {
            return redirect($savedState->previous_url)->withErrors([
                'message' => 'Google authentication has an error, please try again.'
            ]);
        }

        $user = $this->storeGoogleUser($payload);

        Auth::login($user);

        return redirect('profile');
    }

    public function storeGoogleUser($payload)
    {
        $googleId = $payload['sub'];
        $email = $payload['email'];
        $user = User::firstWhere('google_id', $googleId);

        if ($user)
        {
            return $user;
        }

        $user = User::firstWhere('email', $email);

        if ($user)
        {
            $user->google_id = $googleId;
            $user->password = null;
            $user->save();

            return $user;
        }

        $user = User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'locale' => $payload['locale'],
            'picture' => $payload['picture'],
            'google_id' => $payload['sub'],
        ]);

        return $user;
    }
}
