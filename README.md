![Header](https://capsule-render.vercel.app/api?type=waving&color=0084ff&height=200&section=header&text=Agenda&fontSize=55&fontColor=ffffff&animation=fadeIn&fontAlignY=38)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript)

Um sistema de gerenciamento de tarefas pessoais com autenticação de usuários, desenvolvido em PHP puro e MySQL.

## Objetivo

A Agenda foi criado como projeto de estudo de back-end, centralizando:

- cadastro e login de usuários;
- recuperação de senha;
- criação, conclusão e exclusão de tarefas;
- organização por prazo e prioridade.

## Funcionalidades

- Cadastro de usuário com senha criptografada
- Login com sessão persistente
- Recuperação de senha via e-mail
- Criação de tarefas com título, descrição, prazo e prioridade
- Marcar/desmarcar tarefa como concluída
- Exclusão de tarefas
- Listagem ordenada por status e prazo
- Feedback visual em modais de sucesso/erro

## Tecnologias Utilizadas

- PHP
- MySQL
- HTML
- CSS
- JavaScript

## Como Executar

O projeto foi desenvolvido usando o **XAMPP**, então essa é a forma mais simples de rodar localmente.

### 1. Instale o XAMPP

Baixe o instalador em [apachefriends.org](https://www.apachefriends.org/pt_br/index.html) e instale normalmente, mantendo os módulos **Apache** e **MySQL** marcados.

### 2. Abra o Painel de Controle do XAMPP

Inicie os serviços **Apache** e **MySQL** clicando em **Start** ao lado de cada um.

### 3. Coloque o projeto na pasta htdocs

Clone (ou copie) o repositório dentro da pasta `htdocs` do XAMPP:

- Windows: `C:\xampp\htdocs\Agenda`
- Linux: `/opt/lampp/htdocs/Agenda`
- macOS: `/Applications/XAMPP/htdocs/Agenda`

```bash
git clone https://github.com/carloshenrique54/Agenda.git
```

### 4. Instale as dependências do Composer

O projeto usa a biblioteca `vlucas/phpdotenv`. Se não tiver o Composer, instale em [getcomposer.org](https://getcomposer.org/), depois rode dentro da pasta do projeto:

```bash
composer install
```

### 5. Crie o banco de dados

Com o Apache e o MySQL rodando, acesse o **phpMyAdmin** em `http://localhost/phpmyadmin`:

1. Clique em **Novo** e crie um banco chamado `db_agenda`
2. Selecione o banco criado, vá na aba **Importar**
3. Escolha o arquivo `db_agenda.sql` do projeto e clique em **Executar**

### 6. Configure as variáveis de ambiente

Copie o `.env.example` para `.env` na raiz do projeto e ajuste conforme o seu XAMPP (por padrão os valores abaixo já funcionam):

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=db_agenda
```

### 7. Acesse a aplicação

Com tudo rodando, abra o navegador em:

```
http://localhost/Agenda
```

Crie sua conta na tela de **Cadastro** e comece a usar.

## Autor

Carlos Henrique
[GitHub](https://github.com/carloshenrique54)

![Footer](https://capsule-render.vercel.app/api?type=waving&color=0084ff&height=100&section=footer)
