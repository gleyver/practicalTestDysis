/*
	Tabela de registro dos contatos
*/
CREATE TABLE tbl_contato
(
	id_contato INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(180) NOT NULL,
    email VARCHAR(180) NOT NULL,
    senha VARCHAR(180) NOT NULL
);
