-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 03:18 PM
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
-- Database: `enrollment_students`
--

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `verify_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`admin_id`, `email`, `user`, `pass`, `verify_pass`) VALUES
(1, 'akog486@gmail.com', 'jam04241', '$2y$10$fjTDoDx/k6AvqvYeZ48x5.W6Hcl6T4u.aw28v9SyhtdqH2/gzj7/m', '123'),
(2, 'buto@gmail.com', 'dexter123', '$2y$10$yOLF0z.idqU1b0UjT4cAwOqDpzQxlWrgEfhf8mUO7pwD/wHY7MAcO', '123'),
(3, 'gilgregenemantilla@gmail.com', 'Sigma_boi_123', '$2y$10$fD8nj81AjWAWKfavOmVJo.Gg7CRf.v0mTbJ8seVZeTdFYfl8skEcq', '123'),
(5, 'gesef@gmail.com', 'gesef143', '$2y$10$elHzhswjske2IgV5fMUmze8vaho2/4cLp40rYk4C31x2SCI.oVuIa', '123');

-- --------------------------------------------------------

--
-- Table structure for table `students_form`
--

CREATE TABLE `students_form` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `mid_ini` varchar(2) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `birth_year` date NOT NULL,
  `status` enum('Ongoing','Drop','Done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_form`
--

INSERT INTO `students_form` (`student_id`, `first_name`, `mid_ini`, `last_name`, `course`, `department`, `birth_year`, `status`) VALUES
(143000, 'Josh Andrei ', 'M', 'Magcalas', 'BSIT', 'CCE', '2004-06-08', 'Ongoing'),
(143001, 'Gesef Mari ', 'M.', 'Depra', 'MMA', 'CCE', '2005-03-16', 'Ongoing'),
(143002, 'Eli', '', 'Soronio', 'BSIT', 'yawa way oten dri', '2025-02-11', 'Ongoing'),
(143003, 'Josh Andrei ', '', 'Magcalas', 'bsit', 'ddd', '2025-02-10', 'Ongoing'),
(143004, 'P', 'M', 'DIDDY', 'HEAD', 'DICK', '2025-02-12', 'Ongoing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `students_form`
--
ALTER TABLE `students_form`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_form`
--
ALTER TABLE `students_form`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143005;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
