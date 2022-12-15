-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 13 2022 г., 17:14
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `text`, `date`, `user_id`, `image`) VALUES
(100, 'Привет', '2022-12-13 17:08:22', 9, ''),
(101, 'И тебе привет', '2022-12-13 17:10:50', 10, '9265394ad4597607d6d963d6162d17fcf4806f84.png'),
(104, 'Как у тебя дела?', '2022-12-13 17:12:59', 9, ''),
(105, 'Нормально, а у тебя как?', '2022-12-13 17:13:56', 10, ''),
(106, '1', '2022-12-13 17:14:00', 10, ''),
(107, '2', '2022-12-13 17:14:03', 10, ''),
(108, '3', '2022-12-13 17:14:05', 10, ''),
(109, '4', '2022-12-13 17:14:07', 10, ''),
(110, '5', '2022-12-13 17:14:08', 10, ''),
(111, '6', '2022-12-13 17:14:10', 10, ''),
(112, '7', '2022-12-13 17:14:11', 10, ''),
(113, '8', '2022-12-13 17:14:13', 10, ''),
(114, '9', '2022-12-13 17:14:14', 10, ''),
(115, '10', '2022-12-13 17:14:16', 10, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `created_at`) VALUES
(9, '1234', '1234@mail.com', '9c9f3b848b62fd4342b19afb2f8b11640218a5b2', 1, '2022-12-11 16:12:36'),
(10, '12345', '12345@mail.com', 'b27e2d33a4bcb2070210734adae508162cf2eaed', 1, '2022-12-13 17:12:49');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
