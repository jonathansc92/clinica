-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 13-Maio-2018 às 22:31
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
-- Estrutura da tabela `tb_agendamento`
--

CREATE TABLE IF NOT EXISTS `tb_agendamento` (
  `cpf_paciente` varchar(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `crm_medico` varchar(13) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cadastro_medico`
--

INSERT INTO `tb_cadastro_medico` (`id`, `crm`, `cpf`, `nome`, `sexo`, `d_nascimento`, `id_especialidade`, `created_at`, `updated_at`) VALUES
(2, '1111111111', '111111111', 'Johan Silvas', 'M', '2018-05-05', 1, NULL, '2018-05-13 21:31:48'),
(7, '012212121', '12121212', 'milani', 'F', '2018-05-04', 1, '2018-05-13 21:33:27', '2018-05-13 21:33:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_especialidade`
--

INSERT INTO `tb_especialidade` (`id`, `descricao`, `valor_consulta`, `created_at`, `updated_at`) VALUES
(1, 'Ginecologista', 35, NULL, '2018-05-13 20:48:05'),
(2, 'Teste', 12, '2018-05-13 20:52:43', '2018-05-13 20:52:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_paciente`
--

CREATE TABLE IF NOT EXISTS `tb_paciente` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `d_nascimento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_paciente`
--

INSERT INTO `tb_paciente` (`id`, `cpf`, `nome`, `d_nascimento`, `sexo`, `id_plano`, `created_at`, `updated_at`) VALUES
(1, '2', 'Jonathan', '1992-01-31', 'M', 1, NULL, '2018-05-13 21:54:37'),
(3, '00000000000', 'Teste', '2018-05-02', 'M', 9, '2018-05-13 21:56:14', '2018-05-13 21:56:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_plano`
--

INSERT INTO `tb_plano` (`id`, `descricao`, `cnpj`, `contato`, `created_at`, `updated_at`) VALUES
(1, 'Odontológicos', '61.658.100/000', '51900000001', '2018-05-13 22:02:20', '2018-05-14 01:02:20'),
(3, 'asa', NULL, NULL, '2018-05-06 19:26:37', '2018-05-06 22:26:37'),
(4, NULL, NULL, NULL, '2018-05-05 06:32:56', '2018-05-05 06:32:56'),
(5, NULL, NULL, NULL, '2018-05-05 06:49:33', '2018-05-05 06:49:33'),
(6, NULL, NULL, NULL, '2018-05-05 06:52:57', '2018-05-05 06:52:57'),
(7, NULL, NULL, NULL, '2018-05-05 06:53:52', '2018-05-05 06:53:52'),
(8, NULL, NULL, NULL, '2018-05-05 06:54:37', '2018-05-05 06:54:37'),
(9, 'aaaaaa', '11111111', '111111', '2018-05-05 06:59:14', '2018-05-05 06:59:14'),
(11, '111111', '111111', '1111111', '2018-05-05 07:02:42', '2018-05-05 07:02:42'),
(13, 'aaa', '111', '111', '2018-05-05 07:05:16', '2018-05-05 07:05:16'),
(14, 'as', '11', '11', '2018-05-05 07:05:43', '2018-05-05 07:05:43'),
(15, 'teste', '111', '11111111', '2018-05-14 01:03:28', '2018-05-14 01:03:28');

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
(1, 'Jonathan Cruz', 'admin@clinica.com', '$2y$10$zlu8DzkVVktnyahC5vVx9.bog55DcMFnTNJvM8gUYCL.S0LGuNT82', 'Z02AqrVxsWdn3wScGInBkQBxdgyXiZby3DkkKid6tiHZctn46FMkLDJT2Zaa', NULL, '2018-05-13 20:34:59', '127.0.0.1', '2018-05-13 20:34:59', '0167793d4ec4690c588dd296edc45a2d.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agendamento`
--
ALTER TABLE `tb_agendamento`
  ADD PRIMARY KEY (`crm_medico`,`data_hora`),
  ADD KEY `fk_tb_pacientes_cpf` (`cpf_paciente`),
  ADD KEY `fk_tb_plano_id1` (`id_plano`),
  ADD KEY `fk_tb_cadastro_medicos_crm1` (`crm_medico`),
  ADD KEY `fk_tb_especialidade_id1` (`id_especialidade`);

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
-- AUTO_INCREMENT for table `tb_cadastro_medico`
--
ALTER TABLE `tb_cadastro_medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_especialidade`
--
ALTER TABLE `tb_especialidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_paciente`
--
ALTER TABLE `tb_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_plano`
--
ALTER TABLE `tb_plano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
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
  ADD CONSTRAINT `fk_tb_cadastro_medicos_crm1` FOREIGN KEY (`crm_medico`) REFERENCES `tb_cadastro_medico` (`crm`),
  ADD CONSTRAINT `fk_tb_especialidade_id1` FOREIGN KEY (`id_especialidade`) REFERENCES `tb_especialidade` (`id`),
  ADD CONSTRAINT `fk_tb_pacientes_cpf` FOREIGN KEY (`cpf_paciente`) REFERENCES `tb_paciente` (`cpf`),
  ADD CONSTRAINT `fk_tb_plano_id1` FOREIGN KEY (`id_plano`) REFERENCES `tb_plano` (`id`);

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
