<!DOCTYPE html>

<html>

    <head>

        @section('metadata')

            <title>Franquiciar</title>

            <meta name="description" content="Franquiciar"/>

            <meta name="keywords" content="Franquiciar"/>



            <meta property="og:url"                content="{{ Config::get('app.url') }}" />

            <meta property="og:title"              content="Franquiciar" />

            <meta property="og:description"        content="description" />

            <meta property="og:image"              content="" />



            <meta name="twitter:card" content="summary" />

            <meta name="twitter:site" content="@flickr" />

            <meta name="twitter:title" content="Franquiciar" />

            <meta name="twitter:description" content="description" />

            <meta name="twitter:image" content="" />

        @show

        <meta charset="UTF-8">

        <meta name="author" content="Franquiciar"/>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



        <meta name="_token" content="{{ csrf_token() }}" >



        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta name="apple-mobile-web-app-capable" content="yes" />

        <meta name="apple-mobile-web-app-status-bar-style" content="default" />

        <meta name="apple-mobile-web-app-title" content="Franquiciar">

        <meta name="format-detection" content="telephone=no">



        <!--FAVICON-->

        <meta name="msapplication-TileColor" content="#2b5797">

        <meta name="msapplication-TileImage" content="{{ Config::get('app.url') }}image/favicon/mstile-144x144.png">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}image/favicon/favicon-16x16.png" sizes="16x16">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}image/favicon/favicon-32x32.png" sizes="32x32">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}image/favicon/favicon-96x96.png" sizes="96x96">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-57x57.png">

        <link rel="apple-touch-icon" sizes="114x114" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-114x114.png">

        <link rel="apple-touch-icon" sizes="72x72" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-72x72.png">

        <link rel="apple-touch-icon" sizes="144x144" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-144x144.png">

        <link rel="apple-touch-icon" sizes="60x60" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-60x60.png">

        <link rel="apple-touch-icon" sizes="120x120" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-120x120.png">

        <link rel="apple-touch-icon" sizes="76x76" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-76x76.png">

        <link rel="apple-touch-icon" sizes="152x152" href="{{ Config::get('app.url') }}image/favicon/apple-touch-icon-152x152.png">



        <link rel="stylesheet" href="{{ Config::get('app.url') }}style/main.css">



    </head>

    <body data-url="{{ Config::get('app.url') }}" data-section="{{ $frontClass }}">

      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
       
        ga('create', 'UA-99351294-1', 'auto');
        ga('send', 'pageview');
      </script>






        <!--

         * SVG SYMBOL

         * Example:

         <svg width="100%" height="100%" viewBox="0 0 100 100">

             <use xlink:href="#svg-symbol__facebook"></use>

         </svg>

        -->

        <svg id="svg-symbol">

            <symbol id="svg-symbol__facebook" viewBox="0 0 100 100">

                <path d="M72.3,33.1H57.1v-10c0-3.7,2.5-4.6,4.2-4.6c1.7,0,10.7,0,10.7,0V2.1L57.3,2C40.9,2,37.2,14.3,37.2,22.1v11h-9.5v17h9.5 c0,21.8,0,48,0,48h19.9c0,0,0-26.5,0-48h13.5L72.3,33.1z"/>

            </symbol>



            <symbol id="svg-symbol__twitter" viewBox="0 0 100 100">

                <path d="M96.2,21.3c-3.4,1.5-7.1,2.5-10.9,3c3.9-2.3,6.9-6.1,8.3-10.5C90,16,86,17.6,81.6,18.4c-3.5-3.7-8.4-6-13.9-6 c-10.5,0-19,8.5-19,19c0,1.5,0.2,2.9,0.5,4.3c-15.8-0.8-29.8-8.3-39.1-19.8c-1.6,2.8-2.6,6.1-2.6,9.5c0,6.6,3.4,12.4,8.4,15.8 c-3.1-0.1-6-1-8.6-2.4c0,0.1,0,0.2,0,0.2c0,9.2,6.5,16.9,15.2,18.6c-1.6,0.4-3.3,0.7-5,0.7c-1.2,0-2.4-0.1-3.6-0.3 c2.4,7.5,9.4,13,17.7,13.2c-6.5,5.1-14.7,8.1-23.6,8.1c-1.5,0-3-0.1-4.5-0.3c8.4,5.4,18.4,8.5,29.1,8.5c34.9,0,54-28.9,54-54 c0-0.8,0-1.6-0.1-2.5C90.5,28.5,93.7,25.1,96.2,21.3z" />

            </symbol>



            <symbol id="svg-symbol__whatsapp" viewBox="0 0 100 100">

                    <path d="M89.5,47.6c-0.1,10.3-2.7,18.3-8.2,25.3c-5.9,7.5-13.6,12.3-23,14.2C51,88.6,44,87.9,37,85.4 c-1.5-0.6-3-1.2-4.5-2c-0.4-0.2-0.8-0.3-1.3-0.1c-6.6,2.1-13.1,4.2-19.7,6.3c-0.3,0.1-0.7,0.4-0.9,0.2c-0.3-0.3,0.1-0.6,0.2-1 c1.3-3.9,2.6-7.8,4-11.7c0.8-2.4,1.6-4.7,2.4-7.1c0.2-0.6,0.1-1.1-0.2-1.7c-1.7-2.9-2.9-5.9-3.8-9.1c-1.6-6-1.8-12.1-0.5-18.1 c1.4-6.6,4.3-12.5,8.8-17.6c5.4-6.2,12.1-10.2,20.1-12.2c5.1-1.2,10.2-1.4,15.4-0.6c6.7,1.1,12.8,3.8,18.1,8.1 c5.5,4.5,9.5,10.1,12.1,16.8C88.4,39.1,89.6,45.1,89.5,47.6z M20.5,80c4-1.3,7.9-2.5,11.7-3.8c0.5-0.2,0.9-0.1,1.3,0.2 c1.5,1,3,1.8,4.7,2.4c5.3,2.2,10.7,3,16.4,2.3c6.9-0.9,13-3.7,18.2-8.5c6.5-6.1,9.9-13.6,10.2-22.4c0.3-8.7-2.5-16.3-8.3-22.8 c-5.5-6.1-12.5-9.6-20.7-10.5c-7.1-0.8-13.8,0.8-19.9,4.5c-5.3,3.2-9.3,7.5-12.1,13c-3.1,6-4.1,12.4-3.3,19.1 c0.7,5.1,2.5,9.7,5.4,13.9c0.3,0.5,0.4,0.9,0.2,1.4c-0.6,1.7-1.1,3.3-1.7,5C21.9,75.7,21.2,77.7,20.5,80z"/>

                    <path d="M31.2,40c0.1-3.9,1.4-6.7,4-9c0.8-0.7,1.8-1.1,3-0.9c0.5,0.1,1,0.1,1.5,0.1c0.9,0,1.5,0.4,1.8,1.2 c1.1,2.8,2.1,5.6,3.2,8.5c0.4,1-0.3,1.7-0.8,2.4c-0.6,0.8-1.3,1.6-2,2.3c-0.7,0.7-0.8,1.2-0.3,2.1c2.9,5.3,7.1,9.4,12.6,12 c0.2,0.1,0.4,0.2,0.6,0.3c0.7,0.3,1.4,0.3,2-0.4c1-1.2,2.2-2.3,3.1-3.6c0.6-0.8,1.1-1,2-0.6c2.9,1.2,5.5,2.8,8.3,4.3 c0.5,0.3,0.7,0.7,0.7,1.3c-0.1,4.8-2.9,7.3-7.7,8.4c-2.3,0.5-4.5,0-6.6-0.8c-4.5-1.6-8.8-3.5-12.4-6.7c-2.9-2.6-5.4-5.4-7.6-8.6 c-1.7-2.5-3.4-4.9-4.3-7.7C31.6,42.8,31.2,41.2,31.2,40z"/>

            </symbol>



            <symbol id="svg-symbol__instagram" viewBox="0 0 100 100">

                <path d="M71,15.7H29c-7.3,0-13.3,5.9-13.3,13.3v14V71c0,7.3,5.9,13.3,13.3,13.3H71c7.3,0,13.3-5.9,13.3-13.3V43V29 C84.3,21.7,78.3,15.7,71,15.7z M74.8,23.6l1.5,0v1.5v10.1l-11.6,0l0-11.6L74.8,23.6z M40.2,43c2.2-3,5.8-5,9.8-5s7.6,2,9.8,5 c1.4,2,2.3,4.4,2.3,7c0,6.7-5.4,12.1-12.1,12.1c-6.7,0-12.1-5.4-12.1-12.1C37.9,47.4,38.8,44.9,40.2,43z M77.6,71 c0,3.6-2.9,6.6-6.6,6.6H29c-3.6,0-6.6-2.9-6.6-6.6V43h10.2c-0.9,2.2-1.4,4.5-1.4,7c0,10.3,8.4,18.8,18.8,18.8 c10.3,0,18.8-8.4,18.8-18.8c0-2.5-0.5-4.9-1.4-7h10.2V71z"/>

            </symbol>



            <symbol id="svg-symbol__youtube" viewBox="0 0 100 100">

                <path d="M74.9,48.2H25.1c-7.9,0-14.3,6.4-14.3,14.3V74c0,7.9,6.4,14.3,14.3,14.3h49.7c7.9,0,14.3-6.4,14.3-14.3V62.5 C89.2,54.6,82.8,48.2,74.9,48.2z M35.6,57.1H31v23h-4.5v-23h-4.6v-3.9h13.7C35.6,53.2,35.6,57.1,35.6,57.1z M48.6,80.1h-4v-2.2 c-0.7,0.8-1.5,1.4-2.3,1.8c-0.8,0.4-1.6,0.6-2.3,0.6c-0.9,0-1.6-0.3-2.1-0.9c-0.5-0.6-0.7-1.5-0.7-2.7V60.3h4v15.2 c0,0.5,0.1,0.8,0.2,1c0.2,0.2,0.4,0.3,0.8,0.3c0.3,0,0.7-0.1,1.1-0.4c0.4-0.3,0.9-0.6,1.2-1.1V60.3h4V80.1z M63,76 c0,1.4-0.3,2.5-0.9,3.2c-0.6,0.8-1.5,1.1-2.7,1.1c-0.8,0-1.5-0.1-2.1-0.4c-0.6-0.3-1.2-0.7-1.7-1.3v1.5h-4V53.2h4v8.7 c0.5-0.6,1.1-1.1,1.7-1.4c0.6-0.3,1.2-0.5,1.8-0.5c1.3,0,2.2,0.4,2.9,1.3c0.7,0.8,1,2.1,1,3.7L63,76L63,76z M76.8,70.7h-7.6v3.7 c0,1,0.1,1.8,0.4,2.2c0.3,0.4,0.7,0.6,1.3,0.6c0.7,0,1.1-0.2,1.4-0.5c0.3-0.3,0.4-1.1,0.4-2.3v-0.9h4.1v1c0,2-0.5,3.6-1.5,4.6 c-1,1-2.5,1.5-4.4,1.5c-1.8,0-3.2-0.5-4.2-1.6c-1-1.1-1.5-2.6-1.5-4.5v-8.9c0-1.7,0.6-3.1,1.7-4.2c1.1-1.1,2.6-1.6,4.3-1.6 c1.8,0,3.2,0.5,4.2,1.5c1,1,1.5,2.4,1.5,4.3V70.7z"/>

                <path d="M71,63.3c-0.6,0-1.1,0.2-1.4,0.5c-0.3,0.3-0.4,0.9-0.4,1.8v2h3.5v-2c0-0.8-0.1-1.4-0.4-1.8C72,63.4,71.6,63.3,71,63.3z"/>

                <path d="M57.3,63.2c-0.3,0-0.6,0.1-0.8,0.2c-0.3,0.1-0.5,0.3-0.8,0.6v12.4c0.3,0.3,0.6,0.6,0.9,0.7c0.3,0.1,0.6,0.2,1,0.2 c0.5,0,0.8-0.1,1.1-0.4c0.2-0.3,0.3-0.7,0.3-1.4V65.2c0-0.7-0.1-1.2-0.4-1.5C58.2,63.4,57.8,63.2,57.3,63.2z"/>

                <polygon points="31.6,41.3 36.7,41.3 36.7,29 42.5,11.7 37.4,11.7 34.3,23.5 34,23.5 30.7,11.7 25.7,11.7 31.6,29.6    "/>

                <path d="M49.3,41.8c2,0,3.6-0.5,4.8-1.6c1.2-1.1,1.7-2.5,1.7-4.4V24.6c0-1.7-0.6-3-1.8-4.1c-1.2-1.1-2.7-1.6-4.5-1.6 c-2,0-3.6,0.5-4.8,1.5c-1.2,1-1.8,2.3-1.8,4v11.3c0,1.9,0.6,3.3,1.8,4.4C45.8,41.3,47.4,41.8,49.3,41.8z M47.5,24.3 c0-0.5,0.2-0.9,0.5-1.2c0.3-0.3,0.8-0.4,1.3-0.4c0.6,0,1.1,0.1,1.4,0.4c0.4,0.3,0.5,0.7,0.5,1.2v11.9c0,0.6-0.2,1-0.5,1.4 c-0.4,0.3-0.8,0.5-1.4,0.5c-0.6,0-1-0.2-1.4-0.5c-0.3-0.3-0.5-0.8-0.5-1.4L47.5,24.3L47.5,24.3z"/>

                <path d="M62.6,41.6c0.8,0,1.7-0.2,2.6-0.7c0.9-0.5,1.8-1.1,2.6-2v2.4h4.5V19.4h-4.5V36c-0.4,0.5-0.9,0.9-1.4,1.2 c-0.5,0.3-0.9,0.5-1.2,0.5c-0.4,0-0.7-0.1-0.9-0.4c-0.2-0.2-0.3-0.6-0.3-1.1V19.4h-4.5v18.3c0,1.3,0.3,2.3,0.8,2.9 C60.8,41.3,61.5,41.6,62.6,41.6z"/>

            </symbol>



            <symbol id="svg-symbol__arrow-1" viewBox="0 0 17 12">

                <path d="M17,6L17,6l-0.4,0.4l0,0l-5.1,5.1l-0.4-0.4l4.8-4.8H0V5.7h15.9l-4.8-4.8l0.4-0.4l5.1,5.1l0,0L17,6L17,6z"/>

            </symbol>



            <symbol id="svg-symbol__arrow-2" viewBox="0 0 50 70">

                <polygon points="20.5,35 33,46.7 31.3,48.3 17,35 31.3,21.7 33,23.3 "/>

            </symbol>



            <symbol id="svg-symbol__arrow-3" viewBox="0 0 30 50">

                <polygon points="1,4.5 4,1.7 29,25 4,48.3 1,45.5 22.9,25 "/>

            </symbol>



            <symbol id="svg-symbol__play" viewBox="0 0 50 50">

                <path d="M10.5,6.5v37L39.5,25L10.5,6.5z"/>

            </symbol>



            <symbol id="svg-symbol__close" viewBox="0 0 50 50">

                <path d="M27.8,25l16-16c0.8-0.8,0.8-2,0-2.8c-0.8-0.8-2-0.8-2.8,0l-16,15.9L8.9,6.1c-0.8-0.8-2-0.8-2.8,0 c-0.8,0.8-0.8,2,0,2.8L22.3,25L6.1,41.2c-0.8,0.8-0.8,2,0,2.8c0.8,0.8,2,0.8,2.8,0L25,27.8l16.1,16.1c0.8,0.8,2,0.8,2.8,0 c0.8-0.8,0.8-2,0-2.8L27.8,25z"/>

            </symbol>



            <symbol id="svg-symbol__share" viewBox="0 0 100 100">

                <path fill="none" stroke-width="5.8953" stroke-miterlimit="10" d="M80.5,85.4L21.5,50l51.1-29.5"/>

                <circle cx="76.5" stroke-width="0" cy="18.6" r="15.7"/>

                <circle cx="23.5" stroke-width="0" cy="50" r="15.7"/>

                <circle cx="76.5" stroke-width="0" cy="81.4" r="15.7"/>

            </symbol>



            <symbol id="svg-symbol__share-2" viewBox="0 0 100 100">

                <path d="M95.9,41.6L64.7,13.2c-2.4-2.4-5.2,0-5.2,3.8v14.2c-22.2,0-41.1,13.7-50.1,32.1c-3.3,6.1-5.2,12.8-6.6,19.4 c-0.9,4.7,6.1,7.1,9,2.8C22.2,69,39.6,58.1,59.5,58.1v15.6c0,3.8,2.8,6.1,5.2,3.8l31.2-28.3C97.8,47.2,97.8,43.5,95.9,41.6z"/>

            </symbol>



            <symbol id="svg-symbol__star" viewBox="0 0 100 100">

                <path d="M36.3,35.2c0,0-16.5,1.8-27.4,3C7.8,38.4,7,39,6.6,40c-0.3,1,0,2.1,0.7,2.7c8.2,7.4,20.4,18.6,20.4,18.6 c0,0-3.4,16.2-5.6,27c-0.2,1,0.2,2,1,2.6c0.8,0.6,1.9,0.6,2.8,0.1c9.6-5.5,24-13.7,24-13.7s14.4,8.2,24,13.7 c0.9,0.5,2,0.5,2.8-0.2c0.9-0.6,1.2-1.7,1-2.6c-2.2-10.8-5.6-27-5.6-27s12.3-11.1,20.4-18.6c0.7-0.7,1.1-1.7,0.7-2.7 c-0.3-1-1.2-1.7-2.2-1.8c-11-1.2-27.4-3.1-27.4-3.1S56.9,20.1,52.4,10C51.9,9.1,51,8.5,50,8.5c-1.1,0-2,0.6-2.4,1.5 C43.1,20.1,36.3,35.2,36.3,35.2z"/>

            </symbol>



            <symbol id="svg-symbol__user" viewBox="0 0 50 50">

                <path d="M25,30.2c6.6,0,12.1,4.7,13.3,10.9c-3.6,3-8.3,4.8-13.3,4.8s-9.7-1.8-13.3-4.8C12.9,34.9,18.4,30.2,25,30.2z M25,8.8 c3.4,0,6.3,3.2,6.3,7.3s-2.9,7.3-6.3,7.3s-6.3-3.2-6.3-7.3S21.6,8.8,25,8.8z M25,6.7c-4.7,0-8.4,4.3-8.4,9.4s3.7,9.4,8.4,9.4 s8.4-4.3,8.4-9.4S29.7,6.7,25,6.7z M25,4.1c11.6,0,20.9,9.3,20.9,20.9c0,5.6-2.2,10.7-5.8,14.5c-1.9-6.6-7.9-11.4-15.1-11.4 S11.8,32.9,9.9,39.5C6.3,35.7,4.1,30.6,4.1,25C4.1,13.4,13.4,4.1,25,4.1z M25,2C12.3,2,2,12.3,2,25s10.3,23,23,23s23-10.3,23-23 S37.7,2,25,2z"/>

            </symbol>



            <symbol id="svg-symbol__compare" viewBox="0 0 100 100">

                <path d="M42.8,61.7c0.6-0.6,22.1-20.3,22.7-20.9c0.6-0.6,3-0.6,3,0.6c0,1.2,0,11.9,0,11.9h25.6c0,0,4.2,1.2,4.2,10.7 s-4.8,9.5-4.8,9.5h-25c0,0,0,11.9,0,13.1s-2.7,0.9-3.6,0C64,85.9,43.4,66.5,42.8,65.9C42.2,65.3,42.2,62.3,42.8,61.7z"/>

                <path d="M57.2,37.9c-0.6,0.6-21.2,20-22.1,20.9c-0.9,0.9-3.6,1.2-3.6,0c0-1.2,0-13.1,0-13.1h-25c0,0-4.8,0-4.8-9.5 s4.2-10.7,4.2-10.7h25.6c0,0,0-10.7,0-11.9s2.4-1.2,3-0.6c0.6,0.6,22.1,20.3,22.7,20.9C57.8,34.3,57.8,37.3,57.2,37.9z"/>

            </symbol>



            <symbol id="svg-symbol__mail" viewBox="0 0 100 100">

                <path d="M8.6,19.9v60.3h82.9V19.9H8.6z M12.3,32.2l23.5,18L12.3,73.7V32.2z M15,76.4l23.8-23.9L50,61l11.2-8.5L85,76.4H15z M87.7,73.7L64.2,50.2l23.5-18V73.7z M87.7,27.5L50,56.4L12.3,27.5v-3.8h75.3V27.5z"/>

            </symbol>



            <symbol id="svg-symbol__download" viewBox="0 0 50 50">

                <path d="M40.8,42.3H9.1v5.3h31.8C40.8,47.5,40.8,42.3,40.8,42.3z M40.3,21.2c-0.8-0.8-2.1-0.8-2.9,0L27,31.5V4.6

                c0-1.2-0.9-2.1-2.1-2.1c-1.2,0-2.1,0.9-2.1,2.1v26.9L12.6,21.3c-0.8-0.8-2.1-0.8-2.9,0c-0.8,0.8-0.8,2.1,0,2.9L23.5,38

                c0,0,0.1,0.1,0.2,0.1c0,0,0,0,0.1,0.1c0,0,0.1,0,0.1,0.1c0,0,0.1,0,0.1,0.1c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0

                c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0.1,0,0.3,0,0.4,0

                c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0

                c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1,0c0,0,0.1,0,0.1-0.1c0,0,0.1,0,0.1-0.1c0,0,0,0,0.1-0.1c0.1-0.1,0.2-0.1,0.2-0.2c0,0,0,0,0.1-0.1

                l13.8-13.8C41.1,23.3,41.1,22,40.3,21.2"/>

            </symbol>



        </svg>





        <!--HEADER-->

        <header class="header" data-open="false">



            <div class="center-wrapper">



                <div class="header__top || center-wrapper">

                    <div class="center-wrapper">

                        <h1 class="header__logo || icon__logo">

                            <a href="{{ Config::get('app.url') }}">Franquiciar</a>

                        </h1>



                        <button class="header__hamburger">

                            <i></i>

                            <i></i>

                            <i></i>

                        </button>

                    </div>



                </div>



                <div class="header__bottom">

                    <div class="header__bottom__scroll">

                        <div class="header__bottom__wrapper">

                            <div class="center-wrapper">

                                <nav class="header__main-nav">

                                    <ul class="header__main-nav__list">

                                        <li class="header__main-nav__item || js-open-sub-menu {{($frontClass == 'about')?'js-active':''}}">

                                            <a href="javascript:void(0)" class="button-text js-change-url" data-text="Franquiciar" data-url="{{ Config::get('app.url') }}que-es-fraquiciar">

                                                <span>Franquiciar</span>

                                            </a>

                                            <ul class="header__sub-nav">

                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}que-es-fraquiciar">¿Qué es Franquiciar?</a></li>

                                                <li class="header__sub-nav__item"><a href="http://franquiciar.com.ar/registra-tu-franquicia/" target="_blank">Registrá tu Franquicia</a></li>

                                            </ul>

                                        </li>



                                        <li class="header__main-nav__item {{($frontClass == 'adviser')?'js-active':''}} ">

                                            <a href="{{ Config::get('app.url') }}tu-asesor" class="button-text" data-text="Tu asesor"><span>Tu asesor</span></a>

                                        </li>



                                        <li class="header__main-nav__item || js-open-sub-menu {{($frontClass == 'news' || $frontClass == 'news-item')?'js-active':''}}">

                                            <a href="javascript:void(0)" class="button-text js-change-url" data-text="Actualidad" data-url="{{ Config::get('app.url') }}actualidad"><span>Actualidad</span></a>

                                            <ul class="header__sub-nav">

                                                {{-- <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}actualidad">Todas</a></li> --}}
                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}actualidad/tipo/noticia">Noticias</a></li>
                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}actualidad/tipo/entrevista">Entrevistas</a></li>
                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}actualidad/tipo/video">Videos</a></li>

                                            </ul>

                                        </li>



                                        <li class="header__main-nav__item || js-open-sub-menu {{($frontClass == 'franchising' || $frontClass == 'associations' || $frontClass == 'carnival')?'js-active':''}}">

                                            <a href="javascript:void(0)" class="button-text js-change-url" data-text="Franchising" data-url="{{ Config::get('app.url') }}la-franquicia">

                                                <span>Franchising</span>

                                            </a>

                                            <ul class="header__sub-nav">

                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}la-franquicia">La franquicia</a></li>

                                                <li class="header__sub-nav__item"><a href="{{ Config::get('app.url') }}asociaciones-franquicias">Asociaciones de Franquicias</a></li>

                                            </ul>



                                        </li>



                                        <li class="header__main-nav__item">

                                            <a href="javascript.void(0)" class="button-text || js-open-contact-info" data-text="Contacto"><span>Contacto</span></a>

                                        </li>

                                    </ul>

                                </nav>



                                <div class="header__small-nav">

                                    <ul class="header__small-nav__social">

                                        <li class="header__small-nav__item">

                                            <button class="icon__social icon__social--whatsapp">

                                                <span>Whatsapp</span>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__whatsapp"></use>

                                                </svg>



                                                <div class="whatsapp__number">

                                                    <div class="whatsapp__number__wrapper">

                                                        <p>+54 11 5851.8282</p>

                                                    </div>

                                                </div>

                                            </button>

                                        </li>



                                        <li class="header__small-nav__item">

                                            <a href="https://www.facebook.com/franquiciarargentina" target="_blank" class="icon__social icon__social--facebook">

                                                <span>Facebook</span>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__facebook"></use>

                                                </svg>

                                            </a>

                                        </li>



                                        <li class="header__small-nav__item">

                                            <a href="https://twitter.com/franquiciarArg" target="_blank" class="icon__social icon__social--twitter">

                                                <span>Twitter</span>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__twitter"></use>

                                                </svg>

                                            </a>

                                        </li>



                                        <li class="header__small-nav__item">

                                            <a href="https://www.instagram.com/franquiciarargentina" target="_blank" class="icon__social icon__social--instagram">

                                                <span>Instagram</span>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__instagram"></use>

                                                </svg>

                                            </a>

                                        </li>



                                        <li class="header__small-nav__item">

                                            <a href="https://www.youtube.com/channel/UCyPAnRu-RzGB6b03hEJk_Aw" target="_blank" class="icon__social icon__social--youtube">

                                                <span>YouTube</span>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__youtube"></use>

                                                </svg>

                                            </a>

                                        </li>

                                    </ul>



                                    @if(empty($loggedUser))



                                        <div class="header__small-nav__list">

                                            <div class="header__small-nav__item">

                                                <a href="{{ Config::get('app.url') }}FmCBYkve51">

                                                    Franquicias

                                                    <i class="header__small-nav__arrow icon__arrow-1">

                                                        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">

                                                            <use xlink:href="#svg-symbol__arrow-1"></use>

                                                        </svg>

                                                        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">

                                                            <use xlink:href="#svg-symbol__arrow-1"></use>

                                                        </svg>

                                                    </i>

                                                </a>

                                            </div>



                                            <div class="header__small-nav__item">

                                                <a href="{{ (empty($loggedUser)) ? '#' : Config::get('app.url').'perfil' }}" {{ (empty($loggedUser)) ? 'class=js-open-user-login' : '' }}>

                                                    {{ (empty($loggedUser)) ? 'Inversores' : 'Perfil' }}

                                                    <i class="header__small-nav__arrow">

                                                        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">

                                                            <use xlink:href="#svg-symbol__arrow-1"></use>

                                                        </svg>

                                                        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 17 12">

                                                            <use xlink:href="#svg-symbol__arrow-1"></use>

                                                        </svg>

                                                    </i>

                                                </a>

                                            </div>

                                        </div>



                                    @else



                                        <div class="header__small-nav__user">

                                            <div>

                                                <a class="user__text" href="{{ Config::get('app.url') }}perfil">{{  $loggedUser->first_name }}</a>

                                                @if($loggedUser->hasRole(['investor_user', 'user']))

                                                    <a class="user__close" href="{{ Config::get('app.url') }}logout">Cerrar sesión</a>

                                                @else

                                                    <a class="user__close" href="{{ Config::get('app.url') }}{{ Config::get('app.admin_directory') }}">Ingresar</a>

                                                @endif

                                            </div>

                                            <i>

                                                <svg width="100%" height="100%" viewBox="0 0 100 100">

                                                    <use xlink:href="#svg-symbol__user"></use>

                                                </svg>

                                            </i>

                                        </div>



                                    @endif



                                </div>

                            </div>

                        </div>

                    </div>





                </div>

            </div>



        </header>



        <div class="site-wrapper">

            <!--CONTENT-->

            <div id="app">

                @yield('content')

            </div>



            <!--FOOTER-->

            <footer class="footer">

                <div class="center-wrapper">



                    <div class="footer__wrapper footer__wrapper__left">

                        <h1 class="footer__logo || icon__logo">

                            <a href="#">Franquiciar</a>

                        </h1>

                        <ul class="footer__info">

                            <li class="footer__info__item">

                                <span>

                                    <i>

                                        <svg width="100%" height="100%" viewBox="0 0 100 100">

                                            <use xlink:href="#svg-symbol__whatsapp"></use>

                                        </svg>

                                    </i>

                                    Tel:

                                </span> +54 11 5851.8282

                            </li>

                            <li class="footer__info__item">



                                <span>

                                    <i>

                                        <svg width="100%" height="100%" viewBox="0 0 100 100">

                                            <use xlink:href="#svg-symbol__mail"></use>

                                        </svg>

                                    </i>

                                    E-mail:

                                </span>

                                <a href="mailto:franquiciar@franquiciar.com.ar" target="_top">franquiciar@franquiciar.com.ar</a>

                            </li>

                        </ul>

                    </div>



                    <div class="footer__wrapper footer__wrapper__center">

                        <nav class="footer__nav">

                            <ul class="footer__nav__list">

                                <li class="footer__nav__list__item {{($frontClass == 'about')?'js-active':''}}">

                                    <a href="{{ Config::get('app.url') }}que-es-fraquiciar" class="button-text" data-text="Franquiciar"><span>Franquiciar</span></a>

                                </li>



                                <li class="footer__nav__list__item {{($frontClass == 'adviser')?'js-active':''}}">

                                    <a href="{{ Config::get('app.url') }}tu-asesor" class="button-text" data-text="Tu asesor"><span>Tu asesor</span></a>

                                </li>



                                <li class="footer__nav__list__item {{($frontClass == 'news' || $frontClass == 'news-item')?'js-active':''}}">

                                    <a href="{{ Config::get('app.url') }}actualidad" class="button-text" data-text="Actualidad"><span>Actualidad</span></a>

                                </li>



                                <li class="footer__nav__list__item {{($frontClass == 'franchising' || $frontClass == 'associations' || $frontClass == 'carnival')?'js-active':''}}">

                                    <a href="{{ Config::get('app.url') }}la-franquicia" class="button-text" data-text="Franchising"><span>Franchising</span></a>

                                </li>



                                <li class="footer__nav__list__item">

                                    <a href="#" class="button-text || js-open-contact-info" data-text="Contacto"><span>Contacto</span></a>

                                </li>

                            </ul>

                        </nav>



                        <small class="footer__copy">&copy;Copyright Franquiciar 2016 | Todos los derechos reservados</small>

                    </div>



                    <div class="footer__wrapper footer__wrapper__right">

                        <form class="footer__newsletter || newsletter__form" method="post" action="{{ Config::get('app.url') }}addNewsletter">

                            {{ Form::hidden('_token', csrf_token()) }}



                            <h2 class="footer__newsletter__title">Suscribite a nuestro Newsletter</h2>



                            <div class="footer__newsletter__form" action="">

                               <i class="spinner">

                                    <div class="spinner__wrapper"></div>

                                </i>

                                <input class="footer__newsletter__input || newsletter__input"  name="email" type="e-mail" placeholder="Ingresá tu email">

                                <button class="footer__newsletter__button || newsletter__btn" type="submit">Enviar</button>

                            </div>

                        </form>



                        <div class="footer__data-fiscal">

                            <a href="http://qr.afip.gob.ar/?qr=903oyPQPjgYFxWhU6RlfHQ,," target="_F960AFIPInfo"><img src="http://www.afip.gob.ar/images/f960/DATAWEB.jpg" border="0"></a>

                        </div>

                    </div>



                </div>

            </footer>



        </div>



        @include('frontend.includes.component_user-register')

        @include('frontend.includes.component_user-login')

        @include('frontend.includes.component_share')

        @include('frontend.includes.component_compare')

        @include('frontend.includes.component_contact-modal')



        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>



        <script type="text/javascript">

            var widId = "";

            var onloadCallback = function ()

            {

                widId = grecaptcha.render('recapchaWidget', {

                    'sitekey':'6Lf3gRgUAAAAAPO5rZ_InudgcxY51H67jNWM4g48'

                });

            };

        </script>



        <script type="text/javascript">

            function IsRecapchaValid()

            {

                var res = grecaptcha.getResponse(widId);

                if (res == "" || res == undefined || res.length == 0)

                {

                    return false;

                }

                return true;

            }

        </script>



        <script src="{{ Config::get('app.url') }}script/main.js"></script>

        @yield('scripts')

    </body>

</html>
