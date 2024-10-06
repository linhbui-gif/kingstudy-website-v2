// service-worker.js

const CACHE_NAME = 'api-cache-v1';
const API_URL_PATTERN = 'https://admin.kingstudy.vn/api/';

self.addEventListener('install', () => {});

self.addEventListener('activate', () => {});

self.addEventListener('fetch', (event) => {
  if (event.request.url.startsWith(API_URL_PATTERN)) {
    event.respondWith(
      caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((cachedResponse) => {
          if (cachedResponse) {
            return cachedResponse;
          }

          return fetch(event.request).then((networkResponse) => {
            // Lưu network response vào cache
            cache.put(event.request, networkResponse.clone());
            return networkResponse; // Trả về response từ network
          });
        });
      })
    );
  }
});
