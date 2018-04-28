-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Mar-2018 às 04:20
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viagem1.0`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `udpated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `description`, `created_at`, `udpated_at`) VALUES
(1, 'Paraguai', NULL, NULL),
(2, 'Argentina', NULL, NULL),
(3, 'Puerto Iguazú', NULL, NULL),
(4, 'Ciudad del Este', NULL, NULL),
(5, 'São Paulo', NULL, NULL),
(6, 'Três Coroas', NULL, NULL),
(7, 'Templo Budista', NULL, NULL),
(8, 'Foz do Iguaçu', NULL, NULL),
(9, 'Rio de Janeiro', NULL, NULL),
(10, 'Praia', NULL, NULL),
(11, 'Santa Catarina', NULL, NULL),
(12, 'Curitiba', NULL, NULL),
(13, 'Trilha', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `data` date DEFAULT NULL,
  `cities_id` int(11) DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  `feature` char(1) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `tip` char(1) DEFAULT NULL,
  `imgdefault` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`, `data`, `cities_id`, `active`, `feature`, `views`, `tip`, `imgdefault`) VALUES
(32, 'Compras', NULL, '2018-03-10 00:38:12', '2018-03-10 02:39:57', NULL, NULL, 'S', 'S', 1, NULL, 'efd6a727f428a556bbe84a184df22339.jpg'),
(33, 'Foz do Iguaçu', NULL, '2018-03-10 01:19:24', '2018-03-10 01:59:57', NULL, NULL, 'S', 'S', 1, NULL, '56166ffc83c5b38a6cc44f3808399bcf.jpg'),
(34, 'Foz do Iguaçu', NULL, '2018-03-10 01:19:24', '2018-03-10 01:19:24', NULL, NULL, 'S', 'S', NULL, NULL, '56166ffc83c5b38a6cc44f3808399bcf.jpg'),
(35, 'Foz do Iguaçu', NULL, '2018-03-10 01:19:25', '2018-03-10 01:19:25', NULL, NULL, 'S', 'S', NULL, NULL, 'bd662d0376de030e05798f4f71ab54de.jpg'),
(36, 'Foz do Iguaçu', NULL, '2018-03-10 01:20:27', '2018-03-10 01:20:27', NULL, NULL, 'S', 'S', NULL, NULL, '28522f1ff25707e074bc6ee7c5166cc2.jpg'),
(37, 'Cambará do Sul', NULL, '2018-03-10 02:36:49', '2018-03-10 02:36:49', NULL, NULL, 'S', 'S', NULL, NULL, 'cf87b14d5ee0e5cd8d468fcea1683029.jpg'),
(38, 'Templo Budista de Foz do Iguaçu', NULL, '2018-03-10 02:51:22', '2018-03-10 02:52:55', NULL, NULL, 'S', 'S', 1, NULL, '6af5c62b16c933485702c3b763c5a967.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_category`
--

CREATE TABLE `posts_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts_category`
--

INSERT INTO `posts_category` (`id`, `category_id`, `posts_id`, `created_at`, `updated_at`) VALUES
(1, 1, 32, '2018-03-10 00:38:12', '2018-03-10 00:38:12'),
(2, 10, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 8, 36, '2018-03-10 01:20:27', '2018-03-10 01:20:27'),
(4, 13, 37, '2018-03-10 02:36:50', '2018-03-10 02:36:50'),
(5, 8, 38, '2018-03-10 02:51:24', '2018-03-10 02:51:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `search`
--

CREATE TABLE `search` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `iplastlogin` varchar(45) DEFAULT NULL,
  `lastlogin_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `iplastlogin`, `lastlogin_at`) VALUES
(2, NULL, 'tamara.tssilva@gmail.com', '$2y$10$Z67bxFCI7GVSj7g7d17QzeqVL2FWiGVoqSr7SSYg/3q2TwPUI8nYi', NULL, NULL, '2018-03-10 00:12:38', '127.0.0.1', '2018-03-10 00:12:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_category`
--
ALTER TABLE `posts_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_category_category1_idx` (`category_id`),
  ADD KEY `fk_posts_category_posts1_idx` (`posts_id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
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
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `posts_category`
--
ALTER TABLE `posts_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `posts_category`
--
ALTER TABLE `posts_category`
  ADD CONSTRAINT `fk_posts_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_category_posts1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
