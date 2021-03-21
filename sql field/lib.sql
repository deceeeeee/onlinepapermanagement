-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 07:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib`
--

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE `paper` (
  `id` varchar(255) NOT NULL,
  `papername` varchar(50) NOT NULL,
  `authorname` varchar(50) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `year` int(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `path` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`id`, `papername`, `authorname`, `publisher`, `year`, `file_name`, `path`) VALUES
('CS003       ', 'Test Book       ', 'Test Author       ', 'asd   ', 0, 'CS003       .pdf', 'ebooks/CS003       .pdf'),
('B001  ', 'Let Us c  ', 'YK  ', '  ', 0, 'B001  .pdf', 'ebooks/B001  .pdf'),
('1  ', 'asd  ', 'asd  ', '4  ', 0, '1  .pdf', 'ebooks/1  .pdf'),
('Bariyait ', '1997 ', 'Dhiraj ', 'Ding Rong ', 0, 'Bariyait .pdf', 'ebooks/Bariyait .pdf'),
('Bariyaitq', 'C001', 'Dhiraj', 'DING', 1998, 'asd.pdf', 'ebooks/Bariyaitq.pdf'),
('dxasd ', 'C001 ', 'Bariyait ', 'sadasd ', 12321, '13.pdf> <button id=', 'ebooks/dxasd .pdf'),
('dasdasd', 'dasdas', 'C0000000', 'sadasdas', 2147483647, 'asdas.pdf', 'ebooks/dasdasd.pdf'),
('sad', 'Test Book    ', 'Test Author    ', '    ', 0, 'CS003    .pdf', 'ebooks/CS003    .pdf'),
('John    ', 'Baba    ', 'Yaga    ', 'Wick    ', 1997, '> <button id=', 'ebooks/John   .pdf'),
('da      ', 'das      ', 'das      ', '31asd      ', 0, 'da      .pdf', 'ebooks/da      .pdf'),
('3   ', '1   ', '2   ', '4   ', 0, '3   .pdf', 'ebooks/3   .pdf');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_registration`
--

CREATE TABLE `researcher_registration` (
  `id` int(10) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'student',
  `name` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `researcher_registration`
--

INSERT INTO `researcher_registration` (`id`, `phone`, `type`, `name`, `emailid`, `password`) VALUES
(1, '001', 'admin', 'admin', 'admin001', 'admin123'),
(123, '1123', 'student', 'Dhiraj', 'ding@gmail.com', 'asd'),
(124, '1222333', 'student', 'Ding Rong', 'dhiru@gmail.com', 'asd'),
(125, '12', 'student', 'sad', 's@s.com', 'a'),
(122, '123', 'admin', 'Dhiraj', 'dhiraj@gmail.com', 'asd'),
(11, '12313', 'student', 'a', 'c@gmail.com', 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `b_id` (`id`);

--
-- Indexes for table `researcher_registration`
--
ALTER TABLE `researcher_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `researcher_registration`
--
ALTER TABLE `researcher_registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
