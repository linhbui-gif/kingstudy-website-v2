import LogoImage from "@/assets/images/image-logo.png"
import Image from "next/image";
import Link from "next/link";
import {Button} from "antd";
import {MenuData} from "@/containers/Header/Header.data";
import { useMediaQuery } from 'react-responsive';
import HeaderMobile from "@/containers/HeaderMobile";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";

const Header = () => {
  const isTablet = useMediaQuery({ maxWidth: 991 });
  return (
    <div className={`relative flex items-center ${isTablet ? 'bg-black h-[108px]' : 'bg-black h-[108px]'}`}>
      <div className={"container px-4 mx-auto text-2xl"}>
        <div className={"hidden lg:flex  items-center justify-between"}>
          <div>
            <Image src={LogoImage} alt={''}/>
          </div>
          <div className={"flex items-center gap-[4rem]"}>
            <ul className={"flex items-center gap-[4rem]"}>
              {
                MenuData.map((element) => {
                  return (
                    <li key={element?.id}>
                      <Link href="/"
                            className={`relative py-[1rem] text-white text-[2rem] uppercase ${element?.active ? 'text-gradient-menu' : ''}`}>
                        {element?.name}
                        {element?.active && <Icon className={"absolute top-0 left-[50%] translate-x-[-50%]"} name={EIconName.Flash}/>}
                      </Link>
                    </li>
                  )
                })
              }
            </ul>
            <div>
              <Button>
                Connect Wallet
              </Button>
            </div>
          </div>
        </div>
        <HeaderMobile />
      </div>
    </div>
  )
}
export default Header