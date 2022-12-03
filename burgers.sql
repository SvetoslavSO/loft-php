-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 03 2022 г., 17:34
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
-- База данных: `burgers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comment` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `address`, `comment`, `email`, `user_id`, `date`) VALUES
(70, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(71, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(72, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(73, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(74, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(75, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(76, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(77, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(78, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(79, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(80, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(81, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(82, '1111/111/11/11/11', '11', '3456@asd', 12, '2022-12-01'),
(83, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(84, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(85, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(86, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(87, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(88, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(89, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(90, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(91, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(92, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(93, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(94, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(95, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(96, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(97, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(98, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(99, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(100, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(101, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03'),
(102, '222/22/22/22/22', '1234', '21@asd', 13, '2022-12-03');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(64) NOT NULL,
  `orders` int NOT NULL,
  `phone` varchar(18) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `orders`, `phone`, `name`) VALUES
(5, '1111@asd', 1, '', ''),
(11, '1234@asd', 17, '', ''),
(12, '3456@asd', 32, '+7 (222) 222 22 22', '11'),
(13, '21@asd', 20, '+7 (111) 111 11 11', '22');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
