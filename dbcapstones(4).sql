-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 04:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcapstones`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcapstone`
--

CREATE TABLE `tblcapstone` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `date_published` date NOT NULL,
  `abstract` text NOT NULL,
  `pdf_file` longblob DEFAULT NULL,
  `is_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcapstone`
--

INSERT INTO `tblcapstone` (`id`, `title`, `author`, `date_published`, `abstract`, `pdf_file`, `is_status`) VALUES
(26, 'mobile', 'mob', '2024-04-01', 'wwwwwdasdf', NULL, '0'),
(27, 'wewer', 'werwe', '2024-04-10', 'ewrwe', NULL, '0'),
(28, 'wwwww', 'wwwww', '2024-04-11', 'wwww', NULL, '1'),
(29, 'weteryrty', 'dfhfdgh', '2024-04-12', 'hdfghdf', NULL, '1'),
(30, 'sw', 'saw', '2024-04-03', 'Sw', NULL, '1'),
(31, 'lLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'fsdfsd', '2024-04-11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '1'),
(32, 'zdfsgas', 'asdgasdg', '2024-04-08', 'gasdgsad', NULL, '0'),
(33, 'aDS', 'awdwq', '2024-04-08', 'dwdq', 0x2e2e2f75706c6f6164732f4632305f506172656e7473436f6e73656e742e706466, '1'),
(34, 'awefawe', 'fwefwa', '2024-04-05', 'fwefwaefw', 0x2e2e2f75706c6f6164732f4632305f506172656e7473436f6e73656e74202831292e706466, '1'),
(35, 'fxxfjh', 'kugliu', '2024-04-11', 'khjvkyhv', 0x2e2e2f75706c6f6164732f5375727665792d322e706466, '0'),
(0, 'adfadf', 'adfadsfadsfasdf31231', '2024-04-19', 'arwqfacdsfafafaf', 0x2e2e2f75706c6f6164732f434841505445522d332d456e6372797074696f6e322e706466, '1'),
(0, 'adfasdfa', 'adfasdf', '2024-04-10', 'fasdfasfasfas', 0x2e2e2f75706c6f6164732f375275627269632d5265666c65637469696f6e2d50617065722d5275627269632e706466, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `id` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `studentId` int(8) NOT NULL,
  `accountType` enum('student','admin','','') NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`id`, `name`, `studentId`, `accountType`, `email`, `password`) VALUES
(1, 'Mark Angelo', 210432, 'student', 'Light@gmail.com', '$2y$10$MduDrrljHcgENfrOk20n1Oqr9KK3CebCvUkl4B6b9GBDfJxHjFiPy'),
(2, 'Mark Angelo', 210433, 'admin', 'ryan@gmail.com', '$2y$10$qrLCBMf47pX0hetHRfqdNexL5oEr7VBKcF1ktC/hRE97uRtCiQ9Fe'),
(3, 'ryan', 124124, 'admin', 'hehe@gmail.com', '123456'),
(4, 'ryan', 124124, 'admin', 'rydfadan@gmail.com', 'adfadf'),
(5, 'ryan', 124124, 'admin', 'rydfadan@gmail.com', 'adfadf'),
(6, 'hehe', 234, 'admin', 'heehee@gmail.com', '$2y$10$BnubmBGqdep3mBxPCzLEp.Fo.uuzmOGquXv20pnXoSz0G6JJlfesu'),
(7, 'ryan', 24124, 'admin', 'hehe@gmail.com', '$2y$10$n4.nKErbof/3OaHNcYkHXOH9TJ8k8g0ymIc5HI/yAq7ePo3p6TX1C'),
(8, 'keekee', 3213, 'admin', 'keekee@gmail.com', '$2y$10$0nL8xZTS.bSJU0KNSurbHeLGAUs26guINGePDtXJBLvWqJAN5ASsi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
