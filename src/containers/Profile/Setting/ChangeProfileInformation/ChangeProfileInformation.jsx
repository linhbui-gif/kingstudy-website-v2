import { useState } from 'react';

import { Col, DatePicker, Form, Radio, Row } from 'antd';
import Image from 'next/image';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import ImageBannerProfile from '@/assets/images/image-profile-banner.jpg';
import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const ChangeProfileInformation = () => {
  const [value, setValue] = useState(1);
  return (
    <div>
      <div>
        <Image
          layout={'responsive'}
          loading={'lazy'}
          src={ImageBannerProfile}
          alt={''}
          className={'rounded-sm'}
        />
        <div className={'w-[26rem] translate-x-[3rem] -translate-y-1/4'}>
          <Image
            width={260}
            height={260}
            layout={'responsive'}
            loading={'lazy'}
            src={ImageAvatarDefault}
            alt={''}
            className={'w-full object-cover rounded-full'}
          />
        </div>
      </div>
      <div>
        <Form layout={'vertical'}>
          <Row>
            <Col span={12}>
              <Form.Item label={'Tên của bạn'}>
                <Input placeholder={'Nhập Tên...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Email'}>
                <Input placeholder={'Email...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Số điện thoại'}>
                <Input placeholder={'Nhập số điện thoại...'} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Birthday'} className={'date-picker-custom-ks'}>
                <DatePicker />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Giới tính'}>
                <Radio.Group
                  onChange={(e) => {
                    setValue(e.target.value);
                  }}
                  value={value}
                >
                  <Radio value={1}>Nam</Radio>
                  <Radio value={2}>Nữ</Radio>
                </Radio.Group>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label={'Địa chỉ'}>
                <Input placeholder={'Nhập địa chỉ...'} />
              </Form.Item>
            </Col>
          </Row>
          <ButtonComponent
            title={'Cập nhật'}
            className={'primary min-w-[15rem]'}
          />
        </Form>
      </div>
    </div>
  );
};
export default ChangeProfileInformation;
