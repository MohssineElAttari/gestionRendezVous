-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 22 juin 2021 à 13:01
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rdv`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointements`
--

CREATE TABLE `appointements` (
  `userId_fk` int(11) DEFAULT NULL,
  `timeslot_id_fk` int(11) DEFAULT NULL,
  `user_subject` varchar(110) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `appointement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appointements`
--

INSERT INTO `appointements` (`userId_fk`, `timeslot_id_fk`, `user_subject`, `c_date`, `created_at`, `appointement_id`) VALUES
(1, 4, 'test updated successfully', '2021-06-20', '2021-06-20 17:56:29', 3),
(1, 2, 'test tessstttt eeezzzaaa', '2020-06-22', '2021-06-21 13:29:36', 7),
(1, 2, 'test 2', '2020-06-22', '2021-06-21 13:29:56', 8),
(1, 2, 'test 3', '2020-06-22', '2021-06-21 13:30:00', 9),
(1, 2, 'test 4', '2020-06-22', '2021-06-21 13:30:03', 10),
(1, 2, 'test 5', '2020-06-23', '2021-06-21 13:30:18', 11),
(1, 2, 'test 6', '2020-06-23', '2021-06-21 13:30:22', 12),
(1, 2, 'test 7', '2020-06-23', '2021-06-21 13:30:26', 13);

-- --------------------------------------------------------

--
-- Structure de la table `timeslots`
--

CREATE TABLE `timeslots` (
  `timeslot_id` int(11) NOT NULL,
  `start_at` time DEFAULT NULL,
  `end_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `timeslots`
--

INSERT INTO `timeslots` (`timeslot_id`, `start_at`, `end_at`) VALUES
(1, '10:00:00', '10:30:00'),
(2, '11:00:00', '11:30:00'),
(3, '14:00:00', '14:30:00'),
(4, '15:00:00', '15:30:00'),
(5, '16:00:00', '16:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFirstName` varchar(110) DEFAULT NULL,
  `userLastName` varchar(110) DEFAULT NULL,
  `userCIN` varchar(110) DEFAULT NULL,
  `userEmail` varchar(110) DEFAULT NULL,
  `Reference` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userId`, `userFirstName`, `userLastName`, `userCIN`, `userEmail`, `Reference`) VALUES
(1, 'Hicham', 'El Kamouni', 'HH112233', 'hichamelkamouni.dev@gmail.com', NULL),
(2, 'Mohssine', 'Elattari', 'HH223344', 'mohssineElattari@gmail.com', NULL),
(3, 'Safae', 'Baamel', 'HH334455', 'SafaeBaamel@gmail.com', NULL),
(21, 'othamwcwe', 'tewxcwxcst', 'HH121255', 'othamanemous@gmail.com', 'kdhkqsjdhqsd'),
(22, '', '', '', '', 'ce5e901b'),
(23, 'mohammed', '', 'HH12333', 'medOuchen@gmail.com', 'moouHH1914adb0'),
(24, 'ttrree', '', 'HH778899', 'erorgrg@gmail.com', 'ttjkHHf01d1848'),
(25, 'ttrree', 'jkkll', 'HH778899', 'erorgrg@gmail.com', 'ttjkHH8e1de265'),
(26, 'raff', 'rofix', 'z333333', 'gfdgd', 'gdghdghdg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointements`
--
ALTER TABLE `appointements`
  ADD PRIMARY KEY (`appointement_id`),
  ADD KEY `userId_fk` (`userId_fk`,`timeslot_id_fk`),
  ADD KEY `timeslot_id_fk` (`timeslot_id_fk`);

--
-- Index pour la table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`timeslot_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointements`
--
ALTER TABLE `appointements`
  MODIFY `appointement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `timeslot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointements`
--
ALTER TABLE `appointements`
  ADD CONSTRAINT `appointements_ibfk_1` FOREIGN KEY (`userId_fk`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `appointements_ibfk_2` FOREIGN KEY (`timeslot_id_fk`) REFERENCES `timeslots` (`timeslot_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
