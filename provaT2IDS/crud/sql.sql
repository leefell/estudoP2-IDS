-- init.sql - Executado automaticamente na criação do container

-- Tabela de clientes
CREATE TABLE IF NOT EXISTS clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    empresa VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Trigger para atualizar updated_at automaticamente
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ language 'plpgsql';

CREATE TRIGGER update_clientes_updated_at 
    BEFORE UPDATE ON clientes 
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- Dados de exemplo
INSERT INTO clientes (nome, email, telefone, empresa) VALUES
('João Silva', 'joao@empresa.com', '(11) 99999-9999', 'Tech Solutions'),
('Maria Santos', 'maria@startup.com', '(11) 88888-8888', 'Innovation Corp'),
('Pedro Costa', 'pedro@consultoria.com', '(11) 77777-7777', 'Business Expert')
ON CONFLICT (email) DO NOTHING;
