MOBS2 API – Sistema de Cadastro de Veículos

Este projeto é uma API desenvolvida em Laravel para gerenciar usuários e veículos.
A API permite autenticação com JWT e possibilita que cada usuário registre e visualize apenas os veículos cadastrados em sua conta.

📌 Funcionalidades

Cadastro de usuário (/api/register)

Login de usuário (/api/login)

Autenticação via Bearer Token

CRUD de veículos:

Criar veículo vinculado ao usuário logado

Listar veículos apenas do usuário autenticado

Atualizar veículos

Excluir veículos

⚙️ Endpoints da API
🔑 Autenticação

POST /api/register → Cadastra novo usuário

POST /api/login → Realiza login e retorna token

🚗 Veículos (necessário estar logado com Bearer Token)

GET /api/vehicles → Lista todos os veículos do usuário logado

POST /api/vehicles → Cadastra um novo veículo

Exemplo de body:

{
  "placa": "ABC-1234",
  "modelo": "Civic",
  "fabricante": "Honda",
  "ano": 2024
}


GET /api/vehicles/{id} → Retorna um veículo específico

PUT /api/vehicles/{id} → Atualiza um veículo

DELETE /api/vehicles/{id} → Remove um veículo

🚀 Como rodar o projeto
1. Clonar o repositório
git clone https://github.com/seu-usuario/mobs2-api.git
cd mobs2-api

2. Subir containers com Docker
docker-compose up -d --build

3. Instalar dependências
docker exec -it mobs2-laravel bash
composer install
