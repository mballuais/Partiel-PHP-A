-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 jan. 2025 à 10:52
-- Version du serveur : 8.4.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `escape_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `reponse_attendue` varchar(255) NOT NULL,
  `message_succes` text NOT NULL,
  `message_mauvaise_reponse` text NOT NULL,
  `taux_reussite` decimal(5,2) DEFAULT '0.00',
  `total_reponses` int DEFAULT '0',
  `bonnes_reponses` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `reponse_attendue`, `message_succes`, `message_mauvaise_reponse`, `taux_reussite`, `total_reponses`, `bonnes_reponses`) VALUES
(1, 'Quelle est la capitale de la France ?', 'Paris', ' Bravo, la réponse est correcte !', ' Désolé, ce n\'est pas la bonne réponse. La bonne réponse est Paris.', 71.43, 7, 5),
(2, 'Quel est l\'animal terrestre le plus rapide ?', 'Guepard', 'Correct, le guépard est l\'animal terrestre le plus rapide.', 'Non, le guépard est l\'animal terrestre le plus rapide.', 20.00, 5, 1),
(3, ' Combien de continents y a-t-il sur Terre ?', '7', 'Bien vu champion', 'Et nan chef , c\'est 7 ', 50.00, 2, 1),
(4, 'Quelle est la meilleur sauce au kebab', 'Biggy', 'Toi tu sais ce qui est bon !', 'Aïe aïe ERREUR, j\'espère tu n\'as pas dit le ketchup quand même', 66.67, 3, 2),
(6, 'Quel champion dans lol est le plus beau, charismatique, le plus fort, et le plus majestueux', 'Darius', 'Mon frère d\'armes', 'Looser va, comment c\'est possible de se tromper ?', 66.67, 6, 4),
(7, 'Qui est le plus beau de la school ?', 'Nicolas ', 'Sacré Fayot', 'Nan surtout pas lui', 0.00, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
