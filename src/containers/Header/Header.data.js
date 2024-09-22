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
        name: 'Khảo sát',
        link: `${Paths.Survey.View}`,
      },
      {
        id: 5,
        name: 'Tự nộp hồ sơ',
        link: `${Paths.Profile.SubmitProfileStep}`,
      },
      {
        id: 6,
        name: 'FAQ',
      },
      {
        id: 7,
        name: 'Blog',
        link: '/blog',
      },
    ],
  },
  {
    id: 2,
    name: 'Du Học',
    children: [
      {
        id: 7,
        name: 'Du Học Anh',
        link: `${Paths.School.View}?country_id=7`,
      },
      {
        id: 8,
        name: 'Du học Úc',
        link: `${Paths.School.View}?country_id=8`,
      },
      {
        id: 5,
        name: 'Du học Mỹ',
        link: `${Paths.School.View}?country_id=5`,
      },
      {
        id: 9,
        name: 'Du học Canada',
        link: `${Paths.School.View}?country_id=9`,
      },
      {
        id: 11,
        name: 'Du học Ireland',
        link: `${Paths.School.View}?country_id=11`,
      },
      {
        id: 10,
        name: 'Du học Hà Lan',
        link: `${Paths.School.View}?country_id=10`,
      },
      {
        id: 2,
        name: 'Học bổng',
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
