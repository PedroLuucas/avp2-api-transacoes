# 📊 API de Transações – Slim Framework

Este projeto é uma API RESTful desenvolvida com **PHP** e o **Slim Framework 4**, com o objetivo de registrar transações e fornecer estatísticas em tempo real. Esta aplicação foi construída para o desafio da disciplina de Backend.

---

## 🚀 Tecnologias Utilizadas

- PHP 8.0+
- Slim Framework 4
- Slim PSR-7
- MySQL
- Composer

---

## 📁 Estrutura do Projeto

├── app/
│ ├── Controllers/
│ ├── Models/
│ ├── Routes/
│ ├── Services/
│ └── Utils/
├── config/
│ └── database.php
│ └── settings.php
├── migrations/
│ └── create_transacoes.sql
├── public/
│ └── index.php
├── composer.json
├── .htaccess
└── README.md


---

## 🧠 Funcionalidades

### 📥 POST `/transacao`
Registra uma nova transação com os seguintes campos:

```json
{
  "id": "uuid",
  "valor": 100.50,
  "dataHora": "2025-06-01T14:10:00Z"
}

Respostas:
201 Created – Transação registrada com sucesso

422 Unprocessable Entity – Dados inválidos (ex: valor negativo, data no futuro)

400 Bad Request – JSON malformado

📤 GET /transacao/{id}
Retorna os dados de uma transação específica pelo id.

Respostas:
200 OK com JSON da transação

404 Not Found se não existir

❌ DELETE /transacao
Remove todas as transações do banco de dados.

Resposta:
200 OK

❌ DELETE /transacao/{id}
Remove uma transação específica.

Respostas:
200 OK – Se a transação foi apagada

404 Not Found – Se o id não existe

📊 GET /estatistica
Retorna estatísticas das transações realizadas nos últimos 60 segundos:

{
  "sum": 300.75,
  "avg": 100.25,
  "min": 50.00,
  "max": 150.50,
  "count": 3
}

Validações
id deve ser UUID válido

valor deve ser numérico e ≥ 0

dataHora deve estar no passado e no formato ISO 8601

🛠️ Instalação e Execução

Clone o repositório:
bash
Copiar
Editar
git clone https://github.com/PedroLuucas/api-transacoes.git
cd api-transacoes

Instale as dependências:
composer install

Configure o banco de dados em config/database.php.
Crie a base de dados:
-- Execute o conteúdo de migrations/create_transacoes.sql

Inicie o servidor:
php -S localhost:8080 -t public
