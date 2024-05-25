import React from 'react';

import Footer from '@/containers/Footer';
import Header from '@/containers/Header';
import TopBar from '@/containers/Topbar';

const GuestLayout = ({ children }) => {
  return (
    <div className={'min-h-screen'}>
      <TopBar />
      <Header />
      {children}
      <Footer />
    </div>
  );
};
export default GuestLayout;
