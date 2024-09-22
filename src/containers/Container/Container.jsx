const Container = ({ children, fluid = false, isBlogDetail = false }) => {
  return (
    <div
      className={`mx-auto ${
        isBlogDetail ? 'px-0 md:px-[1.2rem]' : 'px-[1.2rem]'
      }  ${fluid ? 'w-full' : 'container'}`}
    >
      {children}
    </div>
  );
};
export default Container;
