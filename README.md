# Projeto Cervejaria SENAC

Este é um projeto acadêmico desenvolvido para o curso de Engenharia de Produção SENAC, com o objetivo de criar um sistema para uma cervejaria. O sistema inclui um site institucional, um painel administrativo para gerenciamento de clientes e comandas, e aplicativos móveis para dispensação de cerveja e um jogo de quiz.

## Tecnologias Utilizadas
- **Backend**: Laravel com Filament para o painel administrativo.
- **Frontend**: Site institucional (HTML/CSS/JavaScript).
- **Aplicativos Móveis**: Flutter para o aplicativo do jogo de quiz.
- **Banco de Dados**: MySQL.
- **Documentação**: Implementou-se um projeto bookstack para a documentação.

## Funcionalidades
- **Jogo de Quiz**: Aplicativo Flutter para engajamento do cliente com um quiz.

## Estrutura do Projeto
- **MVC**: O projeto implementa estrutura MVC, comum em projetos Laravel.
- **Integrações**: API REST para comunicação com os aplicativos Flutter (em desenvolvimento).

## Como Executar
1. Clone o repositório: `git clone https://github.com/Andre-Macedo/cervejaria-backend/`
2. Instale as dependências: `composer install`
3. Configure o arquivo `.env` com as credenciais do banco de dados.
4. Execute as migrações: `php artisan migrate`
5. Popule o banco com dados iniciais: `php artisan db:seed`
6. Inicie o servidor: `php artisan serve`
7. Acesse o painel Filament em `/admin`.

## TODO
- Criar o aplicativo Flutter para o jogo de quiz, com perguntas e envio de resultados.
- Configurar proxy de homologação para produção, Contabo -> Azure.
- Finalizar CI/CD para ambiente de produção.
- Adicionar autenticação na API (ex.: Sanctum).
- Finalizar estilização do projeto de Documentação.
