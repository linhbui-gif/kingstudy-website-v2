import React from 'react';

import dynamic from 'next/dynamic';
import Image from 'next/image';
import Link from 'next/link';

import ImageLogo from '@/assets/images/logo.svg';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import { MenuData } from '@/containers/Header/Header.data';

const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const Header = () => {
  return (
    <header
      className={`relative flex items-center lg:h-[10.4rem] h-[7.2rem] bg-style-10`}
    >
      <div className="container mx-auto lg:px-[3rem] px-[1.6rem]">
        <div className="flex items-center justify-between">
          <div className={'lg:w-auto w-[115px]'}>
            <Image
              src={ImageLogo}
              alt={'Logo King study'}
              width={167}
              height={104}
              className={'max-w-full'}
            />
          </div>

          <MediaQuery minWidth={1024}>
            <nav className={'flex items-center gap-[3.2rem] pr-[4.1rem]'}>
              {MenuData.map((menu) => {
                return (
                  <li key={menu.id}>
                    <Link
                      href={'/'}
                      className={'text-button-16 text-style-5 py-[43px]'}
                    >
                      {menu.name}
                    </Link>
                  </li>
                );
              })}
            </nav>

            <div className={'flex items-center gap-[2.4rem]'}>
              <Input
                className={'input-suffix min-w-[26.8rem]'}
                placeholder={'Tìm khóa học..'}
                suffix={<Icon name={EIconName.Search} />}
              />

              <div className={'relative'}>
                <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                <span
                  className={
                    'absolute top-[-5px] right-[-10px] flex items-center justify-center w-[20px] h-[20px] text-body-14 text-style-5 text-center bg-red rounded-full'
                  }
                >
                  0
                </span>
              </div>

              <Link href={'/'} className={'text-button-16 text-style-5'}>
                Đăng nhập
              </Link>
              <ButtonComponent
                title={'Đăng Ký'}
                className={'w-[112px] orange mt-3 ml-4'}
              />
            </div>
          </MediaQuery>
          <MediaQuery maxWidth={1024}>
            <div className={'flex items-center gap-[1.6rem]'}>
              <Icon name={EIconName.Search} color={EIconColor.WHITE} />
              <div className={'relative'}>
                <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                <span
                  className={
                    'absolute top-[-5px] right-[-10px] flex items-center justify-center w-[20px] h-[20px] text-[12px] text-style-5 text-center bg-red rounded-full'
                  }
                >
                  0
                </span>
              </div>
            </div>
          </MediaQuery>
        </div>
      </div>
    </header>
  );
};
export default Header;
