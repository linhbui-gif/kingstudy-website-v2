import React from 'react';

import Meta from '@/components/Meta';
import TopBar from '@/containers/Topbar';

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
    </div>
  );
}
