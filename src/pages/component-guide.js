import React, { useState, useEffect } from 'react';

import { Avatar, Form, Select, Typography } from 'antd';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Tag from '@/components/Tag';
import { dataCountryOptions } from '@/components/Tag/Country.Tab.data';
import { ECountryTab } from '@/components/Tag/Country.Tab.data';
import { dataCountries } from '@/components/Tag/Country.Tab.data';
import Container from '@/containers/Container';
import Partner from '@/containers/Partner';
const items = ['apple', 'King of fruits', 'Orange'];
const { Option } = Select;

const ComponentGuide = () => {
  const [getCountryParamsRequest, setGetCountryParamsRequest] = useState({
    filter_type: ECountryTab.ALL,
  });
  const [data, setData] = useState(dataCountries);
  const handleTabChange = (option) => {
    const selectedTabValue = option?.value;

    setGetCountryParamsRequest({
      ...getCountryParamsRequest,
      filter_type: selectedTabValue,
    });
  };
  // useEffect(() => {
  //   const selectedCountry = dataCountries.find(
  //     (country) => country.content === getCountryParamsRequest.filter_type
  //   );
  //   if (selectedCountry) {
  //     setCountryContent(selectedCountry.content);
  //   }
  // }, [getCountryParamsRequest]);
  const selectedValue = getCountryParamsRequest?.filter_type;
  const selectedOption = dataCountryOptions.find(
    (option) => option.value === selectedValue
  );
  useEffect(() => {
    const updatedData =
      getCountryParamsRequest.filter_type === ECountryTab.ALL
        ? dataCountries
        : dataCountries.filter(
            (country) => country.content === getCountryParamsRequest.filter_type
          );

    setData(updatedData);
  }, [getCountryParamsRequest]);
  // const [data, setData] = useState([]);
  // const [loading, setLoading] = useState([]);
  // const [filter, setFilter] = useState({
  //   page: 1,
  //   limit: 15,
  // });
  // const getListSchools = async () => {
  //   try {
  //     setLoading(true);
  //     const response = await getListSchool(filter);
  //     if (response?.code === 200) {
  //       setLoading(false);
  //       // eslint-disable-next-line no-unsafe-optional-chaining
  //       setData((prev) => [...prev, ...response?.data?.data]);
  //     }
  //   } catch (e) {
  //     /* empty */
  //   }
  // };
  // useEffect(() => {
  //   getListSchools().then();
  // }, [filter.page, filter.limit]);
  // const LoadingSkeletonCards = () => {
  //   return <CardSkeleton />;
  // };
  // const onLoadMore = () => {
  //   setFilter((prev) => {
  //     return { ...filter, limit: 15, page: prev.page + 1 };
  //   });
  // };

  return (
    <>
      <div className="container px-4 mx-auto">
        <div>
          <Typography.Title level={3}>Button Component</Typography.Title>
          <ButtonComponent title={'Đăng Ký'} className={'orange mt-3 ml-4'} />
          <ButtonComponent
            title={'Đăng Ký'}
            className={'primary mt-3 ml-4'}
            loading={false}
          />
          <ButtonComponent
            title={'Đăng Ký'}
            className={'primary-outline mt-3 ml-4'}
            loading={true}
          />
          <ButtonComponent
            title={'Đăng Ký'}
            className={'primary mt-3 ml-4'}
            secondIconName={EIconName.Arrow_Right}
          />
        </div>
        <div>
          <Typography.Title level={3}>Input Component</Typography.Title>
          <Form>
            <Form.Item name={'name'}>
              <Input
                className={'input-suffix'}
                placeholder={'Input Has Icon'}
                suffix={<Icon name={EIconName.Search} />}
              />
            </Form.Item>
            <Form.Item name={'email'}>
              <Input allowClear style={'mt-4'} placeholder={'Input Text'} />
            </Form.Item>
            <Form.Item name={'phone'}>
              <Input numberic style={'mt-4'} placeholder={'Input Numeric'} />
            </Form.Item>
            <Form.Item name={'price'}>
              <Input
                numberWithSeperator
                useNumber
                numberic
                style={'mt-4'}
                placeholder={'Input price format'}
                suffix={'đ'}
              />
            </Form.Item>
            <Form.Item name={'subribe'}>
              <Input
                style={'mt-4'}
                placeholder={'Input subribe'}
                suffix={
                  <ButtonComponent
                    title={'Subscribe'}
                    className={'primary'}
                    secondIconName={EIconName.Twitter}
                  />
                }
              />
            </Form.Item>
          </Form>
        </div>
        <div>
          <Tag
            value={selectedOption}
            options={dataCountryOptions}
            onChange={handleTabChange}
          />
        </div>
        <div className="container p-4 mx-auto ml-20px text-red text-[1.6rem]">
          {data.map((country) => (
            <div key={country.id} className="mr-6">
              {country.content}
            </div>
          ))}
        </div>
        <Container>
          <Select placeholder="Please select store" style={{ width: '100%' }}>
            {items.map((item) => (
              <Option key={item} value={item} label={item}>
                <div>
                  <Avatar size="small" style={{ background: '#10899e' }}>
                    {item[0]}
                  </Avatar>{' '}
                  {item}
                </div>
              </Option>
            ))}
          </Select>
        </Container>
      </div>
      {/*<Row gutter={[24, 24]} className={'flex'}>*/}
      {/*  {data &&*/}
      {/*    data.map((element) => {*/}
      {/*      return (*/}
      {/*        <Col span={24} md={{ span: 6 }} key={element?.id}>*/}
      {/*          {loading ? LoadingSkeletonCards() : ''}*/}
      {/*          {!loading && (*/}
      {/*            <Card*/}
      {/*              url={'https://kingstudy.vn' + element?.logo}*/}
      {/*              title={element?.name}*/}
      {/*              description={element?.heading}*/}
      {/*              alt={element?.name}*/}
      {/*            />*/}
      {/*          )}*/}
      {/*        </Col>*/}
      {/*      );*/}
      {/*    })}*/}
      {/*  <Col span={24}>*/}
      {/*    <div className={'w-full flex items-center justify-center'}>*/}
      {/*      {' '}*/}
      {/*      <Button type={'primary'} onClick={onLoadMore}>*/}
      {/*        Load more*/}
      {/*      </Button>*/}
      {/*    </div>*/}
      {/*  </Col>*/}
      {/*</Row>*/}
      <Partner />
    </>
  );
};
export default ComponentGuide;
