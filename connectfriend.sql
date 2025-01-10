-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2025 pada 17.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `avatars`
--

CREATE TABLE `avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(1, '2D Avatar', 50, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94web%20page%20ui%20default%20avatar_3801746.png?alt=media&token=5110a0bd-4fbe-405f-9a0f-c6b40edc3031', '2025-01-10 06:24:19', '2025-01-10 06:24:19'),
(2, '3D Avatar', 500, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/aazjeprd6.png?alt=media&token=e0359fe9-0228-462d-9e5a-8de939f82cf0', '2025-01-10 06:24:19', '2025-01-10 06:24:19'),
(3, 'Anime 4K Avatar', 100000, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/exp.jpg?alt=media&token=2cc5baef-dc95-4702-aba1-3398c1405839', '2025-01-10 06:24:19', '2025-01-10 06:24:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 5, 1, 'accepted', '2025-01-10 09:29:59', '2025-01-10 09:30:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_01_09_132002_create_avatars_table', 1),
(3, '2025_01_10_085634_create_friends_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('22TrxipmstHHzxdgKErJMR3IXWbgY1WpXsWjRp1D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVZvQmkySGs2SUltWUtkeEJOcVdXWFVlNDRLTnh1cWswc2d6cXVWayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1736524264),
('Pt6R8iofOl40DOTj5J3KWQAJlM1U916yJhSi0HEh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiekc1SnJwUGtNcGpUMlNLNWZpY0FFMmNQemVicEM2TERLc0E3ZXhoeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idXlhdmF0YXIiO31zOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1736526836);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `hobbies` text NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `wallet_balance` int(11) NOT NULL DEFAULT 0,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94default%20avatar_5408430.png?alt=media&token=580f3ac1-4a50-4327-89c4-bc7667d841de',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `hobbies`, `instagram`, `mobile`, `age`, `email`, `password`, `price`, `wallet_balance`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ken', 'Male', 'Berenang, Badminton, Makan', 'https://www.instagram.com/ken', '081234567890', 20, 'ken@gmail.com', '$2y$12$FptO7EQ8JUoFa8bX8n2DbOsDQeW6c818kZG5tjD163.HqcoqnM4hy', 123899, 575751, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/exp.jpg?alt=media&token=2cc5baef-dc95-4702-aba1-3398c1405839', NULL, '2025-01-10 06:29:24', '2025-01-10 09:33:13'),
(2, 'Sarah', 'Female', 'Makan, Melukis, Menyanyi', 'https://www.instagram.com/sarah', '081234567890', 22, 'sarah@gmail.com', '$2y$12$JpZZUnxUFFo2n7S146P2gerXzvpM/UQ1zc/iqz6tp0B9qG6oGlXie', 122016, 7684, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/aazjeprd6.png?alt=media&token=e0359fe9-0228-462d-9e5a-8de939f82cf0', NULL, '2025-01-10 07:01:33', '2025-01-10 07:04:08'),
(3, 'Ben', 'Female', 'Basket, Makan, Berenang', 'https://www.instagram.com/ben', '081234567890', 22, 'ben@gmail.com', '$2y$12$1fsuVp4wriHV3hNuTli43.7/meiBkqO/851ubP4HY8DLZJzPo5p3W', 119297, 180803, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94default%20avatar_5408430.png?alt=media&token=580f3ac1-4a50-4327-89c4-bc7667d841de', NULL, '2025-01-10 07:16:32', '2025-01-10 07:16:32'),
(4, 'ikan', 'Female', 'Berenang, Makan, Minum', 'https://www.instagram.com/ikan', '081234567890', 22, 'ikan@gmail.com', '$2y$12$J1/si5hqjmNWFFaqcd49H.dYqQLQ5F7A1wtR67FSGqcmNJDGCzRoW', 118509, 300, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94web%20page%20ui%20default%20avatar_3801746.png?alt=media&token=5110a0bd-4fbe-405f-9a0f-c6b40edc3031', NULL, '2025-01-10 07:17:09', '2025-01-10 08:47:45'),
(5, 'Steve', 'Male', 'Berenang, Badminton, Minum', 'https://www.instagram.com/steve', '081234567890', 18, 'steve@gmail.com', '$2y$12$nFptc1PMDIOmRGf9oYgV/eLLwDkfHW9UeWhFFyPacSpXyAz5RmW6C', 119233, 867, 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94default%20avatar_5408430.png?alt=media&token=580f3ac1-4a50-4327-89c4-bc7667d841de', NULL, '2025-01-10 09:26:25', '2025-01-10 09:26:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_user_id_foreign` (`user_id`),
  ADD KEY `friends_friend_id_foreign` (`friend_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
