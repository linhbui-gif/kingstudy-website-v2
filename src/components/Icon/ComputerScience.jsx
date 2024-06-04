import { EIconColor } from './Icon.enum';

const Svg = ({ color = EIconColor.STYLE_10 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={39}
      height={43}
      viewBox="0 0 39 43"
      fill="none"
    >
      <path
        d="M38.6928 29.3704V23.3094L23.9512 13.8995L24.2873 7.55961C24.4318 4.8173 22.2473 0.502197 19.5017 0.502197C16.756 0.502197 14.5716 4.82402 14.7161 7.55961L15.0521 13.8995L0.310547 23.3094V29.3704L15.6151 24.5881L16.2149 36.0144L10.4077 38.4694V42.5022H28.5923V38.4694L22.7884 36.0195L23.39 24.5932L38.6928 29.3704Z"
        fill={color}
        style={{ fill: `${color}`, fillOpacity: 1 }}
      />
    </svg>
  );
};
export default Svg;
