import React from 'react';
import { EIconName } from './Icon.enum';
import MenuBar from "@/components/Icon/MenuBar";
import Flash from "@/components/Icon/Flash";
import Wallet from "@/components/Icon/Wallet";
import Hand from "@/components/Icon/Hand";
import FitGPT from "@/components/Icon/FitGPT";
import Facebook from "@/components/Icon/Facebook";
import Twitter from "@/components/Icon/Twitter";
import Telegram from "@/components/Icon/Telegram";
import Discord from "@/components/Icon/Discord";
import Instagram from "@/components/Icon/Instagram";
import Plan from "@/components/Icon/Plan";
import Sensor from "@/components/Icon/Sensor";
import Diet from "@/components/Icon/Diet";
import Apple from "@/components/Icon/Apple";
import Boots from "@/components/Icon/Boots";
import Clock from "@/components/Icon/Clock";
import Dumbbell from "@/components/Icon/Dumbbell";
import DiscordSmall from "@/components/Icon/DiscordSmall";
import Twitter_Small from "@/components/Icon/Twitter_Small";

const Icon = ({ name, className = '', color, style, onClick }) => {

    const renderIcon = () => {
        switch (name) {
            case EIconName.Wallet:
                return <Wallet/>
            case EIconName.MenuBar:
              return <MenuBar />
            case EIconName.Flash:
              return <Flash />
            case EIconName.Hand:
                return <Hand />
            case EIconName.FitGPT:
                return <FitGPT />
            case EIconName.Facebook:
                return <Facebook />
            case EIconName.Twitter:
                return <Twitter />
            case EIconName.Twitter_Small:
                return <Twitter_Small />
            case EIconName.Telegram:
                return <Telegram />
            case EIconName.Discord:
                return <Discord />
            case EIconName.Discord_Small:
                return <DiscordSmall />
            case EIconName.Instagram:
                return <Instagram />
            case EIconName.Plan:
                return <Plan />
            case EIconName.Sensor:
                return <Sensor />
            case EIconName.Diet:
                return <Diet />
            case EIconName.Apple:
                return <Apple />
            case EIconName.Boots:
                return <Boots />
            case EIconName.Clock:
                return <Clock />
            case EIconName.Dumbbell:
                return <Dumbbell />
            default:
                break;
        }
    }
    return (
        <div className={`flex justify-center items-center ${className}`} onClick={onClick}>
          {renderIcon()}
        </div>
    )
}
export default Icon;