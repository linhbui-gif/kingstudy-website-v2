import { Tag } from 'antd';

import env from '@/env';

export const AppConfig = {
  site_name: 'KingStudy',
  title: 'KingStudy',
  description:
    'KingStudy là đơn vị tư vấn, kết nối du học với 10 năm kinh nghiệm. Khi đến với King Study, bạn sẽ được hỗ trợ về thông tin về du học, học bổng và hướng dẫn hồ ...',
  url: 'https://kingstudy.vn',
  locale: 'vi',
  author: 'KingStudy',
  pagination_size: 5,
  thumbUrl: '',
  keywords:
    'Du học, Du học Kingstudy, Du học Anh, Du học úc, Du học Canada, Du học Mỹ, Du học Hà Lan',
};

export const addTrailingSlash = (url) => {
  // If the trailing slash exists, it is replaced with /.
  // If the trailing slash does not exist, a / is appended to the end
  // (to be exact: The trailing anchor is replaced with /)
  return url.replace(/\/?$/, '/');
};

export const isBrowser = () => {
  return typeof window !== 'undefined';
};

export const statusSchool = (type) => {
  const conditions = [
    { type: 3, color: '#008560', text: 'Available' },
    { type: 2, color: '#F48331', text: 'Partner' },
    { type: 1, color: '#d51f32', text: 'Close' },
  ];

  const condition =
    conditions.find((condition) => Number(type) === condition.type) ||
    conditions[conditions.length - 1];

  return (
    <Tag
      className={'text-[1.5rem] text-style-13 py-[.2rem]'}
      color={condition.color}
    >
      {condition.text}
    </Tag>
  );
};

export const changeArrayToOptions = (arr = []) => {
  return (
    arr &&
    arr.map(({ id, name, icon, logo }) => {
      return { value: id, label: name, icon: icon || '', logo: logo || '' };
    })
  );
};

export const rootUrl = env.rootUrl;
