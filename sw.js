/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/2aRDsh
 */

importScripts("https://storage.googleapis.com/workbox-cdn/releases/4.1.1/workbox-sw.js");

self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [
  {
    "url": "boardlist-starred.html",
    "revision": "ef95e4b080bc95bff0648ac44e999f4e"
  },
  {
    "url": "boardlist.html",
    "revision": "f5e3b38a4e7ee29e379ea33f7f105d34"
  },
  {
    "url": "CHANGELOG.md",
    "revision": "e1a56ecdfdda649f3013416191b6b640"
  },
  {
    "url": "css/style.css",
    "revision": "91674b940e64e0ca703ad789294afeca"
  },
  {
    "url": "fonts/fontawesome-webfont.eot",
    "revision": "674f50d287a8c48dc19ba404d20fe713"
  },
  {
    "url": "fonts/fontawesome-webfont.svg",
    "revision": "acf3dcb7ff752b5296ca23ba2c7c2606"
  },
  {
    "url": "fonts/fontawesome-webfont.woff",
    "revision": "fee66e712a8a08eef5805a46892932ad"
  },
  {
    "url": "fonts/fontawesome-webfont.woff2",
    "revision": "af7ae505a9eed503f8b8e6982036873e"
  },
  {
    "url": "fonts/roboto-bold.woff",
    "revision": "564663c4ddd28fa493f73f2d61a420b1"
  },
  {
    "url": "fonts/roboto-bold.woff2",
    "revision": "80dc7e6746289dde3d1875ab954f6e24"
  },
  {
    "url": "fonts/roboto-regular.woff",
    "revision": "c50f8a52f5d68f47010f058dfeefa4d1"
  },
  {
    "url": "fonts/roboto-regular.woff2",
    "revision": "d5036a1a656971b6e2fb78ad7361e972"
  },
  {
    "url": "img/user.png",
    "revision": "9bed53df2c04f4cffbe3fa8c13e49fda"
  },
  {
    "url": "img/wekan-150.png",
    "revision": "87e47752c72a501ba7c7d0f84e86ad79"
  },
  {
    "url": "img/wekan-150.svg",
    "revision": "988c71d9fb1413c6b1ac0f6c0b6157f0"
  },
  {
    "url": "img/wekan-favicon.png",
    "revision": "3e85d2c1963e4b30588bc1d3c6bd6749"
  },
  {
    "url": "img/wekan-logo-header.png",
    "revision": "eafd1017b79a95fc44bd4b6027fe965e"
  },
  {
    "url": "img/wekan-logo.png",
    "revision": "354358bbc0960aa1b73aab189aafd972"
  },
  {
    "url": "img/wekan-logo.svg",
    "revision": "648c35770cd23439af1e81a689ea70ae"
  },
  {
    "url": "index.html",
    "revision": "c6ac22c67f8a5079b073e5dbfc6dfef0"
  },
  {
    "url": "login.html",
    "revision": "cc82c45b7da9a4de26e58909e67434b4"
  },
  {
    "url": "pyserver.sh",
    "revision": "dea4e5fca56d37d34823544c4b5a9714"
  },
  {
    "url": "README.md",
    "revision": "84574012f0fe4df21b76959d90eb690f"
  },
  {
    "url": "wekan-manifest.json",
    "revision": "86b4838b094309bae1abf968b071d3f0"
  }
].concat(self.__precacheManifest || []);
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});

workbox.routing.registerRoute(/\.(?:png|jpg|jpeg|svg)$/, new workbox.strategies.CacheFirst({ "cacheName":"images", plugins: [new workbox.expiration.Plugin({ maxEntries: 1000, purgeOnQuotaError: false })] }), 'GET');
