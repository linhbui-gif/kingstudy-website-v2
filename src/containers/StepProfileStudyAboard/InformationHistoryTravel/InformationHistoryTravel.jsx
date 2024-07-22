import { Col, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationHistoryTravel = ({ onPrev, onSubmit, loading }) => {
  const onsubmit = (values) => {
    onSubmit?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin lịch sử du lịch</h3>
      <Form layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col md={8} span={24}>
            <Form.Item
              label={'Bạn đã đi nước ngoài chưa?'}
              className={'form-input-study-aboard'}
              name={'is_gone_abroad'}
            >
              <Radio.Group>
                <Radio value={1}>Chưa</Radio>
                <Radio value={2}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Vui lòng cung cấp thông tin 10 năm gần nhất:
            </h4>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Quốc gia 1'}
              className={'form-input-study-aboard'}
              name={'travel_history_1_nation'}
            >
              <Input placeholder={'Quốc gia 1...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Thời gian'}
              className={'form-input-study-aboard'}
              name={'travel_history_1_time'}
            >
              <Input placeholder={'Thời gian...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Mục đích'}
              className={'form-input-study-aboard'}
              name={'travel_history_1_purpose'}
            >
              <Input placeholder={'Mục đích...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Quốc gia 2'}
              className={'form-input-study-aboard'}
              name={'travel_history_2_nation'}
            >
              <Input placeholder={'Quốc gia 1...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Thời gian'}
              className={'form-input-study-aboard'}
              name={'travel_history_2_time'}
            >
              <Input placeholder={'Thời gian...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Mục đích'}
              className={'form-input-study-aboard'}
              name={'travel_history_3_purpose'}
            >
              <Input placeholder={'Mục đích...'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <Form.Item
              label={'Bạn đã đi anh quốc chưa?'}
              className={'form-input-study-aboard'}
              name={'is_gone_uk'}
            >
              <Radio.Group>
                <Radio value={1}>Chưa</Radio>
                <Radio value={2}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <Space>
              <ButtonComponent
                title={'Hoàn thành'}
                className={'primary w-[15rem]'}
                htmlType={'submit'}
                loading={loading}
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
export default InformationHistoryTravel;
