import Link from 'next/link';

import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import { ModulePaths, Paths } from '@/routers/constants';

const NavigationBottom = ({ isLogin }) => {
  return (
    <div
      className={
        'fixed bottom-0 bg-white left-0 w-full z-[40] h-[8rem] rounded-t-[1rem]'
      }
    >
      <nav className={'py-[1rem]'}>
        <ul className={'flex items-center pl-0 justify-around'}>
          <li>
            <Link
              href={'/'}
              className={'text-body-14 text-style-10 font-[500]'}
            >
              <Icon name={EIconName.Home} />
              <span className={'hover:text-style-10'}>Trang Chủ</span>
            </Link>
          </li>
          <li>
            <Link
              href={Paths.Event.View}
              className={'text-body-14 text-style-10 font-[500]'}
            >
              <Icon name={EIconName.Plane} />
              <span className={'hover:text-style-10'}>Sự kiện</span>
            </Link>
          </li>
          <li>
            <Link
              href={Paths.About.View}
              className={'text-body-14 text-style-10 font-[500]'}
            >
              <Icon
                name={EIconName.ScholarshipResult}
                color={EIconColor.STYLE_10}
              />
              <span className={'hover:text-style-10'}>Giới thiệu</span>
            </Link>
          </li>
          <li>
            <Link
              href={
                isLogin
                  ? `${ModulePaths.MyProfile}`
                  : `${ModulePaths.Auth}${Paths.Login}` || ''
              }
              className={'text-body-14 text-style-10 font-[500]'}
            >
              <Icon
                name={EIconName.Account}
                color={EIconColor.STYLE_10}
                width={24}
                height={24}
              />
              <span className={'hover:text-style-10'}>Tài Khoản</span>
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  );
};
export default NavigationBottom;
