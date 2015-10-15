-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Out-2015 às 22:45
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e2f08`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
`id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `uf_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `uf_id`) VALUES
(1, 'Brasília', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `convidado`
--

CREATE TABLE IF NOT EXISTS `convidado` (
`id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `data_hora_chegada` datetime DEFAULT NULL,
  `usuario_check_id` int(11) DEFAULT NULL,
  `nominata` tinyint(1) NOT NULL DEFAULT '0',
  `pre_nominata` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `convidado`
--

INSERT INTO `convidado` (`id`, `pessoa_id`, `evento_id`, `data_hora_chegada`, `usuario_check_id`, `nominata`, `pre_nominata`) VALUES
(1, 33, 7, NULL, NULL, 0, 1),
(3, 32, 7, NULL, NULL, 0, 0),
(7, 33, 1, NULL, NULL, 0, 0),
(9, 33, 6, NULL, NULL, 0, 0),
(10, 32, 11, NULL, NULL, 0, 0),
(11, 33, 11, NULL, NULL, 0, 0),
(12, 32, 12, NULL, NULL, 0, 0),
(13, 33, 12, NULL, NULL, 0, 0),
(17, 34, 12, NULL, NULL, 0, 1),
(18, 34, 13, '2015-10-14 17:41:28', 3, 0, 0),
(19, 35, 13, NULL, NULL, 0, 0),
(20, 36, 13, NULL, NULL, 0, 0),
(21, 37, 13, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
`id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `local_id` int(11) NOT NULL,
  `usuario_cadastro_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`id`, `nome`, `data_inicio`, `data_fim`, `descricao`, `local_id`, `usuario_cadastro_id`) VALUES
(1, 'Evento Teste', '2015-08-22 00:00:00', '2015-08-28 00:00:00', 'Evento de Teste E2f', 1, 1),
(2, 'Evento Teste 2 Alterado pelo FOS', '2015-08-14 00:00:00', '2015-08-28 00:00:00', 'Evento teste 2 Descricao', 1, 1),
(6, 'Flaviano', '2015-08-22 00:00:00', NULL, 'aaaaaaaaaaa', 1, 1),
(7, 'Teste com o novo Windows', '2015-08-21 00:00:00', NULL, 'Teste com o novo Windows', 1, 1),
(11, 'asdasdadasd', '2015-08-22 00:00:00', '2015-08-31 00:00:00', 'sadasds', 1, 3),
(12, 'teste', '2015-10-23 00:00:00', '2015-10-23 00:00:00', 'aasdasd', 1, 3),
(13, 'molina', '2015-10-14 00:00:00', '2015-10-21 00:00:00', 'asdasd', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE IF NOT EXISTS `funcao` (
`id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `ordem` varchar(5) NOT NULL DEFAULT '001',
  `poder_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`id`, `nome`, `ordem`, `poder_id`) VALUES
(1, 'Presidente', '001', 1),
(2, 'Advogado Geral da União', '002', 3),
(3, 'asdasd', 'asdsa', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_acesso`
--

CREATE TABLE IF NOT EXISTS `historico_acesso` (
`id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historico_acesso`
--

INSERT INTO `historico_acesso` (`id`, `data`, `usuario_id`) VALUES
(1, '2015-08-10 00:53:26', 1),
(2, '2015-08-10 00:55:47', 1),
(3, '2015-08-10 20:30:17', 1),
(4, '2015-08-10 21:16:40', 1),
(5, '2015-08-11 21:43:13', 1),
(6, '2015-08-16 10:27:59', 1),
(7, '2015-08-16 10:44:55', 1),
(8, '2015-08-17 00:25:32', 1),
(9, '2015-08-18 00:39:04', 1),
(10, '2015-08-18 21:41:40', 3),
(11, '2015-08-20 01:02:28', 1),
(12, '2015-08-20 21:05:46', 1),
(13, '2015-08-20 22:27:53', 1),
(14, '2015-08-21 11:41:28', 3),
(15, '2015-08-21 11:42:45', 3),
(16, '2015-08-21 11:43:07', 3),
(17, '2015-08-21 11:45:29', 3),
(18, '2015-08-21 11:45:41', 3),
(19, '2015-08-21 11:46:40', 3),
(20, '2015-08-21 12:24:42', 3),
(21, '2015-08-21 12:24:46', 3),
(22, '2015-08-21 12:25:13', 3),
(23, '2015-08-21 14:20:59', 3),
(24, '2015-08-21 16:17:25', 3),
(25, '2015-08-21 18:37:44', 3),
(26, '2015-08-21 18:37:50', 3),
(27, '2015-08-21 18:38:27', 3),
(28, '2015-08-21 18:39:18', 3),
(29, '2015-08-21 18:40:59', 3),
(30, '2015-09-24 16:46:23', 3),
(31, '2015-09-28 15:51:22', 3),
(32, '2015-09-28 15:51:51', 3),
(33, '2015-09-28 16:30:58', 3),
(34, '2015-09-28 17:19:58', 3),
(35, '2015-09-28 17:29:33', 3),
(36, '2015-09-28 17:30:55', 3),
(37, '2015-10-13 14:34:54', 3),
(38, '2015-10-14 15:27:09', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
`id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `cidade_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`id`, `nome`, `endereco`, `cidade_id`) VALUES
(1, 'Igreja Rainha da Paz', 'Canteiro Central do Eixo Monumental', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
`id` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ordem` char(5) NOT NULL DEFAULT '99999',
  `nome` varchar(85) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone_1` varchar(15) NOT NULL,
  `telefone_2` varchar(15) DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  `posto_graduacao_id` int(11) DEFAULT NULL,
  `funcao_id` int(11) NOT NULL,
  `usuario_cadastro_id` int(11) NOT NULL,
  `ativo` enum('0','1','','') NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `foto`, `ordem`, `nome`, `email`, `telefone_1`, `telefone_2`, `data_criacao`, `posto_graduacao_id`, `funcao_id`, `usuario_cadastro_id`, `ativo`) VALUES
(32, '5e3d4accb40e5b1ae6f7416727e69893.png', 'GGGGG', 'GGGGGGGGG', 'GGGGGG', 'GGGGGGGGGGGGGG', 'GGGGGGGGGGG', '2015-08-21 12:34:17', NULL, 2, 3, ''),
(33, '7cce188bef9036f7d194588276956273.jpeg', 'aaaaa', 'aaaaa', 'aaaaaaaa', '44', '444444', '2015-08-21 15:48:34', NULL, 1, 3, ''),
(34, NULL, '2', '2', '2', '2', '2', '2015-09-28 15:52:07', NULL, 1, 3, '1'),
(35, NULL, '3', '3', '3', '3', '3', '2015-09-28 15:52:16', NULL, 2, 3, '1'),
(36, NULL, '4', '4', '4', '4', '4', '2015-09-28 15:52:28', NULL, 2, 3, '1'),
(37, NULL, '5', '5', '5', '5', '5', '2015-09-28 15:52:35', NULL, 2, 3, '1'),
(38, NULL, '6', '6', '6', '6', '6', '2015-09-28 15:52:46', NULL, 2, 3, '1'),
(39, NULL, '8', '8', '8', '8', '8', '2015-09-28 15:52:54', NULL, 3, 3, '1'),
(40, NULL, '9', '9', '9', '9', '9', '2015-09-28 15:53:03', NULL, 2, 3, '1'),
(41, NULL, '10', '10', '10', '10', '10', '2015-09-28 15:53:18', NULL, 2, 3, '1'),
(42, NULL, '11', '11', '11', '11', '11', '2015-09-28 15:53:31', NULL, 2, 3, '1'),
(43, NULL, '12', '12', '12', '12', '12', '2015-09-28 15:53:46', NULL, 1, 3, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `poder`
--

CREATE TABLE IF NOT EXISTS `poder` (
`id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `poder`
--

INSERT INTO `poder` (`id`, `nome`) VALUES
(1, 'Executivo 2'),
(2, 'Legistativo'),
(3, 'Judiciário'),
(4, 'asdasdas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posto_graduacao`
--

CREATE TABLE IF NOT EXISTS `posto_graduacao` (
`id` int(11) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE IF NOT EXISTS `uf` (
`id` int(11) NOT NULL,
  `sigla` char(2) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `uf`
--

INSERT INTO `uf` (`id`, `sigla`, `nome`) VALUES
(1, 'DF', 'Distrito Federal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL,
  `perfil` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `data_cadastro`, `perfil`) VALUES
(1, 'Flaviano O Silva', 'fosbsb@gmail.com', 'd3426d47a74ac758a7167846d80ddcdc', 0, '2015-08-01 00:00:00', '0'),
(2, 'Eric Soares', 'ericsoaresd@gmail.com.br', 'd3426d47a74ac758a7167846d80ddcdc', 0, '2015-08-09 23:46:14', '1'),
(3, 'Francisco Molina', 'francisco.m.duarte@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '2015-08-10 21:15:17', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cidade_uf_idx` (`uf_id`);

--
-- Indexes for table `convidado`
--
ALTER TABLE `convidado`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `pessoa_id` (`pessoa_id`,`evento_id`), ADD KEY `fk_pessoa_has_evento_evento1_idx` (`evento_id`), ADD KEY `fk_pessoa_has_evento_pessoa1_idx` (`pessoa_id`), ADD KEY `fk_convidado_usuario1_idx` (`usuario_check_id`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_evento_local1_idx` (`local_id`), ADD KEY `fk_evento_usuario1_idx` (`usuario_cadastro_id`);

--
-- Indexes for table `funcao`
--
ALTER TABLE `funcao`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_funcao_poder1_idx` (`poder_id`);

--
-- Indexes for table `historico_acesso`
--
ALTER TABLE `historico_acesso`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_historico_acesso_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_local_cidade1_idx` (`cidade_id`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pessoa_posto_graduacao1_idx` (`posto_graduacao_id`), ADD KEY `fk_pessoa_funcao1_idx` (`funcao_id`), ADD KEY `fk_pessoa_usuario1_idx` (`usuario_cadastro_id`);

--
-- Indexes for table `poder`
--
ALTER TABLE `poder`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posto_graduacao`
--
ALTER TABLE `posto_graduacao`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uf`
--
ALTER TABLE `uf`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sigla_UNIQUE` (`sigla`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `convidado`
--
ALTER TABLE `convidado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `historico_acesso`
--
ALTER TABLE `historico_acesso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `local`
--
ALTER TABLE `local`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `poder`
--
ALTER TABLE `poder`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posto_graduacao`
--
ALTER TABLE `posto_graduacao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `uf`
--
ALTER TABLE `uf`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
ADD CONSTRAINT `fk_cidade_uf` FOREIGN KEY (`uf_id`) REFERENCES `uf` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `convidado`
--
ALTER TABLE `convidado`
ADD CONSTRAINT `fk_convidado_usuario1` FOREIGN KEY (`usuario_check_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pessoa_has_evento_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pessoa_has_evento_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
ADD CONSTRAINT `fk_evento_local1` FOREIGN KEY (`local_id`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_evento_usuario1` FOREIGN KEY (`usuario_cadastro_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcao`
--
ALTER TABLE `funcao`
ADD CONSTRAINT `fk_funcao_poder1` FOREIGN KEY (`poder_id`) REFERENCES `poder` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historico_acesso`
--
ALTER TABLE `historico_acesso`
ADD CONSTRAINT `fk_historico_acesso_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `local`
--
ALTER TABLE `local`
ADD CONSTRAINT `fk_local_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
ADD CONSTRAINT `fk_pessoa_funcao1` FOREIGN KEY (`funcao_id`) REFERENCES `funcao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pessoa_posto_graduacao1` FOREIGN KEY (`posto_graduacao_id`) REFERENCES `posto_graduacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pessoa_usuario1` FOREIGN KEY (`usuario_cadastro_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
