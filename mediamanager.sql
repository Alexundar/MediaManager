-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 12 2020 г., 14:33
-- Версия сервера: 5.7.26
-- Версия PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mediamanager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `eventDateTime` datetime NOT NULL,
  `eventTitle` text NOT NULL,
  `eventDescr` text NOT NULL,
  `eventKeywords` text NOT NULL,
  PRIMARY KEY (`eventId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`eventId`, `eventDateTime`, `eventTitle`, `eventDescr`, `eventKeywords`) VALUES
(1, '2019-12-12 12:00:00', 'First Event!!!', 'Description of first event', 'fisrt, event'),
(2, '2020-01-12 12:00:00', 'Event 2', 'This is the second event', 'second, event'),
(3, '2020-01-20 12:00:00', 'The next event', 'Third event is the next', 'third, event, publication');

-- --------------------------------------------------------

--
-- Структура таблицы `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `publicationId` int(32) UNSIGNED NOT NULL AUTO_INCREMENT,
  `publicationTitle` text NOT NULL,
  `publisherId` int(32) UNSIGNED NOT NULL,
  `publicationDescr` text,
  `publicationDateTime` datetime NOT NULL,
  `publicationKeywords` text,
  `eventId` int(11) NOT NULL,
  `imgPath` varchar(100) NOT NULL,
  PRIMARY KEY (`publicationId`),
  KEY `publisherId` (`publisherId`),
  KEY `eventId` (`eventId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `publications`
--

INSERT INTO `publications` (`publicationId`, `publicationTitle`, `publisherId`, `publicationDescr`, `publicationDateTime`, `publicationKeywords`, `eventId`, `imgPath`) VALUES
(2, 'First publication', 2, 'Description of first publication', '2020-01-11 19:23:21', 'fisrt, event, publication', 1, 'img/f22102c8e5309afa29121795b664c915.jpg'),
(3, 'Publication for First Event', 3, 'Hello World', '2020-01-11 19:32:23', 'fisrt, event, publication', 1, 'img/225128930c9640b82f26a9053d91a3bb.jpg'),
(8, 'Publication about 3rd event', 3, '1234', '2020-01-12 13:06:01', '1234', 3, 'img/eebf3bb5958886a01b5dd403a5fa96a1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE IF NOT EXISTS `publishers` (
  `publisherId` int(32) NOT NULL AUTO_INCREMENT,
  `publisherName` varchar(60) DEFAULT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`publisherId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`publisherId`, `publisherName`, `username`, `password`) VALUES
(2, 'Sashka Lush', 'sasha', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'Vlad Petrov', 'Vladik228', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
