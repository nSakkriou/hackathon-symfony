-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 juil. 2024 à 08:39
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coopteam`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_type`
--

DROP TABLE IF EXISTS `action_type`;
CREATE TABLE IF NOT EXISTS `action_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `action_type`
--

INSERT INTO `action_type` (`id`, `name`, `points`) VALUES
(3, 'NO GO', 0),
(4, 'GO', 1),
(5, 'Bonus Challenge', 3),
(6, 'Préqualification téléphonique', 2),
(7, 'Entretien RH', 2),
(8, 'Entretien Manager', 3),
(9, 'Candidat Recruté', 5);

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8C9F3610CCFA12B8` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`id`, `profile_id`, `name`, `path`) VALUES
(1, 3, 'tenetur', '/path/to/files/stw'),
(2, 5, 'ad', '/path/to/files/pls'),
(3, 8, 'aspernatur', '/path/to/files/dwg'),
(4, 10, 'autem', '/path/to/files/oxt'),
(5, 5, 'quam', '/path/to/files/yang'),
(6, 2, 'sit', '/path/to/files/wml'),
(7, 1, 'sit', '/path/to/files/gtw'),
(8, 2, 'quisquam', '/path/to/files/rmvb'),
(9, 5, 'dolorum', '/path/to/files/lostxml'),
(10, 9, 'rerum', '/path/to/files/pnm');

-- --------------------------------------------------------

--
-- Structure de la table `pop_up_message`
--

DROP TABLE IF EXISTS `pop_up_message`;
CREATE TABLE IF NOT EXISTS `pop_up_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `ended_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pop_up_message`
--

INSERT INTO `pop_up_message` (`id`, `message_text`, `started_at`, `ended_at`) VALUES
(1, 'Debitis qui dolores expedita beatae. Odio ut similique eos repellendus. Soluta magnam voluptates nostrum error aut id. Accusamus perspiciatis qui hic dolorum accusantium rerum.', '2024-01-26 00:00:00', '2024-03-30 00:00:00'),
(2, 'Quis fugit et vitae distinctio laborum. Necessitatibus provident sunt ipsa id blanditiis est dignissimos. Ipsa libero nesciunt illo sed.', '2024-03-04 00:00:00', '2024-04-04 00:00:00'),
(3, 'Labore sequi quibusdam sed minima. Qui a aliquid nisi et. Voluptas omnis dolor fugit quasi minima qui rerum.', '2024-04-13 00:00:00', '2024-03-02 00:00:00'),
(4, 'Minima repellat repellendus dignissimos suscipit. Atque sequi et incidunt aliquid nisi quis. Fuga et enim non repellat est aspernatur. Aut facilis enim aut eaque eos.', '2024-02-24 00:00:00', '2024-02-08 00:00:00'),
(5, 'Aut sit officiis dolorem sint debitis velit. Ipsa enim distinctio quibusdam id architecto. Voluptatibus voluptatem dolores neque delectus. Veniam corporis voluptatem tempora et quia.', '2024-02-29 00:00:00', '2024-04-26 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coopted_by_id` int NOT NULL,
  `status_id` int NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acquaintance_pro` tinyint(1) NOT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8157AA0FE7927C74` (`email`),
  KEY `IDX_8157AA0F84EDDC6` (`coopted_by_id`),
  KEY `IDX_8157AA0F6BF700BD` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profile`
--

INSERT INTO `profile` (`id`, `coopted_by_id`, `status_id`, `firstname`, `lastname`, `phone`, `email`, `acquaintance_pro`, `linkedin`) VALUES
(1, 13, 2, 'Savanna', 'Corwin', '0000000000', 'oconnell.pearlie@hotmail.com', 1, 'http://stamm.biz/odit-ea-alias-sunt-unde-non-corrupti-temporibus'),
(2, 15, 1, 'Floyd', 'Rippin', '0000000000', 'anne.reinger@hotmail.com', 1, 'http://www.walter.info/'),
(3, 11, 2, 'Audreanne', 'O\'Keefe', '0000000000', 'aniya38@padberg.com', 1, 'http://rempel.net/aut-molestiae-quia-voluptatem-occaecati-impedit-sequi'),
(4, 12, 3, 'Therese', 'Daniel', '0000000000', 'christiansen.wilber@hotmail.com', 1, 'https://skiles.biz/distinctio-ratione-voluptatem-dolorum-sunt-ut.html'),
(5, 13, 1, 'Lilyan', 'Quigley', '0000000000', 'pasquale.tremblay@batz.com', 0, 'http://www.kohler.com/autem-quo-nulla-qui-est-nulla-quis'),
(6, 15, 1, 'Isom', 'Schaden', '0000000000', 'weber.terence@gerlach.net', 0, 'http://simonis.org/nihil-occaecati-consectetur-ut-et-sit-sapiente-ipsa-vel.html'),
(7, 14, 3, 'Shyanne', 'Hodkiewicz', '0000000000', 'maude58@rempel.com', 0, 'https://gibson.com/aut-eaque-qui-inventore-doloremque-aut.html'),
(8, 13, 3, 'Marc', 'Macejkovic', '0000000000', 'mozelle86@hagenes.net', 0, 'http://www.conroy.com/consectetur-maxime-nulla-eum-nihil'),
(9, 14, 2, 'Barney', 'Koch', '0000000000', 'alysa41@gmail.com', 1, 'http://dietrich.org/aspernatur-eos-laboriosam-animi-quisquam-et'),
(10, 11, 1, 'Fredy', 'Smitham', '0000000000', 'bsteuber@gmail.com', 1, 'https://www.gaylord.com/non-numquam-animi-omnis-et-dolores-eos');

-- --------------------------------------------------------

--
-- Structure de la table `profile_action`
--

DROP TABLE IF EXISTS `profile_action`;
CREATE TABLE IF NOT EXISTS `profile_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id_id` int NOT NULL,
  `profile_id` int NOT NULL,
  `action_type_id` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_2FE6EBF59D86650F` (`user_id_id`),
  KEY `IDX_2FE6EBF5CCFA12B8` (`profile_id`),
  KEY `IDX_2FE6EBF51FEE0472` (`action_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profile_action`
--

INSERT INTO `profile_action` (`id`, `user_id_id`, `profile_id`, `action_type_id`, `created_at`) VALUES
(1, 12, 4, 9, '2024-01-25 00:00:00'),
(2, 11, 1, 9, '2024-01-06 00:00:00'),
(3, 14, 9, 4, '2024-01-15 00:00:00'),
(4, 12, 4, 4, '2024-01-26 00:00:00'),
(5, 15, 3, 9, '2024-03-15 00:00:00'),
(6, 12, 7, 8, '2024-04-04 00:00:00'),
(7, 14, 9, 5, '2024-04-13 00:00:00'),
(8, 13, 1, 6, '2024-05-20 00:00:00'),
(9, 14, 1, 6, '2024-05-27 00:00:00'),
(10, 13, 6, 4, '2024-06-02 00:00:00'),
(11, 12, 3, 5, '2024-01-19 00:00:00'),
(12, 13, 6, 8, '2024-01-21 00:00:00'),
(13, 13, 10, 7, '2024-02-19 00:00:00'),
(14, 13, 1, 9, '2024-03-03 00:00:00'),
(15, 12, 10, 8, '2024-02-24 00:00:00'),
(16, 13, 9, 8, '2024-03-15 00:00:00'),
(17, 12, 2, 5, '2024-04-12 00:00:00'),
(18, 12, 9, 3, '2024-05-15 00:00:00'),
(19, 11, 4, 5, '2024-05-09 00:00:00'),
(20, 11, 6, 7, '2024-03-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `profile_status`
--

DROP TABLE IF EXISTS `profile_status`;
CREATE TABLE IF NOT EXISTS `profile_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_step` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profile_status`
--

INSERT INTO `profile_status` (`id`, `name`, `order_step`) VALUES
(1, 'Préqual Tél', 0),
(2, 'Entretien RH', 1),
(3, 'Entretien Manager', 2),
(4, 'Vivier', 3),
(5, 'Candidat Recruté', 4),
(6, 'Candidat non retenu', 5);

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `name`) VALUES
(1, 'Jenkins-Smith'),
(2, 'Smith-Effertz'),
(3, 'Goodwin-Pacocha');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team_id` int DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  KEY `IDX_8D93D649296CD8AE` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `team_id`, `email`, `roles`, `password`, `firstname`, `lastname`, `phone`) VALUES
(11, 2, 'user0@example.com', '[\"ROLE_HR\"]', '$2y$13$PXvZChckJDF0pUwG3TSUX.cQyNAAWIjzR3mvS9j5t8aq3WPHZ6bbW', 'Donny', 'Schultz', '0000000000'),
(12, 3, 'user1@example.com', '[\"ROLE_USER\"]', '$2y$13$.hFc5r124tAT8E09b69KpO8sDdMG8TWr7d6U23zN5rHQQFP2SI2YS', 'Ashlynn', 'Moore', '0000000000'),
(13, 3, 'user2@example.com', '[\"ROLE_USER\"]', '$2y$13$xm6cq/B6zMGajYrqSQQuA.wcPp7KC1GtKp1Qy7YwELvqjvbXUikgW', 'Viva', 'Barrows', '0000000000'),
(14, 2, 'user3@example.com', '[\"ROLE_USER\"]', '$2y$13$DRjnr65DN64Vevv3SezMFOFSLyg.pPgCpH8EpXAzcnBx6DzSkV2Da', 'Hal', 'Kirlin', '0000000000'),
(15, 1, 'user4@example.com', '[\"ROLE_USER\"]', '$2y$13$Qawz6CRHK.2.zyp0hs0jZejB5Cv6Rbr48DKW38nBtGlZ1WXJ5pJ.u', 'Laura', 'Bogan', '0000000000');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `FK_8C9F3610CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`);

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_8157AA0F6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `profile_status` (`id`),
  ADD CONSTRAINT `FK_8157AA0F84EDDC6` FOREIGN KEY (`coopted_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `profile_action`
--
ALTER TABLE `profile_action`
  ADD CONSTRAINT `FK_2FE6EBF51FEE0472` FOREIGN KEY (`action_type_id`) REFERENCES `action_type` (`id`),
  ADD CONSTRAINT `FK_2FE6EBF59D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2FE6EBF5CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
