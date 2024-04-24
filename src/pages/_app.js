import '@/assets/styles/globals.scss';
import '@/assets/font.scss';
import { isBrowser } from '@/utils/utils';

if (isBrowser() && 'serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/sw.js')
      .then((registration) => {
        console.log('Service worker registration successful:', registration);
      })
      .catch((error) => {
        console.log('Service worker registration failed:', error);
      });
  });
}
export default function App({ Component, pageProps }) {
  return <Component {...pageProps} />;
}
