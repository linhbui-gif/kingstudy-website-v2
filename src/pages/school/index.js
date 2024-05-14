import React from 'react';

import { Col, Row } from 'antd';

import ImageSchool from '@/assets/images/image-school.webp';
import Card from '@/components/Card';
import Container from '@/containers/Container';
import FilterTools from '@/containers/FilterTools';
import GuestLayout from '@/layouts/GuestLayout';

const SchoolList = () => {
  return (
    <section className={'lg:mt-[10rem] mt-[5rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24} xl={{ span: 6 }} className={'xl:block hidden'}>
            <aside>
              <FilterTools className={''} />
            </aside>
          </Col>
          <Col span={24} lg={{ span: 24 }} xl={{ span: 18 }}>
            <Row gutter={[24, 24]}>
              <Col
                span={24}
                xl={{ span: 8 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
              >
                <Card
                  url={ImageSchool}
                  title={'Anglia Ruskin University'}
                  alt={'Anglia Ruskin University'}
                />
              </Col>
              <Col
                span={24}
                xl={{ span: 8 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
              >
                <Card
                  url={ImageSchool}
                  title={'Anglia Ruskin University'}
                  alt={'Anglia Ruskin University'}
                />
              </Col>
              <Col
                span={24}
                xl={{ span: 8 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
              >
                <Card
                  url={ImageSchool}
                  title={'Anglia Ruskin University'}
                  alt={'Anglia Ruskin University'}
                />
              </Col>
            </Row>
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default SchoolList;
SchoolList.getLayout = function (page) {
  return (
    <>
      <GuestLayout>{page}</GuestLayout>
    </>
  );
};
