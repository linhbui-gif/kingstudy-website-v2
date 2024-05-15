import { Html, Head, Main, NextScript } from 'next/document';

import { AppConfig } from '@/utils/utils';

export default function Document() {
  return (
    <Html lang={AppConfig.locale}>
      <Head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
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
