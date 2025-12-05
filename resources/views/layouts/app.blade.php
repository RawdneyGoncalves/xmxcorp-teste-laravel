<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Blog</a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm transition">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 5h4"/></svg>
                        Home
                    </a>
                    <a href="{{ route('post.create') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm transition">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Publicar
                    </a>
                    <a href="{{ route('status.check') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center gap-2 transition bg-blue-50 px-3 py-1 rounded-lg">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        Status
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-full flex items-center gap-1.5 border border-green-200">
                    <span class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></span>
                    API Online
                </span>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto px-4 py-4 animate-fade-in-up">
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    <div>
                        <p class="font-bold">Erros encontrados:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 py-4 animate-fade-in-up">
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 py-4 animate-fade-in-up">
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gradient-to-b from-gray-900 to-black text-white mt-20 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h3 class="font-bold mb-4 text-lg bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Blog DDD</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Plataforma moderna de blog construída com Domain-Driven Design e Laravel, alimentada por DummyJSON API.</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4 text-white">Navegação</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition duration-200">Home</a></li>
                        <li><a href="{{ route('post.create') }}" class="hover:text-white transition duration-200">Publicar</a></li>
                        <li><a href="{{ route('status.check') }}" class="hover:text-white transition duration-200">status</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4 text-white">Tecnologia</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li> Laravel 12</li>
                        <li> Domain-Driven Design</li>
                        <li> Tailwind CSS</li>
                        <li> DummyJSON API</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4 text-white">Recursos</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="https://dummyjson.com" target="_blank" rel="noopener" class="hover:text-white transition duration-200">DummyJSON API ↗</a></li>
                        <li><a href="https://laravel.com" target="_blank" rel="noopener" class="hover:text-white transition duration-200">Laravel Docs ↗</a></li>
                        <li><a href="https://tailwindcss.com" target="_blank" rel="noopener" class="hover:text-white transition duration-200">Tailwind CSS ↗</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center md:text-left">
                    <div>
                        <p class="text-gray-500 text-xs">Desenvolvido com ❤️ por</p>
                        <p class="text-white font-semibold text-sm">Rawdney</p>
                    </div>
                    <div class="text-center">
                        <p class="text-gray-500 text-xs">Arquitetura profissional em 4 camadas</p>
                        <p class="text-gray-400 text-xs mt-1">© {{ date('Y') }} - Todos os direitos reservados</p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-gray-500 text-xs">Padrão arquitetural</p>
                        <p class="text-white font-semibold text-sm">DDD + Laravel</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
