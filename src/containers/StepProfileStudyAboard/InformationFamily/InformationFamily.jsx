import { Col, DatePicker, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationFamily = ({ onNext, onPrev }) => {
  const onsubmit = (values) => {
    onNext?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin gia đình</h3>
      <Form layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col span={8}>
            <Form.Item
              label={'Họ và Tên Bố'}
              className={'form-input-study-aboard'}
              name={'father_name'}
            >
              <Input placeholder={'Họ và Tên Bố...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Ngày tháng năm sinh'}
              className={'form-input-study-aboard'}
              name={'father_birth_day'}
            >
              <DatePicker placeholder={'Birthday ...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Địa chỉ hiện tại'}
              className={'form-input-study-aboard'}
              name={'father_current_address'}
            >
              <Input placeholder={'Địa chỉ hiện tại...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Nghề nghiệp'}
              className={'form-input-study-aboard'}
              name={'father_job'}
            >
              <Input placeholder={'Nghề nghiệp...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Số điện thoại'}
              className={'form-input-study-aboard'}
              name={'father_phone'}
            >
              <Input numberic placeholder={'Số điện thoại...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Email'}
              className={'form-input-study-aboard'}
              name={'father_email'}
            >
              <Input placeholder={'Email...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Tình trạng hôn nhân'}
              className={'form-input-study-aboard'}
              name={'marital_status'}
            >
              <Radio.Group>
                <Radio value={1}>Kết hôn</Radio>
                <Radio value={2}>Độc thân</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Tên vợ/chồng'}
              className={'form-input-study-aboard'}
              name={'spouse_name'}
            >
              <Input placeholder={'Tên vợ/chồng...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Ngày tháng năm sinh'}
              className={'form-input-study-aboard'}
              name={'spouse_birth_day'}
            >
              <DatePicker placeholder={'Birthday ...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Nơi sinh'}
              className={'form-input-study-aboard'}
              name={'spouse_birth_place'}
            >
              <Input placeholder={'Nơi sinh...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Quốc tịch'}
              className={'form-input-study-aboard'}
              name={'spouse_nationality'}
            >
              <Input placeholder={'Quốc tịch...'} />
            </Form.Item>
          </Col>
          <Col span={8}>
            <Form.Item
              label={'Địa chỉ hiện tại'}
              className={'form-input-study-aboard'}
              name={'spouse_current_address'}
            >
              <Input placeholder={'Địa chỉ hiện tại...'} />
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
export default InformationFamily;
