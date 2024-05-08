import React from 'react';

import Meta from '@/components/Meta';
import TopBar from '@/containers/Topbar';
import Header from "@/containers/Header";

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
      <Header />
    </div>
  );
}
