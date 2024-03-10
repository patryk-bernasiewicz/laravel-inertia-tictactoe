import React from 'react';
import { Link } from '@inertiajs/react';

const Home = () => (
  <div className="mx-auto grid h-full max-w-[1200px] items-center justify-center py-4">
    <Link
      href="play"
      className="border-2 border-blue-500 bg-white p-2 text-lg hover:border-blue-600 hover:bg-blue-50 focus:border-blue-600 focus:bg-blue-50"
    >
      Play Tic-Tac-Toe!
    </Link>
  </div>
);

export default Home;
