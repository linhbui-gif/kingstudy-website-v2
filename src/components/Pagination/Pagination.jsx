import React from 'react';

import { Pagination as AntdPagination } from 'antd';
import dynamic from 'next/dynamic';

import { EIconColor, EIconName } from '../Icon/Icon.enum';
import Button from '@/components/Button';
const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});

const Pagination = ({
  page,
  pageSize,
  total = 0,
  showLessItems,
  hideOnSinglePage,
  onChange,
}) => {
  const itemRender = (currentPage, type, originalElement) => {
    switch (type) {
      case 'prev':
        return (
          <Button
            className={'btn-prev'}
            iconName={EIconName.ArrowTriangleLeft}
            iconColor={EIconColor.STYLE_ARROW}
            size="small"
          />
        );
      case 'next':
        return (
          <Button
            className={'btn-next'}
            iconName={EIconName.ArrowTriangleRight}
            iconColor={EIconColor.STYLE_ARROW}
            size="small"
          />
        );
      default:
        return originalElement;
    }
  };

  const props = {
    current: page,
    pageSize: pageSize,
    total: total,
    hideOnSinglePage: hideOnSinglePage,
    showQuickJumper: false,
    showSizeChanger: false,
    itemRender: itemRender,
    onChange: onChange,
  };

  return (
    <div className={'Pagination'}>
      <MediaQuery maxWidth={575}>
        <AntdPagination {...props} showLessItems />
      </MediaQuery>

      <MediaQuery minWidth={576}>
        <AntdPagination {...props} showLessItems tems={showLessItems} />
      </MediaQuery>
    </div>
  );
};

export default Pagination;
