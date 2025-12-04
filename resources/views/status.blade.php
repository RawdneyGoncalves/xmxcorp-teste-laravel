@extends('layouts.app')

@section('title', 'Status - Blog')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <div class="mb-12">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold mb-6 inline-block">
                ← Voltar para Home
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Status do Blog</h1>
            <p class="text-gray-600">Verificar se tudo está funcionando</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- API Status -->
            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 {{ isset($api['status']) && $api['status'] === 'online' ? 'text-green-600' : 'text-red-600' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <h2 class="text-xl font-bold text-gray-900">DummyJSON API</h2>
                </div>

                @if(isset($api['status']) && $api['status'] === 'online')
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                            <span class="text-green-700 font-semibold">Online</span>
                        </div>
                        <p class="text-sm text-gray-600">
                            <strong>Usuários:</strong> {{ $api['users_api'] ? '✓' : '✗' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Posts:</strong> {{ $api['posts_api'] ? '✓' : '✗' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Comentários:</strong> {{ $api['comments_api'] ? '✓' : '✗' }}
                        </p>
                    </div>
                @else
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-red-700 font-semibold">Offline</span>
                    </div>
                    <p class="text-sm text-red-600">{{ $api['message'] ?? 'Erro desconhecido' }}</p>
                @endif
            </div>

            <!-- Database Status -->
            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 12a9 9 0 0118 0v-2.05A4.5 4.5 0 0013.5 2c-1.269 0-2.47.578-3.25 1.5S8.269 5.231 7 5.231 4.77 4.578 4 3.5A4.5 4.5 0 002 9.95V10a9 9 0 001 4z"/>
                    </svg>
                    <h2 class="text-xl font-bold text-gray-900">Banco de Dados</h2>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">👤 Usuários</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $database['users'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">📝 Posts</span>
                        <span class="text-2xl font-bold text-green-600">{{ $database['posts'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-700 font-medium">💬 Comentários</span>
                        <span class="text-2xl font-bold text-purple-600">{{ $database['comments'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Samples -->
        <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Últimos Dados Cadastrados</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if($samples['user'])
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-bold text-gray-900 mb-2">👤 Usuário</h3>
                        <p class="text-sm text-gray-700 mb-1">
                            <strong>Nome:</strong> {{ $samples['user']['first_name'] }} {{ $samples['user']['last_name'] }}
                        </p>
                        <p class="text-sm text-gray-700 break-all">
                            <strong>Email:</strong> {{ $samples['user']['email'] }}
                        </p>
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-center text-gray-500">
                        Sem usuários cadastrados
                    </div>
                @endif

                @if($samples['post'])
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-bold text-gray-900 mb-2">📝 Post</h3>
                        <p class="text-sm text-gray-700 mb-1 line-clamp-2">
                            <strong>Título:</strong> {{ $samples['post']['title'] }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Curtidas:</strong> {{ $samples['post']['likes'] }} | <strong>Views:</strong> {{ $samples['post']['views'] }}
                        </p>
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-center text-gray-500">
                        Sem posts cadastrados
                    </div>
                @endif

                @if($samples['comment'])
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-bold text-gray-900 mb-2">💬 Comentário</h3>
                        <p class="text-sm text-gray-700 mb-1 line-clamp-2">
                            {{ $samples['comment']['body'] }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Curtidas:</strong> {{ $samples['comment']['likes'] }}
                        </p>
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-center text-gray-500">
                        Sem comentários cadastrados
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 mt-8">
            <a href="{{ route('status.check') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                🔄 Atualizar
            </a>
            <a href="{{ route('home') }}" class="inline-block bg-gray-100 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">
                Voltar ao Blog
            </a>
        </div>
    </div>
</div>
@endsection
