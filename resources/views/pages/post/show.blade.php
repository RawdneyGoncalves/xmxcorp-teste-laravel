@extends('layouts.app')

@section('title', $post['title'] ?? 'Artigo')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('user.profile', $post['user']['external_id'] ?? '#') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">{{ $post['user']['first_name'] ?? 'Autor' }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900 font-semibold line-clamp-1">{{ $post['title'] ?? 'Artigo' }}</span>
        </div>

        @if(isset($post) && !empty($post))
            <article class="animate-fade-in-up">
                <!-- Article Header -->
                <header class="mb-12 pb-12 border-b-2 border-gray-200">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-8 leading-tight">
                        {{ $post['title'] }}
                    </h1>

                    <!-- Author Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200 mb-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                            <!-- Author Info -->
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                    {{ substr($post['user']['first_name'], 0, 1) }}{{ substr($post['user']['last_name'] ?? '', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 mb-1">Escrito por</p>
                                    <p class="text-lg font-bold text-gray-900 mb-1">
                                        <a href="{{ route('user.profile', $post['user']['external_id']) }}" class="text-blue-600 hover:text-blue-700 transition">
                                            {{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}
                                        </a>
                                    </p>
                                    <p class="text-sm text-gray-600">{{ $post['created_at'] ?? 'Data desconhecida' }}</p>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="flex gap-6 md:justify-end">
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-blue-600">{{ number_format($post['views'] ?? 0) }}</p>
                                    <p class="text-xs text-gray-600 mt-1">Visualizações</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-green-600">{{ $post['likes'] ?? 0 }}</p>
                                    <p class="text-xs text-gray-600 mt-1">Útil</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-purple-600">{{ count($post['comments'] ?? []) }}</p>
                                    <p class="text-xs text-gray-600 mt-1">Comentários</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if(isset($post['tags']) && is_array($post['tags']) && count($post['tags']) > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($post['tags'] as $tag)
                                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold border border-blue-200 hover:bg-blue-100 transition duration-200 cursor-pointer">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 2a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.418 1.738 1.595 2.881 2.928 3.12.321.053.645.053.966 0 1.333-.239 2.51-1.382 2.928-3.12l-1.548-.773a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0113.847 2H16a1 1 0 011 1v2h2a1 1 0 011 1v2.057a1 1 0 01-.87.995l-1.129.114A7 7 0 015 9c-.639 0-1.263.068-1.871.196l-1.129-.114A1 1 0 012 8.057V4a1 1 0 011-1h2V2z"/></svg>
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </header>

                <!-- Article Body -->
                <div class="prose prose-lg max-w-none mb-12 text-gray-700 leading-relaxed">
                    {!! nl2br(e($post['body'])) !!}
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-4 py-8 border-t border-b border-gray-200">
                    <button class="like-btn-detail flex items-center gap-3 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg" data-id="{{ $post['external_id'] }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                        <span class="like-count font-bold">{{ $post['likes'] ?? 0 }}</span>
                        <span>Útil</span>
                    </button>

                    <button class="dislike-btn-detail flex items-center gap-3 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200 shadow-md hover:shadow-lg" data-id="{{ $post['external_id'] }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"/></svg>
                        <span class="dislike-count font-bold">{{ $post['dislikes'] ?? 0 }}</span>
                        <span>Não Útil</span>
                    </button>
                </div>

                <!-- Comments Section -->
                <section class="mt-16 pt-12">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            💬 Discussão na Comunidade
                        </h2>
                        <p class="text-gray-600 text-lg">
                            <span class="font-bold text-blue-600">{{ count($post['comments'] ?? []) }}</span>
                            {{ count($post['comments'] ?? []) == 1 ? 'comentário' : 'comentários' }} de membros ativos
                        </p>
                    </div>

                    @if(isset($post['comments']) && is_array($post['comments']) && count($post['comments']) > 0)
                        <div class="space-y-4">
                            @foreach($post['comments'] as $index => $comment)
                                <div class="bg-white border-l-4 border-blue-500 rounded-r-lg shadow-sm hover:shadow-md transition duration-200 overflow-hidden group">
                                    <div class="p-6">
                                        <!-- Comment Header -->
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center gap-4 flex-1">
                                                <!-- Avatar -->
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-md">
                                                    {{ substr($comment['user']['first_name'], 0, 1) }}{{ substr($comment['user']['last_name'] ?? '', 0, 1) }}
                                                </div>
                                                <!-- Author Info -->
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="font-bold text-gray-900 mb-1">
                                                        <a href="{{ route('user.profile', $comment['user']['external_id']) }}" class="text-blue-600 hover:text-blue-700 transition hover:underline">
                                                            {{ $comment['user']['first_name'] }} {{ $comment['user']['last_name'] }}
                                                        </a>
                                                    </h3>
                                                    <div class="flex items-center gap-2 flex-wrap">
                                                        <time class="text-xs text-gray-500">{{ $comment['created_at'] ?? 'Data desconhecida' }}</time>
                                                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full font-semibold">
                                                            Comentário #{{ $index + 1 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Body -->
                                        <p class="text-gray-700 mb-4 leading-relaxed text-base bg-gray-50 p-4 rounded-lg border border-gray-100">
                                            {{ $comment['body'] }}
                                        </p>

                                        <!-- Comment Footer -->
                                        <div class="flex items-center justify-between text-sm text-gray-600 pt-4 border-t border-gray-100">
                                            <div class="flex items-center gap-6">
                                                <button class="flex items-center gap-2 hover:text-blue-600 transition cursor-pointer group/like font-medium">
                                                    <svg class="w-5 h-5 group-hover/like:scale-110 transition" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                                                    <span class="font-bold">{{ $comment['likes'] ?? 0 }}</span>
                                                    <span>útil</span>
                                                </button>
                                                <button class="flex items-center gap-2 hover:text-green-600 transition cursor-pointer group/reply font-medium">
                                                    <svg class="w-5 h-5 group-hover/reply:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h4m4 0h4M9 20h6"/></svg>
                                                    <span>Responder</span>
                                                </button>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                ID: #{{ $comment['id'] ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300 p-16 text-center">
                            <svg class="w-20 h-20 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <p class="text-gray-700 text-lg font-bold mb-2">Nenhum comentário ainda</p>
                            <p class="text-gray-600 text-base">Seja o primeiro a comentar neste artigo e iniciar a discussão!</p>
                        </div>
                    @endif
                </section>

                <!-- Related & CTA -->
                <div class="mt-20 pt-12 border-t-2 border-gray-200">
                    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-2xl p-12 text-center border border-blue-500 relative overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <defs>
                                    <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                        <circle cx="10" cy="10" r="2" fill="white"/>
                                    </pattern>
                                </defs>
                                <rect width="100" height="100" fill="url(#dots)"/>
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-3xl font-bold text-white mb-3">Gostou deste artigo?</h3>
                            <p class="text-blue-100 mb-8 text-lg max-w-2xl mx-auto">
                                Explore mais publicações de {{ $post['user']['first_name'] }} e descubra conteúdo similar da comunidade
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('user.profile', $post['user']['external_id']) }}"
                                    class="inline-flex items-center justify-center gap-2 bg-white text-indigo-600 px-8 py-4 rounded-lg hover:bg-gray-50 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                                    👤 Ver Perfil do Autor
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center justify-center gap-2 bg-blue-500 text-white px-8 py-4 rounded-lg hover:bg-blue-400 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                                    🏠 Voltar ao Blog
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Article Metadata -->
                    <div class="mt-12 pt-8 grid grid-cols-2 md:grid-cols-4 gap-4 bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Categoria</p>
                            <p class="font-bold text-gray-900">Artigo</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Tempo de Leitura</p>
                            <p class="font-bold text-gray-900">{{ max(1, round(strlen($post['body'] ?? '') / 200)) }} min</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Útil para</p>
                            <p class="font-bold text-gray-900">{{ $post['likes'] + $post['dislikes'] }} pessoas</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Engajamento</p>
                            <p class="font-bold text-gray-900">{{ count($post['comments'] ?? []) }} comentários</p>
                        </div>
                    </div>
                </div>
            </article>
        @else
            <!-- Not Found -->
            <div class="bg-white rounded-xl shadow-lg p-16 text-center border border-gray-200 mt-8">
                <svg class="w-20 h-20 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-600 text-xl mb-8 font-medium">Artigo não encontrado</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar ao Blog
                </a>
            </div>
        @endif
    </div>
</div>

<script>
const likeDetailBtn = document.querySelector('.like-btn-detail');
if(likeDetailBtn) {
    likeDetailBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const countSpan = this.querySelector('.like-count');
        const currentCount = parseInt(countSpan.textContent);

        fetch(`/post/${id}/like`, { method: 'POST' })
            .then(r => {
                if(r.ok) {
                    countSpan.textContent = currentCount + 1;
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => this.style.transform = 'scale(1)', 200);
                }
            })
            .catch(e => console.error(e));
    });
}

const dislikeDetailBtn = document.querySelector('.dislike-btn-detail');
if(dislikeDetailBtn) {
    dislikeDetailBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const countSpan = this.querySelector('.dislike-count');
        const currentCount = parseInt(countSpan.textContent);

        fetch(`/post/${id}/dislike`, { method: 'POST' })
            .then(r => {
                if(r.ok) {
                    countSpan.textContent = currentCount + 1;
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => this.style.transform = 'scale(1)', 200);
                }
            })
            .catch(e => console.error(e));
    });
}
</script>

@push('scripts')
<style>
    .prose {
        font-size: 1.125rem;
    }
</style>
@endpush
@endsection
