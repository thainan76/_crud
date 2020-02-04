## CRIANDO O BANCO DE DADOS PARA CRUD

CREATE DATABASE CRUD;
USE CRUD;

## CRIANDO A TABELA DE CLIENTES

CREATE TABLE clientes(
	id INT auto_increment NOT NULL, 
    nome varchar(120) NOT NULL,
    email varchar(120) NOT NULL,
    telefone varchar(120),
    endereco varchar(120),
    bairro varchar (120),
	PRIMARY KEY (id)
);

## INSERINDO ALGUNS DADOS NA TABELA

INSERT INTO clientes VALUES (1,'Thainan de Andrade', 'thainan.cpv76@gmail.com','12991667478','Rua Doutor Jorge Winther','Centro'),(2,'João Victor', 'joaovictorcpv@hotmail.com', '12991667478', 'Rua Luso de Souza', 'Vila Naly');