import React from 'react';
import { router } from '@inertiajs/react';

import { Board } from '../components/Board';

type TPlayProps = {
  session_id: string;
  state: string[];
  winner?: 'o' | 'x' | 'draw' | null;
};

const Play = (props: TPlayProps) => {
  const handleMove = (cell: number) => {
    router.post('/move', {
      cell,
    });
  };

  const handleNewGame = () => {
    router.post('/newGame');
  };

  return (
    <div className="mx-auto flex h-full max-w-[1200px] flex-col items-center justify-center">
      {props.winner && (
        <div className="mb-4 border border-slate-200 p-4 text-center text-lg">
          {props.winner === 'draw' && "It's a draw!"}
          {!!props.winner &&
            props.winner !== 'draw' &&
            `The winner is ${props.winner}!`}
        </div>
      )}
      <Board
        gameState={props.state}
        onMove={handleMove}
        isDisabled={!!props.winner}
      />
      <button
        type="button"
        onClick={handleNewGame}
        className="hover:bg-grey-50 focus:bg-grey-50 mt-4 border-2 border-slate-300 bg-white p-2 hover:border-slate-400 focus:border-slate-400"
      >
        Reset game
      </button>
    </div>
  );
};

export default Play;
