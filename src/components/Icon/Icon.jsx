import React from 'react';

import { EIconName } from './Icon.enum';
import ArrowRight from '@/components/Icon/ArrowRight';
const Icon = ({ name, className = '', onClick }) => {
  const renderIcon = () => {
    switch (name) {
      case EIconName.Arrow_Right:
        return <ArrowRight />;
      default:
        break;
    }
  };
  return (
    <div
      className={`flex justify-center items-center ${className}`}
      onClick={onClick}
    >
      {renderIcon()}
    </div>
  );
};
export default Icon;
