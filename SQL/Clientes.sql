CREATE TABLE `serve_ja`.`pessoa` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `nome` VARCHAR(140) NOT NULL , 
    `email` VARCHAR(140) NOT NULL , 
    `senha` VARCHAR(16) NOT NULL , 
    `cpf` VARCHAR(14) NOT NULL , PRIMARY KEY (`id`));

CREATE TABLE `serve_ja`.`prato` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nome_prato` VARCHAR(40) NOT NULL , 
    `descricao` VARCHAR(255) NOT NULL , 
    `preco` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`));