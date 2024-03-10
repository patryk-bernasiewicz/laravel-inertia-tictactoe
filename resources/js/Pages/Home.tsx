import React from 'react';

const Home = () => {
  const foo: string = 'React';
  const bar: string = 'TypeScript';
  const baz: string = 'Tailwind';

  return (
    <div className="mx-auto py-4 max-w-[1200px]">
      <h1 className="text-2xl font-bold">
        Hello {foo} + {bar} + {baz}!
      </h1>
    </div>
  );
};

export default Home;
