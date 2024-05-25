import React, { useEffect, useState } from 'react';

import { Col, Flex, Row } from 'antd';
import Image from 'next/image';
import { useRouter } from 'next/router';

import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import Course from '@/containers/Course';
import HeroBannerText from '@/containers/HeroBannerText';
import Infrastructure from '@/containers/Infrastructure';
import Review from '@/containers/Review';
import Scholarship from '@/containers/Scholarship';
import Tution from '@/containers/Tution';
import GuestLayout from '@/layouts/GuestLayout';
import { getSchoolDetailBySlug } from '@/services/school';
import { rootUrl, statusSchool } from '@/utils/utils';

const SchoolDetail = () => {
  const router = useRouter();
  const { slug } = router.query;
  const [school, setSchool] = useState(null);
  const [loading, setLoading] = useState(false);
  const schoolData = school?.data;
  // const hasDocument = school?.hasDocument;
  const numberInfors = schoolData?.number_info || {};
  const gallery = schoolData?.gallery || {};
  const getSchool = async () => {
    try {
      setLoading(true);
      const response = await getSchoolDetailBySlug(slug[0]);
      if (response?.code === 200) {
        setLoading(true);
        setSchool(response?.data?.data);
      }
    } catch (e) {
      setLoading(false);
    }
  };
  useEffect(() => {
    if (!slug) return;
    getSchool().then();
  }, [slug]);

  return (
    <GuestLayout>
      <Meta title={schoolData?.meta_title} />
      <div className={'min-h-screen'}>
        <HeroBannerText data={schoolData} loading={loading} />
        <section className={'relative z-[5] lg:translate-y-[-6rem]'}>
          <Container>
            <Row gutter={[24, 24]}>
              <Col lg={{ span: 18 }}>
                <div
                  className={'bg-white rounded-sm lg:p-[3.2rem] pt-[3.2rem]'}
                >
                  <Flex
                    align={'start'}
                    className={'school-heading md:gap-[1.6rem] gap-[.6rem]'}
                  >
                    <Flex
                      align={'start'}
                      className={'md:gap-[1.6rem] gap-[.6rem]'}
                    >
                      <div className={'w-[9rem] h-[9rem]'}>
                        <Image
                          src={`${rootUrl}${
                            schoolData?.logo ? schoolData?.logo : ''
                          }`}
                          width={90}
                          height={90}
                          loading={'lazy'}
                          alt={schoolData?.name}
                          className={'w-full h-full object-contain'}
                          quality={100}
                        />
                      </div>
                      <div>
                        <h3
                          className={
                            'md:text-title-36 text-title-20 text-style-7 mb-[.8rem]'
                          }
                        >
                          {schoolData?.name}
                        </h3>
                        <Flex
                          align={'center'}
                          className={'md:gap-[8px] gap-[5px]'}
                        >
                          <Flex>
                            <Icon name={EIconName.Star} />
                            <Icon name={EIconName.Star} />
                            <Icon name={EIconName.Star} />
                            <Icon name={EIconName.Star} />
                            <Icon name={EIconName.Star} />
                          </Flex>
                          <span
                            className={
                              'mt-2 md:text-body-16 text-body-14 text-style-9 font-[600]'
                            }
                          >
                            (25) reviews
                          </span>
                        </Flex>
                      </div>
                    </Flex>
                    {statusSchool(schoolData?.type)}
                  </Flex>
                  <Flex
                    className="md:flex hidden school-meta p-[2rem_0] mt-[4rem]"
                    gap={20}
                    wrap
                    justify={'space-around'}
                    style={{
                      borderTop: '1px solid #edeef2',
                      borderBottom: '1px solid #edeef2',
                    }}
                  >
                    {Object.values(numberInfors) &&
                      Object.values(numberInfors).map((number, index) => {
                        return (
                          <div
                            key={index}
                            className={`relative before:absolute before:content-[''] before:w-[1px] before:h-[4rem] before:right-[-8.5rem] before:top-[1rem] before:bg-style-8 last:before:static`}
                          >
                            <span
                              className={'text-body-14 text-style-9 mb-2 block'}
                            >
                              {number?.title}
                            </span>
                            <h6
                              className={
                                'text-center text-title-20 text-style-7'
                              }
                            >
                              {number?.number}
                            </h6>
                          </div>
                        );
                      })}
                  </Flex>
                  <div className={'md:hidden block'}>
                    <ul>
                      {Object.values(numberInfors) &&
                        Object.values(numberInfors).map((element, index) => {
                          return (
                            <li
                              key={index}
                              className={
                                'flex items-center justify-between p-[1.8rem_0]'
                              }
                              style={{ borderBottom: '1px solid #DEE2E6' }}
                            >
                              <span
                                className={
                                  'text-body-14 font-[600] text-style-9'
                                }
                              >
                                {element?.title}
                              </span>
                              <span className={'text-button-16 text-style-7'}>
                                {element?.number}
                              </span>
                            </li>
                          );
                        })}
                    </ul>
                  </div>
                  <div
                    className={'py-[4rem] font-BeVnPro'}
                    dangerouslySetInnerHTML={{ __html: schoolData?.about }}
                  />
                  <div
                    className={'md:p-[2.4rem] p-[1.6rem] bg-style-8 rounded-sm'}
                    id="thongtinnoibat"
                  >
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Thông Tin Nổi Bật
                    </h4>
                    <ul className={'flex items-center flex-wrap'}>
                      <li
                        className={
                          'mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                      <li
                        className={
                          'mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                      <li
                        className={
                          'mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                      <li
                        className={
                          'mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                      <li
                        className={
                          'mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                      <li
                        className={
                          'text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                        }
                      >
                        Handle advanced techniques like Dimensionality Reduction
                      </li>
                    </ul>
                  </div>
                  <div id={'city'} className={'py-[4rem]'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Thành phố
                    </h4>
                    <div
                      dangerouslySetInnerHTML={{
                        __html: schoolData?.map?.iframe,
                      }}
                    />
                  </div>
                  <div className={''} id={'cosovatchat'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Cơ Sở Vật Chất
                    </h4>
                    <Infrastructure data={schoolData?.program} />
                  </div>
                  <div className={'py-[4rem]'} id={'chuongtrinhgiangday'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Chương trình giảng dạy
                    </h4>
                    <div
                      dangerouslySetInnerHTML={{
                        __html: schoolData?.infrastructure,
                      }}
                    />
                  </div>
                  <div id={'hocphi'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Học phí
                    </h4>
                    <Tution data={schoolData?.tuition} />
                  </div>
                  <div id={'hocbong'} className={'pt-[4rem]'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Học bổng
                    </h4>
                    <Scholarship />
                  </div>
                  <div id={'khoahoc'} className={'pt-[4rem]'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Khóa học
                    </h4>
                    <Course />
                  </div>
                  <div className={'py-[4rem]'} id={'gallery'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Thư viện ảnh
                    </h4>
                    <Row gutter={[24, 24]}>
                      {Object.values(gallery) &&
                        Object.values(gallery).map((gallery) => {
                          return (
                            <Col md={{ span: 8 }} span={24} key={gallery?.id}>
                              <Image
                                src={`${rootUrl}${gallery?.image}`}
                                alt={''}
                                loading={'lazy'}
                                layout={'responsive'}
                                width={256}
                                height={137}
                                quality={100}
                              />
                            </Col>
                          );
                        })}
                    </Row>
                  </div>
                  <div className={''} id={'review'}>
                    <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                      Đánh Giá Của Học Viên
                    </h4>
                    <Review data={schoolData?.feed_back} />
                  </div>
                </div>
              </Col>
              <Col lg={{ span: 6 }}>
                <div className={'bg-white rounded-sm p-[3rem`] shadow-md'}>
                  asdasd
                </div>
              </Col>
            </Row>
          </Container>
        </section>
      </div>
    </GuestLayout>
  );
};
export default SchoolDetail;
