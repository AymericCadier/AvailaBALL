-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 avr. 2024 à 08:28
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `availaball`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240210160730', '2024-02-23 10:43:05', 445),
('DoctrineMigrations\\Version20240223111524', '2024-03-20 13:21:49', 6);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valid` tinyint(1) DEFAULT NULL,
  `name` longtext,
  `date` date DEFAULT NULL,
  `duration` longtext,
  `type` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_playground_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA746D642E4` (`id_playground_id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `valid`, `name`, `date`, `duration`, `type`, `created_at`, `id_playground_id`) VALUES
(13, 1, 'Tournoi 3x3', '2024-05-30', '5h', 'tournoi', '2024-04-17 11:13:21', 20),
(6, 0, 'Showcase A$AP Rocky', '2025-11-10', '3h', 'showcase, concert', '2024-04-08 07:32:21', 7),
(7, 1, 'Match Paris FC', '2024-07-15', '1h30', 'match professionnel', '2024-04-12 10:33:52', 15);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `sender_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recipient_id` (`recipient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `title`, `message`, `created_at`, `is_read`, `sender_id`, `recipient_id`) VALUES
(8, 'Salut', 'test', '2024-04-19 09:53:30', 1, 42, 30),
(9, 'Ca va', 'ca va bien', '2024-04-19 10:33:59', 0, 42, 30),
(10, 'Salut', 'oui et toi', '2024-04-19 12:27:18', 1, 30, 42);

-- --------------------------------------------------------

--
-- Structure de la table `playground`
--

DROP TABLE IF EXISTS `playground`;
CREATE TABLE IF NOT EXISTS `playground` (
  `id` int NOT NULL,
  `note` float DEFAULT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` longtext,
  `count_user` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=363 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `playground`
--

INSERT INTO `playground` (`id`, `note`, `type`, `name`, `count_user`) VALUES
(3, 4, 'basket', 'Champs de Mars', 0),
(4, 1, 'basket', 'Square Docteur Calmette', 0),
(5, 2, 'basket', 'Paris 14', 0),
(6, 3, 'basket', 'Jardin du Luxembourg', 0),
(7, 4, 'basket', 'Glacière', 0),
(8, 5, 'basket', 'Paris 13', 0),
(9, 0, 'basket', 'Saint-Paul', 0),
(10, 1, 'basket', 'Chatelet', 0),
(11, 2, 'basket', 'Rue de Trévise', 0),
(12, 3, 'basket', 'Duperré', 0),
(13, 4, 'basket', 'Square denvers', 0),
(14, 4, 'basket', 'Jardin Villemin', 0),
(15, 0, 'basket', 'Jemmapes', 0),
(16, 1, 'basket', 'Riquet', 0),
(17, 2, 'basket', 'Bagnolet', 0),
(18, 3, 'basket', 'Rue Charrière', 0),
(19, 4, 'foot', 'ASPT75', 0),
(20, 5, 'foot', 'Foot 130', 0),
(21, 0, 'foot', 'Tour aux parachutes', 0),
(22, 1, 'foot', 'Léo Lagrange', 0),
(23, 2, 'foot', 'Jussieu', 0),
(24, 5, 'foot', 'Saint Paul', 0),
(25, 3, 'foot', 'Neuve Saint-Pierre', 0),
(26, 4, 'foot', 'Stadio Bruscield', 0),
(27, 5, 'foot', 'Lagny', 0),
(28, 0, 'foot', 'Jardiniers', 0),
(29, 1, 'foot', 'Rue des Haies', 0),
(30, 2, 'foot', 'Déjerine (Paris FC)', 0),
(31, 3, 'foot', 'La grange aux belles', 0),
(32, 4, 'foot', 'Square Léon', 0),
(33, 5, 'foot', 'Pailleron', 0),
(34, 0, 'foot', 'Porte des Lilas', 0),
(35, 1, 'foot', 'Parc Martin Luther King', 0),
(36, 2, 'foot', 'Bertrand Dauvin', 0),
(37, 3, 'foot', 'Le Five', 0),
(38, 4, 'foot', 'rai by Courtside', 0);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `begin_hour` time DEFAULT NULL,
  `end_hour` time DEFAULT NULL,
  `note` float DEFAULT NULL,
  `id_user_id` int NOT NULL,
  `id_playground_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D479F37AE5` (`id_user_id`),
  KEY `IDX_D044D5D446D642E4` (`id_playground_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `date`, `begin_hour`, `end_hour`, `note`, `id_user_id`, `id_playground_id`) VALUES
(47, '2024-04-12', '16:13:00', '16:13:57', 5, 30, 24),
(48, '2024-04-12', '15:27:35', '15:27:50', 4, 30, 7),
(49, '2024-04-12', '15:06:02', '15:06:14', 2, 30, 10),
(50, '2024-04-12', '15:19:17', '15:19:58', 3, 30, 16),
(51, '2024-04-12', '15:24:12', '15:26:33', 4, 30, 20),
(52, '2024-04-18', '19:11:07', '19:11:21', 4, 30, 3),
(53, '2024-04-26', '11:03:19', '11:03:32', 4, 30, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL,
  `roles` json NOT NULL,
  `lname` longtext,
  `fname` longtext,
  `nickname` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email` longtext,
  `password` longtext,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `deleted_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `roles`, `lname`, `fname`, `nickname`, `email`, `password`, `created_at`, `deleted_at`) VALUES
(42, '[\"ROLE_USER\"]', 'qq', 'qq', 'qq', 'q@q.q', '$2y$13$FccTAPNUbp55347zFWILYeEGT9yzRHvhSrJchErryGkUMQHjo0DYq', '2024-03-20 14:11:12', NULL),
(29, '[\"ROLE_USER\", \"ROLE_ADMIN\"]', 'a', 'aa', 'a', 'a@a.a', '$2y$13$pt19bXV5.SnYV21nq7bpyeFQBha0MP3G7jEuMBbKv3V4GowIdybQ.', '2024-03-25 14:38:33', '2024-04-03 10:31:04'),
(30, '[\"ROLE_USER\", \"ROLE_ADMIN\"]', 'b', 'b', 'b', 'b@b.b', '$2y$13$r9s4tnR0mcCjg1dad4uq6e.tLkbFZnLeKNCP9VQzBh6o5CKGE.Pba', '2024-04-07 17:30:33', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
