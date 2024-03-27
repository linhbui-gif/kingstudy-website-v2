import LogoImage from "@/assets/images/image-logo.png"
import Image from "next/image";
import Link from "next/link";
import {Button} from "antd";

const Header = () => {
  return (
    <div className={"flex items-center bg-black h-[108px]"}>
      <div className={"container px-4 mx-auto text-2xl"}>
          <div className={"flex items-center justify-between"}>
            <div>
              <Image src={LogoImage} alt={''}/>
            </div>
            <div className={"flex items-center gap-[40px]"}>
              <ul className={"flex items-center gap-[40px]"}>
                {
                  [1,2,3,4,5].map((element) => {
                    return (
                      <li key={element}>
                        <Link href="/" className={"text-white text-[20px]"}>Home</Link>
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
      </div>
    </div>
  )
}
export default Header