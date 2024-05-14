import { EIconColor } from './Icon.enum';
const Svg = ({ color = EIconColor.STYLE_10 }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={25}
      height={25}
      viewBox="0 0 25 25"
      fill="none"
    >
      <path
        d="M8.6808 15.857C8.66207 15.7993 8.62559 15.7491 8.5766 15.7135C8.5276 15.6779 8.46859 15.6586 8.408 15.6586H7.0008C6.40968 15.6586 5.82435 15.775 5.27823 16.0012C4.73212 16.2275 4.23592 16.5591 3.81797 16.9771C3.40002 17.3951 3.06851 17.8914 2.84237 18.4375C2.61623 18.9837 2.4999 19.569 2.5 20.1602V22.1602C2.5 22.3378 2.57055 22.5081 2.69612 22.6336C2.8217 22.7592 2.99201 22.8298 3.1696 22.8298H10.5576C10.603 22.8298 10.6477 22.819 10.6882 22.7983C10.7286 22.7777 10.7635 22.7478 10.7902 22.711C10.8168 22.6742 10.8343 22.6317 10.8413 22.5868C10.8483 22.542 10.8446 22.4961 10.8304 22.453L8.6808 15.857ZM17.9984 15.6586H16.5968C16.5362 15.6585 16.4771 15.6777 16.4281 15.7133C16.3791 15.749 16.3426 15.7993 16.324 15.857L14.1736 22.4506C14.1594 22.4937 14.1557 22.5396 14.1627 22.5844C14.1697 22.6293 14.1872 22.6718 14.2138 22.7086C14.2405 22.7454 14.2754 22.7753 14.3158 22.7959C14.3563 22.8166 14.401 22.8274 14.4464 22.8274H21.8304C22.008 22.8274 22.1783 22.7568 22.3039 22.6312C22.4295 22.5057 22.5 22.3354 22.5 22.1578V20.1578C22.4994 18.9643 22.0248 17.8199 21.1807 16.9762C20.3365 16.1325 19.1919 15.6586 17.9984 15.6586ZM18.0208 8.46336C18.0208 7.37161 17.6971 6.30437 17.0905 5.39661C16.484 4.48886 15.6219 3.78134 14.6132 3.36355C13.6046 2.94575 12.4947 2.83644 11.4239 3.04943C10.3531 3.26242 9.36956 3.78815 8.59757 4.56013C7.82558 5.33212 7.29986 6.31569 7.08686 7.38646C6.87387 8.45724 6.98319 9.56713 7.40098 10.5758C7.81878 11.5844 8.52629 12.4465 9.43405 13.0531C10.3418 13.6596 11.409 13.9834 12.5008 13.9834C13.9647 13.9832 15.3685 13.4015 16.4035 12.3663C17.4385 11.3311 18.02 9.92722 18.02 8.46336H18.0208Z"
        fill={color}
        style={{
          fill: 'color(display-p3 0.1333 0.2706 0.5608)',
          fillOpacity: 1,
        }}
      />
      <path
        d="M12.5003 15.8154C12.3871 15.8154 12.2751 15.8377 12.1706 15.881C12.066 15.9243 11.971 15.9878 11.891 16.0678C11.811 16.1478 11.7476 16.2428 11.7043 16.3473C11.661 16.4518 11.6387 16.5639 11.6387 16.677V21.2738C11.6387 21.5023 11.7294 21.7215 11.891 21.8831C12.0526 22.0447 12.2718 22.1354 12.5003 22.1354C12.7288 22.1354 12.9479 22.0447 13.1095 21.8831C13.2711 21.7215 13.3619 21.5023 13.3619 21.2738V16.677C13.3619 16.4485 13.2711 16.2294 13.1095 16.0678C12.9479 15.9062 12.7288 15.8154 12.5003 15.8154Z"
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
