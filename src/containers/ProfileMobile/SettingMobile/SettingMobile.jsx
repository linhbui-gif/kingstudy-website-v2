import React from 'react';

import SettingSidebar from '@/containers/Profile/Setting';
import BackToDashBoard from '@/containers/ProfileMobile/BackToDashBoard';
import { rootUrl } from '@/utils/utils';

const SettingMobile = ({ setSwitchUIMobile, profileState }) => {
  return (
    <div className={'mt-[2rem] px-5 pb-[10rem] min-h-screen overflow-y-scroll'}>
      <div className={'p-5 shadow-md bg-white container rounded-sm'}>
        <BackToDashBoard setSwitchUIMobile={setSwitchUIMobile} />
        <SettingSidebar
          avatarStateUrl={`${rootUrl}${profileState?.profile?.user?.image_url}`}
        />
      </div>
    </div>
  );
};
export default SettingMobile;
