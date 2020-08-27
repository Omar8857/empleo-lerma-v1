var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/empleo-lerma/public/offline',
    '/empleo-lerma/public/css/app.css',
    '/empleo-lerma/public/js/app.js',
    '/empleo-lerma/public/images/icons/icon-72x72.png',
    '/empleo-lerma/public/images/icons/icon-96x96.png',
    '/empleo-lerma/public/images/icons/icon-128x128.png',
    '/empleo-lerma/public/images/icons/icon-144x144.png',
    '/empleo-lerma/public/images/icons/icon-152x152.png',
    '/empleo-lerma/public/images/icons/icon-192x192.png',
    '/empleo-lerma/public/images/icons/icon-384x384.png',
    '/empleo-lerma/public/images/icons/icon-512x512.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});