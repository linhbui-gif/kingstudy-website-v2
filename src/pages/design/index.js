import React, { useState } from "react";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import ButtonComponent from "@/components/Button";
import {EStyleButton} from "@/components/Button/Button.enum";
import Carousels from "@/components/Carousels";

const Design = () => {
  const [isDragging, setIsDragging] = useState(false);
  return (
    <div>
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
    <div>
    <Carousels
          infinite={false}
          dots={true}
          arrows
          autoplay
          slidesToShow={3}
          responsive={[
            {
              breakpoint: 1600,
              settings: {
                slidesToShow: 5,
              },
            },
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 4,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 2,
              },
            },
          ]}
        >
          {[1,2,3,4,5,6].map((item) => (
            <div key={item} className="h-[200px] mr-4">
              <div className="text-2xl">hello</div>
            </div>
          ))}
        </Carousels>
    </div>
    </div>
  );
};

export default Design;
