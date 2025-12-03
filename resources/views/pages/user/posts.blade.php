<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts de {{ $user->first_name ?? 'Usuario' }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                    Voltar aos Posts
                </a>
                <h1 class="text-lg font-bold text-gray-900">
                    Publicacoes de {{ $user->first_name ?? 'Usuario' }}
                </h1>
                <div class="flex items-center gap-2">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $posts->total() }}
                    </span>
                    <span class="text-sm text-gray-600">publicacoes</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        @if($user)
            <header class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-2">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h2>
                        <p class="text-gray-600">
                            Mostrando todas as publicacoes do usuario
                        </p>
                    </div>
                    <a href="{{ route('user.profile', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Ver Perfil Completo
                    </a>
                </div>
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5"></path>
                                <path d="M6.5 6.5h7M6.5 10h7M6.5 13.5h3" stroke="currentColor" stroke-width="2" fill="none"></path>
                            </svg>
                            <span>{{ $posts->total() }} publicacoes no total</span>
                        </div>
                    </div>
                </div>
            </header>

            @if($posts->count() > 0)
                <div class="space-y-6 mb-12">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300 overflow-hidden group">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold mb-2">
                                            <a href="{{ route('post.show', $post->external_id) }}" class="text-gray-900 hover:text-blue-600 transition duration-200">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-3">
                                            Publicado em {{ $post->created_at->format('d \d\e F \d\e Y') }}
                                        </p>
                                    </div>
                                </div>

                                <p class="text-gray-700 mb-4 leading-relaxed">
                                    {{ Str::limit($post->body, 250) }}
                                </p>

                                @if($post->tags && count($post->tags) > 0)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($post->tags as $tag)
                                            <span class="inline-block bg-gray-100 hover:bg-blue-50 text-gray-700 px-3 py-1 rounded-full text-xs font-medium border border-gray-200 transition duration-200">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-6 pt-4 border-t border-gray-200 text-sm">
                                    <button onclick="likePost('{{ $post->external_id }}')" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition duration-200 font-medium">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                                        </svg>
                                        <span id="likes-{{ $post->external_id }}">{{ $post->likes }}</span>
                                        <span class="hidden sm:inline">curtidas</span>
                                    </button>

                                    <button onclick="dislikePost('{{ $post->external_id }}')" class="flex items-center gap-2 text-gray-600 hover:text-red-600 transition duration-200 font-medium">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"></path>
                                        </svg>
                                        <span id="dislikes-{{ $post->external_id }}">{{ $post->dislikes }}</span>
                                        <span class="hidden sm:inline">descurtidas</span>
                                    </button>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                            <path d="M6 7h8M6 11h8M6 15h4" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"></path>
                                        </svg>
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                        <span class="hidden sm:inline">comentarios</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ number_format($post->views) }}</span>
                                        <span class="hidden sm:inline">visualizacoes</span>
                                    </div>

                                    <a href="{{ route('post.show', $post->external_id) }}" class="ml-auto text-blue-600 hover:text-blue-700 font-semibold transition duration-200">
                                        Ler Post
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <nav class="flex items-center gap-2">
                        {{ $posts->links() }}
                    </nav>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <p class="text-gray-600 text-lg mb-6">Este usuario ainda nao tem publicacoes</p>
                    <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Voltar para Home
                    </a>
                </div>
            @endif
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
        <div class="max-w-7xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>

    <script>
        function likePost(id) {
            const likesSpan = document.getElementById(`likes-${id}`);
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
            const dislikesSpan = document.getElementById(`dislikes-${id}`);
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
cat /mnt/user-data/outputs/posts_profissional.blade.php
Saída

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts de {{ $user->first_name ?? 'Usuario' }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                    Voltar aos Posts
                </a>
                <h1 class="text-lg font-bold text-gray-900">
                    Publicacoes de {{ $user->first_name ?? 'Usuario' }}
                </h1>
                <div class="flex items-center gap-2">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $posts->total() }}
                    </span>
                    <span class="text-sm text-gray-600">publicacoes</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        @if($user)
            <header class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-2">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h2>
                        <p class="text-gray-600">
                            Mostrando todas as publicacoes do usuario
                        </p>
                    </div>
                    <a href="{{ route('user.profile', $user->external_id) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Ver Perfil Completo
                    </a>
                </div>
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5"></path>
                                <path d="M6.5 6.5h7M6.5 10h7M6.5 13.5h3" stroke="currentColor" stroke-width="2" fill="none"></path>
                            </svg>
                            <span>{{ $posts->total() }} publicacoes no total</span>
                        </div>
                    </div>
                </div>
            </header>

            @if($posts->count() > 0)
                <div class="space-y-6 mb-12">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300 overflow-hidden group">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold mb-2">
                                            <a href="{{ route('post.show', $post->external_id) }}" class="text-gray-900 hover:text-blue-600 transition duration-200">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-3">
                                            Publicado em {{ $post->created_at->format('d \d\e F \d\e Y') }}
                                        </p>
                                    </div>
                                </div>

                                <p class="text-gray-700 mb-4 leading-relaxed">
                                    {{ Str::limit($post->body, 250) }}
                                </p>

                                @if($post->tags && count($post->tags) > 0)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($post->tags as $tag)
                                            <span class="inline-block bg-gray-100 hover:bg-blue-50 text-gray-700 px-3 py-1 rounded-full text-xs font-medium border border-gray-200 transition duration-200">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-6 pt-4 border-t border-gray-200 text-sm">
                                    <button onclick="likePost('{{ $post->external_id }}')" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition duration-200 font-medium">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v-6a1.5 1.5 0 01-3 0v6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.256 10.333z"></path>
                                        </svg>
                                        <span id="likes-{{ $post->external_id }}">{{ $post->likes }}</span>
                                        <span class="hidden sm:inline">curtidas</span>
                                    </button>

                                    <button onclick="dislikePost('{{ $post->external_id }}')" class="flex items-center gap-2 text-gray-600 hover:text-red-600 transition duration-200 font-medium">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.641a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.744-2.266z"></path>
                                        </svg>
                                        <span id="dislikes-{{ $post->external_id }}">{{ $post->dislikes }}</span>
                                        <span class="hidden sm:inline">descurtidas</span>
                                    </button>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                            <path d="M6 7h8M6 11h8M6 15h4" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"></path>
                                        </svg>
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                        <span class="hidden sm:inline">comentarios</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ number_format($post->views) }}</span>
                                        <span class="hidden sm:inline">visualizacoes</span>
                                    </div>

                                    <a href="{{ route('post.show', $post->external_id) }}" class="ml-auto text-blue-600 hover:text-blue-700 font-semibold transition duration-200">
                                        Ler Post
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <nav class="flex items-center gap-2">
                        {{ $posts->links() }}
                    </nav>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <p class="text-gray-600 text-lg mb-6">Este usuario ainda nao tem publicacoes</p>
                    <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Voltar para Home
                    </a>
                </div>
            @endif
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
        <div class="max-w-7xl mx-auto px-4 py-8 text-center text-sm text-gray-400">
            <p>Blog powered by DummyJSON API. Desenvolvido com Laravel e Domain Driven Design.</p>
        </div>
    </footer>

    <script>
        function likePost(id) {
            const likesSpan = document.getElementById(`likes-${id}`);
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
            const dislikesSpan = document.getElementById(`dislikes-${id}`);
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
