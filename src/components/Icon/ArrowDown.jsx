import { EIconColor } from '@/components/Icon/Icon.enum';

const Svg = ({ color = EIconColor.WHITE, width = 9, height = 6 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={width}
      height={height}
      viewBox="0 0 9 6"
      fill="none"
    >
      <path
        d="M4.06328 5.33639L0.593281 1.60431C0.453281 1.45144 0.453281 1.30759 0.593281 1.17278L1.03828 0.663611C1.17939 0.528796 1.31273 0.528796 1.43828 0.663611L4.24995 3.68611L7.06328 0.663611C7.18773 0.528796 7.3205 0.528796 7.46161 0.663611L7.90661 1.17278C8.04661 1.30759 8.04661 1.45144 7.90661 1.60431L4.43828 5.33639C4.31273 5.4712 4.18773 5.4712 4.06328 5.33639Z"
        fill={color}
        style={{ fill: `${color}`, fillOpacity: 1 }}
      />
    </svg>
  );
};
export default Svg;
