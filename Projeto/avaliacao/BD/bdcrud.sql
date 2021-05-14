-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Maio-2021 às 05:58
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

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
  `dp_servico` varchar(100) NOT NULL,
  `dp_valor` decimal(10,0) NOT NULL,
  `dp_local` varchar(100) NOT NULL,
  `dp_data` date NOT NULL,
  `dp_viagem` varchar(50) NOT NULL,
  `dp_form_pagamento` varchar(10) NOT NULL
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
(1, 'admin', '$2y$10$0IaXa67wfzZKUMuea/PJhOI8GaKO6JbUkcYiGTGv3j6URTd9zBJZm', 'admin', 'admin@domain.com'),
(3, 'admin1', '$2y$10$kPAGwPg049lGkP1ctLnUBuAjDA8oPDEsS6QkARMb20dauuaDRGN.K', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `id_viagens` int(11) NOT NULL,
  `vg_destino` varchar(100) NOT NULL,
  `vg_dsaida` date NOT NULL,
  `vg_dretorno` date NOT NULL,
  `vg_servico` varchar(100) NOT NULL,
  `vg_funcionario` varchar(50) NOT NULL,
  `vg_valorIn` decimal(10,0) NOT NULL,
  `vg_realizada` varchar(20) NOT NULL,
  `vg_motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `viagens`
--

INSERT INTO `viagens` (`id_viagens`, `vg_destino`, `vg_dsaida`, `vg_dretorno`, `vg_servico`, `vg_funcionario`, `vg_valorIn`, `vg_realizada`, `vg_motivo`) VALUES
(1, 'teste', '0000-00-00', '3111-12-12', 'teste', 'teste', '12', 'teste', 'teste');

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
  MODIFY `id_viagens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
