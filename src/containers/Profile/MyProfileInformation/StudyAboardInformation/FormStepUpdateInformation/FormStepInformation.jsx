import React, { useState } from 'react';

import Steps from '@/components/Step';
import InformationFamily from '@/containers/StepProfileStudyAboard/InformationFamily';
import InformationHistoryTravel from '@/containers/StepProfileStudyAboard/InformationHistoryTravel';
import InformationPersonal from '@/containers/StepProfileStudyAboard/InformationPersonal';
import InformationStudyArticle from '@/containers/StepProfileStudyAboard/InformationStudyArticle';
import InformationWork from '@/containers/StepProfileStudyAboard/InformationWork';

const FormStepInformation = ({ setIsUpdateToggle }) => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });
  const dataStep = [
    {
      id: '1',
      children: (
        <InformationPersonal onNext={(data) => handleNextStep('2', data)} />
      ),
    },
    {
      id: '2',
      children: (
        <InformationFamily
          onPrev={() => handlePrevStep('1')}
          onNext={(data) => handleNextStep('3', data)}
        />
      ),
    },
    {
      id: '3',
      children: (
        <InformationStudyArticle
          onPrev={() => handlePrevStep('2')}
          onNext={(data) => handleNextStep('4', data)}
        />
      ),
    },
    {
      id: '4',
      children: (
        <InformationWork
          onPrev={() => handlePrevStep('3')}
          onNext={(data) => handleNextStep('5', data)}
        />
      ),
    },
    {
      id: '5',
      children: (
        <InformationHistoryTravel
          setIsUpdateToggle={setIsUpdateToggle}
          onPrev={() => handlePrevStep('4')}
        />
      ),
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
  const handlePrevStep = (keyStep) => {
    const changedStep = dataStep.find((option) => option.id === keyStep);
    setStepState({
      ...stepState,
      currentStep: changedStep,
    });
  };
  return (
    <div>
      <Steps
        registerStore={true}
        lineWidth="6rem"
        options={dataStep}
        value={stepState.currentStep}
        onChange={(stepChanged) =>
          setStepState({ ...stepState, currentStep: stepChanged })
        }
        className={'h-full'}
      />
    </div>
  );
};
export default FormStepInformation;
