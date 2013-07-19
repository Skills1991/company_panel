-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 19 2013 г., 22:43
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `amg`
--

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `functions` text,
  `result` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `parent_id`, `name`, `head_id`, `functions`, `result`) VALUES
(1, 0, 'Отдел 1', NULL, '', ''),
(2, 0, 'Отдел 1', NULL, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `functions` text NOT NULL,
  `result` text NOT NULL,
  `head_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Не директор\r\n1 - Директор\r\n2 - Генеральный директор',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `department_id`, `user_id`, `name`, `functions`, `result`, `head_type`) VALUES
(1, 0, 0, 'Генеральный директор', '', '', 2),
(2, 1, 0, 'Руководитель', '', '', 0),
(3, 2, 0, 'Руководитель', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `last_visit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `surname`, `father_name`, `phone`, `register_date`, `last_visit`) VALUES
(1, 'ozerich', 'admin', 'ozicoder@gmail.com', 'Виталий', 'Озерский', 'Сергеевич', '+375296704790', '2013-07-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_jobs`
--

CREATE TABLE IF NOT EXISTS `user_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
