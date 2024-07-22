import React, { useState } from 'react';

import moment from 'moment';

import { ETypeNotification } from '@/common/enums';
import Steps from '@/components/Step';
import InformationFamily from '@/containers/StepProfileStudyAboard/InformationFamily';
import InformationHistoryTravel from '@/containers/StepProfileStudyAboard/InformationHistoryTravel';
import InformationPersonal from '@/containers/StepProfileStudyAboard/InformationPersonal';
import InformationStudyArticle from '@/containers/StepProfileStudyAboard/InformationStudyArticle';
import InformationWork from '@/containers/StepProfileStudyAboard/InformationWork';
import { useAPI } from '@/contexts/APIContext';
import { submitProfileStudyAboard } from '@/services/profile';
import { showNotification } from '@/utils/function';

const FormStepInformation = ({ setIsUpdateToggle }) => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });
  const { getProfileInfor } = useAPI();
  const [loading, setLoading] = useState(false);
  const formatDate = (date) =>
    date ? moment(date).format('YYYY/MM/DD') : null;

  const dateFields = [
    'birth_day',
    'father_birth_day',
    'identity_card_date',
    'identity_card_expiration_date',
    'passport_date',
    'passport_expiration_date',
    'spouse_birth_day',
  ];
  const onSaveProfile = async () => {
    try {
      const formattedData = { ...stepState?.data };

      Object.keys(formattedData).forEach((field) => {
        if (dateFields.includes(field) && formattedData[field]) {
          formattedData[field] = formatDate(formattedData[field]);
        }
      });
      setLoading(true);
      const response = await submitProfileStudyAboard(formattedData);
      if (response?.status === 200) {
        setLoading(false);
        setIsUpdateToggle(false);
        getProfileInfor().then();
        showNotification(
          ETypeNotification.SUCCESS,
          'Cập Nhật hồ sơ thành công !'
        );
      }
    } catch (e) {
      setLoading(false);
      setIsUpdateToggle(true);
      showNotification(
        ETypeNotification.ERROR,
        'Có lỗi xảy ra, vui lòng liên hệ Kỹ thuật để được hỗ trợ !'
      );
    }
  };
  const dataStep = [
    {
      id: '1',
      children: (
        <InformationPersonal
          onPrev={() => setIsUpdateToggle(false)}
          onNext={(data) => handleNextStep('2', data)}
        />
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
          onSubmit={onSaveProfile}
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
