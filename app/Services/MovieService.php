<?php

namespace App\Services;

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
