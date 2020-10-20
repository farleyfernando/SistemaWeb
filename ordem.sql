-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Out-2020 às 21:54
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
-- Banco de dados: `ordem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--
-- Criação: 14-Out-2020 às 21:50
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES
(1, 'Games 12', 0, '2020-10-15 17:35:28'),
(3, 'Automotivo', 1, '2020-10-15 17:35:51'),
(4, 'Televisores', 1, '2020-10-16 15:43:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--
-- Criação: 12-Out-2020 às 10:14
-- Última actualização: 20-Out-2020 às 16:44
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `cliente_tipo` tinyint(1) DEFAULT NULL,
  `cliente_nome` varchar(45) NOT NULL,
  `cliente_sobrenome` varchar(150) NOT NULL,
  `cliente_data_nascimento` date NOT NULL,
  `cliente_cpf_cnpj` varchar(20) NOT NULL,
  `cliente_rg_ie` varchar(20) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `cliente_telefone` varchar(20) NOT NULL,
  `cliente_celular` varchar(20) NOT NULL,
  `cliente_cep` varchar(10) NOT NULL,
  `cliente_endereco` varchar(155) NOT NULL,
  `cliente_numero_endereco` varchar(20) NOT NULL,
  `cliente_bairro` varchar(45) NOT NULL,
  `cliente_complemento` varchar(145) NOT NULL,
  `cliente_cidade` varchar(105) NOT NULL,
  `cliente_estado` varchar(2) NOT NULL,
  `cliente_ativo` tinyint(1) NOT NULL,
  `cliente_obs` tinytext DEFAULT NULL,
  `cliente_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_tipo`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf_cnpj`, `cliente_rg_ie`, `cliente_email`, `cliente_telefone`, `cliente_celular`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_complemento`, `cliente_cidade`, `cliente_estado`, `cliente_ativo`, `cliente_obs`, `cliente_data_alteracao`) VALUES
(3, '2020-10-12 19:58:02', 2, 'Smart Cell', 'Smart Cell', '2020-01-03', '35.556.964/0001-03', '577.460.757.672', 'smart@uol.com', '(18) 2315-1252', '(18) 99132-5145', '19470-000', 'Fernando Costa', '11-60', 'Vila maria', 'perto redondo', 'Presidente Epitácio', 'SP', 1, 'Teste', '2020-10-20 16:44:59'),
(7, '2020-10-13 11:08:10', 1, 'Ana Paula', 'da Mota Souza', '1978-03-17', '273.338.568-28', '33.431.111-X', 'ana@hotmail.com', '(18) 3281-5241', '(18) 95421-4515', '19470-000', 'Fernando Costa', '1160', 'Vila Maria', 'casa', 'Presidente Epitácio', 'SP', 1, '', '2020-10-19 15:04:48'),
(9, '2020-10-20 16:27:43', 1, 'Farley Fernando', 'Santos', '2020-10-07', '315.374.768-74', '33.431.111-0', 'farleyfernando@hotmail.com', '(18) 9918-5254', '(21) 32132-1321', '19470-000', 'Guanabara', '32&#039;', 'jd primavera', 'casa', 'Presidente Epitácio', 'SP', 1, 'teste3', '2020-10-20 16:27:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_pagar`
--
-- Criação: 16-Out-2020 às 17:36
-- Última actualização: 19-Out-2020 às 12:42
--

CREATE TABLE `contas_pagar` (
  `conta_pagar_id` int(11) NOT NULL,
  `conta_pagar_fornecedor_id` int(11) DEFAULT NULL,
  `conta_pagar_data_venc` date DEFAULT NULL,
  `conta_pagar_data_pagamento` datetime DEFAULT NULL,
  `conta_pagar_valor` varchar(15) DEFAULT NULL,
  `conta_pagar_status` tinyint(1) DEFAULT NULL,
  `conta_pagar_obs` tinytext DEFAULT NULL,
  `conta_pagar_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='		';

--
-- Extraindo dados da tabela `contas_pagar`
--

INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_data_venc`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES
(1, 2, '2020-10-16', '2020-10-17 13:25:52', '200.00', 1, 'paga', '2020-10-19 10:29:39'),
(2, 3, '2020-11-27', NULL, '1,340.01', 0, 'teste1', '2020-10-19 12:42:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--
-- Criação: 19-Out-2020 às 11:59
-- Última actualização: 19-Out-2020 às 19:34
--

CREATE TABLE `contas_receber` (
  `conta_receber_id` int(11) NOT NULL,
  `conta_receber_cliente_id` int(11) NOT NULL,
  `conta_receber_data_vencto` date DEFAULT NULL,
  `conta_receber_data_pagamento` datetime DEFAULT NULL,
  `conta_receber_valor` varchar(20) DEFAULT NULL,
  `conta_receber_status` tinyint(1) DEFAULT NULL,
  `conta_receber_obs` tinytext DEFAULT NULL,
  `conta_receber_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas_receber`
--

INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencto`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES
(2, 7, '2020-10-23', '2020-10-19 16:34:09', '350.00', 1, '', '2020-10-19 19:34:09'),
(4, 7, '2020-10-23', '2020-10-19 12:04:16', '217.44', 1, 'Teste', '2020-10-19 15:04:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamentos`
--
-- Criação: 19-Out-2020 às 15:41
-- Última actualização: 19-Out-2020 às 19:25
--

CREATE TABLE `formas_pagamentos` (
  `forma_pagamento_id` int(11) NOT NULL,
  `forma_pagamento_nome` varchar(45) DEFAULT NULL,
  `forma_pagamento_aceita_parc` tinyint(1) DEFAULT NULL,
  `forma_pagamento_ativa` tinyint(1) DEFAULT NULL,
  `forma_pagamento_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formas_pagamentos`
--

INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES
(1, 'Cartão de crédito', 1, 1, '2020-10-19 18:52:43'),
(2, 'Dinheiro', 0, 1, '2020-01-29 21:43:54'),
(3, 'Boleto bancário', 0, 1, '2020-10-19 18:52:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--
-- Criação: 13-Out-2020 às 12:04
--

CREATE TABLE `fornecedores` (
  `fornecedor_id` int(11) NOT NULL,
  `fornecedor_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `fornecedor_razao` varchar(200) DEFAULT NULL,
  `fornecedor_nome_fantasia` varchar(145) DEFAULT NULL,
  `fornecedor_cnpj` varchar(20) DEFAULT NULL,
  `fornecedor_ie` varchar(20) DEFAULT NULL,
  `fornecedor_telefone` varchar(20) DEFAULT NULL,
  `fornecedor_celular` varchar(20) DEFAULT NULL,
  `fornecedor_email` varchar(100) DEFAULT NULL,
  `fornecedor_contato` varchar(45) DEFAULT NULL,
  `fornecedor_cep` varchar(10) DEFAULT NULL,
  `fornecedor_endereco` varchar(145) DEFAULT NULL,
  `fornecedor_numero_endereco` varchar(20) DEFAULT NULL,
  `fornecedor_bairro` varchar(45) DEFAULT NULL,
  `fornecedor_complemento` varchar(45) DEFAULT NULL,
  `fornecedor_cidade` varchar(45) DEFAULT NULL,
  `fornecedor_estado` varchar(2) DEFAULT NULL,
  `fornecedor_ativo` tinyint(1) DEFAULT NULL,
  `fornecedor_obs` tinytext DEFAULT NULL,
  `fornecedor_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`fornecedor_id`, `fornecedor_data_cadastro`, `fornecedor_razao`, `fornecedor_nome_fantasia`, `fornecedor_cnpj`, `fornecedor_ie`, `fornecedor_telefone`, `fornecedor_celular`, `fornecedor_email`, `fornecedor_contato`, `fornecedor_cep`, `fornecedor_endereco`, `fornecedor_numero_endereco`, `fornecedor_bairro`, `fornecedor_complemento`, `fornecedor_cidade`, `fornecedor_estado`, `fornecedor_ativo`, `fornecedor_obs`, `fornecedor_data_alteracao`) VALUES
(2, '2020-10-13 16:53:39', 'Jose Santos me', 'Construtora Ideal', '06.246.802/0001-62', '463.087.659.590', '(18) 3281-5214', '(18) 98191-3652', 'jose@uol.com', NULL, '19710-000', 'Av. centro', '35', 'Conceição de Monte Alegre', 'Centro Industrial', 'Paraguaçu Paulista', 'SP', 1, 'Roupas masculinas', '2020-10-16 17:34:22'),
(3, '2020-10-14 00:20:26', 'Alfredo Santos MEEEE', 'TESTE', '99.094.088/0001-11', '463.087.659.591', '(18) 9813-5011', '(18) 98191-3652', 'teste@uol.com', NULL, '05310-000', 'Avenida Doutora Ruth Cardoso', '43', 'Vila Leopoldina', 'casa', 'São Paulo', 'SP', 0, '', '2020-10-15 17:09:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--
-- Criação: 10-Out-2020 às 01:31
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'vendedor', 'Vendedores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--
-- Criação: 10-Out-2020 às 01:31
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--
-- Criação: 14-Out-2020 às 02:51
--

CREATE TABLE `marcas` (
  `marca_id` int(11) NOT NULL,
  `marca_nome` varchar(45) NOT NULL,
  `marca_ativa` tinyint(1) DEFAULT NULL,
  `marca_data_alteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES
(1, 'Sansung', 1, '2020-10-15 12:57:36'),
(3, 'Apple', 0, '2020-10-14 21:41:15'),
(5, 'Positivo', 1, '0000-00-00 00:00:00'),
(6, 'LG', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_tem_servicos`
--
-- Criação: 19-Out-2020 às 19:45
-- Última actualização: 20-Out-2020 às 19:44
--

CREATE TABLE `ordem_tem_servicos` (
  `ordem_ts_id` int(11) NOT NULL,
  `ordem_ts_id_servico` int(11) DEFAULT NULL,
  `ordem_ts_id_ordem_servico` int(11) DEFAULT NULL,
  `ordem_ts_quantidade` int(11) DEFAULT NULL,
  `ordem_ts_valor_unitario` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_desconto` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_total` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de relacionamento entre as tabelas servicos e ordem_servico';

--
-- Extraindo dados da tabela `ordem_tem_servicos`
--

INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES
(67, 4, 2, 1, ' 80.00', '0 ', ' 80.00'),
(69, 1, 3, 3, ' 50.00', '0 ', ' 150.00'),
(70, 2, 1, 3, ' 80.00', '3 ', ' 232.80');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordens_servicos`
--
-- Criação: 19-Out-2020 às 19:45
-- Última actualização: 20-Out-2020 às 19:44
--

CREATE TABLE `ordens_servicos` (
  `ordem_servico_id` int(11) NOT NULL,
  `ordem_servico_forma_pagamento_id` int(11) DEFAULT NULL,
  `ordem_servico_cliente_id` int(11) DEFAULT NULL,
  `ordem_servico_data_emissao` timestamp NULL DEFAULT current_timestamp(),
  `ordem_servico_data_conclusao` varchar(100) DEFAULT NULL,
  `ordem_servico_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_marca_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_modelo_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_acessorios` tinytext DEFAULT NULL,
  `ordem_servico_defeito` tinytext DEFAULT NULL,
  `ordem_servico_valor_desconto` varchar(25) DEFAULT NULL,
  `ordem_servico_valor_total` varchar(25) DEFAULT NULL,
  `ordem_servico_status` tinyint(1) DEFAULT NULL,
  `ordem_servico_obs` tinytext DEFAULT NULL,
  `ordem_servico_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ordens_servicos`
--

INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES
(1, 2, 7, '2020-02-14 20:30:35', NULL, 'Fone de ouvidoF', 'AwellF', 'AV1801F', 'Mouse e carregadorF', 'Não sai aúdio no lado esquerdoF', 'R$ 7.20', '232.80', 0, 'testeF', '2020-10-20 19:44:24'),
(2, 2, 9, '2020-02-14 20:48:53', NULL, 'Notebook', 'Dell', 'FAVE7638', 'Carregador', 'Não liga', 'R$ 0.00', '80.00', 0, 'testeF', '2020-10-20 19:17:54'),
(3, 2, 3, '2020-02-17 23:53:26', NULL, 'Fone de ouvidoFG', 'AwellFG', 'AV1801FG', 'Mouse e carregadorFG', 'Não sai aúdio no lado esquerdoFG', 'R$ 0.00', '150.00', 0, 'testeFG', '2020-10-20 19:20:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--
-- Criação: 15-Out-2020 às 18:15
-- Última actualização: 19-Out-2020 às 11:47
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `produto_codigo` varchar(45) DEFAULT NULL,
  `produto_data_cadastro` datetime DEFAULT NULL,
  `produto_categoria_id` int(11) NOT NULL,
  `produto_marca_id` int(11) NOT NULL,
  `produto_fornecedor_id` int(11) NOT NULL,
  `produto_descricao` varchar(145) DEFAULT NULL,
  `produto_unidade` varchar(25) DEFAULT NULL,
  `produto_preco_custo` varchar(45) DEFAULT NULL,
  `produto_preco_venda` varchar(45) DEFAULT NULL,
  `produto_estoque_minimo` varchar(10) DEFAULT NULL,
  `produto_qtde_estoque` varchar(10) DEFAULT NULL,
  `produto_ativo` tinyint(1) DEFAULT NULL,
  `produto_obs` tinytext DEFAULT NULL,
  `produto_data_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_fornecedor_id`, `produto_descricao`, `produto_unidade`, `produto_preco_custo`, `produto_preco_venda`, `produto_estoque_minimo`, `produto_qtde_estoque`, `produto_ativo`, `produto_obs`, `produto_data_alteracao`) VALUES
(7, '18379264', NULL, 4, 6, 3, 'Smart tv 40', 'UN', '1.810,00', '2.590,00', '5', '10', 1, 'teste', '2020-10-16 15:46:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--
-- Criação: 14-Out-2020 às 01:21
-- Última actualização: 20-Out-2020 às 17:23
--

CREATE TABLE `servicos` (
  `servico_id` int(11) NOT NULL,
  `servico_nome` varchar(145) DEFAULT NULL,
  `servico_preco` varchar(15) DEFAULT NULL,
  `servico_descricao` tinytext DEFAULT NULL,
  `servico_ativo` tinyint(1) DEFAULT NULL,
  `servico_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`servico_id`, `servico_nome`, `servico_preco`, `servico_descricao`, `servico_ativo`, `servico_data_alteracao`) VALUES
(1, 'Limpeza gerall', '50,00', 'Limpeza Geral', 1, '2020-10-20 17:23:41'),
(2, 'Solda elétrica', '80,00', 'Solda elétrica', 1, '2020-02-13 22:10:21'),
(4, 'Formatção de Computador', '80,00', 'Formatação e instalação de programas padrão.', 1, '2020-10-14 02:32:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--
-- Criação: 11-Out-2020 às 18:32
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_txt_ordem_servico` tinytext DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_url`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_cidade`, `sistema_estado`, `sistema_txt_ordem_servico`, `sistema_data_alteracao`) VALUES
(1, 'System Ordem Incc', 'TellNett', '30.235.254/0001-51', '476.875.136.289', '(18) 3281-5432', '(18) 99185-2548', 'farlefernado@gmail.com.br', 'https://farleyfernando.com.br', '19470-009', 'R. Rio de Janeiroo', '34-29', 'Presidente Epitácioo', 'PR', 'Temos os melhores produtos!!!', '2020-10-12 00:02:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--
-- Criação: 10-Out-2020 às 01:31
-- Última actualização: 20-Out-2020 às 14:17
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$1aCih8HbVNrKUtHeYLxpp.pXylYey74H2vQFz9/WLpOLk2MkS5WFG', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1602436936, 1, 'admin', 'instrator', 'ADMIN', '(18) 99125-4885'),
(2, '::1', 'aninnha', '$2y$10$o9PJpYcnSSFPdLGG.pT51.IFird56DeqLGu5MiHxR.5iyvXOYlMB6', 'aninnha_30@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1602424222, NULL, 0, 'ANA PAULA', 'DA MOTA SOUZA', NULL, NULL),
(6, '::1', 'ffsantos', '$2y$12$hglY67w1yZGhwT2nByDdYub.KmuzHwQZ7s7bWBZEIs7liii0W2Vqm', 'farleyfernando@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1602424602, 1603203449, 1, 'FARLEY', 'FERNANDO DOS SANTOS', NULL, '(18) 99185-2548'),
(8, '::1', 'aninnha30', '$2y$10$XTIuw3qpbN9W2VP48NjoAOLtj4i1kRyKK0zbcLi7cF1xveNBzkowG', 'aninnha_30@hotmail.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1602425945, NULL, 0, 'ANA PAULA', 'SOUZA', NULL, '(18) 98191-3654');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--
-- Criação: 10-Out-2020 às 01:31
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(12, 1, 1),
(13, 2, 2),
(18, 6, 1),
(17, 8, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--
-- Criação: 13-Out-2020 às 23:41
--

CREATE TABLE `vendedores` (
  `vendedor_id` int(11) NOT NULL,
  `vendedor_codigo` varchar(10) NOT NULL,
  `vendedor_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `vendedor_nome_completo` varchar(145) NOT NULL,
  `vendedor_cpf` varchar(25) NOT NULL,
  `vendedor_rg` varchar(25) NOT NULL,
  `vendedor_dn` date DEFAULT NULL,
  `vendedor_telefone` varchar(15) DEFAULT NULL,
  `vendedor_celular` varchar(15) DEFAULT NULL,
  `vendedor_email` varchar(45) DEFAULT NULL,
  `vendedor_cep` varchar(15) DEFAULT NULL,
  `vendedor_endereco` varchar(45) DEFAULT NULL,
  `vendedor_numero_endereco` varchar(25) DEFAULT NULL,
  `vendedor_complemento` varchar(45) DEFAULT NULL,
  `vendedor_bairro` varchar(45) DEFAULT NULL,
  `vendedor_cidade` varchar(45) DEFAULT NULL,
  `vendedor_estado` varchar(2) DEFAULT NULL,
  `vendedor_ativo` tinyint(1) DEFAULT NULL,
  `vendedor_obs` tinytext DEFAULT NULL,
  `vendedor_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`vendedor_id`, `vendedor_codigo`, `vendedor_data_cadastro`, `vendedor_nome_completo`, `vendedor_cpf`, `vendedor_rg`, `vendedor_dn`, `vendedor_telefone`, `vendedor_celular`, `vendedor_email`, `vendedor_cep`, `vendedor_endereco`, `vendedor_numero_endereco`, `vendedor_complemento`, `vendedor_bairro`, `vendedor_cidade`, `vendedor_estado`, `vendedor_ativo`, `vendedor_obs`, `vendedor_data_alteracao`) VALUES
(1, '09842571', '2020-01-28 01:24:17', 'Lucio Antonio de SouzaM', '315.374.768-74', '36.803.319-1', '2020-10-14', '(18) 3264-6534', '(41) 99999-9991', 'vendedor@gmail.com.BR', '80530-001', 'Rua das vendasM', '451', 'M', 'CentroM', 'CuritibaM', 'PJ', 1, 'M', '2020-10-13 23:48:01'),
(2, '03841956', '2020-01-29 22:22:27', 'Sara Betina', '582.071.790-23', '25.287.429-8', '2020-10-30', '', '(41) 88884-4444', 'sara@gmail.com', '80540-120', 'Rua das vendas', '45', '', 'Centro', 'Joinville', 'SC', 0, '', '2020-10-13 23:55:57'),
(4, '06589472', '2020-10-14 01:13:47', 'João dos Santos', '789.868.010-35', '36.803.319-3', '2020-09-29', '(12) 3232-4343', '(17) 34342-3432', 'joao@gmail.com', '19470-000', 'Paraná', '45', 'casa', 'Centro', 'Presidente Epitácio', 'SP', 1, 'teste', '2020-10-14 01:13:47');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Índices para tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD PRIMARY KEY (`conta_pagar_id`),
  ADD KEY `fk_conta_pagar_id_fornecedor` (`conta_pagar_fornecedor_id`);

--
-- Índices para tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD PRIMARY KEY (`conta_receber_id`),
  ADD KEY `fk_conta_receber_id_cliente` (`conta_receber_cliente_id`);

--
-- Índices para tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  ADD PRIMARY KEY (`forma_pagamento_id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`marca_id`);

--
-- Índices para tabela `ordem_tem_servicos`
--
ALTER TABLE `ordem_tem_servicos`
  ADD PRIMARY KEY (`ordem_ts_id`),
  ADD KEY `fk_ordem_ts_id_servico` (`ordem_ts_id_servico`),
  ADD KEY `fk_ordem_ts_id_ordem_servico` (`ordem_ts_id_ordem_servico`);

--
-- Índices para tabela `ordens_servicos`
--
ALTER TABLE `ordens_servicos`
  ADD PRIMARY KEY (`ordem_servico_id`),
  ADD KEY `fk_ordem_servico_id_cliente` (`ordem_servico_cliente_id`),
  ADD KEY `fk_ordem_servico_id_forma_pagto` (`ordem_servico_forma_pagamento_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`),
  ADD KEY `produto_categoria_id` (`produto_categoria_id`,`produto_marca_id`,`produto_fornecedor_id`),
  ADD KEY `fk_produto_marca_id` (`produto_marca_id`),
  ADD KEY `fk_produto_forncedor_id` (`produto_fornecedor_id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`servico_id`);

--
-- Índices para tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`sistema_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Índices para tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`vendedor_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  MODIFY `conta_pagar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  MODIFY `conta_receber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  MODIFY `forma_pagamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `ordem_tem_servicos`
--
ALTER TABLE `ordem_tem_servicos`
  MODIFY `ordem_ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `ordens_servicos`
--
ALTER TABLE `ordens_servicos`
  MODIFY `ordem_servico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `servico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `sistema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `vendedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD CONSTRAINT `fk_conta_pagar_id_fornecedor` FOREIGN KEY (`conta_pagar_fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`);

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
