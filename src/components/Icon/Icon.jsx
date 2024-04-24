import React from 'react';

import { EIconName } from './Icon.enum';
import Apple from '@/components/Icon/Apple';
import ArrowRight from '@/components/Icon/ArrowRight';
import Boots from '@/components/Icon/Boots';
import Clock from '@/components/Icon/Clock';
import Diet from '@/components/Icon/Diet';
import Discord from '@/components/Icon/Discord';
import DiscordSmall from '@/components/Icon/DiscordSmall';
import Dumbbell from '@/components/Icon/Dumbbell';
import Facebook from '@/components/Icon/Facebook';
import FitGPT from '@/components/Icon/FitGPT';
import Flash from '@/components/Icon/Flash';
import Hand from '@/components/Icon/Hand';
import Instagram from '@/components/Icon/Instagram';
import MenuBar from '@/components/Icon/MenuBar';
import Plan from '@/components/Icon/Plan';
import Sensor from '@/components/Icon/Sensor';
import Telegram from '@/components/Icon/Telegram';
import Twitter from '@/components/Icon/Twitter';
import Twitter_Small from '@/components/Icon/Twitter_Small';
import Wallet from '@/components/Icon/Wallet';

const Icon = ({ name, className = '', onClick }) => {
  const renderIcon = () => {
    switch (name) {
      case EIconName.Wallet:
        return <Wallet />;
      case EIconName.MenuBar:
        return <MenuBar />;
      case EIconName.Flash:
        return <Flash />;
      case EIconName.Hand:
        return <Hand />;
      case EIconName.FitGPT:
        return <FitGPT />;
      case EIconName.Facebook:
        return <Facebook />;
      case EIconName.Twitter:
        return <Twitter />;
      case EIconName.Twitter_Small:
        return <Twitter_Small />;
      case EIconName.Telegram:
        return <Telegram />;
      case EIconName.Discord:
        return <Discord />;
      case EIconName.Discord_Small:
        return <DiscordSmall />;
      case EIconName.Instagram:
        return <Instagram />;
      case EIconName.Plan:
        return <Plan />;
      case EIconName.Sensor:
        return <Sensor />;
      case EIconName.Diet:
        return <Diet />;
      case EIconName.Apple:
        return <Apple />;
      case EIconName.Boots:
        return <Boots />;
      case EIconName.Clock:
        return <Clock />;
      case EIconName.Dumbbell:
        return <Dumbbell />;
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
