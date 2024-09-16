import React from 'react';

import Link from 'next/link';

import Meta from '@/components/Meta';
import About from '@/containers/About';
import CoreValue from '@/containers/CoreValue';
import Education from '@/containers/Education';
import HeroBannerCommon from '@/containers/HeroBannerCommon';
import Instructor from '@/containers/Instructor';
import Partner from '@/containers/Partner';
import Vison from '@/containers/Vison';
import GuestLayout from '@/layouts/GuestLayout';

const AboutPage = () => {
  return (
    <>
      <HeroBannerCommon
        title={'Giới thiệu'}
        items={[
          {
            title: <Link href="/">Trang chủ</Link>,
          },
          {
            title: 'Giới thiệu',
          },
        ]}
        urlBanner={'/images/image-banner-about.jpg'}
      />
      <div className={'py-[9rem]'}>
        <About />
        <Education />
        <CoreValue />
        <Vison />
        <Instructor title={'ĐỘI NGŨ LÃNH ĐẠO'} />
        <Instructor title={'CHUYÊN GIA TƯ VẤN'} />
        <Partner />
      </div>
    </>
  );
};
export default AboutPage;

AboutPage.getLayout = function (page) {
  return (
    <>
      <GuestLayout>
        <Meta title={'Danh sách bài viết'} />
        {page}
      </GuestLayout>
    </>
  );
};
