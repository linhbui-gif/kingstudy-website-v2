import { Col, DatePicker, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationHistoryTravel = ({ onPrev, onSubmit, loading, form }) => {
  const onsubmit = (values) => {
    onSubmit?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin lịch sử du lịch</h3>
      <Form form={form} layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col md={8} span={24}>
            <Form.Item
              label={'Bạn đã đi nước ngoài chưa?'}
              className={'form-input-study-aboard'}
              name={'is_gone_abroad'}
            >
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
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
              <DatePicker placeholder={'Thời gian...'} />
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
              <DatePicker placeholder={'Thời gian...'} />
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
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>Vui lòng cung cấp thông tin</h4>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'NI Number'}
              className={'form-input-study-aboard'}
              name={'uk_nl_number'}
            >
              <Input numberic placeholder={'NI Number...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Thời gian:'}
              className={'form-input-study-aboard'}
              name={'uk_date'}
            >
              <DatePicker placeholder={'Thời gian...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'BRP number:'}
              className={'form-input-study-aboard'}
              name={'uk_brp_number'}
            >
              <Input numberic placeholder={'BRP number...'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Bạn đã từng bị trượt visa nước nào chưa
            </h4>
          </Col>
          <Col span={24}>
            <Form.Item
              className={'form-input-study-aboard'}
              name={'is_fail_visa'}
            >
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Vui lòng cung cấp thông tin: thời gian - tên nước - loại visa bị
              từ chối
            </h4>
          </Col>
          <Col span={24}>
            <Form.Item
              className={'form-input-study-aboard'}
              name={'is_fail_visa_info'}
            >
              <Input />
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Bạn đã từng vi phạm pháp luật hay bị cảnh cáo tại quốc gia nào
              chưa?
            </h4>
          </Col>
          <Col span={24}>
            <Form.Item
              className={'form-input-study-aboard'}
              name={'is_warned_country'}
            >
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Vui lòng cung cấp thông tin: lý do và quốc gia xảy ra sự việc:
            </h4>
          </Col>
          <Col span={24}>
            <Form.Item
              className={'form-input-study-aboard'}
              name={'is_warned_country_info'}
            >
              <Input />
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Bạn có người thân tại quốc gia du học không?
            </h4>
          </Col>
          <Col span={24}>
            <Form.Item
              className={'form-input-study-aboard'}
              name={'is_relative_study_abroad'}
            >
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
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
