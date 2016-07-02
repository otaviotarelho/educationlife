-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2012 at 10:53 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `amizade`
--

CREATE TABLE IF NOT EXISTS `amizade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `amizade`
--

INSERT INTO `amizade` (`id`, `de`, `para`, `status`) VALUES
(10, 2, 3, 1),
(21, 1, 2, 1),
(22, 1, 3, 1),
(39, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `audio1`
--

CREATE TABLE IF NOT EXISTS `audio1` (
  `id` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `tipo` int(11) NOT NULL,
  `onde` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topico` int(11) NOT NULL,
  `inst` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `adicionado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `imagem`
--

CREATE TABLE IF NOT EXISTS `imagem` (
  `id` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `tipo` int(11) NOT NULL,
  `onde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(140) NOT NULL,
  `usermaster` int(11) NOT NULL,
  `imagem` varchar(140) NOT NULL,
  `cadastro` date NOT NULL,
  `status` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `instituicao`
--

INSERT INTO `instituicao` (`id`, `nome`, `descricao`, `usermaster`, `imagem`, `cadastro`, `status`, `nivel`) VALUES
(1, 'ETEC Cubatão', 'Escola de Nível Técnico do Estado de São Paulo', 4, 'default.png', '2012-10-22', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membros`
--

CREATE TABLE IF NOT EXISTS `membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `de` (`de`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `membros`
--

INSERT INTO `membros` (`id`, `de`, `para`, `status`, `tipo`) VALUES
(7, 5, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `para` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `postagem`
--

CREATE TABLE IF NOT EXISTS `postagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `de` int(11) NOT NULL,
  `onde` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `postagem`
--

INSERT INTO `postagem` (`id`, `de`, `onde`, `comentario`, `status`, `posted`) VALUES
(1, 5, 22, 'Testando eu', 0, '2012-11-17 01:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `topicos`
--

CREATE TABLE IF NOT EXISTS `topicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `id_inst` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `conteudo` longtext NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `tipo` int(11) NOT NULL,
  `adicionado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `topicos`
--

INSERT INTO `topicos` (`id`, `nome`, `id_inst`, `id_autor`, `conteudo`, `descricao`, `tipo`, `adicionado`) VALUES
(4, 'Add new topics', 1, 5, 'This is the way to add a new topic', 'How to add new topics on EducationLife', 0, '2012-11-17 02:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `por` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `por`, `text`, `type`, `posted`) VALUES
(2, 4, 'OlÃ¡ mundo', 0, '2012-10-19 12:08:59'),
(3, 4, 'Sim', 0, '2012-10-19 12:36:50'),
(4, 4, 'teste', 0, '2012-10-19 12:36:54'),
(5, 4, 'teste\r\n', 0, '2012-10-19 12:37:00'),
(7, 5, 'Testando o sistema de postagem', 0, '2012-10-19 12:44:58'),
(9, 5, 'Aprovado? Sim/N', 0, '2012-10-19 12:47:58'),
(10, 5, 'Projeto Education Life', 0, '2012-10-19 12:48:17'),
(12, 5, 'YAGO ESTEVE AQUI!!!!!!', 0, '2012-10-19 14:00:47'),
(13, 5, 'CLICK IDEIA Ã‰ ....', 0, '2012-10-19 14:16:20'),
(14, 5, 'Lais e Laisa estiveram aqui!', 0, '2012-10-19 14:25:27'),
(15, 5, 'FREE STEP SZ..', 0, '2012-10-19 15:17:11'),
(16, 5, 'FREE STEP SZ..', 0, '2012-10-19 15:23:41'),
(17, 5, 'LetÃ­cia e Larissa estiveram aqui', 0, '2012-10-19 15:23:54'),
(18, 5, 'Boa sorte....... ', 0, '2012-10-19 15:33:06'),
(19, 5, 'Patrick Reis esteve aqui\r\n', 0, '2012-10-19 15:35:09'),
(20, 5, 'passem na sala 5 e deem uma olhada no projeto Saluti....Renata\r\n', 0, '2012-10-19 15:43:17'),
(21, 5, 'vote coco sustentÃ¡vel ;* ', 0, '2012-10-19 16:02:21'),
(22, 5, 'Trilha para o PerequÃª, com o Projeto ConexÃ£o logÃ­stica Verde.. R$10,00.. Procurar na sala 02!!!!!!!!! Curtam facebook/projetoecoturistico ', 0, '2012-10-19 16:21:31'),
(23, 5, 'vote no projeto ao lado...!!', 0, '2012-10-19 16:27:01'),
(24, 5, 'Vote no EDUCATION LIFE!!!!!!!!!!!!!!!!!!', 0, '2012-10-19 17:33:11'),
(25, 5, 'OI VOTEM AKI !!!!', 0, '2012-10-19 18:47:53'),
(26, 5, 'PROF. CLAUDIO TEIXEIRA\r\n', 0, '2012-10-19 19:40:15'),
(27, 5, 'VOTE COCO SUSTENTÃVEL', 0, '2012-10-19 19:47:34'),
(28, 5, 'Larissa ESTEVE AQUI', 0, '2012-10-19 20:40:03'),
(29, 5, 'Robson Escotiel has been  here!', 0, '2012-10-19 21:39:08'),
(30, 5, 'DEIVISON ESTEVE AKI!!!!!!!!!!!!!!', 0, '2012-10-19 22:14:21'),
(32, 5, 'teste', 0, '2012-10-19 23:44:39'),
(33, 5, 'Calculo ', 0, '2012-10-19 23:44:52'),
(35, 4, 'thainÃ¡ linda', 0, '2012-10-26 21:44:25'),
(36, 4, 'thainÃ¡ linda', 0, '2012-10-26 21:44:48'),
(37, 4, 'olá mundo\r\n', 0, '2012-11-28 13:11:46'),
(38, 4, 'ola mundo', 0, '2012-11-28 13:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `sobrenome` varchar(64) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `imagem` varchar(128) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `cadastro` date NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `sobrenome`, `nascimento`, `sexo`, `imagem`, `status`, `cadastro`, `nivel`) VALUES
(1, 'gilglecio_765@hotmail.com', 'effd4619301d732cef4a84f6df23d7dd54090620', 'gilglecio', 'santos', '2002-10-10', 'feminino', '104.jpg', 0, '2011-10-26', 0),
(2, 'roberto@hotmail.com', 'effd4619301d732cef4a84f6df23d7dd54090620', 'roberto', 'silva santos', '2011-01-01', 'masculino', '254.jpg', 0, '2011-10-26', 0),
(3, 'anapaula@hotmail.com', 'effd4619301d732cef4a84f6df23d7dd54090620', 'ana paula', 'francisca', '2011-01-01', 'masculino', '331.jpg', 0, '2011-10-26', 0),
(4, 'otavio_ramos_nobrega@hotmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Otavio', 'Ramos Tarelho de Barros', '2012-01-16', 'masculino', '4.png', 0, '2012-10-07', 0),
(5, 'wadsongomes@hotmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Wadson', 'Gomes', '1986-10-03', 'Masculino', '7.png', 0, '2012-10-08', 0),
(7, 'paulovicente@hotmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Paulo Vicente', 'Paulo Vicente', '2012-11-19', 'masculino', 'default.png', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `tipo` int(11) NOT NULL,
  `onde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
