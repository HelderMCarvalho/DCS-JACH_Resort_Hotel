-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 27-Nov-2018 às 22:37
-- Versão do servidor: 5.6.37
-- PHP Version: 7.1.8

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
(1, 1, '2018-11-30', 1, 1, '$2y$10$E7yp63AmNQJLVbuXybUwY.MUSpqVno/K42xcSNuZzLY5GmP1BqUqe');

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
  `nome` varchar(50) NOT NULL COMMENT 'Nome do Produto',
  `preco` float NOT NULL COMMENT 'Preço do Produto',
  `idSeccao` int(11) NOT NULL COMMENT 'Id da Secção à qual este produto pertence'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Produto que pode ser vendido';

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `preco`, `idSeccao`) VALUES
(1, 'Limpeza', 10, 1),
(2, 'Almoço', 10, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtoAluguer`
--

CREATE TABLE IF NOT EXISTS `produtoAluguer` (
  `id` int(11) NOT NULL COMMENT 'Id da Transação',
  `quantidade` int(11) NOT NULL COMMENT 'Quantidade vendida do produto',
  `data` date NOT NULL COMMENT 'Data da venda do produto',
  `idAluguer` int(11) NOT NULL COMMENT 'Id do Aluguer ao qual a transação está relacionada',
  `idProduto` int(11) NOT NULL COMMENT 'Id do Produto ao qual a Transação está relacionada'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtoAluguer`
--

INSERT INTO `produtoAluguer` (`id`, `quantidade`, `data`, `idAluguer`, `idProduto`) VALUES
(1, 1, '2018-11-27', 1, 1),
(2, 2, '2018-11-28', 1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='Reserva de quarto';

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id`, `nome`, `apelido`, `numeroTelemovel`, `numeroAcompanhantes`, `dataCheckIn`, `dataCheckOut`, `idTipoQuarto`) VALUES
(1, 'teste', '1', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(2, 'teste', '2', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(3, 'teste', '3', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(4, 'teste', '4', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(5, 'teste', '5', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(6, 'teste', '6', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(7, 'teste', '7', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(8, 'teste', '8', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(9, 'teste', '9', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(10, 'teste', '10', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(11, 'teste', '11', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(12, 'teste', '12', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(13, 'teste', '13', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(14, 'teste', '14', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(15, 'teste', '15', 123456789, 1, '2018-11-27', '2018-11-30', 1),
(18, 'teste', '16', 123456789, 1, '2018-11-27', '2018-11-30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seccao`
--

CREATE TABLE IF NOT EXISTS `seccao` (
  `id` int(11) NOT NULL COMMENT 'Id de Secção de Produtos',
  `nome` varchar(50) NOT NULL COMMENT 'Nome da Secção'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Secção de Produtos (conjunto de produtos)';

--
-- Extraindo dados da tabela `seccao`
--

INSERT INTO `seccao` (`id`, `nome`) VALUES
(1, 'Quarto'),
(2, 'Restaurante');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Produto',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produtoAluguer`
--
ALTER TABLE `produtoAluguer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da Transação',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quarto`
--
ALTER TABLE `quarto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Quarto',AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da Reserva',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `seccao`
--
ALTER TABLE `seccao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de Secção de Produtos',AUTO_INCREMENT=3;
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
