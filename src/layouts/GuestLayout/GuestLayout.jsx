import React from 'react';

import Header from '@/containers/Header';
import TopBar from '@/containers/Topbar';

const GuestLayout = ({ children }) => {
  return (
    <div>
      <TopBar />
      <Header />
      {children}
    </div>
  );
};
export default GuestLayout;
