<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">Blog</a>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">@yield('subtitle', 'Bem-vindo')</span>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <p class="font-bold">Erros encontrados:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="font-bold mb-4">Blog</h3>
                    <p class="text-gray-400 text-sm">Plataforma moderna de blog construida com DDD e Laravel.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Links</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Tecnologia</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Laravel</li>
                        <li>DDD</li>
                        <li>Tailwind CSS</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400 text-sm">
                <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
