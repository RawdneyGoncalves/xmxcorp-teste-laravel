<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Publicacoes - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Blog</h1>
                <div class="flex items-center gap-2">
                    <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $posts->total() }}
                    </span>
                    <span class="text-sm text-gray-600">publicacoes</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24 h-fit">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                        </svg>
                        Filtros
                    </h3>

                    <form method="GET" action="{{ route('home') }}" class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Titulo</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Minimo de Curtidas</label>
                            <input type="number" name="min_likes" value="{{ request('min_likes') }}" placeholder="0" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Data Inicial</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div class="pt-2 space-y-3">
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('home') }}" class="w-full block text-center bg-gray-200 text-gray-800 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold text-sm">
                                Limpar Filtros
                            </a>
                        </div>
                    </form>

                    @if(request('search') || request('min_likes') || request('date_from'))
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-600 mb-3">Filtros ativos:</p>
                            <div class="space-y-2">
                                @if(request('search'))
                                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ request('search') }}
                                    </span>
                                @endif
                                @if(request('min_likes'))
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ request('min_likes') }}+ curtidas
                                    </span>
                                @endif
                                @if(request('date_from'))
                                    <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                        De {{ request('date_from') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="mb-8">
                    <h2 class="text-4xl font-bold text-gray-900">Publicacoes Recentes</h2>
                    <p class="text-gray-600 mt-2">Explore as melhores publicacoes da comunidade</p>
                </div>

                @if($posts->count() > 0)
                    <div class="space-y-6 mb-12">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300 overflow-hidden group">
                                <div class="p-6">
                                    <div class="mb-4">
                                        <h3 class="text-2xl font-bold mb-2">
                                            <a href="{{ route('post.show', $post->external_id) }}" class="text-gray-900 hover:text-blue-600 transition duration-200">
                                                {{ $post->title }}
                                            </a>
                                        </h3>

                                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Por</span>
                                            <a href="{{ route('user.profile', $post->user->external_id) }}" class="text-blue-600 hover:text-blue-700 font-semibold transition">
                                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                                            </a>
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mb-4 leading-relaxed line-clamp-2">
                                        {{ Str::limit($post->body, 250) }}
                                    </p>

                                    @if($post->tags && count($post->tags) > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('home') }}?tag={{ urlencode($tag) }}" class="inline-block bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 px-3 py-1 rounded-full text-xs font-medium border border-gray-200 hover:border-blue-200 transition duration-200">
                                                    {{ $tag }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200 text-sm">
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
                                            </svg>
                                            <span id="comments-{{ $post->external_id }}">{{ $post->comments_count ?? 0 }}</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg mb-6">Nenhuma publicacao encontrada com estes filtros</p>
                        <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            Limpar Filtros
                        </a>
                    </div>
                @endif
            </div>
        </div>
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
cat /mnt/user-data/outputs/home_profissional.blade.php
Saída

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Publicacoes - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Blog</h1>
                <div class="flex items-center gap-2">
                    <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $posts->total() }}
                    </span>
                    <span class="text-sm text-gray-600">publicacoes</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24 h-fit">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                        </svg>
                        Filtros
                    </h3>

                    <form method="GET" action="{{ route('home') }}" class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Titulo</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Minimo de Curtidas</label>
                            <input type="number" name="min_likes" value="{{ request('min_likes') }}" placeholder="0" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Data Inicial</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <div class="pt-2 space-y-3">
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('home') }}" class="w-full block text-center bg-gray-200 text-gray-800 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold text-sm">
                                Limpar Filtros
                            </a>
                        </div>
                    </form>

                    @if(request('search') || request('min_likes') || request('date_from'))
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-600 mb-3">Filtros ativos:</p>
                            <div class="space-y-2">
                                @if(request('search'))
                                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ request('search') }}
                                    </span>
                                @endif
                                @if(request('min_likes'))
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ request('min_likes') }}+ curtidas
                                    </span>
                                @endif
                                @if(request('date_from'))
                                    <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                        De {{ request('date_from') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="mb-8">
                    <h2 class="text-4xl font-bold text-gray-900">Publicacoes Recentes</h2>
                    <p class="text-gray-600 mt-2">Explore as melhores publicacoes da comunidade</p>
                </div>

                @if($posts->count() > 0)
                    <div class="space-y-6 mb-12">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300 overflow-hidden group">
                                <div class="p-6">
                                    <div class="mb-4">
                                        <h3 class="text-2xl font-bold mb-2">
                                            <a href="{{ route('post.show', $post->external_id) }}" class="text-gray-900 hover:text-blue-600 transition duration-200">
                                                {{ $post->title }}
                                            </a>
                                        </h3>

                                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Por</span>
                                            <a href="{{ route('user.profile', $post->user->external_id) }}" class="text-blue-600 hover:text-blue-700 font-semibold transition">
                                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                                            </a>
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mb-4 leading-relaxed line-clamp-2">
                                        {{ Str::limit($post->body, 250) }}
                                    </p>

                                    @if($post->tags && count($post->tags) > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('home') }}?tag={{ urlencode($tag) }}" class="inline-block bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 px-3 py-1 rounded-full text-xs font-medium border border-gray-200 hover:border-blue-200 transition duration-200">
                                                    {{ $tag }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200 text-sm">
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
                                            </svg>
                                            <span id="comments-{{ $post->external_id }}">{{ $post->comments_count ?? 0 }}</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg mb-6">Nenhuma publicacao encontrada com estes filtros</p>
                        <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            Limpar Filtros
                        </a>
                    </div>
                @endif
            </div>
        </div>
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
