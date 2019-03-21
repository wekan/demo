module.exports = {
  "globDirectory": "demo/",
  "globPatterns": [
    "**/*.{html,md,css,eot,svg,woff,woff2,png,sh,json}"
  ],
  "swDest": "demo\\sw.js",
  runtimeCaching: [{
    // Match any request ends with .png, .jpg, .jpeg or .svg.
    urlPattern: /\.(?:png|jpg|jpeg|svg)$/,

    // Apply a cache-first strategy.
    handler: 'CacheFirst',

    options: {
      // Use a custom cache name.
      cacheName: 'images',

      // Only cache 10 images.
      expiration: {
        maxEntries: 1000,
      },
    },
  }],
};