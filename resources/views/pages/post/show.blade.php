@extends('layouts.app')

@section('title', $post['title'] ?? 'Artigo')

@section('content')
<div class="bg-white">
    <div class="max-w-4xl mx-auto px-4 py-16">
        @if(isset($post) && !empty($post))
            <article>
                <header class="mb-12">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold mb-6 inline-block">
                        ← Voltar para Blog
                    </a>

                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post['title'] }}
                    </h1>

                    <div class="flex items-center justify-between pb-8 border-b border-gray-200">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-900 mb-1">
                                    <a href="{{ route('user.profile', $post['user']['external_id']) }}" class="text-blue-600 hover:text-blue-700">
                                        {{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}
                                    </a>
                                </p>
                                <p class="text-xs text-gray-600">{{ $post['created_at'] ?? 'Data desconhecida' }}</p>
                            </div>
                        </div>

                        <div class="text-right text-sm text-gray-600">
                            <p class="font-semibold">{{ number_format($post['views'] ?? 0) }}</p>
                            <p class="text-xs">Visualizações</p>
                        </div>
                    </div>
                </header>

                @if(isset($post['tags']) && is_array($post['tags']) && count($post['tags']) > 0)
                    <div class="flex flex-wrap gap-2 mb-12">
                        @foreach($post['tags'] as $tag)
                            <span class="inline-block bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-semibold border border-blue-100">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="prose prose-lg max-w-none mb-12 text-gray-700">
                    {!! nl2br(e($post['body'])) !!}
                </div>

                <div class="flex gap-4 py-8 border-t border-gray-200">
                    <button class="like-btn-detail flex items-center gap-3 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition" data-id="{{ $post['external_id'] }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                        <span class="like-count">{{ $post['likes'] ?? 0 }}</span>
                        <span>Útil</span>
                    </button>

                    <button class="dislike-btn-detail flex items-center gap-3 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition" data-id="{{ $post['external_id'] }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"/></svg>
                        <span class="dislike-count">{{ $post['dislikes'] ?? 0 }}</span>
                        <span>Não Útil</span>
                    </button>
                </div>

                <div class="mt-16 pt-12 border-t border-gray-200">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">
                        Comentários
                        <span class="text-lg text-gray-500 font-normal">({{ count($post['comments'] ?? []) }})</span>
                    </h2>

                    @if(isset($post['comments']) && is_array($post['comments']) && count($post['comments']) > 0)
                        <div class="space-y-8">
                            @foreach($post['comments'] as $comment)
                                <div class="border-l-4 border-blue-500 pl-6 py-6 hover:bg-gray-50 transition rounded-r-lg">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-gray-900">
                                            <a href="{{ route('user.profile', $comment['user']['external_id']) }}" class="text-blue-600 hover:text-blue-700">
                                                {{ $comment['user']['first_name'] }} {{ $comment['user']['last_name'] }}
                                            </a>
                                        </h3>
                                        <time class="text-xs text-gray-500">{{ $comment['created_at'] ?? 'Data desconhecida' }}</time>
                                    </div>

                                    <p class="text-gray-700 mb-4 leading-relaxed">{{ $comment['body'] }}</p>

                                    <div class="flex items-center gap-6 text-sm text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"/></svg>
                                            <span>{{ $comment['likes'] ?? 0 }} útil</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <p class="text-gray-600">Nenhum comentário ainda. Seja o primeiro!</p>
                        </div>
                    @endif
                </div>
            </article>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-600 text-lg mb-6">Artigo não encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
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
        fetch(`/post/${id}/like`, { method: 'POST' })
            .then(r => { if(r.ok) countSpan.textContent = parseInt(countSpan.textContent) + 1; })
            .catch(e => console.error(e));
    });
}

const dislikeDetailBtn = document.querySelector('.dislike-btn-detail');
if(dislikeDetailBtn) {
    dislikeDetailBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const countSpan = this.querySelector('.dislike-count');
        fetch(`/post/${id}/dislike`, { method: 'POST' })
            .then(r => { if(r.ok) countSpan.textContent = parseInt(countSpan.textContent) + 1; })
            .catch(e => console.error(e));
    });
}
</script>
@endsection
