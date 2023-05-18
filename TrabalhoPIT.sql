CREATE DATABASE HIREGENIUSES;
USE HIREGENIUSES;

CREATE TABLE TALENTO(
ID_TALENTO int primary key auto_increment not null,
NOME varchar(80) not null,
EMAIL varchar(200) not null,
SENHA varchar(30) not null,
TELEFONE char(14) not null,
CPF char(14) not null,
CEP char(10) not null,
NUM_ENDERECO int,
CEP2 char(10),
NUM_ENDERECO2 int,
GENERO char(1)
);

CREATE TABLE DOCUMENTOS(
ID_TALENTO int auto_increment not null,
CPF char(14) not null,
RG varchar(20) not null,
DATA_EMISSAO_RG date not null,
CNH char(11),
DATA_EMISSAO_CNH date,
DATA_VENCIMENTO_CNH date,
foreign key (ID_TALENTO) references TALENTO (ID_TALENTO)
);

CREATE TABLE CONTRATANTE(
ID_CONTRATANTE int primary key auto_increment not null,
CNPJ char(18),
CPF char(14),
NOME varchar(100) not null,
TELEFONE char(14) not null,
CEP char(10) not null,
NUM_ENDERECO int not null
);

CREATE TABLE SERVICO(
ID_SERVICO int primary key auto_increment not null,
ID_CONTRATANTE int not null,
DESCRICAO varchar(255) not null,
PRAZO int not null,
VALOR double not null,
foreign key (ID_CONTRATANTE) references CONTRATANTE(ID_CONTRATANTE)
);


