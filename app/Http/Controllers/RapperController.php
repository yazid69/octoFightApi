<?php

namespace App\Http\Controllers;

use App\Models\Rapper;
use Illuminate\Http\Request;

class RapperController extends Controller
{
    public function getRappers()
    {
        $maxAttack = 100;
        $maxDefense = 100;

        $rappers = Rapper::all()->map(function($rapper) use ($maxAttack, $maxDefense) {
            $attaque = ($rapper->popularity * 1.1) + ($rapper->followers / 1500000); 
            $attaque = min($attaque, $maxAttack);

            $defense = ($rapper->followers * 0.00003) + ($rapper->popularity * 0.2);
            $defense = min($defense, $maxDefense);

            return [
                'id' => $rapper->id,
                'name' => $rapper->name,
                'image_url' => $rapper->image_url,
                'popularity' => $rapper->popularity,
                'attaque' => round($attaque, 2),   
                'defense' => round($defense, 2),   
            ];
        });

        return response()->json($rappers);
    }

    public function getRapper($id)
    {
        $maxAttack = 100;
        $maxDefense = 100;

        $rapper = Rapper::find($id);

        if (!$rapper) {
            return response()->json(['error' => 'Rappeur non trouvé'], 404);
        }

        $attaque = ($rapper->popularity * 1.1) + ($rapper->followers / 1500000); 
        $attaque = min($attaque, $maxAttack);

        $defense = ($rapper->followers * 0.00003) + ($rapper->popularity * 0.2);
        $defense = min($defense, $maxDefense);

        return response()->json([
            'id' => $rapper->id,
            'name' => $rapper->name,
            'image_url' => $rapper->image_url,
            'popularity' => $rapper->popularity,
            'followers' => $rapper->followers,
            'attaque' => round($attaque, 2),
            'defense' => round($defense, 2)
        ]);
    }
}
