import Tabs from '@/components/Tabs';

const InputRequest = () => {
  const campusOptions = [
    {
      key: 'dubi',
      title: 'Dự bị đại học',
      children: (
        <div className={'border border-solid border-[#DEE2E6] rounded-sm'}>
          <ul>
            <li
              className={'flex items-center justify-between p-[1.8rem_1.6rem]'}
              style={{ borderBottom: '1px solid #DEE2E6' }}
            >
              <span className={'text-button-16 text-style-7'}>Phân loại</span>
              <span className={'text-button-16 text-style-7'}>
                Mức chi phí trên năm (GBP)
              </span>
            </li>
            {[1, 2, 3, 4].map((element) => {
              return (
                <li
                  key={element}
                  className={
                    'flex items-center justify-between p-[1.8rem_1.6rem]'
                  }
                  style={{ borderBottom: '1px solid #DEE2E6' }}
                >
                  <span className={'text-body-16 text-style-12'}>Học phí</span>
                  <span className={'text-body-16 text-style-12'}>£15,900</span>
                </li>
              );
            })}
            <li
              className={'flex items-center justify-between p-[1.8rem_1.6rem]'}
            >
              <span className={'text-body-16 text-style-12'}>Học phí</span>
              <span className={'text-body-16 text-style-12'}>£15,900</span>
            </li>
          </ul>
        </div>
      ),
    },
    {
      key: 'dh',
      title: 'Đại học',
      children: (
        <div className={'border border-solid border-[#DEE2E6] rounded-sm'}>
          <ul>
            <li
              className={'flex items-center justify-between p-[1.8rem_1.6rem]'}
              style={{ borderBottom: '1px solid #DEE2E6' }}
            >
              <span className={'text-button-16 text-style-7'}>Phân loại 1</span>
              <span className={'text-button-16 text-style-7'}>
                Mức chi phí trên năm (GBP)
              </span>
            </li>
            {[1, 2, 3, 4].map((element) => {
              return (
                <li
                  key={element}
                  className={
                    'flex items-center justify-between p-[1.8rem_1.6rem]'
                  }
                  style={{ borderBottom: '1px solid #DEE2E6' }}
                >
                  <span className={'text-body-16 text-style-12'}>Học phí</span>
                  <span className={'text-body-16 text-style-12'}>£15,900</span>
                </li>
              );
            })}
            <li
              className={'flex items-center justify-between p-[1.8rem_1.6rem]'}
            >
              <span className={'text-body-16 text-style-12'}>Học phí</span>
              <span className={'text-body-16 text-style-12'}>£15,900</span>
            </li>
          </ul>
        </div>
      ),
    },
  ];
  return <Tabs options={campusOptions} defaultKey="dubi" />;
};
export default InputRequest;
