<?php

namespace App\Console\Commands;

use App\Models\Rapper;
use App\Services\SpotifyService;
use Illuminate\Console\Command;

class FetchRappers extends Command
{
    protected $signature = 'fetch:rappers';
    protected $description = 'Récupère les informations des rappeurs depuis l\'API Spotify';

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        parent::__construct();
        $this->spotifyService = $spotifyService;
    }

    public function handle()
    {
        $rappersData = $this->spotifyService->searchFrenchRappers();

        foreach ($rappersData as $rapper) {
            Rapper::updateOrCreate(
                ['name' => $rapper['name']],  
                [
                    'image_url' => $rapper['images'][0]['url'] ?? null,
                    'id_spotify' => $rapper['id'],
                    'followers' => $rapper['followers']['total'] ?? null, 
                    'popularity' => $rapper['popularity'] ?? null 
                ]
            );
        }

        $this->info('Les informations de tous les rappeurs français ont été mises à jour.');
    }

}
