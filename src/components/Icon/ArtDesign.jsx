import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_10 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={43}
      height={31}
      viewBox="0 0 43 31"
      fill="none"
    >
      <path
        d="M36.62 0.406982H6.38C4.81596 0.417634 3.31968 1.04677 2.21797 2.15698C1.11625 3.26719 0.498634 4.76826 0.500002 6.33234V24.6679C0.498634 26.2319 1.11625 27.733 2.21797 28.8432C3.31968 29.9534 4.81596 30.5826 6.38 30.5932H36.62C38.184 30.5826 39.6803 29.9534 40.782 28.8432C41.8837 27.733 42.5014 26.2319 42.5 24.6679V6.33234C42.5014 4.76826 41.8837 3.26719 40.782 2.15698C39.6803 1.04677 38.184 0.417634 36.62 0.406982ZM33.3138 5.65698C33.9627 5.65698 34.597 5.84941 35.1366 6.20994C35.6762 6.57046 36.0967 7.08289 36.345 7.68242C36.5934 8.28195 36.6584 8.94166 36.5318 9.57812C36.4052 10.2146 36.0927 10.7992 35.6338 11.2581C35.1749 11.7169 34.5903 12.0294 33.9539 12.156C33.3174 12.2826 32.6577 12.2176 32.0582 11.9693C31.4586 11.721 30.9462 11.3004 30.5857 10.7609C30.2251 10.2213 30.0327 9.58695 30.0327 8.93802C30.0327 8.06813 30.3782 7.23384 30.9931 6.61857C31.6081 6.0033 32.4422 5.65743 33.3121 5.65698H33.3138ZM5.08976 26.321L8.61776 9.91578L19.9225 19.7085L22.083 15.3321L37.9069 26.3311L5.08976 26.321Z"
        fill={color}
        style={{ fill: `${color}`, fillOpacity: 1 }}
      />
    </svg>
  );
};
export default Svg;
