import React, { useState } from 'react';

import { useRouter } from 'next/router';

import { ETypeNotification } from '@/common/enums';
import Steps from '@/components/Step';
import StepCountry from '@/containers/StepSurvey/StepCountry';
import StepEnd from '@/containers/StepSurvey/StepEnd';
import StepMajor from '@/containers/StepSurvey/StepMajor';
import { surveySchool } from '@/services/school';
import { parseObjectToFormData, showNotification } from '@/utils/function';
const StepSurvey = ({ setSchools, setActiveSchool }) => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });
  const [loading, setLoading] = useState(false);
  const onSubmitSurvey = (data) => {
    const body = { ...stepState?.data, ...data };
    body['country_id'] = JSON.stringify(body['country_id']);
    const formData = parseObjectToFormData(body);
    onSurveySchool?.(formData).then();
  };
  const dataStep = [
    {
      id: '1',
      children: <StepCountry onNext={(data) => handleNextStep('2', data)} />,
    },
    {
      id: '2',
      children: (
        <StepMajor
          onPrev={() => handlePrevStep('1')}
          onNext={(data) => handleNextStep('3', data)}
        />
      ),
    },
    {
      id: '3',
      children: (
        <StepEnd
          onPrev={() => handlePrevStep('2')}
          onSubmit={onSubmitSurvey}
          loading={loading}
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
  const onSurveySchool = async (body) => {
    try {
      setLoading(true);
      const response = await surveySchool(body);
      if (response?.code === 200) {
        setSchools(response?.data);
        setLoading(false);
        setActiveSchool(true)
        showNotification(
          ETypeNotification.SUCCESS,
          'Khảo sát trường thành công !'
        );
      }
    } catch (e) {
      setLoading(false);
      showNotification(
        ETypeNotification.ERROR,
        'Có lỗi xảy ra, vui lòng liên hệ Kỹ thuật để được hỗ trợ !'
      );
    }
  };
  return (
    <div className={''}>
      <div className={'rounded-[8px] '}>
        <Steps
          registerStore={true}
          lineWidth="6rem"
          title={'Khảo sát'}
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

export default StepSurvey;
