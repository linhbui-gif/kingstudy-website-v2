import UploadFileMutiple from '@/components/UploadFileMutiple';

const StepUpload = () => {
  return (
    <div className={'my-[3rem]'}>
      <div className={'my-[4rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ học thuật</h3>
        <UploadFileMutiple />
      </div>
      <div className={'mb-[3rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ cá nhân</h3>
        <UploadFileMutiple />
      </div>
      <div className={'mb-[3rem]'}>
        <h3 className={'text-title-20'}>Hồ sơ tài chính</h3>
        <UploadFileMutiple />
      </div>
    </div>
  );
};
export default StepUpload;
