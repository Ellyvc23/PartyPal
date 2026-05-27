create database partypal;

use partypal;

create table usuarios(
    id int primary key AUTO_INCREMENT,
    nome varchar(50),
    email varchar(100),
    cpf varchar(50),
    data_nascimento date,
    senha varchar(255)
);

CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE eventos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    data_evento DATETIME NOT NULL,
    localizacao VARCHAR(200),
    imagem_url TEXT,
    destaque TINYINT(1) DEFAULT 0,
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);