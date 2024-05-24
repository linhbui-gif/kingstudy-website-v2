import { Collapse } from 'antd';

const Accordion = ({
  className,
  defaultActiveKey,
  collapsible,
  onChange,
  items,
  ...rest
}) => {
  return (
    <div className={`arcodion ${className}`}>
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
