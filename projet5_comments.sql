-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : ingenusprb476.mysql.db
-- Généré le :  mar. 18 sep. 2018 à 14:06
-- Version du serveur :  5.6.39-log
-- Version de PHP :  5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ingenusprb476`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet5_comments`
--

CREATE TABLE `projet5_comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `reporting` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_comments`
--

INSERT INTO `projet5_comments` (`id`, `userId`, `articleId`, `groupId`, `content`, `creationDate`, `reporting`) VALUES
(52, 17, 74, 135, 'Quam etiam ut operatur operatur ut facinorum mentium partilibus quam.', '2018-09-18 00:08:37', 0),
(51, 20, 73, 133, 'Deorum Haec diligatur omnium omnibus amicitia nulla nullus in audiendi.', '2018-09-18 00:04:25', 0),
(50, 20, 69, 133, 'Quae sit dicitur in dividendo via non mihi est quae.', '2018-09-18 00:04:10', 0),
(49, 20, 69, 133, 'Enim sit prima trium sit causa animatus in sententiarum non.', '2018-09-18 00:03:36', 0),
(53, 17, 69, 133, 'Scipionis ille dotatur et patris stipe dotatur filia nobilitas filia.', '2018-09-18 00:08:52', 0),
(54, 17, 69, 133, 'Id nodum nodum simulationem tractatus conloquiis codicem interiret mollioribus nisu.', '2018-09-18 00:09:04', 0),
(55, 17, 70, 133, 'Inde interrogationibus ad defensi et praestituto notarii defensi responsum truci.', '2018-09-18 00:09:20', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet5_comments`
--
ALTER TABLE `projet5_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet5_comments`
--
ALTER TABLE `projet5_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
