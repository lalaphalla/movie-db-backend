<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function popular()
    {
        $movies = $this->movieService->fetchPopularMovies($page = 1, $limit = 2);
        // return response()->json($this->movieService->fetchPopularMovies());
        //      dd(print_r(value: $movies));
   
        return response()->json([
        // 'page' => $movies['page'],
        'page' => $page,
        'limit' => $limit,
        'total_pages' => $movies['total_pages'],
        'total_results' => $movies['total_results'],
        'results' => MovieResource::collection($movies['results']),
    ]);
    }
    public function popularV2()
    {
        $movies = $this->movieService->fetchPopularMoviesV2($page = 1, $limit = 2);
        // return response()->json($this->movieService->fetchPopularMovies());
        //      dd(print_r(value: $movies));
   
        return response()->json([
        // 'page' => $movies['page'],
        'page' => $page,
        'limit' => $limit,
        'total_pages' => $movies['total_pages'],
        'total_results' => $movies['total_results'],
        'results' => MovieResource::collection($movies['results']),
    ]);
    }

    public function trending()
    {
        return response()->json($this->movieService->fetchTrendingMovies());
    }

    public function detail($id)
    {
        return response()->json($this->movieService->fetchMovieDetails($id));
    }
}
