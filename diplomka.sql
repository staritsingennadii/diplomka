-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 04 2024 г., 19:35
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
-- База данных: `diplomka`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `vk` varchar(255) NOT NULL,
  `telegram` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`, `name`, `position`, `phone`, `address`, `status`, `photo`, `vk`, `telegram`, `instagram`) VALUES
(6, 'admin@gmail.com', '$2y$10$9HAuqjO8tUysDqs7dSN0xuhF8Nvq0ohmLB/F5i9P.lpFksMvPDX9C', 1, 'Admin', 'Администратор', '1 111 111 11 11', 'ул. Пушкина д. Колотушкина', 'Онлайн', '66856263c458c.png', 'superAdmin', 'superAdmin', 'superAdmin'),
(7, 'superJackie@gmail.com', '$2y$10$znR8tQMy2/zSWlmrBEg6bea6xEIz8wrhhD2jPjU6myWElV6QY5Ql.', 0, 'Jackie Chan', 'Актёр', '2 222 222 22 22', 'Пик Виктория, Гонконг', 'Отошел', '66867706f0f91.jpeg', 'superJackie', 'superJackie', 'superJackie');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
