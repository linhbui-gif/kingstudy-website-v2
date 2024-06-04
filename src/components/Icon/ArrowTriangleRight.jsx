import { EIconColor } from '@/components/Icon/Icon.enum';

const Svg = ({ color = EIconColor.ARROW_TRIANGLE }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={8}
      height={20}
      viewBox="0 0 8 20"
      fill="none"
    >
      <path
        d="M7.51046 10.3138L1.76879 16.0944C1.53361 16.3277 1.31231 16.3277 1.1049 16.0944L0.321571 15.3527C0.114164 15.1175 0.114164 14.8962 0.321571 14.6888L4.97157 9.99991L0.321571 5.3138C0.114164 5.10454 0.114164 4.88232 0.321571 4.64714L1.1049 3.90547C1.31231 3.67214 1.53361 3.67214 1.76879 3.90547L7.51046 9.6888C7.71787 9.89621 7.71787 10.1045 7.51046 10.3138Z"
        fill={color}
        style={{
          fill: 'color(display-p3 0.3412 0.3412 0.3412)',
          fillOpacity: 1,
        }}
      />
    </svg>
  );
};
export default Svg;
