<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lib</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark">
    <nav>
        <div class="flex justify-between items-center p-4 bg-secondary dark:bg-secondary-dark">
            <div class="text-xl font-bold text-primary dark:text-primary-dark">My App</div>
            <div class="space-x-4 text-xl font-bold text-primary dark:text-primary-dark">
                <a href="{{ route('register') }}" class=" hover:text-primary-dark">Register</a>
                <a href="{{ route('login') }}" class=" hover:text-primary-dark">Login</a>

            </div>
        </div>
    </nav>
    <hr class="bg-primary-dark">
    <main >
        <div class="flex justify-between items-center h-screen text-3xl font-bold text-center text-primary dark:text-primary-dark">

                Welcome to the Library app

        </div>


    </main>
</body>
</html>
