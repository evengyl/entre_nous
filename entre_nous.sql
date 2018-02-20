-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 18 fév. 2018 à 20:49
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `entre_nous`
--
CREATE DATABASE IF NOT EXISTS `entre_nous` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `entre_nous`;

-- --------------------------------------------------------

--
-- Structure de la table `client_now`
--

CREATE TABLE `client_now` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_courante_code_postal` varchar(10) NOT NULL,
  `date_debut_contrat` varchar(30) NOT NULL,
  `date_fin_contrat_estimee` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `id_type_service` tinyint(4) NOT NULL,
  `adresse_courante_numero` smallint(6) NOT NULL,
  `adresse_courante_localite` varchar(60) NOT NULL,
  `adresse_courante_rue` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `client_now`
--

TRUNCATE TABLE `client_now`;
-- --------------------------------------------------------

--
-- Structure de la table `client_old`
--

CREATE TABLE `client_old` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_debut_contrat` varchar(50) NOT NULL,
  `date_fin_contrat` varchar(50) NOT NULL,
  `id_type_service` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `client_old`
--

TRUNCATE TABLE `client_old`;
-- --------------------------------------------------------

--
-- Structure de la table `comment_by_all_on_project`
--

CREATE TABLE `comment_by_all_on_project` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(30) NOT NULL,
  `nom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `comment_by_all_on_project`
--

TRUNCATE TABLE `comment_by_all_on_project`;
-- --------------------------------------------------------

--
-- Structure de la table `comment_by_client`
--

CREATE TABLE `comment_by_client` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `comment_by_client`
--

TRUNCATE TABLE `comment_by_client`;
-- --------------------------------------------------------

--
-- Structure de la table `list_type_service`
--

CREATE TABLE `list_type_service` (
  `id` int(11) NOT NULL,
  `nom_service` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `list_type_service`
--

TRUNCATE TABLE `list_type_service`;
-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `login`
--

TRUNCATE TABLE `login`;
-- --------------------------------------------------------

--
-- Structure de la table `translate`
--

CREATE TABLE `translate` (
  `id` int(11) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_nl` varchar(255) NOT NULL,
  `name_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `translate`
--

TRUNCATE TABLE `translate`;
--
-- Déchargement des données de la table `translate`
--

INSERT INTO `translate` (`id`, `name_fr`, `name_en`, `name_nl`, `name_code`) VALUES
(1, '', '', '', '__TRANS_accueil__'),
(2, '', '', '', '__TRANS_documentations__'),
(3, '', '', '', '__TRANS_contact_us__'),
(4, '', '', '', '__TRANS_accueil__'),
(5, '', '', '', '__TRANS_how_to_choise_your_extract__'),
(6, '', '', '', '__TRANS_autre__'),
(7, '', '', '', '__TRANS_documentations__'),
(8, '', '', '', '__TRANS_contact_us__'),
(9, '', '', '', '__TRANS_ou_nous_trouver__'),
(10, '', '', '', '__TRANS_categories__'),
(11, '', '', '', '__TRANS__contact_detail__'),
(12, '', '', '', '__TRANS_horaire__'),
(13, '', '', '', '__TRANS_horaire_list__'),
(14, '', '', '', '__TRANS_address_title__'),
(15, '', '', '', '__TRANS_tel__'),
(16, '', '', '', '__TRANS_footer_price__'),
(17, '', '', '', '__TRANS_login__');

-- --------------------------------------------------------

--
-- Structure de la table `type_service_client`
--

CREATE TABLE `type_service_client` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_type_contrat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `type_service_client`
--

TRUNCATE TABLE `type_service_client`;
--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client_now`
--
ALTER TABLE `client_now`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client_old`
--
ALTER TABLE `client_old`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment_by_all_on_project`
--
ALTER TABLE `comment_by_all_on_project`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment_by_client`
--
ALTER TABLE `comment_by_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `list_type_service`
--
ALTER TABLE `list_type_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `translate`
--
ALTER TABLE `translate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client_now`
--
ALTER TABLE `client_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `client_old`
--
ALTER TABLE `client_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comment_by_all_on_project`
--
ALTER TABLE `comment_by_all_on_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comment_by_client`
--
ALTER TABLE `comment_by_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `list_type_service`
--
ALTER TABLE `list_type_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `translate`
--
ALTER TABLE `translate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
