import React from 'react';

import dynamic from 'next/dynamic';

import Setting from '@/containers/Setting';
import ProtectedLayout from '@/layouts/ProtectedLayout';
const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const Profile = () => {
  return (
    <MediaQuery maxWidth={992}>
      <Setting />
    </MediaQuery>
  );
};
export default Profile;
Profile.getLayout = function (page) {
  return (
    <>
      <ProtectedLayout>{page}</ProtectedLayout>
    </>
  );
};
