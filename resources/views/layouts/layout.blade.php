<!DOCTYPE html>

<html>

    <head>

        @section('metadata')

            <title>Franquiciar - Franquicias en Argentina, Franquicias Rentables</title>

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

        <meta name="msapplication-TileImage" content="{{ Config::get('app.url') }}public/image/favicon/mstile-144x144.png">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}public/image/favicon/favicon-16x16.png" sizes="16x16">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}public/image/favicon/favicon-32x32.png" sizes="32x32">

        <link rel="shortcut icon" type="image/png" href="{{ Config::get('app.url') }}public/image/favicon/favicon-96x96.png" sizes="96x96">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-57x57.png">

        <link rel="apple-touch-icon" sizes="114x114" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-114x114.png">

        <link rel="apple-touch-icon" sizes="72x72" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-72x72.png">

        <link rel="apple-touch-icon" sizes="144x144" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-144x144.png">

        <link rel="apple-touch-icon" sizes="60x60" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-60x60.png">

        <link rel="apple-touch-icon" sizes="120x120" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-120x120.png">

        <link rel="apple-touch-icon" sizes="76x76" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-76x76.png">

        <link rel="apple-touch-icon" sizes="152x152" href="{{ Config::get('app.url') }}public/image/favicon/apple-touch-icon-152x152.png">


        <!-- <link rel="stylesheet" href="{{ Config::get('app.url') }}public/style/main.css"> -->
        <link rel="stylesheet" href="{{ Config::get('app.url') }}public/css/app.css">



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

            <symbol id="svg-symbol__facebook" viewBox="0 0 20.68 20.68">

                <path class="cls-1" d="M0,18.5V2.17l0-.06A2.46,2.46,0,0,1,2.59,0H18.1a2.48,2.48,0,0,1,2.58,2.6V18.08a3,3,0,0,1-.09.73,2.46,2.46,0,0,1-2.52,1.87H2.37A2.49,2.49,0,0,1,.13,19C.08,18.82,0,18.66,0,18.5ZM16.72,7.88c-.38,0-.74,0-1.1,0a8.59,8.59,0,0,0-1,.07.39.39,0,0,0-.3.25c0,.37,0,.75,0,1.15h2.56l-.69,3.44H14.3v6.89h3.77a1.49,1.49,0,0,0,1.63-1.62V2.61A1.49,1.49,0,0,0,18.07,1H2.62A1.49,1.49,0,0,0,1,2.61V18.06a1.49,1.49,0,0,0,1.62,1.63h7.71v-6.9H8.88V9.35h1.46c0-.27,0-.52,0-.76a9.67,9.67,0,0,1,.12-1.32,3.15,3.15,0,0,1,2.41-2.72,5.8,5.8,0,0,1,3.73.5.36.36,0,0,1,.13.28c0,.77,0,1.53,0,2.29C16.74,7.7,16.73,7.78,16.72,7.88Zm-1-1c0-.31,0-.6,0-.88a.27.27,0,0,0-.23-.31,5.44,5.44,0,0,0-1.88-.25A2.11,2.11,0,0,0,11.55,7a6.35,6.35,0,0,0-.22,1.44c0,.63,0,1.25,0,1.9H9.87v1.49h1.47v7.85h1.95V11.82h2.06l.3-1.48H13.31c0-.75,0-1.48,0-2.19A1.22,1.22,0,0,1,14.47,7C14.88,6.9,15.3,6.9,15.75,6.87Z"/>

            </symbol>



            <symbol id="svg-symbol__twitter" viewBox="0 0 25.12 20.96">

                <path class="cls-1" d="M7.93,21A14.5,14.5,0,0,1,.46,19l-.18-.13-.07,0a.5.5,0,0,1,.3-.91A10.65,10.65,0,0,0,6.29,16.4a5.53,5.53,0,0,1-3.82-3.59.48.48,0,0,1,.06-.46.49.49,0,0,1,.41-.21H3A5.81,5.81,0,0,1,.63,7.67a.51.51,0,0,1,.18-.42.5.5,0,0,1,.45-.1l.46.12a5.76,5.76,0,0,1-.34-6,.51.51,0,0,1,.83-.12,13.84,13.84,0,0,0,9.42,5c0-.11,0-.22,0-.33A8,8,0,0,1,11.87,4a5.47,5.47,0,0,1,8.78-2.76c.32.27.5.27.73.19l.22-.08A14.85,14.85,0,0,1,24,.64a.5.5,0,0,1,.49.8l-1,1.38,0,0a4.27,4.27,0,0,1,1.17-.19.51.51,0,0,1,.45.31.49.49,0,0,1-.1.54L24.43,4c-.44.47-.9,1-1.4,1.39a.79.79,0,0,0-.33.67,15,15,0,0,1-6.21,12.18A14.46,14.46,0,0,1,7.93,21ZM2.28,18.79a14,14,0,0,0,13.61-1.32A14,14,0,0,0,21.7,6.06a1.75,1.75,0,0,1,.67-1.39c.27-.24.53-.5.78-.76C23,4,22.78,4,22.6,4l-.31.06a.5.5,0,0,1-.49-.8l1-1.26c-.27.09-.55.19-.82.3l-.22.08A1.64,1.64,0,0,1,20,2,4.47,4.47,0,0,0,12.83,4.3a8.14,8.14,0,0,0-.18,1.55c0,.28,0,.57-.06.87a.49.49,0,0,1-.53.45A14.83,14.83,0,0,1,2,2.37c-.68,2-.21,3.73,1.45,5.45a.48.48,0,0,1,.07.6A.5.5,0,0,1,3,8.65L1.72,8.31a5,5,0,0,0,3.36,3.86.52.52,0,0,1,.3.57.5.5,0,0,1-.49.4H3.7a4.81,4.81,0,0,0,3.92,2.52A.51.51,0,0,1,8,16a.5.5,0,0,1-.19.52A11.52,11.52,0,0,1,2.28,18.79Z"/>

            </symbol>



            <symbol id="svg-symbol__whatsapp" viewBox="0 0 100 100">

                    <path class="cls-1" d="M99,46.48v6.14a4.47,4.47,0,0,0-.2.78,46,46,0,0,1-5.44,18.88c-7.5,13.8-19,22.36-34.39,25.49-2,.4-4,.61-6,.91H46.8a4.47,4.47,0,0,0-.78-.2,49.36,49.36,0,0,1-18.35-5.23,3,3,0,0,0-1.87-.18c-4.43,1-8.84,2.15-13.26,3.26-3,.76-6,1.56-9,2.35H2.16C.77,97.76.61,96.59,1.07,95c2-6.79,3.84-13.61,5.78-20.41a2.72,2.72,0,0,0-.28-2.21,47.51,47.51,0,0,1-4.27-35A49,49,0,0,1,72.65,6.11C86.52,13.43,95,25,98.09,40.44,98.5,42.43,98.7,44.47,99,46.48Zm-93,47c.42-.08.61-.1.8-.15,6.3-1.55,12.6-3.09,18.88-4.69a4.17,4.17,0,0,1,3.15.41A43.81,43.81,0,0,0,62,92.72,44.82,44.82,0,0,0,46.54,4.86,43.52,43.52,0,0,0,19.48,16.6a44.61,44.61,0,0,0-8.54,55.14,3.4,3.4,0,0,1,.35,2.81c-.68,2.26-1.29,4.54-1.93,6.81C8.24,85.36,7.12,89.36,6,93.52Z" transform="translate(-0.72 -0.41)"/><path class="cls-1" d="M39.65,45.74A31.38,31.38,0,0,0,56,59.44c1.18-1.45,2.42-2.92,3.6-4.44,1.54-2,3.1-2.53,5.37-1.55,3.6,1.57,7.16,3.25,10.7,5a3.27,3.27,0,0,1,1.93,3c.06,6.88-2.31,10.19-9.09,12.86-3.7,1.45-7.56,1-11.36-.06C44.73,70.73,35.51,63,28.1,52.77c-2.37-3.27-4.52-6.63-5.44-10.63a16.35,16.35,0,0,1,4.76-16.28,6.51,6.51,0,0,1,4.8-1.92c.71,0,1.42.09,2.13,0A4.46,4.46,0,0,1,39,27q2.16,5,4.21,10A4.12,4.12,0,0,1,43,40.88C42,42.49,40.84,44,39.65,45.74ZM63.26,57.26c-.77,1-1.39,1.78-2,2.57s-1.36,1.63-2.07,2.42a4,4,0,0,1-4.79,1.2A36.32,36.32,0,0,1,35.9,47.82c-1.2-2-1-3.57.62-5.34a31.91,31.91,0,0,0,2.43-3,1.54,1.54,0,0,0,.15-1.29c-1.24-3.06-2.53-6.09-3.83-9.13-.12-.27-.35-.7-.53-.7-1.52,0-3.12-.58-4.49.71-3.66,3.46-4.6,7.64-3.32,12.39,1.05,3.88,3.31,7.1,5.69,10.24,6.7,8.88,15,15.5,25.89,18.52,3.88,1.08,7.58,1,11.12-1.15A7,7,0,0,0,73.27,63a1.42,1.42,0,0,0-.55-1.11C69.6,60.3,66.45,58.8,63.26,57.26Z" transform="translate(-0.72 -0.41)"/>

            </symbol>



            <symbol id="svg-symbol__instagram" viewBox="0 0 20.89 20.89">

                <path class="cls-1" d="M10.45,0H15.1a5.74,5.74,0,0,1,5.68,4.66,5.14,5.14,0,0,1,.1,1q0,4.76,0,9.51a5.73,5.73,0,0,1-4.76,5.6,6.9,6.9,0,0,1-1,.08H5.72A5.76,5.76,0,0,1,.07,16a6.82,6.82,0,0,1-.07-.9V5.75A5.74,5.74,0,0,1,4.86.07,6,6,0,0,1,5.71,0Zm9.31,10.44V5.59a7.53,7.53,0,0,0-.07-.83,4.39,4.39,0,0,0-4.35-3.64H5.55a4.47,4.47,0,0,0-.82.07A4.38,4.38,0,0,0,1.12,5.57v9.75a3.77,3.77,0,0,0,0,.58,4.39,4.39,0,0,0,4.33,3.86h9.9a4.38,4.38,0,0,0,4.37-4.41C19.77,13.71,19.76,12.08,19.76,10.44Z"/><path class="cls-1" d="M16,10.44a5.57,5.57,0,1,1-5.56-5.57A5.58,5.58,0,0,1,16,10.44Zm-10.19,0a4.63,4.63,0,1,0,4.62-4.61A4.62,4.62,0,0,0,5.82,10.43Z"/><path class="cls-1" d="M17.31,4.66a1.06,1.06,0,0,1-1.08,1.08,1.09,1.09,0,1,1,1.08-1.08Z"/>

            </symbol>



            <symbol id="svg-symbol__youtube" viewBox="0 0 28.59 21.24">

                <path class="cls-1" d="M14.31,21.24H12.84l-3.39-.05a36.27,36.27,0,0,1-4.23-.33,11.79,11.79,0,0,1-2.08-.48,3.78,3.78,0,0,1-2-1.69,6.81,6.81,0,0,1-.86-2.51,25.4,25.4,0,0,1-.27-4C0,10.71,0,9,.05,7.34a13.4,13.4,0,0,1,.5-3.49A5,5,0,0,1,2,1.46,4.23,4.23,0,0,1,3.86.64,17.82,17.82,0,0,1,6.79.2c2-.17,4-.2,5.86-.2h.88c1.41,0,2.88,0,4.32,0,1.22,0,2.54.09,4,.19A16.68,16.68,0,0,1,25.1.74,4,4,0,0,1,27.64,2.9a7,7,0,0,1,.68,2.38,45.28,45.28,0,0,1,.25,6.77v0c0,.83,0,1.57-.08,2.28a12.17,12.17,0,0,1-.61,3.42,5,5,0,0,1-1.21,1.84,3.7,3.7,0,0,1-1.6.86,17.09,17.09,0,0,1-3.29.54c-2,.17-4,.19-5.86.19H14.31Zm.48-20.1H12.65c-1.83,0-3.79,0-5.76.19a17.13,17.13,0,0,0-2.75.41,3,3,0,0,0-1.34.58A3.84,3.84,0,0,0,1.64,4.18a12.52,12.52,0,0,0-.44,3.2c-.05,1.66-.06,3.34-.05,4.76A24.55,24.55,0,0,0,1.4,16a5.45,5.45,0,0,0,.7,2.08,2.61,2.61,0,0,0,1.41,1.21,10.4,10.4,0,0,0,1.88.44A34.08,34.08,0,0,0,9.48,20c1.12,0,2.27,0,3.37,0h3.07c1.84,0,3.8,0,5.76-.19a15.5,15.5,0,0,0,3.06-.5,2.58,2.58,0,0,0,1.13-.57,4,4,0,0,0,.94-1.43,10.79,10.79,0,0,0,.53-3.1c.05-.68.07-1.4.08-2.21v0a45.66,45.66,0,0,0-.23-6.61,6.14,6.14,0,0,0-.57-2,2.83,2.83,0,0,0-1.83-1.57,15,15,0,0,0-3-.5c-1.48-.1-2.78-.16-4-.18C16.82,1.15,15.8,1.14,14.79,1.14ZM10.93,16.08a.83.83,0,0,1-.38-.1.8.8,0,0,1-.37-.52,2.25,2.25,0,0,1,0-.38V6a.8.8,0,0,1,1.26-.68l7.93,4.58a.27.27,0,0,1,.1.06.8.8,0,0,1,.4.72.83.83,0,0,1-.45.68l-1.69,1-5.56,3.21-.69.4a1.06,1.06,0,0,1-.25.11A.86.86,0,0,1,10.93,16.08Zm.36-9.54v8.15l.28-.16,5.55-3.21,1.22-.71Z"/>

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

                          <a href="{{ Config::get('app.url') }}">Franquiciar</a>

                      </h1>
                      
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

                    </div>



                    <div class="footer__wrapper footer__wrapper__center">
                      <ul class="footer__info">

                          <li class="footer__info__item">

                              <span>

                                  <!-- <i>

                                      <svg width="100%" height="100%" viewBox="0 0 100 100">

                                          <use xlink:href="#svg-symbol__mail"></use>

                                      </svg>

                                  </i> -->

                                  E-mail

                              </span>

                              <a href="mailto:franquiciar@franquiciar.com.ar" target="_top">franquiciar@franquiciar.com.ar</a>

                          </li>

                          <li class="footer__info__item">

                            <span>

                                  <!-- <i>

                                      <svg width="100%" height="100%" viewBox="0 0 100 100">

                                          <use xlink:href="#svg-symbol__whatsapp"></use>

                                      </svg>

                                  </i> -->

                                  Teléfono

                              </span> 
                              <a href="tel:+5491147803500">+54 9 11 4780 3500
</a>
  

                          </li>

                      </ul>

                      <ul class="footer__small-nav__social">

                          <li class="footer__small-nav__item">

                              <a href="https://wa.me/5491147803500" target="_blank" class="icon__social icon__social--whatsapp">

                                  <span>Whatsapp</span>

                                  <svg width="100%" height="100%" viewBox="0 0 100 100">

                                      <use xlink:href="#svg-symbol__whatsapp"></use>

                                  </svg>

                              </a>

                          </li>



                          <li class="footer__small-nav__item">

                              <a href="https://www.facebook.com/franquiciarargentina" target="_blank" class="icon__social icon__social--facebook">

                                  <span>Facebook</span>

                                  <svg width="100%" height="100%" viewBox="0 0 100 100">

                                      <use xlink:href="#svg-symbol__facebook"></use>

                                  </svg>

                              </a>

                          </li>



                          <li class="footer__small-nav__item">

                              <a href="https://twitter.com/franquiciarArg" target="_blank" class="icon__social icon__social--twitter">

                                  <span>Twitter</span>

                                  <svg width="100%" height="100%" viewBox="0 0 100 100">

                                      <use xlink:href="#svg-symbol__twitter"></use>

                                  </svg>

                              </a>

                          </li>



                          <li class="footer__small-nav__item">

                              <a href="https://www.instagram.com/franquiciarargentina" target="_blank" class="icon__social icon__social--instagram">

                                  <span>Instagram</span>

                                  <svg width="100%" height="100%" viewBox="0 0 100 100">

                                      <use xlink:href="#svg-symbol__instagram"></use>

                                  </svg>

                              </a>

                          </li>
                          hola
                        @if(Session::has('message'))
                            <div class="alert {{ Session::get('alert-class', 'alert-info') }} " role="alert">
                                <strong>{{ Session::get('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                          <li class="footer__small-nav__item">

                              <a href="https://www.youtube.com/channel/UCyPAnRu-RzGB6b03hEJk_Aw" target="_blank" class="icon__social icon__social--youtube">

                                  <span>YouTube</span>

                                  <svg width="100%" height="100%" viewBox="0 0 100 100">

                                      <use xlink:href="#svg-symbol__youtube"></use>

                                  </svg>

                              </a>

                          </li>

                      </ul>


                    </div>



                    <div class="footer__wrapper footer__wrapper__right">

                        <form class="footer__newsletter || newsletter__form" method="post" action="{{ Config::get('app.url') }}addNewsletter">

                            {{ Form::hidden('_token', csrf_token()) }}



                            <h2 class="footer__newsletter__title">Suscribite a nuestro </br>Newsletter</h2>



                            <div class="footer__newsletter__form" action="">

                               <i class="spinner">

                                    <div class="spinner__wrapper"></div>

                                </i>

                                <input class="footer__newsletter__input || newsletter__input"  name="email" type="e-mail" placeholder="Ingresá tu email">

                                <button class="footer__newsletter__button || newsletter__btn" type="submit">Enviar</button>

                            </div>

                        </form>


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



        <script src="{{ Config::get('app.url') }}public/script/main.js"></script>

        @yield('scripts')

    </body>

</html>
