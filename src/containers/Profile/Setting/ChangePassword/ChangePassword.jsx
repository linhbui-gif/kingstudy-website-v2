import { Col, Form, Row } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';

const ChangePassword = () => {
  return (
    <div>
      <Form layout={'vertical'}>
        <Row>
          <Col span={12}>
            <Form.Item label={'Mật khẩu hiện tại'}>
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Mật khẩu mới'}>
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col span={12}>
            <Form.Item label={'Nhập lại mật khẩu mới'}>
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <ButtonComponent
              title={'Cập nhật'}
              className={'primary min-w-[15rem]'}
            />
          </Col>
        </Row>
      </Form>
    </div>
  );
};
export default ChangePassword;
