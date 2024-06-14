import React from 'react';

import StepSubmitProfile from '@/containers/StepSubmitProfile';
import ProtectedLayout from '@/layouts/ProtectedLayout';

const SubmitProfile = () => {
  return (
    <div className={'min-h-screen px-4 flex items-center justify-center '}>
      <div className={'md:w-[100rem] w-full '}>
        <div
          className={
            'w-full lg:p-[4rem] p-[2rem] mx-auto shadow-md bg-white rounded-md'
          }
        >
          <StepSubmitProfile />
        </div>
      </div>
    </div>
  );
};
export default SubmitProfile;
SubmitProfile.getLayout = function (page) {
  return (
    <>
      <ProtectedLayout>{page}</ProtectedLayout>
    </>
  );
};
