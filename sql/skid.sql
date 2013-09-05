-- phpMyAdmin SQL Dump
-- version 4.0.3deb1.precise~ppa.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 05 2013 г., 17:42
-- Версия сервера: 5.5.31-0ubuntu0.12.04.2
-- Версия PHP: 5.3.10-1ubuntu3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `skid`
--
CREATE DATABASE IF NOT EXISTS `skid` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `skid`;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `category_city`
--

CREATE TABLE IF NOT EXISTS `category_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(11) unsigned NOT NULL,
  `id_city` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_category` (`id_category`,`id_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `priсe` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duration_discounts` int(11) NOT NULL DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=456457 ;

--
-- Дамп данных таблицы `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount`, `priсe`, `description`, `date_create`, `duration_discounts`) VALUES
(2, '123123', '123123', 123123, '123123123123', '2013-09-05 10:54:56', 30),
(3, '456456', '456546', 45654, '456456456456', '2013-09-05 10:54:56', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `discounts_city`
--

CREATE TABLE IF NOT EXISTS `discounts_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_discounts` int(11) unsigned NOT NULL,
  `id_city` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_discounts` (`id_discounts`,`id_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
