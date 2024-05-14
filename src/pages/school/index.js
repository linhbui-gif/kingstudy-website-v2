import React from 'react';

import { Col, Row } from 'antd';

import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import Container from '@/containers/Container';
import FilterTools from '@/containers/FilterTools';
import { useAPI } from '@/contexts/APIContext';
import GuestLayout from '@/layouts/GuestLayout';
import { rootUrl } from '@/utils/utils';

const SchoolList = () => {
  const { schoolList, loading } = useAPI();
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
              {schoolList.length === 0 ? (
                <Col span={24}>
                  <div className={'flex items-center justify-center'}>
                    <Empty />
                  </div>
                </Col>
              ) : (
                ''
              )}
              {schoolList &&
                schoolList.map((school) => {
                  return (
                    <Col
                      span={24}
                      xl={{ span: 8 }}
                      lg={{ span: 12 }}
                      md={{ span: 12 }}
                      key={school?.id}
                    >
                      {loading ? (
                        <CardSkeleton />
                      ) : (
                        <Card
                          url={`${rootUrl}${school?.logo}`}
                          title={school?.name}
                          alt={school?.name}
                          type={school?.type_school}
                        />
                      )}
                    </Col>
                  );
                })}
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
