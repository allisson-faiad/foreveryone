-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Dez-2019 às 16:15
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_foreveryone2`
--

DELIMITER $$
--
-- Procedures
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

--
-- Extraindo dados da tabela `tb_contato`
--

INSERT INTO `tb_contato` (`id_contato`, `cd_contato`, `cd_ong`, `cd_voluntario`, `cd_tipo_contato`) VALUES
(1, '(13) 3461-6036', NULL, 47, 1),
(2, '(13) 99624-2235', NULL, 47, 2),
(6, '(13) 3461-6036', NULL, 1, 1),
(7, '', NULL, 1, 2),
(8, '', NULL, 4, 1),
(9, '', NULL, 4, 2),
(10, '', NULL, 2, 1),
(11, '', NULL, 2, 2),
(20, '(11) 3262-4088', 12, NULL, 1),
(21, '(21) 2555-3750', 13, NULL, 1),
(22, '(61) 2109-4150', 14, NULL, 1),
(23, '(21) 2286-9988', 15, NULL, 1),
(24, '(11) 2081-6199', 16, NULL, 1),
(25, '', NULL, 52, 1),
(26, '', NULL, 52, 2),
(27, '(11) 9505-0425', 17, NULL, 1),
(28, '(11) 4374-2030', 18, NULL, 1),
(29, '(11) 7264-040', 19, NULL, 1),
(30, '(11) 4004-5545', 20, NULL, 1),
(31, '(11) 4397-5528', 21, NULL, 1),
(32, '(11) 4397-5528', 22, NULL, 1),
(33, '', NULL, 5, 1),
(34, '', NULL, 5, 2),
(35, '', NULL, 45, 1),
(36, '', NULL, 45, 2);

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

--
-- Extraindo dados da tabela `tb_evento`
--

INSERT INTO `tb_evento` (`cd_evento`, `nm_evento`, `ds_evento`, `dt_publicacao`, `dt_inicio`, `dt_fim`, `hr_inicio`, `hr_fim`, `im_foto`, `nm_numero`, `cd_ong`, `cd_logradouro`) VALUES
(16, 'RelaÃ§Ã£o do Meio Ambiente com a SaÃºde da PopulaÃ§Ã£o', 'BenefÃ­cios e a importÃ¢ncia na saÃºde devido a Mata AtlÃ¢ntica.', '2019-12-09', '2020-03-18', '2020-03-18', '10:00:00.000000', '13:00:00.000000', '../.././ForEveryone/user_img/15758627665dedc1ee12ac3.jpg', '2500', 12, 45),
(17, 'Viva Rio Completa 20 anos', 'Inova hÃ¡ 20 anos, quando juntou intelectuais e lideranÃ§as comunitÃ¡rias contra a violÃªncia no rio. ', '2019-12-09', '2020-01-12', '2020-01-12', '13:00:00.000000', '17:00:00.000000', '../.././ForEveryone/user_img/15758630015dedc2d92679b.jpg', '12', 13, 36),
(18, 'Agricultura e conservaÃ§Ã£o na AmazÃ´nia e no cerrado', 'Conciliar a produÃ§Ã£o de alimentos, a integridade ambiental e as mudanÃ§as climÃ¡ticas.', '2019-12-09', '2020-01-10', '2020-01-10', '15:00:00.000000', '18:00:00.000000', '../.././ForEveryone/user_img/15758632505dedc3d21e21a.jpg', '1', 14, 46),
(19, 'PromoÃ§Ã£o de SaÃºde da CrianÃ§a e do Adolescente', 'AlÃ©m da discussÃ£o do tema, serÃ¡ realizada uma aÃ§Ã£o de saÃºde na Comunidade do GlicÃ©rio.', '2019-12-09', '2020-01-08', '2020-01-13', '07:00:00.000000', '12:00:00.000000', '../.././ForEveryone/user_img/15758636955dedc58f7a64a.jpg', '61', 15, 47),
(20, 'Happy Day AACD', 'O evento proporciona diversas atividades, oficinas, brincadeiras, apresentaÃ§Ãµes e interaÃ§Ãµes.', '2019-12-09', '2020-02-02', '2020-02-02', '10:00:00.000000', '18:00:00.000000', '../.././ForEveryone/user_img/15758639275dedc6774b875.gif', '1150', 16, 48),
(21, 'Palestra de acolhimento de crianÃ§as e adolescentes', 'Compartilhar expertises no acolhimento de crianÃ§as e adolescentes com parceiros.', '2019-12-09', '2020-02-23', '2020-02-24', '12:00:00.000000', '14:00:00.000000', '../.././ForEveryone/user_img/15758641755dedc76fc1c53.jpg', '17', 21, 49),
(22, 'FLORESCER: o DESPERTAR de uma nova MULHER', 'Em nome do resgate do AMOR, da cumplicidade, da amizade e apoio de pura uniÃ£o entre nÃ³s MULHERES.', '2019-12-09', '2020-03-13', '2020-03-13', '15:00:00.000000', '18:00:00.000000', '../.././ForEveryone/user_img/15758643275dedc8076ea04.jpg', '217', 22, 50),
(23, 'FormaÃ§Ã£o de Turma InclusÃ£o Digital', 'FormaÃ§Ã£o de turma para as aulas de inclusÃ£o digital, com direito a certificado ao final.', '2019-12-09', '2020-01-10', '2020-03-14', '16:00:00.000000', '18:00:00.000000', '../.././ForEveryone/user_img/15758645835dedc90722178.jpg', '3500', 18, 41),
(24, 'Como ser um bom servidor pÃºblico', 'Busca exemplificar os pilares do servidor pÃºblico.', '2019-12-09', '2020-03-10', '2020-03-10', '10:00:00.000000', '12:00:00.000000', '../.././ForEveryone/user_img/15758648115dedc9ebf2ffc.gif', '1', 19, 42),
(26, 'Lei do Aprendiz', 'DiscussÃµes acerca da aprendizagem em relaÃ§Ã£o ao trabalho.', '2019-12-09', '2020-02-02', '2020-02-02', '17:00:00.000000', '18:00:00.000000', '../.././ForEveryone/user_img/15758696695deddce569563.png', '1386', 20, 43);

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

--
-- Extraindo dados da tabela `tb_ong`
--

INSERT INTO `tb_ong` (`cd_ong`, `nm_ong`, `nm_email_ong`, `cd_cnpj_ong`, `dt_criacao`, `im_ong`, `ds_ong`, `nm_numero`, `cd_logradouro`, `cd_voluntario`, `cd_causa`) VALUES
(6, 'For Everyone', 'foreveryone.oficial2019@gmail.com', NULL, '2019-09-25', '../.././ForEveryone/user_img/15693904285d8aff5ce32a5.png', 'Nossa ong Ã© voltada para a area ambiental', '1123', 1, 1, 8),
(9, 'Dragon Help', 'dragonhelp@gmail.com', '', '2019-11-26', '../.././ForEveryone/user_img/15747791485ddd390c6dc75.png', 'Somos uma ONG que cuida de animais, e doa-os para quem deseja cuidar', '1122', 30, 8, 10),
(12, 'SOS Mata AtlÃ¢ntica', 'sos@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758592395dedb427cd628.jpg', 'Desenvolve aÃ§Ãµes em benefÃ­cio do meio ambiente, e realiza, entre outras coisas, o mapeamento e monitoramento de toda Ã¡rea de conservaÃ§Ã£o vegetal desse bioma.', '2073', 35, 5, 8),
(13, 'Viva Rio', 'vivario@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758594245dedb4e06c473.png', 'Tem como principal objetivo promover a paz, inclusÃ£o e justiÃ§a atravÃ©s de projetos de conscientizaÃ§Ã£o em Ã¡reas de baixa renda e, principalmente, em regiÃµes violentas do Rio de Janeiro. ', '12', 36, 5, 5),
(14, 'Instituto de Pesquisa Ambiental da AmazÃ´nia', 'ipam@gmaill.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758596375dedb5b57b212.png', 'Desenvolvimento sustentÃ¡vel da AmazÃ´nia. Com o objetivo de desenvolver, atÃ© 2035, a regiÃ£o atravÃ©s da produÃ§Ã£o familiar sustentÃ¡vel, proteger territÃ³rios naturais e promover a agropecuÃ¡ria de baixo carbono.', '211', 37, 5, 8),
(15, 'SaÃºde CrianÃ§a', 'saudecrianca@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758601565dedb7bcd917e.png', 'Em conjunto com famÃ­lias carentes e equipes formadas por assistentes sociais, nutricionistas e psicÃ³logos a fim de atender cada famÃ­lia a partir de suas necessidades. ', '65', 38, 45, 3),
(16, 'AssociaÃ§Ã£o de AssistÃªncia Ã  CrianÃ§a Deficiente', 'aacd@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758602555dedb81f33ae8.png', 'Grande referencia no tratamento de pessoas com deficiÃªncia fÃ­sica no Brasil.', '549', 39, 45, 9),
(17, 'TransparÃªncia Brasil', 'transparenciabrasil@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758607955dedba3b035d7.png', 'Focada em combater a corrupÃ§Ã£o atravÃ©s do aumento da informaÃ§Ã£o do poder pÃºblico brasileiro. Hoje, a entidade Ã© a mais mencionada pelos principais veÃ­culos de comunicaÃ§Ã£o do paÃ­s e Ã© fonte de informaÃ§Ã£o para todos os brasileiros.', '161', 40, 52, 13),
(18, 'Centro de InclusÃ£o Digital', 'inclusaodigital@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758609005dedbaa490407.png', 'Utiliza as tecnologias da informaÃ§Ã£o como meio de mobilizar e transformar vidas. Hoje, sÃ£o 842 Centros de InclusÃ£o Digital distribuÃ­dos por 15 paÃ­ses.', '3500', 41, 52, 5),
(19, 'Vetor Brasil', 'vetor@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758611845dedbbc07a495.jpg', 'Atrair, avaliar e desenvolver profissionais pÃºblicos. Desde sua criaÃ§Ã£o foram formados e inseridos em cargos pÃºblicos 140 profissionais em 30 governos de 10 partidos polÃ­ticos em todo o Brasil.', '2529', 42, 2, 12),
(20, 'FundaÃ§Ã£o Abrinq', 'abrinq@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758613245dedbc4c250b4.png', 'Defender a cidadania e a infÃ¢ncia de crianÃ§as e adolescentes Ã© a missÃ£o da ONG. Em 2015, por exemplo, a FundaÃ§Ã£o beneficiou 268.743 crianÃ§as e esteve presente 19 projetos espalhados pelo Brasil.', '1386', 43, 2, 3),
(21, 'Aldeias Infantis', 'aldeiasinfantis@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758616565dedbd9880603.png', 'Tem como foco cuidar de crianÃ§as e adolescentes em situaÃ§Ã£o de vulnerabilidade, oferecendo aÃ§Ãµes de educaÃ§Ã£o, esporte, lazer e renda.', '200', 44, 4, 3),
(22, 'Nova Mulher', 'novamulher@gmail.com', '', '2019-12-09', '../.././ForEveryone/user_img/15758619455dedbeb921edf.jpg', 'Objetivamos estimular o empoderamento das mulheres, com atividades de geraÃ§Ã£o de renda, autoestima, acesso a direitos e enfrentamento Ã  violÃªncia domÃ©stica.', '200', 44, 4, 15);

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

--
-- Extraindo dados da tabela `tb_rede_social`
--

INSERT INTO `tb_rede_social` (`cd_rede_social`, `nm_rede_social`, `cd_ong`, `cd_voluntario`, `cd_tipo_rede_social`) VALUES
(1, 'For Everyone', NULL, 1, 1),
(2, '13996242235', NULL, 1, 3),
(3, 'wtf_faiad', NULL, 1, 2),
(4, 'www.faiad.com.br', NULL, 1, 4),
(9, '@wtf_faiad', NULL, 1, 5),
(10, 'Matheus Ileck', NULL, 4, 1),
(11, '@lelek', NULL, 4, 2),
(12, '@lelek', NULL, 4, 5),
(13, '13996343922', NULL, 4, 3),
(14, 'www.matheusileck.com.br', NULL, 4, 4),
(15, 'Alexia Marques', NULL, 5, 1),
(16, '@alicia', NULL, 5, 2),
(20, 'For Everyone', 6, NULL, 1),
(21, '@foreveryone', 6, NULL, 2),
(22, '@foreveryone', 6, NULL, 5),
(23, '13996242235', 6, NULL, 3),
(61, 'Carlos2', NULL, 2, 1),
(62, '13997902421', NULL, 5, 3),
(63, '13981706688', NULL, 2, 3),
(64, '13996242235', NULL, 45, 3),
(65, '13991835323', NULL, 52, 3),
(66, 'Vetor Brasil', 19, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_registro_vaga`
--

CREATE TABLE `tb_registro_vaga` (
  `cd_registro_vaga` int(11) NOT NULL,
  `cd_voluntario` int(11) DEFAULT NULL,
  `cd_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_registro_vaga`
--

INSERT INTO `tb_registro_vaga` (`cd_registro_vaga`, `cd_voluntario`, `cd_vaga`) VALUES
(15, 5, 25),
(16, 2, 25),
(22, 4, 18);

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

--
-- Extraindo dados da tabela `tb_trabalho_realizado`
--

INSERT INTO `tb_trabalho_realizado` (`cd_trabalho_realizado`, `nm_trabalho_realizado`, `ds_trabalho_realizado`, `hr_carga_trabalho_realizado`, `nm_ong`, `dt_inicio_trabalho`, `dt_fim_trabalho`, `nm_liberado_ong`, `cd_voluntario`) VALUES
(23, 'PsicolÃ³go focado em VocaÃ§Ã£o Profissional', 'PsicÃ³logo para realizaÃ§Ã£o de testes vocacionais que possam assim, auxiliar na escola da profissÃ£o e treinamento profissional.', '4', 'Vetor Brasil', '2019-12-04', '2019-12-09', '', 4);

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

--
-- Extraindo dados da tabela `tb_vaga`
--

INSERT INTO `tb_vaga` (`cd_vaga`, `nm_vaga`, `ds_vaga`, `hr_carga_horaria`, `dt_publicacao`, `dt_inicio`, `dt_fim`, `hr_inicio`, `hr_fim`, `nm_periodo`, `im_vaga`, `qt_limite_pessoas`, `nm_numero`, `cd_ong`, `cd_logradouro`, `cd_formacao`, `cd_habilidade`) VALUES
(16, 'Desenvolvimento de App para coleta de Ã³leo de cozinha', 'Aplicativo que indiquei pontos de coleta de Ã³leo de cozinha.', '4', '2019-12-09', '2020-03-10', '2020-03-18', '09:00:00.000000', '13:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758673315dedd3c37a189.jpg', 20, '2073', 12, 35, 5, 10),
(17, 'Educador Social - Artes Marciais', 'Desenvolver atividades de artes marciais para crianÃ§as e adolescentes da comunidade local em torno da InstituiÃ§Ã£o! ', '2', '2019-12-09', '2020-02-02', '2020-03-04', '14:00:00.000000', '16:00:00.000000', 'Tarde', '../.././ForEveryone/user_img/15758675505dedd49e48535.jpg', 10, '12', 13, 36, 76, 5),
(18, 'Conscientizar Ã  populaÃ§Ã£o', 'Atividades relacionadas a conscientizaÃ§Ã£o da comunidade e necessidades da comunidade indÃ­gena.', '2', '2019-12-09', '2020-02-02', '2020-03-01', '12:00:00.000000', '14:00:00.000000', 'Tarde', '../.././ForEveryone/user_img/15758678145dedd5a69b7a2.jpg', 5, '211', 14, 37, NULL, 2),
(19, 'PsicolÃ³go focado em VocaÃ§Ã£o Profissional', 'PsicÃ³logo para realizaÃ§Ã£o de testes vocacionais que possam assim, auxiliar na escola da profissÃ£o e treinamento profissional.', '4', '2019-11-29', '2019-12-04', '2019-12-09', '09:00:00.000000', '13:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758681025dedd6c6efd6d.jpeg', 2, '2529', 19, 42, 77, 5),
(20, 'Aulas de Pintura', 'Artista que realizarÃ¡ aulas de pintura para crianÃ§as carentes.', '1', '2019-12-09', '2020-01-04', '2020-02-03', '10:00:00.000000', '11:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758683015dedd78d909f4.jpg', 3, '1386', 20, 43, 11, 1),
(21, 'Videomaker', 'Criar um vÃ­deo paral estratÃ©gia de divulgaÃ§Ã£o, utilizaremos para a sensibilizaÃ§Ã£o da populaÃ§Ã£o.', '2', '2019-12-09', '2020-03-06', '2020-03-18', '14:00:00.000000', '16:00:00.000000', 'Tarde', '../.././ForEveryone/user_img/15758685645dedd8945ec80.jpg', 3, '65', 15, 38, 25, 10),
(22, 'FonoaudiÃ³logo', 'Conhecimento tÃ©cnico e dedicaÃ§Ã£o no atendimento a pessoas com deficiÃªncia.', '4', '2019-12-09', '2020-01-07', '2020-03-03', '09:00:00.000000', '13:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758686965dedd918e80ec.jpg', 6, '1150', 16, 48, 60, 15),
(23, 'Redator da TransparÃªncia Brasil', 'Busca fazer a redaÃ§Ã£o das pautas da TransparÃªncia Brasil, como notÃ­cias da mesma ou de descobertas.', '7', '2019-12-09', '2020-03-01', '2020-03-18', '09:00:00.000000', '16:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758689465dedda126c332.png', 2, '161', 17, 40, 65, 14),
(24, 'CaptaÃ§Ã£o de Recursos', 'Levantar e mobilizar recursos financeiros para a sustentabilidade da organizaÃ§Ã£o.', '7', '2019-12-09', '2020-03-10', '2020-03-18', '09:00:00.000000', '16:00:00.000000', 'ManhÃ£', '../.././ForEveryone/user_img/15758691285deddac82d4da.png', 3, '200', 21, 44, NULL, 13),
(25, 'Impulsionador(a) de Campanhas', 'Vem divulgar nossos projetos e cursos atravÃ©s das mÃ­dias sociais!', '4', '2019-12-09', '2020-02-02', '2020-03-03', '12:00:00.000000', '16:00:00.000000', 'Tarde', '../.././ForEveryone/user_img/15758692545deddb4626d47.jpg', 2, '200', 22, 44, 65, 2);

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
-- Extraindo dados da tabela `tb_voluntario`
--

INSERT INTO `tb_voluntario` (`cd_voluntario`, `nm_voluntario`, `nm_usuario_voluntario`, `nm_email_voluntario`, `nm_senha_voluntario`, `cd_cpf_voluntario`, `dt_nascimento_voluntario`, `ds_voluntario`, `im_voluntario`, `cd_formacao`, `cd_habilidade`, `nm_numero`, `cd_logradouro`) VALUES
(1, 'Administrador Principal', 'scrum master', 'admin', 'admin', '472.990.858-95', '2001-10-02', 'Tecnico em Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso', '../.././ForEveryone/user_img/15693887175d8af8ad82837.jpg', 19, 6, '1123', 1),
(2, 'Carlos VinÃ­cius Souza dos Santos', 'carlos_2k19', 'carlos.vinicius@hotmail.com', 'admin', '472.990.858-95', '2001-10-02', 'Busco a melhor versÃ£o de mim!', '../.././ForEveryone/user_img/15755669395de93e5be2674.jpeg', 6, 11, '80', 7),
(4, 'Matheus Ileck Farias', 'ileck_2k19', 'matheus.ileck@hotmail.com', 'admin', '', '2002-02-11', 'Tecnico em Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso', '../.././ForEveryone/user_img/15744497395dd8324b89e3f.jpg', 77, NULL, '123', 18),
(5, 'Alexia Ribeiro Marques', 'alexia_2k19', 'alexiaribeiro.marques@gmail.com', 'admin', '', '2000-08-20', 'Tecnica em Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso', NULL, NULL, NULL, '1255', 20),
(8, 'Luiza Souza Santos', 'luizinha99', 'luiza@gmail.com', 'admin', NULL, '2003-11-26', '', NULL, NULL, NULL, '332', 1),
(9, 'Ana Verenissima Carvalho', 'aninha2k9', 'anacct229@gmail.com', 'admin', NULL, '1999-09-30', '', NULL, NULL, NULL, '290', 28),
(10, 'Henrique de Ferraz', 'dj_henrique', 'henriquedeferraz_oficial@gmail.com', 'garupa123', NULL, '2001-10-02', '', NULL, NULL, NULL, '302', 1),
(11, 'Monalisa Pereira Rick', 'monaricka', 'monaricka@gmail.com', 'monaricka', NULL, '1991-08-09', '', NULL, NULL, NULL, '222', 1),
(12, 'AlÃ©xia Christina Santos Ribeiro', 'Lelexy', 'alexia.cristina.santos@gmail.com', 'admin', NULL, '2001-05-18', 'Sou um amor', '../.././ForEveryone/user_img/15749968135de08b4d98d49.jpg', NULL, NULL, '233', 28),
(45, 'Allisson Santos Faiad', 'allissaum', 'allisson@gmail.com', 'admin', '', '2001-10-02', 'dasfsadf', '../.././ForEveryone/user_img/15751517915de2e8afd1402.jpeg', NULL, NULL, '1185', 29),
(47, 'Willian Shakespeare da Silva', 'shakespeare', 'rick@hotmail.com', 'admin', NULL, '2001-10-02', 'aaaaa', '../.././ForEveryone/user_img/15751538495de2f0b93d809.jpg', NULL, NULL, '655', 31),
(52, 'Jaime Gabriel Sandim Santos', 'jaime_2k19', 'jaime.sandim@gmail.com', 'admin', '', '2001-08-18', 'Aluno do curso de Desenvolvimento de Sistemas', '../.././ForEveryone/user_img/15758605535dedb949b3695.jpg', 5, 1, '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bairro`
--
ALTER TABLE `tb_bairro`
  ADD PRIMARY KEY (`cd_bairro`),
  ADD KEY `fk_bairro_cidade` (`cd_cidade`);

--
-- Indexes for table `tb_causa`
--
ALTER TABLE `tb_causa`
  ADD PRIMARY KEY (`cd_causa`);

--
-- Indexes for table `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`cd_cidade`),
  ADD KEY `fk_cidade_uf` (`cd_uf`);

--
-- Indexes for table `tb_complemento`
--
ALTER TABLE `tb_complemento`
  ADD PRIMARY KEY (`cd_complemento`),
  ADD KEY `fk_complemento_numero` (`cd_numero`);

--
-- Indexes for table `tb_confirmacao_evento`
--
ALTER TABLE `tb_confirmacao_evento`
  ADD PRIMARY KEY (`cd_confirmacao`),
  ADD KEY `cd_voluntario` (`cd_voluntario`),
  ADD KEY `cd_evento` (`cd_evento`);

--
-- Indexes for table `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `fk_numero_ong` (`cd_ong`),
  ADD KEY `fk_numero_voluntario` (`cd_voluntario`),
  ADD KEY `fk_tipo_contato` (`cd_tipo_contato`),
  ADD KEY `id_contato` (`id_contato`);

--
-- Indexes for table `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`cd_evento`),
  ADD KEY `fk_evento_ong` (`cd_ong`),
  ADD KEY `fk_evento_logradouro` (`cd_logradouro`);

--
-- Indexes for table `tb_formacao`
--
ALTER TABLE `tb_formacao`
  ADD PRIMARY KEY (`cd_formacao`);

--
-- Indexes for table `tb_habilidade`
--
ALTER TABLE `tb_habilidade`
  ADD PRIMARY KEY (`cd_habilidade`);

--
-- Indexes for table `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  ADD PRIMARY KEY (`cd_logradouro`),
  ADD KEY `fk_logradouro_bairro` (`cd_bairro`);

--
-- Indexes for table `tb_numero`
--
ALTER TABLE `tb_numero`
  ADD PRIMARY KEY (`cd_numero`),
  ADD KEY `fk_numero_logradouro` (`cd_logradouro`);

--
-- Indexes for table `tb_ong`
--
ALTER TABLE `tb_ong`
  ADD PRIMARY KEY (`cd_ong`),
  ADD KEY `fk_ong_logradouro` (`cd_logradouro`),
  ADD KEY `fk_ong_voluntario` (`cd_voluntario`),
  ADD KEY `fk_ong_causa` (`cd_causa`);

--
-- Indexes for table `tb_rede_social`
--
ALTER TABLE `tb_rede_social`
  ADD PRIMARY KEY (`cd_rede_social`),
  ADD KEY `fk_rede_social_ong` (`cd_ong`),
  ADD KEY `fk_rede_social_voluntario` (`cd_voluntario`),
  ADD KEY `fk_tipo_rede_social` (`cd_tipo_rede_social`);

--
-- Indexes for table `tb_registro_vaga`
--
ALTER TABLE `tb_registro_vaga`
  ADD PRIMARY KEY (`cd_registro_vaga`),
  ADD KEY `fk_registro_vaga_voluntario` (`cd_voluntario`),
  ADD KEY `fk_registro_vaga_vaga` (`cd_vaga`);

--
-- Indexes for table `tb_tipo_contato`
--
ALTER TABLE `tb_tipo_contato`
  ADD PRIMARY KEY (`cd_tipo_contato`);

--
-- Indexes for table `tb_tipo_rede_social`
--
ALTER TABLE `tb_tipo_rede_social`
  ADD PRIMARY KEY (`cd_tipo_rede_social`);

--
-- Indexes for table `tb_trabalho_realizado`
--
ALTER TABLE `tb_trabalho_realizado`
  ADD PRIMARY KEY (`cd_trabalho_realizado`),
  ADD KEY `fk_trabalho_realizado_voluntario` (`cd_voluntario`);

--
-- Indexes for table `tb_uf`
--
ALTER TABLE `tb_uf`
  ADD PRIMARY KEY (`cd_uf`);

--
-- Indexes for table `tb_vaga`
--
ALTER TABLE `tb_vaga`
  ADD PRIMARY KEY (`cd_vaga`),
  ADD KEY `fk_vaga_ong` (`cd_ong`),
  ADD KEY `fk_vaga_logradouro` (`cd_logradouro`),
  ADD KEY `fk_vaga_formacao` (`cd_formacao`),
  ADD KEY `fk_vaga_habilidade` (`cd_habilidade`);

--
-- Indexes for table `tb_voluntario`
--
ALTER TABLE `tb_voluntario`
  ADD PRIMARY KEY (`cd_voluntario`),
  ADD KEY `fk_logradouro_voluntario` (`cd_logradouro`),
  ADD KEY `fk_formacao_voluntario` (`cd_formacao`),
  ADD KEY `fk_habilidade_voluntario` (`cd_habilidade`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bairro`
--
ALTER TABLE `tb_bairro`
  MODIFY `cd_bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_causa`
--
ALTER TABLE `tb_causa`
  MODIFY `cd_causa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `cd_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_complemento`
--
ALTER TABLE `tb_complemento`
  MODIFY `cd_complemento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_confirmacao_evento`
--
ALTER TABLE `tb_confirmacao_evento`
  MODIFY `cd_confirmacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_contato`
--
ALTER TABLE `tb_contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `cd_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_formacao`
--
ALTER TABLE `tb_formacao`
  MODIFY `cd_formacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tb_habilidade`
--
ALTER TABLE `tb_habilidade`
  MODIFY `cd_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  MODIFY `cd_logradouro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_numero`
--
ALTER TABLE `tb_numero`
  MODIFY `cd_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_ong`
--
ALTER TABLE `tb_ong`
  MODIFY `cd_ong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_rede_social`
--
ALTER TABLE `tb_rede_social`
  MODIFY `cd_rede_social` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_registro_vaga`
--
ALTER TABLE `tb_registro_vaga`
  MODIFY `cd_registro_vaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_tipo_contato`
--
ALTER TABLE `tb_tipo_contato`
  MODIFY `cd_tipo_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tipo_rede_social`
--
ALTER TABLE `tb_tipo_rede_social`
  MODIFY `cd_tipo_rede_social` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_trabalho_realizado`
--
ALTER TABLE `tb_trabalho_realizado`
  MODIFY `cd_trabalho_realizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_uf`
--
ALTER TABLE `tb_uf`
  MODIFY `cd_uf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_vaga`
--
ALTER TABLE `tb_vaga`
  MODIFY `cd_vaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_voluntario`
--
ALTER TABLE `tb_voluntario`
  MODIFY `cd_voluntario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_bairro`
--
ALTER TABLE `tb_bairro`
  ADD CONSTRAINT `fk_bairro_cidade` FOREIGN KEY (`cd_cidade`) REFERENCES `tb_cidade` (`cd_cidade`);

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `fk_cidade_uf` FOREIGN KEY (`cd_uf`) REFERENCES `tb_uf` (`cd_uf`);

--
-- Limitadores para a tabela `tb_confirmacao_evento`
--
ALTER TABLE `tb_confirmacao_evento`
  ADD CONSTRAINT `fk_confirmacao_evento` FOREIGN KEY (`cd_evento`) REFERENCES `tb_evento` (`cd_evento`),
  ADD CONSTRAINT `fk_confirmacao_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`);

--
-- Limitadores para a tabela `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD CONSTRAINT `fk_numero_ong` FOREIGN KEY (`cd_ong`) REFERENCES `tb_ong` (`cd_ong`),
  ADD CONSTRAINT `fk_numero_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`),
  ADD CONSTRAINT `fk_tipo_contato` FOREIGN KEY (`cd_tipo_contato`) REFERENCES `tb_tipo_contato` (`cd_tipo_contato`);

--
-- Limitadores para a tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD CONSTRAINT `fk_evento_logradouro` FOREIGN KEY (`cd_logradouro`) REFERENCES `tb_logradouro` (`cd_logradouro`),
  ADD CONSTRAINT `fk_evento_ong` FOREIGN KEY (`cd_ong`) REFERENCES `tb_ong` (`cd_ong`);

--
-- Limitadores para a tabela `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  ADD CONSTRAINT `fk_logradouro_bairro` FOREIGN KEY (`cd_bairro`) REFERENCES `tb_bairro` (`cd_bairro`);

--
-- Limitadores para a tabela `tb_numero`
--
ALTER TABLE `tb_numero`
  ADD CONSTRAINT `fk_numero_logradouro` FOREIGN KEY (`cd_logradouro`) REFERENCES `tb_logradouro` (`cd_logradouro`);

--
-- Limitadores para a tabela `tb_ong`
--
ALTER TABLE `tb_ong`
  ADD CONSTRAINT `fk_ong_causa` FOREIGN KEY (`cd_causa`) REFERENCES `tb_causa` (`cd_causa`),
  ADD CONSTRAINT `fk_ong_logradouro` FOREIGN KEY (`cd_logradouro`) REFERENCES `tb_logradouro` (`cd_logradouro`),
  ADD CONSTRAINT `fk_ong_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`);

--
-- Limitadores para a tabela `tb_rede_social`
--
ALTER TABLE `tb_rede_social`
  ADD CONSTRAINT `fk_rede_social_ong` FOREIGN KEY (`cd_ong`) REFERENCES `tb_ong` (`cd_ong`),
  ADD CONSTRAINT `fk_rede_social_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`),
  ADD CONSTRAINT `fk_tipo_rede_social` FOREIGN KEY (`cd_tipo_rede_social`) REFERENCES `tb_tipo_rede_social` (`cd_tipo_rede_social`);

--
-- Limitadores para a tabela `tb_registro_vaga`
--
ALTER TABLE `tb_registro_vaga`
  ADD CONSTRAINT `fk_registro_vaga_vaga` FOREIGN KEY (`cd_vaga`) REFERENCES `tb_vaga` (`cd_vaga`),
  ADD CONSTRAINT `fk_registro_vaga_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`);

--
-- Limitadores para a tabela `tb_trabalho_realizado`
--
ALTER TABLE `tb_trabalho_realizado`
  ADD CONSTRAINT `fk_trabalho_realizado_voluntario` FOREIGN KEY (`cd_voluntario`) REFERENCES `tb_voluntario` (`cd_voluntario`);

--
-- Limitadores para a tabela `tb_vaga`
--
ALTER TABLE `tb_vaga`
  ADD CONSTRAINT `fk_vaga_formacao` FOREIGN KEY (`cd_formacao`) REFERENCES `tb_formacao` (`cd_formacao`),
  ADD CONSTRAINT `fk_vaga_habilidade` FOREIGN KEY (`cd_habilidade`) REFERENCES `tb_habilidade` (`cd_habilidade`),
  ADD CONSTRAINT `fk_vaga_logradouro` FOREIGN KEY (`cd_logradouro`) REFERENCES `tb_logradouro` (`cd_logradouro`),
  ADD CONSTRAINT `fk_vaga_ong` FOREIGN KEY (`cd_ong`) REFERENCES `tb_ong` (`cd_ong`);

--
-- Limitadores para a tabela `tb_voluntario`
--
ALTER TABLE `tb_voluntario`
  ADD CONSTRAINT `fk_logradouro_voluntario` FOREIGN KEY (`cd_logradouro`) REFERENCES `tb_logradouro` (`cd_logradouro`),
  ADD CONSTRAINT `fk_voluntario_formacao` FOREIGN KEY (`cd_formacao`) REFERENCES `tb_formacao` (`cd_formacao`),
  ADD CONSTRAINT `fk_voluntario_habilidade` FOREIGN KEY (`cd_habilidade`) REFERENCES `tb_habilidade` (`cd_habilidade`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
