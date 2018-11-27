-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26-Nov-2018 às 09:38
-- Versão do servidor: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jach`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluguer`
--

CREATE TABLE IF NOT EXISTS `aluguer` (
  `id` int(11) NOT NULL COMMENT 'Id do Aluguer',
  `numeroAcompanhantes` tinyint(4) NOT NULL COMMENT 'Número de Acompanhantes que o Hospede levou para o seu quarto',
  `dataCheckOut` date NOT NULL COMMENT 'Data de Check-Out',
  `idHospede` int(11) NOT NULL COMMENT 'Id do Hospede que está alugado',
  `idQuarto` int(11) NOT NULL COMMENT 'Id do Quarto alugado',
  `palavraPasse` varchar(535) NOT NULL COMMENT 'Password do aluguer'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Aluguer é criado num Check-in (é a estadia de um cliente hospedado no hotel)';

--
-- Extraindo dados da tabela `aluguer`
--

INSERT INTO `aluguer` (`id`, `numeroAcompanhantes`, `dataCheckOut`, `idHospede`, `idQuarto`, `palavraPasse`) VALUES
(1, 1, '2018-11-30', 1, 1, '12345');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotografia`
--

CREATE TABLE IF NOT EXISTS `fotografia` (
  `id` int(11) NOT NULL COMMENT 'Id da Fotografia',
  `caminho` varchar(535) NOT NULL COMMENT 'Caminho do ficheiro da fotografia',
  `idTipoQuarto` int(11) NOT NULL COMMENT 'Id do Tipo de Quarto ao qual a Fotografia está relacionada'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='Fotografias dos tipos de quartos';

--
-- Extraindo dados da tabela `fotografia`
--

INSERT INTO `fotografia` (`id`, `caminho`, `idTipoQuarto`) VALUES
(1, '/img/quartoMedio.jpg', 2),
(2, '/img/quartoMedio2.jpg', 2),
(3, '/img/quartoMedio3.jpg', 2),
(4, '/img/quartoPequeno.jpg', 1),
(5, '/img/quartoPequeno2.jpg', 1),
(6, '/img/quartoPequeno3.jpg', 1),
(15, '/img/quartoGrande.jpg', 3),
(16, '/img/quartoGrande2.jpg', 3),
(17, '/img/quartoGrande3.jpg', 3),
(18, '/img/quartoGrande4.jpg', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hospede`
--

CREATE TABLE IF NOT EXISTS `hospede` (
  `id` int(11) NOT NULL COMMENT 'Id do Hospede',
  `nome` varchar(50) NOT NULL COMMENT 'Nome do Hospede',
  `apelido` varchar(50) NOT NULL COMMENT 'Apelido do Hospede',
  `numeroContribuinte` int(11) DEFAULT NULL COMMENT 'Número de Contribuinte do Hospede',
  `numeroTelemovel` int(11) NOT NULL COMMENT 'Número de Telemóvel do Hospede'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Hospede que já esteve hospedado pelo menos 1 vez no hotel';

--
-- Extraindo dados da tabela `hospede`
--

INSERT INTO `hospede` (`id`, `nome`, `apelido`, `numeroContribuinte`, `numeroTelemovel`) VALUES
(1, 'Hélder', 'Carvalho', 123456789, 987654321);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL COMMENT 'Id do Produto',
  `nome` int(11) NOT NULL COMMENT 'Nome do Produto',
  `preco` float NOT NULL COMMENT 'Preço do Produto',
  `idSeccao` int(11) NOT NULL COMMENT 'Id da Secção à qual este produto pertence'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Produto que pode ser vendido';

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtoAluguer`
--

CREATE TABLE IF NOT EXISTS `produtoAluguer` (
  `id` int(11) NOT NULL COMMENT 'Id da Transação',
  `quantidade` int(11) NOT NULL COMMENT 'Quantidade vendida do produto',
  `idAluguer` int(11) NOT NULL COMMENT 'Id do Aluguer ao qual a transação está relacionada',
  `idProduto` int(11) NOT NULL COMMENT 'Id do Produto ao qual a Transação está relacionada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quarto`
--

CREATE TABLE IF NOT EXISTS `quarto` (
  `id` int(11) NOT NULL COMMENT 'Id do Quarto',
  `idTipoQuarto` int(11) NOT NULL COMMENT 'Id do Tipo de Quarto ao qual este Quarto pertence'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='Quarto';

--
-- Extraindo dados da tabela `quarto`
--

INSERT INTO `quarto` (`id`, `idTipoQuarto`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 2),
(19, 2),
(18, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL COMMENT 'Id da Reserva',
  `nome` varchar(50) NOT NULL COMMENT 'Nome de quem reservou',
  `apelido` varchar(50) NOT NULL COMMENT 'Apelido de quem resrvou',
  `numeroTelemovel` int(11) NOT NULL COMMENT 'Número de Telemóvel de quem reservou',
  `numeroAcompanhantes` tinyint(4) NOT NULL COMMENT 'Numero de acompanhares que quem reservou vái levar para o seu quarto',
  `dataCheckIn` date NOT NULL COMMENT 'Data de Check-in',
  `dataCheckOut` date NOT NULL COMMENT 'Data de Check-Out',
  `idTipoQuarto` int(11) NOT NULL COMMENT 'Id do Tipo de Quarto reservado'
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COMMENT='Reserva de quarto';

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id`, `nome`, `apelido`, `numeroTelemovel`, `numeroAcompanhantes`, `dataCheckIn`, `dataCheckOut`, `idTipoQuarto`) VALUES
(1, 'carlos', 'simoes', 989789887, 0, '2018-11-01', '2018-11-10', 1),
(2, 'carlos2', 'simoes2', 989789887, 0, '2018-11-02', '2018-11-11', 1),
(3, 'Atum', 'simoes', 989789887, 0, '2018-11-03', '2018-11-12', 1),
(4, 'sa', 'ad', 123456789, 1, '2018-11-04', '2018-11-13', 1),
(5, 'wq', 'd', 1289, 2, '2018-11-05', '2018-11-14', 1),
(6, 'sdf', 'fds', 34, 2, '2018-11-06', '2018-11-15', 1),
(7, 'feds', 'sdf', 32423, 2, '2018-11-07', '2018-11-16', 1),
(8, 'wedfvs', 'dfsvsd', 2323, 1, '2018-11-08', '2018-11-17', 1),
(9, 'dsvaa', 'efasa', 2323, 1, '2018-11-09', '2018-11-18', 1),
(10, 'dsfveas', 'vsdav sad', 12312, 1, '2018-11-10', '2018-11-19', 1),
(11, 'sdvasa', 'vasvs', 234234, 1, '2018-11-11', '2018-11-20', 1),
(12, 'avssdcfcz', 'sdvfdsvz', 1, 1, '2018-11-12', '2018-11-21', 1),
(13, 'dsvfdsac', 'dsfsf', 1231, 1, '2018-11-13', '2018-11-22', 1),
(14, 'sdfasdc', 'sdfvszadf', 234234, 1, '2018-11-14', '2018-11-23', 1),
(15, 'sdfadfsf', 'sdafafa', 132213, 1, '2018-11-15', '2018-11-24', 1),
(49, 'tone', 'toninho', 123123123, 3, '2018-11-10', '2018-11-15', 1),
(50, 'carlos', '312312', 98988989, 2, '2018-11-29', '2018-11-30', 1),
(51, 'carlos', '312312', 98988989, 2, '2018-11-29', '2018-11-30', 1),
(52, 'carlos', '312312', 98988989, 2, '2018-11-29', '2018-11-30', 1),
(53, 'carlos', '312312', 98988989, 2, '2018-11-29', '2018-11-30', 1),
(54, 'carlos', '312312', 98988989, 2, '2018-11-29', '2018-11-30', 1),
(55, 'wdqwd', 'qwdqwd', 0, 1, '2018-11-23', '2018-11-30', 1),
(56, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-28', '2018-11-30', 1),
(57, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-28', '2018-11-30', 1),
(58, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(59, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(60, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(61, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(62, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(63, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(64, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(65, 'Carlos', 'qwdqwd', 123123, 1, '2018-11-20', '2018-11-28', 1),
(86, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(87, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(88, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(89, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(90, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(91, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(92, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(93, 'Carlinhos', 'Simoesinho', 123456789, 2, '2018-11-29', '2018-11-30', 1),
(94, 'hugo', '2312313', 2147483647, 3, '2018-11-29', '2018-11-30', 2),
(95, 'ascasca', 'e1e12e1', 123123, 1, '2018-11-27', '2018-11-30', 2),
(96, '2werty', 'werty', 2345676, 3, '2018-11-01', '2018-11-30', 3),
(97, '2werty', 'werty', 2345676, 3, '2018-12-01', '2018-12-23', 3),
(98, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(99, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(100, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(101, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(102, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(103, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(104, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(105, 'carlitos', 'carlitos', 2147483647, 2, '2018-11-01', '2018-11-08', 1),
(106, 'carlitos', 'carlitos', 789456123, 2, '2018-11-01', '2018-11-08', 2),
(107, 'carlitos', 'carlitos', 789456123, 2, '2018-11-01', '2018-11-08', 2),
(108, 'carlitos', 'carlitos', 789456123, 3, '2018-12-24', '2018-12-25', 3),
(109, 'qwew', 'qwe', 789, 2, '2018-11-27', '2018-11-28', 2),
(110, 'weg', 'wert', 0, 1, '2018-11-15', '2018-11-21', 2),
(111, '324565', '3456', 324354675, 3, '2018-11-22', '2018-11-22', 2),
(112, '324565', '3456', 324354675, 3, '2018-11-22', '2018-11-22', 2),
(113, 'wqewqe', '123123', 213123, 3, '2019-01-01', '2019-01-02', 1),
(114, 'qwertyuio', 'qwertyuio', 789456123, 3, '2019-01-01', '2019-01-02', 3),
(115, 'qwertyuio', 'qwertyui', 789456123, 3, '2019-01-03', '2019-01-04', 3),
(116, 'Joao', 'Carvalho', 987654321, 3, '2019-01-05', '2019-01-06', 3),
(117, 'wdet', 'werty', 0, 2, '2019-01-01', '2019-01-04', 1),
(118, 'helder', 'qwdqwd', 0, 2, '2019-01-01', '2019-01-04', 1),
(119, '2we34rt5y6', '342567', 2147483647, 3, '2019-01-15', '2019-01-18', 3),
(120, 'qwdqwd', '13123', 0, 2, '2019-01-19', '2019-01-20', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seccao`
--

CREATE TABLE IF NOT EXISTS `seccao` (
  `id` int(11) NOT NULL COMMENT 'Id de Secção de Produtos',
  `nome` varchar(50) NOT NULL COMMENT 'Nome da Secção'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Secção de Produtos (conjunto de produtos)';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoQuarto`
--

CREATE TABLE IF NOT EXISTS `tipoQuarto` (
  `id` int(11) NOT NULL COMMENT 'Id do Tipo de Quarto',
  `nome` varchar(50) NOT NULL COMMENT 'Nome do Tipo de Quarto',
  `descricao` text NOT NULL COMMENT 'Descrição do tipo de quarto'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Tipo de Quarto (é a categoria do quarto)';

--
-- Extraindo dados da tabela `tipoQuarto`
--

INSERT INTO `tipoQuarto` (`id`, `nome`, `descricao`) VALUES
(1, 'Quarto Pequeno', 'Quarto pequeno'),
(2, 'Quarto Medio', 'Quarto medio'),
(3, 'Quarto Grande', 'Quarto muito grande');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluguer`
--
ALTER TABLE `aluguer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idHospede` (`idHospede`),
  ADD KEY `idQuarto` (`idQuarto`);

--
-- Indexes for table `fotografia`
--
ALTER TABLE `fotografia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipoQuarto` (`idTipoQuarto`);

--
-- Indexes for table `hospede`
--
ALTER TABLE `hospede`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSeccao` (`idSeccao`);

--
-- Indexes for table `produtoAluguer`
--
ALTER TABLE `produtoAluguer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAluguer` (`idAluguer`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Indexes for table `quarto`
--
ALTER TABLE `quarto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipoQuarto` (`idTipoQuarto`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipoQuarto` (`idTipoQuarto`);

--
-- Indexes for table `seccao`
--
ALTER TABLE `seccao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoQuarto`
--
ALTER TABLE `tipoQuarto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluguer`
--
ALTER TABLE `aluguer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Aluguer',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fotografia`
--
ALTER TABLE `fotografia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da Fotografia',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `hospede`
--
ALTER TABLE `hospede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Hospede',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Produto';
--
-- AUTO_INCREMENT for table `produtoAluguer`
--
ALTER TABLE `produtoAluguer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da Transação';
--
-- AUTO_INCREMENT for table `quarto`
--
ALTER TABLE `quarto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Quarto',AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da Reserva',AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `seccao`
--
ALTER TABLE `seccao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de Secção de Produtos';
--
-- AUTO_INCREMENT for table `tipoQuarto`
--
ALTER TABLE `tipoQuarto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Tipo de Quarto',AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluguer`
--
ALTER TABLE `aluguer`
  ADD CONSTRAINT `fk_aluguer_cliente` FOREIGN KEY (`idHospede`) REFERENCES `hospede` (`id`),
  ADD CONSTRAINT `fk_aluguer_quarto` FOREIGN KEY (`idQuarto`) REFERENCES `quarto` (`id`);

--
-- Limitadores para a tabela `fotografia`
--
ALTER TABLE `fotografia`
  ADD CONSTRAINT `fk_fotografia_tipoQuarto` FOREIGN KEY (`idTipoQuarto`) REFERENCES `tipoQuarto` (`id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_seccao` FOREIGN KEY (`idSeccao`) REFERENCES `seccao` (`id`);

--
-- Limitadores para a tabela `produtoAluguer`
--
ALTER TABLE `produtoAluguer`
  ADD CONSTRAINT `fk_produtoAluguer_aluguer` FOREIGN KEY (`idAluguer`) REFERENCES `aluguer` (`id`),
  ADD CONSTRAINT `fk_produtoAluguer_produto` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `quarto`
--
ALTER TABLE `quarto`
  ADD CONSTRAINT `fk_quarto_TipoQuarto` FOREIGN KEY (`idTipoQuarto`) REFERENCES `tipoQuarto` (`id`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_TipoQuarto` FOREIGN KEY (`idTipoQuarto`) REFERENCES `tipoQuarto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
