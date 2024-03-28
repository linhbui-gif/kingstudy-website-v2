import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import Image from "next/image";
import ImageLeftHero from "@/assets/images/image-hero-left.png"
import ImageRightHero from "@/assets/images/image-hero-right.png"
import React from "react";
import {EStyleButton} from "@/components/Button/Button.enum";
import ButtonComponent from "@/components/Button";

const Hero = () => {
  return (
    <div className={"relative flex w-full h-[100vh]"} style={{ backgroundImage: "url('/images/image-hero.png')", backgroundSize: 'cover', backgroundPosition:"center center" }}>
      <div className={"relative max-w-[73.5rem] m-[20rem] mx-auto z-20"}>
          <div>
            <div className={"flex items-center justify-center w-full text-white font-Kan font-bold text-[2rem] md:text-[5rem] italic uppercase text-center"}>
              More healthy
              <div>
                <Image src={ImageRightHero} alt={''}/>
              </div>
            </div>
            <div className={"md:min-w-[65.3rem] bg-gradient-blue px-[2rem] py-[1rem] text-white font-Kan font-bold text-[2.2rem] md:text-[6.8rem] italic uppercase text-center"}>
              more beautiful
            </div>
            <div className={"md:min-w-[54rem] bg-white  px-[2rem] py-[1rem] text-white font-Kan font-bold text-[2.2rem] md:text-[6.8rem] italic uppercase text-center"}>
              <span className={"text-gradient-menu"}> more income</span>
            </div>
            <div className={"flex items-center justify-center gap-[1.2rem] mt-[2rem] font-Kan "}>
              <span className={"text-white text-[1.8rem] md:text-[2.8rem] font-[600] uppercase"}>Get PLAN</span>
              <Icon name={EIconName.Arrow_Right} />
              <span className={"text-white text-[1.8rem] md:text-[2.8rem] font-[600] uppercase"}>BUY WORKOUT PACK</span>
              <Icon name={EIconName.Arrow_Right} />
              <span className={"text-white text-[1.8rem] md:text-[2.8rem] font-[600] uppercase"}>Earn</span>
            </div>
          </div>
          <div className={"absolute top-0 left-0 translate-x-[-20%] translate-y-[30%]"}>
            <Image src={ImageLeftHero} alt={''} />
          </div>
      </div>
      <div className={"absolute bg-black w-full h-full top-0 left-0 opacity-[0.4] z-10"}></div>
      <div className={"absolute bottom-[28px] w-full z-50"}>
        <div className={"flex items-center justify-center gap-[17px]"}>
          <div>
            <Icon name={EIconName.Twitter}/>
            <p className={"text-white text-[1.4rem] font-Unbutu"}>Tele Group</p>
          </div>
          <div>
            <Icon name={EIconName.Twitter}/>
            <p className={"text-white text-[1.4rem] font-Unbutu"}>Tele Group</p>
          </div>
        </div>
        <div className={"flex items-center justify-center"}>
          <ButtonComponent
            className={'w-[26.5rem] h-[5.8rem] md:w-[38.7rem] md:h-[8.6rem]'}
            bgUrlButton={'/images/image-border-gray-button.png'}
            styleButton={EStyleButton.CommingSoon}
          />
        </div>
      </div>
    </div>
  )
}
export default Hero