# Sistema de Biblioteca - TRABALHO 2 (DW1)

Adaptação do projeto de gerenciamento de biblioteca de **PHP Puro** para o framework **Laravel 12**.

---

## 📚 Visão Geral do Sistema

O sistema gerencia uma biblioteca com os seguintes módulos:
- **Autores**: Cadastro de autores (relacionamento 1:N com Livros - restrição na exclusão se houver livros cadastrados).
- **Livros**: Cadastro de livros com vínculo a um autor, controle de estoque e ISBN único.
- **Usuários**: Cadastro de leitores/usuários da biblioteca com e-mail único.
- **Reservas**: Tabela intermediária de relacionamento N:N entre Usuários e Livros, registrando data e status (`Pendente`, `Ativa`, `Concluida`, `Cancelada`).

---

## 🛠️ Tecnologias Utilizadas

- **PHP 8.3+**
- **Laravel 12 (Framework)**
- **MySQL / MariaDB** (via Eloquent ORM)
- **Blade Template Engine**
- **CSS personalizado** (mantendo a identidade visual original)

---

## 🗂️ Estrutura do Projeto Laravel

- **Models** (`app/Models/`):
  - [`Autor.php`](/TRABALHO2_DW/app/Models/Autor.php): relacionamento `hasMany(Livro::class)`.
  - [`Livro.php`](/TRABALHO2_DW/app/Models/Livro.php): relacionamento `belongsTo(Autor::class)` e `belongsToMany(Usuario::class, 'reservas')`.
  - [`Usuario.php`](/TRABALHO2_DW/app/Models/Usuario.php): relacionamento `hasMany(Reserva::class)` e `belongsToMany(Livro::class, 'reservas')`.
  - [`Reserva.php`](/TRABALHO2_DW/app/Models/Reserva.php): relacionamentos `belongsTo(Usuario::class)` e `belongsTo(Livro::class)`.

- **Controllers** (`app/Http/Controllers/`):
  - [`AutorController.php`](/TRABALHO2_DW/app/Http/Controllers/AutorController.php): CRUD com busca por nome e bloqueio de exclusão quando há livros associados.
  - [`LivroController.php`](/TRABALHO2_DW/app/Http/Controllers/LivroController.php): CRUD com pesquisa por título do livro ou nome do autor (via JOIN/whereHas).
  - [`UsuarioController.php`](/TRABALHO2_DW/app/Http/Controllers/UsuarioController.php): CRUD com busca por nome ou e-mail.
  - [`ReservaController.php`](/TRABALHO2_DW/app/Http/Controllers/ReservaController.php): CRUD com busca por usuário, livro ou status.

- **Migrations** (`database/migrations/`):
  - `2024_01_01_000001_create_autores_table.php`
  - `2024_01_01_000002_create_usuarios_table.php`
  - `2024_01_01_000003_create_livros_table.php`
  - `2024_01_01_000004_create_reservas_table.php`

- **Views Blade** (`resources/views/`):
  - [`layouts/app.blade.php`](/TRABALHO2_DW/resources/views/layouts/app.blade.php): Layout principal com navegação, estilos e mensagens flash.
  - [`home.blade.php`](/TRABALHO2_DW/resources/views/home.blade.php): Página inicial explicando os relacionamentos 1:N e N:N.
  - `autores/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
  - `livros/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
  - `usuarios/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
  - `reservas/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.

- **Estilos** (`public/css/style.css`):
  - Estilização completa idêntica à versão PHP original.

---

## 🚀 Como Executar o Projeto

### 1. Iniciar o Banco de Dados MySQL
Certifique-se de que o serviço MySQL esteja em execução:
```bash
sudo service mysql start
```

### 2. Configurar o Banco no `.env`
O arquivo `.env` já está configurado com as credenciais padrão do projeto original:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca_db
DB_USERNAME=root
DB_PASSWORD=mysqluser
```
> Caso necessário, ajuste usuário e senha no arquivo `.env`.

### 3. Executar as Migrations e Alimentar o Banco (Seeds)
Execute o comando abaixo para criar as tabelas e inserir dados de exemplo (autores consagrados, usuários, livros e reservas):
```bash
php artisan migrate --seed
```

*(Se o banco `biblioteca_db` não existir, o Laravel perguntará se deseja criá-lo automaticamente; basta confirmar com `yes`)*.

### 4. Iniciar o Servidor de Desenvolvimento
```bash
php artisan serve
```

Acesse no seu navegador: [http://localhost:8000](http://localhost:8000)

---

## 🧪 Testes Automatizados

Para rodar os testes da aplicação:
```bash
php artisan test
```
