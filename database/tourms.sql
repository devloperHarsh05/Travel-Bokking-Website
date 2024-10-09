-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 05:49 AM
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
  `total_payment` bigint(20) NOT NULL DEFAULT 0,
  `moblie_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bid`, `pid`, `cid`, `booking_dateandtime`, `booking_status`, `tour_start`, `tour_end`, `members`, `total_payment`, `moblie_no`) VALUES
(45, 97, 20, '2024-09-14 00:00:00', 'confirmed', '2024-09-21', '2024-09-29', 1, 377600, 0);

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
('harsh', 'harshpanchani05@gmail.com', 'i am send email for my qurey ', 'jwuui '),
('aryan', 'aryan23@gmail.com', 'qurey', 'dfdfdfd'),
('aryan', 'aryan23@gmail.com', 'qurey', 'dfdfdfd'),
('aryan', 'aryan23@gmail.com', 'qurey', 'dfdfdfd');

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
  `package_detail` longtext NOT NULL,
  `package_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pid`, `package_name`, `package_cate`, `package_loc`, `package_price`, `package_detail`, `package_img`) VALUES
(96, 'new york', 'city', 'usa', 200000, 'city', '[\"66e53d808ede9.png\",\"66e53d808fd64.png\",\"66e53d8090abd.png\",\"66e53d8091a13.png\",\"66e53d8092a55.png\"]'),
(97, 'PYRAMID OF GIZA', 'historical', 'egypt', 200000, 'pyramid is great historical place in egypt.', '[\"66e53f140e277.jpeg\",\"66e53f140e60a.jpeg\",\"66e53f140ea64.jpeg\",\"66e53f140ee9c.jpeg\",\"66e53f140f31d.jpeg\"]'),
(98, 'Tokyo', 'city', 'japan', 40000, 'aaaaa', '[\"66e541445a06a.jpeg\",\"66e541445afc2.jpeg\",\"66e541445bdc9.jpeg\",\"66e5414462cb2.jpeg\",\"66e5414463b6c.jpeg\"]');

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
(13, 'Panchani Harsh', 'harshpanchani05@gmail.com', 523, '11', 'KK'),
(15, 'asd', 'harshpanchani05789@gmail.com', 9898989898, '123', 'aaa'),
(16, 'ayush', 'ayush123@gmail.com', 1234567890, '1234', 'surat amroli'),
(17, 'aryan', 'a@gmail.com', 1111222211, '123', 'sabji market '),
(20, 'abc', 'abc@gmail.com', 8888877777, '123', 'aa');

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
  MODIFY `bid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `rid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
