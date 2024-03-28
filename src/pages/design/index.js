import React from "react";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import ButtonComponent from "@/components/Button";
import {EStyleButton} from "@/components/Button/Button.enum";
import Total from "@/components/Icon/Total";
import Image from "next/image";

const Design = () => {
  return (
    <div className="flex justify-center p-[20px] bg-black">
        <ButtonComponent
          className={'flex justify-center gap-2 items-center w-[21.6rem] h-[4.8rem]'}
          bgUrlButton={'/images/image-border-button.png'}
          hasIcon={true}
        />
        <ButtonComponent
          className={'w-[38.7rem] h-[8.6rem]'}
          bgUrlButton={'/images/image-border-gray-button.png'}
          styleButton={EStyleButton.CommingSoon}
        />
        <Icon name={EIconName.Discord_Small}/>
        <Icon name={EIconName.Facebook}/>
        <Icon name={EIconName.Twitter}/>
        <Icon name={EIconName.Twitter_Small}/>
        <Icon name={EIconName.Instagram}/>
        <Icon name={EIconName.FitGPT}/>
        <Icon name={EIconName.Sensor}/>
        <Icon name={EIconName.Plan}/>
        <Icon name={EIconName.Diet}/>
        <Icon name={EIconName.Wallet}/>
        <Icon name={EIconName.Telegram}/>
        <Icon name={EIconName.Discord}/>
        <Icon name={EIconName.Apple}/>
        <Icon name={EIconName.Boots}/>
        <Icon name={EIconName.Clock}/>
        <Icon name={EIconName.Dumbbell}/>
        <Icon name={EIconName.MenuBar}/>
        <Icon name={EIconName.Flash}/>
    </div>
  );
};

export default Design;
