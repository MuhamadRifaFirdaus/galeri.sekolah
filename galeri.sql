-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: galeri
--

-- --------------------------------------------------------

--
-- Table structure for table foto
--

CREATE TABLE foto (
  id int(11) NOT NULL,
  galery_id int(11) NOT NULL,
  file varchar(255) NOT NULL,
  judul varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table galery
--

CREATE TABLE galery (
  id int(11) NOT NULL,
  post_id int(11) NOT NULL,
  position int(11) NOT NULL,
  status int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table kategori
--

CREATE TABLE kategori (
  id int(11) NOT NULL,
  judul varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table kategori
--

INSERT INTO kategori (id, judul) VALUES
(7, 'sd'),
(10, 'Kenangan'),
(11, 'Partisipasi');

-- --------------------------------------------------------

--
-- Table structure for table petugas
--

CREATE TABLE petugas (
  id int(255) NOT NULL,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table petugas
--

INSERT INTO petugas (id, username, password, created_at) VALUES
(2, 'admin', 'admin123', '2024-04-20 12:25:40');

-- --------------------------------------------------------

--
-- Table structure for table posts
--

CREATE TABLE posts (
  id int(11) NOT NULL,
  judul varchar(255) NOT NULL,
  kategori_id int(11) NOT NULL,
  isi text NOT NULL,
  petugas_id int(11) NOT NULL,
  status varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table posts
--

INSERT INTO posts (id, judul, kategori_id, isi, petugas_id, status, created_at) VALUES
(1, 'gatau', 7, 'ee', 2, 'publish', '2024-04-23 05:44:36');

-- --------------------------------------------------------

--
-- Table structure for table profile
--

CREATE TABLE profile (
  id int(11) NOT NULL,
  judul varchar(255) NOT NULL,
  isi text NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table foto
--
ALTER TABLE foto
  ADD PRIMARY KEY (id),
  ADD KEY galery_id (galery_id);

--
-- Indexes for table galery
--
ALTER TABLE galery
  ADD PRIMARY KEY (id),
  ADD KEY post_id (post_id);

--
-- Indexes for table kategori
--
ALTER TABLE kategori
  ADD PRIMARY KEY (id);

--
-- Indexes for table petugas
--
ALTER TABLE petugas
  ADD PRIMARY KEY (id);

--
-- Indexes for table posts
--
ALTER TABLE posts
  ADD PRIMARY KEY (id),
  ADD KEY ketegori_id (kategori_id,petugas_id),
  ADD KEY petugas_id (petugas_id);

--
-- Indexes for table profile
--
ALTER TABLE profile
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table foto
--
ALTER TABLE foto
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table galery
--
ALTER TABLE galery
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table kategori
--
ALTER TABLE kategori
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table petugas
--
ALTER TABLE petugas
  MODIFY id int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table posts
--
ALTER TABLE posts
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table profile
--
ALTER TABLE profile
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;