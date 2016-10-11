"use strict";
var version = 'v1-';
var offlineContent = [
    './',
    './css/master.css',
    './js/master.js',
    './fonts/proximanovalight.ttf',
    './fonts/MYRIADPROREGULAR.ttf',
    './fonts/glyphicons-halflings-regular.eot',
    './fonts/glyphicons-halflings-regular.svg',
    './fonts/glyphicons-halflings-regular.woff',
    './fonts/glyphicons-halflings-regular.ttf',
    './fonts/glyphicons-halflings-regular.woff2',
    './images/banner1.jpg',
    './images/cg.jpg',
    './images/ed.jpg',
    './images/nf.jpg',
    './images/sr.jpg',
    './images/st.jpg',
    './images/uj.jpg',
    './service-worker.js',
    './info.json',
    './review.json'
];

self.addEventListener("install", function(event) {
    event.waitUntil(
        caches.open(version + 'caps').then(function(cache) {
            return cache.addAll(offlineContent);
        })
            .then(function() {
                console.log('WORKER: install completed');
            })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                    if (response) {
                        return response;
                    }

                    return fetch(event.request);
                }
            )
    );
});

self.addEventListener("activate", function(event) {
    event.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(
                keys.filter(function (key) {
                    return !key.startsWith(version);
                })
                    .map(function (key) {
                        return caches.delete(key);
                    })
            );
        })
            .then(function() {
                console.log('WORKER: activate completed.');
            })
    );
});