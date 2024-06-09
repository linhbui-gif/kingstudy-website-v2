import React from 'react';

import { Col, Flex, Row } from 'antd';
import dynamic from 'next/dynamic';
import Image from 'next/image';
import { useRouter } from 'next/router';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import { EProfileSidebar } from '@/common/enums';
import Container from '@/containers/Container';
import ManageProfile from '@/containers/Profile/ManageProfile';
import MyProfileInformation from '@/containers/Profile/MyProfileInformation';
import SchoolFavorite from '@/containers/Profile/SchoolFavorite';
import SettingSidebar from '@/containers/Profile/Setting';
import TrackingProfile from '@/containers/Profile/TrackingProfile';
import Setting from '@/containers/Setting';
import { sidebarProfileData } from '@/containers/SidebarProfile/SidebarProfile.data';
import ProtectedLayout from '@/layouts/ProtectedLayout';

const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const Profile = () => {
  const router = useRouter();
  // eslint-disable-next-line no-unsafe-optional-chaining
  const { page } = router?.query;
  const renderContentRight = (pageType) => {
    switch (pageType) {
      case EProfileSidebar.MY_PROFILE_INFORMATION:
        return <MyProfileInformation />;
      case EProfileSidebar.TRACKING_PROFILE_INFORMATION:
        return <TrackingProfile />;
      case EProfileSidebar.MANAGER_PROFILE_INFORMATION:
        return <ManageProfile />;
      case EProfileSidebar.SCHOOL_FAVORITE:
        return <SchoolFavorite />;
      case EProfileSidebar.SETTING:
        return <SettingSidebar />;
      default:
        return '';
    }
  };
  return (
    <div>
      <MediaQuery maxWidth={991}>
        <Setting />
      </MediaQuery>
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
                  <div className="avatar">
                    <Image
                      className={'rounded-full'}
                      src={ImageAvatarDefault}
                      alt={'not-avatar'}
                    />
                  </div>
                  <div>
                    <span>Xin chào,</span>
                    <h3 className={'text-title-24 font-[700]'}>
                      David Allberto
                    </h3>
                  </div>
                </Flex>
              </Col>
            </Row>
            <Row>
              <Col span={6}>
                <div className={'p-[3rem] bg-style-8 rounded-sm h-full'}>
                  <ul>
                    {sidebarProfileData &&
                      sidebarProfileData.map((sidebar) => {
                        return (
                          <li
                            key={sidebar?.key}
                            onClick={() => router.push(sidebar?.link)}
                            className={`flex items-center w-full p-[1.2rem_1.5rem] cursor-pointer text-body-14 ${
                              sidebar?.activePaths.includes(page)
                                ? 'text-orange font-bold'
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
