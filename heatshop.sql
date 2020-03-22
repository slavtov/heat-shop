-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2020 г., 03:40
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `heatshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `house` int(5) UNSIGNED NOT NULL,
  `apartment` int(5) UNSIGNED DEFAULT NULL,
  `zip` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `address`
--

INSERT INTO `address` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `country`, `region`, `city`, `street`, `house`, `apartment`, `zip`) VALUES
(1, 1, 'Admin', 'Admin', 'Admin', 'Russian Federation', 'Moscow', 'Moscow', 'Central Park', 1, 1, 10000),
(2, 1, 'Test', NULL, 'Test', 'Russian Federation', 'Test', 'Test', 'Test', 7, NULL, 700000);

-- --------------------------------------------------------

--
-- Структура таблицы `attr_group`
--

CREATE TABLE `attr_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attr_group`
--

INSERT INTO `attr_group` (`id`, `title`) VALUES
(1, 'Material'),
(2, 'Size'),
(3, 'Test');

-- --------------------------------------------------------

--
-- Структура таблицы `attr_product`
--

CREATE TABLE `attr_product` (
  `attr_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attr_product`
--

INSERT INTO `attr_product` (`attr_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 11),
(2, 5),
(2, 7),
(5, 3),
(5, 4),
(5, 7),
(8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `attr_value`
--

CREATE TABLE `attr_value` (
  `id` int(11) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `attr_group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attr_value`
--

INSERT INTO `attr_value` (`id`, `value`, `attr_group_id`) VALUES
(1, 'Cotton', 1),
(2, 'Leather', 1),
(3, 'Rubber', 1),
(4, 'Plastic', 1),
(5, 'Thick', 2),
(6, 'Thin', 2),
(7, 'Test', 3),
(8, 'Test', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT 0,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `description`, `alias`, `parent_id`, `img`) VALUES
(1, 'Clothes', 'Clothes description', 'clothes', 0, 'category.png'),
(2, 'Accessories', 'Accessories etc', 'accessories', 0, NULL),
(3, 'Men', 'Men\'s clothing', 'men', 1, NULL),
(4, 'T-Shirts', 'Men\'s t-shirts', 'men-t-shirts', 3, NULL),
(5, 'T-Shirts', 'Women\'s t-shirts', 'women-t-shirts', 8, NULL),
(6, 'Coats & Jackets', NULL, 'coats-jackets', 8, NULL),
(7, 'Hoodies & Sweatshirts', NULL, 'hoodies-sweatshirts', 3, NULL),
(8, 'Women', 'Women\'s clothing', 'women', 1, NULL),
(9, 'Dresses', 'Women dresses', 'dresses', 8, NULL),
(10, 'Watches', NULL, 'watches', 2, NULL),
(11, 'Backpacks', NULL, 'backpacks', 2, NULL),
(12, 'Sunglasses', NULL, 'sunglasses', 2, NULL),
(13, 'Test', 'Test description', 'test1', 2, NULL),
(14, 'Test', 'Test description', 'test2', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `email`, `question`) VALUES
(1, 'test@test.test', 'Test question 1'),
(2, 'test@test.test', 'Test question 2'),
(3, 'test@test.test', 'Test question 3');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `value` float(15,2) NOT NULL,
  `base` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `code`, `symbol`, `value`, `base`) VALUES
(1, 'Ruble', 'RUB', '₽', 65.00, '0'),
(2, 'Dollar', 'USD', '$', 1.00, '1'),
(3, 'Euro', 'EUR', '€', 0.90, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `product_id`, `img`) VALUES
(1, 1, 't-shirt-purple.png'),
(2, 1, 't-shirt-red.png'),
(3, 1, 't-shirt-gray.png'),
(4, 1, 't-shirt-black.png'),
(5, 1, 't-shirt-blue.png'),
(6, 1, 't-shirt-yellow.png'),
(7, 2, 'watch-1.png'),
(8, 2, 'watch-2.png'),
(9, 2, 'watch-3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_color`
--

CREATE TABLE `mod_color` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_color`
--

INSERT INTO `mod_color` (`id`, `product_id`, `title`, `price`) VALUES
(1, 1, 'purple', NULL),
(2, 1, 'red', 50),
(3, 1, 'gray', 100),
(4, 1, 'black', 150),
(5, 1, 'blue', 100),
(6, 1, 'yellow', 50),
(7, 2, 'silver', 200),
(8, 2, 'black', 100),
(9, 2, 'white', 0),
(10, 3, 'gray', 0),
(11, 3, 'yellow', 50),
(12, 3, 'red', 80);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_size`
--

CREATE TABLE `mod_size` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_size`
--

INSERT INTO `mod_size` (`id`, `product_id`, `title`) VALUES
(1, 1, 'xs'),
(2, 1, 's'),
(3, 1, 'm'),
(4, 1, 'l'),
(5, 1, 'xl'),
(6, 1, 'xxl'),
(7, 2, '14'),
(8, 2, '18'),
(9, 2, '19'),
(10, 2, '20'),
(11, 4, '9'),
(12, 4, '9.5'),
(13, 4, '10'),
(14, 5, 'm');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `email`, `status`, `date`, `update_at`, `currency`, `address`, `note`) VALUES
(1, 1, NULL, '0', '2020-03-21 02:20:36', NULL, 'USD', 'a:12:{s:2:\"id\";s:1:\"1\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:5:\"Admin\";s:11:\"middle_name\";s:5:\"Admin\";s:9:\"last_name\";s:5:\"Admin\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:6:\"Moscow\";s:4:\"city\";s:6:\"Moscow\";s:6:\"street\";s:12:\"Central Park\";s:5:\"house\";s:1:\"1\";s:9:\"apartment\";s:1:\"1\";s:3:\"zip\";s:5:\"10000\";}', 'Test'),
(2, 1, NULL, '1', '2020-03-21 02:28:56', '2020-03-21 02:29:14', 'USD', 'a:12:{s:2:\"id\";s:1:\"1\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:5:\"Admin\";s:11:\"middle_name\";s:5:\"Admin\";s:9:\"last_name\";s:5:\"Admin\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:6:\"Moscow\";s:4:\"city\";s:6:\"Moscow\";s:6:\"street\";s:12:\"Central Park\";s:5:\"house\";s:1:\"1\";s:9:\"apartment\";s:1:\"1\";s:3:\"zip\";s:5:\"10000\";}', NULL),
(3, 1, NULL, '0', '2020-03-21 02:35:08', NULL, 'USD', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', NULL),
(4, 1, NULL, '0', '2020-03-21 02:35:52', NULL, 'EUR', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', 'Test note'),
(5, 1, NULL, '0', '2020-03-21 17:51:51', NULL, 'EUR', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', NULL),
(6, 1, NULL, '0', '2020-03-21 18:06:56', NULL, 'RUB', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', NULL),
(7, 1, NULL, '0', '2020-03-21 18:08:13', NULL, 'RUB', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', NULL),
(8, 1, NULL, '0', '2020-03-21 18:09:59', NULL, 'EUR', 'a:12:{s:2:\"id\";s:1:\"1\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:5:\"Admin\";s:11:\"middle_name\";s:5:\"Admin\";s:9:\"last_name\";s:5:\"Admin\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:6:\"Moscow\";s:4:\"city\";s:6:\"Moscow\";s:6:\"street\";s:12:\"Central Park\";s:5:\"house\";s:1:\"1\";s:9:\"apartment\";s:1:\"1\";s:3:\"zip\";s:5:\"10000\";}', NULL),
(9, 1, NULL, '0', '2020-03-21 21:41:48', NULL, 'USD', 'a:12:{s:2:\"id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";N;s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"7\";s:9:\"apartment\";N;s:3:\"zip\";s:6:\"700000\";}', NULL),
(10, 1, 'noreg@test.test', '0', '2020-03-21 21:57:01', NULL, 'USD', 'a:10:{s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";s:4:\"Test\";s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"1\";s:9:\"apartment\";N;s:3:\"zip\";s:5:\"10000\";}', 'Test'),
(11, 1, 'test@test.test', '1', '2020-03-22 00:04:24', '2020-03-22 00:05:19', 'USD', 'a:10:{s:10:\"first_name\";s:4:\"Test\";s:11:\"middle_name\";s:4:\"Test\";s:9:\"last_name\";s:4:\"Test\";s:7:\"country\";s:18:\"Russian Federation\";s:6:\"region\";s:4:\"Test\";s:4:\"city\";s:4:\"Test\";s:6:\"street\";s:4:\"Test\";s:5:\"house\";s:1:\"1\";s:9:\"apartment\";s:1:\"1\";s:3:\"zip\";s:5:\"10000\";}', 'Test');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `qty` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `size`, `qty`, `title`, `price`) VALUES
(1, 1, 1, 'xs', 1, 'Test item 1 (purple)', 500),
(2, 1, 1, 's', 1, 'Test item 1 (purple)', 500),
(3, 1, 1, 's', 1, 'Test item 1 (red)', 550),
(4, 1, 1, 'm', 1, 'Test item 1 (gray)', 600),
(5, 1, 1, 'l', 1, 'Test item 1 (black)', 650),
(6, 1, 1, 'xl', 1, 'Test item 1 (blue)', 600),
(7, 1, 1, 'xxl', 1, 'Test item 1 (yellow)', 550),
(8, 1, 2, '19', 1, 'Test item 2 (silver)', 900),
(9, 2, 2, '19', 1, 'Test item 2 (silver)', 900),
(10, 3, 45, NULL, 7, 'Test item 7', 700),
(11, 4, 48, NULL, 1, 'Test item 10', 900),
(12, 5, 4, '9', 1, 'Test item 4', 450),
(13, 6, 3, '', 1, 'Test item 3 (gray)', 4550),
(14, 6, 4, '9', 1, 'Test item 4', 32500),
(15, 6, 1, 's', 1, 'Test item 1 (purple)', 32500),
(16, 7, 4, '9', 2, 'Test item 4', 32500),
(17, 7, 1, 's', 1, 'Test item 1 (purple)', 32500),
(18, 7, 3, '', 1, 'Test item 3 (gray)', 4550),
(19, 8, 1, 'm', 3, 'Test item 1 (purple)', 450),
(20, 8, 2, '19', 1, 'Test item 2 (black)', 720),
(21, 8, 45, '', 7, 'Test item 7', 630),
(22, 8, 48, '', 1, 'Test item 10', 900),
(23, 9, 3, '', 1, 'Test item 3 (yellow)', 120),
(24, 10, 1, 'm', 1, 'Test item 1 (purple)', 500),
(25, 11, 3, '', 1, 'Test item 3 (gray)', 70);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float UNSIGNED NOT NULL,
  `old_price` float UNSIGNED DEFAULT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `keywords` varchar(255) DEFAULT NULL,
  `info` text DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no-image.png',
  `hit` enum('on','off') NOT NULL DEFAULT 'on',
  `stock` enum('on','off') NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `alias`, `description`, `price`, `old_price`, `status`, `keywords`, `info`, `img`, `hit`, `stock`) VALUES
(1, 4, 'Test item 1', 'test-item-1', 'Test Item 1 description', 500, 800, 'on', 'item, test, 1', '<p><b>Test</b> information</p><img src=\"img/t-shirt-info.png\" class=\"mb-2 mw-100 round\" alt=\"\"><p><b>Test</b> information</p>', 't-shirt-purple.png', 'on', 'on'),
(2, 10, 'Test item 2', 'test-item-2', 'Test Item 1 description', 700, 990, 'on', NULL, 'Test information', 'watch-top.png', 'on', 'on'),
(3, 11, 'Test item 3', 'test-item-3', 'Test Item 1 description', 70, NULL, 'on', NULL, 'Test info', 'backpack.png', 'on', 'on'),
(4, 4, 'Test item 4', 'test-item-4', 'Test Item 1 description', 500, 800, 'on', NULL, NULL, 'no-image.png', 'on', 'on'),
(5, 1, 'Test item 5', 'test-item-5', 'Test Item 1 description', 500, 1000, 'on', NULL, 'Test', 'no-image.png', 'on', 'off'),
(6, 1, 'Test item 6', 'test-item-6', 'Test Item 6 description', 400, NULL, 'on', NULL, 'Test', 'no-image.png', 'on', 'on'),
(7, 1, 'Test item 7', 'test-item-7', 'Test Item 7 description', 700, NULL, 'on', NULL, 'Test', 'no-image.png', 'on', 'on'),
(8, 14, 'Test item 8', 'test-item-8', 'Test Item 8 description', 800, NULL, 'off', NULL, 'Test', 'no-image.png', 'on', 'on'),
(9, 14, 'Test item 9', 'test-item-9', 'Test Item 9 description', 900, NULL, 'on', NULL, 'Test', 'no-image.png', 'off', 'off'),
(10, 14, 'Test item 10', 'test-item-10', 'Test Item 10 description', 1000, NULL, 'on', NULL, 'Test', 'no-image.png', 'off', 'on'),
(11, 5, 'Test item 11', 'test-item-11', 'Test Item 11 description', 1100, NULL, 'on', NULL, 'Test', 'no-image.png', 'off', 'on');

-- --------------------------------------------------------

--
-- Структура таблицы `related_product`
--

CREATE TABLE `related_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `related_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `related_product`
--

INSERT INTO `related_product` (`product_id`, `related_id`) VALUES
(1, 2),
(1, 3),
(3, 1),
(2, 4),
(2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address_id` int(10) UNSIGNED DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `time_token` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `address_id`, `role`, `date`, `remember_token`, `time_token`) VALUES
(1, 'admin', 'admin@test.test', '$2y$10$/cXGg5KBXpCdpB3KHjvsRuk9k0WteJoaHdlOC6i8sslQcol17l/xK', 2, 'admin', '2020-03-04', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `attr_group`
--
ALTER TABLE `attr_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attr_product`
--
ALTER TABLE `attr_product`
  ADD KEY `attr_id` (`attr_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `attr_value`
--
ALTER TABLE `attr_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `mod_color`
--
ALTER TABLE `mod_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `mod_size`
--
ALTER TABLE `mod_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `attr_group`
--
ALTER TABLE `attr_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `attr_value`
--
ALTER TABLE `attr_value`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `mod_color`
--
ALTER TABLE `mod_color`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `mod_size`
--
ALTER TABLE `mod_size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attr_product`
--
ALTER TABLE `attr_product`
  ADD CONSTRAINT `attr_product_ibfk_1` FOREIGN KEY (`attr_id`) REFERENCES `attr_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attr_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mod_color`
--
ALTER TABLE `mod_color`
  ADD CONSTRAINT `mod_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mod_size`
--
ALTER TABLE `mod_size`
  ADD CONSTRAINT `mod_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
