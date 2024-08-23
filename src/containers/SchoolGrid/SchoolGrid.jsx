import React from 'react';

import { Col, Flex, Row, Select } from 'antd';

import ImageSchool from '@/assets/images/image-school.jpg';
import ButtonComponent from '@/components/Button';
import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import Tag from '@/components/Tag';
import Container from '@/containers/Container';
import { useAPI } from '@/contexts/APIContext';
import { rootUrl } from '@/utils/utils';
const SchoolGrid = () => {
  const { schoolList, loading, setFilterSchool, filterSchool, countries } =
    useAPI();
  const schoolListSixItem = schoolList.slice(-6);
  const selectedTagCountries = () => {
    const selectedCountries =
      countries &&
      countries.find((option) => option.value === filterSchool?.country);
    if (!selectedCountries) return countries?.[1];
    return selectedCountries;
  };
  return (
    <section className={'py-[7rem] bg-style-13'}>
      <Container>
        <Row gutter={[24, 24]} className={'lg:mb-[5rem] mb-[1.6rem]'}>
          <Col span={24}>
            <Flex align={'center'} justify={'space-between'}>
              <h2
                className={
                  'lg:text-title-36 text-[2rem] font-[700] text-style-7 mb-0'
                }
              >
                Quốc Gia Du Học
              </h2>
              <Tag
                value={selectedTagCountries()}
                options={countries}
                onChange={(option) => {
                  const selectedTabValue = option?.value;

                  setFilterSchool({
                    page: 1,
                    limit: 15,
                    country: selectedTabValue,
                  });
                }}
                className={'hidden lg:flex'}
              />
              <Select
                value={selectedTagCountries()}
                placeholder={'Tất cả'}
                allowClear
                options={countries || []}
                className={'w-[12rem] lg:hidden block'}
                showSearch
                filterOption={(input, option) =>
                  (option?.label.toLowerCase() ?? '').includes(
                    input.toLowerCase()
                  )
                }
                onChange={(option) => {
                  setFilterSchool({
                    ...filterSchool,
                    country: option,
                  });
                }}
              />
            </Flex>
          </Col>
        </Row>
        <Row
          gutter={[24, 24]}
          className={
            'lg:overflow-x-visible overflow-x-scroll flex-nowrap lg:flex-wrap'
          }
        >
          {schoolList.length === 0 ? (
            <Col span={24}>
              <div className={'flex items-center justify-center'}>
                <Empty />
              </div>
            </Col>
          ) : (
            ''
          )}
          {schoolListSixItem &&
            schoolListSixItem.map((school) => {
              return (
                <Col
                  span={20}
                  lg={{ span: 8 }}
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
                    />
                  )}
                </Col>
              );
            })}
          <Col span={24}>
            <div className={'flex justify-center w-full'}>
              <ButtonComponent
                title={'Xem thêm'}
                className={'primary-outline mt-[4rem]'}
                loading={false}
                link={`/school`}
              />
            </div>
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default SchoolGrid;
