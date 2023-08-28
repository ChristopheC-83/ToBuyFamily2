-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 16 juil. 2023 à 05:03
-- Version du serveur : 10.6.12-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u256533777_ToBuy`
--

-- --------------------------------------------------------

--
-- Structure de la table `datas`
--

CREATE TABLE `datas` (
  `id_data` int(11) NOT NULL,
  `name_creator` varchar(50) NOT NULL,
  `name_list` varchar(50) NOT NULL,
  `note` varchar(100) NOT NULL,
  `fait` tinyint(1) NOT NULL,
  `public` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_data` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `create_data` tinyint(1) NOT NULL,
  `read_data` tinyint(1) NOT NULL,
  `update_data` tinyint(1) NOT NULL,
  `delete_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_management`
--

CREATE TABLE `user_management` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `img_site` tinyint(1) NOT NULL,
  `cle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_management`
--

INSERT INTO `user_management` (`login`, `password`, `mail`, `role`, `image`, `img_site`, `cle`) VALUES
('admin', '$2y$10$.e37igGSgvsHDyuqHAngNurdRpPy6cMPOxIYH1nD.UVgLVnqPjNpS', 'admin@admin.com', 'administrateur', 'profils/profils_site/flamme.jpg', 1, 932145),
('Kikisan', '$2y$10$eAbIktPiNRMIpo6TypeS/OciP/fpAfX3n17BPUuolAxvQVJHVRxbK', 'kiketdule@gmail.com', 'administrateur', 'profils/profils_site/astroshiba.jpg', 1, 925709),
('van', '$2y$10$dgNTz3ZIP.Ol9Hr9FVKKLe.x6o175tyqqDlr2OX2YKnALKMyFi0Ma', 'kiketdule@gmail.com', 'utilisateur', 'profils/profils_site/profil_init.jpg', 1, 694221);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id_data`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_data`);

--
-- Index pour la table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `datas`
--
ALTER TABLE `datas`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `datas` (`id_data`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
