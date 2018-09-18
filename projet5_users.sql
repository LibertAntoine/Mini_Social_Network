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
-- Structure de la table `projet5_users`
--

CREATE TABLE `projet5_users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `creationProfil` datetime NOT NULL,
  `nbGroup` int(11) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `nbPublication` int(11) NOT NULL,
  `nbComment` int(11) NOT NULL,
  `actif` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet5_users`
--

INSERT INTO `projet5_users` (`id`, `pseudo`, `mdp`, `creationProfil`, `nbGroup`, `lastLogin`, `nbPublication`, `nbComment`, `actif`, `admin`) VALUES
(21, 'Tom Dupont', '$2y$10$OPlg/SypW8qMbEPBFSyFhu9gntuGpbF3ZTwiGJJ69du0lMQAt.yg6', '2018-09-17 23:51:56', 2, '2018-09-17 23:51:56', 0, 0, 1, 0),
(20, 'Elise Duval', '$2y$10$HmH4zSBRvBeZJB61UCf7/u5IJUGK6606U5hiLCPXkfDZDkWyqsmpS', '2018-09-16 21:59:39', 3, '2018-09-16 21:59:39', 3, 3, 1, 0),
(17, 'Antoine Libert', '$2y$10$6vxzNBivMGp7poT1EFs7N.XfDFc8mV/AjgxDFlAEWo8.FF5PNCeBK', '2018-09-16 21:33:06', 3, '2018-09-16 21:33:06', 1, 4, 1, 0),
(22, 'Eva Durand', '$2y$10$NodAKkv0EVNJAxF0eciCHehAqT.4Bd5H9q3BNdS81.Znm6te7jWxu', '2018-09-17 23:52:19', 2, '2018-09-17 23:52:19', 0, 0, 1, 0),
(23, 'Bastien Dupont', '$2y$10$QAEyAVAwZH7ESymCw.uxqeH4v0vWnQKo.iVRhHesYuINOV0/TLgl6', '2018-09-17 23:52:40', 1, '2018-09-17 23:52:40', 0, 0, 1, 0),
(24, 'Alice Durand', '$2y$10$koZzPpGWd9O/iKFoTEOPF.Li.TJOrIZMvgPG.nzXdYUMJ7MY3qWly', '2018-09-17 23:52:58', 1, '2018-09-17 23:52:58', 0, 0, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projet5_users`
--
ALTER TABLE `projet5_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projet5_users`
--
ALTER TABLE `projet5_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
