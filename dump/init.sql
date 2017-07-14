-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 07/07/2017 às 11:14
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de dados: `salaReuniaoDB`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` varchar(20) NOT NULL,
  `situacao` varchar(30) NOT NULL,
  `valor` float NOT NULL,
  `observacoes` varchar(500) NOT NULL,
  `id_tipo_agendamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_agendamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `senha` varchar(10)CHARACTER SET latin1 DEFAULT NULL,
  `aniversario` date DEFAULT NULL,
  `data_de_cadastro` datetime NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `observacoes` varchar(500) DEFAULT NULL,
  `endereco` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `fone` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fone1` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `fone2` varchar(50) CHARACTER SET latin1 DEFAULT NULL, 
  `imagem` varchar(100) CHARACTER SET latin1 DEFAULT 'images/clientes/semfoto.png',
  `id_admin` int(11) NOT NULL DEFAULT '46',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Estrutura para tabela `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `tamanho` varchar(10)CHARACTER SET latin1 DEFAULT NULL,  
  `id_admin` int(11) NOT NULL DEFAULT '46',
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;
-- --------------------------------------------------------

--
-- Estrutura para tabela `suspensoes`
--

CREATE TABLE IF NOT EXISTS `suspensoes` (
  `id_suspensao` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicio` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inclusao` datetime NOT NULL,
  PRIMARY KEY (`id_suspensao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `role` (
  `r_id` INT NOT NULL AUTO_INCREMENT,
  `r_name` VARCHAR(45) NOT NULL,
  `r_can_admin` TINYINT(4) NOT NULL,
  `r_can_edit` TINYINT(4) NOT NULL,
  `r_can_write` TINYINT(4) NOT NULL,
  `r_can_read` TINYINT(4) NOT NULL,
  PRIMARY KEY (`r_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 
COLLATE = utf8_general_ci;
 
CREATE TABLE IF NOT EXISTS `user` (
  `a_id` INT NOT NULL AUTO_INCREMENT,
  `a_username` VARCHAR(255) NOT NULL,
  `a_password` VARCHAR(255) NOT NULL,
  `a_first_name` VARCHAR(255) NOT NULL,
  `a_last_name` VARCHAR(255) NOT NULL,
  `a_role_id` INT NOT NULL,
  PRIMARY KEY (`a_id`),
  INDEX `fk_user_role_idx` (`a_role_id` ASC),
  CONSTRAINT `fk_user_role`
    FOREIGN KEY (`a_role_id`)
    REFERENCES `role` (`r_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 
COLLATE = utf8_general_ci;
 
INSERT INTO `role` (`r_id`, `r_name`, `r_can_admin`, `r_can_edit`, `r_can_write`, `r_can_read`) VALUES
(1, 'Leitura', 0, 0, 0, 1),
(2, 'Gravação', 0, 0, 1, 1),
(3, 'Edição', 0, 1, 1, 1),
(4, 'Administrador', 1, 1, 1, 1);
 
INSERT INTO `user` (`a_id`, `a_role_id`, `a_username`, `a_password`, `a_first_name`, `a_last_name`) VALUES
(1, 1, 'user', '!!!$2y$10$dD8mzFLNOawieVTRVuncAOO7UINnpm7wlnBao70FZXOf4Nd9iuTfa', 'User', 'User'),
(2, 4, 'admin', '!!!$2y$10$MOEhiKLYZqd6qH.IPSAFwuaQAHBSmqEnN5sKqxcPZ8fpFU.t5s7eO', 'Admin', 'User');
 
