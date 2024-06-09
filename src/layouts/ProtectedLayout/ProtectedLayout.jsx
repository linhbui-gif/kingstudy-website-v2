import React, { useEffect } from 'react';

import Header from '@/containers/Header';
import { useAPI } from '@/contexts/APIContext';

const ProtectedLayout = ({ children }) => {
  const { getSchoolWishList, schoolWishList } = useAPI();
  useEffect(() => {
    getSchoolWishList().then();
  }, []);
  return (
    <div>
      <Header totalWishList={schoolWishList?.count} />
      {children}
    </div>
  );
};
export default ProtectedLayout;
