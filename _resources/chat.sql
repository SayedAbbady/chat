-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 05:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `dId` int(11) NOT NULL,
  `dEmail` varchar(255) NOT NULL,
  `dName` varchar(255) NOT NULL,
  `dPass` varchar(255) NOT NULL,
  `dLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`dId`, `dEmail`, `dName`, `dPass`, `dLevel`) VALUES
(1, 'sayed@gmail.com', 'Sayed', 'MQ==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `f_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `f_fname` varchar(255) NOT NULL,
  `f_lname` varchar(255) NOT NULL,
  `f_status` int(11) NOT NULL DEFAULT 1,
  `f_gender` varchar(255) NOT NULL,
  `f_teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gId` int(11) NOT NULL,
  `gName` varchar(255) DEFAULT NULL,
  `gSubname` varchar(255) NOT NULL,
  `idTeacher` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `empty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gId`, `gName`, `gSubname`, `idTeacher`, `idStudent`, `status`, `empty`) VALUES
(4, 'student sayed `s Group', 'Sayed Teacher', 16, 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gsuper`
--

CREATE TABLE `gsuper` (
  `superId` int(11) NOT NULL,
  `gId` int(11) NOT NULL,
  `idSupervisor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `mId` int(11) NOT NULL,
  `mText` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gId` int(11) NOT NULL,
  `mDate` datetime NOT NULL,
  `mSender` int(11) NOT NULL,
  `mName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mType` int(11) NOT NULL,
  `mSeen` int(11) DEFAULT 0,
  `mSeenT` int(11) DEFAULT 0,
  `mSeenS` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`mId`, `mText`, `gId`, `mDate`, `mSender`, `mName`, `mType`, `mSeen`, `mSeenT`, `mSeenS`) VALUES
(79, '😂😂😂', 4, '2020-08-06 15:04:27', 16, 'Sayed Teacher', 1, 1, 1, 0),
(80, 'this message deleted', 4, '2020-08-06 16:40:14', 17, 'student sayed', 4, 1, 0, 0),
(81, 'this message deleted', 4, '2020-08-06 16:40:26', 17, 'student sayed', 4, 1, 0, 0),
(82, '🙄', 4, '2020-08-06 16:40:49', 17, 'student sayed', 1, 1, 0, 0),
(83, 'this message deleted', 4, '2020-08-06 16:54:08', 16, 'Sayed Teacher', 4, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_text` text NOT NULL,
  `p_date` datetime NOT NULL,
  `p_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`p_id`, `u_id`, `p_text`, `p_date`, `p_type`) VALUES
(1, 2, 'problem problem', '2020-07-28 06:11:00', 'user'),
(2, 1, 'test', '2020-07-28 06:12:00', 'user'),
(3, 1, 'problem', '2020-07-28 06:12:00', 'support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `uFname` varchar(255) NOT NULL,
  `uLname` varchar(255) NOT NULL,
  `uGender` varchar(100) NOT NULL,
  `uType` varchar(50) NOT NULL,
  `uPhone` varchar(100) NOT NULL,
  `uUrl` varchar(255) NOT NULL,
  `uZoom` varchar(255) NOT NULL,
  `tId` int(11) DEFAULT 0,
  `uImage` varchar(255) NOT NULL,
  `uActive` varchar(100) NOT NULL DEFAULT '0',
  `uStatus` int(11) NOT NULL DEFAULT 1,
  `uEmail` varchar(255) NOT NULL,
  `uPassword` varchar(255) NOT NULL,
  `gId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uFname`, `uLname`, `uGender`, `uType`, `uPhone`, `uUrl`, `uZoom`, `tId`, `uImage`, `uActive`, `uStatus`, `uEmail`, `uPassword`, `gId`) VALUES
(16, 'Sayed', 'Teacher', 'Male', 'Te', '01153198183', 'sdfsdfsdf', 'sddfsdfswd', 0, 'Avatarmale.png', '1', 1, 'teacher@gmail.com', 'MTIzNDU=', 0),
(17, 'student', 'sayed', 'Male', 'stu', '01153198183', 'dsvsdfkjsdf', 'wdkfjsdf', 16, 'Avatarmale.png', '1', 1, 'sayeads@gmail.com', 'MTIzNDU=', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`dId`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `par_id` (`u_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gId`);

--
-- Indexes for table `gsuper`
--
ALTER TABLE `gsuper`
  ADD PRIMARY KEY (`superId`),
  ADD KEY `fk_Id` (`gId`),
  ADD KEY `fk_sup` (`idSupervisor`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`mId`),
  ADD KEY `g_fk` (`gId`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `dId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gsuper`
--
ALTER TABLE `gsuper`
  MODIFY `superId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `mId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `par_id` FOREIGN KEY (`u_id`) REFERENCES `users` (`uId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gsuper`
--
ALTER TABLE `gsuper`
  ADD CONSTRAINT `fk_Id` FOREIGN KEY (`gId`) REFERENCES `groups` (`gId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sup` FOREIGN KEY (`idSupervisor`) REFERENCES `users` (`uId`);

--
-- Constraints for table `msg`
--
ALTER TABLE `msg`
  ADD CONSTRAINT `g_fk` FOREIGN KEY (`gId`) REFERENCES `groups` (`gId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
