import React, { useEffect, useRef, useState } from 'react';

import { Spin } from 'antd';
import Link from 'next/link';

import { ETypeNotification } from '@/common/enums';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import { Paths } from '@/routers/constants';
import { getSmartSearch } from '@/services/common';
import { showNotification } from '@/utils/function';

const SearchMobile = () => {
  const dropdownRef = useRef(null);
  const [searchData, setSearchData] = useState([]);
  const [isVisible, setVisible] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleClickOutside = () => {
    if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
      setVisible(false);
    }
  };

  const onSearchKeywords = (keyword) => {
    setVisible(true);
    const body = {
      keyword: keyword,
      limit: 5,
    };
    onSearch?.(body).then();
  };

  const onSearch = async (body) => {
    try {
      setLoading(true);
      const response = await getSmartSearch(body);
      if (response?.code === 200) {
        const data = response?.data;
        const { blog, events, school } = data;
        const arr = [
          {
            title: 'Trường học',
            data:
              school &&
              school.map((item) => {
                return {
                  ...item,
                  name: item?.name,
                  link: `${Paths.School.SchoolDetail(item?.slug)}`,
                };
              }),
          },
          {
            title: 'Sự kiện',
            data:
              events &&
              events.map((item) => {
                return {
                  ...item,
                  name: item?.title,
                  link: `${Paths.Blog.BlogDetail(item?.alias)}`,
                };
              }),
          },
          {
            title: 'Tin tức',
            data:
              blog &&
              blog.map((item) => {
                return {
                  ...item,
                  name: item?.title,
                  link: `${Paths.Blog.BlogDetail(item?.alias)}`,
                };
              }),
          },
        ];
        setSearchData(arr);
      }
    } catch (e) {
      showNotification(ETypeNotification.ERROR, e?.response?.data?.message);
      setLoading(false);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    document.addEventListener('mousedown', handleClickOutside);
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
      setSearchData([]);
      setVisible(false);
    };
  }, []);
  return (
    <div className={'relative'}>
      <Input
        className={'input-suffix min-w-[26.8rem]'}
        placeholder={'Tìm trường học...'}
        suffix={
          <Icon
            className={
              'absolute top-[50%] right-[1rem] translate-y-[-50%] flex items-center justify-center w-[3.2rem] h-[3.2rem] md:w-[4.2rem] md:h-[4.2rem] cursor-pointer'
            }
            name={EIconName.Search}
          />
        }
        onSearch={onSearchKeywords}
      />
      {isVisible && (
        <div
          className="dropdown absolute top-full left-0 w-full bg-white rounded-sm p-[2rem] border border-solid border-style-8 max-h-[50rem] overflow-y-scroll"
          ref={dropdownRef}
        >
          <Spin spinning={loading}>
            <ul>
              {searchData &&
                searchData.map((item, index) => {
                  return (
                    <li className={'py-[2rem]'} key={index}>
                      <h3 className={'font-[600] text-[1.6rem] text-style-10'}>
                        {item?.title}
                      </h3>
                      <ul>
                        {item?.data &&
                          item?.data?.map((element) => {
                            return (
                              <li
                                key={element?.id}
                                className={
                                  'flex items-center py-4 px-[1.5rem] gap-[2rem]'
                                }
                                style={{
                                  borderBottom: '1px solid #DEE2E6',
                                }}
                              >
                                <Icon name={EIconName.Search} />
                                <Link
                                  href={element?.link}
                                  className={
                                    'text-style-9 text-[1.4rem] leading-9'
                                  }
                                >
                                  {element?.name}
                                </Link>
                              </li>
                            );
                          })}
                      </ul>
                    </li>
                  );
                })}
            </ul>
          </Spin>
        </div>
      )}
    </div>
  );
};
export default SearchMobile;
