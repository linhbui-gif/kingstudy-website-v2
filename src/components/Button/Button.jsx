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
          className="flex items-center justify-center gap-[8px]"
          style={{ flexDirection: reverse ? 'row-reverse' : undefined }}
        >
          {iconName && <Icon name={iconName} color={iconColor} />}
          {title && <span>{title}</span>}
          {secondIconName && (
            <Icon
              className={'mt-1'}
              name={secondIconName}
              color={secondIconColor}
            />
          )}
        </div>
      </AntdButton>
    </div>
  );
};
export default ButtonComponent;
