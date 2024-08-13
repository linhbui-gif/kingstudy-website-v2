import React, { useEffect, useState } from 'react';

import { Drawer } from 'antd';
import dynamic from 'next/dynamic';
import Image from 'next/image';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useRouter } from 'next/router';

import ImageLogoMobile from '@/assets/images/image-logo-mobile.png';
import { EProfileSidebar, ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Container from '@/containers/Container';
import DrawerListCompare from '@/containers/DrawerListCompare';
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
const Header = ({ totalWishList = 0 }) => {
  const [openDrawer, setOpenDrawer] = useState(false);
  const { getProfileInfor, profileState } = useAPI();
  const {
    isLogin,
    onCloseCompare,
    openDrawerCompare,
    schoolCompare,
    removeSchoolCompare,
    setIdCategory,
  } = useAPI();
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
      <div className="relative Header-account flex items-center cursor-pointer py-[4rem] group">
        <div className="text-white text-body-16">
          Xin chào, <strong>{profileState?.profile?.name}</strong>
        </div>
        <div className="ml-2">
          <Icon name={EIconName.ArowDown} />
        </div>
        <span
          className={
            'absolute left-0 w-[1px] h-[35px] bg-white top-[50%] translate-y-[-50%] ml-[-1.2rem]'
          }
        ></span>
        <ul
          className="dropdown absolute left-0 top-[100%] translate-y-[50%] shadow-md bg-white w-[24rem] text-left z-50 rounded-sm pl-0 py-[1.5rem] duration-300 ease-in-out opacity-0 invisible group-hover:opacity-[1] group-hover:visible group-hover:translate-y-[0%]"
          style={{ borderTop: '3px solid #F48331' }}
        >
          <li
            className={
              'p-[1rem_2.5rem] text-button-16 font-[500] text-style-7 hover:text-orange'
            }
            onClick={() => {
              router.push(
                `${Paths.Profile.View}?page=${EProfileSidebar.MY_PROFILE_INFORMATION}`
              );
            }}
          >
            Thông tin cá nhân
          </li>
          <li
            className={
              'p-[1rem_2.5rem] text-button-16 font-[500] text-style-7 hover:text-orange'
            }
            onClick={handleLogout}
          >
            Đăng xuất
          </li>
        </ul>
      </div>
    );
  };
  useEffect(() => {
    if (!profileState && isLogin) {
      getProfileInfor().then();
    }
  }, [profileState]);
  return (
    <header
      className={`opacity-100 visible sticky transition-all ease-in-out duration-500 z-50 top-0 w-full left-0 flex items-center lg:h-[10.4rem] h-auto pb-[2rem] lg:pb-0 bg-style-10 `}
    >
      {openDrawerCompare && schoolCompare.length > 0 && (
        <DrawerListCompare
          removeSchoolCompare={removeSchoolCompare}
          data={schoolCompare}
          open={openDrawerCompare}
          onClose={onCloseCompare}
        />
      )}
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
              if (pathname !== Paths.School.View)
                router.push(Paths.School.View);
              setFilterSchool({ ...filterCommon });
            }}
          />
        </div>
      </Drawer>
      <Container fluid>
        <div className={'max-w-[1700px] mx-auto'}>
          <div className="flex items-center justify-between">
            <div className={'lg:w-auto w-[14.4rem] h-[9.5rem] lg:h-auto'}>
              <Link href={'/'} className={'block w-full h-full'}>
                <Image
                  quality={100}
                  src={ImageLogoMobile}
                  alt={'Logo King study'}
                  width={167}
                  height={104}
                  className={'lg:mt-[1.5rem] max-w-full lg:h-auto'}
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
                        href={`${menu?.link ? menu?.link : '/'}`}
                        className={
                          '2xl:text-button-16 lg:text-body-14 lg:font-[600] text-style-5 w-full block hover:text-orange'
                        }
                      >
                        <div className={'flex gap-[.8rem]'}>
                          <span>{menu.name}</span>
                          {menu?.children?.length && (
                            <Icon name={EIconName.ArowDown} />
                          )}
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
                                  onClick={() => {
                                    setIdCategory({});
                                  }}
                                >
                                  <Link
                                    href={`${item?.link ? item?.link : '/'}`}
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
                      name={EIconName.Search}
                    />
                  }
                />

                <div
                  className={'relative mr-[3rem]'}
                  onClick={() => {
                    if (!isLogin) {
                      showNotification(
                        ETypeNotification.INFO,
                        'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                      );
                    } else {
                      router.push(
                        `${Paths.Profile.View}?page=${EProfileSidebar.SCHOOL_FAVORITE}`
                      );
                    }
                  }}
                >
                  <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                  <span
                    className={
                      'absolute top-[-5px] right-[-10px] flex items-center justify-center w-[20px] h-[20px] text-body-14 text-style-5 text-center bg-red rounded-full'
                    }
                  >
                    {totalWishList}
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
                    if (!isLogin) {
                      showNotification(
                        ETypeNotification.INFO,
                        'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                      );
                    } else {
                      router.push(
                        `${Paths.Profile.View}?page=${EProfileSidebar.SCHOOL_FAVORITE}`
                      );
                    }
                  }}
                >
                  <Icon name={EIconName.Favorite} color={EIconColor.WHITE} />
                  <span
                    className={
                      'absolute top-[-5px] right-[-7px] flex items-center justify-center w-[20px] h-[20px] text-[12px] text-style-5 text-center bg-red rounded-full'
                    }
                  >
                    {totalWishList}
                  </span>
                </div>
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
                  name={EIconName.Search}
                />
              }
            />
          </MediaQuery>
        </div>
      </Container>
      <MediaQuery maxWidth={1023}>
        <NavigationBottom showDrawer={showDrawer} isLogin={isLogin} />
      </MediaQuery>
    </header>
  );
};
export default Header;
