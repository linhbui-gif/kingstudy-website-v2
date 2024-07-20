import { useState } from 'react';

import { Col, Form, Row } from 'antd';

import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';
import { validationRules } from '@/utils/function';

const ChangePassword = () => {
  const [formValues, setFormValues] = useState({});
  const [form] = Form.useForm();

  return (
    <div>
      <Form
        layout={'vertical'}
        form={form}
        onValuesChange={(_, values) =>
          setFormValues({ ...formValues, ...values })
        }
      >
        <Row>
          <Col md={{ span: 12 }} span={24}>
            <Form.Item
              name={'password'}
              label={'Mật khẩu hiện tại'}
              rules={[validationRules.required('')]}
            >
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col md={{ span: 12 }} span={24}>
            <Form.Item
              name={'newPassword'}
              label={'Mật khẩu mới'}
              rules={[validationRules.required('')]}
            >
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col md={{ span: 12 }} span={24}>
            <Form.Item
              name={'confirm_newPassword'}
              label={'Nhập lại mật khẩu mới'}
              rules={[
                validationRules.required(''),
                validationRules.confirmPassword(formValues.newPassword),
              ]}
            >
              <Input type={'password'} />
            </Form.Item>
          </Col>
          <Col span={24}>
            <ButtonComponent
              title={'Cập nhật'}
              className={'primary min-w-[15rem]'}
              htmlType={'submit'}
            />
          </Col>
        </Row>
      </Form>
    </div>
  );
};
export default ChangePassword;
