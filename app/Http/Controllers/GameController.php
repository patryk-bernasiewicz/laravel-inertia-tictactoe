<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Services\GameService;
use App\Models\Game;

class GameController extends Controller
{
    private $playerSymbol = 'x';
    private $computerSymbol = 'o';

    public function __construct(private GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function play(Request $request)
    {
        $key = $request->session()->get('id');
        if (!$key) {
            $key = Str::random(9);
            $request->session()->put('id', $key);
        }

        $game = Game::firstOrCreate([
            'session_id' => $key,
        ], [
            'state' => json_encode($this->gameService->getEmptyGameState())
        ]);
        $gameState = json_decode($game->state, true);

        $winner = $this->gameService->checkWinner($gameState);

        return Inertia::render('Play', [
            'session_id' => $game->session_id,
            'state' => array_values($gameState),
            'winner' => $winner,
        ]);
    }

    public function move(Request $request)
    {
        $key = $request->session()->get('id');

        if (!$key) {
            return response()->json([
                'message' => 'no session id',
            ]);
        }

        $game = Game::where('session_id', $key)->firstOrFail();
        $cell = $request->input('cell');
        $state = json_decode($game->state);

        if ($state[$cell] !== '') {
            return to_route('play');
        }

        $state[$cell] = $this->playerSymbol;

        $oppositeMoveCell = $this->gameService->getBestMove($state, $this->computerSymbol);
        if ($oppositeMoveCell > -1) {
            $state[$oppositeMoveCell] = $this->computerSymbol;
        }

        $game->state = $state;
        $game->saveOrFail();

        return to_route('play');
    }

    public function newGame(Request $request)
    {
        $key = $request->session()->get('id');


        if (!$key) {
            return response()->json([
                'message' => 'no session id',
            ]);
        }

        $game = Game::firstOrCreate([
            'session_id' => $key,
        ], [
            'state' => json_encode($this->gameService->getEmptyGameState())
        ]);
        $game->state = $this->gameService->getEmptyGameState();
        $game->saveOrFail();

        return to_route('play');
    }
}
