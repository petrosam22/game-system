<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{

    // public function getGameTurns(Request $request)
    public function getGameTurns(Request $request, $players = 3, $turns = 3)

    {
        $playersCount = $request->get('players', 3);
        $turnsCount = $request->get('turns', 3);
        $startPlayerIndex = $request->get('start', 2) - 1;

        $players = range('A', 'Z');
        $players = array_slice($players, 0, $playersCount);

        $turns = [];
        for ($i = 0; $i < $turnsCount; $i++) {
            $start = ($startPlayerIndex + $i) % $playersCount;
            $turns[] = array_merge(array_slice($players, $start), array_slice($players, 0, $start));
        }

        return response()->json($turns);
    }

}




