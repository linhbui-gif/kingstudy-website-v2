import { Paths } from '@/routers/constants';

export const MenuData = [
  {
    id: 1,
    name: 'Về KingStudy',
    active: true,
    children: [
      {
        id: 1,
        name: 'Giới thiệu',
        link: `${Paths.About.View}`,
      },
      {
        id: 2,
        name: 'Tin tức mới nhất',
        link: `${Paths.Blog.View}`,
      },
      {
        id: 3,
        name: 'Sự kiện du học',
        link: `${Paths.Event.View}`,
      },
      {
        id: 4,
        name: 'Tìm trường',
      },
      {
        id: 5,
        name: 'Tự nộp hồ sơ',
      },
    ],
  },
  {
    id: 2,
    name: 'Du Học',
    children: [
      {
        id: 1,
        name: 'Du Học Anh',
      },
      {
        id: 2,
        name: 'Du học Uc',
      },
      {
        id: 3,
        name: 'Du học Mỹ',
      },
      {
        id: 4,
        name: 'Du học Canada',
      },
      {
        id: 5,
        name: 'Du học Ireland',
      },
      {
        id: 6,
        name: 'Du học Hà Lan',
      },
      {
        id: 7,
        name: 'Du học Singapore',
      },
      {
        id: 8,
        name: 'Học bổng',
      },
      {
        id: 9,
        name: 'Blog',
        link: '/blog',
      },
      {
        id: 10,
        name: 'FAQ',
      },
    ],
  },
  {
    id: 3,
    name: 'Dịch vụ',
  },
  {
    id: 4,
    name: 'Liên Hệ',
  },
];
