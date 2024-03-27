import React from "react";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import ButtonComponent from "@/components/Button";
import {EStyleButton} from "@/components/Button/Button.enum";

const Design = () => {
  return (
    <div className="flex justify-center p-[20px]">
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
    </div>
  );
};

export default Design;
