<head>
    <title>@yield('title')</title>

    {{-- <!-- <link rel="stylesheet" href="{{ asset('dash_mag/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash_mag/css/bootstrap.min.css') }}"> --> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
    <link href="https://rawgit.com/marvelapp/devices.css/master/assets/devices.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vibes&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Dancing+Script&family=Jaini&family=Noto+Sans+Tai+Le&family=Playwrite+HU:wght@100..400&family=Reem+Kufi:wght@400..700&family=Rock+Salt&family=Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash_mag/style.css') }}">

    @yield('css')
    @vite(['resources/js/app.js'])

</head>

<body>
    <!-- ==================NavBar============================================= -->
