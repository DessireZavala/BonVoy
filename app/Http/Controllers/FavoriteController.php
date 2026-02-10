<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites;
        return view('favorites.index', compact('favorites'));
    }

    public function toggle($id, $type)
    {
        $userId = Auth::id();
        
        // Buscamos si ya existe para quitarlo, si no, lo agregamos
        $exists = Favorite::where('user_id', $userId)
            ->where('favorable_id', $id)
            ->where('favorable_type', 'App\Models\\' . $type)
            ->first();

        if ($exists) {
            $exists->delete();
            return back()->with('info', 'Eliminado de favoritos');
        }

        Favorite::create([
            'user_id' => $userId,
            'favorable_id' => $id,
            'favorable_type' => 'App\Models\\' . $type
        ]);

        return back()->with('success', 'Guardado en favoritos');
    }
}
