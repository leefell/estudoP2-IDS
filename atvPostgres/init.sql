-- Script de inicialização do banco startup_db para PostgreSQL

-- Conectar ao banco startup_db (executar após criar o banco)
-- \c startup_db;

-- Criar tabela de clientes
CREATE TABLE IF NOT EXISTS clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INTEGER DEFAULT 0,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir dados de exemplo
INSERT INTO clientes (nome, email, telefone, endereco) VALUES 
('João Silva', 'joao@email.com', '(11) 99999-9999', 'Rua das Flores, 123'),
('Maria Santos', 'maria@email.com', '(11) 88888-8888', 'Av. Principal, 456'),
('Pedro Oliveira', 'pedro@email.com', '(11) 77777-7777', 'Rua do Comércio, 789');

INSERT INTO produtos (nome, descricao, preco, estoque) VALUES 
('Produto A', 'Descrição do Produto A', 29.90, 100),
('Produto B', 'Descrição do Produto B', 45.50, 50),
('Produto C', 'Descrição do Produto C', 15.00, 200);
