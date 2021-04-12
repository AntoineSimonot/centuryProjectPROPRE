-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 12 avr. 2021 à 22:01
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `century_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `name` varchar(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `bets` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tournament_id` (`tournament_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`name`, `id`, `tournament_id`, `bets`) VALUES
('team1', 82, 26, 11),
('team2', 83, 26, 6),
('Team3', 84, 26, 4),
('Team4', 85, 26, 2),
('Team5', 86, 26, 3),
('Team6', 87, 26, 2),
('Team7', 88, 26, 2),
('Team8', 89, 26, 2);

-- --------------------------------------------------------

--
-- Structure de la table `teams_has_matchs`
--

DROP TABLE IF EXISTS `teams_has_matchs`;
CREATE TABLE IF NOT EXISTS `teams_has_matchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round` int(11) NOT NULL,
  `team1` int(11) DEFAULT NULL,
  `team2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team1_id` (`team1`),
  KEY `team2_id` (`team2`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `team_has_users`
--

DROP TABLE IF EXISTS `team_has_users`;
CREATE TABLE IF NOT EXISTS `team_has_users` (
  `users_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `teams_id` (`teams_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` int(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `places` int(11) NOT NULL,
  `maxPlaces` int(64) NOT NULL DEFAULT '24',
  `winner` int(11) DEFAULT NULL,
  `currentRound` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `winner` (`winner`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `date`, `price`, `description`, `places`, `maxPlaces`, `winner`, `currentRound`) VALUES
(25, 'Antoine', '2021-04-14', 250, 'reazrez', 23, 24, NULL, 0),
(26, 'Tournoi 1', '2021-04-06', 250, 'Description super', 0, 24, 82, 1),
(27, 'Antoine', '2021-04-07', 250, 'reazrez', 23, 24, NULL, 0),
(28, 'Antoine', '2021-04-09', 250, 'reazrez', 24, 24, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `pseudo` varchar(45) NOT NULL,
  `tokens` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `admin`, `pseudo`, `tokens`) VALUES
(1, 'simonotantoine1@gmail.com', '0208', 1, 'antoine', 1),
(2, 'simonotantoine@gmail.com', '0208', 0, 'gryph', 2),
(3, 'simonotantoine3@gmail.com', '0208', 0, 'fox', 6),
(4, 'simonotantoine4@gmail.com', '0208', 0, 'nec', 0),
(5, 'simonotantoine5@gmail.com', '0208', 0, 'wolf', 0),
(6, 'simonotantoine6@gmail.com', '0208', 0, 'oui', 0),
(7, 'simonotantoine7@gmail.com', '0208', 0, 'jean', 0),
(8, 'jean@gmail.com', '0208', 0, 'hean', 0),
(9, 'presque@gmail.com', '0208', 0, 'presque', 0),
(10, 'non@gmail.com', '0208', 0, 'non', 0),
(11, 'long@gmail.com', '0208', 0, 'long', 0),
(12, 'yes@gmail.com', '0208', 0, 'yes', 0),
(13, 'XxxX@gmail.com', '0208', 0, 'xxx', 0),
(14, 'bbb@gmail.com', '0208', 0, 'bbb', 0),
(15, 'ahhh@gmail.com', '0208', 0, 'araezr', 0),
(16, 'verre@gmail.com', '0208', 0, 'verre', 0),
(17, 'bonjour@gmail.com', '0208', 0, 'bonchour', 0),
(18, 'sql@gmail.com', '0208', 0, 'sql', 0),
(19, 'idea@gmail.com', '0208', 0, 'idea', 0),
(20, 'sombre@gmail.com', '0208', 0, 'sombre', 0),
(21, 'damien@gmail.com', '0208', 0, 'damien', 0),
(22, 'rino@gmail.com', '0208', 0, 'rino', 0),
(23, 'player@gmail.com', '0208', 0, 'player', 0),
(24, 'user@gmail.com', '0208', 0, 'user', 0),
(25, 'mathieu@gmail.com', '0208', 0, 'mathieu', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_has_tournaments`
--

DROP TABLE IF EXISTS `users_has_tournaments`;
CREATE TABLE IF NOT EXISTS `users_has_tournaments` (
  `users_id` int(11) NOT NULL,
  `tournaments_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`tournaments_id`),
  KEY `fk_users_has_tournaments_tournaments1_idx` (`tournaments_id`),
  KEY `fk_users_has_tournaments_users_idx` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_has_tournaments`
--

INSERT INTO `users_has_tournaments` (`users_id`, `tournaments_id`) VALUES
(3, 26),
(4, 26),
(5, 26),
(6, 26),
(7, 26),
(8, 26),
(9, 26),
(10, 26),
(11, 26),
(12, 26),
(13, 26),
(14, 26),
(15, 26),
(16, 26),
(17, 26),
(18, 26),
(19, 26),
(20, 26),
(21, 26),
(22, 26),
(23, 26),
(24, 26),
(25, 26);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_bets`
--

DROP TABLE IF EXISTS `user_has_bets`;
CREATE TABLE IF NOT EXISTS `user_has_bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `user_name` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Contraintes pour la table `teams_has_matchs`
--
ALTER TABLE `teams_has_matchs`
  ADD CONSTRAINT `teams_has_matchs_ibfk_1` FOREIGN KEY (`team1`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `teams_has_matchs_ibfk_2` FOREIGN KEY (`team2`) REFERENCES `teams` (`id`);

--
-- Contraintes pour la table `team_has_users`
--
ALTER TABLE `team_has_users`
  ADD CONSTRAINT `team_has_users_ibfk_1` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `team_has_users_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_ibfk_1` FOREIGN KEY (`winner`) REFERENCES `teams` (`id`);

--
-- Contraintes pour la table `users_has_tournaments`
--
ALTER TABLE `users_has_tournaments`
  ADD CONSTRAINT `fk_users_has_tournaments_tournaments1` FOREIGN KEY (`tournaments_id`) REFERENCES `tournaments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_tournaments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_has_bets`
--
ALTER TABLE `user_has_bets`
  ADD CONSTRAINT `user_has_bets_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `user_has_bets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
