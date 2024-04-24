import { Html, Head, Main, NextScript } from 'next/document';

import { AppConfig } from '@/utils/utils';

export default function Document() {
  return (
    <Html lang={AppConfig.locale}>
      <Head>
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamBlack.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamBlack.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamBold.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamBook.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamLight.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamRegular.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamThin.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamUltra.otf"
          as="font"
          type="font/otf"
          crossOrigin=""
        />
        <link
          rel="preload"
          href="assets/fonts/SVN-GothamXLight.otf"
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
