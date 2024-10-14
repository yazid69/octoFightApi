<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpotifyService
{
    public function getSpotifyAccessToken()
    {
        $clientId = env('SPOTIFY_CLIENT_ID');
        $clientSecret = env('SPOTIFY_CLIENT_SECRET');

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        return $response->json('access_token');
    }

    public function searchFrenchRappers()
    {
        $accessToken = $this->getSpotifyAccessToken();
        $query = 'genre:"french hip hop""';  

        $allRappers = [];
        $next = 'https://api.spotify.com/v1/search?q=' . urlencode($query) . '&type=artist&market=FR&limit=10';  

        while ($next) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get($next);

            $data = $response->json();
            $allRappers = array_merge($allRappers, $data['artists']['items']);
            $next = $data['artists']['next'] ?? null;
        }

        return $allRappers;
    }
}
