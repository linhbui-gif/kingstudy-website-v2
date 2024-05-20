import { useState } from 'react';

import { Form } from 'antd';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/router';

import ImageLogoMobile from '@/assets/images/image-logo-mobile.png';
import { ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';
import Meta from '@/components/Meta';
import AuthLayout from '@/layouts/AuthLayout';
import { ModulePaths, Paths } from '@/routers/constants';
import { signUp } from '@/services/auth';
import { showNotification, validationRules } from '@/utils/function';

const SignUp = () => {
  const [formValues, setFormValues] = useState({});
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const router = useRouter();
  const handleSubmit = (values) => {
    const body = { ...values };
    onSignUp(body).then();
  };

  const onSignUp = async (body) => {
    try {
      setLoading(true);
      const response = await signUp(body);
      if (response) {
        setLoading(false);
        showNotification(
          ETypeNotification.SUCCESS,
          'Đăng ký tài khoản thành công !'
        );
        form.resetFields();
        router.push(`${ModulePaths.Auth}${Paths.Login}`);
      }
    } catch (e) {
      setLoading(false);
      showNotification(ETypeNotification.ERROR, e?.response?.data?.message);
    }
  };

  return (
    <div className={'md:w-[56rem] w-full translate-y-[-2%]'}>
      <div className={'w-full text-center'}>
        <Link href={'/'} className={'block'}>
          <Image
            quality={100}
            src={ImageLogoMobile}
            alt={'Logo King study'}
            width={167}
            height={100}
            className={'max-w-full h-[10rem] lg:h-auto'}
            priority
          />
        </Link>
      </div>
      <div
        className={
          'w-full lg:p-[4rem] p-[2rem] mx-auto shadow-md bg-white rounded-md'
        }
      >
        <div className={'flex items-center text-body-16 justify-center mb-5'}>
          <p className={'mb-0 mr-2'}>Bạn đã có tài khoản?</p>
          <div>
            <Link href={`${ModulePaths.Auth}${Paths.Login}`}>
              <strong className={'text-style-10'}>Đăng nhập</strong>
            </Link>
          </div>
        </div>
        <Form
          form={form}
          layout={'vertical'}
          onValuesChange={(_, values) =>
            setFormValues({ ...formValues, ...values })
          }
          onFinish={handleSubmit}
        >
          <Form.Item
            name={'email'}
            label={'Email'}
            required
            rules={[validationRules.required(''), validationRules.email()]}
          >
            <Input placeholder={'Nhập Email...'} />
          </Form.Item>
          <Form.Item
            name={'phone'}
            label={'Số điện thoại'}
            required
            rules={[validationRules.required('')]}
          >
            <Input placeholder={'Nhập số điện thoại...'} />
          </Form.Item>
          <Form.Item
            name={'password'}
            label={'Mật khẩu'}
            required
            rules={[validationRules.required('')]}
          >
            <Input type={'password'} placeholder={'Nhập mật khẩu...'} />
          </Form.Item>
          <Form.Item
            name={'confirm_password'}
            label={'Nhập lại mật khẩu'}
            required
            rules={[validationRules.confirmPassword(formValues?.password)]}
          >
            <Input type={'password'} placeholder={'Nhập lại mật khẩu...'} />
          </Form.Item>
          <ButtonComponent
            title={'Đăng ký tài khoản'}
            className={'primary w-full block'}
            htmlType={'submit'}
            loading={loading}
          />
        </Form>
      </div>
    </div>
  );
};
export default SignUp;
SignUp.getLayout = function (page) {
  return (
    <>
      <Meta title={'Đăng ký tài khoản'} />
      <AuthLayout>{page}</AuthLayout>
    </>
  );
};
