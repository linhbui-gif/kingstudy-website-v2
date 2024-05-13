import React from 'react';

import Meta from '@/components/Meta';
import About from '@/containers/About';
import Cta from '@/containers/Cta';
import Header from '@/containers/Header';
import Hero from '@/containers/Hero';
import Major from '@/containers/Major';
import TopBar from '@/containers/Topbar';

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
      <Header />
      <Hero />
      <About />
      <Major />
      <Cta />
    </div>
  );
}
