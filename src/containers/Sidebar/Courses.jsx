import React, { useState, useEffect, useRef } from 'react';

import { Menu } from 'antd';
import { Select } from 'antd';

const Sidebar = () => {
  const [selectedKey, setSelectedKey] = useState('1');
  const [isMobile, setIsMobile] = useState(false);
  const [activeMenuItem, setActiveMenuItem] = useState('');

  const itemsWithContent = [
    {
      key: '1',
      label: 'Tổng Quan',
      value: 'Content của Tổng Quan',
      background: 'lightblue',
    },
    {
      key: '2',
      label: 'Thành Phố',
      value: 'Content của Thành Phố',
      background: 'lightgreen',
    },
    {
      key: '3',
      label: 'Các thông tin nổi bật',
      value: 'Content của Các thông tin nổi bật',
      background: 'lightcoral',
    },
    {
      key: '4',
      label: 'Cơ sở vật chất',
      value: 'Content của Cơ sở vật chất',
      background: 'lightyellow',
    },
    {
      key: '5',
      label: 'Chương trình giảng dạy',
      value: 'Content của Chương trình giảng dạy',
      background: 'lightpink',
    },
    {
      key: '6',
      label: 'Học phí',
      value: 'Content của Học phí',
      background: 'lightcyan',
    },
    {
      key: '7',
      label: 'Học bổng',
      value: 'Content của Học bổng',
      background: 'lightsalmon',
    },
    {
      key: '8',
      label: 'Khóa học',
      value: 'Content của Khóa học',
      background: 'lightseagreen',
    },
    {
      key: '9',
      label: 'Yêu cầu đầu vào',
      value: 'Content của Yêu cầu đầu vào',
      background: 'lightsteelblue',
    },
    {
      key: '10',
      label: 'Feedback',
      value: 'Content của Feedback',
      background: 'lightgrey',
    },
    {
      key: '11',
      label: 'Thư viện ảnh',
      value: 'Content của Thư viện ảnh',
      background: 'lightcoral',
    },
  ];

  const contentRefs = itemsWithContent.reduce((acc, item) => {
    acc[item.key] = useRef(null);
    return acc;
  }, {});

  const handleMenuClick = (e) => {
    const { key } = e;
    setSelectedKey(key);
    if (!isMobile) {
      const contentRef = contentRefs[key].current;
      if (contentRef) {
        const contentTop = contentRef.offsetTop;
        window.scrollTo({ top: contentTop, behavior: 'smooth' });
      }
    }
  };
  const filteredItem = itemsWithContent.find(
    (item) => item.key === selectedKey
  );
  const defaultLabel = filteredItem?.label;
  useEffect(() => {
    const handleResize = () => {
      setIsMobile(window.innerWidth <= 768);
    };
    handleResize();
    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  useEffect(() => {
    if (isMobile) {
      const contentRef = contentRefs[selectedKey].current;
      if (contentRef) {
        const contentTop = contentRef.offsetTop;
        window.scrollTo({ top: contentTop, behavior: 'smooth' });
      }
    }
  }, [selectedKey, isMobile]);

  useEffect(() => {
    const handleResize = () => {
      setIsMobile(window.innerWidth <= 768);
    };
    handleResize();
    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  useEffect(() => {
    const handleScroll = () => {
      if (!isMobile) {
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight / 2;
        let minDistance = Infinity;
        let closestItemKey = null;
        for (const item of itemsWithContent) {
          const contentRef = contentRefs[item.key].current;
          if (contentRef) {
            const contentTop = contentRef.offsetTop;
            const distance = Math.abs(contentTop - scrollPosition);
            const contentHeight = contentRef.clientHeight;
            const visibleHeight = Math.min(windowHeight, contentHeight);
            const scrollThreshold = visibleHeight;
            if (distance < minDistance && distance < scrollThreshold) {
              minDistance = distance;
              closestItemKey = item.key;
            }
          }
        }
        setSelectedKey(closestItemKey);
      }
    };
    window.addEventListener('scroll', handleScroll);
    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, [isMobile]);
  useEffect(() => {
    setActiveMenuItem(selectedKey);
  }, [selectedKey]);
  return (
    <div className=" ">
      <div className="hidden lg:block">
        <div className=" flex flex-col lg:flex-row lg:gap-8">
          <div className="courses p-[3rem] rounded-[0.4rem] border border-custom border-solid border-style-8  lg:sticky lg:top-[0.4rem] lg:h-[calc(100vh-1rem)] lg:overflow-y-auto">
            <Menu
              selectedKeys={[activeMenuItem]}
              items={itemsWithContent}
              onClick={handleMenuClick}
              mode="inline"
              theme="light"
            />
          </div>
          <div className="lg:w-3/4">
            {itemsWithContent.map((item) => (
              <div key={item?.key}>
                <div
                  className={`h-[20rem] px-[7rem] py-[10rem] text-body-16 `}
                  ref={contentRefs[item?.key]}
                  id={`${item.key}`}
                  style={{ background: item?.background }}
                >
                  {item?.content}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
      <div className="courses block lg:hidden">
        <Select
          defaultValue={defaultLabel}
          className="w-full"
          onChange={(value) => setSelectedKey(value)}
          options={itemsWithContent.map((item) => ({
            value: item.key,
            label: item.label,
          }))}
        />
        {filteredItem && (
          <div
            className="h-[20rem] px-[7rem] py-[10rem] text-body-16"
            style={{ background: filteredItem.background }}
          >
            {filteredItem.value}
          </div>
        )}
      </div>
    </div>
  );
};

export default Sidebar;
