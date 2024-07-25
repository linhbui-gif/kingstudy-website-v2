import React, { useState } from 'react';

import { Col, Row } from 'antd';
import Link from 'next/link';

import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import HeroBannerCommon from '@/containers/HeroBannerCommon';
import StepSurvey from '@/containers/StepSurvey';
import GuestLayout from '@/layouts/GuestLayout';
import Empty from "@/components/Empty";
import CardSkeleton from "@/components/Card/CardSkeleton";
import Card from "@/components/Card";
import ImageSchool from "@/assets/images/image-school.jpg";
import ButtonComponent from "@/components/Button";
const Survey = () => {
  const [schools, setSchools] = useState([]);
  const [activeSchool, setActiveSchool] = useState(false);
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
                {!activeSchool && (
                  <div className={'md:w-[100rem] w-full '}>
                    <div
                      className={
                        'w-full lg:p-[4rem] p-[2rem] mx-auto shadow-md bg-white rounded-md'
                      }
                    >
                      <StepSurvey
                        setActiveSchool={setActiveSchool}
                        setSchools={setSchools}
                      />
                    </div>
                  </div>
                )}
                {
                  <Row gutter={[24, 24]}>
                    {schools.length === 0 && activeSchool ? (
                      <Col span={24}>
                        <h3 className={'text-center'}>Rất tiếc ! Không có trường nào phù hợp</h3>
                        <div
                          className={
                            'flex items-center justify-center flex-col'
                          }
                        >
                          <Empty />
                        </div>
                        <div className={'flex justify-center'}>
                          <ButtonComponent
                            title={'Quay lại khảo sát'}
                            className={'primary'}
                            onClick={() => setActiveSchool(false)}
                          />
                        </div>
                      </Col>
                    ) : (
                      ''
                    )}
                    {schools &&
                      schools.map((school) => {
                        return (
                          <Col
                            className="flex flex-col "
                            span={24}
                            xl={{ span: 8 }}
                            lg={{ span: 12 }}
                            md={{ span: 12 }}
                            key={school?.id}
                          >
                            <Card
                              url={ImageSchool}
                              title={school?.name}
                              alt={school?.name}
                              type={school?.type_school}
                              country={school?.country}
                              slug={school?.slug}
                              id={school?.id}
                              price={school?.price}
                            />
                          </Col>
                        );
                      })}
                  </Row>
                }
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
