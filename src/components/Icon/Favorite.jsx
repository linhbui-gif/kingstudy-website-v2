import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_10 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={24}
      height={24}
      viewBox="0 0 24 24"
      fill="none"
    >
      <g id="Heart">
        <path
          id="Heart_2"
          d="M12.62 20.8101C12.28 20.9301 11.72 20.9301 11.38 20.8101C8.48 19.8201 2 15.6901 2 8.6901C2 5.6001 4.49 3.1001 7.56 3.1001C9.38 3.1001 10.99 3.9801 12 5.3401C13.01 3.9801 14.63 3.1001 16.44 3.1001C19.51 3.1001 22 5.6001 22 8.6901C22 15.6901 15.52 19.8201 12.62 20.8101Z"
          fill={color}
          stroke={color}
          style={{
            fill: 'color(display-p3 0.1333 0.2706 0.5608)',
            fillOpacity: 1,
            stroke: 'color(display-p3 0.1333 0.2706 0.5608)',
            strokeOpacity: 1,
          }}
          strokeWidth="1.5"
          strokeLinecap="round"
          strokeLinejoin="round"
        />
      </g>
    </svg>
  );
};
export default Svg;
