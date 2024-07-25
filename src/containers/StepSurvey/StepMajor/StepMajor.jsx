import React, { useState } from 'react';

import { Checkbox, Form, Select, Space } from 'antd';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import TagTimeStartLearn from '@/containers/StepSurvey/StepMajor/TagTimeStartLearn';
import { useAPI } from '@/contexts/APIContext';
import { changeArrayToOptions } from '@/utils/utils';

const options = [
  {
    id: 1,
    name: 'survey_mark_thpt',
    label: 'Điểm học THPT',
  },
  {
    id: 2,
    name: 'survey_mark_dh',
    label: 'Điểm học đại học',
  },
  {
    id: 3,
    name: 'survey_mark_ts',
    label: 'Điểm học thạc sĩ',
  },
  {
    id: 4,
    name: 'survey_mark_ct',
    label: 'Điểm học chuyển tiếp',
  },
];

const optionTimeStartLearn = [
  {
    label: 'Trong 1-3 tháng nữa',
    value: '1,3',
  },
  {
    label: 'Trong 4-6 tháng nữa',
    value: '4,6',
  },
  {
    label: 'Trong 7-9 tháng nữa',
    value: '7,9',
  },
  {
    label: 'Trong 10-12 tháng nữa',
    value: '10,12',
  },
  {
    label: 'Trong 1 năm nữa hoặc hơn',
    value: '15',
  },
];
const StepMajor = ({ onNext, onPrev }) => {
  const { majors } = useAPI();
  const majorOptions = changeArrayToOptions(majors);
  const [checkedList, setCheckedList] = useState([]);
  const [optionPoints, setOptionPoints] = useState(options);
  const [selectedValueTag, setSelectedValueTag] = useState(
    optionTimeStartLearn[0]?.value
  );
  const onChangeCheckPoint = (event) => {
    const arrCheckList = processLogicUpdateCheckedList(event);
    const updatedArrOptionPoints = optionPoints.map((item) => ({
      ...item,
      checked: arrCheckList.includes(item.id),
    }));
    setOptionPoints(updatedArrOptionPoints);
    setCheckedList(arrCheckList);
  };
  const processLogicUpdateCheckedList = (event) => {
    const value = event?.target?.value;
    return event?.target.checked
      ? [...checkedList, value].filter(
          (item, index, self) => self.indexOf(item) === index
        )
      : checkedList.filter((point) => point !== value);
  };
  const handlerSubmit = (values) => {
    onNext?.({ ...values, startTime: selectedValueTag });
  };
  return (
    <div className={'my-[3rem]'}>
      <Form layout={'vertical'} onFinish={handlerSubmit}>
        <Form.Item name={'majors'} label={'Chọn ngành học'}>
          <Select
            allowClear
            showSearch
            placeholder="Chọn ngành học..."
            className={'w-full mb-5'}
            suffixIcon={
              <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_7} />
            }
            options={majorOptions}
          />
        </Form.Item>
        <h3>ĐIỂM HỌC</h3>
        <div>
          {optionPoints &&
            optionPoints.map((option) => {
              return (
                <>
                  <div className={'flex gap-[1rem] mb-[2rem] '}>
                    <div key={option?.id}>
                      <Checkbox
                        value={option?.id}
                        onChange={onChangeCheckPoint}
                      />
                    </div>
                    <div
                      className={
                        'flex-1 border border-solid border-style-8 rounded-sm'
                      }
                    >
                      <div className={'p-[1.2rem_1.5rem] text-body-16'}>
                        {option?.label}
                      </div>
                      <div
                        className={`transition ease-in max-h-0 ${
                          option?.checked
                            ? 'p-[2.4rem_1.6rem] max-h-screen overflow-auto'
                            : 'p-[0rem_1.6rem] overflow-hidden '
                        }`}
                        style={{
                          borderTop: option?.checked
                            ? '1px solid #EDEEF2'
                            : '0px solid #EDEEF2',
                        }}
                      >
                        <p>Điểm 3 năm gần nhất</p>
                        <Form.Item
                          className={'mb-0 form-input-study-aboard w-full'}
                          name={option?.name}
                        >
                          <Input placeholder={option?.label} />
                        </Form.Item>
                      </div>
                    </div>
                  </div>
                </>
              );
            })}
        </div>
        <h3>THỜI GIAN BẮT ĐẦU HỌC</h3>
        <div>
          <TagTimeStartLearn
            options={optionTimeStartLearn}
            value={optionTimeStartLearn.find(
              (option) => option.value === selectedValueTag
            )}
            onChange={(option) => {
              const selectedTabValue = option?.value;

              setSelectedValueTag(selectedTabValue);
            }}
          />
        </div>
        <Space>
          <ButtonComponent
            title={'Tiếp theo'}
            className={'primary min-w-[16rem] mt-[4rem]'}
            htmlType={'submit'}
          />
          <ButtonComponent
            title={'Quay lại'}
            className={'primary-outline min-w-[16rem] mt-[4rem]'}
            onClick={onPrev}
          />
        </Space>
      </Form>
    </div>
  );
};
export default StepMajor;
