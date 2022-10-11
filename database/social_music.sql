-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2022 às 19:37
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `social_music`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(256) NOT NULL,
  `client` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `avatar` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `avatar`) VALUES
(4, 'Renan Cavichi', 'renancavichi@gmail.com', 'a13fec1deb7c2308fbecf7b2698ecf93413c52e3', 'https://avatars.githubusercontent.com/u/4259630?v=4'),
(5, 'Vitor Ambrizzi', 'ambrizzivitor@gmail.com', 'fc683af1f7957ebc4dcb77738ab688b5dd84881a', 'https://avatars.githubusercontent.com/u/54189051?v=4'),
(6, 'Allan Gabriel', 'allangabriel@gmail.com', 'dfd68fe9fd793aa349622bf9ef05b39de5a36baa', 'https://avatars.githubusercontent.com/u/104521672?v=4'),
(7, 'Breno Machado', 'brenomachado@gmail.com', '245a72e7d46b8620df10255ec5bb00b79893dc28', 'https://avatars.githubusercontent.com/u/101892969?v=4'),
(8, 'Micaella Larissa', 'micaellalarissa@gmail.com', 'd6f603bec82af995a0df85f02b6407e57f23dcaf', 'https://avatars.githubusercontent.com/u/110495667?v=4');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_session_id_users` (`id_user`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `id_user_session_id_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
