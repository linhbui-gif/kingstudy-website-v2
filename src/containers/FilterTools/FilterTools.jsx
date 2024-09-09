import React, { useEffect, useState } from 'react';

import { Flex, Form, Select } from 'antd';
import Image from 'next/image';

import ButtonComponent from '@/components/Button';
import CheckboxGroup from '@/components/CheckboxGroup';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import AccordionSideBar from '@/containers/AccordionSideBar';
import { dataTuitionOptions } from '@/containers/FilterTools/Tuition.data';
import { useAPI } from '@/contexts/APIContext';
import {
  getCityByCountry,
  getLevelCourse,
  getRanking,
} from '@/services/common';
import { changeArrayToOptions, rootUrl } from '@/utils/utils';
const FilterTools = ({
  paramsRequest,
  showFooter = false,
  onFilterChange,
  onApply,
  onReset,
  className = '',
  filterDrawer = false,
}) => {
  const { majors, countries } = useAPI();
  const majorOptions = changeArrayToOptions(majors);
  const [cities, setCities] = useState([]);
  const [levelCourse, setLevelCourse] = useState([]);
  const [rankings, setRanking] = useState([]);
  const [form] = Form.useForm();
  const getCities = async () => {
    try {
      const response = await getCityByCountry({
        province_id: paramsRequest?.country,
      });
      if (response?.code === 200) {
        const citiesOption = changeArrayToOptions(response?.data?.cities);
        setCities(citiesOption);
      }
    } catch (e) {
      /* empty */
    }
  };

  const getLevel = async () => {
    try {
      const response = await getLevelCourse();
      if (response?.code === 200) {
        const levelOption = changeArrayToOptions(response?.data?.level);
        setLevelCourse(levelOption);
      }
    } catch (e) {
      /* empty */
    }
  };
  const getRank = async () => {
    try {
      const response = await getRanking();
      if (response?.code === 200) {
        const rankingOption = changeArrayToOptions(response?.data?.ranking);
        setRanking(rankingOption);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    getCities().then();
    getLevel().then();
    getRank().then();
  }, [paramsRequest?.country, paramsRequest?.level, paramsRequest?.ranking]);

  const handleChangeCountry = (option) => {
    form.setFieldValue('province_id', null);
    onFilterChange({
      ...paramsRequest,
      country: option,
    });
  };

  const handleChangeCities = (option) => {
    onFilterChange({
      ...paramsRequest,
      province: option,
    });
  };
  return (
    <div className={`pb-[7rem] ${className}`}>
      {filterDrawer && (
        <span
          className={
            'block w-full bg-style-10 rounded-sm p-4 text-white font-[600] text-[1.8rem] mb-[1.2rem]'
          }
        >
          Bộ lọc
        </span>
      )}
      <Form form={form}>
        <div
          className={'border border-style-8 border-solid rounded-sm mt-5 p-4'}
        >
          <h3 className={'p-[.8rem] text-[2rem] text-style-7 font-[600]'}>
            Quốc gia, thành phố
          </h3>
          <div>
            <Form.Item name={'country'} className={'mb-0'}>
              <Select
                allowClear
                showSearch
                placeholder="Nhập Quốc Gia..."
                className={'w-full mb-5'}
                onChange={(option) => handleChangeCountry(option)}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
                filterOption={(input, option) =>
                  (option?.label.toLowerCase() ?? '').includes(
                    input.toLowerCase()
                  )
                }
              >
                {countries &&
                  countries.map((item) => (
                    <Select.Option
                      key={item?.value}
                      value={item?.value}
                      label={item?.label}
                    >
                      <Flex align={'center'} gap={'small'}>
                        <Image
                          quality={100}
                          src={`${rootUrl}${item?.icon}`}
                          alt={''}
                          width={24}
                          height={24}
                        />
                        {item?.label}
                      </Flex>
                    </Select.Option>
                  ))}
              </Select>
            </Form.Item>
            <Form.Item name={'province_id'} className={'mb-0'}>
              <Select
                allowClear
                showSearch
                placeholder="Nhập thành phố"
                className={'w-full mb-4'}
                onChange={(option) => handleChangeCities(option)}
                suffixIcon={
                  <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
                }
                filterOption={(input, option) =>
                  (option?.label.toLowerCase() ?? '').includes(
                    input.toLowerCase()
                  )
                }
              >
                {cities &&
                  cities.map((item) => (
                    <Select.Option
                      key={item?.value}
                      value={item?.value}
                      label={item?.label}
                    >
                      {item?.label}
                    </Select.Option>
                  ))}
              </Select>
            </Form.Item>
          </div>
        </div>
        <div className={'rounded-sm mt-5 py-4'}>
          <AccordionSideBar
            label={'Bậc học'}
            childrenData={
              <CheckboxGroup
                value={levelCourse.find(
                  (option) => option.value === paramsRequest?.levelcourse
                )}
                options={levelCourse}
                onChange={(option) => {
                  onFilterChange({
                    ...paramsRequest,
                    levelcourse: option,
                  });
                }}
              />
            }
          />
        </div>
        <div className={'rounded-sm mt-5 py-4'}>
          <AccordionSideBar
            label={'Xếp hạng'}
            childrenData={
              <CheckboxGroup
                value={
                  rankings &&
                  rankings.find(
                    (option) => option.value === paramsRequest?.ranking
                  )
                }
                options={rankings}
                onChange={(option) => {
                  onFilterChange({
                    ...paramsRequest,
                    ranking: option,
                  });
                }}
              />
            }
          />
        </div>
        <div className={'rounded-sm mt-5 py-4'}>
          <AccordionSideBar
            label={'Học phí'}
            childrenData={
              <CheckboxGroup
                value={dataTuitionOptions.find(
                  (option) => option.value === paramsRequest?.survey_tuition
                )}
                options={dataTuitionOptions}
                onChange={(option) => {
                  onFilterChange({
                    ...paramsRequest,
                    survey_tuition: option,
                  });
                }}
              />
            }
          />
        </div>
        <div
          className={'border border-style-8 border-solid rounded-sm mt-5 p-4'}
        >
          <h3 className={'p-[.8rem] text-[1.8rem] text-style-7 font-[600]'}>
            Ngành học
          </h3>
          <Form.Item name={'majors'} className={'mb-0'}>
            <Select
              allowClear
              showSearch
              placeholder="Nhập ngành học..."
              className={'w-full mb-5'}
              suffixIcon={
                <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
              }
              options={majorOptions}
              onChange={(option) => {
                onFilterChange({
                  ...paramsRequest,
                  majors: option,
                });
              }}
              filterOption={(input, option) =>
                (option?.label.toLowerCase() ?? '').includes(
                  input.toLowerCase()
                )
              }
            />
          </Form.Item>
        </div>
      </Form>
      {showFooter ? (
        <Flex
          align={'center'}
          justify={'center'}
          className={
            'absolute w-full left-0 bottom-0 shadow-md bg-white p-[1.2rem_1.6rem]'
          }
          gap={'small'}
        >
          <ButtonComponent
            title={'Áp dụng'}
            className={'primary w-[10rem]'}
            loading={false}
            onClick={onApply}
          />
          <ButtonComponent
            title={'Đặt lại'}
            className={'primary-outline w-[10rem]'}
            loading={false}
            onClick={onReset}
          />
        </Flex>
      ) : (
        <ButtonComponent
          title={'Đặt lại'}
          className={'primary w-full mt-5'}
          loading={false}
          onClick={() => {
            form.resetFields();
            onReset?.({
              page: 1,
              limit: 15,
            });
          }}
        />
      )}
    </div>
  );
};
export default FilterTools;
