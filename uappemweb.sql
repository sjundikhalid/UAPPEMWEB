-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 05:40 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uappemweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `idCourse` varchar(100) NOT NULL,
  `namaCourse` varchar(255) DEFAULT NULL,
  `deskSingkat` varchar(255) DEFAULT NULL,
  `emailMentor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`idCourse`, `namaCourse`, `deskSingkat`, `emailMentor`) VALUES
('PHP-1', 'PHP-Dasar', 'PHP Susah, harus rajin berlatih', 'mentor1@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `idMateri` varchar(100) NOT NULL,
  `namaMateri` varchar(255) DEFAULT NULL,
  `linkVideo` varchar(255) DEFAULT NULL,
  `idCourse` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`idMateri`, `namaMateri`, `linkVideo`, `idCourse`) VALUES
('PHP-1-1', 'Belajar PHP untuk PEMULA | 1. Intro', 'https://www.youtube.com/embed/l1W2OwV5rgY?si=3u96GfAZ8hC5JH0M', 'PHP-1');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `idTestimoni` int(10) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`idTestimoni`, `pesan`, `email`) VALUES
(1, 'Sangat seru belajar disini', 'pelajar1@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomorHP` varchar(100) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `nama`, `nomorHP`, `roles`, `passwords`) VALUES
('admin1@example.com', 'Admin 1', '081234567890', 'admin', '$2y$10$kulqm1oSvA3VE6fLD2eCEOWAV3VfCHjCWg4rKA1.Dgbz57LSQW5re'),
('admin2@example.com', 'Admin 2', '081234567891', 'admin', '$2y$10$IooWKk78VHDBdA4Ji847qeKKKb39WIhMiHQa4W5EwkKXXSPTMwy9S'),
('mentor1@example.com', 'Mentor 1', '081234567892', 'mentor', '$2y$10$M3U4Efwvszsmor8zK8s3j.lhN51QCTP9TbWBDwz4fVQ90fqsCY5dS'),
('mentor2@example.com', 'Mentor 2', '08912312312', 'mentor', '$2y$10$KTqsi5Z4C0z2e6MPRwFsnusspZDgLXYhiDXUZXwFn5AEa.7NOhFdq'),
('mentor3@example.com', 'Mentor 3', '081234567894', 'mentor', '$2y$10$7rNwnCT5rRlxf4.WVuwgVeluHd0NCCMA5Ls0Df0bjkhc6fQBAueuW'),
('pelajar1@example.com', 'Pelajar 1', '081234567895', 'pelajar', '$2y$10$mm1pbkEPFzglx6W7xvDdyObAhAfbH0m.C/k8K8CcTg77eGiZ81ERG'),
('pelajar2@example.com', 'Pelajar 2', '081234567896', 'pelajar', '$2y$10$hKzNVAUMB03Hf.4qHrLHSe2ogJYu2GPG9RJQb6oRdXk8M4S/1M06G'),
('pelajar3@example.com', 'Pelajar 3', '081234567897', 'pelajar', '$2y$10$laxlD2BqgEQzV9aZOm6UuOStBjKHiYya0VYxQcZnfx.CnXM/TX0Mi'),
('pelajar4@example.com', 'Pelajar 4', '081234567898', 'pelajar', '$2y$10$SDn7pChInmoSypsT9119X.lhrj0CsXG4HsPkAZ6fqCbzOmPVeEste'),
('pelajar5@example.com', 'Pelajar 5', '081234567899', 'pelajar', '$2y$10$gnIxyaFH5UC4dXfT0q82oeODJGAvAUvlV7sG.Tl/nEweYbEww/Vge');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`idCourse`),
  ADD KEY `emailMentor` (`emailMentor`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`idMateri`),
  ADD KEY `idCourse` (`idCourse`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`idTestimoni`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `idTestimoni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`emailMentor`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`idCourse`) REFERENCES `course` (`idCourse`) ON DELETE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
