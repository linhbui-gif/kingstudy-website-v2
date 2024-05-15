import React, { useEffect } from 'react';

import { Col, Row } from 'antd';
import { useRouter } from 'next/router';

import ImageSchool from '@/assets/images/image-school.jpg';
import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import FilterTools from '@/containers/FilterTools';
import { useAPI } from '@/contexts/APIContext';
import GuestLayout from '@/layouts/GuestLayout';

const SchoolList = () => {
  const router = useRouter();
  const { majors } = router.query;
  const { schoolList, loading, setFilterSchool, filterSchool } = useAPI();
  useEffect(() => {
    if (majors) {
      setFilterSchool({
        ...filterSchool,
        majors: majors,
      });
    }
  }, [majors]);
  return (
    <section className={'lg:mt-[10rem] mt-[5rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col
            span={24}
            xl={{ span: 6 }}
            className={'xl:block xl:sticky hidden'}
          >
            <aside className="sticky top-[10.5rem]">
              <FilterTools
                onFilterChange={(dataChanged) => {
                  setFilterSchool({
                    ...filterSchool,
                    ...dataChanged,
                  });
                }}
                paramsRequest={filterSchool}
                className={''}
                onReset={(dataReset) => {
                  setFilterSchool({
                    ...dataReset,
                    majors: majors,
                  });
                }}
              />
            </aside>
          </Col>
          <Col span={24} lg={{ span: 24 }} xl={{ span: 18 }}>
            <Row gutter={[24, 24]}>
              <Col span={24}>
                <h3 className={'text-body-18'}>Danh sách trường</h3>
              </Col>
              {schoolList.length === 0 ? (
                <Col span={24}>
                  <div className={'flex items-center justify-center flex-col'}>
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
                          url={ImageSchool}
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
      <GuestLayout>
        <Meta title={'Danh sách trường'} />
        {page}
      </GuestLayout>
    </>
  );
};
