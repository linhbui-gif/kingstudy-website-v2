import React, { useEffect, useState } from 'react';

import { Col, Flex, Form, Row, Select, Spin } from 'antd';
import Image from 'next/image';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import { useAPI } from '@/contexts/APIContext';
import { getLevelCourse } from '@/services/common';
import { validationRules } from '@/utils/function';
import { changeArrayToOptions, rootUrl } from '@/utils/utils';

const StepInformation = ({ onNext }) => {
  const [levelCourse, setLevelCourse] = useState([]);
  const { countries, profileState, getProfileInfor, loadingGetProfileState } =
    useAPI();
  const [form] = Form.useForm();
  const englishSkills = [
    {
      label: 'IELTS',
      value: 'IELTS',
    },
    {
      label: 'Dưới 5.5',
      value: '5',
    },
    {
      label: '5.5 đến 7.0',
      value: '6',
    },
    {
      label: 'Trên 7.0',
      value: '7',
    },
  ];
  const onSubmit = (values) => {
    onNext?.({ ...values });
  };
  const getLevel = async () => {
    try {
      const response = await getLevelCourse();
      if (response?.code === 200) {
        const levelOption = changeArrayToOptions(response?.data?.level);
        setLevelCourse(levelOption);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    getLevel().then();
    getProfileInfor().then();
  }, []);
  useEffect(() => {
    if (!profileState) {
      return;
    }
    form.setFieldsValue({
      full_name: profileState?.profile?.name,
      country_id: profileState?.profile?.country_id,
      phone: profileState?.profile?.phone,
      level_id: profileState?.profile?.level?.id,
      english_skill: profileState?.profile?.english_skill,
      email: profileState?.profile?.email,
    });
  }, []);
  return (
    <div className={'my-[3rem]'}>
      <Spin spinning={loadingGetProfileState}>
        <Form layout={'vertical'} onFinish={onSubmit} form={form}>
          <Row>
            <Col span={12}>
              <Form.Item
                label={'Họ & Tên'}
                required
                name={'full_name'}
                rules={[validationRules.required('')]}
              >
                <Input placeholder={'Nhập họ tên...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Quốc gia du học'} name={'country_id'}>
                <Select
                  allowClear
                  showSearch
                  placeholder="Nhập Quốc Gia..."
                  className={'w-full mb-5 h-[5.5rem]'}
                  suffixIcon={
                    <Icon
                      name={EIconName.ArowDown}
                      color={EIconColor.STYLE_7}
                    />
                  }
                >
                  {countries &&
                    countries.map((item) => (
                      <Select.Option
                        key={item?.value}
                        value={item?.value}
                        label={item?.label}
                      >
                        <Flex align={'center'} gap={'small'}>
                          <Image
                            quality={100}
                            src={`${rootUrl}${item?.icon}`}
                            alt={''}
                            width={24}
                            height={24}
                          />
                          {item?.label}
                        </Flex>
                      </Select.Option>
                    ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label={'Số điện thoại'}
                required
                name={'phone'}
                rules={[validationRules.required('')]}
              >
                <Input numberic placeholder={'Nhập số điện thoại...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Bậc học'} name={'level_id'}>
                <Select
                  options={levelCourse}
                  placeholder={'Bậc học'}
                  className={'h-[5.5rem]'}
                  suffixIcon={
                    <Icon
                      name={EIconName.ArowDown}
                      color={EIconColor.STYLE_7}
                    />
                  }
                  allowClear
                  showSearch
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label={'Email'}
                required
                name={'email'}
                rules={[validationRules.required('')]}
              >
                <Input placeholder={'Nhập Email...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Điểm IELTS'} name={'english_skill'}>
                <Select
                  options={englishSkills}
                  placeholder={'Điểm IELTS'}
                  className={'h-[5.5rem]'}
                  suffixIcon={
                    <Icon
                      name={EIconName.ArowDown}
                      color={EIconColor.STYLE_7}
                    />
                  }
                  allowClear
                  showSearch
                />
              </Form.Item>
            </Col>
            <Col span={24}>
              <ButtonComponent
                title={'Tiếp theo'}
                className={'primary min-w-[16rem]'}
                htmlType={'submit'}
              />
            </Col>
          </Row>
        </Form>
      </Spin>
    </div>
  );
};
export default StepInformation;
