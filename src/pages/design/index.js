import React from "react";
import Image from "next/image";
import wallet from "@/assets/images/wallet.png";

const Design = () => {
  return (
    <div class=" bg-black flex justify-center p-[20px]">
        <div
            className="flex justify-center  gap-2 items-center text-white  whitespace-nowrap"
            style={{
                backgroundImage: "url('/images/btnborder.png')",
                backgroundRepeat: "no-repeat",
                backgroundPosition: "center",
                backgroundSize: "cover",
                width: "21.6rem",
                height: "4.8rem",
            }}
        >
            <Image src={wallet} alt="wallet-icon" width={25} height={25} />
            <p className="uppercase text-[2rem] mb-[1.5rem]">Connect wallet</p>
        </div>
    </div>
  );
};

export default Design;
