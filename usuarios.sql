-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/04/2026 às 02:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_simples`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

-- 1. Cria a tabela de usuários primeiro
CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `idade` INT(11) NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `curso` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Cria a tabela de notas
CREATE TABLE `notas_alunos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `bimestre` VARCHAR(20) NOT NULL,
  `nota1` DECIMAL(5,2),
  `nota2` DECIMAL(5,2),
  `nota3` DECIMAL(5,2),
  `peso` DECIMAL(4,2) DEFAULT 1.00,
  `faltas` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aluno_usuario` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `telefone`, `idade`, `cidade`, `curso`) VALUES
(1, 'Carlos', 'carlos@email.com', '454875487', 35, 'teste', 'ads'),
(4, 'Teste2', 'teste2@teste.com', '5454545454', 35, 'teste2', 'ads'),
(11, 'teste', 'teste@email.com', '4798989898', 25, 'joinville', 'ads');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
/* ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`); */


--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
/* ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT; */


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
