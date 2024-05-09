import React from 'react';

import Meta from '@/components/Meta';
import Header from '@/containers/Header';
import TopBar from '@/containers/Topbar';
import Hero from "@/containers/Hero";

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
      <Header />
      <Hero/>
    </div>
  );
}
