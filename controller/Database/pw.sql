-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 nov. 2023 à 03:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pw`
--

-- --------------------------------------------------------

--
-- Structure de la table `colis`
--

CREATE TABLE `colis` (
  `idcolis` int(11) NOT NULL,
  `id_client` varchar(25) NOT NULL,
  `depart` varchar(40) NOT NULL,
  `arrivee` varchar(40) NOT NULL,
  `size` varchar(30) NOT NULL,
  `poids` float NOT NULL,
  `budget` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `colis`
--

INSERT INTO `colis` (`idcolis`, `id_client`, `depart`, `arrivee`, `size`, `poids`, `budget`) VALUES
(2, '1', 'marsa', 'gafsa', '30*15*40', 5.4, 0),
(3, 'CGIDhjjjb', 'gammarth', 'ariana', '30*115*20', 14, 0),
(4, '1', 'marsa', 'sfax', '30*115*70', 17, 0);

-- --------------------------------------------------------

--
-- Structure de la table `colis_a_encherer`
--

CREATE TABLE `colis_a_encherer` (
  `idBid` int(11) NOT NULL,
  `idLivreur` int(11) NOT NULL,
  `idcolis` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `dateDepart` date NOT NULL,
  `dateArrive` date NOT NULL,
  `comment` varchar(254) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `colis_a_encherer`
--

INSERT INTO `colis_a_encherer` (`idBid`, `idLivreur`, `idcolis`, `montant`, `dateDepart`, `dateArrive`, `comment`, `status`) VALUES
(5, 3, 2, 50, '2023-11-03', '2023-11-04', 'test', 0),
(41, 1, 2, 35, '2023-11-15', '2023-11-16', 'test', 0),
(42, 1, 2, 28, '2023-11-17', '2023-11-18', 'test', 0),
(43, 2, 2, 15, '2023-01-01', '2023-01-02', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `data`
--

CREATE TABLE `data` (
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `image_url` text NOT NULL,
  `ID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `data`
--

INSERT INTO `data` (`nom`, `prenom`, `numero`, `email`, `password`, `image_url`, `ID`) VALUES
('Hamouda', 'Ben abedennbi', '59863255', 'Hamouda@gmail.com', 'hhhhhhhaaaa123', 'Capture d\'écran 2023-10-31 192216.png', 'CGIDhjjjb'),
('Mustapha', 'Belkadhi', '21939904', 'Workenxaimelespatat@gmail.com', 'azzzzaaa123', 'search-alt-2-regular-24.png', 'Ck8yjsnCF');

-- --------------------------------------------------------

--
-- Structure de la table `deliverylinkpoints`
--

CREATE TABLE `deliverylinkpoints` (
  `id_client` int(11) NOT NULL,
  `Points` int(11) NOT NULL,
  `iD_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `date de naissance` date NOT NULL,
  `CIN` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`idLivreur`, `nom`, `prenom`, `email`, `password`, `numero`, `date de naissance`, `CIN`) VALUES
(1, 'ben moussa', 'mahmoud', 'benmoussamahmoud@fst.tn', 'warframe123', 50123456, '2004-11-11', 0),
(2, 'abid', 'ahmed', 'abid.ahmed@esprit.tn', 'cursed', 20123678, '2004-11-17', 0),
(3, 'chokri', 'nour', 'nour.chokri@esprit.tn', 'azertyuiop', 12345678, '2004-11-18', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messagechat`
--

CREATE TABLE `messagechat` (
  `idmessage` int(25) NOT NULL,
  `idrelationel` int(25) NOT NULL,
  `sender` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `messagechat`
--

INSERT INTO `messagechat` (`idmessage`, `idrelationel`, `sender`, `message`, `date`) VALUES
(1, 0, 1, 'suck my dick hamouda', '2023-11-16'),
(2, 0, 0, 'YES PLEASEEEEEEEEEEE', '2023-11-23'),
(3, 0, 2, 'daddy yes ', '2023-11-30'),
(4, 10, 1, 'Hello can you shut up please ', '2023-11-22');

-- --------------------------------------------------------

--
-- Structure de la table `reclamationa`
--

CREATE TABLE `reclamationa` (
  `idReclamationA` int(11) NOT NULL,
  `idP` int(11) NOT NULL,
  `message` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamationc`
--

CREATE TABLE `reclamationc` (
  `idReclamationC` int(11) NOT NULL,
  `idC` int(11) DEFAULT NULL,
  `idL` int(11) DEFAULT NULL,
  `idCommande` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamationc`
--

INSERT INTO `reclamationc` (`idReclamationC`, `idC`, `idL`, `idCommande`, `type`, `description`) VALUES
(1, NULL, 1, 2, 'Technical', 'Unable to send requests'),
(2, NULL, 1, 4, 'Payement', 'cgdfghdfghdfgh'),
(3, NULL, 1, 4, 'Supprot', 'test test'),
(4, NULL, 1, 4, 'Supprot', 'test test'),
(5, NULL, 1, 3, 'Supprot', 'test test 2'),
(6, NULL, 1, 4, 'Payement', 'sdfgsdfg'),
(8, NULL, 1, 4, 'Payement', 'tetetete'),
(9, NULL, 1, 4, 'Technical', 'kgkyuggh');

-- --------------------------------------------------------

--
-- Structure de la table `relationchat`
--

CREATE TABLE `relationchat` (
  `idrelationel` int(25) NOT NULL,
  `idclient` int(25) NOT NULL,
  `idlivreur` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `relationchat`
--

INSERT INTO `relationchat` (`idrelationel`, `idclient`, `idlivreur`) VALUES
(0, 1, 3),
(2, 1, 1),
(10, 1, 2);

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
-- Index pour la table `colis`
--
ALTER TABLE `colis`
  ADD PRIMARY KEY (`idcolis`);

--
-- Index pour la table `colis_a_encherer`
--
ALTER TABLE `colis_a_encherer`
  ADD PRIMARY KEY (`idBid`),
  ADD KEY `idLivreur` (`idLivreur`),
  ADD KEY `idDeliveries` (`idcolis`);

--
-- Index pour la table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD PRIMARY KEY (`idLivreur`);

--
-- Index pour la table `messagechat`
--
ALTER TABLE `messagechat`
  ADD PRIMARY KEY (`idmessage`),
  ADD KEY `fk_relationchat_messagechat` (`idrelationel`);

--
-- Index pour la table `reclamationa`
--
ALTER TABLE `reclamationa`
  ADD PRIMARY KEY (`date`),
  ADD KEY `idReclamationA` (`idReclamationA`);

--
-- Index pour la table `reclamationc`
--
ALTER TABLE `reclamationc`
  ADD PRIMARY KEY (`idReclamationC`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idC` (`idC`),
  ADD KEY `idL` (`idL`);

--
-- Index pour la table `relationchat`
--
ALTER TABLE `relationchat`
  ADD PRIMARY KEY (`idrelationel`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `idlivreur` (`idlivreur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `colis`
--
ALTER TABLE `colis`
  MODIFY `idcolis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `colis_a_encherer`
--
ALTER TABLE `colis_a_encherer`
  MODIFY `idBid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `livreur`
--
ALTER TABLE `livreur`
  MODIFY `idLivreur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messagechat`
--
ALTER TABLE `messagechat`
  MODIFY `idmessage` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reclamationc`
--
ALTER TABLE `reclamationc`
  MODIFY `idReclamationC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `colis_a_encherer`
--
ALTER TABLE `colis_a_encherer`
  ADD CONSTRAINT `colis_a_encherer_ibfk_1` FOREIGN KEY (`idLivreur`) REFERENCES `livreur` (`idLivreur`),
  ADD CONSTRAINT `colis_a_encherer_ibfk_2` FOREIGN KEY (`idcolis`) REFERENCES `colis` (`idcolis`);

--
-- Contraintes pour la table `messagechat`
--
ALTER TABLE `messagechat`
  ADD CONSTRAINT `fk_relationchat_messagechat` FOREIGN KEY (`idrelationel`) REFERENCES `relationchat` (`idrelationel`),
  ADD CONSTRAINT `messagechat_ibfk_1` FOREIGN KEY (`idrelationel`) REFERENCES `relationchat` (`idrelationel`);

--
-- Contraintes pour la table `reclamationc`
--
ALTER TABLE `reclamationc`
  ADD CONSTRAINT `reclamationc_ibfk_1` FOREIGN KEY (`idC`) REFERENCES `livreur` (`idLivreur`),
  ADD CONSTRAINT `reclamationc_ibfk_2` FOREIGN KEY (`idL`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `reclamationc_ibfk_3` FOREIGN KEY (`idCommande`) REFERENCES `colis` (`idcolis`),
  ADD CONSTRAINT `reclamationc_ibfk_4` FOREIGN KEY (`idC`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `reclamationc_ibfk_5` FOREIGN KEY (`idL`) REFERENCES `livreur` (`idLivreur`),
  ADD CONSTRAINT `reclamationc_ibfk_6` FOREIGN KEY (`idC`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `reclamationc_ibfk_7` FOREIGN KEY (`idL`) REFERENCES `livreur` (`idLivreur`);

--
-- Contraintes pour la table `relationchat`
--
ALTER TABLE `relationchat`
  ADD CONSTRAINT `relationchat_ibfk_1` FOREIGN KEY (`idlivreur`) REFERENCES `livreur` (`idLivreur`),
  ADD CONSTRAINT `relationchat_ibfk_2` FOREIGN KEY (`idclient`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
