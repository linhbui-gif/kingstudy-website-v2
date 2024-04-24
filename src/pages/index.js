'use client';
import React from 'react';

import Meta from '@/components/Meta';
import Header from '@/containers/Header';

export default function Home() {
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <Header />
    </div>
  );
}
