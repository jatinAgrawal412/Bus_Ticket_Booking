-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 05:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_info`
--

CREATE TABLE `bus_info` (
  `bus_id` int(11) NOT NULL,
  `max_seats` int(11) NOT NULL DEFAULT 112,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_info`
--

INSERT INTO `bus_info` (`bus_id`, `max_seats`, `type`) VALUES
(1001, 112, 'non-ac'),
(1002, 112, 'ac'),
(1003, 112, 'non-ac'),
(1004, 112, 'non-ac'),
(1005, 112, 'ac'),
(1006, 112, 'non-ac'),
(1007, 112, 'non-ac'),
(1008, 112, 'ac'),
(1009, 112, 'non-ac'),
(1010, 112, 'non-ac'),
(1011, 112, 'ac'),
(1012, 112, 'non-ac'),
(1013, 112, 'non-ac'),
(1014, 112, 'ac'),
(1015, 112, 'non-ac'),
(1016, 112, 'non-ac'),
(1017, 112, 'ac'),
(1018, 112, 'non-ac'),
(1019, 112, 'non-ac'),
(1020, 112, 'ac'),
(1021, 112, 'non-ac'),
(1022, 112, 'non-ac'),
(1023, 112, 'ac'),
(1024, 112, 'non-ac'),
(1025, 112, 'non-ac'),
(1026, 112, 'ac'),
(1027, 112, 'non-ac'),
(1028, 112, 'non-ac'),
(1029, 112, 'ac'),
(1030, 112, 'non-ac'),
(1031, 112, 'non-ac'),
(1032, 112, 'ac'),
(1033, 112, 'non-ac'),
(1034, 112, 'non-ac'),
(1035, 112, 'ac'),
(1036, 112, 'non-ac');

-- --------------------------------------------------------

--
-- Table structure for table `bus_route`
--

CREATE TABLE `bus_route` (
  `route_id` int(11) NOT NULL,
  `departure` time NOT NULL,
  `arrival` time NOT NULL,
  `bus_id` int(11) NOT NULL,
  `fare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_route`
--

INSERT INTO `bus_route` (`route_id`, `departure`, `arrival`, `bus_id`, `fare`) VALUES
(101, '08:00:00', '08:05:00', 1001, 220),
(101, '12:00:00', '12:05:00', 1002, 320),
(101, '16:00:00', '16:05:00', 1003, 220),
(102, '08:30:00', '08:35:00', 1004, 80),
(102, '12:30:00', '12:35:00', 1005, 155),
(102, '16:30:00', '16:35:00', 1006, 90),
(103, '08:45:00', '08:50:00', 1007, 50),
(103, '12:45:00', '12:50:00', 1008, 150),
(103, '17:45:00', '17:50:00', 1009, 60),
(104, '08:00:00', '08:05:00', 1010, 270),
(104, '12:00:00', '12:05:00', 1011, 380),
(104, '16:00:00', '16:05:00', 1012, 300),
(105, '08:30:00', '08:35:00', 1013, 35),
(105, '12:30:00', '12:35:00', 1014, 95),
(105, '16:30:00', '16:35:00', 1015, 40),
(106, '08:45:00', '08:50:00', 1016, 80),
(106, '12:45:00', '12:50:00', 1017, 130),
(106, '17:45:00', '17:50:00', 1018, 85),
(107, '09:00:00', '09:05:00', 1019, 190),
(107, '12:00:00', '12:05:00', 1020, 320),
(107, '16:00:00', '16:05:00', 1021, 220),
(108, '08:30:00', '08:35:00', 1022, 37),
(108, '12:30:00', '12:35:00', 1023, 90),
(108, '20:30:00', '20:35:00', 1024, 45),
(109, '07:45:00', '07:50:00', 1025, 56),
(109, '14:45:00', '14:50:00', 1026, 110),
(109, '17:45:00', '17:50:00', 1027, 54),
(110, '06:00:00', '06:05:00', 1028, 270),
(110, '12:00:00', '12:05:00', 1029, 360),
(110, '21:00:00', '21:05:00', 1030, 300),
(111, '08:30:00', '08:35:00', 1031, 275),
(111, '12:30:00', '12:35:00', 1032, 395),
(111, '19:30:00', '19:35:00', 1033, 289),
(112, '08:45:00', '08:50:00', 1034, 280),
(112, '12:45:00', '12:50:00', 1035, 380),
(112, '17:45:00', '17:50:00', 1036, 285);

-- --------------------------------------------------------

--
-- Table structure for table `route_info`
--

CREATE TABLE `route_info` (
  `destination` varchar(15) NOT NULL,
  `source` varchar(15) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route_info`
--

INSERT INTO `route_info` (`destination`, `source`, `route_id`) VALUES
('vadodara', 'bhuj', 101),
('vadodara', 'ahemadabad', 102),
('vadodara', 'anand', 103),
('ahemadabad', 'bhuj', 104),
('ahemadabad', 'anand', 105),
('ahemadabad', 'vadodara', 106),
('anand', 'bhuj', 107),
('anand', 'ahemadabad', 108),
('anand', 'vadodara', 109),
('bhuj', 'vadodara', 110),
('bhuj', 'ahemadabad', 111),
('bhuj', 'anand', 112);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_info`
--

CREATE TABLE `ticket_info` (
  `ticket_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `total_fare` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `bookingdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_info`
--

INSERT INTO `ticket_info` (`ticket_id`, `p_id`, `bus_id`, `seats`, `total_fare`, `date`, `bookingdate`) VALUES
(14, 17, 1001, 1, 220, '2022-04-15 00:00:00', '2022-04-10 18:53:34'),
(94, 17, 1010, 1, 270, '2022-04-16 00:00:00', '2022-04-10 14:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `p_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobileno` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`p_id`, `name`, `uname`, `password`, `gender`, `age`, `email`, `mobileno`, `date`) VALUES
(17, 'Jatin Agrawal', 'jatin412', '1234', 'Male', 18, 'ajagrawal@gmail.com', 2147483647, '2022-04-01 18:51:35'),
(18, 'priyank', '08priyank', '123456', 'Male', 18, 'priyank@gmail.com', 2147483647, '2022-04-03 16:28:09'),
(19, 'Parthiv', 'Parthiv123', '0000', 'Male', 19, 'parthiv@gmail.com', 1478529631, '2022-04-03 16:33:04'),
(20, 'jaydev kalariya', 'jk', 'Jay1515@', 'Male', 19, 'jaydevkalariya27@gmail.com', 2147483647, '2022-04-03 16:35:23'),
(21, 'Mayur', 'Mayur123', 'mayur@123', 'Male', 20, 'ajagrawal@gmail.com', 2147483647, '2022-04-03 21:08:53'),
(26, 'Pratham Mehta', 'shady_45', '1234', 'Male', 18, 'ajagrawal@gmail.com', 2147483647, '2022-04-04 11:11:35'),
(31, 'Jatin Agrawal', 'jatin412123', '1111', 'Male', 12, 'ajagrawal@gmail.com', 2147483647, '2022-04-10 11:14:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_info`
--
ALTER TABLE `bus_info`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_route`
--
ALTER TABLE `bus_route`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `route_info`
--
ALTER TABLE `route_info`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `ticket_info`
--
ALTER TABLE `ticket_info`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
