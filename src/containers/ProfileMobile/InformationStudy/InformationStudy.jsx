import StudyAboardInformation from '@/containers/Profile/MyProfileInformation/StudyAboardInformation';
import BackToDashBoard from '@/containers/ProfileMobile/BackToDashBoard';

const InformationStudy = ({ userInformation, setSwitchUIMobile }) => {
  return (
    <div
      className={
        'flex mt-[2rem] px-5 pb-[10rem] min-h-screen overflow-y-scroll'
      }
    >
      <div className={'p-5 shadow-md bg-white container rounded-sm'}>
        <BackToDashBoard setSwitchUIMobile={setSwitchUIMobile} />
        <StudyAboardInformation userInformation={userInformation} />{' '}
      </div>
    </div>
  );
};
export default InformationStudy;
