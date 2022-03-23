<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-zinc-100 dark:bg-zinc-900 dark:bg-opacity-90 h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <meta name="title" content="{{ config('app.name') }} Podcast" />
        <meta name="description" content="{{ config('app.name') }} is a podcast about books and reading by two aspiring authors." />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/app.css', true) }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="favicon" type="image/png" href="{{ asset('favicon.png') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ request()->fullUrl() }}">
        <meta property="og:title" content="{{ config('app.name') }} Podcast">
        <meta property="og:description" content="{{ config('app.name') }} is a podcast about books and reading by two aspiring authors.">
        @routes
        <script src="{{ asset('js/app.js', true) }}" defer></script>
        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
            _paq.push(["setCookieDomain", "*.podcast.test"]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="https://analytics.sketchni.uk/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '2']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <noscript><p><img src="https://analytics.sketchni.uk/matomo.php?idsite=2&amp;rec=1" style="border:0;" alt="" /></p></noscript>
        <!-- End Matomo Code -->

    </head>
    <body class="font-sans h-full">
        @inertia
    </body>
</html>
