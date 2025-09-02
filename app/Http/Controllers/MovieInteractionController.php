<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieInteractionController extends Controller
{
    public function addFavorite($movieId)
    {
        $user = Auth::user();

        $favorite = Favorite::firstOrCreate([
            'user_id' => $user->id,
            'movie_id' => $movieId,
        ]);

        return response()->json([$favorite, 201]);
    }

    public function userFavorites($userId)
    {
        $favorites = Favorite::where('user_id', $userId)->get();

        return response()->json($favorites);
    }

}
