-- Tabela de LOGIN
CREATE TABLE `pessoa` IF NOT EXISTS.(
    `id` INT(255) NOT NULL AUTO_INCREMENT , 
    `nome` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `CPF` VARCHAR(11) NOT NULL , 
    PRIMARY KEY (`id`)
);

CREATE TABLE `serve_ja`.`login` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nome` VARCHAR(140) NOT NULL ,
    `email` VARCHAR(140) NOT NULL , 
    `senha` VARCHAR(16) NOT NULL , PRIMARY KEY (`id`))