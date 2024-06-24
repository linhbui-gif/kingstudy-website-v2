import { Skeleton } from 'antd';

import Tabs from '@/components/Tabs';
import StudyAboardInformation from '@/containers/Profile/MyProfileInformation/StudyAboardInformation';

const MyProfileInformation = ({ loading, profileState }) => {
  const userInformation = profileState?.profile?.user;
  const profileInfomationOptions = [
    {
      key: 'information',
      title: 'Thông tin cá nhân',
      children: (
        <div>
          <Skeleton loading={loading}>
            <ul>
              <li className={'flex items-center mb-[2rem]'}>
                <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                  Họ và Tên:
                </h5>
                <span className={'text-body-16 text-style-9'}>
                  {userInformation?.full_name}
                </span>
              </li>
              <li className={'flex items-center mb-[2rem]'}>
                <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                  Email:
                </h5>
                <span className={'text-body-16 text-style-9'}>
                  {userInformation?.email}
                </span>
              </li>
              <li className={'flex items-center mb-[2rem]'}>
                <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                  Số điện thoại:
                </h5>
                <span className={'text-body-16 text-style-9'}>
                  {userInformation?.phone}
                </span>
              </li>
              <li className={'flex items-center mb-[2rem]'}>
                <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                  Giới tính:
                </h5>
                <span className={'text-body-16 text-style-9'}>
                  {userInformation?.gender}
                </span>
              </li>
              <li className={'flex items-center mb-[2rem]'}>
                <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                  Địa chỉ:
                </h5>
                <span className={'text-body-16 text-style-9'}>
                  {userInformation?.address}
                </span>
              </li>
            </ul>
          </Skeleton>
        </div>
      ),
    },
    {
      key: 'information_study',
      title: 'Thông tin du học',
      children: <StudyAboardInformation userInformation={userInformation} />,
    },
  ];
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>My Profile</h4>
      <Tabs options={profileInfomationOptions} defaultKey="information" />
    </div>
  );
};
export default MyProfileInformation;
