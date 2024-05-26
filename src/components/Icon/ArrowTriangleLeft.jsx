import { EIconColor } from '@/components/Icon/Icon.enum';

const Svg = ({ color = EIconColor.ARROW_TRIANGLE }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={9}
      height={20}
      viewBox="0 0 9 20"
      fill="none"
    >
      <path
        d="M0.905556 9.6888L6.64722 3.90547C6.88241 3.67214 7.10463 3.67214 7.31389 3.90547L8.09444 4.64714C8.30185 4.88232 8.30185 5.10454 8.09444 5.3138L3.44444 9.99991L8.09444 14.6888C8.30185 14.8962 8.30185 15.1175 8.09444 15.3527L7.31389 16.0944C7.10463 16.3277 6.88241 16.3277 6.64722 16.0944L0.905556 10.3138C0.698148 10.1045 0.698148 9.89621 0.905556 9.6888Z"
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
