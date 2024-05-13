import React, { useState } from 'react';

import { Col, Flex, Row, Select } from 'antd';

import ImageSchool from '@/assets/images/image-school.webp';
import Card from '@/components/Card';
import Tag from '@/components/Tag';
import {
  dataCountryOptions,
  ECountryTab,
} from '@/components/Tag/Country.Tab.data';
import Container from '@/containers/Container';

const SchoolGrid = () => {
  const [getCountryParamsRequest, setGetCountryParamsRequest] = useState({
    filter_type: ECountryTab.ALL,
  });
  const selectedValue = getCountryParamsRequest?.filter_type;
  const selectedOption = dataCountryOptions.find(
    (option) => option.value === selectedValue
  );

  const handleTabChange = (option) => {
    const selectedTabValue = option?.value;

    setGetCountryParamsRequest({
      ...getCountryParamsRequest,
      filter_type: selectedTabValue,
    });
  };
  return (
    <section className={'lg:py-[15rem] py-[5rem] bg-style-13'}>
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
                value={selectedOption}
                options={dataCountryOptions}
                onChange={handleTabChange}
                className={'hidden lg:flex'}
              />
              <Select
                placeholder={'Tất cả'}
                allowClear
                options={dataCountryOptions}
                className={'w-[12rem] lg:hidden block'}
                showSearch
                filterOption={(input, option) =>
                  (option?.label.toLowerCase() ?? '').includes(
                    input.toLowerCase()
                  )
                }
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
          <Col span={20} lg={{ span: 8 }} md={{ span: 12 }}>
            <Card
              url={ImageSchool}
              title={'Anglia Ruskin University'}
              alt={'Anglia Ruskin University'}
            />
          </Col>
          <Col span={20} lg={{ span: 8 }} md={{ span: 12 }}>
            <Card
              url={ImageSchool}
              title={'Anglia Ruskin University'}
              alt={'Anglia Ruskin University'}
            />
          </Col>
          <Col span={20} lg={{ span: 8 }} md={{ span: 12 }}>
            <Card
              url={ImageSchool}
              title={'Anglia Ruskin University'}
              alt={'Anglia Ruskin University'}
            />
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default SchoolGrid;
