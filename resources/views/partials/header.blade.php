<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{--  favicon  --}}
    <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}" />
    {{--  theme meta  --}}
    <meta name="theme-name" content="Pinwheel" />
    <meta name="msapplication-TileColor" content="#000000" />
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#fff" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#000" />
    <meta name="generator" content="gulp" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    {{--  responsive meta  --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />

    {{--  title  --}}
    <title>Talent sync - @yield('title')</title>

    {{--  noindex robots  --}}
    <meta name="robots" content="" />

    {{--  meta-description  --}}
    <meta name="description" content="meta description" />

    {{--  og-title --}}
    <meta property="og:title" content="" />

    {{--  og-description --}}
    <meta property="og:description" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="/" />

    {{--  twitter-title --}}
    <meta name="twitter:title" content="" />

    {{--  twitter-description --}}
    <meta name="twitter:description" content="" />

    {{--  og-image --}}
    <meta property="og:image" content="" />

    {{--  google font css --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&display=swap" rel="stylesheet" />

    {{--  styles --}}

    {{--  Swiper slider --}}
    <link rel="stylesheet" href="{{ asset('theme/plugins/swiper/swiper-bundle.css') }}" />

    {{--  Fontawesome --}}
    <link rel="stylesheet" href="{{ asset('theme/plugins/font-awesome/v6/brands.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/plugins/font-awesome/v6/solid.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/plugins/font-awesome/v6/fontawesome.css') }}" />

    {{--  Main Stylesheet --}}
    <link href="{{ asset('theme/styles/main.css') }}" rel="stylesheet" />
</head>
@include('partials.navbar')
