-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 août 2018 à 14:55
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet5`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet5_comments`
--

DROP TABLE IF EXISTS `projet5_comments`;
CREATE TABLE IF NOT EXISTS `projet5_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `reporting` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet5_groups`
--

DROP TABLE IF EXISTS `projet5_groups`;
CREATE TABLE IF NOT EXISTS `projet5_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(240) NOT NULL,
  `status` varchar(25) NOT NULL,
  `creationDate` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `nbPost` int(11) NOT NULL,
  `nbMember` int(11) NOT NULL,
  `linkCouvPicture` varchar(240) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_groups`
--

INSERT INTO `projet5_groups` (`id`, `title`, `status`, `creationDate`, `lastUpdate`, `nbPost`, `nbMember`, `linkCouvPicture`) VALUES
(56, 'pastÃ¨que', 'private', '2018-08-22 22:40:17', '2018-08-22 22:40:17', 0, 1, 'public/pictures/couv/pastÃ¨que.'),
(58, 'Le petit Nicolas', 'private', '2018-08-24 16:33:22', '2018-08-24 16:33:22', 0, 1, 'public/pictures/couv/Le_petit_Nicolas.png'),
(59, 'Le petit ', 'private', '2018-08-24 16:38:02', '2018-08-24 16:38:02', 0, 1, 'public/pictures/couv/Le_petit_.png'),
(60, 'Le stop', 'private', '2018-08-24 16:38:46', '2018-08-24 16:38:46', 0, -3, 'public/pictures/couv/Le_stop.png'),
(45, 'ytuytiuytuytuytuy', 'private', '2018-08-22 13:22:54', '2018-08-22 13:22:54', 1, 1, ''),
(42, 'iuyyutyutiutuytuytu', 'private', '2018-08-22 12:25:58', '2018-08-22 12:25:58', 2, -3, '');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkfriend`
--

DROP TABLE IF EXISTS `projet5_linkfriend`;
CREATE TABLE IF NOT EXISTS `projet5_linkfriend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId1` int(11) NOT NULL,
  `userId2` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `linkDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkfriend`
--

INSERT INTO `projet5_linkfriend` (`id`, `userId1`, `userId2`, `status`, `linkDate`) VALUES
(61, 10, 7, 'yes', '2018-08-22 09:39:11'),
(62, 7, 10, 'yes', '2018-08-22 09:39:11');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkgroupuser`
--

DROP TABLE IF EXISTS `projet5_linkgroupuser`;
CREATE TABLE IF NOT EXISTS `projet5_linkgroupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `linkDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkgroupuser`
--

INSERT INTO `projet5_linkgroupuser` (`id`, `groupId`, `userId`, `status`, `linkDate`) VALUES
(104, 60, 7, 'admin', '2018-08-24 16:38:46'),
(68, 42, 10, 'member', '2018-08-22 12:25:58'),
(74, 45, 10, 'member', '2018-08-22 13:22:54'),
(108, 60, 10, 'commenter', '2018-08-24 16:53:18'),
(102, 59, 7, 'admin', '2018-08-24 16:38:02'),
(101, 59, 10, 'commenter', '2018-08-24 16:38:02'),
(100, 58, 7, 'admin', '2018-08-24 16:33:22'),
(99, 58, 10, 'author', '2018-08-24 16:33:22'),
(95, 56, 7, 'viewer', '2018-08-22 22:40:17'),
(96, 56, 10, 'admin', '2018-08-22 22:40:17');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_linkreporting`
--

DROP TABLE IF EXISTS `projet5_linkreporting`;
CREATE TABLE IF NOT EXISTS `projet5_linkreporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `reportingDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkreporting`
--

INSERT INTO `projet5_linkreporting` (`id`, `userId`, `commentId`, `reportingDate`) VALUES
(5, 10, 16, '2018-08-22 22:06:49');

-- --------------------------------------------------------

--
-- Structure de la table `projet5_posts`
--

DROP TABLE IF EXISTS `projet5_posts`;
CREATE TABLE IF NOT EXISTS `projet5_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(240) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `nbComment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_posts`
--

INSERT INTO `projet5_posts` (`id`, `userId`, `groupId`, `title`, `content`, `creationDate`, `updateDate`, `nbComment`) VALUES
(21, 7, 45, 'yutytiutyu', 'tyuytyuytuyt', '2018-08-22 13:22:58', '2018-08-22 13:22:58', 0),
(16, 7, 42, 'iuiopuoiuououi', 'iououioiuoiu', '2018-08-22 12:26:35', '2018-08-22 12:26:35', 0),
(17, 7, 42, 'oiuoiuoiuoi', 'oiuoiiuouoiu', '2018-08-22 12:26:51', '2018-08-22 12:26:51', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet5_users`
--

DROP TABLE IF EXISTS `projet5_users`;
CREATE TABLE IF NOT EXISTS `projet5_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  `creationProfil` datetime NOT NULL,
  `nbGroup` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `nbPublication` int(11) NOT NULL,
  `nbComment` int(11) NOT NULL,
  `acompte` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_users`
--

INSERT INTO `projet5_users` (`id`, `pseudo`, `mdp`, `creationProfil`, `nbGroup`, `status`, `lastLogin`, `nbPublication`, `nbComment`, `acompte`) VALUES
(8, 'Sarah Libert', 'Sarah Libert', '2018-08-19 16:20:45', 0, 'member', '2018-08-19 16:20:45', 0, 0, 'off'),
(7, 'Antoine Libert', 'Antoine Libert', '2018-08-19 16:01:54', -3, 'member', '2018-08-19 16:01:54', 3, 5, 'on'),
(10, 'ClÃ©mence Libert', 'ClÃ©mence Libert', '2018-08-22 09:39:02', -5, 'member', '2018-08-22 09:39:02', 0, 0, 'on');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
