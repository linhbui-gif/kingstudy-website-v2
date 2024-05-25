import Arcodion from '@/components/Arcodion';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
const AccordionSideBar = ({ childrenData, label }) => {
  const items = [
    {
      key: '1',
      label: label,
      children: childrenData,
    },
  ];

  const customExpandIcon = ({ isActive }) => (
    <div className="">
      {isActive ? (
        <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_PLUS} />
      ) : (
        <Icon
          className="transform rotate-180"
          name={EIconName.ArowDown}
          color={EIconColor.STYLE_PLUS}
        />
      )}
    </div>
  );
  return (
    <div className={'accordionSidebar'}>
      <Arcodion
        items={items}
        expandIcon={customExpandIcon}
        expandIconPosition={'end'}
      />
    </div>
  );
};
export default AccordionSideBar;
