import React from 'react';
import classNames from 'classnames';

type TBoardProps = {
  gameState: string[];
  isDisabled?: boolean;
  onMove: (cell: number) => void;
};

export const Board = (props: TBoardProps) => (
  <div className="inline-grid grid-flow-col grid-cols-3 grid-rows-3 gap-1">
    {props.gameState.map((value, index) => {
      const disabled = props.isDisabled || value !== '';

      return (
        <button
          key={`cell-${index}`}
          type="button"
          className={classNames(
            'h-24 w-24 items-center justify-center border border-slate-400 bg-slate-50',
            disabled && 'cursor-not-allowed border-slate-300 bg-slate-100'
          )}
          disabled={disabled}
          onClick={() => props.onMove(index)}
        >
          {value && (
            <span className="grid__symbol">{props.gameState[index]}</span>
          )}
          <span className="sr-only">Cell #{index}</span>
        </button>
      );
    })}
  </div>
);
