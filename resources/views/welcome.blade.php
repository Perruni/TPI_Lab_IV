<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventosYa!</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionales si necesitas personalizar más */
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="bg-black text-white">

    <!-- Navbar -->
    <header class="bg-yellow-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">EVENTOS YA!</h1>
            <nav class="space-x-6 text-white">
                <a href="{{ route('mostrareventos') }}" class="hover:text-gray-400">Eventos</a>
                <a href="{{ route('cargar') }}" class="hover:text-gray-400">Crear eventos</a>

            </nav>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-500 text-black rounded-md hover:bg-yellow-600">Inicia sesion</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-yellow-500 text-black rounded-md hover:bg-yellow-600">Registrate</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('https://example.com/event-banner.jpg');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
            <h2 class="text-5xl font-extrabold text-white">HAZ DE CADA EVENTO UN EXITO, SIN COMPLICACIONES</h2>
            <p class="mt-4 text-lg text-gray-300">Nosotros nos encargamos</p>
            <a href="/fullcalendar" class="mt-6 inline-block bg-yellow-500 text-black font-semibold py-3 px-6 rounded-md hover:bg-yellow-600">Ir a eventos</a>

        </div>
    </section>

    <!-- Countdown or Information Section -->
    <section class="bg-black text-center py-10">
        <h3 class="text-3xl font-bold text-yellow-500">GESTIONA TUS EVENTOS</h3>
        <!-- Aquí puedes agregar un contador o alguna otra información relevante -->
    </section>

    <!-- Footer -->
    <footer class="bg-yellow-600 text-black py-4 text-center">
        <p>&copy; EVENTOSYA! 2024.</p>
    </footer>

</body>
</html>
