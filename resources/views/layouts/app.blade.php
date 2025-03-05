<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
    <header class="w-full bg-indigo-950 text-white font-semibold flex justify-between px-12 py-6">
        <h1 class="text-3xl">Work 👄</h1>
        <div class="flex justify-around w-1/5">
            <p><a href="{{ route('trabajadores.index') }}">Lista</a></p>
            <p><a href="{{ route('trabajadores.create') }}">Nuevo</a></p>
        </div>
    </header>
    
    <section class="py-5">
        @yield('content')
    </section>
</body>
</html>