import React from 'react';

import { Flex, Select } from 'antd';
import Image from 'next/image';

import ImageCountry from '@/assets/images/image-country-uk.svg';
import ButtonComponent from '@/components/Button';
import Tag from '@/components/Tag';
import { dataCountryOptions } from '@/components/Tag/Country.Tab.data';
const FilterTools = ({
  paramsRequest,
  showFooter = false,
  onFilterChange,
  onApply,
  onReset,
  className = '',
}) => {
  return (
    <div className={`pb-[7rem] ${className}`}>
      <span
        className={
          'block w-full bg-style-10 rounded-sm p-4 text-white font-[600] text-[1.8rem] mb-[1.2rem]'
        }
      >
        Bộ lọc
      </span>
      <div className={'border border-style-8 border-solid rounded-sm py-4'}>
        <h3 className={'p-[.8rem_1.6rem] text-[2rem] text-style-7 font-[600]'}>
          Ngành Học
        </h3>
        <div>
          <Tag
            value={dataCountryOptions.find(
              (option) => option.value === paramsRequest?.filter_type
            )}
            options={dataCountryOptions}
            onChange={(option) => {
              const selectedTabValue = option?.value;
              onFilterChange({
                filter_type: selectedTabValue,
              });
            }}
            filterTool
            className={'flex-col items-start justify-start pl-[.5rem]'}
          />
        </div>
      </div>
      <div
        className={'border border-style-8 border-solid rounded-sm mt-5 py-4'}
      >
        <h3 className={'p-[.8rem_1.6rem] text-[2rem] text-style-7 font-[600]'}>
          Quốc Gia
        </h3>
        <div>
          <Tag
            value={dataCountryOptions.find(
              (option) => option.value === paramsRequest?.filter_type
            )}
            options={dataCountryOptions}
            onChange={(option) => {
              const selectedTabValue = option?.value;
              onFilterChange({
                filter_type: selectedTabValue,
              });
            }}
            filterTool
            className={'flex-col items-start justify-start pl-[.5rem]'}
          />
        </div>
      </div>
      <div
        className={'border border-style-8 border-solid rounded-sm mt-5 py-4'}
      >
        <h3 className={'p-[.8rem_1.6rem] text-[2rem] text-style-7 font-[600]'}>
          Quốc Gia
        </h3>
        <div>
          <Tag
            value={dataCountryOptions.find(
              (option) => option.value === paramsRequest?.filter_type
            )}
            options={dataCountryOptions}
            onChange={(option) => {
              const selectedTabValue = option?.value;
              onFilterChange({
                filter_type: selectedTabValue,
              });
            }}
            filterTool
            className={'flex-col items-start justify-start pl-[.5rem]'}
          />
        </div>
      </div>
      <div className={'border border-style-8 border-solid rounded-sm mt-5 p-4'}>
        <h3 className={'p-[.8rem] text-[2rem] text-style-7 font-[600]'}>
          Quốc gia, thành phố
        </h3>
        <div>
          <Select
            allowClear
            showSearch
            placeholder="Please select store"
            className={'w-full mb-5'}
          >
            {dataCountryOptions.map((item) => (
              <Select.Option
                key={item?.value}
                value={item?.value}
                label={item?.label}
              >
                <div>
                  <Image src={ImageCountry} alt={''} width={24} height={24} />
                  {item?.label}
                </div>
              </Select.Option>
            ))}
          </Select>
          <Select
            allowClear
            showSearch
            placeholder="Please select store"
            className={'w-full mb-4'}
          >
            {dataCountryOptions.map((item) => (
              <Select.Option
                key={item?.value}
                value={item?.value}
                label={item?.label}
              >
                <div>
                  <Image src={ImageCountry} alt={''} width={24} height={24} />
                  {item?.label}
                </div>
              </Select.Option>
            ))}
          </Select>
        </div>
      </div>

      {showFooter && (
        <Flex
          align={'center'}
          justify={'space-between'}
          className={
            'absolute w-full left-0 bottom-0 shadow-md bg-white p-[1.2rem_1.6rem]'
          }
        >
          <ButtonComponent
            title={'Áp dụng'}
            className={'primary w-[15rem]'}
            loading={false}
            onClick={onApply}
          />
          <ButtonComponent
            title={'Đặt lại'}
            className={'primary-outline w-[15rem]'}
            loading={false}
            onClick={onReset}
          />
        </Flex>
      )}
    </div>
  );
};
export default FilterTools;
