import ImageAi from "@/assets/images/image-AI-polygon.png"
import ImageCoin from "@/assets/images/image-coin.png"
import ImageOverLay from "@/assets/images/image-bg-IA.png"
import Image from "next/image";

const Personal = () => {
  return (
    <div className={"bg-black-2"}>
      <div>
        <h3 className={"w-full mb-0 text-gradient-menu text-[2rem] md:text-[5rem] text-center font-[400]" }>Personal trainer created by artificial intelligence</h3>
        <p className={"m-0 text-gray text-center text-[1.8rem] font-[300] font-Unbutu"}>FitGPT: Personalized AI fitness coaching for all</p>
        <div className={""}>
          <div style={{
            backgroundImage: "url('/images/image-personal-combine-icon.png')",
            backgroundSize:'cover',
            backgroundPosition:'center'
          }} className={"w-full h-[30rem] md:h-[100vh]"}></div>
        </div>
      </div>
      <div>
        <div className="container mx-auto px-[1.5rem] xl:px-0">
          <div className={"flex items-center flex-wrap mb-[4rem]"}>
            <div className={"w-[50%] text-center"}>
              <div className={"relative w-full"}>
                <div className={"relative w-[16.2rem] h-[16.2rem] lg:w-auto lg:h-auto lg:static"}>
                  <Image className={"absolute lg:static top-0 left-0 z-50 aspect-square w-full h-full  md:w-auto md:h-auto"} src={ImageAi} alt={''} />
                </div>
                <div className={"absolute top-[50%] left-0 z-50 md:translate-x-[50%] translate-y-[-50%] w-[8.3rem] h-[7.5rem] md:w-auto md:h-auto"} >
                  <Image className={"w-full h-full"} src={ImageCoin} alt={''}/>
                </div>
                {/*<div className={"absolute top-0 left-0 z-20 translate-x-[-30%] translate-y-[-20%]"}>*/}
                {/*  <Image src={ImageOverLay} alt={''}/>*/}
                {/*</div>*/}
              </div>
            </div>
            <div className={"w-[50%]"}>
              <h3 className={"m-0 text-blue text-[2.2rem] lg:text-[5rem] uppercase font-[400] leading-[50px]"}>
                Earn <br className={"hidden lg:block"}/>
                daily income
              </h3>
              <p className={"text-gray font-Unbutu text-[1.4rem] lg:text-[2rem] m-0"}>Get daily rewards via USDT by finishing <br className={"hidden lg:block"}/>
                your workout</p>
            </div>
          </div>
          <div className={"flex items-center flex-wrap mb-[4rem]"}>
            <div className={"w-[50%] text-center order-2"}>
              <div className={"relative w-full"}>
                <div className={"relative w-[16.2rem] h-[16.2rem] lg:w-auto lg:h-auto lg:static"}>
                  <Image className={"absolute lg:static top-0 left-0 aspect-square w-full h-full  md:w-auto md:h-auto"} src={ImageAi} alt={''} />
                </div>
                {/*<div className={"absolute top-0 left-0 z-20 translate-x-[-10%] translate-y-[-30%]"}>*/}
                {/*  <Image src={ImageOverLay} alt={''}/>*/}
                {/*</div>*/}
              </div>
            </div>
            <div className={"w-[50%] md:text-right order-1"}>
              <h3 className={"m-0 text-blue text-[2.2rem] lg:text-[5rem] uppercase font-[400] leading-[50px]"}>
                Earn <br className={"hidden lg:block"}/>
                daily income
              </h3>
              <p className={"text-gray font-Unbutu text-[1.4rem] lg:text-[2rem] m-0"}>Get daily rewards via USDT by finishing <br className={"hidden lg:block"}/>
                your workout</p>
            </div>
          </div>
          <div className={"flex items-center flex-wrap mb-[4rem]"}>
            <div className={"w-[50%] text-center order-1"}>
              <div className={"relative w-full"}>
                <div className={"relative w-[16.2rem] h-[16.2rem] lg:w-auto lg:h-auto lg:static"}>
                  <Image className={"absolute lg:static top-0 left-0 aspect-square w-full h-full  md:w-auto md:h-auto"} src={ImageAi} alt={''} />
                </div>
                {/*<div className={"absolute top-0 left-0 z-20 translate-x-[-30%] translate-y-[-20%]"}>*/}
                {/*  <Image src={ImageOverLay} alt={''}/>*/}
                {/*</div>*/}
              </div>
            </div>
            <div className={"w-[50%] order-2"}>
              <h3 className={"m-0 text-blue text-[2.2rem] lg:text-[5rem] uppercase font-[400] leading-[50px]"}>
                Earn <br className={"hidden lg:block"}/>
                daily income
              </h3>
              <p className={"text-gray font-Unbutu text-[1.4rem] lg:text-[2rem] m-0"}>Get daily rewards via USDT by finishing <br className={"hidden lg:block"}/>
                your workout</p>
            </div>
          </div>
          <div className={"flex items-center flex-wrap mb-[4rem]"}>
            <div className={"w-[50%] text-center order-2"}>
              <div className={"relative w-full"}>
                <div className={"relative w-[16.2rem] h-[16.2rem] lg:w-auto lg:h-auto lg:static"}>
                  <Image className={"absolute lg:static top-0 left-0 aspect-square w-full h-full  md:w-auto md:h-auto"} src={ImageAi} alt={''} />
                </div>
                {/*<div className={"absolute top-0 left-0 z-20 translate-x-[-10%] translate-y-[-30%]"}>*/}
                {/*  <Image src={ImageOverLay} alt={''}/>*/}
                {/*</div>*/}
              </div>
            </div>
            <div className={"w-[50%] md:text-right order-1"}>
              <h3 className={"m-0 text-blue text-[2.2rem] lg:text-[5rem] uppercase font-[400] leading-[50px]"}>
                Earn <br className={"hidden lg:block"}/>
                daily income
              </h3>
              <p className={"text-gray font-Unbutu text-[1.4rem] lg:text-[2rem] m-0"}>Get daily rewards via USDT by finishing <br className={"hidden lg:block"}/>
                your workout</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
export default Personal