-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 nov. 2023 à 18:24
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test-pw`
--

-- --------------------------------------------------------

--
-- Structure de la table `activedeliveries`
--

CREATE TABLE `activedeliveries` (
  `idDeliveries` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `depart` varchar(40) NOT NULL,
  `arrive` varchar(40) NOT NULL,
  `size` varchar(30) NOT NULL,
  `poid` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `activedeliveries`
--

INSERT INTO `activedeliveries` (`idDeliveries`, `ID`, `depart`, `arrive`, `size`, `poid`) VALUES
(2, 1, 'marsa', 'gafsa', '30*15*40', 5.4),
(3, 3, 'gammarth', 'ariana', '30*115*20', 14),
(4, 1, 'marsa', 'sfax', '30*115*70', 17);

-- --------------------------------------------------------

--
-- Structure de la table `bids`
--

CREATE TABLE `bids` (
  `idBid` int(11) NOT NULL,
  `idLivreur` int(11) NOT NULL,
  `idDeliveries` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `dateDepart` date NOT NULL,
  `dateArrive` date NOT NULL,
  `comment` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `bids`
--

INSERT INTO `bids` (`idBid`, `idLivreur`, `idDeliveries`, `montant`, `dateDepart`, `dateArrive`, `comment`) VALUES
(1, 1, 3, 20, '2023-11-03', '2023-11-04', ''),
(2, 1, 2, 80, '2023-11-03', '2023-11-06', 'test'),
(3, 2, 2, 70, '2023-11-02', '2023-11-03', 'yes'),
(4, 3, 3, 14, '2023-11-08', '2023-11-09', '12h'),
(5, 3, 2, 50, '2023-11-03', '2023-11-04', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

CREATE TABLE `livreur` (
  `idLivreur` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `numero` int(8) NOT NULL,
  `date de naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`idLivreur`, `nom`, `prenom`, `email`, `password`, `numero`, `date de naissance`) VALUES
(1, 'ben moussa', 'mahmoud', 'benmoussamahmoud@fst.tn', 'warframe123', 50123456, '2004-11-11'),
(2, 'abid', 'ahmed', 'abid.ahmed@esprit.tn', 'cursed', 20123678, '2004-11-17'),
(3, 'chokri', 'nour', 'nour.chokri@esprit.tn', 'azertyuiop', 12345678, '2004-11-18');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `numero` int(8) NOT NULL,
  `date de naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `nom`, `prenom`, `email`, `password`, `numero`, `date de naissance`) VALUES
(1, 'ben abdennebi', 'hamouda', 'hamouda.benabdennebi@esprit.tn', 'azerty77', 50774419, '2002-02-04'),
(3, 'zouaoui', 'montasar', 'montasar.zouaoui@fst.tn', 'tesst45', 90123456, '2003-01-04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activedeliveries`
--
ALTER TABLE `activedeliveries`
  ADD PRIMARY KEY (`idDeliveries`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`idBid`),
  ADD KEY `idLivreur` (`idLivreur`),
  ADD KEY `idDeliveries` (`idDeliveries`);

--
-- Index pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD PRIMARY KEY (`idLivreur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activedeliveries`
--
ALTER TABLE `activedeliveries`
  MODIFY `idDeliveries` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `bids`
--
ALTER TABLE `bids`
  MODIFY `idBid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `livreur`
--
ALTER TABLE `livreur`
  MODIFY `idLivreur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activedeliveries`
--
ALTER TABLE `activedeliveries`
  ADD CONSTRAINT `activedeliveries_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`idLivreur`) REFERENCES `livreur` (`idLivreur`),
  ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`idDeliveries`) REFERENCES `activedeliveries` (`idDeliveries`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
