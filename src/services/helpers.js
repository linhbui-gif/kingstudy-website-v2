import cookie from 'react-cookies';

import env from '@/env';

const COOKIE_DOMAIN = env.cookie.domain;
export const COOKIE_ACCESS_TOKEN = `${COOKIE_DOMAIN}-atk`;
export const COOKIE_REFRESH_TOKEN = `${COOKIE_DOMAIN}-rtk`;
const LOCAL_STORAGE_REMEMBER_ACCOUNT = `${COOKIE_DOMAIN}-rma`;

const cookieSetting = {
  path: '/',
  secure: true,
};

const setCookie = (name, value) => cookie.save(name, value, cookieSetting);

const getCookie = (name) => cookie.load(name);

const removeCookie = (name) => cookie.remove(name, cookieSetting);

class Helpers {
  getRefreshToken = () => getCookie(COOKIE_REFRESH_TOKEN);

  storeRefreshToken = (refreshToken) =>
    setCookie(COOKIE_REFRESH_TOKEN, refreshToken);

  getAccessToken = () => getCookie(COOKIE_ACCESS_TOKEN);

  storeAccessToken = (accessToken) =>
    setCookie(COOKIE_ACCESS_TOKEN, accessToken);

  getDataRememberAccount = () => {
    if (typeof window !== 'undefined') {
      return (
        JSON.parse(
          localStorage.getItem(LOCAL_STORAGE_REMEMBER_ACCOUNT) || '{}'
        ) || {}
      );
    }

    return {};
  };

  setDataRememberAccount = (data) => {
    if (typeof window !== 'undefined') {
      localStorage.setItem(
        LOCAL_STORAGE_REMEMBER_ACCOUNT,
        JSON.stringify(data || {}) || '{}'
      );
    }
  };

  clearTokens = () => {
    removeCookie(COOKIE_REFRESH_TOKEN);
    removeCookie(COOKIE_ACCESS_TOKEN);
  };
}

const instance = new Helpers();
export default instance;
