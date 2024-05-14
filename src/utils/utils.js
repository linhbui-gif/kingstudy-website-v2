import { Tag } from 'antd';

import env from '@/env';

export const AppConfig = {
  site_name: 'KingStudy',
  title: 'KingStudy',
  description: 'Personalized AI fitness coaching for all',
  url: 'https://example.com',
  locale: 'vi',
  author: 'KingStudy',
  pagination_size: 5,
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
    <Tag className={'text-[1.6rem] text-style-13 py-2'} color={condition.color}>
      {condition.text}
    </Tag>
  );
};

export const changeArrayToOptions = (arr = []) => {
  return (
    arr &&
    arr.map(({ id, name, icon }) => {
      return { value: id, label: name, icon: icon || '' };
    })
  );
};

export const rootUrl = env.rootUrl;
