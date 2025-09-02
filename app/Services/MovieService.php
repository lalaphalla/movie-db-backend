<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MovieService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->apiKey = config('services.tmdb.api_key');
    }

    public function fetchPopularMovies($page = 1, $limit = 10)
    {
        return Http::get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'page' => $page,
            'per_page' => $limit
        ])->json();
    }
    public function fetchPopularMoviesV2($page = 1, $limit = 10)
    {
        $cacheKey = "tmdb:popular:page:$page";

        $movies = Cache::get($cacheKey);

        // Try Redis Cache
        $movies = Cache::get($cacheKey);
        if ($movies) {
            return $movies;
        }
        // Try DB
        $dbCache = Movie::where('type', 'popular')->where('page', $page)->first();
        if ($dbCache) {
            Cache::put($cacheKey, $dbCache->data, 3600);
            return $dbCache->data;
        }
        ;

        // TMDB API         
        $response = Http::get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'page' => $page,
        ])->json();

        // Store in db
        Movie::updateOrCreate(
            ['type' => 'popular', 'page' => $page],
            ['data' => $response]
        );

        // Store in Redis
        Cache::put($cacheKey, $response, 3600);

        return $response;
    }

    public function fetchTrendingMovies()
    {
        return Http::get("{$this->baseUrl}/trending/movie/week", [
            'api_key' => $this->apiKey,
        ])->json();
    }

    public function fetchMovieDetails($id)
    {
        return Http::get("{$this->baseUrl}/movie/{$id}", [
            'api_key' => $this->apiKey,
        ])->json();
    }
}
