-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 07:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plasmabank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

CREATE TABLE `admin_detail` (
  `admin_id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`admin_id`, `username`, `password`) VALUES
(1, 'knzope', 'Kunal@123'),
(2, 'shubham', 'Shubham@123');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donar_appointments`
--

CREATE TABLE `donar_appointments` (
  `donar_id` int(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_email` varchar(50) NOT NULL,
  `bank_phone` varchar(50) NOT NULL,
  `address_line_1` varchar(50) NOT NULL,
  `address_line_2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donar_appointments`
--

INSERT INTO `donar_appointments` (`donar_id`, `bank_name`, `bank_email`, `bank_phone`, `address_line_1`, `address_line_2`, `city`, `state`, `pincode`, `date`, `time`) VALUES
(26, 'Plasma bank 1', 'learnerp34@gmail.com', '9678900989', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', '106565', '2020-11-15', '09:00'),
(27, 'plasma bank 2', 'learnersdomain@gmail.com', '7678900989', 'Skyline bld', 'Powai road', 'Pune', 'Maharashtra', '106565', '2020-11-16', '11:00');

-- --------------------------------------------------------

--
-- Table structure for table `donar_requests`
--

CREATE TABLE `donar_requests` (
  `donar_id` int(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `donar_name` varchar(255) NOT NULL,
  `donar_age` varchar(50) NOT NULL,
  `donar_gender` varchar(50) NOT NULL,
  `donar_bgroup` varchar(50) NOT NULL,
  `donar_city` varchar(50) NOT NULL,
  `donar_proof` varchar(255) NOT NULL,
  `donar_q1` varchar(50) NOT NULL,
  `donar_q2` varchar(50) NOT NULL,
  `donar_q3` varchar(50) NOT NULL,
  `donar_q4` varchar(50) NOT NULL,
  `donar_q5` varchar(50) NOT NULL,
  `donar_q6` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `request_status` int(50) NOT NULL,
  `allotment_status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donar_requests`
--

INSERT INTO `donar_requests` (`donar_id`, `user_email`, `user_phone`, `donar_name`, `donar_age`, `donar_gender`, `donar_bgroup`, `donar_city`, `donar_proof`, `donar_q1`, `donar_q2`, `donar_q3`, `donar_q4`, `donar_q5`, `donar_q6`, `token`, `request_status`, `allotment_status`) VALUES
(26, 'learnerp34@gmail.com', '9387654212', 'Kunal', '20', 'male', 'A', 'Mumbai', '887309d048beef83ad3eabf2a79a64a389ab1c9f.jpg', 'no', 'no', 'no', 'no', 'no', 'no', '887309d048beef83ad3eabf2a79a64a389ab1c9f', 1, 1),
(27, 'learnersdomain@gmail.com', '8678900989', 'Rohit', '20', 'male', 'A', 'Pune', 'bc33ea4e26e5e1af1408321416956113a4658763.jpg', 'no', 'no', 'no', 'no', 'no', 'no', 'bc33ea4e26e5e1af1408321416956113a4658763', 1, 1),
(28, 'learnerp34@gmail.com', '9387654212', 'Zope', '20', 'male', 'A', 'Mumbai', '0a57cb53ba59c46fc4b692527a38a87c78d84028.jpg', 'no', 'no', 'no', 'no', 'no', 'no', '0a57cb53ba59c46fc4b692527a38a87c78d84028', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `individual_user`
--

CREATE TABLE `individual_user` (
  `Userid` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(50) NOT NULL,
  `checkedtoken` varchar(255) NOT NULL,
  `initialtoken` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individual_user`
--

INSERT INTO `individual_user` (`Userid`, `fname`, `lname`, `age`, `gender`, `email`, `phone`, `password`, `addressline1`, `addressline2`, `city`, `state`, `pincode`, `checkedtoken`, `initialtoken`) VALUES
(38, 'Kunal', 'Zope', 18, 'male', 'learnerp34@gmail.com', '9387654212', 'Kunal@123', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', 106565, '7dee51c87d682002bf811f86bcb1229154da77f7', '8287f15b53c6cbab93000ea43275953d34165710'),
(39, 'Rohit', 'Suryawanshi', 22, 'male', 'learnersdomain@gmail.com', '8678900989', 'Rohit@123', 'Skyline bld', 'Powai road', 'Pune', 'Maharashtra', 106565, 'dec4174d7a7c23fa0bcd33112e0064f709f3a95b', '3f2c97ed8a2acc49e3c901befb0abaa7f22fe3be'),
(40, 'Zope', 'Kunal', 22, 'male', 'knzope@mitaoe.ac.in', '9172172352', 'Kunal@123', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', 106565, '7dee51c87d682002bf811f86bcb1229154da77f7', '4f9eb0b641d6d6c93ffc1eddc39fc45f1987a42d');

-- --------------------------------------------------------

--
-- Table structure for table `organizational_user`
--

CREATE TABLE `organizational_user` (
  `org_id` int(50) NOT NULL,
  `pbname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(50) NOT NULL,
  `approvalfile` varchar(255) NOT NULL,
  `checkedtoken` varchar(255) NOT NULL,
  `initialtoken` varchar(255) NOT NULL,
  `approval_status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizational_user`
--

INSERT INTO `organizational_user` (`org_id`, `pbname`, `email`, `phone`, `password`, `addressline1`, `addressline2`, `city`, `state`, `pincode`, `approvalfile`, `checkedtoken`, `initialtoken`, `approval_status`) VALUES
(48, 'Plasma bank 1', 'learnerp34@gmail.com', '9678900989', 'Kunal@123', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', 106565, '8287f15b53c6cbab93000ea43275953d34165710.jpg', '7dee51c87d682002bf811f86bcb1229154da77f7', '8287f15b53c6cbab93000ea43275953d34165710', 1),
(49, 'plasma bank 2', 'learnersdomain@gmail.com', '7678900989', 'Kunal@123', 'Skyline bld', 'Powai road', 'Pune', 'Maharashtra', 106565, '3f2c97ed8a2acc49e3c901befb0abaa7f22fe3be.jpg', '7dee51c87d682002bf811f86bcb1229154da77f7', '3f2c97ed8a2acc49e3c901befb0abaa7f22fe3be', 1),
(50, 'Plasma bank 3', 'knzope@mitaoe.ac.in', '9387654212', 'Kunal@123', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', 106565, '4f9eb0b641d6d6c93ffc1eddc39fc45f1987a42d.jpg', '7dee51c87d682002bf811f86bcb1229154da77f7', '4f9eb0b641d6d6c93ffc1eddc39fc45f1987a42d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receiver_appointments`
--

CREATE TABLE `receiver_appointments` (
  `receiver_id` int(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_email` varchar(50) NOT NULL,
  `bank_phone` varchar(50) NOT NULL,
  `address_line_1` varchar(50) NOT NULL,
  `address_line_2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiver_appointments`
--

INSERT INTO `receiver_appointments` (`receiver_id`, `bank_name`, `bank_email`, `bank_phone`, `address_line_1`, `address_line_2`, `city`, `state`, `pincode`, `date`, `time`) VALUES
(7, 'Plasma bank 1', 'learnerp34@gmail.com', '9678900989', 'Skyline bld', 'Powai road', 'Mumbai', 'Maharashtra', '106565', '2020-11-15', '12:00'),
(8, 'plasma bank 2', 'learnersdomain@gmail.com', '7678900989', 'Skyline bld', 'Powai road', 'Pune', 'Maharashtra', '106565', '2020-11-16', '11:00');

-- --------------------------------------------------------

--
-- Table structure for table `receiver_requests`
--

CREATE TABLE `receiver_requests` (
  `receiver_id` int(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `receiver_name` varchar(50) NOT NULL,
  `receiver_age` varchar(50) NOT NULL,
  `receiver_gender` varchar(50) NOT NULL,
  `receiver_bgroup` varchar(50) NOT NULL,
  `receiver_city` varchar(50) NOT NULL,
  `receiver_proof` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `request_status` int(50) NOT NULL,
  `allotment_status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiver_requests`
--

INSERT INTO `receiver_requests` (`receiver_id`, `user_email`, `user_phone`, `receiver_name`, `receiver_age`, `receiver_gender`, `receiver_bgroup`, `receiver_city`, `receiver_proof`, `token`, `request_status`, `allotment_status`) VALUES
(7, 'learnerp34@gmail.com', '9387654212', 'Kunal', '20', 'male', 'A', 'Mumbai', '902ba3cda1883801594b6e1b452790cc53948fda.jpg', '902ba3cda1883801594b6e1b452790cc53948fda', 1, 1),
(8, 'learnersdomain@gmail.com', '8678900989', 'Rohit', '20', 'male', 'A', 'Pune', 'fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f.jpg', 'fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 1, 1),
(9, 'learnerp34@gmail.com', '9387654212', 'Zope', '22', 'male', 'A', 'Mumbai', '0ade7c2cf97f75d009975f4d720d1fa6c19f4897.jpg', '0ade7c2cf97f75d009975f4d720d1fa6c19f4897', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_detail`
--
ALTER TABLE `admin_detail`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donar_requests`
--
ALTER TABLE `donar_requests`
  ADD PRIMARY KEY (`donar_id`);

--
-- Indexes for table `individual_user`
--
ALTER TABLE `individual_user`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `organizational_user`
--
ALTER TABLE `organizational_user`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `receiver_requests`
--
ALTER TABLE `receiver_requests`
  ADD PRIMARY KEY (`receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_detail`
--
ALTER TABLE `admin_detail`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donar_requests`
--
ALTER TABLE `donar_requests`
  MODIFY `donar_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `individual_user`
--
ALTER TABLE `individual_user`
  MODIFY `Userid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `organizational_user`
--
ALTER TABLE `organizational_user`
  MODIFY `org_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `receiver_requests`
--
ALTER TABLE `receiver_requests`
  MODIFY `receiver_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
