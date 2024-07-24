import React from 'react';

import { Col, Row } from 'antd';
import Link from 'next/link';

import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import HeroBannerCommon from '@/containers/HeroBannerCommon';
import StepSurvey from '@/containers/StepSurvey';
import GuestLayout from '@/layouts/GuestLayout';
const Survey = () => {
  return (
    <>
      <HeroBannerCommon
        title={'Khảo sát'}
        items={[
          {
            title: <Link href="/">Trang chủ</Link>,
          },
          {
            title: 'Khảo sát',
          },
        ]}
      />
      <div>
        <Container>
          <Row>
            <Col span={24}>
              <div
                className={
                  'min-h-screen px-4 flex items-center justify-center '
                }
              >
                <div className={'md:w-[100rem] w-full '}>
                  <div
                    className={
                      'w-full lg:p-[4rem] p-[2rem] mx-auto shadow-md bg-white rounded-md'
                    }
                  >
                    <StepSurvey />
                  </div>
                </div>
              </div>
            </Col>
          </Row>
        </Container>
      </div>
    </>
  );
};
export default Survey;
Survey.getLayout = function (page) {
  return (
    <>
      <GuestLayout>
        <Meta title={'Khảo sát'} />
        {page}
      </GuestLayout>
    </>
  );
};
