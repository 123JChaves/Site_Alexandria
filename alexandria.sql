-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2025 às 23:53
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
-- Banco de dados: `alexandria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`, `ativo`) VALUES
(15, 'Filosofia', 'S'),
(16, 'Romance', 'S'),
(17, 'Biografia', 'S'),
(18, 'Ficção', 'S'),
(19, 'História', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `senha`) VALUES
(11, 'Juliano Chaves Baptista', 'juliano@gmail.com', '$2y$10$5Xefmm1qKfXbLs5EpGU8X.Hn/1qBRvrvlUjkRB5aHU1/dl2Rak9Ou');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`pedido_id`, `produto_id`, `qtde`, `valor`) VALUES
(8, 52, 1, 87),
(8, 54, 1, 97),
(8, 55, 2, 132),
(8, 58, 1, 96),
(8, 59, 1, 137),
(9, 52, 1, 87),
(9, 55, 1, 132),
(9, 56, 1, 67),
(9, 58, 1, 96),
(9, 59, 1, 137),
(15, 54, 1, 97),
(15, 56, 1, 67),
(15, 58, 1, 96),
(16, 53, 1, 127),
(16, 59, 1, 137);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `preference_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `data`, `preference_id`) VALUES
(8, 11, '2025-11-19 19:27:27', '1077390063-010dc826-31ea-4589-a3df-89f08476498d'),
(9, 11, '2025-11-19 19:35:47', '1077390063-9f8da6ca-51c5-4f0a-a8e1-b462a880de8f'),
(15, 11, '2025-11-19 19:46:17', '1077390063-e749773f-8e44-4cd0-80e5-310eedcad0f8'),
(16, 11, '2025-11-19 19:48:58', '1077390063-57b7b04d-e01f-4c03-a17d-e9cfdce670fc');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `destaque` enum('S','N') NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `autor`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(52, 'As Crônicas de Nárnia', 18, 'C. S. Lewis', '<p>Famoso livor de ficção infanto-juvenil do escritor irlandês C. S. Lewis</p>', '1763587723.jpg', 87, 'S', 'S'),
(53, 'O Silmarillion', 18, 'J. R. Tolkien', '<p>Livro que contém as primeiras história do famoso universo de \"O Senhor dos Anéis\" Tolkien.</p>', '1763587829.jpg', 127, 'S', 'S'),
(54, 'Direito Natural e História', 15, 'Leo Strauss', '<p>Importante obra que abordam de forma btilhante o tema do Direito Natural. O livro é uma busca para justificar e importância do direito natural, principalmente levando em consideração o século XX, século tanto das duas mais violentas e destrutivas guerras já registradas na história, como da ascensã dos regimes mais autoritários e também violentos da história humana. </p>', '1763588257.jpg', 97, 'S', 'S'),
(55, 'Crime e Castigo', 16, 'Fiódor M. Dostoiévski', '<p>Importante obra de Dostoiéviski, Crime e Castigo narra a história de Raskólninkov, gênio matemático que foi tomado por uma noção niilista de mundo, e que tecidindo levar até o fim a sua tese comete um terrível ato que tanto marcará toda a sus história no livro, como servirá de importante ocasião para marcar o sentido da obra.&nbsp;</p>', '1763588580.jpg', 132, 'S', 'S'),
(56, 'Apologia de Sócrates', 15, 'Platão', 'Narrando o fatídico epísódio do julgamento de Sócrates, esse diálogo platônico é um símbolo universal a filosofia.&nbsp;<br>Acusado de impiedade e de corromper a juventude, Sócrates defende a sua atividade como um chamamento divino, atividade que basicamente consisitia em por meio da conversação, testar os limites da sabedoria dos sábios atenienses. O que é possível ver é que na atividade filosófica de Sócrates está a busca pela transicção da aparência da realidade para a própria realidade, que operada pelo jogo de perguntas respostas acaba por desunar o coração daqueles envolvidos pela conversação socrática - resultando nem sempre bem-vindo aos amantes da aparência.&nbsp;', '1763589187.jpg', 67, 'S', 'S'),
(58, 'O Diário de Anne Frank', 17, 'Anne Frank', '<p>Essa é a famosa e imortal biografia de Anne Frank. O Diário contém auto-relatos que compreendem o período que vai de antes da Segunda Guerra Mundial até a Guerra, período em que a família de Anne, junto a ela, por ser judia, se escondeu em algum lugar da Holanda enquanto fugia das forças nazistas.&nbsp;</p>', '1763590818.jpg', 96, 'S', 'S'),
(59, 'Jerusalém: A Biografia', 19, 'Simon Sebag Montefiore', 'Esse livro, escrito pelo renomado jornalista Simon S. Montefiore, discorre sobre a movimentada história milenar da cidade de Jerusalém, passando pela época do domínio dos judeus, ao período islâmido até os tempos modernos.&nbsp;', '1763591035.jpg', 137, 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `telefone`, `ativo`) VALUES
(1, 'Bill Gates', 'bill@gmail.com', '$2y$10$vlKXwI9l1H42YtnKDrph0uXpV8TrtCKCyWOurwoMibSt.GsRg05qK', '(44) 99999-1234', 'S'),
(2, 'Anderson Burnes', 'burnes@gmail.com', '$2y$10$vlKXwI9l1H42YtnKDrph0uXpV8TrtCKCyWOurwoMibSt.GsRg05qK', '(44) 99999-9999', 'S'),
(3, 'Steve Jobs', 'stevej@gmail.com', '$2y$10$oBBNNoAL3qjQRtpRfEZb9efSrLImrVXhPY8mFAmkP430k0POcunXy', '(44) 98765-4321', 'S'),
(5, 'Juliano Chaves Baptista', 'juliano@gmail.com', '$2y$10$e8qqNBY7KElRFhtEpIOHQu09NgKQ6oIGawk.y7mAgav8glRKwRbX2', '(44) 99999-9999', 'S'),
(6, 'Gordon Thompson', 'gordonth@gmail.com', '$2y$10$fy4U1sHG7uuss4fJWyBUfOxr85SNUUcTT8f3YRtEsaWVvFqaB8kTm', '(44) 99999-9999', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`descricao`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`pedido_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
