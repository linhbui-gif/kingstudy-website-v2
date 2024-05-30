import { Button as AntdButton } from 'antd';
import { useRouter } from 'next/router';

import Icon from '@/components/Icon';
const ButtonComponent = ({
  className,
  size,
  iconName,
  iconColor,
  type,
  htmlType,
  title,
  danger,
  reverse,
  link,
  disabled,
  loading,
  secondIconName,
  secondIconColor,
  onClick,
  block,
  style = '',
  widthIcon,
}) => {
  const router = useRouter();
  const handleClickButton = () => {
    if (link) router.push(link);
    else onClick?.();
  };
  return (
    <div className={`Button ${style}`}>
      <AntdButton
        className={className}
        size={size}
        type={type}
        htmlType={htmlType}
        onClick={handleClickButton}
        danger={danger}
        disabled={disabled}
        block={block}
        loading={loading}
      >
        <div
          className={` flex items-center gap-2 ${
            secondIconName ? 'secondIconName' : ''
          }`}
          style={{ flexDirection: reverse ? 'row-reverse' : undefined }}
        >
          {iconName && (
            <Icon width={widthIcon} name={iconName} color={iconColor} />
          )}
          {title && <span>{title}</span>}
          {secondIconName && (
            <Icon name={secondIconName} color={secondIconColor} />
          )}
        </div>
      </AntdButton>
    </div>
  );
};
export default ButtonComponent;
