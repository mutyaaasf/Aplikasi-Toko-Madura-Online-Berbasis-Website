-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 07:59 AM
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
-- Database: `db-settings`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `about` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `about`) VALUES
(1, 'Toko Madura Online adalah sebuah platform e-commerce yang menyediakan berbagai macam barang kebutuhan sehari-hari seperti makanan, minuman, rokok, dan bahan dapur secara online. Melalui platform ini, pengguna dapat dengan mudah menjelajahi dan membeli berbagai produk kebutuhan rumah tangga tanpa harus keluar rumah.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$MilDJm3l8BP.0xHChL/liOBpFEQcHaW3gejq.SuQYfs459KDgwhR.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(5, 'Rokok'),
(8, 'Makanan'),
(9, 'Minuman'),
(10, 'Bahan Mandi'),
(11, 'Bahan Dapur');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `value`) VALUES
(1, 'address', 'Jl. Ketintang No.156, Gayungan, Surabaya, Jawa Timur 60231'),
(2, 'phone', '+62812-3456-7890'),
(3, 'facebook', 'username'),
(4, 'twitter', 'username'),
(5, 'instagram', 'username'),
(6, 'email', 'admin@gammabookstore.com');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'How To Orders?', 'Login, Add your books to cart, check out then... Happy Shoping :)'),
(4, 'What if i dont have an account?', 'Just Register in the registration form :)');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `id` int(11) NOT NULL,
  `policy` varchar(25000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`id`, `policy`) VALUES
(1, 'Copyright 2011-2018 Twitter, Inc.\r\n\r\nPermission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the \"Software\"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:\r\n\r\nThe above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.\r\n\r\nTHE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `stock` double NOT NULL,
  `price` double NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` varchar(500) NOT NULL,
  `images` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `stock`, `price`, `description`, `category`, `images`) VALUES
(61, 'Rokok Kapten', 10, 12000, 'Rokoknya Para Kapten, 18++', 'Rokok', 'a:1:{i:0;s:45:\"uploads/07106b4289423891c87d39665ff251e8.jpeg\";}'),
(68, 'Royco Sapi', 13, 2000, 'Asli dari Sapi Madura , sudah SNI', 'Bahan Dapur', 'a:1:{i:0;s:44:\"uploads/1012093e1a94370c27d39fb385a3c929.jpg\";}'),
(69, 'Shampoo Punten', 23, 2000, 'puntennn shampo memanjangkan tali silahturahmi', 'Bahan Mandi', 'a:1:{i:0;s:44:\"uploads/29b78a138c7f83b8ec5aa836fc872857.jpg\";}'),
(70, 'Shampoo Shobat Ambyar', 13, 5000, 'aseloleee', 'Bahan Mandi', 'a:1:{i:0;s:44:\"uploads/0f1c04ccb3b45e2ff77b0a2d16250aff.jpg\";}'),
(71, 'Nabati Berbagi', 6, 3000, 'Makann cocok untuk berbagi sesama teman', 'Makanan', 'a:1:{i:0;s:44:\"uploads/61792ab079cc24be4ecb7de9bd4ad698.jpg\";}'),
(74, 'Mahalbro', 3, 12000, 'Rokok mahal', 'Rokok', 'a:1:{i:0;s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `position` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `position`, `phone`, `email`, `address`) VALUES
(2, 'Muhammad Zaini Rochman', 'Developers', '081357040615', 'rochman279@gmail.com', 'Jl. Jetis Kulon 1, No. 57, Surabaya'),
(4, 'Moch. Anang Ardiansyah', 'Pemilik Toko', '089514312154', 'anangaak87@gmail.com', 'Jl. Lingkar Timur No. 24, Sidoarjo'),
(5, 'Faniah Iftitakhul Kamilah', 'Tukang Kulakan', '081216189439', 'faniahfk@gmail.com', 'Jl. Ketintang 1 No. 63, Surabaya'),
(7, 'Mutyara Safitri', 'Ngancani Kulakan', '083149616276', 'mutyarasafitri99@gmail.com', 'Jl. Ketintang Baru No. 35, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`) VALUES
(3, 'PT. Kapten Jaya Abadi', '089191919191', 'ayomerokok@gmail.com', 'Jl. Manyar Kertoarjo 16, Surabaya'),
(4, 'PT. Lico Sabun', '086611662266', 'janganlupamandi@gmail.com', 'Jl. Aja Jadian Kaga, Surabaya'),
(5, 'PT. Mahalbro Rokok Mahal', '081234512345', 'janganminta@gmail.com', 'Jl. Sama Kamu, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `timestamp` datetime NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `email`, `details`, `timestamp`, `address`) VALUES
(59, 'Rosa Aliffiana', 'aliffianarosa@gmail.com', 'a:2:{i:63;a:7:{s:2:\"id\";s:2:\"63\";s:5:\"title\";s:13:\"Ranah 3 Warna\";s:5:\"price\";s:6:\"139000\";s:11:\"description\";s:18:\"Buku Ranah 3 Warna\";s:8:\"category\";s:5:\"Novel\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/fdab20064ef9f536b19fb301f1af2346.jpg\";}i:62;a:7:{s:2:\"id\";s:2:\"62\";s:5:\"title\";s:15:\"Negeri 5 Menara\";s:5:\"price\";s:6:\"129000\";s:11:\"description\";s:20:\"Buku Negeri 5 Menara\";s:8:\"category\";s:5:\"Novel\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/4763539fe3a0df4a02fd6fe0fc67cdf3.jpg\";}}', '2024-01-11 10:40:58', 'Jl. Air Terjun Alam Kandung'),
(60, 'santoso budi', 'budisantoso@gmail.com', 'a:2:{i:57;a:7:{s:2:\"id\";s:2:\"57\";s:5:\"title\";s:12:\"Sang Pemimpi\";s:5:\"price\";s:5:\"79000\";s:11:\"description\";s:17:\"Buku Sang Pemimpi\";s:8:\"category\";s:5:\"Fiksi\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/d56435626e9b753bb95ea4daa65b6586.jpg\";}i:58;a:7:{s:2:\"id\";s:2:\"58\";s:5:\"title\";s:12:\"Pulang-Pergi\";s:5:\"price\";s:6:\"109000\";s:11:\"description\";s:17:\"Buku Pulang-Pergi\";s:8:\"category\";s:5:\"Novel\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/d81128d909a76179677743ccbaa6609b.jpg\";}}', '2024-01-11 12:41:25', 'Jl. Kusuma Bangsa 100'),
(61, 'Rosa Aliffiana', 'aliffianarosa@gmail.com', 'a:3:{i:57;a:7:{s:2:\"id\";s:2:\"57\";s:5:\"title\";s:12:\"Sang Pemimpi\";s:5:\"price\";s:5:\"79000\";s:11:\"description\";s:17:\"Buku Sang Pemimpi\";s:8:\"category\";s:5:\"Fiksi\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/d56435626e9b753bb95ea4daa65b6586.jpg\";}i:62;a:7:{s:2:\"id\";s:2:\"62\";s:5:\"title\";s:15:\"Negeri 5 Menara\";s:5:\"price\";s:6:\"129000\";s:11:\"description\";s:20:\"Buku Negeri 5 Menara\";s:8:\"category\";s:5:\"Novel\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/4763539fe3a0df4a02fd6fe0fc67cdf3.jpg\";}i:63;a:7:{s:2:\"id\";s:2:\"63\";s:5:\"title\";s:13:\"Ranah 3 Warna\";s:5:\"price\";s:6:\"139000\";s:11:\"description\";s:18:\"Buku Ranah 3 Warna\";s:8:\"category\";s:5:\"Novel\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/fdab20064ef9f536b19fb301f1af2346.jpg\";}}', '2024-01-11 14:16:28', 'Jl. Air Terjun Alam Kandung 99'),
(62, 'Ar Anang', 'mochanangardiansyah@gmail.com', 'a:1:{i:61;a:7:{s:2:\"id\";s:2:\"61\";s:5:\"title\";s:6:\"KAPTEN\";s:5:\"price\";s:5:\"80000\";s:11:\"description\";s:12:\"Rokok KAPTEN\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/d5363b0008789ebc3a64b8ed13e5f46b.png\";}}', '2024-02-25 22:02:55', 'jl.kuy'),
(63, 'Ar Anang', 'mochanangardiansyah@gmail.com', 'a:2:{i:61;a:7:{s:2:\"id\";s:2:\"61\";s:5:\"title\";s:12:\"Rokok Kapten\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:26:\"Rokoknya Para Kapten, 18++\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/48ecd1962f4465854359a231ff39303c.jpg\";}i:72;a:7:{s:2:\"id\";s:2:\"72\";s:5:\"title\";s:19:\"Minuman Enakk Kawa\'\";s:5:\"price\";s:6:\"300000\";s:11:\"description\";s:29:\"Bisa diminum sesama keluarga.\";s:8:\"category\";s:7:\"Minuman\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/c1d06b38e191ae50101bd72395f7bf43.jpg\";}}', '2024-02-25 22:47:29', 'jl.kuy'),
(64, 'Ar Anang', 'mochanangardiansyah@gmail.com', 'a:1:{i:61;a:7:{s:2:\"id\";s:2:\"61\";s:5:\"title\";s:12:\"Rokok Kapten\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:26:\"Rokoknya Para Kapten, 18++\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:2:\"89\";s:5:\"image\";s:44:\"uploads/48ecd1962f4465854359a231ff39303c.jpg\";}}', '2024-03-18 13:33:06', 'jl.kuy'),
(65, ' ', 'mochanangardiansyah@gmail.com', 'a:1:{i:68;a:7:{s:2:\"id\";s:2:\"68\";s:5:\"title\";s:10:\"Royco Sapi\";s:5:\"price\";s:4:\"2000\";s:11:\"description\";s:33:\"Asli dari Sapi Madura , sudah SNI\";s:8:\"category\";s:11:\"Bahan Dapur\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/7b2ba0f1f2680927587c2049287dd74e.jpg\";}}', '2024-03-20 20:33:58', 'jl.kuy'),
(66, ' ', 'mochanangardiansyah@gmail.com', 'a:4:{i:72;a:7:{s:2:\"id\";s:2:\"72\";s:5:\"title\";s:19:\"Minuman Enakk Kawa\'\";s:5:\"price\";s:6:\"300000\";s:11:\"description\";s:29:\"Bisa diminum sesama keluarga.\";s:8:\"category\";s:7:\"Minuman\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/c1d06b38e191ae50101bd72395f7bf43.jpg\";}i:61;a:7:{s:2:\"id\";s:2:\"61\";s:5:\"title\";s:12:\"Rokok Kapten\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:26:\"Rokoknya Para Kapten, 18++\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/48ecd1962f4465854359a231ff39303c.jpg\";}i:69;a:7:{s:2:\"id\";s:2:\"69\";s:5:\"title\";s:14:\"Shampoo Punten\";s:5:\"price\";s:4:\"2000\";s:11:\"description\";s:46:\"puntennn shampo memanjangkan tali silahturahmi\";s:8:\"category\";s:11:\"Bahan Mandi\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s:44:\"uploads/56d3108002a0f5fa78cae95e266b71ea.jpg\";}i:70;a:7:{s:2:\"id\";s:2:\"70\";s:5:\"title\";s:22:\"Shampoo Shobat Ambyarr\";s:5:\"price\";s:4:\"5000\";s:11:\"description\";s:9:\"aseloleee\";s:8:\"category\";s:11:\"Bahan Mandi\";s:8:\"quantity\";s:1:\"1\";s:5:\"image\";s', '2024-03-20 21:58:26', 'jl.kuy'),
(67, ' ', 'mochanangardiansyah@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"3\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-23 10:22:01', 'jl.kuy'),
(68, ' ', 'mochanangardiansyah@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"3\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-23 10:40:49', 'jl.kuy'),
(69, 'Rochman Zaini', 'rochman279@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-25 19:11:53', 'Jl. Jetis Kulon 1, No. 57, Surabaya'),
(70, 'Rochman Zaini', 'rochman279@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-25 19:29:02', 'Jl. Jetis Kulon 1, No. 57, Surabaya'),
(71, 'Rochman Zaini', 'rochman279@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-25 19:30:55', 'Jl. Jetis Kulon 1, No. 57, Surabaya'),
(72, 'Rochman Zaini', 'rochman279@gmail.com', 'a:1:{i:74;a:7:{s:2:\"id\";s:2:\"74\";s:5:\"title\";s:8:\"Mahalbro\";s:5:\"price\";s:5:\"12000\";s:11:\"description\";s:11:\"Rokok mahal\";s:8:\"category\";s:5:\"Rokok\";s:8:\"quantity\";s:1:\"2\";s:5:\"image\";s:44:\"uploads/c24310189bed0677cd5712cfb0730091.jpg\";}}', '2024-04-25 19:38:09', 'Jl. Jetis Kulon 1, No. 57, Surabaya'),
(73, 'B A', 'ab123456@gmail.com', 'a:1:{i:68;a:7:{s:2:\"id\";s:2:\"68\";s:5:\"title\";s:10:\"Royco Sapi\";s:5:\"price\";s:4:\"2000\";s:11:\"description\";s:33:\"Asli dari Sapi Madura , sudah SNI\";s:8:\"category\";s:11:\"Bahan Dapur\";s:8:\"quantity\";s:1:\"3\";s:5:\"image\";s:44:\"uploads/8b24034b690928d53682f79bc81f6aac.jpg\";}}', '2024-04-29 13:28:27', 'Jl. Yuk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `code` int(11) NOT NULL DEFAULT 0,
  `expiration` int(11) NOT NULL DEFAULT 0,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `phone`, `address`, `password`, `code`, `expiration`, `created`) VALUES
(19, 'Ardiansyah', 'Anang', 'mochardiansyahanang.22006@mhs.unesa.ac.id', '089514312154', 'jl.kuy', '$2y$10$trhksjF2yCLivjizERaIUeXZAf045uUHHI3clf7AgeqdIhs13RRCi', 0, 0, 1708863839),
(20, '', '', 'mochanangardiansyah@gmail.com', '089514312154', 'jl.kuy', '$2y$10$8bSACb2HLDmwaQAYtIRmT.wZKMHfjvJacjA46e65bj2GFfUCbiHai', 0, 0, 1708871635),
(21, 'Rochman', 'Zaini', 'rochman279@gmail.com', '081357040615', 'Jl. Jetis Kulon 1, No. 57, Surabaya', '$2y$10$kcpcX1nEK6Wj4q3EEGxVKetDSDRpjwbIkUj.SRiivXdOWYawTXCuW', 0, 0, 1714043093),
(22, 'B', 'A', 'ab123456@gmail.com', '0811565656', 'Jl. Yuk', '$2y$10$v2RlMqXJItHXdJO5eQSY3.PDFFhQnbSiZ26uv3CLwbtVBYY3e26oW', 0, 0, 1714372049);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
