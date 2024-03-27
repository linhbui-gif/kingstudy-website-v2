
const Hero = () => {
  return (
    <div className={"flex w-full h-[97rem]"} style={{ backgroundImage: "url('/images/image-hero.png')", backgroundSize: 'cover', backgroundPosition:"center center" }}>
      <div className={"max-w-[73.5rem] m-[20rem] mx-auto"}>
          <div>
            <span className={"block w-full text-white font-Kan font-bold text-[5rem] italic uppercase text-center"}>More healthy</span>
            <div className={"min-w-[65.3rem] bg-gradient-blue px-[2rem] py-[1rem] text-white font-Kan font-bold text-[6.8rem] italic uppercase text-center"}>
              more beautiful
            </div>
            <div className={"min-w-[54rem] bg-white  px-[2rem] py-[1rem] text-white font-Kan font-bold text-[6.8rem] italic uppercase text-center"}>
              <span className={"text-gradient-menu"}> more income</span>
            </div>
            <div>
              <span>Get PLAN</span>
            </div>
          </div>
      </div>
    </div>
  )
}
export default Hero