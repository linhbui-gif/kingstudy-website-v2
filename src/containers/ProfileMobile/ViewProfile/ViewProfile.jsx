import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import Avatar from '@/components/Avatar';
import BackToDashBoard from '@/containers/ProfileMobile/BackToDashBoard';
import { rootUrl } from '@/utils/utils';

const ViewProfile = ({ setSwitchUIMobile, profileState }) => {
  const userInformation = profileState?.profile?.user;
  return (
    <div className={'mt-[2rem] px-5'}>
      <div className={'p-5 shadow-md bg-white h-full container rounded-sm'}>
        <BackToDashBoard setSwitchUIMobile={setSwitchUIMobile} />
        <div className={'flex items-center justify-center mb-[2rem]'}>
          <div className={'text-center'}>
            <Avatar
              className={'w-[10rem] h-[10rem]'}
              image={
                userInformation
                  ? `${rootUrl}${userInformation?.image_url}`
                  : ImageAvatarDefault
              }
            />
            <div className={'mt-2 text-title-20 text-style-9'}>
              {' '}
              {userInformation?.full_name}
            </div>
          </div>
        </div>
        <div className={'mt-[3rem]'}>
          <ul>
            <li className={'pb-[1rem]'}>
              <h5 className={'text-body-14 text-style-9'}>Giới tính:</h5>
              <span className={'text-body-16 text-style-7'}>
                {userInformation?.gender === 'male' ? 'Nam' : 'Nữ'}
              </span>
            </li>
            <li
              className={'py-[1rem]'}
              style={{ borderTop: '1px solid #edeef2' }}
            >
              <h5 className={'text-body-14 text-style-9'}>Số điện thoại:</h5>
              <span className={'text-body-16 text-style-7'}>
                {profileState?.profile?.phone}
              </span>
            </li>
            <li
              className={'py-[1rem]'}
              style={{ borderTop: '1px solid #edeef2' }}
            >
              <h5 className={'text-body-14 text-style-9'}>Email:</h5>
              <span className={'text-body-16 text-style-7'}>
                {userInformation?.email}
              </span>
            </li>
            <li
              className={'py-[1rem]'}
              style={{ borderTop: '1px solid #edeef2' }}
            >
              <h5 className={'text-body-14 text-style-9'}>Địa chỉ:</h5>
              <span className={'text-body-16 text-style-7'}>
                {userInformation?.address}
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};
export default ViewProfile;
