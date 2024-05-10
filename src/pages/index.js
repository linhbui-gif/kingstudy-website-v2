import React from 'react';

import Meta from '@/components/Meta';
import Header from '@/containers/Header';
import Hero from '@/containers/Hero';
import Major from '@/containers/Major';
import TopBar from '@/containers/Topbar';
import Cta from "@/containers/Cta";

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
      <Header />
      <Hero />
      <Major />
      <Cta />
    </div>
  );
}
