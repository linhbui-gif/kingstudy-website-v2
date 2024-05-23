import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_PLUS }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={13}
      height={16}
      viewBox="0 0 13 16"
      fill="none"
    >
      <path
        d="M1 7L12 7C12.1452 7 12.2652 7.04667 12.36 7.14C12.4533 7.23482 12.5 7.35481 12.5 7.5V8.5C12.5 8.64519 12.4533 8.76518 12.36 8.86C12.2652 8.95333 12.1452 9 12 9L1 9C0.854815 9 0.734815 8.95333 0.64 8.86C0.546667 8.76518 0.5 8.64519 0.5 8.5L0.5 7.5C0.5 7.35481 0.546667 7.23482 0.64 7.14C0.734815 7.04667 0.854815 7 1 7Z"
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
