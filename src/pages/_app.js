import '@/assets/styles/globals.scss';
import '@/assets/font.scss';
import { isBrowser } from '@/utils/utils';

if (isBrowser() && 'serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/sw.js')
      // eslint-disable-next-line no-unused-vars
      .then((_registration) => {})
      // eslint-disable-next-line no-unused-vars
      .catch((_error) => {});
  });
}
export default function App({ Component, pageProps }) {
  return <Component {...pageProps} />;
}
