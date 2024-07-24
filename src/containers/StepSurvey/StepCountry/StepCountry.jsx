import React, { useState } from 'react';

import { Checkbox } from 'antd';
import Image from 'next/image';

import ButtonComponent from '@/components/Button';
import { useAPI } from '@/contexts/APIContext';
import { rootUrl } from '@/utils/utils';

const StepCountry = ({ onNext }) => {
  const { countries } = useAPI();
  const [countryChecked, setCountryChecked] = useState([]);
  const onChange = (event) => {
    const value = event?.target?.value;
    setCountryChecked(
      event?.target.checked
        ? [...countryChecked, value].filter(
            (item, index, self) => self.indexOf(item) === index
          )
        : countryChecked.filter((country) => country !== value)
    );
  };
  const handlerSubmit = () => {
    onNext?.(countryChecked);
  };
  return (
    <div className={'my-[3rem]'}>
      <h3>Chọn quốc gia</h3>
      <div className={'flex items-center gap-[2rem] flex-wrap'}>
        {countries &&
          countries.map((element) => {
            return (
              <div key={element?.value} className={'w-[21rem]'}>
                <div className={'relative'}>
                  <Image
                    className={'w-full block object-cover rounded-sm'}
                    src={rootUrl + element?.logo}
                    alt={element?.label}
                    layout={'responsive'}
                    loading={'lazy'}
                    width={210}
                    height={140}
                  />
                  <Checkbox
                    onChange={onChange}
                    className={'absolute top-0.5 right-[.5rem]'}
                    value={element?.value}
                  ></Checkbox>
                </div>
                <div className={'mt-[2rem] text-center text-body-16'}>
                  {element?.label}
                </div>
              </div>
            );
          })}
      </div>
      <ButtonComponent
        title={'Tiếp theo'}
        className={'primary min-w-[16rem] mt-[4rem]'}
        onClick={handlerSubmit}
      />
    </div>
  );
};
export default StepCountry;
