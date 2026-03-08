<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="description"
    content="NextSaaS - Modern HTML template collection with 35+ home page variations for SaaS businesses, startups, and web applications. Features responsive design, authentication pages, pricing, blog, and more with Tailwind CSS and Vite." />
  <meta name="keywords" content="HTML,Tailwind CSS, JavaScript" />
  <meta name="author" content="NextSaaS" />
  <link rel="icon" type="image/png" href="./favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="./favicon.svg" />
  <link rel="shortcut icon" href="./favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png" />
  <link rel="manifest" href="./site.webmanifest" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />

  <title>Rememus - Home</title>

  <link rel="stylesheet" href="./assets/main.css">
</head>
<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</body>
</html>