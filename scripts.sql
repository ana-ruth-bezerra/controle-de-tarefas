CREATE DATABASE IF NOT EXISTS controle_tarefas;
USE controle_tarefas;

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    categoria_id INT NOT NULL,
    responsavel_id INT NOT NULL,
    status ENUM('nova', 'iniciada', 'pausada', 'reiniciada', 'finalizada') DEFAULT 'nova',
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (responsavel_id) REFERENCES responsaveis(id)
);

CREATE TABLE IF NOT EXISTS movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT NOT NULL,
    acao ENUM('inicio', 'pausa', 'finalizacao', 'retomada') NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id)
);

INSERT INTO categorias (nome) VALUES ('Desenvolvimento'), ('Marketing'), ('Design');

INSERT INTO responsaveis (nome, email) VALUES ('João Silva', 'joao@email.com'), ('Maria Oliveira', 'maria@email.com');

INSERT INTO tarefas (titulo, descricao, categoria_id, responsavel_id, status) 
VALUES ('Criar página inicial', 'Desenvolver a página inicial do site', 1, 1, 'nova'), ('Iniciar campanha de marketing', 'Iniciar campanha', 2, 2, 'nova');