import React from 'react';

import { Col, Flex, Row } from 'antd';
import dynamic from 'next/dynamic';
import Image from 'next/image';
import { useRouter } from 'next/router';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import Container from '@/containers/Container';
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
      case 'profile':
        return 'profile page';
      case 'wishlist':
        return 'wishlist';
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
                <div className={'p-[3rem] bg-style-8 rounded-sm'}>
                  <ul>
                    {sidebarProfileData &&
                      sidebarProfileData.map((sidebar) => {
                        return (
                          <li
                            key={sidebar?.key}
                            onClick={() => router.push(sidebar?.link)}
                            className={
                              'block w-full p-[1.2rem_1.5rem] cursor-pointer text-body-14'
                            }
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
