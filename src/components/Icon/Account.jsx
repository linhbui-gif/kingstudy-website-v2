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
      <path
        d="M9.70848 13.7832C9.69724 13.7486 9.67536 13.7185 9.64596 13.6971C9.61656 13.6757 9.58115 13.6642 9.5448 13.6642H8.70048C8.34581 13.6642 7.99461 13.734 7.66694 13.8698C7.33927 14.0055 7.04155 14.2045 6.79078 14.4553C6.54001 14.7061 6.34111 15.0039 6.20542 15.3315C6.06974 15.6592 5.99994 16.0104 6 16.3651V17.5651C6 17.6717 6.04233 17.7739 6.11767 17.8492C6.19302 17.9246 6.29521 17.9669 6.40176 17.9669H10.8346C10.8618 17.9669 10.8886 17.9604 10.9129 17.948C10.9372 17.9356 10.9581 17.9177 10.9741 17.8956C10.9901 17.8736 11.0006 17.848 11.0048 17.8211C11.009 17.7942 11.0067 17.7667 10.9982 17.7408L9.70848 13.7832ZM15.299 13.6642H14.4581C14.4217 13.6641 14.3863 13.6756 14.3569 13.697C14.3274 13.7184 14.3056 13.7486 14.2944 13.7832L13.0042 17.7394C12.9957 17.7652 12.9934 17.7928 12.9976 17.8197C13.0018 17.8466 13.0123 17.8721 13.0283 17.8942C13.0443 17.9162 13.0652 17.9342 13.0895 17.9466C13.1138 17.959 13.1406 17.9654 13.1678 17.9654H17.5982C17.7048 17.9654 17.807 17.9231 17.8823 17.8478C17.9577 17.7724 18 17.6702 18 17.5637V16.3637C17.9996 15.6476 17.7149 14.961 17.2084 14.4547C16.7019 13.9485 16.0151 13.6642 15.299 13.6642ZM15.3125 9.34704C15.3125 8.69199 15.1182 8.05165 14.7543 7.50699C14.3904 6.96234 13.8731 6.53783 13.2679 6.28715C12.6627 6.03647 11.9968 5.97088 11.3543 6.09868C10.7119 6.22647 10.1217 6.54191 9.65854 7.0051C9.19535 7.46829 8.87991 8.05844 8.75212 8.7009C8.62432 9.34337 8.68991 10.0093 8.94059 10.6145C9.19127 11.2197 9.61578 11.7369 10.1604 12.1009C10.7051 12.4648 11.3454 12.659 12.0005 12.659C12.8788 12.6589 13.7211 12.3099 14.3421 11.6888C14.9631 11.0677 15.312 10.2254 15.312 9.34704H15.3125Z"
        fill={color}
        style={{
          fill: 'color(display-p3 0.1333 0.2706 0.5608)',
          fillOpacity: 1,
        }}
      />
      <path
        d="M12 13.7582C11.9321 13.7582 11.8649 13.7716 11.8022 13.7976C11.7394 13.8236 11.6825 13.8616 11.6344 13.9097C11.5864 13.9577 11.5484 14.0146 11.5224 14.0774C11.4964 14.1401 11.483 14.2073 11.483 14.2752V17.0333C11.483 17.1704 11.5375 17.3019 11.6344 17.3988C11.7314 17.4958 11.8629 17.5502 12 17.5502C12.1371 17.5502 12.2686 17.4958 12.3655 17.3988C12.4625 17.3019 12.517 17.1704 12.517 17.0333V14.2752C12.517 14.1381 12.4625 14.0066 12.3655 13.9097C12.2686 13.8127 12.1371 13.7582 12 13.7582Z"
        fill={color}
        style={{
          fill: 'color(display-p3 0.1333 0.2706 0.5608)',
          fillOpacity: 1,
        }}
      />
    </svg>
  );
};
export default Svg;
