-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS pedidos;

-- Usar o banco de dados
USE pedidos;

-- Criar a tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco TEXT NOT NULL,
    pagamento VARCHAR(50) NOT NULL,
    refeicao TEXT NOT NULL,
    bebida VARCHAR(50) NOT NULL,
    observacoes TEXT,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
