import React, { useState } from 'react';

// import { useRouter } from 'next/router';
//
// import {
//   EProfileSidebar,
//   ETypeNotification,
//   EUploadType,
// } from '@/common/enums';
import Steps from '@/components/Step';
import StepCountry from '@/containers/StepSurvey/StepCountry';
import StepMajor from '@/containers/StepSurvey/StepMajor';
// import { Paths } from '@/routers/constants';
// import { submitProfile } from '@/services/profile';
// import { showNotification } from '@/utils/function';

const StepSurvey = () => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });
  // const [loading, setLoading] = useState(false);
  // const router = useRouter();
  // const extractOriginFileObjs = (filesArray) => {
  //   return filesArray?.map((element) => element?.originFileObj);
  // };
  // const parseObjectToFormData = (obj) => {
  //   const formData = new FormData();
  //
  //   Object.keys(obj).forEach((key) => {
  //     if (Array.isArray(obj[key])) {
  //       obj[key].forEach((item) => {
  //         formData.append(`${key}`, item);
  //       });
  //     } else {
  //       formData.append(key, obj[key]);
  //     }
  //   });
  //
  //   return formData;
  // };

  // const onSubmitProfile = () => {
  //   let body = { ...stepState?.data, object: EUploadType.ATTACHMENT };
  //   body['academic_files[]'] = extractOriginFileObjs(body['academic_files[]']);
  //   body['profile_files[]'] = extractOriginFileObjs(body['profile_files[]']);
  //   body['finance_files[]'] = extractOriginFileObjs(body['finance_files[]']);
  //
  //   const formData = parseObjectToFormData(body);
  //
  //   onSaveProfile?.(formData).then();
  // };
  const dataStep = [
    {
      id: '1',
      children: <StepCountry onNext={(data) => handleNextStep('2', data)} />,
    },
    {
      id: '2',
      children: <StepMajor />,
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
  // const onSaveProfile = async (body) => {
  //   try {
  //     setLoading(true);
  //     const response = await submitProfile(body);
  //     if (response?.status === 200) {
  //       setLoading(false);
  //       router.push(
  //         `${Paths.Profile.View}?page=${EProfileSidebar.MANAGER_PROFILE_INFORMATION}`
  //       );
  //       showNotification(ETypeNotification.SUCCESS, 'Nộp hồ sơ thành công !');
  //     }
  //   } catch (e) {
  //     setLoading(false);
  //     showNotification(
  //       ETypeNotification.ERROR,
  //       'Có lỗi xảy ra, vui lòng liên hệ Kỹ thuật để được hỗ trợ !'
  //     );
  //   }
  // };
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
