CREATE DATABASE prova DEFAULT CHARACTER SET latin1 COLLATE latin1_bin ;

use prova;

CREATE TABLE profissional (
  cnpjcontratado VARCHAR(24) NOT NULL,
  nomecontratado VARCHAR(250) CHARACTER SET 'latin1' COLLATE 'latin1_bin' NULL,
  PRIMARY KEY (cnpjcontratado));


CREATE TABLE procedimento (
  codigoprocedimento VARCHAR(20) NOT NULL,
  descricaoprocedimento VARCHAR(250) NULL,
  valorunitario DECIMAL(10,2) NULL,
  PRIMARY KEY (codigoprocedimento));

CREATE TABLE guia (
  numeroguiaprestador VARCHAR(25) NOT NULL,
  cpfcontratato VARCHAR(12) NULL,
  cnpjcontratado VARCHAR(24) NULL,
  codigoprocedimento VARCHAR(20) NULL,
  dataexecucao DATE NULL,
  PRIMARY KEY (numeroguiaprestador));

CREATE TABLE contratado (
  cpfcontratado varchar(12)  NOT NULL,
  nomecontratado varchar(250),
  PRIMARY KEY (cpfcontratado));

CREATE TABLE quantidade (
  idquantidade INT(20) NOT NULL AUTO_INCREMENT ,
  numeroguiaprestador VARCHAR(45),
  quantidadeexecucao INT(5) NULL,
  valortotal DECIMAL(10,2) NULL,
  PRIMARY KEY (idquantidade));


