import { Col, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationWork = ({ onNext, onPrev }) => {
  const onsubmit = (values) => {
    onNext?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin công việc</h3>
      <Form layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col md={8} span={24}>
            <Form.Item
              label={'Bạn đã đi làm chưa?'}
              className={'form-input-study-aboard'}
              name={'is_worked_2'}
            >
              <Radio.Group>
                <Radio value={1}>Chưa</Radio>
                <Radio value={2}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Tên cơ quan'}
              className={'form-input-study-aboard'}
              name={'job_company_name'}
            >
              <Input placeholder={'Tên cơ quan...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Thời gian làm việc'}
              className={'form-input-study-aboard'}
              name={'job_working_time'}
            >
              <Input placeholder={'Thời gian làm việc...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Địa chỉ'}
              className={'form-input-study-aboard'}
              name={'job_address'}
            >
              <Input placeholder={'Địa chỉ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Số điện thoại'}
              className={'form-input-study-aboard'}
              name={'job_phone'}
            >
              <Input placeholder={'Địa chỉ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Email'}
              className={'form-input-study-aboard'}
              name={'job_email'}
            >
              <Input placeholder={'Email...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Chức vụ'}
              className={'form-input-study-aboard'}
              name={'job_position'}
            >
              <Input placeholder={'Chức vụ...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Mức lương'}
              className={'form-input-study-aboard'}
              name={'job_salary'}
            >
              <Input numberic placeholder={'Mức lương...'} />
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
export default InformationWork;
