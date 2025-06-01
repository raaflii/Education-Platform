<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Education Platform</title>
</head>

<body class="bg-white dark:bg-gray-900 min-h-screen transition-colors duration-300">

    <x-header></x-header>

    <x-hero-section></x-hero-section>

    <x-stat></x-stat>

    <x-featured-course></x-featured-course>

    <x-quality-section></x-quality-section>

    <x-testimonial-section></x-testimonial-section>

    <x-pricing></x-pricing>

    <x-cta-section></x-cta-section>

    <x-footer></x-footer>
</body>

</html>
