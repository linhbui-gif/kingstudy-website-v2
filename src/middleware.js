import { NextResponse } from 'next/server';

import { ModulePaths, Paths } from '@/routers/constants';
import { COOKIE_ACCESS_TOKEN } from '@/services/helpers';

const privatePaths = ['/me', '/profile'];
const authPaths = ['/login'];
export function middleware(request) {
  const { pathname } = request.nextUrl;
  const sessionToken = request.cookies.get(COOKIE_ACCESS_TOKEN)?.value;
  if (privatePaths.some((path) => pathname.startsWith(path)) && !sessionToken) {
    return NextResponse.redirect(new URL(Paths.Login, request.url));
  }
  if (authPaths.some((path) => pathname.startsWith(path)) && sessionToken) {
    return NextResponse.redirect(new URL(ModulePaths.Me, request.url));
  }
  return NextResponse.next();
}

export const config = {
  matcher: ['/me', '/login', '/profile'],
};
