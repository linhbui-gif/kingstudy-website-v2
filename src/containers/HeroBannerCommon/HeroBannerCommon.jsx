import React from 'react';

import { Breadcrumb, Col, Row } from 'antd';

import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const HeroBannerCommon = ({ title, items, urlBanner = '' }) => {
  return (
    <>
      <div
        className="banner relative flex items-center min-h-[35rem] z-[2] after:absolute after:content-[''] after:w-full after:h-full after:left-0 after:top-0 after:bg-style-7 after:opacity-[.7] after:z-[-1]"
        style={{
          backgroundImage:
            urlBanner === ''
              ? `url('/images/image-banner-common.png')`
              : `url(${urlBanner})`,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
        }}
      >
        <Container>
          <Row>
            <Col span={24}>
              <h2 className={'text-white md:text-[5.6rem] text-[3.2rem]'}>
                {title}
              </h2>
              <Breadcrumb
                className={'breadcrumb-common'}
                items={items}
                separator={<Icon name={EIconName.ArowDown} />}
              />
            </Col>
          </Row>
        </Container>
      </div>
    </>
  );
};
export default HeroBannerCommon;
