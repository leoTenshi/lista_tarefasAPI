-- Banco de Dados To-Do List
CREATE DATABASE IF NOT EXISTS lista_tarefas;
USE lista_tarefas;

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Categorias
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de Tarefas
CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT,
    status ENUM('pendente','em_andamento','concluida') DEFAULT 'pendente',
    usuario_id INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Inserir usuário inicial
INSERT INTO usuarios (nome, email, senha) VALUES
('Admin', 'admin@example.com', '123456');

-- Inserir categorias iniciais
INSERT INTO categorias (nome) VALUES ('Trabalho'), ('Estudo'), ('Pessoal');

-- Inserir tarefas exemplo
INSERT INTO tarefas (titulo, descricao, status, usuario_id, categoria_id) VALUES
('Finalizar projeto MVC', 'Implementar To-Do List com PHP', 'pendente', 1, 1),
('Estudar para prova', 'Revisar conteúdo de banco de dados', 'em_andamento', 1, 2),
('Comprar mantimentos', 'Ir ao mercado comprar frutas e legumes', 'pendente', 1, 3);
