import { Collapse } from 'antd';

const Accordion = ({
  defaultActiveKey,
  collapsible,
  onChange,
  items,
  ...rest
}) => {
  return (
    <div className="arcodion">
      <Collapse
        defaultActiveKey={defaultActiveKey}
        collapsible={collapsible}
        onChange={onChange}
        items={items}
        {...rest}
      />
    </div>
  );
};

export default Accordion;
