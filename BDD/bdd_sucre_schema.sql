-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Version du serveur: 5.5.50-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bdd_sucre`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS admin (
  admin_id int unsigned NOT NULL AUTO_INCREMENT,
  nom varchar(128) NOT NULL,
  mdp varchar(128) NOT NULL,
  PRIMARY KEY (admin_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS client (
  client_id int unsigned NOT NULL AUTO_INCREMENT,
  nom varchar(128) NOT NULL,
  mdp varchar(128) NOT NULL,
  email varchar(128) NOT NULL,
  date_inscription date NOT NULL,
  vip varchar(128) NOT NULL,
  temps int NOT NULL,
    
  PRIMARY KEY (client_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


--
-- Structure de la table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  coupon_id int unsigned NOT NULL AUTO_INCREMENT,
  client_id int unsigned NOT NULL,  
  code_coupon varchar(128) NOT NULL,
  date_creation date NOT NULL,
  temps int NOT NULL,
  actif boolean NOT NULL DEFAULT TRUE,
  PRIMARY KEY (coupon_id),
  FOREIGN KEY (client_id) REFERENCES client(client_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
