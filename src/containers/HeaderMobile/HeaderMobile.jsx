"use client"

import LogoImage from "@/assets/images/image-logo.png"
import Image from "next/image";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import Link from "next/link";
import {MenuData} from "@/containers/Header/Header.data";
import {useState} from "react";

const HeaderMobile = () => {
  const [showDropdown, setShowDropdown] = useState(false)

  return (
    <div className={"block lg:hidden"}>
      <div className={"flex items-center justify-between"}>
        <Image className={"w-[8.5rem] h-[2.1rem]"} src={LogoImage} alt={''}/>
        <Icon name={EIconName.MenuBar} onClick={() => setShowDropdown(!showDropdown)} />
      </div>
      <div className={`absolute top-[100%] left-0 w-full max-h-0 overflow-hidden bg-black transition ease-in-out delay-150 ${showDropdown ? 'max-h-[100vh] ' : ''}`}>
        <ul className={"p-0"}>
          {
            MenuData.map((element) => {
              return (
                <li key={element?.id}>
                  <Link href="/"
                        className={`block w-full p-[1rem] text-white text-[2rem] uppercase ${element?.active ? 'text-gradient-menu' : ''}`}>{element?.name}</Link>
                </li>
              )
            })
          }
        </ul>
      </div>
    </div>
  )
}
export default HeaderMobile