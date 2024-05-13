import React from 'react';

import { Flex } from 'antd';

import ButtonComponent from '@/components/Button';
import Tag from '@/components/Tag';
import { dataCountryOptions } from '@/components/Tag/Country.Tab.data';

const FilterTools = ({
  paramsRequest,
  showFooter = false,
  onFilterChange,
  onApply,
  onReset,
}) => {
  return (
    <div className={'pb-[7rem]'}>
      <span
        className={
          'block w-full bg-style-10 rounded-sm p-4 text-white font-[600] text-[1.8rem] mb-[1.2rem]'
        }
      >
        Bộ lọc
      </span>
      <div className={'bg-[#fafbfd] rounded-sm py-4'}>
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
      <div className={'bg-[#fafbfd] rounded-sm mt-5 py-4'}>
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
      <div className={'bg-[#fafbfd] rounded-sm mt-5 py-4'}>
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
      <div className={'bg-[#fafbfd] rounded-sm mt-5 py-4'}>
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
      <div className={'bg-[#fafbfd] rounded-sm mt-5 py-4'}>
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