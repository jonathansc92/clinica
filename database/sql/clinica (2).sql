-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 24-Jun-2018 às 22:44
-- Versão do servidor: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_06_13_021102_create_tb_agendamento_table', 0),
(2, '2018_06_13_021102_create_tb_cadastro_medico_table', 0),
(3, '2018_06_13_021102_create_tb_especialidade_table', 0),
(4, '2018_06_13_021102_create_tb_paciente_table', 0),
(5, '2018_06_13_021102_create_tb_plano_table', 0),
(6, '2018_06_13_021102_create_users_table', 0),
(7, '2018_06_13_021104_add_foreign_keys_to_tb_agendamento_table', 0),
(8, '2018_06_13_021104_add_foreign_keys_to_tb_cadastro_medico_table', 0),
(9, '2018_06_13_021104_add_foreign_keys_to_tb_paciente_table', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agendamento`
--

CREATE TABLE IF NOT EXISTS `tb_agendamento` (
  `id` int(11) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_agendamento`
--

INSERT INTO `tb_agendamento` (`id`, `data_hora`, `created_at`, `updated_at`, `status`, `id_paciente`, `id_medico`) VALUES
(1, '2018-06-25 00:00:00', NULL, '2018-06-24 21:49:20', 2, 1, 2),
(2, '2018-05-06 00:00:00', '2018-05-27 02:18:33', '2018-05-27 02:33:58', 1, 5, 2),
(4, '2018-05-09 00:00:00', NULL, NULL, NULL, 1, 7),
(5, '2018-05-15 00:00:00', NULL, NULL, NULL, 1, 9),
(6, '2018-05-30 00:00:00', NULL, NULL, NULL, 3, 9),
(7, NULL, '2018-06-24 21:21:28', '2018-06-24 21:21:28', 1, 1, 2),
(8, NULL, '2018-06-24 21:22:32', '2018-06-24 21:22:32', 1, 1, 2),
(9, '2017-12-08 02:03:00', '2018-06-24 21:23:42', '2018-06-24 21:23:42', 1, 1, 2),
(10, '2018-11-12 09:09:00', '2018-06-24 22:40:22', '2018-06-24 22:43:37', 2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cadastro_medico`
--

CREATE TABLE IF NOT EXISTS `tb_cadastro_medico` (
  `id` int(11) NOT NULL,
  `crm` varchar(13) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `d_nascimento` date NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cadastro_medico`
--

INSERT INTO `tb_cadastro_medico` (`id`, `crm`, `cpf`, `nome`, `sexo`, `d_nascimento`, `id_especialidade`, `created_at`, `updated_at`) VALUES
(2, '11111111112', '111111111', 'Johan Silva', 'M', '2018-05-05', 1, NULL, '2018-05-20 23:54:16'),
(7, '012212121', '12121212', 'Maria Teresa', 'F', '2018-04-05', 2, '2018-05-13 21:33:27', '2018-06-01 00:35:22'),
(9, '333333', '1111112222', 'Tamara Silva', 'F', '2018-05-17', 1, '2018-05-21 00:19:08', '2018-05-27 23:58:29'),
(10, '11111111', '11111111', 'Walter Oach', 'M', '2018-11-05', 4, '2018-06-01 00:34:58', '2018-06-01 00:34:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_especialidade`
--

CREATE TABLE IF NOT EXISTS `tb_especialidade` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor_consulta` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_especialidade`
--

INSERT INTO `tb_especialidade` (`id`, `descricao`, `valor_consulta`, `created_at`, `updated_at`) VALUES
(1, 'Fisioterapia', 39, NULL, '2018-06-01 00:18:14'),
(2, 'Cardiologia', 39, '2018-06-01 00:21:41', '2018-06-01 00:21:41'),
(4, 'Odontologia', 76, '2018-06-01 00:27:00', '2018-06-01 00:27:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_paciente`
--

CREATE TABLE IF NOT EXISTS `tb_paciente` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `d_nascimento` date DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `id_plano` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_paciente`
--

INSERT INTO `tb_paciente` (`id`, `cpf`, `nome`, `d_nascimento`, `sexo`, `id_plano`, `created_at`, `updated_at`) VALUES
(1, '29999999', 'Jonathan Cruz', '1992-01-31', 'M', 7, NULL, '2018-06-01 00:12:39'),
(3, '00000000000', 'Lenilson Motta', '2018-05-02', 'M', 9, '2018-05-13 21:56:14', '2018-05-13 21:56:14'),
(5, '03307235028', 'Diego Bertodo', '2018-05-03', 'M', 1, '2018-05-20 23:24:19', '2018-06-24 22:25:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_plano`
--

CREATE TABLE IF NOT EXISTS `tb_plano` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_plano`
--

INSERT INTO `tb_plano` (`id`, `descricao`, `cnpj`, `contato`, `created_at`, `updated_at`) VALUES
(1, 'Unimed', '61.658.100/000', '51900000001', '2018-05-31 23:43:12', '2018-06-01 02:43:12'),
(3, 'Green Line', '111111', '22222', '2018-05-31 23:51:31', '2018-06-01 02:51:31'),
(4, 'Amil', '11111111', '1111111111', '2018-05-31 23:56:39', '2018-06-01 02:56:39'),
(5, 'Santa Helena – Atendimento Nacional', '111111', '1111111', '2018-05-31 23:52:24', '2018-06-01 02:52:24'),
(6, 'Qualicorp', '11111111', '1111111', '2018-05-31 23:53:07', '2018-06-01 02:53:07'),
(7, 'SulAmérica', '111111111', '11111111', '2018-05-31 23:57:01', '2018-06-01 02:57:01'),
(9, 'Bradesco Saúde', '11111111', '111111', '2018-05-31 23:56:27', '2018-06-01 02:56:27'),
(16, 'Intermédica Sistema de saúde', NULL, NULL, '2018-06-01 03:01:25', '2018-06-01 03:01:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `iplastlogin` varchar(45) DEFAULT NULL,
  `lastlogin_at` datetime DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `whoarewe` longtext
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `iplastlogin`, `lastlogin_at`, `img`, `whoarewe`) VALUES
(1, 'Administrador', 'admin@clinica.com', '$2y$10$JbMmT.0K43TzxfSjja38yuYL3O5ES3t.FQvFHmYQqKfweTTk15Jqm', 'bEAVta0JZ6umjf3CmiCcDgINoMB6hkOgSmsRiGLpbr9T2uBnkBaZNs59rgfD', NULL, '2018-06-24 19:55:24', '127.0.0.1', '2018-06-24 19:55:24', 'ae33e1d9d1fa082b324fc577abd9ce0f.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_agendamento`
--
ALTER TABLE `tb_agendamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_agendamento_tb_paciente1_idx` (`id_paciente`),
  ADD KEY `fk_tb_agendamento_tb_cadastro_medico1_idx` (`id_medico`);

--
-- Indexes for table `tb_cadastro_medico`
--
ALTER TABLE `tb_cadastro_medico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm` (`crm`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `fk_tb_especialidade_id` (`id_especialidade`);

--
-- Indexes for table `tb_especialidade`
--
ALTER TABLE `tb_especialidade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descricao` (`descricao`);

--
-- Indexes for table `tb_paciente`
--
ALTER TABLE `tb_paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `fk_tb_plano_id` (`id_plano`);

--
-- Indexes for table `tb_plano`
--
ALTER TABLE `tb_plano`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_agendamento`
--
ALTER TABLE `tb_agendamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_cadastro_medico`
--
ALTER TABLE `tb_cadastro_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_especialidade`
--
ALTER TABLE `tb_especialidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_paciente`
--
ALTER TABLE `tb_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_plano`
--
ALTER TABLE `tb_plano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_agendamento`
--
ALTER TABLE `tb_agendamento`
  ADD CONSTRAINT `fk_tb_agendamento_tb_cadastro_medico1` FOREIGN KEY (`id_medico`) REFERENCES `tb_cadastro_medico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_agendamento_tb_paciente1` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_cadastro_medico`
--
ALTER TABLE `tb_cadastro_medico`
  ADD CONSTRAINT `fk_tb_especialidade_id` FOREIGN KEY (`id_especialidade`) REFERENCES `tb_especialidade` (`id`);

--
-- Limitadores para a tabela `tb_paciente`
--
ALTER TABLE `tb_paciente`
  ADD CONSTRAINT `fk_tb_plano_id` FOREIGN KEY (`id_plano`) REFERENCES `tb_plano` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
