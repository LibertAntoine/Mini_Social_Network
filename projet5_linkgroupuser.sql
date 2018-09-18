-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : ingenusprb476.mysql.db
-- Généré le :  mar. 18 sep. 2018 à 14:07
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
-- Structure de la table `projet5_linkgroupuser`
--

CREATE TABLE `projet5_linkgroupuser` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `linkDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkgroupuser`
--

INSERT INTO `projet5_linkgroupuser` (`id`, `groupId`, `userId`, `status`, `linkDate`) VALUES
(292, 137, 21, 1, '2018-09-18 00:11:16'),
(291, 136, 21, 1, '2018-09-18 00:10:26'),
(297, 135, 17, 5, '2018-09-18 13:41:10'),
(289, 135, 22, 2, '2018-09-18 00:07:24'),
(288, 134, 23, 4, '2018-09-18 00:07:16'),
(287, 135, 20, 1, '2018-09-18 00:06:39'),
(286, 134, 20, 1, '2018-09-18 00:05:24'),
(285, 134, 17, 2, '2018-09-18 00:05:24'),
(284, 133, 17, 1, '2018-09-17 23:56:04'),
(283, 133, 22, 3, '2018-09-17 23:56:04'),
(282, 133, 20, 2, '2018-09-17 23:56:04'),
(294, 139, 24, 1, '2018-09-18 00:14:52');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet5_linkgroupuser`
--
ALTER TABLE `projet5_linkgroupuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet5_linkgroupuser`
--
ALTER TABLE `projet5_linkgroupuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
