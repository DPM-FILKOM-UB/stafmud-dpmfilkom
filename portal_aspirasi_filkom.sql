-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Nov 2026 pada 05.49
-- Versi server: 11.8.6-MariaDB-5ubuntu0.1 from Ubuntu
-- Versi PHP: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `portal_aspirasi_filkom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin_user`
--

INSERT INTO `admin_user` (`id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Aldo Natanael Sihaloho', 'masaldoaje@admin.dpm', '$2y$12$xUHRdGNnyn3seYeffzwW1.d0hND9u2rD/tJcQMJqMdCDbcst9/sMC', '2026-11-19 22:00:56', '2026-11-19 22:00:56'),
(2, 'El Basa', 'elbasa@admin.dpm', '$2y$12$MgWVsmY9bruuDS/qPk6S4eKR0Oh9ROxSHTdb9Wb/2I.1WlQ.18YzC', '2026-11-19 22:00:56', '2026-11-19 22:00:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasi_db`
--

CREATE TABLE `aspirasi_db` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `jenis_aspirasi` varchar(255) NOT NULL,
  `aspirasi` text NOT NULL,
  `waktu_kejadian` date NOT NULL,
  `bukti_files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`bukti_files`)),
  `submitted_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aspirasi_db`
--

INSERT INTO `aspirasi_db` (`id`, `nama`, `prodi`, `kontak`, `jenis_aspirasi`, `aspirasi`, `waktu_kejadian`, `bukti_files`, `submitted_at`, `created_at`, `updated_at`) VALUES
(2, 'Anonim', 'Teknik Informatika', '08124823094', 'eerwer', 'wwwwwwwwwwwwwwwwwwwwwwwww', '2026-11-01', '[]', '2026-11-20', '2026-11-19 22:03:04', '2026-11-19 22:03:04'),
(3, 'Halo', 'Teknik Informatika', '08124823094', 'eerwer', 'wwwwwwwwwwwwwwww', '2026-11-02', '[]', '2026-11-20', '2026-11-19 22:40:10', '2026-11-19 22:40:10');

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
(1, '2026_11_19_034508_aspirasi_db', 1),
(2, '2026_11_20_025504_admin_user', 1);

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_user_email_unique` (`email`);

--
-- Indeks untuk tabel `aspirasi_db`
--
ALTER TABLE `aspirasi_db`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `aspirasi_db`
--
ALTER TABLE `aspirasi_db`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
