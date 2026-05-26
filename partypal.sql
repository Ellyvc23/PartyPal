create database partypal;

use partypal;

create table usuarios(
    id int primary key auto increment,
    nome varchar(50),
    email varchar(100),
    cpf varchar(50),
    data_nascimento date,
    senha varchar(255)
);