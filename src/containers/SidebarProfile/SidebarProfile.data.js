import { EProfileSidebar } from '@/common/enums';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import { Paths } from '@/routers/constants';

export const sidebarProfileData = [
  {
    key: '1',
    title: 'Thông tin của bạn',
    icon: <Icon name={EIconName.Compare} color={EIconColor.STYLE_7} />,
    link: `${Paths.Profile.View}?page=${EProfileSidebar.MY_PROFILE_INFORMATION}`,
    activePaths: [`${EProfileSidebar.MY_PROFILE_INFORMATION}`],
  },
  {
    key: '2',
    title: 'Theo dõi hồ sơ',
    icon: <Icon name={EIconName.Compare} color={EIconColor.STYLE_7} />,
    link: `${Paths.Profile.View}?page=${EProfileSidebar.TRACKING_PROFILE_INFORMATION}`,
    activePaths: [`${EProfileSidebar.TRACKING_PROFILE_INFORMATION}`],
  },
  {
    key: '3',
    title: 'Quản lý hồ sơ',
    icon: <Icon name={EIconName.Compare} color={EIconColor.STYLE_7} />,
    link: `${Paths.Profile.View}?page=${EProfileSidebar.MANAGER_PROFILE_INFORMATION}`,
    activePaths: [`${EProfileSidebar.MANAGER_PROFILE_INFORMATION}`],
  },
  {
    key: '3',
    title: 'Trường yêu thích',
    icon: <Icon name={EIconName.Compare} color={EIconColor.STYLE_7} />,
    link: `${Paths.Profile.View}?page=${EProfileSidebar.SCHOOL_FAVORITE}`,
    activePaths: [`${EProfileSidebar.SCHOOL_FAVORITE}`],
  },
  {
    key: '3',
    title: 'Cài đặt',
    icon: <Icon name={EIconName.Compare} color={EIconColor.STYLE_7} />,
    link: `${Paths.Profile.View}?page=${EProfileSidebar.SETTING}`,
    activePaths: [`${EProfileSidebar.SETTING}`],
  },
];
