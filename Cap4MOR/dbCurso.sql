-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Aluno'
-- 
-- ---

DROP TABLE IF EXISTS `Aluno`;
		
CREATE TABLE `Aluno` (
  `id` INTEGER(3) NULL AUTO_INCREMENT DEFAULT NULL,
  `nome` VARCHAR(40) NULL DEFAULT NULL,
  `endereco` VARCHAR(40) NULL DEFAULT NULL,
  `telefone` VARCHAR(40) NULL DEFAULT NULL,
  `cidade` VARCHAR(40) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'Curso'
-- 
-- ---

DROP TABLE IF EXISTS `Curso`;
		
CREATE TABLE `Curso` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `descricao` VARCHAR(40) NULL DEFAULT NULL,
  `duracao` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'Turma'
-- 
-- ---

DROP TABLE IF EXISTS `Turma`;
		
CREATE TABLE `Turma` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `dia_semana` INTEGER NULL DEFAULT NULL,
  `turno` CHAR(1) NULL DEFAULT NULL,
  `professor` VARCHAR(40) NULL DEFAULT NULL,
  `sala` VARCHAR(20) NULL DEFAULT NULL,
  `data_inicio` DATE NULL DEFAULT NULL,
  `encerrada` bit NULL DEFAULT NULL,
  `concluida` bit NULL DEFAULT NULL,
  `id_Curso` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'Inscricao'
-- 
-- ---

DROP TABLE IF EXISTS `Inscricao`;
		
CREATE TABLE `Inscricao` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `nota` DECIMAL NULL DEFAULT NULL,
  `frequencia` DECIMAL NULL DEFAULT NULL,
  `cancelada` bit NULL DEFAULT NULL,
  `concluida` bit NULL DEFAULT NULL,
  `id_Aluno` INTEGER(3) NULL DEFAULT NULL,
  `id_Turma` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Turma` ADD FOREIGN KEY (id_Curso) REFERENCES `Curso` (`id`);
ALTER TABLE `Inscricao` ADD FOREIGN KEY (id_Aluno) REFERENCES `Aluno` (`id`);
ALTER TABLE `Inscricao` ADD FOREIGN KEY (id_Turma) REFERENCES `Turma` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Aluno` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Curso` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Turma` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Inscricao` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Aluno` (`id`,`nome`,`endereco`,`telefone`,`cidade`) VALUES
-- ('','','','','');
-- INSERT INTO `Curso` (`id`,`descricao`,`duracao`) VALUES
-- ('','','');
-- INSERT INTO `Turma` (`id`,`dia_semana`,`turno`,`professor`,`sala`,`data_inicio`,`encerrada`,`concluida`,`id_Curso`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `Inscricao` (`id`,`nota`,`frequencia`,`cancelada`,`concluida`,`id_Aluno`,`id_Turma`) VALUES
-- ('','','','','','','');