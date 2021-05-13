-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Maio-2021 às 13:41
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdcrud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id_despesas` int(11) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `local` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `viagem` varchar(50) NOT NULL,
  `form_pagamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `password_hash`, `user_full_name`, `user_email`) VALUES
(1, 'admin', '$2y$10$mjs0xu0h6aeh7ynUVyBryOjwS/pRYrr72xNKPD3/PXkJfGKHQ0r62', 'Udemy', 'admin@domain.com'),
(3, 'admin1', '$2y$10$kPAGwPg049lGkP1ctLnUBuAjDA8oPDEsS6QkARMb20dauuaDRGN.K', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `id_viagens` int(11) NOT NULL,
  `local` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `servico` varchar(100) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id_despesas`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices para tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`id_viagens`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id_despesas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `id_viagens` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
