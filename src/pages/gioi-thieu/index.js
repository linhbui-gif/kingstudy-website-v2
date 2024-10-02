import https from 'https';

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
import { getAboutContentPage } from '@/services/common/get-about-page';

const AboutPage = ({ dataResponse }) => {
  const dataAboutPage = dataResponse?.data;
  const items = dataResponse?.items;
  return (
    <>
      <Meta
        title={dataAboutPage[26]['locale_vi']['title'] ?? ''}
        description={dataAboutPage[26]['locale_vi']['description'] ?? ''}
      />
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
        <CoreValue
          title={dataAboutPage[20]['locale_vi']['title'] ?? ''}
          data={items[20] || []}
        />
        <Vison
          title={dataAboutPage[21]['locale_vi']['title'] ?? ''}
          description={dataAboutPage[21]['locale_vi']['content'] ?? ''}
        />
        <Instructor
          title={dataAboutPage[24]['locale_vi']['title'] ?? ''}
          data={items[24] || []}
        />
        <Instructor
          title={dataAboutPage[25]['locale_vi']['title'] ?? ''}
          data={items[25] || []}
        />
        <Partner />
      </div>
    </>
  );
};
AboutPage.getLayout = function (page) {
  return (
    <>
      <GuestLayout>{page}</GuestLayout>
    </>
  );
};
export async function getServerSideProps() {
  try {
    const agent = new https.Agent({
      rejectUnauthorized: false,
    });

    const response = await getAboutContentPage(agent);
    const data = response.data;

    return {
      props: {
        dataResponse: data,
      },
    };
  } catch (error) {
    return {
      props: {
        dataResponse: null,
        error: error.message,
      },
    };
  }
}
export default AboutPage;
