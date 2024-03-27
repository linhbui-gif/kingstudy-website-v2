import React from "react";
import Icon from "@/components/Icon";
import {EIconName} from "@/components/Icon/Icon.enum";

const Design = () => {
  return (
    <div className="flex justify-center p-[20px]">
        <div
            className="flex justify-center gap-2 items-center text-white whitespace-nowrap cursor-pointer"
            style={{
                backgroundImage: "url('/images/image-border-button.png')",
                backgroundRepeat: "no-repeat",
                backgroundPosition: "center",
                backgroundSize: "cover",
                width: "21.6rem",
                height: "4.8rem",
            }}
        >
            <Icon name={EIconName.Wallet} />
            <span className="uppercase text-[2rem]">Connect wallet</span>
        </div>
      <div
        className="relative text-white text-center cursor-pointer"
        style={{
          backgroundImage: "url('/images/image-border-gray-button.png')",
          backgroundRepeat: "no-repeat",
          backgroundPosition: "center",
          backgroundSize: "cover",
          width: "38.7rem",
          height: "8.6rem",
        }}
      >
        <div className={"absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"}>
          <span className="uppercase font-[400] text-[3.2rem]">DOWNLOAD APP</span>
          <p className={"m-0 uppercase font-[400] text-[2rem] tracking-[10px]"}>COMING SOON</p>
        </div>
      </div>
    </div>
  );
};

export default Design;
