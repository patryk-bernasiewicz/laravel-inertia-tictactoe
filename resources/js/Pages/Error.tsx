import React from 'react';
import { Link } from '@inertiajs/react';

type TErrorProps = {
  status?: string | number;
  message?: string;
};

const Error = (props: TErrorProps) => (
  <div className="mx-auto flex h-full max-w-[1200px] items-center justify-center p-8">
    <div className="min-w-[400px] border-2 border-red-700 p-4">
      <h1 className="text-xl font-bold">Sorry!</h1>
      <p className="font-medium">
        {props.status ? `Error ${props.status} - ` : ''}
        {props.message}
      </p>
      <div className="my-4 flex justify-center">
        <Link
          href="/"
          className="font-bold text-blue-500 hover:underline focus:underline"
        >
          Go to home page
        </Link>
      </div>
    </div>
  </div>
);

export default Error;
