const CACHE_NAME = 'studio-pasti-pwa-v2';
const PRECACHE_ASSETS = [
  '/offline.html',
  '/manifest.json',
  '/icons/icon-192x192.png',
  '/icons/icon-512x512.png'
];

const SENSITIVE_PATH_PATTERNS = [
  '/auth/',
  '/admin/',
  '/login',
  '/logout',
  '/attempt',
  '/store',
  '/update',
  '/delete',
  '/toggle'
];

function isSensitiveRequest(url) {
  const path = url.pathname.toLowerCase();
  return SENSITIVE_PATH_PATTERNS.some((segment) => path.includes(segment));
}

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) =>
      Promise.allSettled(PRECACHE_ASSETS.map((url) => cache.add(url)))
    )
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) =>
      Promise.all(
        cacheNames
          .filter((name) => name !== CACHE_NAME)
          .map((name) => caches.delete(name))
      )
    )
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  const { request } = event;

  // 1. Never intercept non-GET requests (e.g. POST forms with CSRF tokens)
  if (request.method !== 'GET') {
    return;
  }

  const url = new URL(request.url);

  // 2. Only handle http/https requests
  if (url.protocol !== 'http:' && url.protocol !== 'https:') {
    return;
  }

  const isHtmlNavigation =
    request.mode === 'navigate' ||
    (request.headers.get('accept') || '').includes('text/html');

  // 3. Do not cache sensitive authentication, admin, or mutating endpoints
  if (isSensitiveRequest(url)) {
    if (isHtmlNavigation) {
      event.respondWith(
        fetch(request).catch(() => caches.match('/offline.html'))
      );
    }
    return;
  }

  // 4. Network First strategy for safe GET requests
  event.respondWith(
    fetch(request)
      .then((networkResponse) => {
        if (
          networkResponse &&
          networkResponse.status === 200 &&
          networkResponse.type === 'basic'
        ) {
          const responseClone = networkResponse.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, responseClone);
          });
        }
        return networkResponse;
      })
      .catch(async () => {
        const cachedResponse = await caches.match(request);
        if (cachedResponse) {
          return cachedResponse;
        }
        if (isHtmlNavigation) {
          return caches.match('/offline.html');
        }
        return Response.error();
      })
  );
});
