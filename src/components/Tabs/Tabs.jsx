import React, { useEffect, useState } from 'react';

import { Tabs as AntdTabs } from 'antd';
import { useRouter } from 'next/router';

const Tabs = ({ options = [], defaultKey, onKeyChange }) => {
  const key = 'tabKey';
  const router = useRouter();
  const [activeKey, setActiveKey] = useState(defaultKey || null);

  const handleTabChange = (activeKeyChanged) => {
    setActiveKey(activeKeyChanged);
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
    <div className="Tabs">
      <AntdTabs activeKey={activeKey} onChange={handleTabChange}>
        {options.map((option) => (
          <AntdTabs.TabPane tab={option.title} key={option.key}>
            {activeKey === option.key && option.children}
          </AntdTabs.TabPane>
        ))}
      </AntdTabs>
    </div>
  );
};

export default Tabs;
