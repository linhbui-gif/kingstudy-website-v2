import React from 'react';

import { Breadcrumb, Col, Row } from 'antd';
import SkeletonImage from 'antd/es/skeleton/Image';
import Link from 'next/link';

import Container from '@/containers/Container';
import { rootUrl } from '@/utils/utils';

const HeroBannerText = ({ data, loading = false }) => {
  return (
    <>
      {loading ? (
        <div className={'loading-image-hero-text'}>
          <SkeletonImage active />
        </div>
      ) : (
        <div
          className="banner relative flex items-center  min-h-[35rem] z-[2] after:absolute after:content-[''] after:w-full after:h-full after:left-0 after:top-0 after:bg-style-7 after:opacity-[.7] after:z-[-1]"
          style={{
            backgroundImage: `url(${rootUrl}/${data?.banner})`,
            backgroundSize: 'cover',
          }}
        >
          <Container>
            <Row>
              <Col span={24}>
                <h2 className={'text-white md:text-[5.6rem] text-[3.2rem]'}>
                  {data?.name}
                </h2>
                <Breadcrumb
                  items={[
                    {
                      title: 'Trang chủ',
                    },
                    {
                      title: <Link href="/school">Danh sách trường</Link>,
                    },
                    {
                      title: data?.name,
                    },
                  ]}
                />
              </Col>
            </Row>
          </Container>
        </div>
      )}
    </>
  );
};
export default HeroBannerText;
