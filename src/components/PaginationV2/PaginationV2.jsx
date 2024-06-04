import React, { useState } from 'react';

import { Pagination } from 'antd';

import Button from '@/components/Button';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';

export const PaginationV2 = (props) => {
  const {
    onChange,
    onChangeSize,
    pages,
    disabled = false,
    showSizeChanger,
    total,
  } = props;
  const { page = 1, limit = 15 } = pages;
  const [pageSizeDefault, setPageSize] = useState(limit);

  const onChangePage = (page) => {
    onChange && onChange(page);
  };

  const onChangeSizePage = (current, pageSize) => {
    setPageSize(pageSize);
    onChangeSize && onChangeSize(current, pageSize);
  };
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
  return (
    <div className={'Pagination'}>
      <Pagination
        disabled={disabled}
        current={page}
        onChange={onChangePage}
        total={total}
        onShowSizeChange={onChangeSizePage}
        pageSize={pageSizeDefault}
        showSizeChanger={showSizeChanger}
        itemRender={itemRender}
      />
    </div>
  );
};

export default PaginationV2;
