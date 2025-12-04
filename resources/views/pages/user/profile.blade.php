@extends('layouts.app')

@section('title', $user['first_name'] ?? 'Perfil')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        @if(isset($user) && !empty($user))
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden -mt-8 relative z-10 mb-12">
                <div class="h-40 bg-gradient-to-r from-blue-600 via-blue-600 to-indigo-600"></div>

                <div class="px-8 pb-12">
                    <div class="flex flex-col md:flex-row gap-8 items-start md:items-end -mt-20 mb-8">
                        <div class="flex-shrink-0">
                            @if(isset($user['image']) && !empty($user['image']))
                                <img src="{{ $user['image'] }}" alt="{{ $user['first_name'] }}"
                                    class="w-48 h-48 rounded-2xl object-cover border-4 border-white shadow-xl">
                            @else
                                <div class="w-48 h-48 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-7xl font-bold text-white border-4 border-white shadow-xl">
                                    {{ substr($user['first_name'], 0, 1) }}{{ substr($user['last_name'] ?? '', 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 pb-4">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                                {{ $user['first_name'] }} {{ $user['last_name'] ?? '' }}
                            </h1>
                            <p class="text-gray-600 text-lg mb-8">Membro ativo da comunidade</p>

                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('user.posts', $user['external_id']) }}"
                                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-md">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10.5A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10.5A7.968 7.968 0 0014.5 4c-1.669 0-3.218.51-4.5 1.385A7.968 7.968 0 009 4.804z"/></svg>
                                    Ver Publicações
                                </a>
                                <a href="mailto:{{ $user['email'] }}"
                                    class="inline-flex items-center gap-2 bg-gray-100 text-gray-800 px-8 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.5 3A1.5 1.5 0 001 4.5v.006c0 .564.224 1.077.586 1.457A2.968 2.968 0 005.537 9h.074a2.968 2.968 0 003.95-2.037A2.968 2.968 0 0013.463 9h.074a2.968 2.968 0 003.951-2.037A1.5 1.5 0 0020 4.506 1.5 1.5 0 0018.5 3H2.5zM.5 9.5h19v8a1.5 1.5 0 01-1.5 1.5H2A1.5 1.5 0 01.5 17.5v-8z"/></svg>
                                    Contato
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                                <div class="flex items-center gap-3 mb-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2.5 3A1.5 1.5 0 001 4.5v.006c0 .564.224 1.077.586 1.457A2.968 2.968 0 005.537 9h.074a2.968 2.968 0 003.95-2.037A2.968 2.968 0 0013.463 9h.074a2.968 2.968 0 003.951-2.037A1.5 1.5 0 0020 4.506 1.5 1.5 0 0018.5 3H2.5zM.5 9.5h19v8a1.5 1.5 0 01-1.5 1.5H2A1.5 1.5 0 01.5 17.5v-8z"/></svg>
                                    <h3 class="text-sm font-semibold text-gray-900">E-mail</h3>
                                </div>
                                <a href="mailto:{{ $user['email'] }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm break-all">
                                    {{ $user['email'] }}
                                </a>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                                <div class="flex items-center gap-3 mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.418 1.738 1.595 2.881 2.928 3.12.321.053.645.053.966 0 1.333-.239 2.51-1.382 2.928-3.12l-1.548-.773a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0113.847 3H16a1 1 0 011 1v2h2a1 1 0 011 1v2.057a1 1 0 01-.87.995l-1.129.114A7 7 0 005 9c-.639 0-1.263.068-1.871.196l-1.129-.114A1 1 0 012 8.057V6a1 1 0 011-1h2V3z"/></svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Telefone</h3>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">{{ $user['phone'] ?? 'Não informado' }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-100">
                                <div class="flex items-center gap-3 mb-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Nascimento</h3>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">{{ $user['birth_date'] ?? 'Não informado' }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-orange-50 to-red-50 p-6 rounded-xl border border-orange-100">
                                <div class="flex items-center gap-3 mb-3">
                                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    <h3 class="text-sm font-semibold text-gray-900">Publicações</h3>
                                </div>
                                <p class="text-3xl font-bold text-orange-600">{{ $user['posts_count'] ?? 0 }}</p>
                            </div>
                        </div>

                        @if(isset($user['address']) && !empty($user['address']))
                            <div class="border-t border-gray-200 pt-8">
                                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    Localização
                                </h2>
                                <div class="bg-gray-50 p-6 rounded-xl">
                                    @if(isset($user['address']['address']))
                                        <p class="text-gray-700 mb-4">
                                            <span class="font-semibold text-gray-900">Endereço:</span> {{ $user['address']['address'] }}
                                        </p>
                                    @endif
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @if(isset($user['address']['city']))
                                            <div>
                                                <span class="font-semibold text-gray-900 text-sm">Cidade</span>
                                                <p class="text-gray-700">{{ $user['address']['city'] }}, {{ $user['address']['state'] ?? 'N/A' }}</p>
                                            </div>
                                        @endif
                                        @if(isset($user['address']['postalCode']))
                                            <div>
                                                <span class="font-semibold text-gray-900 text-sm">CEP / País</span>
                                                <p class="text-gray-700">{{ $user['address']['postalCode'] }} - {{ $user['address']['country'] ?? 'N/A' }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Explore as Publicações</h2>
                <p class="text-gray-600 mb-8">Confira todos os artigos publicados por {{ $user['first_name'] }}</p>
                <a href="{{ route('user.posts', $user['external_id']) }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-10 py-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold text-lg shadow-lg">
                    Ver Publicações
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        @else
            <div class="text-center py-32">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-600 text-lg mb-8">Usuário não encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Voltar ao Blog
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
