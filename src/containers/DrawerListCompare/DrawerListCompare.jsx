import { Drawer } from 'antd';
import Image from 'next/image';

import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import { rootUrl } from '@/utils/utils';
const DrawerListCompare = ({ open, onClose, data, removeSchoolCompare }) => {
  return (
    <Drawer
      title="Danh sách so sánh trường"
      placement={'bottom'}
      width={200}
      onClose={onClose}
      open={open}
      height={200}
    >
      <div className={'flex items-center justify-between'}>
        <div className={'flex items-center flex-1 justify-center gap-3'}>
          {data &&
            data.map((element) => {
              return (
                <div
                  key={element?.id}
                  className={
                    'relative flex items-center justify-center w-[7rem] h-[7rem] rounded-full p-[.6rem] transition border border-[#dfe3e6] border-solid group hover:border-Tailwind/black'
                  }
                >
                  <Image
                    src={`${rootUrl}${element?.logo ? element?.logo : ''}`}
                    alt={element?.name}
                    width={70}
                    height={70}
                    layout={'responsive'}
                    loading={'lazy'}
                    className={'w-full object-fill rounded-full'}
                  />
                  <Icon
                    name={EIconName.Minus}
                    className={
                      'absolute bottom-0 translate-y-[50%] w-[2rem] h-[2rem] bg-Tailwind/black rounded-full cursor-pointer opacity-0 invisible group-hover:visible group-hover:opacity-[1]'
                    }
                    onClick={() => {
                      removeSchoolCompare?.(element?.id).then();
                    }}
                  />
                </div>
              );
            })}
        </div>
        <ButtonComponent title={'So sánh'} className={'primary w-[15rem]'} />
      </div>
    </Drawer>
  );
};
export default DrawerListCompare;
