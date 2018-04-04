-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : front-ha-mysql-01.shpv.fr:3306
-- Généré le :  Dim 25 mars 2018 à 18:42
-- Version du serveur :  5.6.38
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `myuggyyf_falkio`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `author` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `img_type` int(11) NOT NULL,
  `img_source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `game` text NOT NULL,
  `mode` text NOT NULL,
  `ip` text NOT NULL,
  `port` text NOT NULL,
  `collection` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `image` text NOT NULL,
  `rank` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `textindex`
--

CREATE TABLE `textindex` (
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `titre1` text NOT NULL,
  `titre2` text NOT NULL,
  `titre3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `textindex`
--

INSERT INTO `textindex` (`text1`, `text2`, `text3`, `titre1`, `titre2`, `titre3`) VALUES
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis accumsan ipsum et volutpat. Aenean vel massa commodo erat fermentum suscipit non nec mi. Suspendisse quis mi risus. Donec aliquam dapibus facilisis. Pellentesque elit erat, volutpat ac finibus id, ullamcorper a magna. Nulla hendrerit ornare libero nec elementum. Quisque non cursus ex. Aliquam rhoncus, neque id dignissim dignissim, enim dui bibendum dui, ut blandit tortor justo ac sem. Sed mi orci, ornare at magna in, feugiat iaculis dui. Nam volutpat, ipsum vitae rhoncus pellentesque, purus erat ornare lacus, eu elementum tellus sapien sit amet nibh.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis accumsan ipsum et volutpat. Aenean vel massa commodo erat fermentum suscipit non nec mi. Suspendisse quis mi risus. Donec aliquam dapibus facilisis. Pellentesque elit erat, volutpat ac finibus id, ullamcorper a magna. Nulla hendrerit ornare libero nec elementum. Quisque non cursus ex. Aliquam rhoncus, neque id dignissim dignissim, enim dui bibendum dui, ut blandit tortor justo ac sem. Sed mi orci, ornare at magna in, feugiat iaculis dui. Nam volutpat, ipsum vitae rhoncus pellentesque, purus erat ornare lacus, eu elementum tellus sapien sit amet nibh.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis accumsan ipsum et volutpat. Aenean vel massa commodo erat fermentum suscipit non nec mi. Suspendisse quis mi risus. Donec aliquam dapibus facilisis. Pellentesque elit erat, volutpat ac finibus id, ullamcorper a magna. Nulla hendrerit ornare libero nec elementum. Quisque non cursus ex. Aliquam rhoncus, neque id dignissim dignissim, enim dui bibendum dui, ut blandit tortor justo ac sem. Sed mi orci, ornare at magna in, feugiat iaculis dui. Nam volutpat, ipsum vitae rhoncus pellentesque, purus erat ornare lacus, eu elementum tellus sapien sit amet nibh.', 'Lorem ipsum', 'Lorem ipsum', 'Lorem ipsum');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `bio` text NOT NULL,
  `steamid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `bio`, `steamid`) VALUES
(1, 'Falkio', 'ecc9e0fa3bcc5556c4086f419260c4198a7a7af6', 'Fondateur de la communauté Amnésia.', '76561198315260360');

-- --------------------------------------------------------

--
-- Structure de la table `vocal`
--

CREATE TABLE `vocal` (
  `id` int(11) NOT NULL,
  `plateform` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vocal`
--
ALTER TABLE `vocal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vocal`
--
ALTER TABLE `vocal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
