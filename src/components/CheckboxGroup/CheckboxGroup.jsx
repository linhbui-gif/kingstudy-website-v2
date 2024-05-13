import React from 'react';

import { Checkbox, Space } from 'antd';
const CheckboxGroup = ({ className = '', options = [], onChange, value }) => {
  const handleCheckboxGroupChange = (e) => {
    const changedValues = options.filter((item) => e.includes(item.value));
    onChange?.(changedValues);
  };

  return (
    <div className={`CheckboxGroup ${className}`}>
      <Checkbox.Group
        onChange={handleCheckboxGroupChange}
        value={value?.map((item) => item.value)}
      >
        <Space direction="vertical" size={12}>
          {options.map((item) => (
            <Checkbox key={item.value} value={item.value}>
              {item.label}
            </Checkbox>
          ))}
        </Space>
      </Checkbox.Group>
    </div>
  );
};

export default CheckboxGroup;
