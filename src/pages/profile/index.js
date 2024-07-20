import React, { useEffect, useState } from 'react';

import { Col, Flex, Row } from 'antd';
import dynamic from 'next/dynamic';
import { useRouter } from 'next/router';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import { EProfileSidebar } from '@/common/enums';
import Container from '@/containers/Container';
import ManageProfile from '@/containers/Profile/ManageProfile';
import MyProfileInformation from '@/containers/Profile/MyProfileInformation';
import SchoolFavorite from '@/containers/Profile/SchoolFavorite';
import SettingSidebar from '@/containers/Profile/Setting';
import TrackingProfile from '@/containers/Profile/TrackingProfile';
import SettingMobile from '@/containers/ProfileMobile/SettingMobile';
import ViewProfile from '@/containers/ProfileMobile/ViewProfile';
import Setting from '@/containers/Setting';
import { sidebarProfileData } from '@/containers/SidebarProfile/SidebarProfile.data';
import { useAPI } from '@/contexts/APIContext';
import ProtectedLayout from '@/layouts/ProtectedLayout';
import { rootUrl } from '@/utils/utils';

const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const Profile = () => {
  const router = useRouter();
  // eslint-disable-next-line no-unsafe-optional-chaining
  const { page } = router?.query;
  const { getProfileInfor, profileState, loadingGetProfileState } = useAPI();
  const userInformation = profileState?.profile?.user;
  const [switchUIMobile, setSwitchUIMobile] = useState(null);
  const renderContentRight = (pageType) => {
    switch (pageType) {
      case EProfileSidebar.MY_PROFILE_INFORMATION:
        return (
          <MyProfileInformation
            profileState={profileState}
            loading={loadingGetProfileState}
          />
        );
      case EProfileSidebar.TRACKING_PROFILE_INFORMATION:
        return <TrackingProfile />;
      case EProfileSidebar.MANAGER_PROFILE_INFORMATION:
        return (
          <ManageProfile
            profileState={profileState}
            loading={loadingGetProfileState}
          />
        );
      case EProfileSidebar.SCHOOL_FAVORITE:
        return <SchoolFavorite />;
      case EProfileSidebar.SETTING:
        return (
          <SettingSidebar
            avatarStateUrl={`${rootUrl}${profileState?.profile?.user?.image_url}`}
          />
        );
      default:
        return '';
    }
  };

  const renderUIMobile = () => {
    switch (switchUIMobile?.type) {
      case EProfileSidebar.MY_PROFILE_INFORMATION:
        return (
          <ViewProfile
            profileState={profileState}
            setSwitchUIMobile={setSwitchUIMobile}
          />
        );
      case EProfileSidebar.SETTING:
        return (
          <SettingMobile
            setSwitchUIMobile={setSwitchUIMobile}
            profileState={profileState}
          />
        );
      default:
        return (
          <Setting
            setSwitchUIMobile={setSwitchUIMobile}
            userInformation={userInformation}
            switchUIMobile={switchUIMobile}
          />
        );
    }
  };

  useEffect(() => {
    getProfileInfor().then();
  }, []);
  return (
    <div>
      <MediaQuery maxWidth={991}>{renderUIMobile()}</MediaQuery>
      <MediaQuery minWidth={992}>
        <div className={'py-[10rem]'}>
          <Container>
            <Row>
              <Col span={24}>
                <Flex
                  align={'center'}
                  gap={30}
                  style={{ borderBottom: '1px solid #edeef2' }}
                  className={'pb-[3rem]'}
                >
                  <div className="avatar w-[26rem]">
                    <img
                      width={260}
                      height={260}
                      loading={'lazy'}
                      alt={''}
                      className={'w-full object-cover rounded-full'}
                      src={
                        profileState
                          ? `${rootUrl}${userInformation?.image_url}`
                          : ImageAvatarDefault
                      }
                    />
                  </div>
                  <div>
                    <span>Xin chào,</span>
                    <h3 className={'text-title-24 font-[700]'}>
                      {userInformation?.full_name}
                    </h3>
                  </div>
                </Flex>
              </Col>
            </Row>
            <Row>
              <Col span={6}>
                <div className={'p-[3rem] bg-gray-sample rounded-sm h-full'}>
                  <ul>
                    {sidebarProfileData &&
                      sidebarProfileData.map((sidebar) => {
                        return (
                          <li
                            key={sidebar?.key}
                            onClick={() => router.push(sidebar?.link)}
                            className={`flex items-center w-full p-[1.2rem_1.5rem] cursor-pointer text-body-14 ${
                              sidebar?.activePaths.includes(page)
                                ? 'bg-white rounded-sm text-style-10 font-[500]'
                                : ''
                            }`}
                          >
                            {sidebar?.icon} {sidebar?.title}
                          </li>
                        );
                      })}
                  </ul>
                </div>
              </Col>
              <Col span={18}>{renderContentRight(page)}</Col>
            </Row>
          </Container>
        </div>
      </MediaQuery>
    </div>
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
