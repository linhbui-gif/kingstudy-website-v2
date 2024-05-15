const Container = ({ children, fluid = false }) => {
  return (
    <div className={`mx-auto px-[1.2rem] ${fluid ? 'w-full' : 'container'}`}>
      {children}
    </div>
  );
};
export default Container;
