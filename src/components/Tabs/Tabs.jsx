import React, { useEffect, useState } from 'react';

import { Select, Tabs as AntdTabs } from 'antd';
import { useRouter } from 'next/router';

import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';

const Tabs = ({ options = [], defaultKey, onKeyChange, hasMajor = false }) => {
  const key = 'tabKey';
  const router = useRouter();
  const [activeKey, setActiveKey] = useState(defaultKey || null);

  const handleTabChange = (activeKeyChanged) => {
    setActiveKey(activeKeyChanged);
    onKeyChange?.(activeKeyChanged);
  };

  useEffect(() => {
    if (router?.query?.[key]) {
      const keyTab = router?.query?.[key];
      setActiveKey(keyTab);
      onKeyChange?.(keyTab);
    }
  }, [router.query]);

  useEffect(() => {
    if (!activeKey) setActiveKey(options[0]?.key);
  }, []);

  return (
    <div className="Tabs relative">
      {hasMajor && (
        <Select
          className={'w-full md:hidden block'}
          options={[]}
          placeholder={'Chọn ngành học'}
          allowClear
          suffixIcon={
            <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
          }
        />
      )}
      <AntdTabs activeKey={activeKey} onChange={handleTabChange}>
        {options.map((option) => (
          <AntdTabs.TabPane tab={option.title} key={option.key}>
            {activeKey === option.key && option.children}
          </AntdTabs.TabPane>
        ))}
      </AntdTabs>
      {hasMajor && (
        <div
          className={
            'absolute md:block md:top-0 md:right-0 hidden h-[5.2rem] leading-[5.2rem]'
          }
        >
          <Select
            suffixIcon={
              <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
            }
            allowClear
            className={''}
            options={[]}
            placeholder={'Chọn ngành học'}
          />
        </div>
      )}
    </div>
  );
};

export default Tabs;
