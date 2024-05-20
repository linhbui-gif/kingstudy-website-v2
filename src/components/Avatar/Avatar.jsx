import React, { useEffect, useState } from 'react';

import { Avatar as AntdAvatar } from 'antd';

import Icon from '@/components/Icon';

const Avatar = ({
  image,
  size,
  className,
  iconNameDefault,
  iconColorDefault,
}) => {
  const [isError, setIsError] = useState(false);

  useEffect(() => {
    setIsError(false);
  }, [image]);

  return (
    <AntdAvatar
      size={size}
      src={isError ? '' : image || (iconNameDefault ? undefined : '')}
      onError={() => {
        setIsError(true);
        return true;
      }}
      className={className}
    >
      {iconNameDefault && !image && (
        <Icon name={iconNameDefault} color={iconColorDefault} />
      )}
    </AntdAvatar>
  );
};

export default Avatar;
