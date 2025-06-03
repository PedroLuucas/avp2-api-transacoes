
CREATE DATABASE IF NOT EXISTS api_transacoes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE api_transacoes;

CREATE TABLE IF NOT EXISTS transacoes (
  id CHAR(36) PRIMARY KEY,
  valor DECIMAL(10,2) NOT NULL CHECK (valor >= 0),
  dataHora DATETIME NOT NULL
);
