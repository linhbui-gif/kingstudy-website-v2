import React from 'react';

import { Col, Form, Row, Select } from 'antd';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';

const StepInformation = ({ onNext }) => {
  return (
    <div className={'my-[3rem]'}>
      <Form layout={'vertical'}>
        <Row>
          <Col span={12}>
            <Form.Item label={'Họ & Tên'} required name={'full_name'}>
              <Input placeholder={'Nhập họ tên...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Quốc gia du học'} name={'country'}>
              <Select
                options={[]}
                placeholder={'Quốc gia du học'}
                className={'h-[5.5rem]'}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
                allowClear
              />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Số điện thoại'} required name={'phone'}>
              <Input numberic placeholder={'Nhập số điện thoại...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Bậc học'} name={'level_id'}>
              <Select
                options={[]}
                placeholder={'Bậc học'}
                className={'h-[5.5rem]'}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
                allowClear
              />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Email'} required name={'email'}>
              <Input placeholder={'Nhập Email...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Điểm IELTS'} required name={'ielts'}>
              <Select
                options={[]}
                placeholder={'Điểm IELTS'}
                className={'h-[5.5rem]'}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
                allowClear
              />
            </Form.Item>
          </Col>
          <Col span={24}>
            <ButtonComponent
              title={'Tiếp theo'}
              className={'primary min-w-[16rem]'}
              onClick={onNext}
            />
          </Col>
        </Row>
      </Form>
    </div>
  );
};
export default StepInformation;
