import React, { useEffect } from 'react';

import Footer from '@/containers/Footer';
import Header from '@/containers/Header';
import TopBar from '@/containers/Topbar';
import { useAPI } from '@/contexts/APIContext';

const GuestLayout = ({ children }) => {
  const { getSchoolWishList, schoolWishList, isLogin } = useAPI();
  useEffect(() => {
    if (isLogin) getSchoolWishList().then();
  }, []);
  return (
    <div className={'min-h-screen'}>
      <TopBar />
      <Header totalWishList={isLogin ? schoolWishList?.count : 0} />
      {children}
      <Footer />
    </div>
  );
};
export default GuestLayout;
