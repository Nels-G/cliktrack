-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql107.byetcluster.com
-- Généré le :  Dim 17 nov. 2024 à 13:40
-- Version du serveur :  10.6.19-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_37730030_viewlink`
--

-- --------------------------------------------------------

--
-- Structure de la table `clicks`
--

CREATE TABLE `clicks` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `link` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `clicks`
--

INSERT INTO `clicks` (`id`, `ip`, `time`, `link`) VALUES
(1, '41.78.139.6', '2024-11-17 18:31:13', 'https://learn.microsoft.com/en-us/training/courses/sc-400t00?wt.mc_id=studentamb_350176');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
