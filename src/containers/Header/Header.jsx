import React, { useState } from 'react';

import { Drawer } from 'antd';
import dynamic from 'next/dynamic';
import Image from 'next/image';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useRouter } from 'next/router';

import ImageLogoMobile from '@/assets/images/image-logo-mobile.png';
import { ETypeNotification } from '@/common/enums';
import Avatar from '@/components/Avatar';
import ButtonComponent from '@/components/Button';
import DropdownMenu from '@/components/DropdownMenu';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Container from '@/containers/Container';
import FilterTools from '@/containers/FilterTools';
import { MenuData } from '@/containers/Header/Header.data';
import NavigationBottom from '@/containers/NavigationBottom';
import { useAPI } from '@/contexts/APIContext';
import { ModulePaths, Paths } from '@/routers/constants';
import Helpers from '@/services/helpers';
import { showNotification } from '@/utils/function';

const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const Header = () => {
  const [openDrawer, setOpenDrawer] = useState(false);
  const { isLogin } = useAPI();
  const router = useRouter();
  const { setFilterSchool } = useAPI();
  const [filterCommon, setFilterCommon] = useState({
    page: 1,
    limit: 15,
  });
  const pathname = usePathname();
  const showDrawer = () => {
    setOpenDrawer(true);
  };

  const onClose = () => {
    setOpenDrawer(false);
  };

  const handleLogout = () => {
    Helpers.clearTokens();
    router.push(`${Paths.Home}`);
    showNotification(
      ETypeNotification.SUCCESS,
      'Đăng xuất tài khoản thành công !'
    );
  };

  const renderHeaderAccount = () => {
    return (
      <DropdownMenu
        options={[
          { value: '1', label: 'Thông tin cá nhân', link: `` },
          { value: '2', label: 'Đăng xuất', onClick: handleLogout },
        ]}
      >
        <div className="Header-account flex items-center">
          <div className="Header-account-avatar">
            <Avatar
              className={'bg-[unset]'}
              iconNameDefault={EIconName.Account}
              iconColorDefault={EIconColor.WHITE}
              image={''}
            />
          </div>
          <div className="text-white">
            Xin chào, <strong>Hello</strong>
          </div>
          <div className="ml-2">
            <Icon name={EIconName.ArowDown} />
          </div>
        </div>
      </DropdownMenu>
    );
  };
  return (
    <header
      className={`opacity-100 visible sticky transition-all ease-in-out duration-500 z-50 top-0 w-full left-0 flex items-center lg:h-[10.4rem] h-auto pb-[2rem] lg:pb-0 bg-style-10 `}
    >
      <Drawer
        onClose={onClose}
        open={openDrawer}
        zIndex={1052}
        classNames={'relative'}
        width={320}
      >
        <div className={''}>
          <FilterTools
            onFilterChange={(dataChanged) => {
              setFilterCommon({
                ...filterCommon,
                ...dataChanged,
              });
            }}
            paramsRequest={filterCommon}
            onReset={(dataReset) => {
              setFilterCommon({
                ...dataReset,
                page: 1,
                limit: 15,
              });
            }}
            showFooter
            onApply={() => {
              if (pathname !== '/school') router.push('/school');
              setFilterSchool({ ...filterCommon });
            }}
          />
        </div>
      </Drawer>
      <Container fluid>
        <div className={'max-w-[1700px] mx-auto'}>
          <div className="flex items-center justify-between">
            <div className={'lg:w-auto w-[115px]'}>
              <Link href={'/'} className={'block w-full h-full'}>
                <Image
                  quality={100}
                  src={ImageLogoMobile}
                  alt={'Logo King study'}
                  width={167}
                  height={92}
                  className={'mt-[1.5rem] max-w-full h-[9.2rem] lg:h-auto'}
                  priority
                />
              </Link>
            </div>

            <MediaQuery minWidth={1024}>
              <nav
                className={'flex items-center flex-1 gap-[3.2rem] px-[4.1rem]'}
              >
                {MenuData.map((menu) => {
                  return (
                    <li key={menu.id} className={'relative py-[4.3rem] group'}>
                      <Link
                        href={'/'}
                        className={
                          '2xl:text-button-16 lg:text-body-14 lg:font-[600] text-style-5 w-full block hover:text-orange'
                        }
                      >
                        <div className={'flex gap-[.8rem]'}>
                          <span>{menu.name}</span>
                          <Icon name={EIconName.ArowDown} />
                        </div>
                      </Link>
                      {menu?.children?.length > 0 ? (
                        <>
                          <ul
                            className="absolute left-0 top-[100%] translate-y-[50%] shadow-md bg-white w-[24rem] text-left z-50 rounded-sm pl-0 py-[1.5rem] duration-300 ease-in-out opacity-0 invisible group-hover:opacity-[1] group-hover:visible group-hover:translate-y-[0%]"
                            style={{ borderTop: '3px solid #F48331' }}
                          >
                            {menu?.children.map((item) => {
                              return (
                                <li
                                  key={item?.id}
                                  className={'p-[1rem_2.5rem]'}
                                >
                                  <Link
                                    href={'/'}
                                    className={
                                      'block w-full text-button-16 font-[500] text-style-7 hover:text-orange'
                                    }
                                  >
                                    {item?.name}
                                  </Link>
                                </li>
                              );
                            })}
                          </ul>
                        </>
                      ) : (
                        ''
                      )}
                    </li>
                  );
                })}
              </nav>

              <div className={'flex items-center'}>
                <Input
                  style={'mr-[3rem]'}
                  className={'input-suffix 2xl:min-w-[34rem] lg:min-w-[27rem]'}
                  placeholder={'Tìm trường học...'}
                  suffix={
                    <Icon
                      className={
                        'absolute top-[50%] right-[1rem] translate-y-[-50%] flex items-center justify-center w-[3.2rem] h-[3.2rem] md:w-[4.2rem] md:h-[4.2rem] cursor-pointer'
                      }
                      name={EIconName.Filter}
                      onClick={showDrawer}
                    />
                  }
                />

                <div
                  className={'relative mr-[3rem]'}
                  onClick={() => {
                    if (!isLogin)
                      showNotification(
                        ETypeNotification.INFO,
                        'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                      );
                  }}
                >
                  <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                  <span
                    className={
                      'absolute top-[-5px] right-[-10px] flex items-center justify-center w-[20px] h-[20px] text-body-14 text-style-5 text-center bg-red rounded-full'
                    }
                  >
                    0
                  </span>
                </div>

                {isLogin ? (
                  renderHeaderAccount()
                ) : (
                  <>
                    <div className={'relative'}>
                      <Link
                        href={`${ModulePaths.Auth}${Paths.Login}`}
                        className={
                          'text-button-16 text-style-5 ml-[2rem] mr-[3rem]'
                        }
                      >
                        Đăng nhập
                      </Link>
                      <span
                        className={
                          'absolute left-0 w-[1px] h-[35px] bg-white top-[50%] translate-y-[-50%]'
                        }
                      ></span>
                    </div>
                    <ButtonComponent
                      title={'Đăng Ký'}
                      className={'w-[112px] orange'}
                      link={`${ModulePaths.Auth}${Paths.SignUp}`}
                    />
                  </>
                )}
              </div>
            </MediaQuery>
            <MediaQuery maxWidth={1023}>
              <div className={'flex items-center gap-[1.6rem]'}>
                <div
                  className={'relative'}
                  onClick={() => {
                    if (!isLogin)
                      showNotification(
                        ETypeNotification.INFO,
                        'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                      );
                  }}
                >
                  <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                  <span
                    className={
                      'absolute top-[-5px] right-[-10px] flex items-center justify-center w-[20px] h-[20px] text-[12px] text-style-5 text-center bg-red rounded-full'
                    }
                  >
                    0
                  </span>
                </div>
                {/*<Icon*/}
                {/*  name={EIconName.Account}*/}
                {/*  color={EIconColor.STYLE_10}*/}
                {/*  width={24}*/}
                {/*  height={24}*/}
                {/*  className={'w-[3rem] h-[3rem] rounded-full bg-white'}*/}
                {/*/>*/}
              </div>
            </MediaQuery>
          </div>
          <MediaQuery maxWidth={1023}>
            <Input
              className={'input-suffix min-w-[26.8rem]'}
              placeholder={'Tìm trường học...'}
              suffix={
                <Icon
                  className={
                    'absolute top-[50%] right-[1rem] translate-y-[-50%] flex items-center justify-center w-[3.2rem] h-[3.2rem] md:w-[4.2rem] md:h-[4.2rem] cursor-pointer'
                  }
                  name={EIconName.Filter}
                  onClick={showDrawer}
                />
              }
            />
          </MediaQuery>
        </div>
      </Container>
      <MediaQuery maxWidth={1023}>
        <NavigationBottom isLogin={isLogin} />
      </MediaQuery>
    </header>
  );
};
export default Header;
