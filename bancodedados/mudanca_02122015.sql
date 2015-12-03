ALTER TABLE `funcao` ADD `ativo` INT(1) NOT NULL DEFAULT '1' AFTER `poder_id`;
ALTER TABLE `pessoa` ADD `ativo` INT(1) NOT NULL DEFAULT '1' AFTER `usuario_cadastro_id`;
ALTER TABLE `evento` ADD `ativo` INT(1) NOT NULL DEFAULT '1' AFTER `usuario_cadastro_id`;