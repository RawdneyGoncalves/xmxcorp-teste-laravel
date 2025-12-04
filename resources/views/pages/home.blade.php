@extends('layouts.app')

@section('title', 'Home - Blog')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-8 sticky top-24 h-fit border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-8">Filtros de Busca</h3>
                    <form method="GET" action="{{ route('home') }}" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Título da Publicação</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Digite aqui..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Curtidas Mínimas</label>
                            <input type="number" name="min_likes" value="{{ request('min_likes') }}" placeholder="0" min="0"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        <div class="space-y-3">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-2.5 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold text-sm shadow-md">
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('home') }}" class="w-full block text-center bg-gray-100 text-gray-800 py-2.5 rounded-lg hover:bg-gray-200 transition font-semibold text-sm">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Publicações Recentes</h1>
                    <p class="text-gray-600">Explore as melhores publicações da comunidade</p>
                </div>

                @if(isset($posts) && is_array($posts) && count($posts) > 0)
                    <div class="space-y-6">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
                                <div class="p-8">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <h2 class="text-2xl font-bold mb-3">
                                                <a href="{{ route('post.show', $post['external_id']) }}" class="text-gray-900 hover:text-blue-600 transition">
                                                    {{ $post['title'] }}
                                                </a>
                                            </h2>
                                            <p class="text-sm text-gray-600 mb-4">
                                                Publicado por
                                                <a href="{{ route('user.profile', $post['user']['external_id']) }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                                    {{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mb-6 leading-relaxed line-clamp-2">
                                        {{ substr($post['body'], 0, 280) }}...
                                    </p>

                                    @if(isset($post['tags']) && is_array($post['tags']) && count($post['tags']) > 0)
                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach($post['tags'] as $tag)
                                                <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold border border-blue-100">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-6 pt-6 border-t border-gray-100 text-sm">
                                        <button class="like-btn flex items-center gap-2 text-gray-600 hover:text-blue-600 transition font-semibold" data-id="{{ $post['external_id'] }}">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                                            <span class="like-count">{{ $post['likes'] ?? 0 }}</span>
                                        </button>

                                        <button class="dislike-btn flex items-center gap-2 text-gray-600 hover:text-red-600 transition font-semibold" data-id="{{ $post['external_id'] }}">
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

                                        <a href="{{ route('post.show', $post['external_id']) }}" class="ml-auto text-blue-600 hover:text-blue-700 font-semibold transition">
                                            Ler Artigo →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-16 text-center border border-gray-100">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Nenhuma publicação encontrada</p>
                        <a href="{{ route('home') }}" class="inline-block mt-6 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Limpar Filtros
                        </a>
                    </div>
                @endif
            </div>
        </div>
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
