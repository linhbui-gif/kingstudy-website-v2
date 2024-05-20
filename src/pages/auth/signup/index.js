import { Form } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import ImageLogoMobile from '@/assets/images/image-logo-mobile.png';
import ButtonComponent from '@/components/Button';
import Input from '@/components/Input';
import Meta from '@/components/Meta';
import AuthLayout from '@/layouts/AuthLayout';
import { ModulePaths, Paths } from '@/routers/constants';

const SignUp = () => {
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
        <Form layout={'vertical'}>
          <Form.Item name={'email'} label={'Email'} required>
            <Input placeholder={'Nhập Email...'} />
          </Form.Item>
          <Form.Item name={'phone'} label={'Số điện thoại'} required>
            <Input placeholder={'Nhập số điện thoại...'} />
          </Form.Item>
          <Form.Item name={'password'} label={'Mật khẩu'} required>
            <Input type={'password'} placeholder={'Nhập mật khẩu...'} />
          </Form.Item>
          <Form.Item name={'re_password'} label={'Nhập lại mật khẩu'} required>
            <Input type={'password'} placeholder={'Nhập lại mật khẩu...'} />
          </Form.Item>
          <ButtonComponent
            title={'Đăng ký tài khoản'}
            className={'primary w-full block'}
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
