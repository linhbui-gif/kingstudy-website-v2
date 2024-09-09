import https from 'https';

import React, { useEffect, useState } from 'react';

import { Col, Flex, Row, Skeleton } from 'antd';
import * as cheerio from 'cheerio';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/router';
import { useMediaQuery } from 'react-responsive';

import { ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import Course from '@/containers/Course';
import Gallery from '@/containers/Gallery';
import HeroBannerText from '@/containers/HeroBannerText';
import Infrastructure from '@/containers/Infrastructure';
import InputRequest from '@/containers/InputRequest';
import Review from '@/containers/Review';
import Scholarship from '@/containers/Scholarship';
import Tution from '@/containers/Tution';
import { useAPI } from '@/contexts/APIContext';
import GuestLayout from '@/layouts/GuestLayout';
import { addSchoolFavorite, getSchoolDetailBySlug } from '@/services/school';
import { showNotification } from '@/utils/function';
import { rootUrl, statusSchool } from '@/utils/utils';

const itemsMenu = [
  {
    key: 'tongquan',
    label: 'Tổng Quan',
  },
  {
    key: 'city',
    label: 'Thành Phố',
  },
  {
    key: 'cosovatchat',
    label: 'Cơ sở vật chất',
  },
  {
    key: 'chuongtrinhgiangday',
    label: 'Chương trình giảng dạy',
  },
  {
    key: 'hocphi',
    label: 'Học phí',
  },
  {
    key: 'hocbong',
    label: 'Học bổng',
  },
  {
    key: 'khoahoc',
    label: 'Khóa học',
  },
  {
    key: 'yeucaudauvao',
    label: 'Yêu cầu đầu vào',
  },
  {
    key: 'gallery',
    label: 'Thư viện ảnh',
  },
  {
    key: 'review',
    label: 'Feedback',
  },
];

const SchoolDetail = ({ schoolDetail }) => {
  const router = useRouter();
  const { slug } = router.query;
  const [school, setSchool] = useState(null);
  const [loading, setLoading] = useState(false);
  const schoolData = school?.data;
  const hasDocument = school?.hasDocument;
  const numberInfors = schoolData?.number_info || {};
  const gallery = schoolData?.gallery || {};
  const [itemMenuActive, setItemMenuActive] = useState('');
  const isMobile = useMediaQuery({ maxWidth: 1024 });
  const { getSchoolWishList, isLogin } = useAPI();
  const getSchool = async () => {
    try {
      setLoading(true);
      const response = await getSchoolDetailBySlug(slug[0]);
      if (response?.code === 200) {
        let content = response?.data?.data?.data?.program?.after_college;
        const $ = cheerio.load(content);
        $('img').each((index, element) => {
          const src = $(element).attr('src');
          const newSrc = `${rootUrl}${src}`;
          $(element).attr('src', newSrc);
          $(element).attr('alt', 'after_college');
        });

        content = $.html();
        setLoading(false);
        setSchool({
          ...response?.data?.data,
          content,
        });
      }
    } catch (e) {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (!slug) return;
    getSchool().then();
  }, [slug]);

  const handleScroll = (id) => {
    let yOffset = 0;
    if (isMobile) {
      yOffset = -230;
    } else {
      yOffset = -103;
    }
    const element = document.getElementById(id);
    const y =
      element.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
    setItemMenuActive(id);
  };
  const onAddSchoolFavorite = (idSchool) => {
    if (typeof idSchool !== 'undefined')
      addSchoolToFavoriteList(idSchool).then();
  };

  const addSchoolToFavoriteList = async (idSchoolFavorite) => {
    try {
      const response = await addSchoolFavorite(idSchoolFavorite);
      if (response?.status === 200) {
        getSchoolWishList().then();
        showNotification(ETypeNotification.SUCCESS, response?.message);
      }
    } catch (e) {
      showNotification(
        ETypeNotification.ERROR,
        'Đã xảy ra lỗi hệ thống ! Vui lòng liên hệ kỹ thuật để được hỗ trợ sớm nhất'
      );
    }
  };
  return (
    <GuestLayout>
      <Meta
        title={schoolDetail?.meta_title}
        description={schoolDetail?.meta_description}
        robots={schoolDetail?.robots}
        thumbnail={rootUrl + schoolDetail?.thumbnail}
        link={schoolDetail?.link}
      />
      <div className={'min-h-screen'}>
        <HeroBannerText data={schoolData} loading={loading} />
        <section className={'relative z-[5] lg:translate-y-[-6rem]'}>
          <Container>
            <Row gutter={[24, 24]}>
              <Col lg={{ span: 16 }}>
                <div
                  className={'bg-white rounded-sm lg:p-[3.2rem] pt-[3.2rem]'}
                >
                  {loading ? (
                    <Skeleton active avatar />
                  ) : (
                    <Flex
                      align={'start'}
                      className={'school-heading md:gap-[1.6rem] gap-[.6rem]'}
                      id={'tongquan'}
                    >
                      <Flex
                        className={'gap-[1.6rem] md:items-start items-center'}
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
                            className={
                              'w-full h-full object-contain rounded-sm'
                            }
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
                            <Image
                              quality={100}
                              src={`${rootUrl}${
                                schoolData?.country?.icon
                                  ? schoolData?.country?.icon
                                  : ''
                              }`}
                              alt={''}
                              loading={'lazy'}
                              width={18}
                              height={18}
                            />
                            <span
                              className={
                                ' md:text-body-16 text-body-14 text-style-9 font-[600] leading-9'
                              }
                            >
                              {schoolData?.country?.name}
                            </span>
                            <div
                              className={'flex flex-1 md:hidden justify-end'}
                            >
                              {statusSchool(schoolData?.type_school)}
                            </div>
                          </Flex>
                        </div>
                      </Flex>
                      <div className={'mt-2 md:block hidden'}>
                        {statusSchool(schoolData?.type_school)}
                      </div>
                    </Flex>
                  )}
                  <div
                    className={`lg:hidden block fixed top-[14.4rem] md:top-[18.4rem] bg-white z-[100] left-0 w-full`}
                  >
                    <ul
                      className={
                        'flex items-center flex-nowrap overflow-x-scroll'
                      }
                    >
                      {itemsMenu &&
                        itemsMenu.map((item) => {
                          return (
                            <li
                              key={item?.key}
                              onClick={() => handleScroll(item?.key)}
                              className={`cursor-pointer min-w-[33%] ${
                                item?.key === itemMenuActive
                                  ? 'sidebarSchoolMobileActive relative'
                                  : ''
                              }`}
                            >
                              <span
                                className={
                                  'text-body-16 text-style-9 p-[1.6rem_.8rem] block w-full  hover:text-orange text-center'
                                }
                              >
                                {item?.label}
                              </span>
                            </li>
                          );
                        })}
                    </ul>
                  </div>
                  {loading ? (
                    <Skeleton className={'mt-[5rem]'} />
                  ) : (
                    <>
                      <Flex
                        className="md:flex hidden school-meta p-[1.6rem_0] pb-[1.4rem] mt-[4rem]"
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
                                className={`relative before:absolute before:content-[''] before:w-[1px] before:h-[4rem] before:right-[-5.5rem] before:top-[1rem] before:bg-style-8 last:before:static`}
                              >
                                <span
                                  className={
                                    'text-body-14 text-style-9 mb-2 block'
                                  }
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
                            Object.values(numberInfors).map(
                              (element, index) => {
                                return (
                                  <li
                                    key={index}
                                    className={
                                      'flex items-center justify-between p-[1.8rem_0]'
                                    }
                                    style={{
                                      borderBottom: '1px solid #DEE2E6',
                                    }}
                                  >
                                    <span
                                      className={
                                        'text-body-14 font-[600] text-style-9'
                                      }
                                    >
                                      {element?.title}
                                    </span>
                                    <span
                                      className={'text-button-16 text-style-7'}
                                    >
                                      {element?.number}
                                    </span>
                                  </li>
                                );
                              }
                            )}
                        </ul>
                      </div>
                    </>
                  )}
                  {loading ? (
                    <Skeleton className={'my-[5rem]'} />
                  ) : (
                    <div className={'py-[4rem] '}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Tổng quan
                      </h4>
                      <div
                        className={'font-BeVnPro-style-content'}
                        dangerouslySetInnerHTML={{ __html: schoolData?.about }}
                        style={{ color: '#141517 !important' }}
                      />
                    </div>
                  )}
                  <div
                    className={'md:p-[2.4rem] p-[1.6rem] bg-style-8 rounded-sm'}
                    id="thongtinnoibat"
                  >
                    <Skeleton loading={loading}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Thông Tin Nổi Bật
                      </h4>
                      <ul className={'flex items-center flex-wrap'}>
                        {schoolData?.featured &&
                          schoolData?.featured.map((item, index) => {
                            return (
                              <li
                                key={index}
                                className={
                                  'flex items-start gap-[8px] mb-[1.6rem] text-body-16 font-[400] md:w-[50%] w-full leading-[24px]'
                                }
                              >
                                <Icon name={EIconName.Check} /> {item}
                              </li>
                            );
                          })}
                      </ul>
                    </Skeleton>
                  </div>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div id={'city'} className={'pt-[3rem]'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Thành phố
                      </h4>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: schoolData?.map?.iframe,
                        }}
                      />
                      <div
                        className={
                          'relative my-[3.5rem] rounded-sm md:p-[2.4rem] p-[1.6rem] bg-style-8'
                        }
                      >
                        <h5
                          className={'mb-[1.6rem] text-button-16 text-style-7'}
                        >
                          {schoolData?.map?.title}
                        </h5>
                        <div
                          className={'text-body-16 text-style-7 leading-9'}
                          dangerouslySetInnerHTML={{
                            __html: schoolData?.map?.content,
                          }}
                        />
                        <Link
                          href={schoolData?.map?.link || '/'}
                          target={'_blank'}
                          className={'text-button-16 text-orange'}
                        >
                          Xem trên bản đồ
                        </Link>
                      </div>
                    </div>
                  </Skeleton>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div className={'pt-[4rem]'} id={'cosovatchat'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Cơ Sở Vật Chất
                      </h4>
                      <Infrastructure
                        data={schoolData?.program}
                        after_college={school?.content}
                      />
                    </div>
                  </Skeleton>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div className={'py-[2rem]'} id={'chuongtrinhgiangday'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Chương trình giảng dạy
                      </h4>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: schoolData?.infrastructure,
                        }}
                      />
                    </div>
                  </Skeleton>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div id={'hocphi'} className={'py-[4rem]'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Học phí
                      </h4>
                      <Tution data={schoolData?.tuition} />
                    </div>
                  </Skeleton>
                  <Skeleton loading={loading}>
                    <div id={'hocbong'} className={'pt-[4rem]'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Học bổng
                      </h4>
                      <div className={''}>
                        <Scholarship data={schoolData?.scholarship} />
                      </div>
                    </div>
                  </Skeleton>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div id={'khoahoc'} className={'pt-[4rem]'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Khóa học
                      </h4>
                      <Course
                        school_id={schoolData?.id}
                        hasDocument={hasDocument}
                        data={schoolData?.courses}
                      />
                    </div>
                  </Skeleton>
                  <Skeleton className={'my-[5rem]'} loading={loading}>
                    <div id={'yeucaudauvao'} className={'pt-[4rem]'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Yêu cầu đầu vào
                      </h4>
                      <InputRequest data={schoolData?.required} />
                    </div>
                  </Skeleton>
                  <Gallery loading={loading} gallery={gallery} />
                  <Skeleton loading={loading}>
                    <div className={'py-[4rem]'} id={'review'}>
                      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>
                        Đánh Giá Của Học Viên
                      </h4>
                      <Review data={schoolData?.feed_back} />
                    </div>
                  </Skeleton>
                </div>
              </Col>
              <Col lg={{ span: 8 }} className={'hidden lg:block'}>
                <div
                  className={`sticky top-[15rem] bg-white rounded-sm p-[3rem] shadow-md ${
                    loading ? 'h-[79.4rem]' : ''
                  }`}
                >
                  <Skeleton loading={loading}>
                    <div>
                      <iframe
                        className={'w-full'}
                        width="560"
                        height="224"
                        src={schoolData?.video_url}
                        title="YouTube video player"
                        frameBorder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerPolicy="strict-origin-when-cross-origin"
                        allowFullScreen
                      ></iframe>
                    </div>
                    <ul className={'mt-[2.7rem]'}>
                      {itemsMenu &&
                        itemsMenu.map((item) => {
                          return (
                            <li
                              key={item?.key}
                              onClick={() => handleScroll(item?.key)}
                              className={`cursor-pointer ${
                                item?.key === itemMenuActive
                                  ? 'sidebarSchoolActive relative'
                                  : ''
                              }`}
                            >
                              <span
                                className={
                                  'text-body-16 text-style-9 p-[1.6rem_.8rem] block w-full  hover:text-orange'
                                }
                                style={{ borderBottom: '1px solid #edeef2' }}
                              >
                                {item?.label}
                              </span>
                            </li>
                          );
                        })}
                    </ul>
                    <Flex
                      className={'mt-[3rem] mb-[2.8rem]'}
                      justify={'center'}
                      gap={'small'}
                    >
                      <ButtonComponent
                        iconName={EIconName.Compare}
                        iconColor={EIconColor.WHITE}
                        title={'So sánh'}
                        className={'primary w-[15rem] px-0'}
                        widthIcon={35}
                        heightIcon={35}
                      />
                      <ButtonComponent
                        iconName={EIconName.Favorite}
                        title={'Yêu thích'}
                        className={'default w-[15rem] px-0'}
                        widthIcon={20}
                        onClick={() => {
                          if (!isLogin) {
                            showNotification(
                              ETypeNotification.INFO,
                              'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                            );
                          } else {
                            onAddSchoolFavorite(schoolData?.id);
                          }
                        }}
                      />
                    </Flex>
                    <Flex justify={'center'} gap={50}>
                      <Link
                        href={'/'}
                        className={
                          'text-center text-body-16 text-style-10 font-[600] underline'
                        }
                      >
                        Tải tài liệu
                      </Link>
                      <Link
                        href={'/submit-profile'}
                        className={
                          'text-center text-body-16 text-style-10 font-[600] underline'
                        }
                      >
                        Nộp hồ sơ
                      </Link>
                    </Flex>
                  </Skeleton>
                </div>
              </Col>
            </Row>
          </Container>
        </section>
      </div>
    </GuestLayout>
  );
};
export async function getServerSideProps(context) {
  try {
    const { slug } = context.params;
    const agent = new https.Agent({
      rejectUnauthorized: false,
    });
    const response = await getSchoolDetailBySlug(slug[0], agent);
    const data = response?.data?.data?.data;
    return {
      props: {
        schoolDetail: {
          thumbnail: data?.banner ? data?.banner : '',
          meta_title: data?.meta_title,
          meta_description: data?.meta_description,
          robots: data?.is_index,
          link: data?.link_seo,
        },
      },
    };
  } catch (error) {
    return {
      props: {
        schoolDetail: null,
        error: error.message,
      },
    };
  }
}
export default SchoolDetail;
