@extends('layouts.app')

@section('title', 'Publicações de ' . ($user['first_name'] ?? 'Usuário'))

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-5xl mx-auto px-4 py-16">
        @if(isset($user) && !empty($user))
            <div class="mb-12">
                <a href="{{ route('user.profile', $user['external_id']) }}"
                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar ao Perfil
                </a>

                <div class="bg-white rounded-xl p-8 border border-gray-200 mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Publicações de {{ $user['first_name'] }} {{ $user['last_name'] ?? '' }}
                    </h1>
                    <div class="flex items-center gap-3 text-gray-600 mt-4">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10.5A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10.5A7.968 7.968 0 0014.5 4c-1.669 0-3.218.51-4.5 1.385A7.968 7.968 0 009 4.804z"/></svg>
                        <span class="font-semibold">{{ count($posts ?? []) }}</span>
                        <span>publicações no total</span>
                    </div>
                </div>
            </div>

            @if(isset($posts) && is_array($posts) && count($posts) > 0)
                <div class="space-y-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
                            <div class="p-8">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold mb-3">
                                            <a href="{{ route('post.show', $post['external_id']) }}"
                                                class="text-gray-900 hover:text-blue-600 transition">
                                                {{ $post['title'] }}
                                            </a>
                                        </h2>
                                        <p class="text-sm text-gray-600">
                                            Publicado em {{ $post['created_at'] ?? 'Data desconhecida' }}
                                        </p>
                                    </div>
                                </div>

                                <p class="text-gray-700 mb-6 leading-relaxed">
                                    {{ substr($post['body'], 0, 280) }}...
                                </p>

                                @if(isset($post['tags']) && is_array($post['tags']) && count($post['tags']) > 0)
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach($post['tags'] as $tag)
                                            <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-semibold border border-blue-100">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-6 pt-6 border-t border-gray-100 text-sm">
                                    <button class="like-btn flex items-center gap-2 text-gray-600 hover:text-blue-600 transition font-semibold"
                                        data-id="{{ $post['external_id'] }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                                        <span class="like-count">{{ $post['likes'] ?? 0 }}</span>
                                    </button>

                                    <button class="dislike-btn flex items-center gap-2 text-gray-600 hover:text-red-600 transition font-semibold"
                                        data-id="{{ $post['external_id'] }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"/></svg>
                                        <span class="dislike-count">{{ $post['dislikes'] ?? 0 }}</span>
                                    </button>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/></svg>
                                        <span>{{ $post['comments_count'] ?? 0 }}</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                        <span>{{ number_format($post['views'] ?? 0) }}</span>
                                    </div>

                                    <a href="{{ route('post.show', $post['external_id']) }}"
                                        class="ml-auto text-blue-600 hover:text-blue-700 font-semibold transition">
                                        Ler Artigo →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-16 text-center border border-gray-100">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">Este usuário ainda não publicou nenhum artigo</p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-semibold">
                        Voltar ao Blog
                    </a>
                </div>
            @endif
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

<script>
document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const countSpan = this.querySelector('.like-count');
        fetch(`/post/${id}/like`, { method: 'POST' })
            .then(r => { if(r.ok) countSpan.textContent = parseInt(countSpan.textContent) + 1; })
            .catch(e => console.error(e));
    });
});

document.querySelectorAll('.dislike-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const countSpan = this.querySelector('.dislike-count');
        fetch(`/post/${id}/dislike`, { method: 'POST' })
            .then(r => { if(r.ok) countSpan.textContent = parseInt(countSpan.textContent) + 1; })
            .catch(e => console.error(e));
    });
});
</script>
@endsection
