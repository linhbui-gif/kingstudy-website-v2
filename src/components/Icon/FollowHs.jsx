import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_10 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      id="Layer_1"
      viewBox="0 0 24 24"
      className={'w-[2.4rem] h-[2.4rem]'}
    >
      <g id="Articles">
        <path
          d="m15.38,6.37c-.41,0-.75-.34-.75-.75V0H6.38c-2.06,0-3.75,1.69-3.75,3.75v16.5c0,1.03.42,1.97,1.1,2.65.68.68,1.62,1.1,2.65,1.1h11.25c2.06,0,3.75-1.69,3.75-3.75V6.37h-6Zm1.16,11.63H7.47c-.4,0-.72-.34-.72-.75s.32-.75.72-.75h9.07c.4,0,.72.34.72.75s-.32.75-.72.75Zm0-3.75H7.47c-.4,0-.72-.34-.72-.75s.32-.75.72-.75h9.07c.4,0,.72.34.72.75s-.32.75-.72.75Zm0-3.75H7.47c-.4,0-.72-.34-.72-.75s.32-.75.72-.75h9.07c.4,0,.72.34.72.75s-.32.75-.72.75Z"
          fill={color}
          strokeWidth={0}
        />
        <polygon
          points="16.13 0 16.13 4.87 21 4.87 16.13 0"
          fill={color}
          strokeWidth={0}
        />
      </g>
    </svg>
  );
};
export default Svg;
