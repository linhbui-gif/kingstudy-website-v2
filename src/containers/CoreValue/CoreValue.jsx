import React from 'react';

import { Col, Row } from 'antd';
import Image from 'next/image';

import ImageAboutGallery from '@/assets/images/gallary-06.jpg';
import Container from '@/containers/Container';
const CoreValue = ({ title, data = [] }) => {
  return (
    <div className={'py-[9rem]'}>
      <Container>
        <h2
          className={
            'lg:text-title-36 text-[2rem] font-[700] text-style-7 mb-[6rem] text-center'
          }
        >
          {title}
        </h2>
        <Row>
          {data &&
            data.map((element) => {
              return (
                <Col lg={{ span: 8 }} span={24} key={element}>
                  <div
                    className={
                      'relative mb-[3rem] text-center group cursor-pointer overflow-hidden rounded-sm'
                    }
                  >
                    <div className="relative before:absolute before:content-[''] before:top-0 before:left-0 before:w-full before:h-full gradient-black-before ">
                      <Image
                        src={element['image_location'] || ImageAboutGallery}
                        alt={'/'}
                        loading={'lazy'}
                        layout={'responsive'}
                        width={410}
                        height={300}
                      />
                    </div>
                    <div
                      className={
                        'absolute bottom-[2rem] left-1/2 text-white -translate-x-1/2 text-center text-title-20'
                      }
                    >
                      {element?.['locale_vi']?.['title'] || ''}
                    </div>
                  </div>
                </Col>
              );
            })}
        </Row>
      </Container>
    </div>
  );
};
export default CoreValue;
