-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 02:03 PM
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
-- Database: `tourms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(5) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `password`, `role`) VALUES
(1, 'dhruv', 'dhruv2004', 'admin'),
(3, 'harsh', 'harsh2004', 'admin'),
(4, 'shubham', 'shubham2005', 'admin'),
(5, 'vivek', 'vivek2005', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bid` int(5) NOT NULL,
  `pid` int(5) DEFAULT NULL,
  `cid` int(5) DEFAULT NULL,
  `booking_dateandtime` datetime DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT 'pending',
  `tour_start` date NOT NULL DEFAULT '1970-01-01',
  `tour_end` date NOT NULL DEFAULT '1970-01-01',
  `members` int(5) NOT NULL DEFAULT 0,
  `total_payment` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bid`, `pid`, `cid`, `booking_dateandtime`, `booking_status`, `tour_start`, `tour_end`, `members`, `total_payment`) VALUES
-- (14, 50, 4, '2024-09-05 14:20:48', 'pending', '2024-09-17', '2024-09-19', 0, 300000),
-- (16, 49, 6, '2024-09-05 14:24:58', 'pending', '2024-09-10', '2024-09-25', 0, 2250000),
(18, 50, 5, '2024-09-06 10:35:56', 'pending', '2024-09-11', '2024-09-25', 4, 9912000),
(20, 51, 4, '2024-09-06 12:18:23', 'pending', '2024-10-16', '2024-10-23', 1, 619500),
(21, 47, 5, '2024-09-06 12:45:05', 'pending', '2024-09-14', '2024-09-26', 1, 1840800);

-- --------------------------------------------------------

--
-- Table structure for table `emaildata`
--

CREATE TABLE `emaildata` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emaildata`
--

INSERT INTO `emaildata` (`name`, `email`, `subject`, `message`) VALUES
('ery', '9081759406@gmail.com', 'qurey', 'jdjsoijavnj'),
('Panchani Harsh Rajeshbhai', 'hpanchani2004@gmail.com', 'i am send email for my qurey\'s', 'hello'),
('Panchani Harsh Rajeshbhai', 'hpanchani2004@gmail.com', 'i am send email for my qurey\'s', 'hello hi'),
('Panchani Harsh Rajeshbhai', 'hpanchani2004@gmail.com', 'i am send email for my qurey\'s', 'hello hi'),
('Panchani Harsh Rajeshbhai', 'hpanchani2004@gmail.com', 'i am send email for my qurey\'s', 'hello hi'),
('Panchani Harsh', 'hpanchani2004@gmail.com', 'qurey', 'hello hi by'),
('Panchani Harsh', 'hpanchani2004@gmail.com', 'qurey', 'hello hi by'),
('Panchani Harsh', 'hpanchani2004@gmail.com', 'i am send email for my qurey ', 'iojw3nyvby'),
('Panchani Harsh', 'hpanchani2004@gmail.com', 'i am send email for my qurey ', 'iojw3nyvby'),
('harsh', 'harshpanchani05@gmail.com', 'i am send email for my qurey ', 'jwuui ');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `pid` int(5) NOT NULL,
  `package_name` varchar(40) NOT NULL,
  `package_cate` varchar(30) NOT NULL,
  `package_loc` varchar(40) NOT NULL,
  `package_price` bigint(10) NOT NULL,
  `package_detail` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pid`, `package_name`, `package_cate`, `package_loc`, `package_price`, `package_detail`) VALUES
(10, 'manali', 'mountain', 'manali,shimla', 475000, 'asdfasdfasdfasdfasdfasdfasdf'),
(11, 'manali', 'island', 'manali,shimla', 350000, 'asdfadfasdf'),
(43, 'manali', 'city', 'india', 500000, 'xfgdfgsfegs'),
(44, 'dubai', 'city', 'UAE', 450000, 'dubai is very rich country/city'),
(45, 'switzerland', 'mountain', 'switzerland europe', 200000, 'it is very cold place'),
(47, 'vct', 'city', 'seoul,korea ', 650000, 'vct'),
(49, 'tokyo', 'city', 'tokyo japan', 550000, 'tokyo is very beautiful city and capital of japan! you can visit all the shrines of japan, and you can also visit the tokyo tower ,there are many more thing to visit in tokyo! there are many good cities near tokyo like shibuya,osaka,etc . and mount fuji is also near from tokyo'),
(50, 'singapor', 'city', 'singapor', 750000, 'singapor is very beautiful city!Every one should visit the singapor.There is also Disney land in singapor'),
(51, 'paris', 'city', 'france', 375000, 'paris is beautiful city witch is located in the france country');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `rid` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`rid`, `name`, `email`, `phone`, `password`, `address`) VALUES
(1, 'shubham', 'shubhamkoshiya3434@gmail.com', 9876543210, '123456789', '135,haridarshan soc,surat,gujarat,india'),
(4, 'abc', 'abc@gmail.com', 879345693, 'abc123', 'l;skhjg'),
(5, 'dhruv', 'dhruv@gmail.com', 7549205844, 'ironman', 'abcdefghijklmnoASDFASDFASDFASDF'),
(6, 'xyz', 'xyz@gmail.com', 578492304, 'xyzabc', 'abcdefghijklmnopqrstuvwxyz'),
(8, 'senTenz', 'senvct@gmail.com', 6450454545, 'tenz', 'canada'),
(10, 'prxforsacon', 'paperrex@gmail.com', 6395720389, 'vct', 'abcdefghijklmopqrstuvwxyz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `rid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `packages` (`pid`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `registration` (`rid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
