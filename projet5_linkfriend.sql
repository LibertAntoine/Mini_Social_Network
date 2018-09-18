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
-- Structure de la table `projet5_linkfriend`
--

CREATE TABLE `projet5_linkfriend` (
  `id` int(11) NOT NULL,
  `userId1` int(11) NOT NULL,
  `userId2` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `linkDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_linkfriend`
--

INSERT INTO `projet5_linkfriend` (`id`, `userId1`, `userId2`, `link`, `linkDate`) VALUES
(104, 20, 21, 0, '2018-09-17 23:52:00'),
(103, 21, 20, 1, '2018-09-17 23:52:00'),
(102, 20, 17, 1, '2018-09-17 21:04:41'),
(101, 17, 20, 1, '2018-09-17 21:04:41'),
(105, 21, 17, 1, '2018-09-17 23:52:01'),
(106, 17, 21, 0, '2018-09-17 23:52:01'),
(107, 22, 21, 1, '2018-09-17 23:52:24'),
(108, 21, 22, 1, '2018-09-17 23:52:24'),
(109, 22, 20, 1, '2018-09-17 23:52:25'),
(110, 20, 22, 1, '2018-09-17 23:52:25'),
(111, 22, 17, 1, '2018-09-17 23:52:26'),
(112, 17, 22, 1, '2018-09-17 23:52:26'),
(113, 23, 20, 1, '2018-09-17 23:52:43'),
(114, 20, 23, 1, '2018-09-17 23:52:43'),
(115, 24, 22, 1, '2018-09-17 23:53:05'),
(116, 22, 24, 0, '2018-09-17 23:53:05'),
(117, 24, 17, 1, '2018-09-17 23:53:07'),
(118, 17, 24, 0, '2018-09-17 23:53:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet5_linkfriend`
--
ALTER TABLE `projet5_linkfriend`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet5_linkfriend`
--
ALTER TABLE `projet5_linkfriend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
