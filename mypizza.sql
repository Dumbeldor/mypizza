-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 30 Septembre 2014 à 23:10
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mypizza`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPizzeria` int(11) NOT NULL,
  `nomIngredient` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pizzeria`
--

CREATE TABLE IF NOT EXISTS `pizzeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siret` varchar(40) NOT NULL,
  `nomPizzeria` varchar(100) NOT NULL,
  `nomResponsable` varchar(100) NOT NULL,
  `prenomResponsable` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `adressePostal` int(5) NOT NULL,
  `rue` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `pizzeria`
--

INSERT INTO `pizzeria` (`id`, `siret`, `nomPizzeria`, `nomResponsable`, `prenomResponsable`, `pass`, `telephone`, `email`, `ville`, `adressePostal`, `rue`) VALUES
(1, '', 'Mypizz', 'Glize', 'Vincent', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '637962713', 'vincentglize@hotmail.fr', 'Seignosse', 40510, '24 rue emile zola'),
(2, '123456789', 'Test', 'Glize', 'Vincent', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '637962713', 'vincentglize@hotmail.fr', 'Seignosse', 40510, '24 rue emile zola'),
(3, '123456789123', 'Test', 'Glize', 'Vincent', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '637962713', 'vincentglize@hotmail.fr', 'Seignosse', 40510, '24 rue emile zola');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPizzeria` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `pass`, `email`) VALUES
(1, 'Glize', 'Vincent', 'Dumbeldor', '123456789', 'vincentglize@hotmail.fr'),
(2, 'Glize', 'Vincent', 'Dumbeldor2', '123456789', 'vincentglize2@hotmail.fr'),
(3, 'Glize', 'Vincent', 'Dumbeldor2s', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'vincentglizes2@hotmail.fr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
