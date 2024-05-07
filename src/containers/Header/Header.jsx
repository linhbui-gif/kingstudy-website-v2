import { useMediaQuery } from 'react-responsive';

const Header = () => {
  const isTablet = useMediaQuery({ maxWidth: 991 });
  return (
    <div
      className={`relative flex items-center ${
        isTablet ? 'bg-black h-[108px]' : 'bg-black h-[108px]'
      }`}
    ></div>
  );
};
export default Header;
