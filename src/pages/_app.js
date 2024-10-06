import 'antd/dist/reset.css';
import '@/assets/styles/globals.scss';
import '@/assets/font.scss';
import { ConfigProvider } from 'antd';

import { APIProvider } from '@/contexts/APIContext';

export default function App({ Component, pageProps }) {
  const AnyComponent = Component;
  const getLayout = AnyComponent.getLayout ?? ((page) => page);
  return (
    <ConfigProvider
      theme={{
        token: {
          fontFamily: 'Be Vietnam Pro, sans-serif',
        },
        hashed: false,
        components: {
          Breadcrumb: {
            colorText: 'white',
            linkColor: 'white',
            itemColor: 'white',
            separatorColor: 'white',
          },
          DatePicker: {
            activeBorderColor: '#22458F',
            hoverBorderColor: '#22458F',
            cellRangeBorderColor: '#22458F',
          },
          Select: {
            activeBorderColor: '#22458F',
            hoverBorderColor: '#22458F',
          },
          Radio: {
            buttonSolidCheckedActiveBg: '#22458F',
            buttonSolidCheckedBg: '#22458F',
          },
          Spin: {
            colorPrimary: '#22458F',
          },
        },
      }}
    >
      <APIProvider>
        <main>{getLayout(<AnyComponent {...pageProps} />)}</main>
      </APIProvider>
    </ConfigProvider>
  );
}
