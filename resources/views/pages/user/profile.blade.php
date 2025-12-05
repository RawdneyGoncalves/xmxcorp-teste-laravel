@extends('layouts.app')

@section('title', $user['first_name'] ?? 'Perfil')

@section('content')
<div class="bg-gradient-to-b from-blue-50 via-indigo-50 to-white min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900 font-semibold">Perfil do Usuário</span>
        </div>

        @if(isset($user) && !empty($user))
            <div class="animate-fade-in-up">
                <!-- Main Profile Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-12 border border-gray-200 mx-4 md:mx-0">
                    <!-- Profile Content -->
                    <div class="px-6 md:px-8 py-8">
                        <div class="flex flex-col md:flex-row gap-8 items-start md:items-center mb-8">
                            <!-- Avatar Container -->
                            <div class="flex-shrink-0">
                                @if(isset($user['image']) && !empty($user['image']))
                                    <img src="{{ $user['image'] }}" alt="{{ $user['first_name'] }}"
                                        class="w-40 h-40 rounded-2xl object-cover border-4 border-blue-100 shadow-lg hover:shadow-xl transition duration-300">
                                @else
                                    <div class="w-40 h-40 rounded-2xl bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 flex items-center justify-center text-5xl font-bold text-white border-4 border-blue-100 shadow-lg">
                                        {{ substr($user['first_name'], 0, 1) }}{{ substr($user['last_name'] ?? '', 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 w-full">
                                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                                    {{ $user['first_name'] }} {{ $user['last_name'] ?? '' }}
                                </h1>
                                <p class="text-gray-600 text-base font-semibold mb-6">Membro Ativo da Comunidade</p>

                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('user.posts', $user['external_id']) }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-bold shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10.5A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10.5A7.968 7.968 0 0114.5 4c-1.669 0-3.218.51-4.5 1.385A7.968 7.968 0 009 4.804z"/></svg>
                                        Ver {{ $user['posts_count'] ?? 0 }} Publicações
                                    </a>
                                    <a href="mailto:{{ $user['email'] }}"
                                        class="inline-flex items-center gap-2 bg-white text-gray-800 border-2 border-gray-300 px-6 py-3 rounded-lg hover:border-gray-400 transition duration-200 font-semibold">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 8a1 1 0 011-1h12a1 1 0 011 1v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/><path d="M1 6a2 2 0 012-2h14a2 2 0 012 2v2a1 1 0 11-2 0V6H3v2a1 1 0 11-2 0V6z"/></svg>
                                        Contato
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t-2 border-gray-200 my-8"></div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Email Card -->
                            <div class="bg-blue-50 p-5 rounded-xl border-2 border-blue-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-blue-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 8a1 1 0 011-1h12a1 1 0 011 1v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/><path d="M1 6a2 2 0 012-2h14a2 2 0 012 2v2a1 1 0 11-2 0V6H3v2a1 1 0 11-2 0V6z"/></svg>
                                    </div>
                                    <h3 class="text-xs font-bold text-gray-900">E-mail</h3>
                                </div>
                                <a href="mailto:{{ $user['email'] }}" class="text-blue-600 hover:text-blue-700 font-semibold text-xs break-all transition hover:underline">
                                    {{ $user['email'] }}
                                </a>
                            </div>

                            <!-- Phone Card -->
                            <div class="bg-green-50 p-5 rounded-xl border-2 border-green-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-green-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.418 1.738 1.595 2.881 2.928 3.12.321.053.645.053.966 0 1.333-.239 2.51-1.382 2.928-3.12l-1.548-.773a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0113.847 3H16a1 1 0 011 1v2h2a1 1 0 011 1v2.057a1 1 0 01-.87.995l-1.129.114A7 7 0 015 9c-.639 0-1.263.068-1.871.196l-1.129-.114A1 1 0 012 8.057V6a1 1 0 011-1h2V3z"/></svg>
                                    </div>
                                    <h3 class="text-xs font-bold text-gray-900">Telefone</h3>
                                </div>
                                <p class="text-gray-800 font-semibold text-xs">{{ $user['phone'] ?? '—' }}</p>
                            </div>

                            <!-- Birth Date Card -->
                            <div class="bg-pink-50 p-5 rounded-xl border-2 border-pink-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-purple-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg>
                                    </div>
                                    <h3 class="text-xs font-bold text-gray-900">Nascimento</h3>
                                </div>
                                <p class="text-gray-800 font-semibold text-xs">{{ $user['birth_date'] ?? '—' }}</p>
                            </div>

                            <!-- Posts Count Card -->
                            <div class="bg-orange-50 p-5 rounded-xl border-2 border-orange-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-orange-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    </div>
                                    <h3 class="text-xs font-bold text-gray-900">Publicações</h3>
                                </div>
                                <p class="text-2xl font-bold text-orange-600">{{ $user['posts_count'] ?? 0 }}</p>
                            </div>
                        </div>

                        <!-- Address Section -->
                        @if(isset($user['address']) && !empty($user['address']))
                            <div class="border-t-2 border-gray-200 pt-8 mt-8">
                                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    Localização
                                </h2>
                                <div class="bg-gray-50 p-6 rounded-xl border-2 border-gray-200">
                                    @if(isset($user['address']['address']))
                                        <p class="text-gray-700 mb-4 leading-relaxed text-sm font-medium">
                                            {{ $user['address']['address'] }}
                                        </p>
                                    @endif
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        @if(isset($user['address']['city']))
                                            <div class="bg-white p-3 rounded-lg border-2 border-gray-300">
                                                <span class="font-bold text-gray-900 text-xs block mb-1">Cidade / Estado</span>
                                                <p class="text-gray-700 font-semibold text-sm">{{ $user['address']['city'] }}, {{ $user['address']['state'] ?? 'N/A' }}</p>
                                            </div>
                                        @endif
                                        @if(isset($user['address']['postalCode']))
                                            <div class="bg-white p-3 rounded-lg border-2 border-gray-300">
                                                <span class="font-bold text-gray-900 text-xs block mb-1">CEP</span>
                                                <p class="text-gray-700 font-semibold text-sm">{{ $user['address']['postalCode'] }}</p>
                                            </div>
                                        @endif
                                        @if(isset($user['address']['country']))
                                            <div class="bg-white p-3 rounded-lg border-2 border-gray-300">
                                                <span class="font-bold text-gray-900 text-xs block mb-1">País</span>
                                                <p class="text-gray-700 font-semibold text-sm">{{ $user['address']['country'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Not Found -->
            <div class="bg-white rounded-3xl shadow-2xl p-20 text-center border-2 border-gray-200 mt-8">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-700 text-2xl mb-4 font-bold">Usuário não encontrado</p>
                <p class="text-gray-600 text-lg mb-10">Desculpe, o usuário que você procura não existe ou foi removido.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-10 py-4 rounded-xl hover:bg-blue-700 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar ao Blog
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
