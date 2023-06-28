CREATE DATABASE HIREGENIUSES;
USE HIREGENIUSES;

CREATE TABLE TALENTO(
ID varchar(30) primary key not null,
NOME varchar(80) not null,
EMAIL varchar(200) not null,
SENHA varchar(100) not null,
TELEFONE char(15) not null,
CPF char(14) not null,
CEP char(10) not null,
NUM_ENDERECO int,
CEP2 char(10),
NUM_ENDERECO2 int,
GENERO char(1)
);

CREATE TABLE DOCUMENTOS(
ID int auto_increment not null,
CPF char(14) not null,
RG varchar(20) not null,
DATA_EMISSAO_RG date not null,
CNH char(11),
DATA_EMISSAO_CNH date,
DATA_VENCIMENTO_CNH date,
foreign key (ID) references TALENTO (ID)
);

CREATE TABLE CONTRATANTE(
ID varchar(30) primary key not null,
NOME varchar(150) not null,
email varchar(200) not null,
CNPJ char(18),
TELEFONE char(15) not null,
CEP char(10) not null,
ENDERECO varchar(200) not null,
bairro varchar(100) not null,
cidade varchar(200) not null,
estado char(2) not null,
site varchar(150) not null,
SENHA varchar(100)  not null
);

CREATE TABLE FREELANCERS(
  ID_FREELANCER int primary key auto_increment not null,
  ID_FK varchar(30) not null,
  DESCRICAO varchar(255) not null,
  SERVICO varchar(255) not null,
  foreign key (ID_FK) references TALENTO(ID)
);

CREATE TABLE SERVICO(
  ID_SERVICO int primary key auto_increment not null,
  ID_FK varchar(30) not null,
  NOME_EMPRESA varchar(250) not null,
  DESCRICAO varchar(255) not null,
  HORARIO timestamp not null,
  HABILIDADES varchar(255) not null,
  SERVICO varchar(255) not null,
  VALOR float(9,2) not null,
  CONTATO varchar(255) not null,
  foreign key (ID_FK) references CONTRATANTE(ID)
);
