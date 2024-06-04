import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_PLUS }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      id="Layer_1"
      data-name="Layer 1"
      viewBox="0 0 24 24"
      className={'w-[2.4rem] h-[2.4rem]'}
    >
      <defs>
        <style
          dangerouslySetInnerHTML={{
            __html: `\n      .cls-1 {\n        fill: ${color};\n      }\n    `,
          }}
        />
      </defs>
      <g id="Minus">
        <path className="cls-1" d="m12.8,11.12s.01,0,.03,0c.42,0,.5,0-.03,0Z" />
        <path
          className="cls-1"
          d="m15.69,11.12s-2.55,0-2.87,0c-1.17,0-4.97,0-4.97,0-.59,0-1.07.54-1.02,1.18.05.56.53.98,1.07.98h7.72c.54,0,1.02-.41,1.07-.98.06-.64-.42-1.18-1.02-1.18Z"
        />
      </g>
    </svg>
  );
};
export default Svg;
