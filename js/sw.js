const staticCacheName = "pastedown";
const assets = [
  "/js/halfmoon.js",
  "/js/main.js",
  "/js/marked.js",
  "/js/prism.js",
  "/js/sw.js",
  "/js/xss.js",
  "/css/halfmoon.css",
  "/css/main.css",
  "/css/prism.css",
  "/contact",
  "/"
];

self.addEventListener("install", evt => {
  evt.waitUntil(
    caches.open(staticCacheName).then(cache => {
      console.log("caching shell assets");
      cache.addAll(assets);
    })
  );
});

self.addEventListener("activate", evt => {
  evt.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys
          .filter(key => key !== staticCacheName)
          .map(key => caches.delete(key))
      );
    })
  );
});

self.addEventListener("fetch", evt => {
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request);
    })
  );
});