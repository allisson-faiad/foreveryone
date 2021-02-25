-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Fev-2021 às 01:11
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_foreveryone`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Create_tb_voluntario` (IN `cd_voluntario` INT(11), IN `nm_voluntario` VARCHAR(70), IN `nm_usuario_voluntario1` VARCHAR(35), IN `nm_email_voluntario1` VARCHAR(100), IN `nm_senha_voluntario` VARCHAR(20), IN `cd_cpf_voluntario` INT(12), IN `dt_nascimento_voluntario` DATE, IN `im_voluntario` VARCHAR(300))  begin
    if (SELECT COUNT(0) FROM tb_voluntario WHERE nm_email_voluntario = nm_email_voluntario1) then
    select 'Já existe uma conta com esse e-mail';
    end if;
    if (SELECT COUNT(0) FROM tb_voluntario WHERE nm_usuario_voluntario = nm_usuario_voluntario1) then
    select 'Já existe uma conta com esse usuário';
    else
	INSERT INTO tb_voluntario (
        cd_voluntario, 
        nm_voluntario, 
        nm_usuario_voluntario, 
        nm_email_voluntario, 
        nm_senha_voluntario, 
        cd_cpf_voluntario, 
        dt_nascimento_voluntario, 
        im_voluntario) 
    VALUES (
        cd_voluntario, 
        nm_voluntario, 
        nm_usuario_voluntario1, 
        nm_email_voluntario1, 
        nm_senha_voluntario, 
        cd_cpf_voluntario, 
        dt_nascimento_voluntario, 
        im_voluntario);
	end if;
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bairro`
--

CREATE TABLE `tb_bairro` (
  `cd_bairro` int(11) NOT NULL,
  `nm_bairro` varchar(70) DEFAULT NULL,
  `cd_cidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_bairro`
--

INSERT INTO `tb_bairro` (`cd_bairro`, `nm_bairro`, `cd_cidade`) VALUES
(1, 'Vila Margarida', 1),
(5, 'Vila Valqueire', 3),
(6, 'Campinho', 3),
(8, 'Cascadura', 3),
(11, 'Cruzeiro Novo', 6),
(12, 'Residencial Gente Feliz', 7),
(13, 'Conjunto Habitar Brasil', 8),
(15, 'Liberdade', 10),
(16, 'PetrÃ³polis', 11),
(17, 'Jardim Clodoaldo', 12),
(18, 'Ferreira', 13),
(20, 'Parque Continental', 1),
(21, 'Centro', 1),
(22, 'Cidade NaÃºtica', 1),
(23, 'Luz', 13),
(24, 'Esplanada dos Barreiros', 1),
(25, 'Ilha Porchat', 1),
(26, 'Bela Vista', 13),
(27, 'Ipanema', 3),
(28, 'Asa Norte', 6),
(29, 'Botafogo', 3),
(30, 'Vila Andrade', 13),
(31, 'Vila Mariana', 13),
(32, 'Vila Silva Ribeiro', 15),
(33, 'ConsolaÃ§Ã£o', 13),
(34, 'Vila Nova ConceiÃ§Ã£o', 13),
(35, 'Curucutu', 16),
(36, 'Pinheiros', 13),
(37, 'Vila Buarque', 13),
(38, 'Piratininga', 17),
(39, 'Del Castilho', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_causa`
--

CREATE TABLE `tb_causa` (
  `cd_causa` int(11) NOT NULL,
  `nm_causa` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tb_causa`
--

INSERT INTO `tb_causa` (`cd_causa`, `nm_causa`) VALUES
(1, 'Cidadania'),
(2, 'Combate Ã  Pobreza'),
(3, 'CrianÃ§as'),
(4, 'Cultura e Arte'),
(5, 'Direitos Humanos'),
(6, 'EducaÃ§Ã£o'),
(7, 'Idosos'),
(8, 'Meio Ambiente'),
(9, 'Pessoas com DeficiÃªncia'),
(10, 'ProteÃ§Ã£o Animal'),
(11, 'SaÃºde'),
(12, 'Treinamento Profissional'),
(13, 'PolÃ­tica'),
(14, 'Jovens'),
(15, 'Mulheres');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `cd_cidade` int(11) NOT NULL,
  `nm_cidade` varchar(70) DEFAULT NULL,
  `cd_uf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`cd_cidade`, `nm_cidade`, `cd_uf`) VALUES
(1, 'SÃ£o Vicente', 1),
(3, 'Rio de Janeiro', 3),
(4, 'AcarÃ¡', 4),
(5, 'Imperatriz', 5),
(6, 'BrasÃ­lia', 6),
(7, 'Sinop', 7),
(8, 'Rio Branco', 8),
(10, 'Manacapuru', 10),
(11, 'Passo Fundo', 11),
(12, 'Cacoal', 12),
(13, 'SÃ£o Paulo', 1),
(15, 'CarapicuÃ­ba', 1),
(16, 'SÃ£o Bernardo do Campo', 1),
(17, 'Osasco', 1),
(18, 'Salvador', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_complemento`
--

CREATE TABLE `tb_complemento` (
  `cd_complemento` int(11) NOT NULL,
  `nm_complemento` varchar(70) DEFAULT NULL,
  `cd_numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_confirmacao_evento`
--

CREATE TABLE `tb_confirmacao_evento` (
  `cd_confirmacao` int(11) NOT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_evento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contato`
--

CREATE TABLE `tb_contato` (
  `id_contato` int(11) NOT NULL,
  `cd_contato` varchar(16) NOT NULL,
  `cd_ong` int(11) DEFAULT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_tipo_contato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_evento`
--

CREATE TABLE `tb_evento` (
  `cd_evento` int(11) NOT NULL,
  `nm_evento` varchar(70) DEFAULT NULL,
  `ds_evento` varchar(500) DEFAULT NULL,
  `dt_publicacao` date NOT NULL,
  `dt_inicio` date DEFAULT NULL,
  `dt_fim` date DEFAULT NULL,
  `hr_inicio` time(6) DEFAULT NULL,
  `hr_fim` time(6) DEFAULT NULL,
  `im_foto` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nm_numero` varchar(10) NOT NULL,
  `cd_ong` int(11) DEFAULT NULL,
  `cd_logradouro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_formacao`
--

CREATE TABLE `tb_formacao` (
  `cd_formacao` int(11) NOT NULL,
  `nm_formacao` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_formacao`
--

INSERT INTO `tb_formacao` (`cd_formacao`, `nm_formacao`) VALUES
(1, 'AdministraÃ§Ã£o'),
(2, 'Agronomia'),
(3, 'Arqueologia'),
(4, 'Alimentos'),
(5, 'AnÃ¡lise-e-Desenvolvimento-de-Sistemas'),
(6, 'AnÃ¡lises-ClÃ­nicas'),
(7, 'Antropologia'),
(8, 'Arquologia'),
(9, 'Arquitetura-e-Urbanismo'),
(10, 'Arquivologia'),
(11, 'Artes'),
(12, 'Artes-CÃªnicas'),
(13, 'Artes-GrÃ¡ficas'),
(14, 'Artes-PlÃ¡stica'),
(15, 'Artes-Visuais'),
(16, 'Biblioteconomia'),
(17, 'Biomedicina'),
(18, 'CiÃªncia-da-ComputaÃ§Ã£o'),
(19, 'CiÃªncias-BiolÃ³gicas'),
(20, 'CiÃªncias-Atuariais'),
(21, 'CiÃªncias-ContÃ¡beis'),
(22, 'CiÃªncias-EconÃ´micas'),
(23, 'CiÃªncias-Naturais'),
(24, 'CiÃªncias-Sociais'),
(25, 'Cinema-e-Audiovisual'),
(26, 'DanÃ§a'),
(27, 'Design'),
(28, 'Direito'),
(29, 'EducaÃ§Ã£o-FÃ­sica'),
(30, 'Enfermagem'),
(31, 'Engenharia-AeronÃ¡utica'),
(32, 'Engenharia-AgrÃ­cola'),
(33, 'Engenharia-Ambiental-e-SanitÃ¡ria'),
(34, 'Engenharia-CartogrÃ¡fica-e-de-Agrimensura'),
(35, 'Engenharia-Civil'),
(36, 'Engenharia-de-Alimentos'),
(37, 'Engenharia-de-Bioprocessos'),
(38, 'Engenharia-de-ComputaÃ§Ã£o'),
(39, 'Engenharia-de-Controle-e-AutomaÃ§Ã£o'),
(40, 'Engenharia-de-Materiais'),
(41, 'Engenharia-de-Minas'),
(42, 'Engenharia-de-Pesca'),
(43, 'Engenharia-de-PetrÃ³leo'),
(44, 'Engenharia-de-ProduÃ§Ã£o'),
(45, 'Engenharia-de-TelecomunicaÃ§Ãµes'),
(46, 'Engenharia-ElÃ©trica'),
(47, 'Engenharia-EletrÃ´nica'),
(48, 'Engenharia-Florestal'),
(49, 'Engenharia-MecÃ¢nica'),
(50, 'Engenharia-MetalÃºrgica'),
(51, 'Engenharia-Naval'),
(52, 'Engenharia-Nuclear'),
(53, 'Engenharia-QuÃ­mica'),
(54, 'Engenharia-TÃªxtil'),
(55, 'EstatÃ­stica'),
(56, 'FarmÃ¡cia'),
(57, 'Filosofia'),
(58, 'FÃ­sica'),
(59, 'Fisioterapia'),
(60, 'Fonoaudiologia'),
(61, 'Geografia'),
(62, 'Geologia'),
(63, 'HistÃ³ria'),
(64, 'InformÃ¡tica'),
(65, 'Jornalismo'),
(66, 'Letras-LÃ­ngua-Estrangeira'),
(67, 'Letras-LÃ­ngua-Portuguesa'),
(68, 'MatemÃ¡tica'),
(69, 'Medicina'),
(70, 'Medicina-VeterinÃ¡ria'),
(71, 'Meteorologia'),
(72, 'Museologia'),
(73, 'MÃºsica'),
(74, 'NutriÃ§Ã£o'),
(75, 'Odontologia'),
(76, 'Pedagogia'),
(77, 'Psicologia'),
(78, 'Publicidade-e-Propaganda'),
(79, 'QuÃ­mica'),
(80, 'Radio,-TV,-Internet'),
(81, 'RelaÃ§Ãµes-Internacionais'),
(82, 'RelaÃ§Ãµes-PÃºblicas'),
(83, 'Secretariado-Executivo'),
(84, 'ServiÃ§o-Social'),
(85, 'Sistemas-da-InformaÃ§Ã£o'),
(86, 'Teatro'),
(87, 'Teologia'),
(88, 'Terapia-Ocupacional'),
(89, 'Turismo'),
(90, 'Zootecnia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_habilidade`
--

CREATE TABLE `tb_habilidade` (
  `cd_habilidade` int(11) NOT NULL,
  `nm_habilidade` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_habilidade`
--

INSERT INTO `tb_habilidade` (`cd_habilidade`, `nm_habilidade`) VALUES
(1, 'Artes/Trabalho Manual'),
(2, 'ComunicaÃ§Ã£o'),
(3, 'DanÃ§a/MÃºsica'),
(4, 'Direito'),
(5, 'EducaÃ§Ã£o'),
(6, 'Esportes'),
(7, 'Cozinha'),
(8, 'Gerenciamento'),
(9, 'Idiomas'),
(10, 'Computadores/Tecnologia'),
(11, 'SaÃºde'),
(12, 'EducaÃ§Ã£o'),
(13, 'OrganizaÃ§Ã£o'),
(14, 'Agilidade'),
(15, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_logradouro`
--

CREATE TABLE `tb_logradouro` (
  `cd_logradouro` int(11) NOT NULL,
  `nm_logradouro` varchar(100) DEFAULT NULL,
  `cd_cep` varchar(10) DEFAULT NULL,
  `cd_bairro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_logradouro`
--

INSERT INTO `tb_logradouro` (`cd_logradouro`, `nm_logradouro`, `cd_cep`, `cd_bairro`) VALUES
(1, 'Avenida das NaÃ§Ãµes Unidas', '11330300', 1),
(7, 'Avenida Jambeiro', '21330300', 5),
(11, 'Avenida Dois', '11330320', 1),
(12, 'Rua Paula LourenÃ§o Oliveira', '11330330', 1),
(14, 'SHCES Quadra 1409 Bloco D', '70658494', 11),
(15, 'Avenida Rute de Souza Silva', '78551109', 12),
(16, 'Rua GastÃ£o LobÃ£o', '69915374', 13),
(18, 'Rua Coronel Madeira', '69400577', 15),
(19, 'Rua Manoel Thomas Resende', '99050135', 16),
(20, 'Avenida Porto Velho', '76963543', 17),
(21, 'Rua Bartolomeo Bandinelli', '05524130', 18),
(22, 'Viela Cento e Trinta e Nove', '11330695', 1),
(23, 'Rua Teles', '21320300', 6),
(25, 'Rua Lovely Plauchut', '11330803', 1),
(26, 'Rua Quarenta e TrÃªs', '11348260', 20),
(27, 'PraÃ§a Doutor Bernardino de Campos', '11310300', 21),
(28, 'Rua Guilherme Raposo de Almeida', '11350200', 22),
(29, 'Rua Benigno AntÃ´nio Pimenta', '11350250', 22),
(30, 'Rua dos Cantores', '01103090', 23),
(31, 'Rua Professor AndrÃ© Retz', '11340250', 24),
(32, 'Rua Professora Carolina Ribeiro de Barros', '11340300', 24),
(33, 'Rua Monte Plano', '11335020', 1),
(34, 'Alameda Ari Barroso', '11320400', 25),
(35, 'Avenida Paulista', '01311300', 26),
(36, 'Rua Alberto de Campos', '22411030', 27),
(37, 'CLN 211 Bloco B', '70863520', 28),
(38, 'Rua das Palmeiras', '22270070', 29),
(39, 'Avenida Giovanni Gronchi', '05724002', 30),
(40, 'Rua Professor JoÃ£o Marinho', '04007010', 31),
(41, 'Avenida InocÃªncio SerÃ¡fico', '06380021', 32),
(42, 'Avenida AngÃ©lica', '01227200', 33),
(43, 'Avenida Santo Amaro', '04506001', 34),
(44, 'Rua do Alambique', '09835000', 35),
(45, 'Rua Oscar Freire', '05409012', 36),
(46, 'Campus UniversitÃ¡rio Darcy Ribeiro', '70910900', 28),
(47, 'Rua Doutor CesÃ¡rio Mota JÃºnior', '01221020', 37),
(48, 'Avenida GetÃºlio Vargas', '06233020', 38),
(49, 'Largo do Queimadinho', '40325256', 15),
(50, 'Rua Vlaminck', '20771360', 39);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_numero`
--

CREATE TABLE `tb_numero` (
  `cd_numero` int(11) NOT NULL,
  `nm_numero` varchar(10) DEFAULT NULL,
  `cd_logradouro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_numero`
--

INSERT INTO `tb_numero` (`cd_numero`, `nm_numero`, `cd_logradouro`) VALUES
(1, '1123', 1),
(9, '1123', 7),
(12, '1145', 11),
(14, '1145', 12),
(16, '23', 14),
(17, '2111', 15),
(18, '270', 16),
(20, '122', 18),
(21, '1234', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ong`
--

CREATE TABLE `tb_ong` (
  `cd_ong` int(11) NOT NULL,
  `nm_ong` varchar(70) DEFAULT NULL,
  `nm_email_ong` varchar(70) DEFAULT NULL,
  `cd_cnpj_ong` varchar(18) DEFAULT NULL,
  `dt_criacao` date NOT NULL,
  `im_ong` varchar(100) DEFAULT NULL,
  `ds_ong` varchar(500) DEFAULT NULL,
  `nm_numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cd_logradouro` int(11) DEFAULT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_causa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_rede_social`
--

CREATE TABLE `tb_rede_social` (
  `cd_rede_social` int(11) NOT NULL,
  `nm_rede_social` varchar(70) DEFAULT NULL,
  `cd_ong` int(11) DEFAULT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_tipo_rede_social` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_registro_vaga`
--

CREATE TABLE `tb_registro_vaga` (
  `cd_registro_vaga` int(11) NOT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_contato`
--

CREATE TABLE `tb_tipo_contato` (
  `cd_tipo_contato` int(11) NOT NULL,
  `nm_tipo_contato` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_tipo_contato`
--

INSERT INTO `tb_tipo_contato` (`cd_tipo_contato`, `nm_tipo_contato`) VALUES
(1, 'Telefone Fixo'),
(2, 'Celular');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_rede_social`
--

CREATE TABLE `tb_tipo_rede_social` (
  `cd_tipo_rede_social` int(11) NOT NULL,
  `nm_tipo_rede_social` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_tipo_rede_social`
--

INSERT INTO `tb_tipo_rede_social` (`cd_tipo_rede_social`, `nm_tipo_rede_social`) VALUES
(1, 'Facebook'),
(2, 'Instagram'),
(3, 'Whatsapp'),
(4, 'Site\r\n'),
(5, 'Twitter');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_trabalho_realizado`
--

CREATE TABLE `tb_trabalho_realizado` (
  `cd_trabalho_realizado` int(11) NOT NULL,
  `nm_trabalho_realizado` varchar(45) DEFAULT NULL,
  `ds_trabalho_realizado` varchar(500) DEFAULT NULL,
  `hr_carga_trabalho_realizado` varchar(70) DEFAULT NULL,
  `nm_ong` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `dt_inicio_trabalho` date NOT NULL,
  `dt_fim_trabalho` date NOT NULL,
  `nm_liberado_ong` varchar(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cd_voluntario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_uf`
--

CREATE TABLE `tb_uf` (
  `cd_uf` int(11) NOT NULL,
  `sg_uf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_uf`
--

INSERT INTO `tb_uf` (`cd_uf`, `sg_uf`) VALUES
(1, 'SP'),
(3, 'RJ'),
(4, 'PA'),
(5, 'MA'),
(6, 'DF'),
(7, 'MT'),
(8, 'AC'),
(10, 'AM'),
(11, 'RS'),
(12, 'RO'),
(14, 'BA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_vaga`
--

CREATE TABLE `tb_vaga` (
  `cd_vaga` int(11) NOT NULL,
  `nm_vaga` varchar(70) DEFAULT NULL,
  `ds_vaga` varchar(500) DEFAULT NULL,
  `hr_carga_horaria` varchar(70) DEFAULT NULL,
  `dt_publicacao` date NOT NULL,
  `dt_inicio` date NOT NULL,
  `dt_fim` date NOT NULL,
  `hr_inicio` time(6) NOT NULL,
  `hr_fim` time(6) NOT NULL,
  `nm_periodo` varchar(70) DEFAULT NULL,
  `im_vaga` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `qt_limite_pessoas` int(11) NOT NULL,
  `nm_numero` varchar(11) NOT NULL,
  `cd_ong` int(11) DEFAULT NULL,
  `cd_logradouro` int(11) DEFAULT NULL,
  `cd_formacao` int(11) DEFAULT NULL,
  `cd_habilidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_voluntario`
--

CREATE TABLE `tb_voluntario` (
  `cd_voluntario` int(11) NOT NULL,
  `nm_voluntario` varchar(70) DEFAULT NULL,
  `nm_usuario_voluntario` varchar(35) DEFAULT NULL,
  `nm_email_voluntario` varchar(100) DEFAULT NULL,
  `nm_senha_voluntario` varchar(20) DEFAULT NULL,
  `cd_cpf_voluntario` varchar(15) DEFAULT NULL,
  `dt_nascimento_voluntario` date DEFAULT NULL,
  `ds_voluntario` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `im_voluntario` varchar(100) DEFAULT NULL,
  `cd_formacao` int(11) DEFAULT NULL,
  `cd_habilidade` int(11) DEFAULT NULL,
  `nm_numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cd_logradouro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_bairro`
--
ALTER TABLE `tb_bairro`
  ADD PRIMARY KEY (`cd_bairro`),
  ADD KEY `fk_bairro_cidade` (`cd_cidade`);

--
-- Índices para tabela `tb_causa`
--
ALTER TABLE `tb_causa`
  ADD PRIMARY KEY (`cd_causa`);

--
-- Índices para tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`cd_cidade`),
  ADD KEY `fk_cidade_uf` (`cd_uf`);

--
-- Índices para tabela `tb_complemento`
--
ALTER TABLE `tb_complemento`
  ADD PRIMARY KEY (`cd_complemento`),
  ADD KEY `fk_complemento_numero` (`cd_numero`);

--
-- Índices para tabela `tb_confirmacao_evento`
--
ALTER TABLE `tb_confirmacao_evento`
  ADD PRIMARY KEY (`cd_confirmacao`),
  ADD KEY `cd_voluntario` (`cd_voluntario`),
  ADD KEY `cd_evento` (`cd_evento`);

--
-- Índices para tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `fk_numero_ong` (`cd_ong`),
  ADD KEY `fk_numero_voluntario` (`cd_voluntario`),
  ADD KEY `fk_tipo_contato` (`cd_tipo_contato`),
  ADD KEY `id_contato` (`id_contato`);

--
-- Índices para tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`cd_evento`),
  ADD KEY `fk_evento_ong` (`cd_ong`),
  ADD KEY `fk_evento_logradouro` (`cd_logradouro`);

--
-- Índices para tabela `tb_formacao`
--
ALTER TABLE `tb_formacao`
  ADD PRIMARY KEY (`cd_formacao`);

--
-- Índices para tabela `tb_habilidade`
--
ALTER TABLE `tb_habilidade`
  ADD PRIMARY KEY (`cd_habilidade`);

--
-- Índices para tabela `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  ADD PRIMARY KEY (`cd_logradouro`),
  ADD KEY `fk_logradouro_bairro` (`cd_bairro`);

--
-- Índices para tabela `tb_numero`
--
ALTER TABLE `tb_numero`
  ADD PRIMARY KEY (`cd_numero`),
  ADD KEY `fk_numero_logradouro` (`cd_logradouro`);

--
-- Índices para tabela `tb_ong`
--
ALTER TABLE `tb_ong`
  ADD PRIMARY KEY (`cd_ong`),
  ADD KEY `fk_ong_logradouro` (`cd_logradouro`),
  ADD KEY `fk_ong_voluntario` (`cd_voluntario`),
  ADD KEY `fk_ong_causa` (`cd_causa`);

--
-- Índices para tabela `tb_rede_social`
--
ALTER TABLE `tb_rede_social`
  ADD PRIMARY KEY (`cd_rede_social`),
  ADD KEY `fk_rede_social_ong` (`cd_ong`),
  ADD KEY `fk_rede_social_voluntario` (`cd_voluntario`),
  ADD KEY `fk_tipo_rede_social` (`cd_tipo_rede_social`);

--
-- Índices para tabela `tb_registro_vaga`
--
ALTER TABLE `tb_registro_vaga`
  ADD PRIMARY KEY (`cd_registro_vaga`),
  ADD KEY `fk_registro_vaga_voluntario` (`cd_voluntario`),
  ADD KEY `fk_registro_vaga_vaga` (`cd_vaga`);

--
-- Índices para tabela `tb_tipo_contato`
--
ALTER TABLE `tb_tipo_contato`
  ADD PRIMARY KEY (`cd_tipo_contato`);

--
-- Índices para tabela `tb_tipo_rede_social`
--
ALTER TABLE `tb_tipo_rede_social`
  ADD PRIMARY KEY (`cd_tipo_rede_social`);

--
-- Índices para tabela `tb_trabalho_realizado`
--
ALTER TABLE `tb_trabalho_realizado`
  ADD PRIMARY KEY (`cd_trabalho_realizado`),
  ADD KEY `fk_trabalho_realizado_voluntario` (`cd_voluntario`);

--
-- Índices para tabela `tb_uf`
--
ALTER TABLE `tb_uf`
  ADD PRIMARY KEY (`cd_uf`);

--
-- Índices para tabela `tb_vaga`
--
ALTER TABLE `tb_vaga`
  ADD PRIMARY KEY (`cd_vaga`),
  ADD KEY `fk_vaga_ong` (`cd_ong`),
  ADD KEY `fk_vaga_logradouro` (`cd_logradouro`),
  ADD KEY `fk_vaga_formacao` (`cd_formacao`),
  ADD KEY `fk_vaga_habilidade` (`cd_habilidade`);

--
-- Índices para tabela `tb_voluntario`
--
ALTER TABLE `tb_voluntario`
  ADD PRIMARY KEY (`cd_voluntario`),
  ADD KEY `fk_logradouro_voluntario` (`cd_logradouro`),
  ADD KEY `fk_formacao_voluntario` (`cd_formacao`),
  ADD KEY `fk_habilidade_voluntario` (`cd_habilidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_bairro`
--
ALTER TABLE `tb_bairro`
  MODIFY `cd_bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `tb_causa`
--
ALTER TABLE `tb_causa`
  MODIFY `cd_causa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `cd_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tb_complemento`
--
ALTER TABLE `tb_complemento`
  MODIFY `cd_complemento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_confirmacao_evento`
--
ALTER TABLE `tb_confirmacao_evento`
  MODIFY `cd_confirmacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `cd_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `tb_formacao`
--
ALTER TABLE `tb_formacao`
  MODIFY `cd_formacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `tb_habilidade`
--
ALTER TABLE `tb_habilidade`
  MODIFY `cd_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
