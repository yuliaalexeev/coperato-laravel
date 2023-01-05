<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Planet;
use App\Models\Film;

class SyncPlanetsAndFilmsFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:planets-films-from-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data about planets and films from the SWAPI.dev API';

    /**
     * Execute the console command.
     *
     * @return int
     */

     public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Set up a Guzzle HTTP client
        $client = new Client([
            'verify' => false,
        ]);

        // Fetch planets from the API
        $response = $client->request('GET', 'https://swapi.dev/api/planets/');
        $planets = json_decode($response->getBody());

        foreach ($planets->results as $planet) {
            $planetModel = Planet::firstOrNew(['name' => $planet->name]);
            $planetModel->name = $planet->name;
            if ($planet->population !== "unknown") {
                $planetModel->population = $planet->population;
            }
            else {
                $planetModel->population = 0;
            }
            $planetModel->diameter = $planet->diameter;
            $planetModel->url = $planet->url;
            $planetModel->save();
        }

        // Fetch films from the API
        $response = $client->request('GET', 'https://swapi.dev/api/films/');
        $films = json_decode($response->getBody());

        foreach ($films->results as $film) {
            $filmModel = Film::firstOrNew(['title' => $film->title]);
            $filmModel->title = $film->title;
            $filmModel->url = $film->url;
            $filmModel->save();
        }

        foreach ($planets->results as $planet) {
            $planetModel = Planet::where('name', $planet->name)->first();
            $planetModel->films()->sync([]);
            foreach ($planet->films as $filmUrl) {
                $filmModel = Film::where('url', $filmUrl)->first();
                $planetModel->films()->attach($filmModel);
            }
        }
        
        return Command::SUCCESS;
    }
}
