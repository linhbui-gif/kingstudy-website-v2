import React from 'react';

import Header from '@/containers/Header';

const ProtectedLayout = ({ children }) => {
  return (
    <div>
      <Header />
      {children}
    </div>
  );
};
export default ProtectedLayout;
