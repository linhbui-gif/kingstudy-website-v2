const MyProfileInformation = () => {
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>My Profile</h4>
      <ul>
        {[1, 2, 3, 4, 5, 6].map((element) => {
          return (
            <li className={'flex items-center mb-[2rem]'} key={element}>
              <h5 className={'text-body-16 text-style-7 min-w-[23rem] mb-0'}>
                Registration Date :
              </h5>
              <span className={'text-body-16 text-style-9'}>
                October 15, 2022 10:30 am
              </span>
            </li>
          );
        })}
      </ul>
    </div>
  );
};
export default MyProfileInformation;
