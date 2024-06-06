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
import { signIn } from '@/services/auth';
import Helpers from '@/services/helpers';
import { showNotification } from '@/utils/function';
const Login = () => {
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const router = useRouter();
  const handleSubmit = (values) => {
    const body = { ...values };
    onLogin(body).then();
  };

  const onLogin = async (body) => {
    try {
      setLoading(true);
      const response = await signIn(body);
      if (response) {
        setLoading(false);
        Helpers.storeAccessToken(response?.access_token);
        showNotification(ETypeNotification.SUCCESS, 'Đăng nhập thành công !');
        form.resetFields();
        router.push(`${Paths.Home}`);
      }
    } catch (e) {
      setLoading(false);
      showNotification(ETypeNotification.ERROR, e?.response?.data?.message);
    }
  };
  return (
    <div className={'md:w-[56rem] w-full translate-y-[-10%]'}>
      <div
        className={
          'text-center lg:w-auto w-[14.4rem] h-[9.5rem] mx-auto lg:h-auto'
        }
      >
        <Link href={'/'} className={'block'}>
          <Image
            quality={100}
            src={ImageLogoMobile}
            alt={'Logo King study'}
            width={167}
            height={104}
            className={'max-w-full lg:h-auto'}
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
          <p className={'mb-0 mr-2'}>Bạn chưa có tài khoản?</p>
          <div>
            <Link href={`${ModulePaths.Auth}${Paths.SignUp}`}>
              <strong className={'text-style-10'}>Đăng ký</strong>
            </Link>
          </div>
        </div>
        <Form layout={'vertical'} form={form} onFinish={handleSubmit}>
          <Form.Item name={'email'} label={'Email'} required>
            <Input placeholder={'Nhập Email...'} />
          </Form.Item>
          <Form.Item name={'password'} label={'Mật khẩu'} required>
            <Input type={'password'} placeholder={'Nhập mật khẩu...'} />
          </Form.Item>
          <ButtonComponent
            title={'Đăng nhập'}
            className={'primary w-full block'}
            loading={loading}
            htmlType={'submit'}
          />
        </Form>
      </div>
    </div>
  );
};
export default Login;
Login.getLayout = function (page) {
  return (
    <>
      <Meta title={'Đăng ký tài khoản'} />
      <AuthLayout>{page}</AuthLayout>
    </>
  );
};
