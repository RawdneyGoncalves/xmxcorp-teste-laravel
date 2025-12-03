<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Post' }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                    Voltar aos Posts
                </a>
                <span class="text-sm text-gray-500">
                    Leitura de {{ ceil(str_word_count($post->body) / 200) }} minuto(s)
                </span>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-12">
        @if($post)
            <article class="mb-12">
                <header class="mb-8">
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Por</p>
                                <a href="{{ route('user.profile', $post->user->external_id) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-700 transition">
                                    {{ $post->user->first_name }} {{ $post->user->last_name }}
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1 4.5 4.5 0 1-3.384 6.98z"></path>
                                </svg>
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                    {{ $post->created_at->format('d \d\e F \d\e Y') }}
                                </time>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ number_format($post->views) }} visualizacoes</span>
                            </div>
                        </div>
                    </div>

                    @if($post->tags && count($post->tags) > 0)
                        <div class="flex flex-wrap gap-2 mt-6">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-medium border border-blue-100">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </header>

                <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>

                <div class="flex gap-3 mb-8 pt-6 border-t border-gray-200">
                    <button onclick="likePost('{{ $post->external_id }}')" class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                        </svg>
                        <span id="likes-count">{{ $post->likes }}</span>
                        <span class="text-sm">Gostei</span>
                    </button>

                    <button onclick="dislikePost('{{ $post->external_id }}')" class="flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"></path>
                        </svg>
                        <span id="dislikes-count">{{ $post->dislikes }}</span>
                        <span class="text-sm">Nao Gostei</span>
                    </button>
                </div>
            </article>

            <section class="bg-white rounded-lg shadow-sm p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Comentarios
                    <span class="text-lg text-gray-500 font-normal">({{ $post->comments->count() }})</span>
                </h2>

                @if($post->comments->count() > 0)
                    <div class="space-y-6">
                        @foreach($post->comments as $comment)
                            <div class="border-l-4 border-blue-500 pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition duration-150">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-900">
                                        <a href="{{ route('user.profile', $comment->user->external_id) }}" class="text-blue-600 hover:text-blue-700 transition">
                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        </a>
                                    </h3>
                                    <time class="text-xs text-gray-500" datetime="{{ $comment->created_at->format('Y-m-d H:i') }}">
                                        {{ $comment->created_at->format('d/m/Y \a\s H:i') }}
                                    </time>
                                </div>

                                <p class="text-gray-700 mb-3 leading-relaxed">{{ $comment->body }}</p>

                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                    <button class="flex items-center gap-1 hover:text-blue-600 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                                        </svg>
                                        {{ $comment->likes }} curtidas
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Nenhum comentario ainda. Seja o primeiro a comentar!</p>
                    </div>
                @endif
            </section>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 text-lg mb-6">Post nao encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Voltar para Home
                </a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-900 text-white mt-16 border-t border-gray-800">
        <div class="max-w-5xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>

    <script>
        function likePost(id) {
            const likesSpan = document.getElementById('likes-count');
            const currentLikes = parseInt(likesSpan.textContent);

            fetch(`/post/${id}/like`, { method: 'POST' })
                .then(response => {
                    if (response.ok) {
                        likesSpan.textContent = currentLikes + 1;
                    }
                })
                .catch(error => console.error('Erro ao curtir:', error));
        }

        function dislikePost(id) {
            const dislikesSpan = document.getElementById('dislikes-count');
            const currentDislikes = parseInt(dislikesSpan.textContent);

            fetch(`/post/${id}/dislike`, { method: 'POST' })
                .then(response => {
                    if (response.ok) {
                        dislikesSpan.textContent = currentDislikes + 1;
                    }
                })
                .catch(error => console.error('Erro ao descurtir:', error));
        }
    </script>
</body>
</html>
EOF
cat /mnt/user-data/outputs/show_profissional.blade.php
Saída

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Post' }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                    Voltar aos Posts
                </a>
                <span class="text-sm text-gray-500">
                    Leitura de {{ ceil(str_word_count($post->body) / 200) }} minuto(s)
                </span>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-12">
        @if($post)
            <article class="mb-12">
                <header class="mb-8">
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Por</p>
                                <a href="{{ route('user.profile', $post->user->external_id) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-700 transition">
                                    {{ $post->user->first_name }} {{ $post->user->last_name }}
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1 4.5 4.5 0 1-3.384 6.98z"></path>
                                </svg>
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                    {{ $post->created_at->format('d \d\e F \d\e Y') }}
                                </time>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ number_format($post->views) }} visualizacoes</span>
                            </div>
                        </div>
                    </div>

                    @if($post->tags && count($post->tags) > 0)
                        <div class="flex flex-wrap gap-2 mt-6">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-medium border border-blue-100">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </header>

                <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>

                <div class="flex gap-3 mb-8 pt-6 border-t border-gray-200">
                    <button onclick="likePost('{{ $post->external_id }}')" class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                        </svg>
                        <span id="likes-count">{{ $post->likes }}</span>
                        <span class="text-sm">Gostei</span>
                    </button>

                    <button onclick="dislikePost('{{ $post->external_id }}')" class="flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"></path>
                        </svg>
                        <span id="dislikes-count">{{ $post->dislikes }}</span>
                        <span class="text-sm">Nao Gostei</span>
                    </button>
                </div>
            </article>

            <section class="bg-white rounded-lg shadow-sm p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Comentarios
                    <span class="text-lg text-gray-500 font-normal">({{ $post->comments->count() }})</span>
                </h2>

                @if($post->comments->count() > 0)
                    <div class="space-y-6">
                        @foreach($post->comments as $comment)
                            <div class="border-l-4 border-blue-500 pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition duration-150">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-900">
                                        <a href="{{ route('user.profile', $comment->user->external_id) }}" class="text-blue-600 hover:text-blue-700 transition">
                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        </a>
                                    </h3>
                                    <time class="text-xs text-gray-500" datetime="{{ $comment->created_at->format('Y-m-d H:i') }}">
                                        {{ $comment->created_at->format('d/m/Y \a\s H:i') }}
                                    </time>
                                </div>

                                <p class="text-gray-700 mb-3 leading-relaxed">{{ $comment->body }}</p>

                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                    <button class="flex items-center gap-1 hover:text-blue-600 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                                        </svg>
                                        {{ $comment->likes }} curtidas
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Nenhum comentario ainda. Seja o primeiro a comentar!</p>
                    </div>
                @endif
            </section>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 text-lg mb-6">Post nao encontrado</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Voltar para Home
                </a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-900 text-white mt-16 border-t border-gray-800">
        <div class="max-w-5xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>

    <script>
        function likePost(id) {
            const likesSpan = document.getElementById('likes-count');
            const currentLikes = parseInt(likesSpan.textContent);

            fetch(`/post/${id}/like`, { method: 'POST' })
                .then(response => {
                    if (response.ok) {
                        likesSpan.textContent = currentLikes + 1;
                    }
                })
                .catch(error => console.error('Erro ao curtir:', error));
        }

        function dislikePost(id) {
            const dislikesSpan = document.getElementById('dislikes-count');
            const currentDislikes = parseInt(dislikesSpan.textContent);

            fetch(`/post/${id}/dislike`, { method: 'POST' })
                .then(response => {
                    if (response.ok) {
                        dislikesSpan.textContent = currentDislikes + 1;
                    }
                })
                .catch(error => console.error('Erro ao descurtir:', error));
        }
    </script>
</body>
</html>
