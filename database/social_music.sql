-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Out-2022 às 20:58
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
  `avatar` varchar(400) NOT NULL,
  `role` varchar(12) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `avatar`, `role`) VALUES
(10, 'Allan Gabriel', 'allangabriel@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'https://avatars.githubusercontent.com/u/104521672?v=4', 'client'),
(11, 'Breno Machado', 'brenomachado@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'https://avatars.githubusercontent.com/u/101892969?v=4', 'client'),
(12, 'Micaella Larissa', 'micaellalarissa@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'https://avatars.githubusercontent.com/u/110495667?v=4', 'client'),
(13, 'Renan Cavichi', 'renancavichi@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'https://avatars.githubusercontent.com/u/4259630?v=4', 'client'),
(14, 'Vítor Ambrizzi', 'vitorambrizzi@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'https://avatars.githubusercontent.com/u/54189051?v=4', 'client admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
