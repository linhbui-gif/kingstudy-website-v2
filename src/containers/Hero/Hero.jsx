import React from 'react';

import { Col, Row } from 'antd';
import Image from 'next/image';
import { useMediaQuery } from 'react-responsive';

import ImageArrowHero from '@/assets/images/image-hero-arrow.webp';
import ImageHeroAvatar from '@/assets/images/image-hero-avatar.webp';
import ImageHeroBagde from '@/assets/images/image-hero-bagde.svg';
import ImageHeroShape5 from '@/assets/images/image-hero-shape-5.webp';
import ImageHeroShape6 from '@/assets/images/image-hero-shape-6.svg';
import ImageHeroShape6Mobile from '@/assets/images/image-shape-6-mobile.svg';
import ButtonComponent from '@/components/Button';
import Container from '@/containers/Container';
const Hero = () => {
  const isMobile = useMediaQuery({ maxWidth: 767 });
  return (
    <section
      className={
        'relative flex items-center lg:h-[90rem] md:bg-[80%_0] md:h-[84rem] h-[37.5rem] bg-[80%]'
      }
      style={{
        backgroundImage: isMobile
          ? "url('/images/image-banner-home-mobile.webp')"
          : "url('/images/image-hero.webp')",
        backgroundSize: 'cover',
      }}
    >
      <Image
        quality={100}
        loading={'lazy'}
        width={212}
        height={179}
        className={
          'absolute top-[46%] left-[2rem] md:top-[50%] md:left-0 md:w-auto md:h-auto w-[5rem] h-[4rem]'
        }
        src={ImageArrowHero}
        alt={'image-hero'}
      />
      <Container>
        <Row>
          <Col span={14} md={{ span: 14 }} lg={{ span: 12 }}>
            <div className="hero-text">
              <h5
                className={
                  'md:text-body-18 text-body-14 font-[600] text-style-10'
                }
              >
                Khám phá hành trình của bạn
              </h5>
              <h2
                className={
                  'mt-[1.8rem] mb-[3.8rem] lg:text-title-50 md:text-[3.6rem] text-[1.6rem] font-[700] text-style-7'
                }
              >
                Khám phá 4500+ Khóa học từ những Giảng viên hàng đầu trên khắp
                Thế giới
              </h2>
              <p
                className={
                  'mt-[1.6rem] mb-[3rem] text-body-16 text-style-7 hidden md:block'
                }
              >
                Đưa tổ chức học tập của bạn lên một tầm cao mới. Chia sẻ kiến
                thức tới mọi người trên khắp thế giới.
              </p>
              <ButtonComponent
                title={'Xem tất cả khóa học'}
                className={'orange w-[19.7rem] md:w-auto'}
              />
            </div>
          </Col>
          <Col
            md={{ span: 24 }}
            lg={{ span: 12 }}
            className={'lg:block hidden'}
          >
            <div className={'hero-right relative'}>
              <Image
                className={'absolute top-[14rem] left-[10%]'}
                src={ImageHeroShape6}
                alt={''}
                width={176}
                height={193}
                quality={100}
                priority
              />
              <Image
                className={
                  'absolute top-[-10rem] left-[10.5rem] animate-hero-circle-1'
                }
                src={ImageHeroShape5}
                alt={''}
                width={64}
                height={59}
                quality={100}
                priority
              />
              <div className="shape-4 absolute top-[33.5rem] left-[15rem] rounded-[12px] bg-white w-[18rem] shadow-md text-center pt-[1.7rem] pb-[2.5rem] animate-hero-thumb-sm-2-animation">
                <Image
                  quality={100}
                  priority
                  src={ImageHeroBagde}
                  alt={''}
                  width={80}
                  height={80}
                />
                <h5
                  className={
                    'text-body-18 text-style-7 max-w-[146px] text-center mx-auto'
                  }
                >
                  Giảng viên <br /> hàng đầu
                </h5>
              </div>
              <div className="shape-5 absolute 2xl:bottom-[-30rem] 2xl:right-[0] lg:right-[-3rem] p-[2rem_2.4rem_1.5rem] bg-white rounded-[12px] shadow-md max-w-[28.3rem] animate-hero-thumb-sm-2-animation">
                <div className={'flex items-center mb-3'}>
                  {[1, 2, 3, 4, 5, 6].map((image) => {
                    return (
                      <Image
                        key={image}
                        className={
                          'shadow-[0_0_10px_rgba(28, 51, 84, .1)] border-4 border-solid border-[#fff] shadow-md mr-[-1.5rem] rounded-full'
                        }
                        quality={100}
                        priority
                        src={ImageHeroAvatar}
                        alt={''}
                        width={30}
                        height={30}
                      />
                    );
                  })}
                </div>
                <h5 className={'font-[400] text-[18px] text-style-7 mb-0'}>
                  Hơn{' '}
                  <span className={'text-body-18 text-style-10'}>21,500+</span>{' '}
                  học viên tham gia khắp thế giới
                </h5>
              </div>
            </div>
          </Col>
          <Col
            md={{ span: 24 }}
            lg={{ span: 12 }}
            className={'md:hidden block'}
          >
            <div className={'hero-right relative'}>
              <Image
                className={
                  'absolute top-[7rem] left-[0] translate-x-[-3rem] translate-y-[-1rem]'
                }
                src={ImageHeroShape6Mobile}
                alt={''}
                width={65}
                height={70}
                quality={100}
                priority
              />
              <Image
                className={
                  'absolute top-[1.5rem] left-[-5.5rem] animate-hero-circle-1 w-[1.5rem] h-[1.5rem]'
                }
                src={ImageHeroShape5}
                alt={''}
                width={64}
                height={59}
                quality={100}
                priority
              />
            </div>
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default Hero;
