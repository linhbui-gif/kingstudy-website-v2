import { Html, Head, Main, NextScript } from 'next/document';

import { AppConfig } from '@/utils/utils';

export default function Document() {
  return (
    <Html lang={AppConfig.locale}>
      <Head>
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Regular.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Thin.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Light.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-SemiBold.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Medium.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-ExtraLight.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-ExtraBold.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Bold.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/BeVietnamPro-Black.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
          rel="preconnect"
          href="https://fonts.gstatic.com"
          crossOrigin=""
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
