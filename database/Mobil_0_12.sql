-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2017 às 00:00
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `refil`
--

CREATE TABLE `refil` (
  `id` int(99) NOT NULL,
  `reservatorio` int(99) NOT NULL,
  `horimetro` int(99) NOT NULL,
  `horimetro_anterior` int(99) DEFAULT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  `graxa_adicionada` int(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `refil`
--

INSERT INTO `refil` (`id`, `reservatorio`, `horimetro`, `horimetro_anterior`, `data`, `graxa_adicionada`) VALUES
(13, 2, 2100, 1, '2017-09-10 18:13:58', 0),
(14, 2, 3950, 3950, '2017-09-10 18:15:00', 20790);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservatorios`
--

CREATE TABLE `reservatorios` (
  `id` int(99) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `capacidade` int(99) DEFAULT NULL,
  `horimetro` int(99) DEFAULT NULL,
  `horimetro_abastecimento` int(99) DEFAULT NULL,
  `consumo` int(99) DEFAULT NULL,
  `autonomia` int(99) DEFAULT NULL,
  `user` int(99) NOT NULL,
  `ultima_atualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reservatorios`
--

INSERT INTO `reservatorios` (`id`, `titulo`, `capacidade`, `horimetro`, `horimetro_abastecimento`, `consumo`, `autonomia`, `user`, `ultima_atualizacao`) VALUES
(1, 'CM4027', 27000, 3400, 1334, NULL, 2400, 2, '2017-09-11 20:25:03'),
(2, 'CM4014', 27000, 5300, 3950, NULL, 2400, 2, '2017-09-11 20:24:18'),
(5, 'CM4032', 27000, 14100, 12740, NULL, 2400, 2, '2017-09-11 20:24:28'),
(6, 'CM4011', 27000, 12500, 12323, NULL, 2400, 2, '2017-09-11 20:24:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `cargo`, `setor`, `nome`) VALUES
(1, 'alfenido', '56582e58b3fafd9b052ffff40023a117', NULL, '', '', ''),
(2, 'admin', '698dc19d489c4e4db73e28a713eab07b', 'admin@gmai.com', '', '', ''),
(3, 'Usuario', '7c49a85109a7a12890bcfbd6769bc300', 'Email', 'Cargo', 'Setor', 'Nome'),
(4, 'admin123', '0192023a7bbd73250516f069df18b500', 'Email', 'Cargo', 'Setor', 'Nome');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refil`
--
ALTER TABLE `refil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservatorios`
--
ALTER TABLE `reservatorios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refil`
--
ALTER TABLE `refil`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `reservatorios`
--
ALTER TABLE `reservatorios`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
