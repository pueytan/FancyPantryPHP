-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2012 at 10:02 AM
-- Server version: 5.1.65
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fpantry_test`
--
CREATE DATABASE `fpantry_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fpantry_test`;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `upc` bigint(20) unsigned NOT NULL,
  `exp_date` timestamp NOT NULL,
  `discount` decimal(5,2) unsigned NOT NULL,
  `item_upc` bigint(20) NOT NULL,
  PRIMARY KEY (`upc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grocery_lists`
--

CREATE TABLE IF NOT EXISTS `grocery_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `upc` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` char(20) NOT NULL,
  PRIMARY KEY (`upc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`upc`, `name`, `category`) VALUES
(24094070916, 'De Cecco Orecchiette, 16-Ounce Boxes', 'grocery'),
(12345, 'aa', 'cat'),
(3, 'c', 'cat'),
(4, 'd', 'cat'),
(5, 'e', 'cat'),
(6, 'e', 'cat'),
(88, 'qq', 'cat'),
(99, 'aaaaaaaaaa', 'cattttttttttt'),
(98764, 'qqq', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `items_lists`
--

CREATE TABLE IF NOT EXISTS `items_lists` (
  `list_id` int(11) NOT NULL,
  `item_upc` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items_recipes`
--

CREATE TABLE IF NOT EXISTS `items_recipes` (
  `recipe_id` int(10) unsigned NOT NULL,
  `item_upc` bigint(20) unsigned NOT NULL,
  `item_qty` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` char(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `retailers`
--

CREATE TABLE IF NOT EXISTS `retailers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `retailer_id` int(10) unsigned NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trips_items`
--

CREATE TABLE IF NOT EXISTS `trips_items` (
  `trip_id` int(10) unsigned NOT NULL,
  `item_upc` bigint(20) unsigned NOT NULL,
  `item_qty` int(10) unsigned NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `storage_location` varchar(25) NOT NULL,
  `exp_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
