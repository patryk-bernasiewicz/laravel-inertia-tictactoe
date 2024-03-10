<?php

namespace App\Services;

class GameService
{
    public function checkWinner(array $gameState)
    {
        $winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        foreach ($winningCombinations as $combination) {
            $val1 = $gameState[$combination[0]];
            $val2 = $gameState[$combination[1]];
            $val3 = $gameState[$combination[2]];

            if ($val1 !== '' && $val1 === $val2 && $val2 === $val3) {
                return $val1;
            }
        }

        if (!in_array('', $gameState)) {
            return 'draw';
        }

        return null;
    }

    public function getBestMove(array $gameState, string $symbol) {
        $bestScore = -INF;
        $bestMove = null;

        for ($i = 0; $i < count($gameState); $i++) {
            if ($gameState[$i] === '') {
                $gameStateCopy = $gameState;
                $gameStateCopy[$i] = $symbol;
                $score = $this->getMoveMinimax($gameStateCopy, $symbol, false);

                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMove = $i;
                }
            }
        }

        return $bestMove;
    }

    public function getEmptyGameState()
    {
        return array_fill(0, 9, '');
    }

    private function getMoveMinimax(array $gameState, string $symbol, bool $isMaximizing = false)
    {
        $winner = $this->checkWinner($gameState);
        if ($winner !== null) {
            if ($winner === $symbol) {
                return 'x';
            } elseif ($winner === 'draw') {
                return 1;
            } else {
                return -1;
            }
        }

        $bestScore = $isMaximizing ? -INF : INF;

        for ($i = 0; $i < count($gameState); $i++) {
            if ($gameState[$i] === '') {
                $gameStateCopy = $gameState;
                if ($isMaximizing) {
                    $gameStateCopy[$i] = $symbol;
                    $score = $this->getMoveMinimax($gameStateCopy, $symbol, false);
                    $bestScore = max($score, $bestScore);
                } else {
                    $gameStateCopy[$i] = ($symbol === 'x') ? 'o' : 'x';
                    $score = $this->getMoveMinimax($gameStateCopy, $symbol, true);
                    $bestScore = min($score, $bestScore);
                }
            }
        }

        return $bestScore;
    }
}