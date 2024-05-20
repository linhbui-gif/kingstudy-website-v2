import React from 'react';

import { Dropdown as AntdDropdown } from 'antd';
import { useRouter } from 'next/router';
const DropdownMenu = ({
  children,
  trigger,
  placement,
  overlayClassName,
  options = [],
  disabled,
  className = '',
  onVisibleChange,
}) => {
  const router = useRouter();
  const handleVisibleChange = (currentVisible) => {
    onVisibleChange?.(currentVisible);
  };

  const antdDropdownProps = {
    placement,
    disabled,
    overlayClassName: overlayClassName,
    trigger: trigger || ['click'],
    onVisibleChange: handleVisibleChange,
  };

  const renderDropdownMenuOverlay = () => {
    return (
      <ul className="p-4 rounded-md shadow-md bg-white">
        {options.map((item) => (
          <li
            className={
              'cursor-pointer text-style-7 transition ease-in-out hover:text-orange py-2'
            }
            key={item.value}
            onClick={() => {
              if (!item?.disabled) {
                if (item?.link) {
                  router(item.link);
                } else {
                  item.onClick?.(item);
                }
              }
            }}
          >
            {item.label}
          </li>
        ))}
      </ul>
    );
  };

  return (
    <div className={`cursor-pointer`}>
      <AntdDropdown
        {...antdDropdownProps}
        overlay={renderDropdownMenuOverlay()}
        className={className}
      >
        <div className="DropdownMenu-wrapper">{children}</div>
      </AntdDropdown>
    </div>
  );
};

export default DropdownMenu;
