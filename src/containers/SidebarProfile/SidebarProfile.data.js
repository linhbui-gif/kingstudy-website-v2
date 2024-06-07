import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import { Paths } from '@/routers/constants';

export const sidebarProfileData = [
  {
    key: '1',
    title: 'Tài khoản của bạn',
    icon: <Icon name={EIconName.Account} color={EIconColor.STYLE_ARROW} />,
    link: `${Paths.Profile.View}?page=profile`,
    activePaths: [`${Paths.Profile.View}`],
  },
  {
    key: '2',
    title: 'Danh sách yêu thích',
    // icon: IconSidebar1,
    link: `${Paths.Profile.View}?page=wishlist`,
    activePaths: [`${Paths.Profile.View}`],
  },
];
