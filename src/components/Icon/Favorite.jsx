import { EIconColor } from './Icon.enum';
const Svg = ({
  color = EIconColor.STYLE_10,
  width = 33,
  height = 33,
  isFavorite = false,
}) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={width}
      height={height}
      viewBox="0 0 32 33"
      fill="none"
    >
      <path
        d="M16.8267 28.2467C16.3734 28.4067 15.6267 28.4067 15.1734 28.2467C11.3067 26.9267 2.66675 21.42 2.66675 12.0867C2.66675 7.9667 5.98675 4.63336 10.0801 4.63336C12.5067 4.63336 14.6534 5.8067 16.0001 7.62003C17.3467 5.8067 19.5067 4.63336 21.9201 4.63336C26.0134 4.63336 29.3334 7.9667 29.3334 12.0867C29.3334 21.42 20.6934 26.9267 16.8267 28.2467Z"
        fill={color}
        stroke={color}
        style={{
          fill: `${!isFavorite ? color : EIconColor.WHITE}`,
          fillOpacity: 1,
          stroke: `${color}`,
          strokeOpacity: 1,
        }}
        strokeWidth={2}
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </svg>
  );
};
export default Svg;
