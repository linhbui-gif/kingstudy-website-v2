import {EStyleButton} from "@/components/Button/Button.enum";
import {EIconName} from "@/components/Icon/Icon.enum";
import Icon from "@/components/Icon";
import {useRouter} from "next/router";

const ButtonComponent = ({ className = '', hasIcon = false, styleButton = EStyleButton.Normal, bgUrlButton = '', onClick, link = '' }) => {
  const router = useRouter()
  const handlerClick = () => {
    if(link !== '') router.push(link)
    else onClick?.()
  }
  return (
    <div
      className={`relative text-white text-center cursor-pointer ${className}`}
      style={{
        backgroundImage: `url(${bgUrlButton})`,
        backgroundRepeat: "no-repeat",
        backgroundPosition: "center",
        backgroundSize: "cover"
      }}
      onClick={handlerClick}
    >
      <div className={`absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] ${hasIcon ? 'flex w-full justify-center' : ''}`}>
        {hasIcon && <Icon name={EIconName.Wallet}/>}
        <span className={`uppercase font-[400] ${styleButton === EStyleButton.Normal ? 'text-[2rem]' : 'text-[2.2rem] md:text-[3.2rem]'}`}>DOWNLOAD APP</span>
        {styleButton === EStyleButton.CommingSoon && <p className={"m-0 uppercase font-[400] text-[1rem] tracking-[5px] md:text-[2rem] md:tracking-[10px]"}>COMING SOON</p>}
      </div>
    </div>
  )
}
export default ButtonComponent