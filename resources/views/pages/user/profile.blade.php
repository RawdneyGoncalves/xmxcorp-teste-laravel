<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name ?? 'Usuario' }} - Perfil - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                Voltar aos Posts
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        @if($user)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="h-32 bg-gradient-to-r from-blue-600 to-blue-700"></div>

                <div class="px-8 pb-8">
                    <div class="flex flex-col md:flex-row gap-8 items-start md:items-end -mt-16 mb-8">
                        <div class="flex-shrink-0">
                            @if($user->image)
                                <img src="{{ $user->image }}" alt="{{ $user->first_name }}" class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
                            @else
                                <div class="w-40 h-40 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-6xl font-bold text-white border-4 border-white shadow-lg">
                                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 pb-4">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h1>
                            <p class="text-gray-600 text-lg mb-6">
                                Membro ativo da comunidade de blog
                            </p>

                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('user.posts', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                                    Ver Publicacoes
                                </a>
                                <a href="mailto:{{ $user->email }}" class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition duration-200">
                                    Enviar Email
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.5 3A1.5 1.5 0 001 4.5v.006c0 .564.224 1.077.586 1.457A2.968 2.968 0 005.537 9h.074a2.968 2.968 0 003.95-2.037A2.968 2.968 0 0013.463 9h.074a2.968 2.968 0 003.951-2.037A1.5 1.5 0 0020 4.506 1.5 1.5 0 0018.5 3H2.5zM.5 9.5h19v8a1.5 1.5 0 01-1.5 1.5H2A1.5 1.5 0 01.5 17.5v-8z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Email</h3>
                                </div>
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-700 font-medium break-all">
                                    {{ $user->email }}
                                </a>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.418 1.738 1.595 2.881 2.928 3.12.321.053.645.053.966 0 1.333-.239 2.51-1.382 2.928-3.12l-1.548-.773a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0113.847 3H16a1 1 0 011 1v2h2a1 1 0 011 1v2.057a1 1 0 01-.87.995l-1.129.114A7 7 0 005 9c-.639 0-1.263.068-1.871.196l-1.129-.114A1 1 0 012 8.057V6a1 1 0 011-1h2V3z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Telefone</h3>
                                </div>
                                <p class="text-gray-700 font-medium">
                                    {{ $user->phone ?? 'Nao informado' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Nascimento</h3>
                                </div>
                                <p class="text-gray-700 font-medium">
                                    @if($user->birth_date)
                                        {{ $user->birth_date->format('d \d\e F \d\e Y') }}
                                    @else
                                        Nao informado
                                    @endif
                                </p>
                            </div>

                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Publicacoes</h3>
                                </div>
                                <p class="text-3xl font-bold text-blue-600">
                                    {{ $user->posts_count ?? 0 }}
                                </p>
                            </div>
                        </div>

                        @if($user->address && (isset($user->address['address']) || isset($user->address['city'])))
                            <div class="border-t border-gray-200 pt-8">
                                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Endereco
                                </h2>

                                <div class="bg-gray-50 p-6 rounded-lg">
                                    @if(isset($user->address['address']))
                                        <p class="text-gray-700 mb-2">
                                            <span class="font-semibold text-gray-900">Endereco:</span> {{ $user->address['address'] }}
                                        </p>
                                    @endif

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @if(isset($user->address['city']) || isset($user->address['state']))
                                            <div>
                                                <span class="font-semibold text-gray-900">Cidade</span>
                                                <p class="text-gray-700">
                                                    {{ $user->address['city'] ?? 'N/A' }}, {{ $user->address['state'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @endif

                                        @if(isset($user->address['postalCode']) || isset($user->address['country']))
                                            <div>
                                                <span class="font-semibold text-gray-900">CEP / Pais</span>
                                                <p class="text-gray-700">
                                                    {{ $user->address['postalCode'] ?? 'N/A' }} - {{ $user->address['country'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <p class="text-gray-600 mb-6">
                    Confira todas as publicacoes de {{ $user->first_name }}
                </p>
                <a href="{{ route('user.posts', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 text-lg">
                    Explorar Publicacoes
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 text-lg mb-6">Usuario nao encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Voltar para Home
                </a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-900 text-white mt-16 border-t border-gray-800">
        <div class="max-w-6xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>
</body>
</html>
EOF
cat /mnt/user-data/outputs/profile_profissional.blade.php
Saída

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name ?? 'Usuario' }} - Perfil - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                Voltar aos Posts
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        @if($user)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="h-32 bg-gradient-to-r from-blue-600 to-blue-700"></div>

                <div class="px-8 pb-8">
                    <div class="flex flex-col md:flex-row gap-8 items-start md:items-end -mt-16 mb-8">
                        <div class="flex-shrink-0">
                            @if($user->image)
                                <img src="{{ $user->image }}" alt="{{ $user->first_name }}" class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
                            @else
                                <div class="w-40 h-40 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-6xl font-bold text-white border-4 border-white shadow-lg">
                                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 pb-4">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h1>
                            <p class="text-gray-600 text-lg mb-6">
                                Membro ativo da comunidade de blog
                            </p>

                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('user.posts', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                                    Ver Publicacoes
                                </a>
                                <a href="mailto:{{ $user->email }}" class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition duration-200">
                                    Enviar Email
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.5 3A1.5 1.5 0 001 4.5v.006c0 .564.224 1.077.586 1.457A2.968 2.968 0 005.537 9h.074a2.968 2.968 0 003.95-2.037A2.968 2.968 0 0013.463 9h.074a2.968 2.968 0 003.951-2.037A1.5 1.5 0 0020 4.506 1.5 1.5 0 0018.5 3H2.5zM.5 9.5h19v8a1.5 1.5 0 01-1.5 1.5H2A1.5 1.5 0 01.5 17.5v-8z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Email</h3>
                                </div>
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-700 font-medium break-all">
                                    {{ $user->email }}
                                </a>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.418 1.738 1.595 2.881 2.928 3.12.321.053.645.053.966 0 1.333-.239 2.51-1.382 2.928-3.12l-1.548-.773a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0113.847 3H16a1 1 0 011 1v2h2a1 1 0 011 1v2.057a1 1 0 01-.87.995l-1.129.114A7 7 0 005 9c-.639 0-1.263.068-1.871.196l-1.129-.114A1 1 0 012 8.057V6a1 1 0 011-1h2V3z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Telefone</h3>
                                </div>
                                <p class="text-gray-700 font-medium">
                                    {{ $user->phone ?? 'Nao informado' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Nascimento</h3>
                                </div>
                                <p class="text-gray-700 font-medium">
                                    @if($user->birth_date)
                                        {{ $user->birth_date->format('d \d\e F \d\e Y') }}
                                    @else
                                        Nao informado
                                    @endif
                                </p>
                            </div>

                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                                <div class="flex items-center gap-4 mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Publicacoes</h3>
                                </div>
                                <p class="text-3xl font-bold text-blue-600">
                                    {{ $user->posts_count ?? 0 }}
                                </p>
                            </div>
                        </div>

                        @if($user->address && (isset($user->address['address']) || isset($user->address['city'])))
                            <div class="border-t border-gray-200 pt-8">
                                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Endereco
                                </h2>

                                <div class="bg-gray-50 p-6 rounded-lg">
                                    @if(isset($user->address['address']))
                                        <p class="text-gray-700 mb-2">
                                            <span class="font-semibold text-gray-900">Endereco:</span> {{ $user->address['address'] }}
                                        </p>
                                    @endif

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @if(isset($user->address['city']) || isset($user->address['state']))
                                            <div>
                                                <span class="font-semibold text-gray-900">Cidade</span>
                                                <p class="text-gray-700">
                                                    {{ $user->address['city'] ?? 'N/A' }}, {{ $user->address['state'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @endif

                                        @if(isset($user->address['postalCode']) || isset($user->address['country']))
                                            <div>
                                                <span class="font-semibold text-gray-900">CEP / Pais</span>
                                                <p class="text-gray-700">
                                                    {{ $user->address['postalCode'] ?? 'N/A' }} - {{ $user->address['country'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <p class="text-gray-600 mb-6">
                    Confira todas as publicacoes de {{ $user->first_name }}
                </p>
                <a href="{{ route('user.posts', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 text-lg">
                    Explorar Publicacoes
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 text-lg mb-6">Usuario nao encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Voltar para Home
                </a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-900 text-white mt-16 border-t border-gray-800">
        <div class="max-w-6xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>
</body>
</html>
