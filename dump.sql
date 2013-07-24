-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 24 2013 г., 12:42
-- Версия сервера: 5.5.31
-- Версия PHP: 5.4.4-14+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `amg_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `color` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `functions` text,
  `result` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `parent_id`, `color`, `name`, `head_id`, `functions`, `result`) VALUES
(18, 0, 'e8e8e8', 'Департамент 1000 нефти', 20, '', ''),
(19, 0, 'fffdd1', '2', 21, '', ''),
(20, 0, 'aeedf0', '3', 22, '', ''),
(21, 0, 'b2aef0', '4', 23, '', ''),
(22, 0, 'f0aee3', '5', 24, '', ''),
(23, 0, 'aef0bb', '6', 25, '', ''),
(24, 0, 'aed5f0', '7', 26, '', ''),
(25, 0, 'd9f0ae', '8', 27, '', ''),
(26, 0, 'f0d9ae', '9', 28, '', ''),
(27, 0, 'f0aeae', '10', 29, '', ''),
(28, 0, 'dacfe6', '11', 30, '', ''),
(29, 18, 'e8e8e8', 'Подразделение 1', 32, 'Функции первого подразделения', 'Результат первого подразделения'),
(30, 29, 'e8e8e8', 'Подподразделение', 34, 'Подчиняется подразделению1', 'Полная подчиненность'),
(31, 18, 'e8e8e8', 'Подразделение 2', 38, 'Выполняет вторичные ф-ии', ''),
(32, 31, 'e8e8e8', 'Второе подподразделение', 41, '', '');

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
  `departments_head` text NOT NULL COMMENT 'Массив ID департаментов за которые отвечает директор',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `department_id`, `user_id`, `name`, `functions`, `result`, `head_type`, `departments_head`) VALUES
(1, 0, 1, 'Генеральный директор', '', '', 2, '[]'),
(7, 0, 0, 'Умный Вася', '', '', 1, '["19","21","26","27","28"]'),
(20, 0, 1, 'Руководитель', '', '', 3, '[]'),
(21, 0, 0, 'Руководитель', '', '', 3, '[]'),
(22, 0, 0, 'Руководитель', '', '', 3, '[]'),
(23, 0, 0, 'Руководитель', '', '', 3, '[]'),
(24, 0, 0, 'Руководитель', '', '', 3, '[]'),
(25, 0, 0, 'Руководитель', '', '', 3, '[]'),
(26, 0, 0, 'Руководитель', '', '', 3, '[]'),
(27, 0, 0, 'Руководитель', '', '', 3, '[]'),
(28, 0, 0, 'Руководитель', '', '', 3, '[]'),
(29, 0, 0, 'Руководитель', '', '', 3, '[]'),
(30, 0, 0, 'Руководитель', '', '', 3, '[]'),
(31, 0, 0, 'Петя тупой', '', '', 1, '["18","21","22","25"]'),
(32, 0, 0, 'Руководитель', '', '', 3, '[]'),
(33, 18, 2, 'Руководитель', '', '', 0, '[]'),
(34, 0, 0, 'Руководитель', '', '', 3, '[]'),
(35, 30, 2, 'Руководитель подподразделения', '', '', 0, '[]'),
(36, 30, 1, 'Сотрудник подподразделения', 'Помогать руководжителю', 'csdfsdfsd', 0, '[]'),
(38, 0, 0, 'Руководитель', '', '', 3, '[]'),
(39, 31, 1, 'Сотрудник подразделения 2', '', '', 0, '[]'),
(40, 31, 1, 'Второй сотрудник подразделения 2', '', '', 0, '[]'),
(41, 0, 0, 'Руководитель', '', '', 3, '[]'),
(42, 32, 2, 'Сотрудник второго подподразделения', '', 'rweyrweyrqw', 0, '[]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `surname`, `father_name`, `phone`, `register_date`, `last_visit`) VALUES
(1, 'ozerich', 'admin', 'ozicoder@gmail.com', 'Виталий', 'Озерский', 'Сергеевич', '+375296704790', '2013-07-24 00:00:00', '2013-07-23 10:11:27'),
(2, '123', '321', 'kir55@mail.ru', 'Григорий', 'Ушаков', '', '', '2013-07-22 22:14:20', NULL);

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
