import { useState } from 'react';

import { Flex } from 'antd';

import FormStepInformation from '@/containers/Profile/MyProfileInformation/StudyAboardInformation/FormStepUpdateInformation';

const StudyAboardInformation = ({ isUpdated = false }) => {
  const [isUpdateToggle, setIsUpdateToggle] = useState(false);
  return (
    <div>
      {!isUpdated && !isUpdateToggle && (
        <Flex align={'center'} className={'justify-between'}>
          <div>
            Trạng thái : <span className={'text-orange'}>Chưa cập nhật</span>
          </div>
          <span
            onClick={() => setIsUpdateToggle(true)}
            className={'cursor-pointer text-orange text-body-16 font-[500]'}
          >
            Cập nhật ngay
          </span>
        </Flex>
      )}
      {isUpdated ||
        (isUpdateToggle && (
          <FormStepInformation setIsUpdateToggle={setIsUpdateToggle} />
        ))}
    </div>
  );
};
export default StudyAboardInformation;
