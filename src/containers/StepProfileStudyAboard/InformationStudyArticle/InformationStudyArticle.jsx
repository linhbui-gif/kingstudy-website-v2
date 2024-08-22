import { Col, DatePicker, Form, Radio, Row, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const InformationStudyArticle = ({ onNext, onPrev, form }) => {
  const onsubmit = (values) => {
    onNext?.(values);
  };
  return (
    <div className={'pt-[2rem]'}>
      <h3>Thông tin học thuật</h3>
      <Form form={form} layout={'vertical'} onFinish={onsubmit}>
        <Row>
          <Col md={8} span={24}>
            <Form.Item
              label={'Bằng cấp cao nhất'}
              className={'form-input-study-aboard'}
              name={'degree'}
            >
              <Input placeholder={'Bằng cấp cao nhất...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Bạn đã đi làm chưa?'}
              className={'form-input-study-aboard'}
              name={'is_work'}
            >
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Vui lòng cung cấp thông tin bậc học gần nhất.
            </h4>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Tên trường'}
              className={'form-input-study-aboard'}
              name={'degree_school_name'}
            >
              <Input placeholder={'Tên trường...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Chuyên ngành:'}
              className={'form-input-study-aboard'}
              name={'degree_major'}
            >
              <Input placeholder={'Chuyên ngành...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Niên khóa'}
              className={'form-input-study-aboard'}
              name={'degree_school_year'}
            >
              <Input placeholder={'Niên khóa...'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item
              label={'Địa chỉ'}
              className={'form-input-study-aboard'}
              name={'degree_address'}
            >
              <Input placeholder={'Địa chỉ...'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>
              Vui lòng cung cấp thông tin 2 người giới thiệu
            </h4>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Họ tên (1)'}
              className={'form-input-study-aboard'}
              name={'presenter_1_name'}
            >
              <Input placeholder={'Họ tên (1)...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Chức vụ'}
              className={'form-input-study-aboard'}
              name={'presenter_1_position'}
            >
              <Input placeholder={'Chức vụ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Số điện thoại'}
              className={'form-input-study-aboard'}
              name={'presenter_1_phone'}
            >
              <Input numberic placeholder={'Số điện thoại...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Email'}
              className={'form-input-study-aboard'}
              name={'presenter_1_email'}
            >
              <Input placeholder={'Email...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Họ tên (2)'}
              className={'form-input-study-aboard'}
              name={'presenter_2_name'}
            >
              <Input placeholder={'Họ tên (2)...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Chức vụ'}
              className={'form-input-study-aboard'}
              name={'presenter_2_position'}
            >
              <Input placeholder={'Chức vụ...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Số điện thoại'}
              className={'form-input-study-aboard'}
              name={'presenter_2_phone'}
            >
              <Input numberic placeholder={'Số điện thoại...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Email'}
              className={'form-input-study-aboard'}
              name={'presenter_2_email'}
            >
              <Input numberic placeholder={'Email...'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <h4 className={'text-orange'}>Bạn đã thi IELTS chưa?</h4>
          </Col>
          <Col md={24} span={24}>
            <Form.Item className={'form-input-study-aboard'} name={'is_ielts'}>
              <Radio.Group>
                <Radio value={0}>Chưa</Radio>
                <Radio value={1}>Rồi</Radio>
              </Radio.Group>
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Overall'}
              className={'form-input-study-aboard'}
              name={'ielts_overall'}
            >
              <Input placeholder={'Overall...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Ngày thi'}
              className={'form-input-study-aboard'}
              name={'ielts_date'}
            >
              <DatePicker placeholder={'Ngày thi...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Reading'}
              className={'form-input-study-aboard'}
              name={'ielts_reading'}
            >
              <Input placeholder={'Reading...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Listening'}
              className={'form-input-study-aboard'}
              name={'ielts_listening'}
            >
              <Input placeholder={'Listening...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Writing'}
              className={'form-input-study-aboard'}
              name={'ielts_writing'}
            >
              <Input placeholder={'Writing...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Speaking'}
              className={'form-input-study-aboard'}
              name={'ielts_speaking'}
            >
              <Input placeholder={'Speaking...'} />
            </Form.Item>
          </Col>
          <Col md={8} span={24}>
            <Form.Item
              label={'Test Report Form No'}
              className={'form-input-study-aboard'}
              name={'ielts_test_report_form'}
            >
              <Input placeholder={'Test Report Form No...'} />
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
export default InformationStudyArticle;
