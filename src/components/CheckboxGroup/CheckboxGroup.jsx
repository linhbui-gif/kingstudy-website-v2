import React from 'react';

import { Checkbox, Space } from 'antd';
const CheckboxGroup = ({ className = '', options = [], onChange, value }) => {
  const handleCheckboxChange = (checkedValue) => {
    const selectedOption = options.find((item) => item.value === checkedValue);
    onChange?.(selectedOption?.value);
  };
  return (
    <div className={`CheckboxGroup px-[1.6rem] ${className}`}>
      <Space direction="vertical" size={12}>
        {options.map((item) => (
          <Checkbox
            key={item.value}
            checked={value?.value === item.value}
            onChange={() => handleCheckboxChange(item.value)}
          >
            <span className={'cursor-pointer text-body-16'}>{item.label}</span>
          </Checkbox>
        ))}
      </Space>
    </div>
  );
};

export default CheckboxGroup;
