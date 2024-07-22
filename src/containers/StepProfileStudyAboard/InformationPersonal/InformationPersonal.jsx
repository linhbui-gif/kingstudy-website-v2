import { Col, DatePicker, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationPersonal = ({ onNext, onPrev }) => {
  const onsubmit = (values) => {
    onNext?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin cá nhân</h3>
      <Form layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col md={8} span={24}>
            <Form.Item
              label={'Tên của bạn'}
              className={'form-input-study-aboard'}
              name={'name'}
            >
              <Input placeholder={'Nhập tên của bạn ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày tháng năm sinh'}
              className={'form-input-study-aboard'}
              name={'birth_day'}
            >
              <DatePicker placeholder={'Birthday ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Nơi sinh'}
              className={'form-input-study-aboard'}
              name={'birth_place'}
            >
              <Input placeholder={'Nơi sinh ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Giới tính'}
              className={'form-input-study-aboard'}
              name={'gender'}
            >
              <Radio.Group>
                <Radio value={1}>Nam</Radio>
                <Radio value={2}>Nữ</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Địa chỉ thường trú'}
              className={'form-input-study-aboard'}
              name={'permanent_address'}
            >
              <Input placeholder={'Địa chỉ thường trú ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Địa chỉ tạm trú'}
              className={'form-input-study-aboard'}
              name={'current_address'}
            >
              <Input placeholder={'Địa chỉ tạm trú ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'SĐT cá nhân'}
              className={'form-input-study-aboard'}
              name={'phone'}
            >
              <Input numberic placeholder={'SĐT cá nhân...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Email'}
              className={'form-input-study-aboard'}
              name={'email'}
            >
              <Input placeholder={'Email...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Số CCCD'}
              className={'form-input-study-aboard'}
              name={'identity_card'}
            >
              <Input numberic placeholder={'Số CCCD...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Nơi cấp'}
              className={'form-input-study-aboard'}
              name={'identity_card_issued_by'}
            >
              <Input placeholder={'Nơi cấp...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày cấp'}
              className={'form-input-study-aboard'}
              name={'identity_card_date'}
            >
              <DatePicker placeholder={'Ngày cấp...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày hết hạn'}
              className={'form-input-study-aboard'}
              name={'identity_card_expiration_date'}
            >
              <DatePicker placeholder={'Ngày hết hạn...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Số hộ chiếu'}
              className={'form-input-study-aboard'}
              name={'passport'}
            >
              <Input numberic placeholder={'Số hộ chiếu...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Nơi cấp'}
              className={'form-input-study-aboard'}
              name={'passport_issued_by'}
            >
              <Input placeholder={'Nơi cấp...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày cấp'}
              className={'form-input-study-aboard'}
              name={'passport_date'}
            >
              <DatePicker placeholder={'Ngày cấp...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày hết hạn'}
              className={'form-input-study-aboard'}
              name={'passport_expiration_date'}
            >
              <DatePicker placeholder={'Ngày hết hạn...'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <Space>
              <ButtonComponent
                title={'Tiếp theo'}
                className={'primary w-[15rem]'}
                htmlType={'submit'}
              />
              <ButtonComponent
                title={'Quay lại'}
                className={'primary-outline w-[15rem]'}
                onClick={onPrev}
              />
            </Space>
          </Col>
        </Row>
      </Form>
    </div>
  );
};
export default InformationPersonal;
