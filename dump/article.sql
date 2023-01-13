-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 12 jan. 2023 à 13:05
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tests`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `contenu` text NOT NULL,
  `author` varchar(25) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `author`, `date`) VALUES
(1, 'Article1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit quae illum ratione et rem iste, doloribus molestiae facere quaerat laborum quia enim asperiores ipsam quos voluptatem dolorem nam facilis ipsum!', 'Malick SOKHONA', '2023-01-12'),
(2, 'Article2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit quae illum ratione et rem iste, doloribus molestiae facere quaerat laborum quia enim asperiores ipsam quos voluptatem dolorem nam facilis ipsum!', 'Ahmed bama', '2023-01-02'),
(3, 'Article3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit quae illum ratione et rem iste, doloribus molestiae facere quaerat laborum quia enim asperiores ipsam quos voluptatem dolorem nam facilis ipsum!', 'john snow', '2023-01-23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
