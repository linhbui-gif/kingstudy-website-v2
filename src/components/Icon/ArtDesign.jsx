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
        d="M16.32 7.68768H7.68C7.23313 7.69073 6.80562 7.87048 6.49085 8.18768C6.17607 8.50489 5.99961 8.93376 6 9.38064V14.6194C5.99961 15.0662 6.17607 15.4951 6.49085 15.8123C6.80562 16.1295 7.23313 16.3093 7.68 16.3123H16.32C16.7669 16.3093 17.1944 16.1295 17.5092 15.8123C17.8239 15.4951 18.0004 15.0662 18 14.6194V9.38064C18.0004 8.93376 17.8239 8.50489 17.5092 8.18768C17.1944 7.87048 16.7669 7.69073 16.32 7.68768ZM15.3754 9.18768C15.5608 9.18768 15.742 9.24266 15.8962 9.34567C16.0503 9.44868 16.1705 9.59509 16.2414 9.76638C16.3124 9.93767 16.331 10.1262 16.2948 10.308C16.2586 10.4899 16.1693 10.6569 16.0382 10.788C15.9071 10.9191 15.7401 11.0084 15.5582 11.0446C15.3764 11.0807 15.1879 11.0622 15.0166 10.9912C14.8453 10.9203 14.6989 10.8001 14.5959 10.6459C14.4929 10.4918 14.4379 10.3105 14.4379 10.1251C14.4379 9.87658 14.5366 9.63821 14.7123 9.46242C14.888 9.28663 15.1263 9.18781 15.3749 9.18768H15.3754ZM7.31136 15.0917L8.31936 10.4045L11.5493 13.2024L12.1666 11.952L16.6877 15.0946L7.31136 15.0917Z"
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
