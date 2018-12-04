-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 04 2018 г., 09:33
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `***REMOVED***`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pointsToLevelup`
--

CREATE TABLE IF NOT EXISTS `pointsToLevelup` (
  `level_` int(11) NOT NULL AUTO_INCREMENT,
  `skills_points` int(11) NOT NULL,
  `currentLevel` int(11) NOT NULL,
  PRIMARY KEY (`level_`),
  UNIQUE KEY `level_` (`level_`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `pointsToLevelup`
--

INSERT INTO `pointsToLevelup` (`level_`, `skills_points`, `currentLevel`) VALUES
(1, 100, 100),
(2, 300, 200),
(3, 600, 300),
(4, 1000, 400),
(5, 1500, 500),
(6, 2100, 600),
(7, 2800, 700),
(8, 3600, 800),
(9, 4500, 900),
(10, 5500, 1000),
(11, 6600, 1100),
(12, 7800, 1200),
(13, 9100, 1300),
(14, 10500, 1400);

-- --------------------------------------------------------

--
-- Структура таблицы `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id_` int(11) DEFAULT NULL,
  `name` tinytext,
  `sublevel` int(11) DEFAULT NULL,
  `index_` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index_`),
  UNIQUE KEY `index_` (`index_`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `skills`
--

INSERT INTO `skills` (`id_`, `name`, `sublevel`, `index_`) VALUES
(1, 'Инженер', 0, 1),
(2, 'Дизайнер', 0, 2),
(3, 'Программист', 0, 3),
(11, 'Механика', 1, 4),
(12, 'Электроника', 1, 5),
(13, 'Схемотехника', 1, 6),
(14, 'Микроконтроллеры', 1, 7),
(15, 'БПЛА', 1, 8),
(16, 'Авиамоделирование', 1, 9),
(21, 'Двухмерная графика', 1, 10),
(211, 'Векторное рисование', 2, 11),
(212, 'Черчение и проектирование', 2, 12),
(213, 'Растровое рисование', 2, 13),
(214, 'Текстурирование', 2, 14),
(22, 'Трёхмерная графика', 1, 15),
(221, 'Полигональное моделирование', 2, 16),
(222, 'Геометрическое моделирование', 2, 17),
(223, '3D-сканирование', 2, 18),
(224, 'Фотограмметрия', 2, 19),
(225, 'Скульптинг', 2, 20),
(31, 'Фронтенд', 1, 21),
(32, 'Бэкенд', 1, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `fathername` tinytext,
  `surname` tinytext,
  `birthday` date DEFAULT NULL,
  `phone` tinytext,
  `email` tinytext,
  `city` tinytext,
  `province` tinytext,
  `occupation` tinytext,
  UNIQUE KEY `id_` (`id_`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='kek' AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_`, `name`, `fathername`, `surname`, `birthday`, `phone`, `email`, `city`, `province`, `occupation`) VALUES
(1, 'Альфа', 'Тестотчество', 'Юзер', '1990-01-05', NULL, NULL, 'Самара', 'Самарская область', 'Искатель приключений'),
(2, 'Бета', NULL, 'Юзер', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `userSkills`
--

CREATE TABLE IF NOT EXISTS `userSkills` (
  `id_` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `id_` (`id_`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `userSkills`
--

INSERT INTO `userSkills` (`id_`, `user_id`, `skill_id`, `level`, `points`) VALUES
(1, 1, 1, 3, 732),
(2, 1, 2, 3, 808),
(3, 1, 3, 5, 1723),
(4, 1, 11, 2, 411),
(5, 1, 12, 2, 321),
(6, 1, 13, 0, 0),
(7, 1, 14, 0, 0),
(8, 1, 15, 0, 0),
(9, 1, 16, 0, 0),
(10, 1, 21, 2, 351),
(11, 1, 211, 2, 325),
(12, 1, 212, 0, 0),
(13, 1, 213, 0, 0),
(14, 1, 214, 1, 114),
(15, 1, 22, 0, 0),
(16, 1, 221, 0, 0),
(17, 1, 222, 0, 0),
(18, 1, 223, 0, 18),
(19, 1, 224, 0, 0),
(20, 1, 225, 0, 0),
(32, 1, 31, 4, 1111),
(33, 1, 32, 3, 612),
(35, 2, 1, 0, 0),
(36, 2, 2, 3, 666),
(37, 2, 3, 0, 0),
(38, 2, 11, 0, 0),
(39, 2, 12, 0, 0),
(40, 2, 13, 0, 0),
(41, 2, 14, 0, 0),
(42, 2, 15, 0, 0),
(43, 2, 16, 0, 0),
(44, 2, 21, 0, 0),
(45, 2, 211, 0, 0),
(46, 2, 212, 0, 0),
(47, 2, 213, 0, 0),
(48, 2, 214, 3, 655),
(49, 2, 22, 0, 0),
(50, 2, 221, 0, 0),
(51, 2, 222, 0, 0),
(52, 2, 223, 0, 0),
(53, 2, 224, 0, 11),
(54, 2, 225, 0, 0),
(55, 2, 31, 0, 0),
(56, 2, 32, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
