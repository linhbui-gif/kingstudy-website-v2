import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';

const BackToDashBoard = ({ setSwitchUIMobile }) => {
  return (
    <div
      className={'h-[2rem] flex items-center justify-start gap-2'}
      onClick={() => setSwitchUIMobile(null)}
    >
      <Icon
        className={'rotate-[90deg]'}
        name={EIconName.ArowDown}
        color={EIconColor.STYLE_10}
        width={15}
        height={15}
      />
      <span className={'text-body-14'}>Back</span>
    </div>
  );
};
export default BackToDashBoard;
