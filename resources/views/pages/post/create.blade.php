@extends('layouts.app')

@section('title', 'Criar Publicação')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-16">
        <div class="mb-12">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold mb-6 inline-block">
                ← Voltar para Blog
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Criar Publicação</h1>
            <p class="text-gray-600">Compartilhe seus pensamentos com a comunidade</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            <form action="{{ route('post.store') }}" method="POST" class="space-y-8">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-3">
                        Título da Publicação
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Digite um título atrativo..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror"
                        required
                        minlength="5"
                        maxlength="255"
                    >
                    @error('title')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2">Mínimo 5 caracteres, máximo 255</p>
                </div>

                <div>
                    <label for="body" class="block text-sm font-semibold text-gray-900 mb-3">
                        Conteúdo
                    </label>
                    <textarea
                        id="body"
                        name="body"
                        rows="10"
                        placeholder="Escreva o conteúdo da sua publicação aqui..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none @error('body') border-red-500 @enderror"
                        required
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2">Mínimo 10 caracteres</p>
                </div>

                <div>
                    <label for="tags" class="block text-sm font-semibold text-gray-900 mb-3">
                        Tags (Opcional)
                    </label>
                    <input
                        type="text"
                        id="tags"
                        name="tags"
                        value="{{ old('tags') }}"
                        placeholder="Digite as tags separadas por vírgula (ex: tecnologia, design, tutorial)"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('tags') border-red-500 @enderror"
                    >
                    @error('tags')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2">Separe múltiplas tags com vírgula</p>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button
                        type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold shadow-lg"
                    >
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Publicar
                    </button>
                    <a
                        href="{{ route('home') }}"
                        class="flex-1 bg-gray-100 text-gray-800 py-3 rounded-lg hover:bg-gray-200 transition font-semibold text-center"
                    >
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-12 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="text-lg font-bold text-blue-900 mb-3">💡 Dicas para uma boa publicação:</h3>
            <ul class="space-y-2 text-blue-800 text-sm">
                <li>✓ Escolha um título claro e descritivo</li>
                <li>✓ Escreva conteúdo original e relevante</li>
                <li>✓ Use tags para melhor categorização</li>
                <li>✓ Revise antes de publicar</li>
                <li>✓ Seja respeitoso com a comunidade</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('body').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 400) + 'px';
    });
</script>
@endsection
