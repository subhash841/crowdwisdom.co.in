"use strict";
var version = 'v2:1:8';

var cacheonly = new RegExp('^(https?:\/\/)(www\.)?(' + [
    location.hostname + '(.*)',
    'googleapi(.*)',
    'fonts.gstatic(.*)',
    'boomboxninjas(.*)',
].join('(\/?)|') + ')$')


self.addEventListener("fetch", function (event) {
    if (event.request.method !== 'GET') {
        return;
    }
    if (/\.php$/.test(event.request.url))
        return

    if (!cacheonly.test(event.request.url)) {
        return
    }
    //return from cache if available and simultaneously fetch fresh resource and store in cache
    event.respondWith(caches.match(event.request).then(function (cached) {
        var networked = fetch(event.request).then(fetchedFromNetwork, unableToResolve).catch(unableToResolve);
        return cached || networked;
        function fetchedFromNetwork(response) {
            var cacheCopy = response.clone();
            caches.open(version + 'fundamentals').then(function add(cache) {
                cache.put(event.request, cacheCopy);
            }).then(function () {});
            return response;
        }
        function unableToResolve() {
            return new Response('<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Offline</title></head><style>.swabody225{text-align: center;padding: 8%;}.swah1225 {font-size: 1.8em}.swabody225{font: 1.1em Helvetica, sans-serif;color: #333}.swaarticle225 {display: block;text-align: left;width: 50%;margin: 0 auto}.swaa225 {color: #fd586f;text-decoration: none;}.swaa225:hover {text-decoration: none}.swaa225 strong {color: #02ceff;}.swapowered225 {margin-top: 20px;font-size: 13px;}.swacontainer225 {width: 100%;}@media(max-width:840px){.swaarticle225 {width: 70%;}.swabody225 {padding: 15% 5%;}}@media(max-width:650px) {.swaarticle225 {width: 80%}.swabody225 {padding: 20% 5%;}}@media(max-width:530px) {.swaarticle225 {width: 90%;}.swabody225 {padding: 25% 5%}}@media(max-width:440px) {.swaarticle225 {width: 96%}.swabody225 {padding: 25% 2%;}}</style><body class="swabody225"><div class="swacontainer225"><article class="swaarticle225"><h1 class="swah1225">You&rsquo;re working offline!</h1><div><p>Sorry for the inconvenience but we&rsquo;re trying to fix your offline experience, and it seems at the moment this section is not available offline.</p><p>&mdash; CrowdWisdom Team</p></div></article><article class="swaarticle225 swapowered225"><em>Powered by </em><a class="swaa225"><strong>Sunday Mobility</strong></a></article></div></body></html>', {status: 503, statusText: 'Service Unavailable', headers: new Headers({'Content-Type': 'text/html'})});
        }
    }
    ));
});
self.addEventListener("activate", function (event) {
    event.waitUntil(caches.keys().then(function (keys) {
        return Promise.all(keys.filter(function (key) {
            return!key.startsWith(version);
        }).map(function (key) {
            return caches.delete(key);
        }));
    }).then(function () {}));
});
