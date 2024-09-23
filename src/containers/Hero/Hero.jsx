import React from 'react';

import { Col, Row } from 'antd';
import Image from 'next/image';
import { useRouter } from 'next/router';
import { useMediaQuery } from 'react-responsive';

import ImageHeroShape5 from '@/assets/images/image-hero-shape-5.webp';
import ImageHeroShape6 from '@/assets/images/image-hero-shape-6.png';
import ImageHeroBagde from '@/assets/images/image-hero-shape-8.png';
import ImageHeroShape6Mobile from '@/assets/images/image-shape-6-mobile.svg';
import ImageShape7 from '@/assets/images/image-shape-7.png';
import ButtonComponent from '@/components/Button';
import Container from '@/containers/Container';
import { useAPI } from '@/contexts/APIContext';
const Hero = () => {
  const { setParamMajor } = useAPI();
  const router = useRouter();
  const isMobile = useMediaQuery({ maxWidth: 767 });
  return (
    <section
      className={
        'relative flex items-center lg:h-[90rem] md:bg-[80%_0] md:h-[84rem] h-[37.5rem] bg-[80%]'
      }
      style={{
        backgroundImage: isMobile
          ? "url('')"
          : "url('/images/image-hero3.webp')",
        backgroundSize: 'cover',
      }}
    >
      {/*<Image*/}
      {/*  quality={100}*/}
      {/*  loading={'lazy'}*/}
      {/*  width={212}*/}
      {/*  height={179}*/}
      {/*  className={*/}
      {/*    'absolute top-[46%] left-[2rem] md:top-[50%] md:left-0 md:w-auto md:h-auto w-[5rem] h-[4rem]'*/}
      {/*  }*/}
      {/*  src={ImageArrowHero}*/}
      {/*  alt={'image-hero'}*/}
      {/*/>*/}
      <Container>
        <Row>
          <Col span={24} md={{ span: 14 }} lg={{ span: 12 }}>
            <div className="hero-text">
              <h5
                className={
                  'md:text-body-18 text-body-14 font-[600] text-style-10'
                }
              >
                Cùng KingStudy
              </h5>
              <h2
                className={
                  'mt-[1.8rem] mb-[3.8rem] 2xl:text-title-50 md:text-[3.6rem] text-[2rem] font-[700] text-style-7'
                }
              >
                Khám phá những ngôi trường nằm trong “Wishlist” của bạn!
              </h2>
              <p
                className={
                  'mt-[1.6rem] mb-[3rem] text-body-16 text-style-7 hidden md:block leading-9'
                }
              >
                Với hơn 20+ tiêu chí được các chuyên gia KingStudy tuyển chọn và
                đánh giá kỹ lưỡng, bạn chắc chắn sẽ tìm kiếm được ngôi trường
                dành-riêng-cho- mình.
              </p>
              <ButtonComponent
                title={'Khám phá danh sách trường'}
                className={'orange md:w-auto'}
                onClick={() => {
                  setParamMajor(null);
                  router.push('/school');
                }}
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
                className={
                  'absolute 2xl:top-[32rem] lg:left-[-7rem] lg:top-[21rem] animate-hero-thumb-sm-2-animation'
                }
                src={ImageHeroShape6}
                alt={''}
                width={300}
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
              <div className="shape-4 absolute 2xl:top-[28.5rem] 2xl:left-[70%] lg:right-[-8rem] lg:top-[14rem] rounded-[12px] text-center animate-hero-thumb-sm-3-animation">
                <Image
                  quality={100}
                  priority
                  src={ImageHeroBagde}
                  alt={''}
                  width={400}
                />
              </div>
              <div className="shape-5 absolute lg:bottom-[-14rem] 2xl:right-[-34%] lg:right-[-3rem] animate-hero-thumb-sm-2-animation">
                <Image
                  quality={100}
                  priority
                  src={ImageShape7}
                  alt={''}
                  width={400}
                />
              </div>
            </div>
          </Col>
          <Col
            md={{ span: 24 }}
            lg={{ span: 12 }}
            className={'md:hidden hidden'}
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
