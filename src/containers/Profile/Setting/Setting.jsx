import React from 'react';

import Tabs from '@/components/Tabs';
import ChangePassword from '@/containers/Profile/Setting/ChangePassword';
import ChangeProfileInformation from '@/containers/Profile/Setting/ChangeProfileInformation';
const SettingSidebar = ({ avatarStateUrl }) => {
  const settingOptions = [
    {
      key: 'profile',
      title: 'Hồ sơ',
      children: <ChangeProfileInformation avatarStateUrl={avatarStateUrl} />,
    },
    {
      key: 'password',
      title: 'Mật khẩu',
      children: <ChangePassword />,
    },
  ];
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>Cài đặt</h4>
      <Tabs options={settingOptions} defaultKey="profile" />
    </div>
  );
};
export default SettingSidebar;
