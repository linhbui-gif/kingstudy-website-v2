import React, { useEffect, useState } from 'react';

import { Form, Spin } from 'antd';
import dayjs from 'dayjs';
import localeData from 'dayjs/plugin/localeData';
import weekday from 'dayjs/plugin/weekday';
import moment from 'moment';

import { ETypeNotification } from '@/common/enums';
import Steps from '@/components/Step';
import InformationFamily from '@/containers/StepProfileStudyAboard/InformationFamily';
import InformationHistoryTravel from '@/containers/StepProfileStudyAboard/InformationHistoryTravel';
import InformationPersonal from '@/containers/StepProfileStudyAboard/InformationPersonal';
import InformationStudyArticle from '@/containers/StepProfileStudyAboard/InformationStudyArticle';
import InformationWork from '@/containers/StepProfileStudyAboard/InformationWork';
import { useAPI } from '@/contexts/APIContext';
import {
  getProfileStudyAboard,
  submitProfileStudyAboard,
} from '@/services/profile';
import { showNotification } from '@/utils/function';
dayjs.extend(weekday);
dayjs.extend(localeData);
const FormStepInformation = ({ setIsUpdateToggle }) => {
  const [stepState, setStepState] = useState({
    currentStep: undefined,
    data: undefined,
  });
  const { getProfileInfor } = useAPI();
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const [loadingProfileStudy, setLoadingProfileStudy] = useState(false);
  const formatDate = (date) =>
    date ? moment(date).format('YYYY/MM/DD') : null;
  useEffect(() => {
    getStudyAboardInformation().then();
  }, []);
  const dateFields = [
    'birth_day',
    'other_passport_date',
    'other_passport_card_expiration_date',
    'father_birth_day',
    'identity_card_date',
    'identity_card_expiration_date',
    'passport_date',
    'passport_expiration_date',
    'spouse_birth_day',
    'mother_birth_day',
    'child_1_birth_day',
    'child_2_birth_day',
    'ielts_date',
    'travel_history_1_time',
    'travel_history_2_time',
    'travel_history_3_time',
    'travel_history_4_time',
    'travel_history_5_time',
    'uk_date',
  ];
  const getStudyAboardInformation = async () => {
    try {
      setLoadingProfileStudy(true);
      const response = await getProfileStudyAboard();
      if (response?.status === 200) {
        const data = response?.data;
        setLoadingProfileStudy(false);
        Object.keys(data).forEach((field) => {
          if (dateFields.includes(field) && data[field] && field) {
            form.setFieldsValue({
              [field]: dayjs(data[field]),
            });
          }
        });
        form.setFieldsValue({
          name: data?.name,
          birth_day: dayjs(data?.birth_day),
          birth_place: data?.birth_place,
          gender: data?.gender,
          permanent_address: data?.permanent_address,
          current_address: data?.current_address,
          time_at_address: data?.time_at_address,
          phone: data?.phone,
          phone_2: data?.phone_2,
          email: data?.email,
          identity_card: data?.identity_card,
          identity_card_issued_by: data?.identity_card_issued_by,
          passport: data?.passport,
          passport_issued_by: data?.passport_issued_by,
          other_passport: data?.other_passport,
          other_passport_card: data?.other_passport_card,
          other_passport_issued_by: data?.other_passport_issued_by,
          father_name: data?.father_name,
          father_current_address: data?.father_current_address,
          father_job: data?.father_job,
          father_phone: data?.father_phone,
          father_email: data?.father_email,
          mother_name: data?.mother_name,
          mother_current_address: data?.mother_current_address,
          mother_job: data?.mother_job,
          mother_phone: data?.mother_phone,
          mother_email: data?.mother_email,
          marital_status: data?.marital_status,
          spouse_name: data?.spouse_name,
          spouse_nationality: data?.spouse_nationality,
          spouse_current_address: data?.spouse_current_address,
          child_1_name: data?.child_1_name,
          child_1_birth_place: data?.child_1_birth_place,
          child_1_nationality: data?.child_1_nationality,
          child_1_current_address: data?.child_1_current_address,
          child_2_name: data?.child_2_name,
          child_2_nationality: data?.child_2_nationality,
          child_2_current_address: data?.child_2_current_address,
          degree: data?.degree,
          is_work: data?.is_work,
          degree_school_name: data?.degree_school_name,
          degree_major: data?.degree_major,
          degree_school_year: data?.degree_school_year,
          degree_address: data?.degree_address,
          presenter_1_name: data?.presenter_1_name,
          presenter_1_position: data?.presenter_1_position,
          presenter_1_phone: data?.presenter_1_phone,
          presenter_1_email: data?.presenter_1_email,
          presenter_2_name: data?.presenter_2_name,
          presenter_2_position: data?.presenter_2_position,
          presenter_2_phone: data?.presenter_2_phone,
          presenter_2_email: data?.presenter_2_email,
          is_ielts: data?.is_ielts,
          ielts_overall: data?.ielts_overall,
          ielts_reading: data?.ielts_reading,
          ielts_listening: data?.ielts_listening,
          ielts_writing: data?.ielts_writing,
          ielts_speaking: data?.ielts_speaking,
          ielts_test_report_form: data?.ielts_test_report_form,
          is_worked_2: data?.is_worked_2,
          job_company_name: data?.job_company_name,
          job_working_time: data?.job_working_time,
          job_address: data?.job_address,
          job_phone: data?.job_phone,
          job_email: data?.job_email,
          job_position: data?.job_position,
          job_salary: data?.job_salary,
          is_gone_abroad: data?.is_gone_abroad,
          travel_history_1_nation: data?.travel_history_1_nation,
          travel_history_1_purpose: data?.travel_history_1_purpose,
          travel_history_2_nation: data?.travel_history_2_nation,
          travel_history_3_nation: data?.travel_history_3_nation,
          travel_history_4_nation: data?.travel_history_4_nation,
          travel_history_5_nation: data?.travel_history_5_nation,
          travel_history_3_purpose: data?.travel_history_3_purpose,
          travel_history_2_purpose: data?.travel_history_2_purpose,
          travel_history_4_purpose: data?.travel_history_4_purpose,
          travel_history_5_purpose: data?.travel_history_5_purpose,
          is_gone_uk: data?.is_gone_uk,
          uk_nl_number: data?.uk_nl_number,
          uk_brp_number: data?.uk_brp_number,
          is_fail_visa: data?.is_fail_visa,
          is_fail_visa_info: data?.is_fail_visa_info,
          is_warned_country: data?.is_warned_country,
          is_warned_country_info: data?.is_warned_country_info,
          is_relative_study_abroad: data?.is_relative_study_abroad,
          spouse_birth_place: data?.spouse_birth_place,
          child_2_birth_place: data?.child_2_birth_place,
          is_denine_info: data?.is_denine_info,
          is_denine: data?.is_denine,
          relative_abroad_name: data?.relative_abroad_name,
          relative_abroad_phone: data?.relative_abroad_phone,
          relative_abroad_email: data?.relative_abroad_email,
          relative_abroad_address: data?.relative_abroad_address,
        });
      }
    } catch (e) {
      setLoadingProfileStudy(true);
    }
  };
  const onSaveProfile = async (endStep) => {
    try {
      const formattedData = { ...stepState?.data, ...endStep };
      Object.keys(formattedData).forEach((field) => {
        if (dateFields.includes(field) && formattedData[field] && field) {
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
          form={form}
          onPrev={() => setIsUpdateToggle(false)}
          onNext={(data) => handleNextStep('2', data)}
        />
      ),
    },
    {
      id: '2',
      children: (
        <InformationFamily
          form={form}
          onPrev={() => handlePrevStep('1')}
          onNext={(data) => handleNextStep('3', data)}
        />
      ),
    },
    {
      id: '3',
      children: (
        <InformationStudyArticle
          form={form}
          onPrev={() => handlePrevStep('2')}
          onNext={(data) => handleNextStep('4', data)}
        />
      ),
    },
    {
      id: '4',
      children: (
        <InformationWork
          form={form}
          onPrev={() => handlePrevStep('3')}
          onNext={(data) => handleNextStep('5', data)}
        />
      ),
    },
    {
      id: '5',
      children: (
        <InformationHistoryTravel
          form={form}
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
      <Spin spinning={loadingProfileStudy}>
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
      </Spin>
    </div>
  );
};
export default FormStepInformation;
