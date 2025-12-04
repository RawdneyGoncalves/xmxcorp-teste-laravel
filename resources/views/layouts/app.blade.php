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
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">Blog</a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm">Home</a>
                    <a href="{{ route('post.create') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm">Publicar</a>
                    <a href="{{ route('status.check') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        Status
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">API Online</span>
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
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-bold mb-4 text-lg">Blog</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Plataforma moderna de blog construída com DDD e Laravel, alimentada por dados da DummyJSON API.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Navegação</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('post.create') }}" class="hover:text-white transition">Publicar</a></li>
                        <li><a href="{{ route('status.check') }}" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Tecnologia</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Laravel 10+</li>
                        <li>Domain-Driven Design</li>
                        <li>Tailwind CSS</li>
                        <li>DummyJSON API</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">API</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="https://dummyjson.com" target="_blank" class="hover:text-white transition">DummyJSON</a></li>
                        <li><a href="{{ route('status.check') }}" class="hover:text-white transition">Ver Status</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center md:text-left">
                    <div>
                        <p class="text-gray-400 text-xs">Desenvolvido por</p>
                        <p class="text-white font-semibold">Rawdney</p>
                    </div>
                    <div class="text-center">
                        <p class="text-gray-400 text-xs">Blog powered by DummyJSON API</p>
                        <p class="text-gray-500 text-xs mt-1">© {{ date('Y') }} - Todos os direitos reservados</p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-gray-400 text-xs">Arquitetura</p>
                        <p class="text-white font-semibold">DDD + Laravel</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
