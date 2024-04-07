-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 07 avr. 2024 à 19:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agence_voyage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `mot_de_passe`) VALUES
(1, 'admin@example.com', 'adminpass123'),
(2, 'syamina@gmail.com', 'AMINAsy123'),
(3, 'thiamhapstou@gmmail.com', 'HAPSthiam123');

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `id` int(11) NOT NULL,
  `trajet` varchar(60) NOT NULL,
  `prix` int(11) NOT NULL,
  `statut` enum('disponible','indisponible') NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`id`, `trajet`, `prix`, `statut`, `id_admin`) VALUES
(14, 'Dakar - Paris', 250000, 'disponible', 2),
(17, 'Dakar - Madrid', 300000, 'disponible', 3),
(21, 'Dakar - Mecque', 950000, 'disponible', 2),
(22, 'Dakar - Dubai', 508571, 'disponible', 3);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(80) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(12) NOT NULL,
  `mot_de_passe` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`) VALUES
(1, 'demba', 'ndiakhate', 'demba.ndiakhate@example.com', '', 'motdepass123'),
(2, 'Thiam', 'Hapsatou', 'hapsthiam@gmail.com', '781509680', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `destinations_populaires`
--

CREATE TABLE `destinations_populaires` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `destinations_populaires`
--

INSERT INTO `destinations_populaires` (`id`, `nom`, `image`) VALUES
(1, 'MECQUE', 'https://images.pexels.com/photos/11667463/pexels-photo-11667463.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(2, 'DUBAI', 'https://images.pexels.com/photos/1470502/pexels-photo-1470502.jpeg?auto=compress&cs=tinysrgb&w=400'),
(3, 'PARIS', 'https://as1.ftcdn.net/v2/jpg/02/64/54/98/1000_F_264549883_ayKb5wQ3jAE0c4EfXan3tJhCHYCyd8Q4.jpg'),
(4, 'MADRID', 'https://img.freepik.com/photos-gratuite/palais-communication-au-crepuscule-ete-madrid_1398-2169.jpg?w=740');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_billet` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `etat` enum('confirmé','en attente','annulé') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `id_billet`, `id_client`, `date`, `etat`) VALUES
(8, 21, 2, '2024-04-07 00:00:00', 'confirmé'),
(23, 22, 1, '2024-04-07 00:00:00', 'en attente');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `destinations_populaires`
--
ALTER TABLE `destinations_populaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_billet` (`id_billet`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `destinations_populaires`
--
ALTER TABLE `destinations_populaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_billet`) REFERENCES `billet` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
