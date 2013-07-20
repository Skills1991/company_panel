-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 20 2013 г., 11:26
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `parent_id`, `name`, `head_id`, `functions`, `result`) VALUES
(4, 3, '5555', 7, '5', '555'),
(6, 0, 'Отдел 1', 10, 'Функции отдела 1', 'Результат отдела 1'),
(7, 6, ' Департамент 12', 11, '', ''),
(8, 7, '123213', 12, '', '');

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
  `head_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Не директор1 - Директор2 - Генеральный директор, 3 - руководитель отдела',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `department_id`, `user_id`, `name`, `functions`, `result`, `head_type`) VALUES
(1, 0, 1, 'Генеральный директор', '111', '222', 2),
(2, 1, 0, 'Руководитель', '', '', 0),
(3, 2, 0, 'Руководитель', '', '', 0),
(4, 0, 1, 'Технический директор 2', 'Функции техн. директора', 'Результат техн. директора', 1),
(5, 0, 0, '123321213', '21321', '1321221', 1),
(6, 0, 0, 'Руководитель', '', '', 0),
(7, 0, 0, 'Руководитель', '', '', 0),
(8, 0, 1, '534543', '3453453', '34534435', 0),
(9, 0, 1, 'Руководитель', '', '', 0),
(10, 0, 0, 'Руководитель', '', '', 3),
(11, 0, 0, 'Руководитель', '', '', 3),
(12, 0, 0, 'Руководитель', '', '', 3),
(13, 0, 0, 'Руководитель', '', '', 3),
(14, 8, 1, 'ОР423 545345', '', '', 0);

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
(1, 'ozerich', 'admin', 'ozicoder@gmail.com', 'Виталий', 'Озерский', 'Сергеевич', '+375296704790', '2013-07-24 00:00:00', '2013-07-20 01:17:26');

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
