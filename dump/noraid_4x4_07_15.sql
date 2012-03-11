-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 15 Lip 2011, 02:44
-- Wersja serwera: 5.0.83
-- Wersja PHP: 5.2.5

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `noraid_4x4`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isVisible` binary(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id`, `title`, `path`, `isVisible`) VALUES
(1, 'Oferta wynajmu samochodu rajdowego Bowler Nemesis', 'oferta_wynajmu_samochodu_rajdowego_bowler_nemesis', '1'),
(3, 'Marzenia i rozsądek - wywiad z Piotrem Beaupré', 'marzenia_i_rozsadek_wywiad_z_piotrem_beaupre', '1'),
(4, 'Sylwetki zawodników', 'sylwetki_zawodnikow', '1'),
(5, 'Maraton Rowerowy 2008', 'maraton_rowerowy_2008', '1'),
(6, 'Kontakt', 'kontakt', '1'),
(7, 'Sponsorzy', 'sponsorzy', '1'),
(9, 'Bowler Nemesis', 'bowler_nemesis', '1'),
(10, 'Ciężarówka serwisowa', 'ciezarowka_serwisowa', '1'),
(11, 'BMW', 'bmw', '1'),
(12, 'Oferta sprzedaży samochodu rajdowego Bowler Nemesis', 'oferta_sprzedazy_samochodu_rajdowego_bowler_nemesis', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `calendarium`
--

DROP TABLE IF EXISTS `calendarium`;
CREATE TABLE IF NOT EXISTS `calendarium` (
  `id` int(10) unsigned default NULL,
  `data_od` varchar(255) NOT NULL,
  `data_do` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `kierowca` varchar(255) NOT NULL default 'Piotr Beaupré',
  `pilot` varchar(255) NOT NULL default 'Jacek Lisicki',
  `path` varchar(255) default NULL,
  `isVisible` binary(1) default '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `calendarium`
--

INSERT INTO `calendarium` (`id`, `data_od`, `data_do`, `name`, `place`, `kierowca`, `pilot`, `path`, `isVisible`) VALUES
(NULL, 'Od', 'Do', 'Rajd', 'Kraj', 'Kierowca', 'Pilot', NULL, NULL),
(1, '2011-03-18', '2011-03-21', 'FiA Italian Baja', 'Włochy', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(2, '2011-03-25', '2011-03-27', 'Rajd 24H Polska', 'Polska', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(3, '2011-04-07', '2011-04-10', 'MT Rally', 'Polska', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(4, '2011-05-01', '2011-05-07', 'FiA Rallye de Tunisie ', 'Tunezja', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(5, '2011-05-30', '2011-06-11', 'FiA Rallye Estoril – Marakech ', 'Portugalia', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(6, '2011-07-22', '2011-07-24', 'FiA Baja Espana', 'Hiszpania', 'Piotr Beaupré', 'Jacek Lisicki', '', '1'),
(8, '-', '-', 'Rally Dakar', '-', 'Piotr Beaupré', 'Jacek Lisicki', '', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isVisible` binary(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `path` (`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Zrzut danych tabeli `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `path`, `isVisible`) VALUES
(1, '24H Tout Terrain de France 2008', '24h_tout_terrain_de_france_2008', '1'),
(2, 'Baja de France 2007', 'baja_de_france_2007', '1'),
(3, 'Baja España Aragon 2010', 'baja_espana_aragon_2010', '1'),
(4, 'Baja Portalegre 2008', 'baja_portalegre_2008', '1'),
(5, 'Baja Slovakia 2006', 'baja_slovakia_2006', '1'),
(6, 'Berlin - Wrocław 2006', 'berlin_wroclaw_2006', '1'),
(7, 'Drezno - Wrocław 2007', 'drezno_wroclaw_2007', '1'),
(8, 'Drezno - Wrocław 2008', 'drezno_wroclaw_2008', '1'),
(9, 'Drezno - Wrocław 2009', 'drezno_wroclaw_2009', '1'),
(10, 'Italian Baja 2008', 'italian_baja_2008', '1'),
(11, 'Italian Baja 2009', 'italian_baja_2009', '1'),
(12, 'Italian Baja 2010 nowym samochodem - Bowler Nemesis', 'italian_baja_2010_nowym_samochodem_bowler_nemesis', '1'),
(13, 'Optic 2000, 2008', 'optic_2000_2008', '1'),
(14, 'Pharaons Rally 2007', 'pharaons_rally_2007', '1'),
(15, 'Bowler Nemesis', 'bowler_nemesis', '1'),
(16, 'Anglia - Fabryka Drew Bowlera', 'anglia_fabryka_drew_bowlera', '1'),
(17, 'Budowa ciężarówki', 'budowa_ciezarowki', '1'),
(18, 'Dariusz Żyła - IC seria 4x4 2010', 'dariusz_zyla_ic_seria_4x4_2010', '1'),
(19, 'Dariusz Żyła - Tuning Show 2010', 'dariusz_zyla_tuning_show_2010', '1'),
(20, 'Maraton Rowerowy 2008', 'maraton_rowerowy_2008', '1'),
(21, 'Nemesis z nowym silnikiem', 'nemesis_z_nowym_silnikiem', '1'),
(22, 'Start Naszych Przyjaciół w imprezie Baja Polonia 2009', 'start_naszych_przyjaciol_w_imprezie_baja_polonia_2009', '1'),
(23, 'Sponsorzy', 'sponsorzy', '1'),
(24, 'Sylwetki zawodników', 'sylwetki_zawodnikow', '1'),
(25, 'Rajdy przeprawowe', 'rajdy_przeprawowe', '1'),
(26, 'RMPST odcinek Słomczyn', 'rmpst_odcinek_slomczyn', '1'),
(27, 'Galeria testowa', 'galeria_testowa', '1'),
(31, 'Bowler', 'bowler', '1'),
(32, 'Top', 'top', '1'),
(33, 'test2', 'test2', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) default NULL,
  `rok` varchar(4) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `pojazd` varchar(255) NOT NULL,
  `kierowca` varchar(255) NOT NULL default 'Piotr Beaupré',
  `pilot` varchar(255) NOT NULL default 'Jacek Lisicki',
  `id_gallery` int(11) default NULL,
  `isVisible` binary(1) default '1',
  KEY `id` (`id`),
  KEY `rok` (`rok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `history`
--

INSERT INTO `history` (`id`, `rok`, `nazwa`, `pojazd`, `kierowca`, `pilot`, `id_gallery`, `isVisible`) VALUES
(NULL, 'Rok', 'Rajd', 'Samochód', 'Kierowca', 'Pilot', NULL, NULL),
(1, '1994', 'Rozpoczęcie startów  RMPST', 'Forda Mutt', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(2, '1998', 'II Vice mistrzostwo Polski  RMPST', 'Mitsubishi Pajero', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(3, '1999', 'IV miejsce w klasyfikacji generalnej  RMPST', 'Mitsubishi Pajero', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(4, '2003', 'Rajdy przeprawowe', 'Mercedes G', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(5, '2005', 'Berlin – Wrocław', 'Range Rover Classic', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(6, '2006', 'Baja Slovakia', 'Tomcat 100', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(7, '2006', 'Berlin - Wrocław', 'Range Rover Classic', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(8, '2007', 'Baja de France', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(9, '2007', 'Baja GB Wales', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(10, '2007', 'Drezno - Wrocław', 'Range Rover Classic', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(11, '2007', 'Pharaons Rally', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(12, '2008', 'Italian Baja', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(13, '2008', 'Rally Optic 2000', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(14, '2008', 'Drezno - Wrocław', 'Range Rover Classic', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(15, '2008', '24H Tout Terain de France', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(16, '2008', 'Baja Portalegre', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(17, '2009', 'Italian Baja', 'Bowler Wildcat 200', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(18, '2009', 'Drezno – Wrocław', 'Range Rover Classic', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(19, '2010', 'Italian Baja', 'Bowler Nemesis', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(20, '2010', 'Baja Espada Aragon', 'Bowler Nemesis', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1'),
(21, '2010', 'Baja Portalegre', 'Bowler Nemesis', 'Piotr Beaupré', 'Jacek Lisicki', 0, '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_galleries` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `position` int(10) unsigned NOT NULL default '0',
  `isVisible` int(10) unsigned NOT NULL default '1',
  UNIQUE KEY `id` (`id`),
  KEY `id_galleries` (`id_galleries`),
  KEY `filename` (`filename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=388 ;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`id`, `id_galleries`, `filename`, `position`, `isVisible`) VALUES
(1, 1, '056e6032c49c2efd08e53701f189ce40.jpg', 0, 1),
(2, 1, '07bef73c3b439f9905e1d359a1575d19.jpg', 0, 1),
(3, 1, '0cc7b6ef7c2a16c7b3d7fa08b2f2e368.jpg', 0, 1),
(4, 1, '129ac34b2ec7a3c6a80a19bbc7d19188.jpg', 0, 1),
(5, 1, '450185f1198721d0c0b7cfe72137ae84.jpg', 0, 1),
(6, 1, '4743e4b43e49a3c3f58d55c60de78970.jpg', 0, 1),
(7, 1, '514c14a13be439f2f68b9ec56c324391.jpg', 0, 1),
(8, 1, '6a5410c994d181d7ab8965766710849e.jpg', 0, 1),
(9, 1, '75a2b3436542766371e029f3708f7fe2.jpg', 0, 1),
(10, 1, '877f0fedbf17f8a17d7c800a1daeedbb.jpg', 0, 1),
(11, 1, '975c454e1466e4555865bd77cc63d156.jpg', 0, 1),
(12, 1, 'a02827d513996953d9e8549b742c3954.jpg', 0, 1),
(13, 1, 'b0fdffcf35bc27b31576cb3c48ef515b.jpg', 0, 1),
(14, 1, 'b665b2216bc60a9e44a8f1d73ed3b19f.jpg', 0, 1),
(15, 1, 'cb0a7cedb8ad6625648cc3a57b11a515.jpg', 0, 1),
(16, 1, 'e7477dbae89d6c212d7965899d6c0be5.jpg', 0, 1),
(17, 1, 'ed7c2a01d36de93ef0cc49831dc99191.jpg', 0, 1),
(18, 1, 'f6c121a7e90e9e2b25b4d9a99e35c72b.jpg', 0, 1),
(19, 2, '86ca8b9f11e04e110803fb932af8d8c4.jpg', 0, 1),
(20, 2, '9f9f9238922bc03be68e10884b6827bc.jpg', 0, 1),
(21, 3, '1129b9380010949b6b5623fca8c16f27.jpg', 0, 1),
(22, 3, '37ba3682223ea49bb2a7c0b9ad4d6e05.jpg', 0, 1),
(23, 3, '47af068a0878c22a2d9964c87d786acf.jpg', 0, 1),
(24, 3, '48e2f6b5c883a140b029815847b6983f.jpg', 0, 1),
(25, 3, '66730958fc69a82c629eadce0936426b.jpg', 0, 1),
(26, 3, '83c19e3102c42239585e5a1066a1c351.jpg', 0, 1),
(27, 3, 'b96e8d2dd0e483992bb48151189360ed.jpg', 0, 1),
(28, 3, 'd70f6be662cdcd17b6ab043774a350a0.jpg', 0, 1),
(29, 3, 'f5cad7071895d8c5744b5c6dacaf7b98.jpg', 0, 1),
(30, 4, '0097cd733948e7146d645990cb686fac.jpg', 0, 1),
(31, 4, '234c5c471f64a02908a67b27e7eb0c48.jpg', 0, 1),
(32, 4, '25f6f77ea0ca5bd5c42cb1d9ae687511.jpg', 0, 1),
(33, 4, '2665126ca045805457019582ce71e6ad.jpg', 0, 1),
(34, 4, '667cafe745e137cc77c70941997f9a18.jpg', 0, 1),
(35, 4, '8011a53a17cacf82264ed202c4080286.jpg', 0, 1),
(36, 4, '8a7302683ef5ba69234495d457e9cf2f.jpg', 0, 1),
(37, 4, '8d0732ac53ad0059ec27e8727e40109e.jpg', 0, 1),
(38, 4, 'a68d728bcc904dd957d49e6024f7b001.jpg', 0, 1),
(39, 4, 'b38b690c49a3524d012f733d1d967477.jpg', 0, 1),
(40, 4, 'c739eaf0504c4435ba3be8dd7c3d0c36.jpg', 0, 1),
(41, 5, '2fd23b11b9b7f806e65e1004a58897ee.jpg', 0, 1),
(42, 5, '3f196f862f4e7ae9312959a062cb625d.jpg', 0, 1),
(43, 5, '49fff5b52ee22804bb934eb465a2538b.jpg', 0, 1),
(44, 5, '6e47e7578ec716abc639efdc5c52c357.jpg', 0, 1),
(45, 5, '8835debe3ab9f00bc79e4801e7d0e3b2.jpg', 0, 1),
(46, 5, '99bd2aa8e8689d451c86af58e7937967.jpg', 0, 1),
(47, 5, '9c15c479f50f66bdd2c5ed518fe85933.jpg', 0, 1),
(48, 5, 'b8233953f0b8e05d0a8c6faef9a2d72e.jpg', 0, 1),
(49, 5, 'cc3d3240fba5fb04b9a1b6d54bd8b08a.jpg', 0, 1),
(50, 5, 'cd06e65919d53b98611f3a234d1744cc.jpg', 0, 1),
(51, 5, 'd66fe2608405715e56ebad2aa22212ab.jpg', 0, 1),
(52, 5, 'd75c5e896e39e139e0995bd8b3fbcb65.jpg', 0, 1),
(53, 5, 'dd44d0b8456cb138d735d8f94f823bd6.jpg', 0, 1),
(54, 5, 'f10be67e3a55bdf5907369e3f6c4f7b8.jpg', 0, 1),
(55, 6, '2d2c351518e3b3e04e02adcf61e2a436.jpg', 6, 0),
(56, 6, '3910d120d7c99516e3f0aa4743c567db.jpg', 7, 0),
(57, 6, '572d5fe8ea7887ef36cf0946e4caa34b.jpg', 1, 1),
(58, 6, 'a6e2a03187c9fe94bf600bddaf9ba248.jpg', 3, 1),
(59, 6, 'b446dd840b94003c6027bda9ea7ca94b.jpg', 4, 1),
(60, 6, 'cadafc87d470aa0d0cd31e9a7140caad.jpg', 2, 1),
(61, 7, '2265334cce57f1dc61c5bb52b4e217d4.jpg', 0, 1),
(62, 7, '446264536d683feec624ef5978fec023.jpg', 0, 1),
(63, 7, '7d0e4d1429f84c88fbb50f13aa59ca93.jpg', 0, 1),
(64, 7, 'aca713554e4c9cd8798b3ab28fd00dbc.jpg', 0, 1),
(65, 7, 'c907773d263eadf897815cdd553f16a5.jpg', 0, 1),
(66, 8, '280236c7a776b52610775baa398f57f4.jpg', 7, 1),
(67, 8, '76579c862d74d01ffe3315f57e6cccab.jpg', 8, 1),
(68, 8, '7dae03c807b2cb9d823bb50eca8a95aa.jpg', 9, 1),
(69, 8, '97985b23a4ad4007d32907bcd2248bab.jpg', 10, 1),
(70, 8, '994dd70042da6cf1c750bf2f325361f7.jpg', 11, 1),
(71, 8, 'a6bce0acd9b63ef5ec490791a1ec352b.jpg', 2, 1),
(72, 8, 'a7bb2e81252c31eb73183ee8a2f9b778.jpg', 1, 1),
(73, 8, 'b74dcee41a5c14e3426067bdbf15f746.jpg', 3, 1),
(74, 8, 'd00a169c85af66ab50013dab1abacb4a.jpg', 4, 1),
(75, 8, 'da458ce86da4e091031c4e1bd983928d.jpg', 5, 1),
(76, 8, 'f7104ada2a6960a6f77b6871bc21b764.jpg', 6, 1),
(77, 9, '05881a3f6c0e92799353a7c8e26dcecb.jpg', 0, 1),
(78, 9, '05b01a2051838c3180fbde505f4920a6.jpg', 0, 1),
(79, 9, '09132d5ab958ad00f34553f1289e5ee9.jpg', 0, 1),
(80, 9, '0f1649518a5b4fde75cd03a8449ca3c7.jpg', 0, 1),
(81, 9, '10829e51a92200fa92395e43192d26ef.jpg', 0, 1),
(82, 9, '14f1e112466a28f19b9e5e4fc75cf144.jpg', 0, 1),
(83, 9, '169d0f44f33c8bc7c572a40dd7632c19.jpg', 0, 1),
(84, 9, '21bfe1bbc7188701d4949f002ef7f3a8.jpg', 0, 1),
(85, 9, '22e39abb7dc78d26dbb99007ad22f832.jpg', 0, 1),
(86, 9, '2524ffaf84743071b6fc8432f257463b.jpg', 0, 1),
(87, 9, '25a5c8bb75b3a84cc6ea2c8a5489f712.jpg', 0, 1),
(88, 9, '270164643e15242042de7da51bef9ebd.jpg', 0, 1),
(89, 9, '28775cd4a40cf8ca3929ff4ada582734.jpg', 0, 1),
(90, 9, '2953fa55e36a4afbce5230a22eecafd7.jpg', 0, 1),
(91, 9, '29a1447a0b44f689a78b3cf056247941.jpg', 0, 1),
(92, 9, '3933740860f3453a4d3613ff70f801d1.jpg', 0, 1),
(93, 9, '3990b5f8b6372b058aed825f98396288.jpg', 0, 1),
(94, 9, '3af51bbe02d446b1cb2b91fc36960575.jpg', 0, 1),
(95, 9, '3b66211c4b1bd7bde0075ef7a2c694ca.jpg', 0, 1),
(96, 9, '3ed911d873ec74f2e078add3ae8ca443.jpg', 0, 1),
(97, 9, '3f185d9bd8f5f9fd00cbf285f6958181.jpg', 0, 1),
(98, 9, '41454710d9ee67d1bce071b0b64bfd1d.jpg', 0, 1),
(99, 9, '4d6d7d5edd09d2eff4aca5c339af2fe0.jpg', 0, 1),
(100, 9, '50b7ed77a74b9d1642f8222544307cb2.jpg', 0, 1),
(101, 9, '51f6ddfa106b1a3c6436451bd817d295.jpg', 0, 1),
(102, 9, '53e19512a4408e38588275cd11c8ef2c.jpg', 0, 1),
(103, 9, '5439c1f5f22dbb9d257b1f9581d0e330.jpg', 0, 1),
(104, 9, '550eb57e91edae57bb2f12ce250094d1.jpg', 0, 1),
(105, 9, '5e943da7b2e7ce78146f4e93257495ea.jpg', 0, 1),
(106, 9, '64434a95788749ba604742bdc36c4d3e.jpg', 0, 1),
(107, 9, '65758e5d8b40d12d6f27cbab23e642e9.jpg', 0, 1),
(108, 9, '6de0cc55e10ea876034bec5374a0d86c.jpg', 0, 1),
(109, 9, '74b59f89a8148f98f49d98e9719a347b.jpg', 0, 1),
(110, 9, '79cbcd016985bf2abe981cb79b121ed8.jpg', 0, 1),
(111, 9, '7d83e95adbc4a63f148da209b581381d.jpg', 0, 1),
(112, 9, '7e2196a21cdbf3d5e8c293186202dfeb.jpg', 0, 1),
(113, 9, '857783383288021be80cc74ea596c717.jpg', 0, 1),
(114, 9, '87a897a8908e6d7baec80912ff228d06.jpg', 0, 1),
(115, 9, '882d2afbaec4801ec2e8bec8781905ea.jpg', 0, 1),
(116, 9, '887d0b17bd6330b004cbd9cbdd08764e.jpg', 0, 1),
(117, 9, '8aa9fc368941d146bd70c8035d2d8c0e.jpg', 0, 1),
(118, 9, '97f2063a34cf3c62e37c2a847d8dbf98.jpg', 0, 1),
(119, 9, '98929b6d2cf3a3690f92eb69c4c4f44e.jpg', 0, 1),
(120, 9, '98ca93a3bb98f8c245b3469ba2e9e06a.jpg', 0, 1),
(121, 9, '9bc405b95bc59733d7c241d596689f0d.jpg', 0, 1),
(122, 9, '9f29198dc943923b853bedb63d9916c2.jpg', 0, 1),
(123, 9, '9f645555fe25b506884358a8e6335710.jpg', 0, 1),
(124, 9, 'a21d03fe762b4b1ba6f0f600d39dfa6a.jpg', 0, 1),
(125, 9, 'a7c3b826f086cad2dd3530da94aebe8b.jpg', 0, 1),
(126, 9, 'a86c658bbd2272147c0104c56a888e6f.jpg', 0, 1),
(127, 9, 'aa99ebf6cdc76dfe1f76e5e2ea89a4ad.jpg', 0, 1),
(128, 9, 'ad23a8bd964f7873ef9fe02bb0af31b3.jpg', 0, 1),
(129, 9, 'ae86e2b5ab2543867604c200fe76b335.jpg', 0, 1),
(130, 9, 'af3122eae202721580b5475c65c15c48.jpg', 0, 1),
(131, 9, 'b42ec314857b1eca5f537e0e00ff2cac.jpg', 0, 1),
(132, 9, 'b557310e58da9c1fb6d051060e71710b.jpg', 0, 1),
(133, 9, 'bfc21db1fb31b1d8163c08e94e3a4c54.jpg', 0, 1),
(134, 9, 'c062dacb8edc1792e0f60f3d9590f24c.jpg', 0, 1),
(135, 9, 'c24982008fcab5df8e6a75c53fdb9f0e.jpg', 0, 1),
(136, 9, 'd50d090f7a656d05c1147aadf15828ab.jpg', 0, 1),
(137, 9, 'd7cc5a3d33d8862611549af73777030c.jpg', 0, 1),
(138, 9, 'd8a093420885429cc788476c24f53907.jpg', 0, 1),
(139, 9, 'd94168531bf2f49d00aa933340e2574c.jpg', 0, 1),
(140, 9, 'db458c9f3c39963f17053d88d8eaece2.jpg', 0, 1),
(141, 9, 'db8e400f32d6d7b18c1cdfbeef6b77a9.jpg', 0, 1),
(142, 9, 'df5cf62fa141a2588a3eeb6822f4db68.jpg', 0, 1),
(143, 9, 'eb046fb44110bbe890d5733bd01572d4.jpg', 0, 1),
(144, 9, 'ec04b850c5521abd15b108d693f27fc1.jpg', 0, 1),
(145, 9, 'f12471e21c595400fa0f2e6670825611.jpg', 0, 1),
(146, 9, 'f6e15a63004a88ee34239987e226832b.jpg', 0, 1),
(147, 9, 'f85b458b70121b33f0f10a26249df41b.jpg', 0, 1),
(148, 9, 'ff473beef6e56cc30050648120325112.jpg', 0, 1),
(149, 10, '32564c24234ca62f03ee5a8ffeb17124.jpg', 0, 1),
(150, 10, '3efddd8c33fe94ab2039e30561445642.jpg', 0, 1),
(151, 10, 'a185df5b593140ca7d70070cbe29df90.jpg', 0, 1),
(152, 10, 'b648da95622bd5b03600e4c2ab7a3d57.jpg', 0, 1),
(153, 10, 'da0e5362ae36f6590490e0c1aa0d1d93.jpg', 0, 1),
(154, 11, '0ac4673f6d28b3f1d39db17863df06a3.jpg', 0, 1),
(155, 11, '26701362ce1273c8976b91c7abc3828d.jpg', 0, 1),
(156, 11, '2750861937965251a469ff8009a3e10f.jpg', 0, 1),
(157, 11, '45ffa5a641374008aea5a6f0cfa78719.jpg', 0, 1),
(158, 11, '483ff05a9735d9ce7b80452fad7cfabf.jpg', 0, 1),
(159, 11, '65be014149759bc3cf8aa0c228661046.jpg', 0, 1),
(160, 11, '696bf20cc01f871ddab847401f82c838.jpg', 0, 1),
(161, 11, '7708098d60a1807d7f47d79a166a8974.jpg', 0, 1),
(162, 11, '7813201765bfff1bd6ca95cc9995e977.jpg', 0, 1),
(163, 11, '80cd6f27f352b41ca4a7b49349b9b3ff.jpg', 0, 1),
(164, 11, '8e043626616b6edd38626b7516f83bbb.jpg', 0, 1),
(165, 11, 'a061a31eb7dd50eeb736af05453a1362.jpg', 0, 1),
(166, 11, 'b474c02fbb41b809c6dc9204716fce60.jpg', 0, 1),
(167, 11, 'b546695129b0fd12db35444aed67fc2e.jpg', 0, 1),
(168, 11, 'b79cdf8236a6fb497548605c8fd5f18c.jpg', 0, 1),
(169, 11, 'b87d88197e65f0d4e30b88a6e25613b7.jpg', 0, 1),
(170, 12, '021d03609fbcdd14a3423969a78f83c7.jpg', 0, 1),
(171, 12, '04411d3ca2d6d270d9a81663f63e93c6.jpg', 0, 1),
(172, 12, '06a6d889230d000d6fb2e910db835a3b.jpg', 0, 1),
(173, 12, '10b98528341c198f9ddd1541c7e2b9f5.jpg', 0, 1),
(174, 12, '10e98edbef6341c7b4c89cd76f274af3.jpg', 0, 1),
(175, 12, '1753e0bd7608fb82c43cadfe4fdc204f.jpg', 0, 1),
(176, 12, '3025ae347d6875be7eeed5027bf7ef85.jpg', 0, 1),
(177, 12, '37688641a818e35e6f17b74f8161a11e.jpg', 0, 1),
(178, 12, '3e46c00a321947585d5a508b917ee433.jpg', 0, 1),
(179, 12, '47850e2321ce21ff0b4158e47d7c7908.jpg', 0, 1),
(180, 12, '49af82c7673449018edc06fad1fcda0a.jpg', 0, 1),
(181, 12, '501318b27eedd67a8cb73b7dc5401a8f.jpg', 0, 1),
(182, 12, '682ea3724edc4a80290ea77cb6f0ff99.jpg', 0, 1),
(183, 12, '714d6a3a1b4cfc08ed4608f34a6189e0.jpg', 0, 1),
(184, 12, '85403eb8b2c5586d244b07b453932793.jpg', 0, 1),
(185, 12, '86caf356db9a989538df14f55eb3fc92.jpg', 0, 1),
(186, 12, '8e7bd0bcbdce0d73d660e1412ee6f205.jpg', 0, 1),
(187, 12, '90a341ad658c8bc301e7c0e2d88ccac3.jpg', 0, 1),
(188, 12, '95fe378f9fd5bb333619914e7891bc4a.jpg', 0, 1),
(189, 12, 'a9187b1db5d3cfd3e10f91e821c29580.jpg', 0, 1),
(190, 12, 'aaec503819812e62e40bb1259433955c.jpg', 0, 1),
(191, 12, 'ab0c980ce174cc41c035e1a26dea4239.jpg', 0, 1),
(192, 12, 'b29ad44561c146e2ab16c4a74919bf6a.jpg', 0, 1),
(193, 12, 'b3396dff8f58e8578fe3e85b5c92057b.jpg', 0, 1),
(194, 12, 'b9d49333b4cd9e207b1abca36fd00a31.jpg', 0, 1),
(195, 12, 'c722c10834a1d7e94e985351b04a98d3.jpg', 0, 1),
(196, 12, 'd771b521db15136e3bfe12ac14e28d5e.jpg', 0, 1),
(197, 12, 'df8553277991ee7948b9d7e1e7640dad.jpg', 0, 1),
(198, 12, 'e2e2e26867276d9b0f6febd3fc99ba83.jpg', 0, 1),
(199, 12, 'e42d3d59e6eb28f205f7caf90c343642.jpg', 0, 1),
(200, 12, 'e6305e39e730726608c6d0abba7cadf5.jpg', 0, 1),
(201, 12, 'e82bccc8c46c7d45b41c7c57842bda24.jpg', 0, 1),
(202, 12, 'ea1f941ff7174a12c7057c50209c51b2.jpg', 0, 1),
(203, 12, 'f300afc6b0cd1207807755a7069025fe.jpg', 0, 1),
(204, 12, 'f3ba9266940678f573542d27957c0aec.jpg', 0, 1),
(205, 12, 'f486a5e1b9d47edb23965b417e352f86.jpg', 0, 1),
(206, 13, '111aed0789ecf30028d942e63e063c2d.jpg', 0, 1),
(207, 13, '31c5882d2cd237297f7299d011c5a3b6.jpg', 0, 1),
(208, 13, '41ef362bfe1a8b7c4a93bb7b626d855d.jpg', 0, 1),
(209, 13, '561f15b6cc283d3ca6cfd408c60d2b2e.jpg', 0, 1),
(210, 13, '660d4bd60c7ae4a75cce137cb20ad207.jpg', 0, 1),
(211, 13, '6cddf06884c2b868312859fb9ca11cab.jpg', 0, 1),
(212, 13, '7bbfca4ed8bd316ffefda8f5a2857c54.jpg', 0, 1),
(213, 13, '7e4c66b4c3d40e384b1af0bbc5aa6e7b.jpg', 0, 1),
(214, 13, '80eaa4f77f0474785d7700423ce9ca05.jpg', 0, 1),
(215, 13, '8325142b61f0d74f1e603ecb6e2da639.jpg', 0, 1),
(216, 13, 'a1794ff71977bbb9efc6e06750005500.jpg', 0, 1),
(217, 13, 'b324eb30234fc0a92d63589095707791.jpg', 0, 1),
(218, 13, 'ba016162772531707d0d730f066ce54d.jpg', 0, 1),
(219, 13, 'bc36edf5caaded6775d8f2388bace70e.jpg', 0, 1),
(220, 13, 'c8dfa874aaea635c39654efd982fc5c4.jpg', 0, 1),
(221, 13, 'd4e8f963a03a2f6cf48e99de97cca71d.jpg', 0, 1),
(222, 13, 'e87a6bd70f33e19e0553699f52f992ee.jpg', 0, 1),
(223, 13, 'e9c6d615013b8b8b67d30517562dc8e1.jpg', 0, 1),
(224, 14, '297bd8c08a587adb30eb87d881583620.jpg', 0, 1),
(225, 14, '4e88d9e05fb4cf070bc708551b694dd5.jpg', 0, 1),
(226, 14, '74607b0e58d61cc9d1136551959cc176.jpg', 0, 1),
(227, 14, '7489870086f08173b89057dc339fbc7f.jpg', 0, 1),
(228, 14, 'de5f68dde2f0632520713fb8019f9279.jpg', 0, 1),
(229, 14, 'e231a3cfdf7d5e9c53112e162ccd357b.jpg', 0, 1),
(230, 14, 'fc89b7bf318344513205119fcfeff8b8.jpg', 0, 1),
(231, 15, '4d6905dda71cad6c19ddad45bc677389.jpg', 0, 1),
(232, 15, '7235ae7b540f33a1d80ee3805d3ab627.jpg', 0, 1),
(233, 15, '85e82e570632dd2e63b380ecdab38237.jpg', 0, 1),
(234, 15, '97c039bfa660f4ded487d3d4674f98da.jpg', 0, 1),
(235, 15, 'd45e5a5f83a8017c30cc30948c4e1302.jpg', 0, 1),
(236, 15, 'fc2e4987484d1a7861bd1054cf5b71d4.jpg', 0, 1),
(237, 16, '089fd7fb47608bd5cba3a60e19264d2a.jpg', 0, 1),
(238, 16, '1f8b09cb8fa4a6d2761e99ab0790ab1e.jpg', 0, 1),
(239, 16, '24f9ab50704254bee5214a8882de9502.jpg', 0, 1),
(240, 16, '251b8b8fe956e1bee397575e306f0eff.jpg', 0, 1),
(241, 16, '40b5b4f27424ecbebc540548d9a307b8.jpg', 0, 1),
(242, 16, '432391008d68afe2756071a1f2f56882.jpg', 0, 1),
(243, 16, '4d13bf3b9e3fa2a53e4ffc4a8f4f1c33.jpg', 0, 1),
(244, 16, '5a81d2da4cfff8fbf4c7c31fab3b0120.jpg', 0, 1),
(245, 16, '5dbb750922da593908eff40946faddd9.jpg', 0, 1),
(246, 16, '63a3e4fc22f48d4a1d875ab552482aaa.jpg', 0, 1),
(247, 16, '68e061f2bdb62ffd61aaf4204dd6c767.jpg', 0, 1),
(248, 16, '6b0d01653592812d1935c7cd3a652684.jpg', 0, 1),
(249, 16, '9b7ca4ffce3b48daa9a01c47adeddd32.jpg', 0, 1),
(250, 16, 'a3225e652a5fcf0c880d66143d32eb23.jpg', 0, 1),
(251, 16, 'c6174f53df0e2fe537519107eb2fd146.jpg', 0, 1),
(252, 16, 'e17295db775357f97de9b1d2e7c04981.jpg', 0, 1),
(253, 17, '0cd878c81013498b7228d863e320d09c.jpg', 0, 1),
(254, 17, '0d19e496907bab8289fb2bdbd38b1f38.jpg', 0, 1),
(255, 17, '1ece96887b8a7ee85a8a4515c919b63b.jpg', 0, 1),
(256, 17, '2c877c9eb4326a2c763a3601e178b552.jpg', 0, 1),
(257, 17, '37e0f13bcc2f20c11205c5377732c59a.jpg', 0, 1),
(258, 17, '705e53c5f38665fae7f292121d43ed10.jpg', 0, 1),
(259, 17, '7376cde88595b05bbf1f404665e38b1e.jpg', 0, 1),
(260, 18, '02aae8496c8831f22a81d7e4c5364349.jpg', 0, 1),
(261, 18, '14256528f97eb236f917710e378ebbe3.jpg', 0, 1),
(262, 18, '2f5b99533b6a28ccd20310af2987b485.jpg', 0, 1),
(263, 18, '3446e07f00191297e9b7e98aca19eff4.jpg', 0, 1),
(264, 18, '3db901058ca301ecb0cc423b474c9e5a.jpg', 0, 1),
(265, 18, '4c52d4af7e2a631b0049beb0b01d6608.jpg', 0, 1),
(266, 18, '7087bb88b32840ef323515e2a491facb.jpg', 0, 1),
(267, 18, '9a8162eccf07d4d0aa964dd56f28a7fa.jpg', 0, 1),
(268, 18, 'b40370505e7e33ea03b1a8c8cc28e616.jpg', 0, 1),
(269, 18, 'dd6e6cf15f06085e7a5a23e493a75a52.jpg', 0, 1),
(270, 18, 'ef24bed17db0e25d833b33f895a1f321.jpg', 0, 1),
(271, 18, 'fca950c68a9f4962bb63d54d23801ce4.jpg', 0, 1),
(272, 19, '0703c5e38e3de5ce2909173e7bd3f8d1.jpg', 0, 1),
(273, 19, '4706c8dd09372b9ecaf555898e2ca941.jpg', 0, 1),
(274, 19, '5c85a1199b62b0437dcccaec2ebdfe7d.jpg', 0, 1),
(275, 19, '687004a070ba6301890b9e4341c80235.jpg', 0, 1),
(276, 19, '8245c0a5298b75b67638fbfce423e568.jpg', 0, 1),
(277, 19, 'a00d1bf58ed99f29fa2f828369d9dc69.jpg', 0, 1),
(278, 19, 'a5dd05d76210871ef178c251d8f4bd3c.jpg', 0, 1),
(279, 19, 'bbe570653d6467fba3f5ce26dfd150ae.jpg', 0, 1),
(280, 19, 'c28e367cc7d9f912c81b4f660f192519.jpg', 0, 1),
(281, 19, 'c4b806d5777fe518137836671c39dc09.jpg', 0, 1),
(282, 19, 'c74553503712176a62c703f874483716.jpg', 0, 1),
(283, 19, 'de34b8aef8a7337e1822760a6a0c433c.jpg', 0, 1),
(284, 19, 'e2ef102861883d7b3e5e0dea3aa77486.jpg', 0, 1),
(285, 21, '1adcfca3e7f67e63182dfc3190c05d83.jpg', 0, 1),
(286, 21, '1facf1744c2ff85bd7b357c8e796a53d.jpg', 0, 1),
(287, 21, '240037d9e3ab5df4d56a7d7dcabb03f4.jpg', 0, 1),
(288, 21, '27c899ac24a14489b47fd7a772e6ca5a.jpg', 0, 1),
(289, 21, '34d8449c58ab551afb6e8a32769a8268.jpg', 0, 1),
(290, 21, '3d11cfc1e1441da513660da7cee45e26.jpg', 0, 1),
(291, 21, '4a75a6a4448738c037025de0bfaf9b0d.jpg', 0, 1),
(292, 21, '783244f7c6cc656cd402c154fefb322d.jpg', 0, 1),
(293, 21, '83d745103af8814407f8718994f94f79.jpg', 0, 1),
(294, 21, '8f4929f84d4633f7838d01c20087b9e7.jpg', 0, 1),
(295, 21, '90ee108ba160765a7fccbd3322992eb8.jpg', 0, 1),
(296, 21, 'a2e7cf2c11e33c48a01ac722b7f61ffa.jpg', 0, 1),
(297, 21, 'abb4582c78bd4e02f5190c2252410195.jpg', 0, 1),
(298, 21, 'b1d85fe5e7b9ce6cb822e108e0426a5e.jpg', 0, 1),
(299, 21, 'c743ec8c032879c9d68be176329453c6.jpg', 0, 1),
(300, 21, 'cc9d67c34673ae126d29c631bac0504f.jpg', 0, 1),
(301, 21, 'f50ff73cd22e41abdd14c7bc7cf45fd7.jpg', 0, 1),
(302, 22, '0d6f7b20699ba7a9881888317e871f5d.jpg', 0, 1),
(303, 22, '132009bcb5380bc066628d5169030f61.jpg', 0, 1),
(304, 22, '13d2e3100b6e129d4b9892c16119d652.jpg', 0, 1),
(305, 22, '15754abb322cebaffda273157f11401a.jpg', 0, 1),
(306, 22, '214728cfb6dbead9b42dc12517ad8965.jpg', 0, 1),
(307, 22, '21c268ab9c3d8ec6879d96d0288ba1da.jpg', 0, 1),
(308, 22, '2372782aa5cbcd75802555bf458cfaf3.jpg', 0, 1),
(309, 22, '24c8d027d359304bf819df64c82a7e86.jpg', 0, 1),
(310, 22, '25a434067cec0780eb5163271dfb83f6.jpg', 0, 1),
(311, 22, '29a2a7ecf6e5306a62df08059593e0cc.jpg', 0, 1),
(312, 22, '2d87d0071e5427e9b529260396ea21ab.jpg', 0, 1),
(313, 22, '3a6e37d8f7ff4cbb83fe019eb87edfd5.jpg', 0, 1),
(314, 22, '469f603bdf1a191d1443e6260a42461e.jpg', 0, 1),
(315, 22, '4f60b81acec687f73b7a2465a28d3210.jpg', 0, 1),
(316, 22, '4fe6526dc8d15a90d84434980560e53f.jpg', 0, 1),
(317, 22, '5ddca9b61a14d4f3b538c59d92e47e23.jpg', 0, 1),
(318, 22, '646ec914596f830061d602625c7bf5e7.jpg', 0, 1),
(319, 22, '65f946d8f35032feca3981a2fc3a934e.jpg', 0, 1),
(320, 22, '7384636a0dd7453cf1d32ea9063580a9.jpg', 0, 1),
(321, 22, '814761290524d05a6e33c1f52fe58fb5.jpg', 0, 1),
(322, 22, '8b7b977d6403ffa8573d7394e683f9a7.jpg', 0, 1),
(323, 22, '985f0a2c2e41840a9401c8eaa40ab903.jpg', 0, 1),
(324, 22, '98eac44f1e0e9f4672af62e71de06f10.jpg', 0, 1),
(325, 22, 'becd0597aaec5e6f3bffed61d2cb165d.jpg', 0, 1),
(326, 22, 'cc1fb8b324eb4f476502c324bad23fa8.jpg', 0, 1),
(327, 23, '0677f5f009062b9339774e361e5ec947.png', 0, 1),
(328, 23, '28f1ece6c8347a3dd9a28a0e62ec8111.png', 0, 1),
(329, 23, '4d45e04a2f08eb6a7b37ac679d7f5c76.jpg', 0, 1),
(330, 23, '878d12028f8b84bc8be68db59a8579d2.png', 0, 1),
(331, 23, '9482ef084b061bf6c5388d62a62fc9ec.png', 0, 1),
(332, 23, 'bab5e69112740821bf6a3e11249687f0.gif', 0, 1),
(333, 23, 'cfa02537493bd244ca82f4038f89b0c4.png', 0, 1),
(334, 23, 'dbfaf8dfdb29224eb1f4597efbfea787.png', 0, 1),
(335, 24, '07bef73c3b439f9905e1d359a1575d19.jpg', 0, 1),
(336, 24, 'a02827d513996953d9e8549b742c3954.jpg', 0, 1),
(337, 24, 'c428dfbf70477904d954698d95d75fc3.jpg', 0, 1),
(338, 25, 'ec578f9848b6e8e0cc831ddde1612b8b.jpg', 3, 1),
(339, 25, '24abfae491da8df392ca98c205f599d6.jpg', 6, 1),
(340, 25, '7e566f816eed95f9bdf1af56abe1de5b.jpg', 4, 1),
(341, 25, '770603ae6e55390b864dd26994ef1e86.jpg', 2, 1),
(342, 25, '15810d859f4ba6f38b8cef9820bb9b6b.jpg', 5, 1),
(343, 25, 'e984c7908fc90d28d4bb31bcdd711bc3.jpg', 1, 1),
(345, 26, 'e875c1bc4caf15f4424432a1284e7aa5.jpg', 0, 1),
(347, 27, '80410729e7e8256eb3eda5891f9b24de.jpg', 0, 1),
(348, 31, '637abb61294aa783cb8f0eb64dca7a8f.jpg', 1, 1),
(349, 31, '52ffc3f31d1a214f563355cdab24cca8.jpg', 3, 1),
(350, 31, '2592ebb5c16086fadd00adabf8f508e1.jpg', 6, 1),
(351, 31, 'adc5aa75448cbaa1358a94dcfdfba22e.jpg', 7, 1),
(352, 31, '0fa1995c665007d731acc3fc87bf2935.jpg', 8, 1),
(354, 31, 'fb48ec2df5dbf7efc80eca61074da96f.jpg', 13, 1),
(357, 31, '8f0824e5e37757b23badf9f800eb397b.jpg', 14, 1),
(359, 31, '7b37189c7b1f4732d0c4b61779335400.jpg', 11, 1),
(360, 31, '8ced6bf576967e369e607000bffd8832.jpg', 10, 1),
(361, 31, 'ff36f25b76090e8b3569410ea57861b2.jpg', 20, 1),
(362, 31, '8c589aeddf21a8ba20b380c9416bcb49.jpg', 21, 1),
(363, 31, '08a450bf3e88b14882868e84e8e62936.jpg', 22, 1),
(364, 31, '08a450bf3e88b14882868e84e8e62936.jpg', 23, 1),
(365, 31, 'b01141f2b5b28b6a32139c4ab4b8daa5.jpg', 24, 1),
(366, 31, 'f8570aa5ed423aaddab306548a666790.jpg', 16, 1),
(367, 31, '02c5842d353478114c10029b94405d30.jpg', 17, 1),
(369, 31, '7b2415c1425bef86461fd0c411efc638.jpg', 2, 1),
(370, 31, '1faf8aa0787608f4f6a32269a02d2dca.jpg', 4, 1),
(371, 31, '3f16147be917167fb997012e50f0eaf5.jpg', 5, 1),
(374, 31, 'a1b0e941127b8aadf3b52a64ce914f75.jpg', 12, 1),
(376, 31, 'cef2372df814b9aa9a062f0836584e66.jpg', 9, 1),
(377, 31, '5d8298146a157c7ed4fa282176aefad4.jpg', 18, 1),
(378, 31, 'a8270303432fccf1d3a3a185d6dda84f.jpg', 19, 1),
(379, 31, 'a8270303432fccf1d3a3a185d6dda84f.jpg', 15, 1),
(380, 32, 'c3275c30190817a77250fa743f4c2516.jpg', 0, 1),
(381, 32, 'c66f166414ef6b13aa062b5ee7587706.jpg', 0, 1),
(382, 31, 'a96ce58ccb7bef5c49266e6907f2b6ea.jpg', 0, 1),
(383, 31, 'edefd9b49d36dc863251ce403dbfbf78.jpg', 0, 1),
(384, 31, 'ff36f25b76090e8b3569410ea57861b2.jpg', 0, 1),
(385, 6, 'e75354c9fc75bb0267e830427bcb6166.jpg', 5, 1),
(386, 33, 'ff13b23e4fccfd06a05e517285dd32a8.jpg', 0, 1),
(387, 33, '8c0f15df8df86dd0d5e33f1ca1ad0a73.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `isVisible` binary(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id`, `title`, `path`, `url`, `width`, `height`, `isVisible`) VALUES
(1, 'Italian Baja 2010 nowym samochodem - Bowler Nemesis', 'italian_baja_2010_nowym_samochodem_bowler_nemesis', 'http://www.youtube.com/v/2lTn6CHpmQw', 425, 344, '1'),
(2, 'Pharaons Rally 2007', 'pharaons_rally_2007', 'http://www.youtube.com/v/he4ElYgXxxc', 425, 344, '1'),
(3, 'Pharaons Rally 2007', 'pharaons_rally_2007', 'http://www.youtube.com/v/Ip09iGs9SjU', 425, 344, '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `date` date default NULL,
  `title` varchar(255) NOT NULL,
  `hasHeadline` binary(1) default '1',
  `hasArticle` binary(1) default '0',
  `id_images` int(11) default NULL,
  `id_galleries` int(11) default NULL,
  `id_objects` int(11) default NULL,
  `path` varchar(255) NOT NULL,
  `isVisible` binary(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `path` (`path`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `hasHeadline`, `hasArticle`, `id_images`, `id_galleries`, `id_objects`, `path`, `isVisible`) VALUES
(1, '2011-07-06', 'Rajd Silk Way 2011', '1', '1', NULL, NULL, 9, 'rajd_silk_way_2011', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `objects`
--

DROP TABLE IF EXISTS `objects`;
CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `position` int(10) unsigned default '0',
  `title` varchar(255) default NULL,
  `path` varchar(255) default NULL,
  `images_id` int(10) unsigned default NULL,
  `url` varchar(255) default NULL,
  `target` varchar(255) default '_blank',
  `width` int(10) unsigned default NULL,
  `height` int(10) unsigned default NULL,
  `isVisible` binary(1) default '1',
  `container` varchar(255) default 'div',
  `class` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `objects`
--

INSERT INTO `objects` (`id`, `position`, `title`, `path`, `images_id`, `url`, `target`, `width`, `height`, `isVisible`, `container`, `class`) VALUES
(1, 0, NULL, 'sponsorzy/0677f5f009062b9339774e361e5ec947.png', NULL, 'www.wedelpijalnie.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(2, 0, NULL, 'sponsorzy/28f1ece6c8347a3dd9a28a0e62ec8111.png', NULL, 'www.galposter.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(3, 0, NULL, 'sponsorzy/4d45e04a2f08eb6a7b37ac679d7f5c76.jpg', NULL, 'www.motul.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(4, 0, NULL, 'sponsorzy/878d12028f8b84bc8be68db59a8579d2.png', NULL, 'www.5asec.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(5, 0, NULL, 'sponsorzy/9482ef084b061bf6c5388d62a62fc9ec.png', NULL, 'www.cursor.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(6, 0, NULL, 'sponsorzy/bab5e69112740821bf6a3e11249687f0.gif', NULL, 'www.ecowind.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(7, 0, NULL, 'sponsorzy/cfa02537493bd244ca82f4038f89b0c4.png', NULL, 'www.neoinvestments.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(8, 0, NULL, 'sponsorzy/dbfaf8dfdb29224eb1f4597efbfea787.png', NULL, 'www.agatha.pl', '_blank', NULL, NULL, '1', 'div', 'sponsorzy'),
(9, 0, 'Silk Way 2011', 'newsy/20108b2e51f9fb74ad188a2bef8ed91c.png', NULL, 'www.silkwayrally.com', '_blank', NULL, NULL, '1', 'div', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isVisible` binary(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `path` (`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `tables`
--

INSERT INTO `tables` (`id`, `title`, `path`, `isVisible`) VALUES
(1, 'Kalendarz', 'calendarium', '1'),
(2, 'Historia startów', 'history', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `top`
--

DROP TABLE IF EXISTS `top`;
CREATE TABLE IF NOT EXISTS `top` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `tree_menu_Id` int(10) unsigned default NULL,
  `id_galleries` int(11) default NULL,
  `id_images` int(11) default NULL,
  `filename` varchar(255) default NULL,
  PRIMARY KEY  (`Id`),
  KEY `menu_Id` (`tree_menu_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `top`
--

INSERT INTO `top` (`Id`, `tree_menu_Id`, `id_galleries`, `id_images`, `filename`) VALUES
(1, 0, 32, 380, 'c3275c30190817a77250fa743f4c2516.jpg'),
(2, 2, 32, 381, 'c66f166414ef6b13aa062b5ee7587706.jpg'),
(3, 5, 32, 381, 'c66f166414ef6b13aa062b5ee7587706.jpg'),
(4, 0, 32, 380, 'c3275c30190817a77250fa743f4c2516.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tree_menu`
--

DROP TABLE IF EXISTS `tree_menu`;
CREATE TABLE IF NOT EXISTS `tree_menu` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `position` int(10) unsigned NOT NULL default '1000',
  `name` varchar(128) NOT NULL,
  `action` varchar(128) NOT NULL,
  `action_id` int(10) unsigned default '0',
  `slave` tinyint(1) unsigned NOT NULL default '0',
  `ownerEl` int(10) unsigned NOT NULL default '0',
  `isVisible` binary(1) NOT NULL default '1',
  `class` varchar(16) default NULL,
  PRIMARY KEY  (`Id`),
  KEY `isVisible` (`isVisible`),
  KEY `name` (`name`),
  KEY `parentId` (`ownerEl`),
  KEY `hasChildren` (`slave`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Zrzut danych tabeli `tree_menu`
--

INSERT INTO `tree_menu` (`Id`, `position`, `name`, `action`, `action_id`, `slave`, `ownerEl`, `isVisible`, `class`) VALUES
(1, 2, 'Home', 'news', 1, 1, 0, '1', ''),
(2, 3, 'Team', '', 0, 0, 0, '1', ''),
(5, 7, 'Galerie', '', 0, 0, 0, '1', ''),
(6, 4, 'Samochody', '', 0, 0, 0, '1', ''),
(7, 5, 'Kalendarz', 'tables', 1, 1, 0, '1', ''),
(9, 9, 'Wynajem/Sprzedaż ', 'articles', 12, 0, 0, '1', ''),
(10, 3, '2006', '', 0, 0, 5, '1', ''),
(11, 4, '2007', '', 0, 0, 5, '1', ''),
(12, 5, '2008', '', 0, 0, 5, '1', ''),
(13, 6, '2009', '', 0, 0, 5, '1', ''),
(14, 7, '2010', '', 0, 0, 5, '1', ''),
(15, 9, '2011', '', 0, 0, 5, '0', ''),
(16, 1, 'Berlin - Wrocław', 'galleries', 6, 1, 10, '1', ''),
(17, 2, 'Baja Slovakia', 'galleries', 5, 1, 10, '1', ''),
(18, 1, 'Baja de France', 'galleries', 2, 1, 11, '1', ''),
(19, 2, 'Pharaons Rally', 'galleries', 14, 1, 11, '1', ''),
(20, 3, 'Drezno - Wrocław', 'galleries', 7, 1, 11, '1', ''),
(21, 1, '24H Tout Terrain de France', 'galleries', 1, 1, 12, '1', ''),
(22, 2, 'Baja Portalegre', 'galleries', 4, 1, 12, '1', ''),
(23, 3, 'Drezno - Wrocław', 'galleries', 8, 1, 12, '1', ''),
(24, 4, 'Italian Baja', 'galleries', 10, 1, 12, '1', ''),
(25, 5, 'Optic 2000', 'galleries', 13, 1, 12, '1', ''),
(26, 1, 'Drezno - Wrocław', 'galleries', 9, 1, 13, '1', ''),
(27, 2, 'Italian Baja', 'galleries', 11, 1, 13, '1', ''),
(28, 2, 'Baja España Aragon', 'galleries', 3, 1, 14, '1', ''),
(29, 0, 'Italian Baja', 'galleries', 12, 1, 14, '1', ''),
(32, 10, 'Kontakt', 'articles', 6, 1, 0, '1', ''),
(33, 6, 'Sponsorzy', 'articles', 7, 1, 0, '0', ''),
(35, 1, 'Bowler Nemesis', 'articles', 9, 1, 6, '1', ''),
(36, 2, 'BMW X5CC', 'articles', 11, 1, 6, '1', ''),
(37, 3, 'Ciężarówka serwisowa', 'articles', 10, 1, 6, '1', ''),
(38, 8, 'Inne', '', 0, 0, 5, '1', ''),
(39, 1, 'Anglia - Fabryka Drew Bowlera - zakup samochodu', 'galleries', 16, 1, 38, '1', ''),
(40, 2, 'Budowa ciężarówki', 'galleries', 17, 1, 38, '1', ''),
(41, 3, 'Dariusz Żyła - IC seria 4x4 2010', 'galleries', 18, 1, 38, '0', ''),
(42, 4, 'Dariusz Żyła - Tuning Show 2010', 'galleries', 19, 1, 38, '0', ''),
(43, 5, 'Nemesis z nowym silnikiem', 'galleries', 21, 1, 38, '1', ''),
(44, 6, 'Start Naszych Przyjaciół w imprezie Baja Polonia 2009', 'galleries', 22, 1, 38, '0', ''),
(45, 7, 'Maraton Rowerowy 2008', 'galleries', 20, 1, 38, '0', ''),
(46, 1, 'Historia startów', 'tables', 2, 1, 2, '1', ''),
(47, 2, 'Sylwetki zawodników', 'articles', 4, 1, 2, '1', ''),
(48, 0, 'Rajdy przeprawowe', 'galleries', 25, 1, 5, '1', NULL),
(49, 0, 'RMPST odcinek Słomczyn', 'galleries', 26, 1, 55, '1', NULL),
(50, 10, 'Test', '', 0, 0, 5, '1', NULL),
(51, 0, 'Galeria testowa', 'galleries', 27, 1, 50, '1', NULL),
(55, 1, '1999', '', 0, 0, 5, '1', NULL),
(57, 11, 'Bowler', 'galleries', 31, 1, 5, '0', NULL),
(58, 0, 'Top', 'top', 32, 1, 0, '0', NULL),
(59, 1, 'test2', 'galleries', 33, 1, 50, '1', NULL);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_galleries`) REFERENCES `galleries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
