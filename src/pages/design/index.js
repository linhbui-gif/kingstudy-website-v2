import React from "react";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";
import ButtonComponent from "@/components/Button";
import {EStyleButton} from "@/components/Button/Button.enum";

import Image from "next/image";

const Design = () => {
  return (
     <div className="bg-black  bg-center bg-no-repeat bg-cover lg:bg-[length:100%_100%] pt-[20px] pb-[60px] lg:pt-[10px] lg:pb-[70px] h-[100vh] md:h-[200vh]">
        <div className="w-full max-w-[1024px] mx-auto px-4">
            <div className="flex flex-col items-center justify-center max-w-[1080px] m-auto relative">
                <Image src="/images/image-roadmap.svg" alt="Roadmap" width={419} height={346} className="relative z-[30]"/>
                <Image src="/images/image-total.svg" alt="Total" width={820} height={196} className="absolute z-[20] top-[73%] sm:hidden lg:block lg:w-[74%] lg:top-[70%]"/>
            </div>
            <div className="flex flex-col z-[40] lg:flex-row items-center lg:items-start justify-between w-full relative lg:-mt-[91px] gap-[30px] lg:gap-0 ">
               <div className=" md:w-[230px] md:left-[33%] md:absolute md:w-[269px] md:min-h-[269px] md:h-auto  md:bg-[url('/images/images-roadmap-item.svg')] md:bg-center md:bg-no-repeat md:bg-[length:100%_100%] lg:left-[1%]
                lg:top-[4rem]" >
                   <div className="md:absolute w-[94%] left-[3%] top-[27%] bg-white z-10 rounded-[2.8rem] h-full py-[4rem] z-[4rem] md:top-[29%]">
                       <p className=" absolute text-[#29282D4D] z-[3] -right-3 bottom-16 rotate-90 text-[30px] font-semibold">PHASE 01</p>
                       <ul className="list-disc font-ubuntu list-inside">
                           <li className="text-[#636363] text-[1.6rem]">Team Building</li>
                           <li className="text-[#636363] text-[1.6rem]">AI Training</li>
                           <li className="text-[#636363] text-[1.6rem]">Market Research</li>
                           <li className="text-[#636363] text-[1.6rem]">Design Website</li>
                           <li className="text-[#636363] text-[1.6rem]">Design System & UI Kits</li>
                           <li className="text-[#636363] text-[1.6rem]">Mockup Design</li>
                           <li className="text-[#636363] text-[1.6rem]">App Mechanisms & Documents</li>
                           <li className="text-[#636363] text-[1.6rem]">IOS & Android MVP finished</li>
                       </ul>
                   </div>
               </div>
                <div className="md:w-[230px] md:absolute md:left-[33%] md:top-[41rem]  w-[269px] min-h-[269px]  md:h-auto  md:bg-[url('/images/images-roadmap-item.svg')] md:bg-center md:bg-no-repeat md:bg-[length:100%_100%] p-10 lg:top-[7.7rem] lg:left-[36%] ">
                    <div className="absolute w-[94%] left-[3%] top-[27%] bg-white z-10 rounded-[2.8rem] h-full py-[4rem] z-[40px] md:top-[31%] ">
                        <p className=" absolute text-[#29282D4D] z-[3] -right-3 bottom-16 rotate-90 text-[30px] font-semibold">PHASE 02</p>
                        <ul className="list-disc font-ubuntu list-inside">
                                    <li className="text-[#636363] text-[1.6rem]">Private Test</li>
                                    <li className="text-[#636363] text-[1.6rem]">Community Building</li>
                                    <li className="text-[#636363] text-[1.6rem]">Fund Raising</li>
                                    <li className="text-[#636363] text-[1.6rem]">App Launch</li>
                                    <li className="text-[#636363] text-[1.6rem]">Affiliate Program</li>
                                    <li className="text-[#636363] text-[1.6rem]">IDO</li>
                                    <li className="text-[#636363] text-[1.6rem]">Token Launch</li>
                                    <li className="text-[#636363] text-[1.6rem]">NFT Marketplace</li>
                                    <li className="text-[#636363] text-[1.6rem]">Defi System</li>
                        </ul>
                    </div>
                </div>
                <div className="md:w-[230px] md:absolute  md:min-h-[269px] md:top-[91rem] md:left-[34%]  h-auto bg-[url('/images/images-roadmap-item.svg')]  bg-center bg-no-repeat bg-[length:100%_100%] p-10  lg:left-[72%] lg:top-[2.2rem]  ">
                    <div className="absolute w-[94%] left-[3%] top-[27%] bg-white z-10 rounded-[2.8rem] h-full py-[4rem] z-[4rem] md:top-[31%]">
                        <p className=" absolute text-[#29282D4D] z-[3] -right-3 bottom-16 rotate-90 text-[30px] font-semibold">PHASE 03</p>
                        <ul className="list-disc font-ubuntu list-inside">
                                    <li className="text-[#636363] text-[1.6rem]">Daily Missions</li>
                                    <li className="text-[#636363] text-[1.6rem]">Mini Games</li>
                                    <li className="text-[#636363] text-[1.6rem]">Achievement System</li>
                                    <li className="text-[#636363] text-[1.6rem]">Leaderboard Features</li>
                                    <li className="text-[#636363] text-[1.6rem]">Group / Guild Features</li>
                                    <li className="text-[#636363] text-[1.6rem]">Social Features</li>
                                    <li className="text-[#636363] text-[1.6rem]">Community Events</li>
                                    <li className="text-[#636363] text-[1.6rem]">Dating Features</li>
                                    <li className="text-[#636363] text-[1.6rem]">PVP Features</li>
                                    <li className="text-[#636363] text-[1.6rem]">Badges System</li>
                                    <li className="text-[#636363] text-[1.6rem]">DAO Model</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
     </div>
  );
};

export default Design;
