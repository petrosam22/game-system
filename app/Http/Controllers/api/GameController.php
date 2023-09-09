<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getGameTurns(Request $request)
    {
        $numPlayers = $request->input('numPlayers', 3);
        $numTurns = $request->input('numTurns', 3);
        $startPlayer = $request->input('startPlayer', 'A');

        $players = range('A', 'Z');
        $playerCount = count($players);
        $startIndex = array_search($startPlayer, $players);

        $gameTurns = [];
        $reverseOrder = false;

        for ($i = 0; $i < $numTurns; $i++) {
            $gameTurn = [];

            for ($j = 0; $j < $numPlayers; $j++) {
                $playerIndex = ($startIndex + $j) % $playerCount;
                $gameTurn[] = $players[$playerIndex];
            }

            $gameTurns[] = $gameTurn;

            if ($reverseOrder) {
                $startIndex--;
                if ($startIndex < 0) {
                    $startIndex = $playerCount - 1;
                }
            } else {
                $startIndex++;
                if ($startIndex >= $playerCount) {
                    $startIndex = 0;
                }
            }

            $reverseOrder = !$reverseOrder;
        }

        return response()->json($gameTurns);
    }


}
