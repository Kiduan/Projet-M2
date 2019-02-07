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


INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test2', 'mdp_c2', 'client2@test.fr', '2019-01-01 00:00:00', 'true', 0);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test3', 'mdp_c3', 'client3@test.fr', '2019-01-01 00:00:00', 'false', 10);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test4', 'mdp_c4', 'client4@test.fr', '2019-01-01 00:00:00', 'false', 5);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test5', 'mdp_c5', 'client5@test.fr', '2019-01-01 00:00:00', 'false', 8);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test6', 'mdp_c6', 'client6@test.fr', '2019-01-01 00:00:00', 'false', 0);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test7', 'mdp_c7', 'client7@test.fr', '2019-01-01 00:00:00', 'true', 0);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test8', 'mdp_c8', 'client8@test.fr', '2019-01-01 00:00:00', 'true', 3);

INSERT INTO client (nom, mdp, email, date_inscription, vip, temps) VALUES 
('client_test9', 'mdp_c9', 'client9@test.fr', '2019-01-01 00:00:00', 'false', 56);
