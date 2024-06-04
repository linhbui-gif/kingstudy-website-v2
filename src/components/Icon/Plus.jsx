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
      <path
        id="Plus"
        className="cls-1"
        d="m15.51,11.47h-2.52v-2.52c0-.6-.49-1.08-1.08-1.08s-1.08.49-1.08,1.08v2.52s-2.52,0-2.52,0c-.6,0-1.08.49-1.08,1.08s.49,1.08,1.08,1.08h2.52v2.52c0,.6.49,1.08,1.08,1.08s1.08-.49,1.08-1.08v-2.52s2.52,0,2.52,0c.6,0,1.08-.49,1.08-1.08s-.49-1.08-1.08-1.08Z"
      />
    </svg>
  );
};
export default Svg;
