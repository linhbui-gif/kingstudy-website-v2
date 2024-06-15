import React from 'react';

import ButtonComponent from '@/components/Button';
import UploadFileMutiple from '@/components/UploadFileMutiple';

const StepUpload = ({ stepState, setStepState, onSubmit, loading }) => {
  return (
    <div className={'my-[3rem]'}>
      <div className={'my-[4rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ học thuật</h3>
        <UploadFileMutiple
          onChange={(data) => {
            setStepState({
              ...stepState,
              data: { ...stepState?.data, 'academic_files[]': data },
            });
          }}
        />
      </div>
      <div className={'mb-[3rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ cá nhân</h3>
        <UploadFileMutiple
          onChange={(data) => {
            setStepState({
              ...stepState,
              data: { ...stepState?.data, 'profile_files[]': data },
            });
          }}
        />
      </div>
      <div className={'mb-[3rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ tài chính</h3>
        <UploadFileMutiple
          onChange={(data) => {
            setStepState({
              ...stepState,
              data: { ...stepState?.data, 'finance_files[]': data },
            });
          }}
        />
      </div>
      <div>
        <ButtonComponent
          title={'Hoàn thành'}
          className={'primary min-w-[16rem]'}
          onClick={onSubmit}
          loading={loading}
        />
      </div>
    </div>
  );
};
export default StepUpload;
