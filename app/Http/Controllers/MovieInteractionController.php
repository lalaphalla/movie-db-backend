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
        $user = Auth::user();

        $favorites = Favorite::where('user_id', $userId)->get();

        // return $user->favorites;
        return response()->json($favorites);
    }

    public function favorites()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $favorites = Favorite::where('user_id', $user->id)->get();
        return response()->json($favorites);
    }

}
