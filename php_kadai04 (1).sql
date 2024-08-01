-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-08-01 12:51:26
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `php_kadai04`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `php_kadai04`
--

CREATE TABLE `php_kadai04` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `postdate` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `php_kadai04`
--

INSERT INTO `php_kadai04` (`id`, `username`, `comment`, `postdate`, `image_path`) VALUES
(1, 'onotoshi', 'test', '2024-06-27', NULL),
(2, '小野 利隆', 'wwwwwwwwwwwwwwwwww', '2024-06-27', NULL),
(3, '小野 利隆', 'wwwwwwwwwwwwwwwwww', '2024-06-27', NULL),
(4, '小野 利隆', 'wwwwwwwwwwwwwwwwww', '2024-06-27', NULL),
(5, '奏', 'aaaaaaaaaaa', '2024-06-27', NULL),
(6, '元詩', 'zzzzzzzzzzz', '2024-06-28', NULL),
(7, '珠利那', 'jjjjjjjjjjjjjjj', '2024-06-27', NULL),
(8, '利隆', 'おおおおおおおおおおおおおおおおおおお', '2024-06-28', NULL),
(9, '利隆', 'おおおおおおおおおおおおおおおおおおお', '2024-06-28', NULL),
(10, 'テスト', '写真', '2024-06-28', NULL),
(11, 'テスト', 'ji', '2024-06-28', 'uploads/111605_0.jpg'),
(12, 'sh', 'sh', '2024-06-28', NULL),
(13, 'sh', 'sh', '2024-06-29', NULL),
(14, '小野 利隆', 'aaaaaaaaaaaaa', '2024-06-29', NULL),
(15, '小野 利隆', 'nnnnnnnnnnnnnnn', '2024-06-29', NULL),
(16, '小野 利隆', 'aaaaaaaaa', '2024-06-29', NULL),
(17, '小野 利隆', 'aaaaaaaaaaaaa', '2024-06-29', NULL),
(18, 'q', 'w', '2024-07-08', NULL),
(19, 'sh', 'sh', '2024-07-09', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'info@japan-imex.co.jp', '$2y$10$jRULqPXrvJQisIyRqwqHS./0fM2jr7v9f3jrG.JEu/./0txE8w4RG', '2024-07-11 11:21:50'),
(2, 'info@japan-imex.co.jp', '$2y$10$OxiB6ZbaXHuWySm4/PZBxeFGwhi03MutVDbvWi0rbWoi23a/dMEp6', '2024-08-01 09:48:16');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `php_kadai04`
--
ALTER TABLE `php_kadai04`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `php_kadai04`
--
ALTER TABLE `php_kadai04`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
