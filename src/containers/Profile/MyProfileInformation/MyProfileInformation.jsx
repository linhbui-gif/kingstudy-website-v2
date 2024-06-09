import { Skeleton } from 'antd';

const MyProfileInformation = ({ loading, profileState }) => {
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>My Profile</h4>
      <Skeleton loading={loading}>
        <ul>
          <li className={'flex items-center mb-[2rem]'}>
            <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
              Họ và Tên:
            </h5>
            <span className={'text-body-16 text-style-9'}>
              {profileState?.full_name}
            </span>
          </li>
          <li className={'flex items-center mb-[2rem]'}>
            <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
              Email:
            </h5>
            <span className={'text-body-16 text-style-9'}>
              {profileState?.email}
            </span>
          </li>
          <li className={'flex items-center mb-[2rem]'}>
            <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
              Số điện thoại:
            </h5>
            <span className={'text-body-16 text-style-9'}>
              {profileState?.phone}
            </span>
          </li>
          <li className={'flex items-center mb-[2rem]'}>
            <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
              Giới tính:
            </h5>
            <span className={'text-body-16 text-style-9'}>
              {profileState?.gender}
            </span>
          </li>
          <li className={'flex items-center mb-[2rem]'}>
            <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
              Địa chỉ:
            </h5>
            <span className={'text-body-16 text-style-9'}>
              {profileState?.address}
            </span>
          </li>
        </ul>
      </Skeleton>
    </div>
  );
};
export default MyProfileInformation;
