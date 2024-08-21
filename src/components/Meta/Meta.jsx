import Head from 'next/head';
import { useRouter } from 'next/router';

import { AppConfig } from '@/utils/utils';

const Meta = (props) => {
  const router = useRouter();

  return (
    <>
      <Head>
        <meta charSet="UTF-8" key="charset" />
        <meta
          name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"
          key="viewport"
        />
        <link
          rel="apple-touch-icon"
          href={`${router.basePath}/apple-touch-icon.png`}
          key="apple"
        />
        <link
          rel="icon"
          type="image/png"
          sizes="32x32"
          href={`${router.basePath}/favicon-32x32.ico`}
          key="icon32"
        />
        <link
          rel="icon"
          type="image/png"
          sizes="16x16"
          href={`${router.basePath}/favicon-16x16.ico`}
          key="icon16"
        />
        <link
          rel="icon"
          type="image/png"
          href={`${router.basePath}/android-chrome-192x192.ico`}
          sizes="192x192"
          key="android-chrome-192x192"
        />
        <link
          rel="icon"
          type="image/png"
          href={`${router.basePath}/android-chrome-512x512.ico`}
          sizes="512x512"
          key="android-chrome-512x512"
        />
        <link
          rel="icon"
          href={`${router.basePath}/favicon.ico`}
          key="favicon"
        />
        <link
          rel="image_src"
          href={props?.thumbnail ?? router.basePath + '/thumbnail.png'}
        />
        <title>{AppConfig.site_name}</title>
        <meta
          name="description"
          content={
            props.description ? props.description : AppConfig.description
          }
          key="description"
        />
        <meta name="author" content={AppConfig.author} key="author" />
        {props.canonical && (
          <link rel="canonical" href={props.canonical} key="canonical" />
        )}
        <meta
          property="og:title"
          content={props.title ? props.title : AppConfig.title}
          key="og:title"
        />
        <meta
          property="og:description"
          content={
            props.description ? props.description : AppConfig.description
          }
          key="og:description"
        />
        <meta property="og:locale" content={AppConfig.locale} key="og:locale" />
        <meta
          property="og:site_name"
          content={AppConfig.site_name}
          key="og:site_name"
        />
        {props?.robots === 1 ? (
          <meta name="robots" content="all" />
        ) : (
          <meta name="robots" content="noindex" />
        )}
        <meta
          property="og:image"
          itemProp="thumbnailUrl"
          content={props?.thumbnail ?? router.basePath + '/thumbnail.png'}
        />
        <meta
          property="og:url"
          itemProp="url"
          content={props?.link ?? AppConfig.url}
        />
        <meta
          name="keywords"
          content={props?.keywords ? props?.keywords : AppConfig.keywords}
        />
      </Head>
    </>
  );
};

export default Meta;
