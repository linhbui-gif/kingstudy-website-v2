import React, { useState } from 'react';

import { Checkbox, Form, Select } from 'antd';

import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
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
const StepMajor = () => {
  const { majors } = useAPI();
  const majorOptions = changeArrayToOptions(majors);
  const [checkedList, setCheckedList] = useState([]);
  const [optionPoints, setOptionPoints] = useState(options);
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
  return (
    <div className={'my-[3rem]'}>
      <Form layout={'vertical'}>
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
        <h3>Điểm học</h3>
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
      </Form>
    </div>
  );
};
export default StepMajor;
