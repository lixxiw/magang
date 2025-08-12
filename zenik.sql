-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 09:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zenik`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_db`
--

CREATE TABLE `login_db` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_db`
--

INSERT INTO `login_db` (`id`, `username`, `password`, `role`) VALUES
(10, 'dilon', '$2y$10$x2vpm6KYt6rg38CsExEN.epsWhkrA6QwiiihiZlphekgAzOE49HLS', 'admin'),
(12, 'firly', '$2y$10$nU/QN6A1Vv3Tt1QQlN2rEOiLhVA41Unux.shOdNmSmj8FNPz/2lmG', ''),
(13, 'king', '$2y$10$ILW.zQrBmSPUoM9TOFisSeq4XzpkWpjdrac1miWQrPLMd2QF7.Kkq', ''),
(14, 'arkan', '$2y$10$TLtjCtjf.ZEU70fs5NhxX.gWM1Fv0uGzNOH6WnmEyyPlEPFkxcQXy', ''),
(15, 'anjay', '$2y$10$YvjIkKmrLHHCVyTaXD6j/.HpqLSdKt/RcrD4/R.rL.SEtedWo1jcO', ''),
(16, 'valen', '$2y$10$9Oc2RRXvJx69rgg0X4R4HeN/W9v/cTA92g5UH/ItGXzTlvy1Ao/pi', '');

-- --------------------------------------------------------

--
-- Table structure for table `resi`
--

CREATE TABLE `resi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `catatan` text NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pesanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resi`
--

INSERT INTO `resi` (`id`, `nama`, `alamat`, `telepon`, `catatan`, `total`, `tanggal`, `pesanan`) VALUES
(1, 'kjnjvsf', 'dswaszc', 'sefef', 'aef', 30, '2025-08-11 15:30:53', '- baju batik (Rp 10)\r\n- baju batik (Rp 10)\r\n- baju batik (Rp 10)'),
(2, 'dilon', 'jln ', '0988778', ';klnakjzb', 0, '2025-08-11 15:58:59', ''),
(3, 'dilon', 'acdzxscx', '09879', ' xzmc asmc nz', 4, '2025-08-11 16:36:39', '- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)'),
(4, 'dilon', 'jln', 'p0988y7', 'nothing', 16, '2025-08-12 02:13:35', '- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- baju batik (Rp 10)'),
(5, 'dilon', 'ojn', '0987', 'nk', 4, '2025-08-12 03:13:20', '- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)\r\n- da (Rp 1)'),
(6, 'dilon', 'jln rungkut', '0988767', 'jahitan nya yg rapih', 2, '2025-08-12 06:09:26', '- da (Rp 1)\r\n- da (Rp 1)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'dilon', '$2y$10$SJRSrM.67sYs5xzEyl4Yy.hgriCDj5ukDcVZ6ig9WYq7zph.y7AJa', 'admin'),
(2, 'dilon', '$2y$10$rb9NxctVCyjcZDtT/czS3ORq8mAipZJVMuTmCz0BADOkA0OO6ZwxG', 'admin'),
(3, 'dilon', '$2y$10$rY0D37M62DtXW.ZSX0hj1.BDBzdqFrqcttJiu0QZcJJzemqFTOaCm', 'admin'),
(4, 'anjay', '$2y$10$b73yTEo4Q.FY1LuS811vN.AO.IrPYtC.Wf.mSyTLVVeJbATrP2oVW', 'user'),
(5, 'anjay', '$2y$10$EvH6.C1Uonr4n3q7dQqWsee.a20hz1tnZ4b0YB56x8YY8SsTLF/Uu', 'user'),
(6, 'admin', '$2y$10$BqwAaIObAsD6YFvLriY79uW2IW7cJU8RFE7GBFF4HQjJnPafadime', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `zenik_taylor`
--

CREATE TABLE `zenik_taylor` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zenik_taylor`
--

INSERT INTO `zenik_taylor` (`id`, `nama`, `harga`, `gambar`) VALUES
(5, 'baju batik', 10, 'assets/Black Red Minimalist Fashion Product Introduction Landscape Banner.png'),
(7, 'vinel', 10, 'assets/galery4.jpg'),
(8, 'da', 1, 'assets/download.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_db`
--
ALTER TABLE `login_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zenik_taylor`
--
ALTER TABLE `zenik_taylor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_db`
--
ALTER TABLE `login_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zenik_taylor`
--
ALTER TABLE `zenik_taylor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
