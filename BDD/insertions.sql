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

INSERT INTO admin (nom, mdp) VALUES ('admin_test', 'mdp_test');

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test', 'mdp_test', 'client@test.fr', '2019-01-01 00:00:00', 'true', 0);

INSERT INTO coupon (client_id, code_coupon, date_creation, temps) VALUES ( 1, 'AEB3C','2019-01-01 00:00:00', '10');