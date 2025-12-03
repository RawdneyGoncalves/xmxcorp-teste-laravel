# Blog Laravel - Arquitetura DDD

Aplicação Laravel implementada com Domain-Driven Design (DDD) para gerenciamento de posts, usuários e comentários.

## Tecnologias

- PHP 8.3.24
- Laravel 12.40.2
- MySQL 8.0
- Eloquent ORM
- Composer

## Arquitetura

A aplicação segue o padrão **Layered Architecture + Domain-Driven Design** com 4 camadas principais:

### 1. Domain Layer (Camada de Domínio)

Contém a lógica de negócio pura, independente de frameworks.

**Componentes:**

- **Entities**: Objetos com identidade única que encapsulam regras de negócio
  - UserEntity.php
  - PostEntity.php
  - CommentEntity.php

- **Value Objects**: Objetos imutáveis identificados por seus atributos
  - PostId.php
  - UserId.php
  - Email.php (Shared)

- **Repositories (Interfaces)**: Contratos para persistência de dados
  - PostRepositoryInterface.php
  - UserRepositoryInterface.php
  - CommentRepositoryInterface.php

- **Domain Services**: Lógica complexa entre entidades
  - PostDomainService.php
  - UserDomainService.php
  - CommentDomainService.php

**Localização:** `app/Domain/Blog`

### 2. Application Layer (Camada de Aplicação)

Orquestra o fluxo entre domínio e apresentação. Não contém regras de negócio.

**Componentes:**

- **Use Cases**: Encapsulam um fluxo de negócio específico
  - ListPostsUseCase.php
  - GetPostDetailUseCase.php
  - LikePostUseCase.php
  - DislikePostUseCase.php
  - GetUserProfileUseCase.php
  - ListUserPostsUseCase.php

- **DTOs**: Transferem dados entre camadas sem lógica
  - ListPostsInputDTO.php
  - ListPostsOutputDTO.php
  - PostDetailOutputDTO.php
  - UserProfileOutputDTO.php

- **Mappers**: Convertem entre entidades e DTOs
  - PostMapper.php
  - UserMapper.php
  - CommentMapper.php

- **Exceptions**: Tratamento de erros específicos da aplicação
  - ApplicationException.php
  - EntityNotFoundException.php

**Localização:** `app/Application/Blog`

### 3. Infrastructure Layer (Camada de Infraestrutura)

Implementações técnicas (banco de dados, APIs externas).

**Componentes:**

- **Repositories (Implementações)**: Implementam as interfaces do domínio
  - EloquentPostRepository.php
  - EloquentUserRepository.php
  - EloquentCommentRepository.php

- **Models (Eloquent)**: Representam as tabelas do banco
  - UserModel.php
  - PostModel.php
  - CommentModel.php

- **External APIs**: Integração com serviços externos
  - DummyJsonClient.php
  - UserSynchronizer.php
  - PostSynchronizer.php
  - CommentSynchronizer.php

- **Service Providers**: Binding de dependências
  - RepositoryServiceProvider.php

**Localização:** `app/Infrastructure`

### 4. Presentation Layer (Camada de Apresentação)

Interface com o usuário (Controllers, Views).

**Componentes:**

- **Controllers**: Recebem requests e delegam a use cases
  - HomeController.php
  - PostController.php
  - UserController.php

- **Requests**: Validação de input HTTP
  - FilterPostsRequest.php
  - FilterUserPostsRequest.php

- **Commands**: CLI para operações administrativas
  - SyncDataCommand.php

- **Views**: Templates Blade para renderização
  - home.blade.php
  - post/show.blade.php
  - user/profile.blade.php

**Localização:** `app/Presentation/Http`

## Fluxo de Dados

```
HTTP Request
    ↓
Controller (validação básica)
    ↓
UseCase (orquestração da lógica)
    ↓
DomainService (regras de negócio)
    ↓
Repository (acesso aos dados)
    ↓
Eloquent Model (persistência)
    ↓
Response/View
```

## Instalação

### Pré-requisitos

- PHP 8.3 ou superior
- Composer
- MySQL 8.0 ou superior
- Git

### 1. Clonar Repositório

```bash
git clone <repository-url>
cd xmxcorp-teste-laravel
```

### 2. Instalar Dependências

```bash
composer install
```

### 3. Configurar Ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar Banco de Dados

Edite o arquivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=
```

Crie o banco de dados:

```bash
mysql -u root -p -e "CREATE DATABASE blog_db;"
```

### 5. Executar Migrations

```bash
php artisan migrate
```

### 6. Popular Banco de Dados

```bash
php artisan db:seed
```

Dados de teste:
- 6 usuários com perfis completos
- 8 posts com múltiplas tags
- 17 comentários distribuídos

### 7. Iniciar Servidor

```bash
php artisan serve
```

A aplicação estará disponível em: http://localhost:8000

## Comandos Disponíveis

### Migrations

```bash
# Executar todas as migrations
php artisan migrate

# Reverter última migration
php artisan migrate:rollback

# Reverter todas as migrations
php artisan migrate:reset

# Resetar e executar novamente
php artisan migrate:refresh

# Resetar banco e executar seeders
php artisan migrate:fresh --seed

# Ver status das migrations
php artisan migrate:status
```

### Database

```bash
# Executar todos os seeders
php artisan db:seed

# Executar seeder específico
php artisan db:seed --class=UserSeeder

# Limpar banco de dados
php artisan db:wipe

# Resetar e popular banco
php artisan db:wipe && php artisan migrate && php artisan db:seed
```

### Tinker (REPL Interativo)

```bash
# Acessar console Laravel
php artisan tinker

# Exemplos de uso:
>>> $user = App\Infrastructure\Persistence\Models\UserModel::first();
>>> $user->posts()->count();
>>> $user->email;
>>> App\Infrastructure\Persistence\Models\PostModel::with('comments')->first();
```

### Cache

```bash
# Limpar cache de configuração
php artisan config:cache

# Limpar todo cache
php artisan cache:clear

# Limpar cache de views
php artisan view:clear

# Limpar cache de rotas
php artisan route:cache
```

### Desenvolvimento

```bash
# Iniciar servidor local
php artisan serve

# Iniciar servidor em porta específica
php artisan serve --port=8080

# Compilar assets
npm run dev

# Build para produção
npm run build
```

### Artisan Make Commands

```bash
# Criar Model
php artisan make:model Post

# Criar Migration
php artisan make:migration create_posts_table

# Criar Seeder
php artisan make:seeder PostSeeder

# Criar Controller
php artisan make:controller PostController

# Criar Request (Form Request)
php artisan make:request StorePostRequest

# Criar Command
php artisan make:command SyncData

# Criar Service Provider
php artisan make:provider RepositoryServiceProvider
```

## Estrutura de Pastas

```
app/
├── Domain/
│   └── Blog/
│       ├── Entities/              # Entidades de domínio
│       ├── Interfaces/            # Contratos de repositório
│       ├── Repositories/          # Implementações Eloquent
│       ├── Services/              # Domain services
│       ├── UseCases/              # Casos de uso
│       ├── ValueObjects/          # Value objects
│       ├── DTOs/                  # Data transfer objects
│       └── Mappers/               # Mappers
├── Application/
│   └── Blog/
│       ├── DTOs/                  # Application DTOs
│       ├── Mappers/               # Application mappers
│       └── UseCases/              # Casos de uso
├── Infrastructure/
│   ├── Persistence/
│   │   ├── Repositories/          # Implementações repository
│   │   └── Models/                # Eloquent models
│   └── ExternalApi/               # Integrações externas
├── Presentation/
│   └── Http/
│       ├── Controllers/           # Controllers HTTP
│       ├── Requests/              # Form requests
│       └── Middleware/            # Middleware customizado
└── Providers/                     # Service providers

database/
├── migrations/                    # Database migrations
├── seeders/                       # Database seeders
└── factories/                     # Model factories

resources/
└── views/                         # Blade templates

routes/
└── web.php                        # Rotas web

```

## Exemplos de Uso

### Listar Posts

```php
// Controller
$useCase = app(ListPostsUseCase::class);
$input = new ListPostsInputDTO(
    page: $request->get('page', 1),
    perPage: $request->get('per_page', 15),
    tag: $request->get('tag'),
    search: $request->get('search')
);
$output = $useCase->execute($input);

// View
@foreach($output->posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
@endforeach
```

### Obter Detalhes de Post

```php
// Controller
$useCase = app(GetPostDetailUseCase::class);
$output = $useCase->execute($postId);

// View
<h1>{{ $output->post->title }}</h1>
@foreach($output->comments as $comment)
    <div>{{ $comment->body }}</div>
@endforeach
```

### Curtir Post

```php
// Controller
$useCase = app(LikePostUseCase::class);
$result = $useCase->execute($postId);

if ($result) {
    return response()->json(['success' => true]);
}
```

### Perfil de Usuário

```php
// Controller
$useCase = app(GetUserProfileUseCase::class);
$output = $useCase->execute($userId);

// View
<h1>{{ $output->user->firstName }}</h1>
<p>Total de posts: {{ $output->totalPosts }}</p>
@foreach($output->posts as $post)
    <article>{{ $post->title }}</article>
@endforeach
```

## Banco de Dados

### Tabelas

**users**
- id (PK)
- external_id (unique)
- first_name
- last_name
- email
- phone
- birth_date
- image
- address (JSON)
- created_at
- updated_at

**posts**
- id (PK)
- external_id (unique)
- user_id (FK)
- title
- body
- tags (longText JSON)
- likes
- dislikes
- views
- created_at
- updated_at

**comments**
- id (PK)
- post_id (FK)
- user_id (FK)
- body
- likes
- created_at
- updated_at

## Padrões de Projeto

### Repository Pattern

Abstração de persistência de dados através de interfaces:

```php
interface PostRepositoryInterface {
    public function findById(PostId $postId): ?PostEntity;
    public function findAll(int $page, int $perPage): array;
    public function save(PostEntity $post): void;
}
```

### UseCase Pattern

Encapsula um fluxo de negócio específico:

```php
class ListPostsUseCase {
    public function execute(ListPostsInputDTO $input): ListPostsOutputDTO {
        // Lógica de listagem
    }
}
```

### Data Transfer Object (DTO)

Transfere dados entre camadas:

```php
class ListPostsInputDTO {
    public int $page = 1;
    public int $perPage = 15;
    public ?string $search = null;
}
```

### Mapper Pattern

Converte entre entidades e DTOs:

```php
class PostMapper {
    public static function fromModelToDTO(PostModel $model): PostOutputDTO {
        return new PostOutputDTO(...);
    }
}
```

### Service Locator / Dependency Injection

Service Provider para binding de dependências:

```php
class RepositoryServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(
            PostRepositoryInterface::class,
            EloquentPostRepository::class
        );
    }
}
```

## Troubleshooting

### Erro: "Target class [Class] does not exist"

```bash
# Limpar cache de autoload
composer dump-autoload

# Verificar se o arquivo existe no caminho correto
# Verificar namespace do arquivo
```

### Erro: "SQLSTATE[42000]"

```bash
# Resetar banco de dados
php artisan migrate:fresh --seed

# Verificar credenciais do banco em .env
```

### Erro: "Undefined type"

```bash
# Verificar namespace e imports
# Limpar cache
php artisan config:clear

# Verificar se o arquivo existe
```

### Erro de Permissão

```bash
# Dar permissões corretas
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage bootstrap/cache
```

## Referências

- [Laravel Documentation](https://laravel.com/docs)
- [Domain-Driven Design - Eric Evans](https://www.domainlanguage.com/ddd/)
- [Repository Pattern](https://martinfowler.com/eaaCatalog/repository.html)
- [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
