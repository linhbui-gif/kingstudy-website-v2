import React, { useState } from 'react';

import Steps from '@/components/Step';
import StepInformation from '@/containers/StepSubmitProfile/StepInformation';
import StepUpload from '@/containers/StepSubmitProfile/StepUpload';

const StepSubmitProfile = () => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });

  const dataStep = [
    {
      id: '1',
      children: (
        <StepInformation onNext={(data) => handleNextStep('2', data)} />
      ),
    },
    {
      id: '2',
      children: <StepUpload />,
    },
  ];

  const handleNextStep = (keyStep, data) => {
    const changedStep = dataStep.find((option) => option.id === keyStep);
    setStepState({
      ...stepState,
      currentStep: changedStep,
      data: { ...stepState.data, ...data },
    });
  };

  return (
    <div className={''}>
      <div className={'rounded-[8px] '}>
        <Steps
          registerStore={true}
          lineWidth="6rem"
          title={'Tự nộp hồ sơ chỉ với 2 bước :'}
          options={dataStep}
          value={stepState.currentStep}
          onChange={(stepChanged) =>
            setStepState({ ...stepState, currentStep: stepChanged })
          }
          className={'h-full'}
        />
      </div>
    </div>
  );
};

export default StepSubmitProfile;
