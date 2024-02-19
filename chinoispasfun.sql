-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 29 mai 2023 à 17:28
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chinoispasfun`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercices`
--

CREATE TABLE `exercices` (
  `id_exercice` int(11) NOT NULL,
  `question` text NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `reponse` text NOT NULL,
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exercices`
--

INSERT INTO `exercices` (`id_exercice`, `question`, `A`, `B`, `C`, `reponse`, `theme`) VALUES
(1, '一', 'un', 'trois', 'dix', 'un', 'Les nombres'),
(2, '我', 'tu', 'elles', 'je', 'je', 'Les pronoms'),
(3, '十三', 'dix', 'vingt-trois', 'treize', 'treize', 'Les nombres'),
(4, 'quatre', '七', '八', '四', '四', 'Les nombres'),
(5, 'soixante-et-onze', '三十七', '七十一', '七十三', '七十一', 'Les nombres'),
(6, 'trois cents', '一百', '六百', '三百', '三百', 'Les nombres'),
(7, '三月二十五号', '3 décembre', '25 mars', '3 janvier', '25 mars', 'Les dates'),
(8, '星期四十一月十六号', 'jeudi 16 novembre', 'vendredi 26 octobre', 'jeudi 26 octobre', 'jeudi 16 novembre', 'Les dates');

-- --------------------------------------------------------

--
-- Structure de la table `mot`
--

CREATE TABLE `mot` (
  `id` int(11) NOT NULL,
  `mot` text NOT NULL,
  `traduction` text NOT NULL,
  `pinyin` text NOT NULL,
  `exemple` text NOT NULL,
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mot`
--

INSERT INTO `mot` (`id`, `mot`, `traduction`, `pinyin`, `exemple`, `theme`) VALUES
(2, '一', 'un', 'yī', '十一 onze', 'Les nombres'),
(3, '二', 'deux', 'èr', '二十五 vingt cinq', 'Les nombres'),
(4, '三', 'trois', 'sān ', '十三 treize', 'Les nombres'),
(5, '四', 'quatre', 'sì ', '四十七 quarante-sept', 'Les nombres'),
(6, '五', 'cinq', 'wǔ ', '五百 cinq cents', 'Les nombres'),
(7, '六', 'six', 'liù ', '六十八 soixante-huit', 'Les nombres'),
(8, '七', 'sept', 'qī ', '十七 dix-sept', 'Les nombres'),
(9, '八', 'huit', 'bā ', '八十八 quatre-vingt-huit', 'Les nombres'),
(10, '九', 'neuf', 'jiǔ ', '九十九 quatre-vingt-dix-neuf', 'Les nombres'),
(11, '十', 'dix', 'shí ', '十四 quatorze', 'Les nombres'),
(12, '二十', 'vingt', 'èr shí', '二十一 vingt-et-un', 'Les nombres'),
(13, '百', 'cent', 'bǎi ', '一百 cent', 'Les nombres'),
(14, '我', 'je', 'wǒ', '我叫Sarra. Je mappelle Sarra.', 'Les pronoms'),
(15, '月', 'mois', 'yuè', '一月 janvier', 'Les dates'),
(16, '号', 'numéro (ici : jour du mois)', 'hào', '七号 le 7 du mois', 'Les dates'),
(17, '星期', 'semaine', 'xīngqī', '十二月 八号 星期五 vendredi 8 décembre', 'Les dates'),
(18, '星期一', 'lundi', 'xīngqīyī', "我不喜欢星期一 Je n'aime pas le lundi", 'Les dates'),
(19, '星期六', 'samedi', 'xīngqīliù', "星期六是周末最喜欢的日子！Samedi c'est mon jour préféré du week-end !", 'Les dates'),
(20, '星期天', 'dimanche', 'xīngqītiān', '星期天下雨 Il pleut dimanche', 'Les dates'),
(21, '六月', 'juin', 'liùyuè', '六月二十一号 21 juin', 'Les dates'),
(22, '十月', 'octobre', 'shíyuè', '十月十八号 18 octobre', 'Les dates');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(11) NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `mail`) VALUES
(2, 'jujustine.tu@gmail.com'),
(4, 'pic@pouc.com'),
(5, 'test@test.com'),
(6, 'lb@kj.com'),
(16, 'justine@tu.com'),
(22, 'maxou@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `resultats`
--

CREATE TABLE `resultats` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_exercice` int(11) NOT NULL,
  `resultat` text NOT NULL,
  `date_resultat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL COMMENT 'clé primaire',
  `nom` varchar(30) NOT NULL COMMENT 'nom',
  `prenom` varchar(30) NOT NULL COMMENT 'prénom',
  `mail` text NOT NULL COMMENT 'mail',
  `mdp` text NOT NULL COMMENT 'mot de passe',
  `date_inscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `mail`, `mdp`, `date_inscription`) VALUES
(1, 'Tu', 'Justine', 'jujustine.tu@gmail.com', 'bonjour', '2023-05-26 23:49:36'),
(5, 'Tu', 'Justine', 'justine@tu.com', 'fun', '2023-05-28 00:06:44');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercices`
--
ALTER TABLE `exercices`
  ADD PRIMARY KEY (`id_exercice`);

--
-- Index pour la table `mot`
--
ALTER TABLE `mot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`);

--
-- Index pour la table `resultats`
--
ALTER TABLE `resultats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_exo` (`id_exercice`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercices`
--
ALTER TABLE `exercices`
  MODIFY `id_exercice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `mot`
--
ALTER TABLE `mot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `resultats`
--
ALTER TABLE `resultats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire', AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `resultats`
--
ALTER TABLE `resultats`
  ADD CONSTRAINT `id_exo` FOREIGN KEY (`id_exercice`) REFERENCES `exercices` (`id_exercice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
