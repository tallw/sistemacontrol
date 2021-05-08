-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 07/05/2021 às 19h21min
-- Versão do Servidor: 5.5.54
-- Versão do PHP: 5.3.10-1ubuntu3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `db_blog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE IF NOT EXISTS `ordem` (
  `id_ordem` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario` varchar(100) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `dataser` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `horaInicio` time NOT NULL,
  `horaFim` time NOT NULL,
  `detalhe` text NOT NULL,
  `fk_id_ordem` int(11) NOT NULL,
  PRIMARY KEY (`id_ordem`),
  KEY `fk_id_ordem` (`fk_id_ordem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`id_ordem`, `funcionario`, `quantidade`, `dataser`, `horaInicio`, `horaFim`, `detalhe`, `fk_id_ordem`) VALUES
(3, 'joao de deus', 1, '2021-05-05 16:40:02', '15:00:00', '15:16:00', 'asasass', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` float NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_servico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `descricao`, `valor`, `status`) VALUES
(1, 'Inspeção', 1500, 'Ativo'),
(2, 'Instalação', 150, 'Ativo'),
(3, 'Instalacao de ar', 150, 'Ativo');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `ordem`
--
ALTER TABLE `ordem`
  ADD CONSTRAINT `ordem_ibfk_1` FOREIGN KEY (`fk_id_ordem`) REFERENCES `servico` (`id_servico`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
