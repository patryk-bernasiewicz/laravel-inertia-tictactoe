<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\GameService;

class GameServiceTest extends TestCase
{
    private GameService $game_service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->game_service = new GameService;
    }

    public function testCheckWinnerForColumns()
    {
        $game_state = [
            'x', '', '',
            'x', '', 'o',
            'x', 'o', '',
        ];
        $this->assertEquals('x', $this->game_service->checkWinner($game_state));
    }

    public function testCheckWinnerForRows()
    {
        $game_state = [
            'o', '', '',
            '', '', 'o',
            'x', 'x', 'x',
        ];
        $this->assertEquals('x', $this->game_service->checkWinner($game_state));
    }

    public function testCheckWinnerForDiagonal()
    {
        $game_state = [
            'o', '', '',
            '', 'o', 'x',
            'x', 'x', 'o',
        ];
        $this->assertEquals('o', $this->game_service->checkWinner($game_state));
    }

    public function testDeterminesBestMove()
    {
        $game_state = [
            'x', '', '',
            '', 'x', 'o',
            '', '', '',
        ];
        $this->assertEquals(8, $this->game_service->getBestMove($game_state, 'x'));
    }
}