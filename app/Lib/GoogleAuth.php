<?php

namespace App\Lib;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Google_Client;

class GoogleAuth
{
    const AUTH_URI = 'https://accounts.google.com/o/oauth2/auth';
    const TOKEN_URI = 'https://oauth2.googleapis.com/token';
    const RESPONSE_TYPE = 'code';
    const SCOPE = 'openid profile email';
    const REDIRECT_URI = '/google/authorize';
    const STATE_COOKIE = 'state';
    const STATE_EXPIRATION = 60; // Minutes
    const GRANT_TYPE = 'authorization_code';

    public static function getAuthUrl()
    {
        $query = http_build_query(array(
            'client_id' => config('auth.google_client_id'),
            'response_type' => self::RESPONSE_TYPE,
            'scope' => self::SCOPE,
            'redirect_uri' =>  GoogleAuth::getRedirectUri(),
            'state' => GoogleAuth::encodeState(),
        ));
        return self::AUTH_URI.'?'.$query;
    }

    public static function encodeState()
    {
        $state = base64_encode(json_encode(
            array(
                'csrf_token' => csrf_token(),
                'previous_url' => url()->previous(),
            )
        ));
        Cookie::queue(self::STATE_COOKIE, $state, self::STATE_EXPIRATION);
        return $state;
    }

    public static function isValidState($state)
    {
        $savedState = Cookie::get(self::STATE_COOKIE);
        return $savedState == $state;
    }

    public static function getSavedState()
    {
        return json_decode(base64_decode(Cookie::get(self::STATE_COOKIE)));
    }

    public static function getAccessToken($code)
    {
        $response = Http::asForm()
            ->post(self::TOKEN_URI, [
                'code' => $code,
                'client_id' => config('auth.google_client_id'),
                'client_secret' => config('auth.google_client_secret'),
                'redirect_uri' => GoogleAuth::getRedirectUri(),
                'grant_type' => self::GRANT_TYPE,
            ]);
        return $response->json();
    }

    public static function getRedirectUri()
    {
        return config('app.url') . self::REDIRECT_URI;
    }

    public static function decodeIdToken($idToken)
    {
        $client = new Google_Client(['client_id' => config('auth.google_client_id')]);
        $payload = $client->verifyIdToken($idToken);

        if ($payload)
        {
            return $payload;
        }

        return null;
    }
}
