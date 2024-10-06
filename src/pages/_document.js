import { Html, Head, Main, NextScript } from 'next/document';

import { AppConfig } from '@/utils/utils';

export default function Document() {
  return (
    <Html lang={AppConfig.locale}>
      <Head>
        <link rel="manifest" href="/manifest.json" />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Thin.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-ExtraLight.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Light.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Regular.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Medium.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-SemiBold.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Bold.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-ExtraBold.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Black.woff2"
          as="font"
          type="font/woff2"
          crossOrigin=""
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
          rel="preconnect"
          href="https://fonts.gstatic.com"
          crossOrigin=""
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet"
        />

        <link rel="preload" as="style" href="/assets/font.css" />
        <link rel="stylesheet" href="/assets/font.css" />
      </Head>
      <body>
        <Main />
        <NextScript />
      </body>
    </Html>
  );
}
