import React from 'react';

import { Col, Form, Row, Select, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import { dataTuitionOptions } from '@/containers/FilterTools/Tuition.data';

const englishSkills = [
  {
    label: 'Dưới 5.5',
    value: '5.4',
  },
  {
    label: '5.5 đến 7.0',
    value: '5.6',
  },
  {
    label: 'Trên 7.0',
    value: '7.1',
  },
];
const StepEnd = ({ onPrev, loading, onSubmit }) => {
  const handlerSubmit = (values) => {
    onSubmit?.(values);
  };
  return (
    <div className={'my-[3rem]'}>
      <Form layout={'vertical'} onFinish={handlerSubmit}>
        <Row>
          <Col md={{ span: 12 }} span={24}>
            <Form.Item name={'survey_tuition'} label={'Học phí'}>
              <Select
                options={dataTuitionOptions}
                allowClear
                showSearch
                placeholder="Chọn học phí..."
                className={'w-full'}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
              />
            </Form.Item>
          </Col>
          <Col md={{ span: 12 }} span={24}>
            <Form.Item name={'survey_mark_ielts'} label={'Điểm IELTS'}>
              <Select
                options={englishSkills}
                allowClear
                showSearch
                placeholder="Chọn điểm IELTS..."
                className={'w-full'}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
              />
            </Form.Item>
          </Col>
          <Col span={24}>
            <Form.Item
              label={'BẠN CÓ THẮC MẮC GÌ CẦN CÁC TVV CỦA KS TƯ VẤN KHÔNG?'}
              name={'survey_mark_gpa'}
            >
              <Input placeholder={'Nội dung...'} allowClear />
            </Form.Item>
          </Col>
          <Col span={24}>
            <Space>
              <ButtonComponent
                title={'Gửi khảo sát'}
                className={'primary min-w-[16rem] mt-[4rem]'}
                htmlType={'submit'}
                loading={loading}
              />
              <ButtonComponent
                title={'Quay lại'}
                className={'primary-outline md:min-w-[16rem] mt-[4rem]'}
                onClick={onPrev}
              />
            </Space>
          </Col>
        </Row>
      </Form>
    </div>
  );
};
export default StepEnd;
