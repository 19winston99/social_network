-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 06, 2023 alle 21:56
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `window_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Si hai ragione è stata grandiosa', '2023-04-06 15:14:50', '2023-04-06 15:14:50'),
(2, 1, 2, 'E\' fantastico :)', '2023-04-06 15:15:46', '2023-04-06 15:15:46'),
(3, 3, 3, 'Ti amo', '2023-04-06 15:20:22', '2023-04-06 15:20:22'),
(4, 1, 3, 'Siiii', '2023-04-06 15:20:35', '2023-04-06 15:20:35'),
(5, 3, 4, 'Che bella coppia', '2023-04-06 15:25:42', '2023-04-06 15:25:42'),
(6, 4, 4, 'WOW', '2023-04-06 15:25:48', '2023-04-06 15:25:48'),
(7, 8, 5, 'Porto i pop corn :)', '2023-04-06 15:28:39', '2023-04-06 15:28:39'),
(8, 9, 6, 'Che figoo', '2023-04-06 15:33:00', '2023-04-06 15:33:00'),
(9, 7, 6, 'Beatiful', '2023-04-06 15:34:00', '2023-04-06 15:34:00'),
(10, 1, 6, 'Stupendo', '2023-04-06 15:34:19', '2023-04-06 15:34:19');

-- --------------------------------------------------------

--
-- Struttura della tabella `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2023-04-06 15:14:19', '2023-04-06 15:14:19'),
(2, 2, 1, '2023-04-06 15:14:21', '2023-04-06 15:14:21'),
(3, 3, 4, '2023-04-06 15:20:12', '2023-04-06 15:20:12'),
(4, 3, 3, '2023-04-06 15:20:16', '2023-04-06 15:20:16'),
(5, 3, 2, '2023-04-06 15:20:17', '2023-04-06 15:20:17'),
(6, 4, 1, '2023-04-06 15:25:53', '2023-04-06 15:25:53'),
(7, 4, 2, '2023-04-06 15:25:57', '2023-04-06 15:25:57'),
(8, 4, 3, '2023-04-06 15:25:57', '2023-04-06 15:25:57'),
(9, 4, 4, '2023-04-06 15:25:59', '2023-04-06 15:25:59'),
(10, 5, 7, '2023-04-06 15:28:41', '2023-04-06 15:28:41'),
(11, 6, 9, '2023-04-06 15:33:01', '2023-04-06 15:33:01'),
(12, 1, 11, '2023-04-06 15:36:50', '2023-04-06 15:36:50'),
(13, 1, 10, '2023-04-06 15:36:50', '2023-04-06 15:36:50'),
(14, 1, 9, '2023-04-06 15:36:54', '2023-04-06 15:36:54'),
(15, 1, 7, '2023-04-06 15:36:56', '2023-04-06 15:36:56'),
(16, 1, 5, '2023-04-06 15:36:58', '2023-04-06 15:36:58'),
(17, 1, 3, '2023-04-06 15:37:03', '2023-04-06 15:37:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_29_184920_create_posts_table', 1),
(6, '2023_03_31_163901_create_likes_table', 1),
(7, '2023_04_02_173313_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default-image.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fantastico paesaggio', 'WOW', '642efccb7a348.jpg', '2023-04-06 15:09:31', '2023-04-06 15:09:31'),
(2, 1, 'Partita mozzafiato', '1-0 grande vittoria!!', '642efd6d61268.jpg', '2023-04-06 15:12:13', '2023-04-06 15:12:13'),
(3, 2, 'I love you', 'Memories...', '642efe7784078.jpg', '2023-04-06 15:16:39', '2023-04-06 15:16:39'),
(4, 2, 'Dovete assolutamente venirci', 'Trentino Alto Adige', '642efee5476df.jpg', '2023-04-06 15:18:29', '2023-04-06 15:18:29'),
(5, 3, 'NO PAIN NO GAIN', '*STRONG*', '642eff92a6fb1.jpg', '2023-04-06 15:21:22', '2023-04-06 15:21:22'),
(6, 3, 'Amazing', 'no description for this...', '642effc706ad3.jpg', '2023-04-06 15:22:15', '2023-04-06 15:22:15'),
(7, 4, 'Family', 'I love my family', '642f008432868.jpg', '2023-04-06 15:25:24', '2023-04-06 15:25:24'),
(8, 4, 'Barcellona vs Real Madrid', 'Questo Sabato!!', '642f00dd30ffa.jpg', '2023-04-06 15:26:53', '2023-04-06 15:26:53'),
(9, 5, '-20kg', 'Nuova ricomposizione corporea', '642f01f9e8228.jpg', '2023-04-06 15:31:37', '2023-04-06 15:31:37'),
(10, 6, 'ME & YOU', 'ONE LOVE', '642f027334e37.jpg', '2023-04-06 15:33:39', '2023-04-06 15:33:39'),
(11, 7, 'Memories..', 'Love love love', '642f03081e455.jpg', '2023-04-06 15:36:08', '2023-04-06 15:36:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'default-profile-img.jpg',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `email_verified_at`, `password`, `profile`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Roberto', 'Hasa', 'admin@gmail.com', NULL, '$2y$10$yRD36vGci/OMnqwhoofkXOA8/KhmC/8Ux2mKwu3T3Rm7HJOHEecgO', '642efc3a96346.jpg', NULL, '2023-04-06 15:07:06', '2023-04-06 15:07:06'),
(2, 'Sara', 'Greene', 'greene@gmail.com', NULL, '$2y$10$AwWwdGiXk5wEDQ56zDWfjePcgFwbbTlojezggGjDFcMgebyyN7XVO', '642efdd871c4b.jpg', NULL, '2023-04-06 15:14:00', '2023-04-06 15:14:00'),
(3, 'Will', 'Smith', 'mescal@gmail.com', NULL, '$2y$10$CGF2suk1oqK/ks/R35GjhuKYMQ9uVEwcSu37XUZpsO7olOg9.graa', '642eff2355886.jpg', NULL, '2023-04-06 15:19:31', '2023-04-06 15:20:00'),
(4, 'Katy', 'Perry', 'perry@gmail.com', NULL, '$2y$10$tD7uYGDzpnUcP9E9d6fZFe2b6U5GVOEFzG5G.Y/aAU7UfMaoRPI3a', '642efffced043.jpg', NULL, '2023-04-06 15:23:09', '2023-04-06 15:23:09'),
(5, 'Salvatore', 'Aranzulla', 'theory@gmail.com', NULL, '$2y$10$cTWnJAo0XUQlDhR.qhitbOb7myRqy7CIvZezo2sQs3vudQGZr15hK', '642f01380efb7.jpg', NULL, '2023-04-06 15:28:24', '2023-04-06 15:29:18'),
(6, 'Ashley', 'Graham', 'graham@gmail.com', NULL, '$2y$10$zaxX12pJQujyWfFnqcz0BOqy29BMB1de7aNv6euKUqSDvZcmPcjOC', '642f02432a822.jpg', NULL, '2023-04-06 15:32:51', '2023-04-06 15:32:51'),
(7, 'Abdul', 'Karim', 'karim@gmail.com', NULL, '$2y$10$U6IkdnGpgn5tiertUusyOeUvu1UEpbH4Ftg/rgGVGKvPj4FhpWuzK', '642f02ddb07f7.jpg', NULL, '2023-04-06 15:35:25', '2023-04-06 15:35:25');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indici per le tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indici per le tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
