-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 05 Avril 2018 à 09:44
-- Version du serveur :  5.6.35
-- Version de PHP :  7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `72hchrono`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `role` enum('abonne','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `token`, `created_at`, `role`) VALUES
(1, 'kariza', 'k@g.com', '$2y$10$lEySRnjlUUumZ.aS6rKKleHWRE89esg4jKT16U8zAGCPKdjnpleBC', 'Q9eVtf1b60e3lyHXCGDppxm2Oo05MLRDU5yolzzrAOvWncUZTx', '2018-04-04 15:00:02', 'abonne'),
(2, 'mit', 'm@gmail.com', '$2y$10$2NQORg0ld15SVDb.CyfSculYrMl068dIfkNdsBo8vYvFNDAKmJQ82', 'KPrje2Zxn3aL4Q18dYiuETp0TbAC68LRYcbcfbJCeUojKpsXnK', '2018-04-04 15:29:15', 'abonne');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;