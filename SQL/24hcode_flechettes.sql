DROP DATABASE `24hcode_flechettes`;

CREATE DATABASE `24hcode_flechettes` CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `24hcode_flechettes`;

-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 20 Janvier 2018 à 12:12
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `24hcode_flechettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `equipe_id` int(11) NOT NULL,
  `partie_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`equipe_id`, `partie_id`, `numero`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `equipe_joueur`
--

CREATE TABLE `equipejoueur` (
  `equipe_joueur_id` int(11) NOT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  `joueur_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `equipe_joueur`
--

INSERT INTO `equipejoueur` (`equipe_joueur_id`, `equipe_id`, `joueur_id`, `position`) VALUES
(1, 1, 2, 2),
(2, 1, 1, 1),
(3, 2, 3, 1),
(4, 2, 4, 2),
(5, 3, 5, 1),
(6, 3, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `joueur_id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`joueur_id`, `nom`, `prenom`) VALUES
(1, 'Undefined', 'Undefined'),
(2, 'Gasnot', 'Gabriel'),
(3, 'Mineiro', 'Angelo'),
(4, 'Molliere', 'Vincent'),
(5, 'Tadmi', 'Darryl'),
(6, 'Doe', 'John'),
(7, 'Dupond', 'Pierre');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `partie_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `en_cours` int(11) DEFAULT NULL,
  `partie_type_id` int(11) DEFAULT NULL,
  `lancer_actif` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`partie_id`, `date`, `en_cours`, `partie_type_id`, `lancer_actif`) VALUES
(1, '2018-01-01 12:00:01', 0, 1, 0),
(2, '2018-01-02 12:00:01', 0, 2, 0),
(3, '2018-01-04 12:00:01', 0, 3, 0),
(4, '2018-01-06 12:00:01', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `partie_type`
--

CREATE TABLE `partietype` (
  `partie_type_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partie_type`
--

INSERT INTO `partietype` (`partie_type_id`, `type`) VALUES
(1, '10 tours'),
(2, '301'),
(3, '501');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL,
  `partie_id` int(11) DEFAULT NULL,
  `equipe_joueur_id` int(11) DEFAULT NULL,
  `tour` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `update_done` int(11) DEFAULT 0,
  `points` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `score`
--

INSERT INTO `score` (`score_id`, `partie_id`, `equipe_joueur_id`, `tour`, `score`, `update_done`, `points`) VALUES
(1,4,1,1,20,1,'"7", "11", "2"'),
(2,4,2,1,52,1,'"20", "13", "19"'),
(3,4,3,1,21,1,'"6", "14", "1"'),
(4,4,4,1,43,1,'"18", "8", "17"'),
(5,4,5,1,41,1,'"19", "9", "13"'),
(6,4,6,1,31,1,'"20", "0", "11"'),
(7,4,1,2,24,1,'"13", "3", "8"'),
(8,4,2,2,37,1,'"16", "8", "13"'),
(9,4,3,2,36,1,'"16", "14", "6"'),
(10,4,4,2,37,1,'"13", "6", "18"'),
(11,4,5,2,27,1,'"8", "12", "7"'),
(12,4,6,2,14,1,'"3", "7", "4"'),
(13,4,1,3,15,1,'"8", "1", "6"'),
(14,4,2,3,32,1,'"19", "8", "5"'),
(15,4,3,3,46,1,'"12", "16", "18"'),
(16,4,4,3,38,1,'"6", "17", "15"'),
(17,4,5,3,36,1,'"11", "9", "16"'),
(18,4,6,3,27,1,'"8", "6", "13"'),
(19,4,1,4,24,1,'"14", "9", "1"'),
(20,4,2,4,22,1,'"10", "8", "4"'),
(21,4,3,4,42,1,'"19", "8", "15"'),
(22,4,4,4,27,1,'"18", "6", "3"'),
(23,4,5,4,18,1,'"10", "0", "8"'),
(24,4,6,4,49,1,'"11", "20", "18"'),
(25, 4, 1, 5, NULL, 0, ''),
(26, 4, 2, 5, NULL, 0, ''),
(27, 4, 3, 5, NULL, 0, ''),
(28, 4, 4, 5, NULL, 0, ''),
(29, 4, 5, 5, NULL, 0, ''),
(30, 4, 6, 5, NULL, 0, ''),
(31, 4, 1, 6, NULL, 0, ''),
(32, 4, 2, 6, NULL, 0, ''),
(33, 4, 3, 6, NULL, 0, ''),
(34, 4, 4, 6, NULL, 0, ''),
(35, 4, 5, 6, NULL, 0, ''),
(36, 4, 6, 6, NULL, 0, ''),
(37, 4, 1, 7, NULL, 0, ''),
(38, 4, 2, 7, NULL, 0, ''),
(39, 4, 3, 7, NULL, 0, ''),
(40, 4, 4, 7, NULL, 0, ''),
(41, 4, 5, 7, NULL, 0, ''),
(42, 4, 6, 7, NULL, 0, ''),
(43, 4, 1, 8, NULL, 0, ''),
(44, 4, 2, 8, NULL, 0, ''),
(45, 4, 3, 8, NULL, 0, ''),
(46, 4, 4, 8, NULL, 0, ''),
(47, 4, 5, 8, NULL, 0, ''),
(48, 4, 6, 8, NULL, 0, ''),
(49, 4, 1, 9, NULL, 0, ''),
(50, 4, 2, 9, NULL, 0, ''),
(51, 4, 3, 9, NULL, 0, ''),
(52, 4, 4, 9, NULL, 0, ''),
(53, 4, 5, 9, NULL, 0, ''),
(54, 4, 6, 9, NULL, 0, ''),
(55, 4, 1, 10, NULL, 0, ''),
(56, 4, 2, 10, NULL, 0, ''),
(57, 4, 3, 10, NULL, 0, ''),
(58, 4, 4, 10, NULL, 0, ''),
(59, 4, 5, 10, NULL, 0, ''),
(60, 4, 6, 10, NULL, 0, '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`equipe_id`);

--
-- Index pour la table `equipe_joueur`
--
ALTER TABLE `equipejoueur`
  ADD PRIMARY KEY (`equipe_joueur_id`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`joueur_id`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`partie_id`);

--
-- Index pour la table `partie_type`
--
ALTER TABLE `partietype`
  ADD PRIMARY KEY (`partie_type_id`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `equipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `equipe_joueur`
--
ALTER TABLE `equipejoueur`
  MODIFY `equipe_joueur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `joueur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `partie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `partie_type`
--
ALTER TABLE `partietype`
  MODIFY `partie_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE VIEW flechetteresultats AS 

SELECT 



e.equipe_id equipe_equipe_id,
e.partie_id equipe_partie_id,
e.numero equipe_numero,

ej.equipe_joueur_id equipejoueur_equipe_joueur_id,
ej.equipe_id equipejoueur_equipe_id,
ej.joueur_id equipejoueur_joueur_id,
ej.position equipejoueur_position,

j.joueur_id joueur_joueur_id,
j.nom joueur_nom,
j.prenom joueur_prenom,

p.partie_id partie_partie_id,
p.date partie_date,
p.en_cours partie_en_cours,
p.partie_type_id partie_partie_type_id,

pt.partie_type_id partietype_partie_type_id,
pt.type partietype_type,

s.score_id score_score_id,
s.partie_id score_partie_id,
s.equipe_joueur_id score_equipe_joueur_id,
s.tour score_tour,
s.score score_score

FROM partie p
INNER JOIN score s ON p.partie_id = s.partie_id
INNER JOIN equipe e ON p.partie_id = e.partie_id
INNER JOIN equipejoueur ej ON ej.equipe_id = e.equipe_id
INNER JOIN joueur j ON j.joueur_id = ej.joueur_id
INNER JOIN partietype pt ON pt.partie_type_id = p.partie_type_id;