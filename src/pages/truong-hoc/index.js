import React, { useEffect, useState } from 'react';

import { Col, Row } from 'antd';
import { useRouter } from 'next/router';

import ImageSchool from '@/assets/images/image-school.jpg';
import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Meta from '@/components/Meta';
import PaginationV2 from '@/components/PaginationV2';
import Container from '@/containers/Container';
import FilterTools from '@/containers/FilterTools';
import { useAPI } from '@/contexts/APIContext';
import GuestLayout from '@/layouts/GuestLayout';
import { rootUrl } from '@/utils/utils';
const SchoolList = () => {
  const router = useRouter();
  const { majors, country_id } = router.query;
  const { schoolList, loading, setFilterSchool, filterSchool, totalSchool } =
    useAPI();
  const [countFilter, setCountFilter] = useState(0);
  const handlePageChange = (page) => {
    setFilterSchool({
      ...filterSchool,
      page: page,
    });
  };
  useEffect(() => {
    if (majors) {
      setFilterSchool({
        ...filterSchool,
        majors: majors,
      });
    }
  }, [majors]);
  useEffect(() => {
    if (filterSchool) {
      const filterScholLength = { ...filterSchool };
      delete filterScholLength['page'];
      delete filterScholLength['limit'];
      setCountFilter(Object.keys(filterScholLength)?.length);
    }
  }, [filterSchool]);

  useEffect(() => {
    if (country_id) {
      setFilterSchool({
        ...filterSchool,
        country: country_id,
      });
    }
  }, [country_id]);
  const onShowSizeChange = (current, limit) => {
    setFilterSchool({
      ...filterSchool,
      page: current,
      limit: limit,
    });
  };
  return (
    <section className={'lg:mt-[10rem] mt-[5rem]'}>
      <Container>
        <Row gutter={[24, 24]} className={'mb-[2.4rem]'} align={'center'}>
          <Col span={24} lg={{ span: 5 }}>
            <div
              className={
                'flex items-center h-full px-[1.6rem] text-body-16 text-white bg-style-10 rounded-sm'
              }
            >
              <Icon
                className={'w-[4rem] h-[4rem]'}
                name={EIconName.Filter}
                color={EIconColor.WHITE}
              />
              <span>Filter ({countFilter})</span>
            </div>
          </Col>
          <Col span={24} lg={{ span: 8 }}>
            <Input
              className={'input-suffix min-w-[26.8rem]'}
              placeholder={'Tìm trường học...'}
              prefix={<Icon name={EIconName.Search} />}
              onSearch={(keyword) => {
                setFilterSchool({
                  ...filterSchool,
                  keywords: keyword,
                });
              }}
              allowClear
            />
          </Col>
          <Col span={24} lg={{ span: 11 }}>
            <div
              className={
                'flex items-center h-full border border-solid border-style-8 lg:px-[2rem] p-[1.6rem] text-body-16 rounded-sm'
              }
            >
              Hiển thị {schoolList?.length} kết quả
            </div>
          </Col>
        </Row>
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
                  });
                }}
              />
            </aside>
          </Col>
          <Col span={24} lg={{ span: 24 }} xl={{ span: 18 }}>
            <Row gutter={[24, 24]}>
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
                      className="flex flex-col "
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
                          url={
                            school?.thumbnail
                              ? rootUrl + school?.thumbnail
                              : ImageSchool
                          }
                          title={school?.name}
                          alt={school?.name}
                          type={school?.type_school}
                          country={school?.country}
                          slug={school?.slug}
                          id={school?.id}
                          price={school?.price}
                        />
                      )}
                    </Col>
                  );
                })}
            </Row>
            <div className="my-[4.0rem] lg:mt-[2.4rem]">
              <PaginationV2
                showSizeChanger={false}
                pages={filterSchool}
                onChange={handlePageChange}
                onChangeSize={onShowSizeChange}
                total={totalSchool}
              />
            </div>
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
