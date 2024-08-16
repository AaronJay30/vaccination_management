-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 11:23 AM
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
-- Database: `vaccination_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '4915b74462f5611a67c1c54d2148c2e4');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `philhealth` varchar(255) NOT NULL,
  `category` varchar(2) NOT NULL,
  `vaccineCardNumber` varchar(255) NOT NULL,
  `firstDoseid` int(11) DEFAULT NULL,
  `secondDoseid` int(11) DEFAULT NULL,
  `boosterDoseid` int(11) DEFAULT NULL,
  `facilityName` varchar(255) NOT NULL,
  `facilityContact` varchar(255) NOT NULL,
  `vaccineCard` varchar(255) DEFAULT NULL,
  `boosterCard` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`archive_id`, `userid`, `philhealth`, `category`, `vaccineCardNumber`, `firstDoseid`, `secondDoseid`, `boosterDoseid`, `facilityName`, `facilityContact`, `vaccineCard`, `boosterCard`) VALUES
(17, 11, 'ABC12345', 'A3', '8350983475', 13, 13, 5, 'GSW BAY', '083595236923', 'BI637ade732cd5c1.90284155.jpg', 'BI637ade732cd714.44440732.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booster_dose`
--

CREATE TABLE `booster_dose` (
  `booster_dose_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `batchNumber` varchar(255) NOT NULL,
  `lotNumber` varchar(255) NOT NULL,
  `vaccinatorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booster_dose`
--

INSERT INTO `booster_dose` (`booster_dose_id`, `userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES
(1, 5, '2022-07-10', 'Pfizer', '1F1043A', '1F1043A', 'Amana P. Sarte'),
(2, 3, '2022-08-26', 'Sinovac', 'CS1101', 'CS1010', 'Chelsea C. Salmonte'),
(3, 7, '2022-11-20', 'Pfizer', 'MP-2585', 'DC-7234', 'Steve Kerr'),
(4, 9, '2022-05-13', 'Sinovac', 'KT-25925', 'DC-7234', 'Kim Taehyung'),
(5, 11, '2001-11-05', 'Moderna', 'MP-2585', 'DC-7234', 'Steve Kerr');

-- --------------------------------------------------------

--
-- Table structure for table `first_dose`
--

CREATE TABLE `first_dose` (
  `first_dose_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `batchNumber` varchar(255) NOT NULL,
  `lotNumber` varchar(255) NOT NULL,
  `vaccinatorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `first_dose`
--

INSERT INTO `first_dose` (`first_dose_id`, `userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES
(1, 1, '2021-09-13', 'Astrazenica', 'A502SC', 'A1026', 'Mischelle A. Sumio'),
(2, 2, '2021-08-10', 'Pfizer', 'AS506', 'A2052', 'Imelda Pangan'),
(3, 3, '2021-06-15', 'Pfizer', 'AB250', 'A4026', 'Maria Clara'),
(4, 4, '2020-12-16', 'Sinovac', 'BS503', 'A7924', 'Kelly Clarkson'),
(5, 5, '2020-08-11', 'Sinovac', 'BT250', 'C9630', 'Regine Velazques'),
(6, 6, '2022-05-17', 'Jansen', 'A-42LS3', 'A-503AB', 'Billy Jean'),
(10, 7, '2022-10-01', 'Moderna', 'SC-5296', 'AC-3405', 'Klay Thompson'),
(11, 8, '2022-08-02', 'Jansen', 'C-365SD', 'J-24524', 'Jan Sena'),
(12, 9, '2021-02-13', 'Moderna', 'PS-25238', 'MS-35356', 'Aaron Jay Gabato'),
(13, 11, '2022-11-21', '', 'kfejlkfj', 'pogi', 'Klay Thompson');

-- --------------------------------------------------------

--
-- Table structure for table `second_dose`
--

CREATE TABLE `second_dose` (
  `second_dose_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `batchNumber` varchar(255) NOT NULL,
  `lotNumber` varchar(255) NOT NULL,
  `vaccinatorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `second_dose`
--

INSERT INTO `second_dose` (`second_dose_id`, `userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES
(1, 1, '2022-11-03', 'Astrazenica', 'A502SC', 'A1026', 'John Llyod'),
(2, 2, '2021-08-25', 'Pfizer', 'AS506', 'A2052', 'Imelda Pangan'),
(3, 3, '2021-07-02', 'Pfizer', 'AB250', 'A4026', 'Maria Clara'),
(4, 4, '2020-12-30', 'Sinovac', 'BS503', 'A7924', 'Kelly Clarkson'),
(5, 5, '2020-08-29', 'Sinovac', 'BT250', 'C9630', 'Regine Velazques'),
(9, 7, '2022-11-11', 'Moderna', 'SC-5296', 'AC-3405', 'Draymond Green'),
(12, 9, '2021-05-08', 'Moderna', 'JJ-24592', 'AN-33592', 'Jeon Jung Kook'),
(13, 11, '2022-11-21', 'Sinovac', 'SC-5296', '4814091284', 'Draymond Green');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_login_id`, `name`, `address`, `birthday`, `gender`, `email`, `contact`, `password`, `roles`, `grade`, `section`, `department`, `profile`) VALUES
(1, 'Aaron Jay N. Gabato', 'Science City of Munoz', '2002-06-01', 'Female', 'aaronjaygabato30@gmail.com', '09325283592', 'd1950cde82615f17da6dae352046f512', 'Faculty', NULL, NULL, 'Science Department', 'BI63967d3e966528.04466210.png'),
(2, 'Marvin Nodora', 'Bantug', '2001-12-28', 'Female', 'marvinNodora@gmail.com', '09257692851', '25f9e794323b453885f5181f1b624d0b', 'Student', 11, 1, NULL, 'female.png'),
(3, 'Uwy Ventanilla', 'Cabanatuan', '2002-02-28', 'Male', 'luizVentanilla@gmail.com', '09947258145', '25f9e794323b453885f5181f1b624d0b', 'Faculty', NULL, NULL, 'Science Department', 'BI63789c45572b64.01181463.jpg'),
(4, 'Mike Angelo Mariano', 'San Jose', '2002-07-24', 'Male', 'mikeMariano@gmail.com', '09827693857', '25f9e794323b453885f5181f1b624d0b', 'Faculty', NULL, NULL, 'ESP Department', 'male.png'),
(5, 'Nathaniel Cabobos', 'Guimba', '2001-09-05', 'Male', 'nathanCabobos@gmail.com', '09738672743', '25f9e794323b453885f5181f1b624d0b', 'Faculty', NULL, NULL, 'MAPEH Department', 'male.png'),
(6, 'Michael C. Jackson ', 'Science City of Munoz', '2002-11-01', 'Male', 'michaelJackson@gmail.com', '0924242424242', '25f9e794323b453885f5181f1b624d0b', 'Faculty', NULL, NULL, 'English Department', 'male.png'),
(7, 'Stephen M. Curry ', 'Bagong Sikat', '1993-10-24', 'Male', 'stephenCurry30@gmail.com', '09482596348', '25f9e794323b453885f5181f1b624d0b', 'Faculty', NULL, NULL, 'Science Department', 'male.png'),
(8, 'April Jayne N. Gabato ', 'Science City of Munoz', '1998-04-18', 'Female', 'apriljaynegabato@gmail.com', '09123456789', '25f9e794323b453885f5181f1b624d0b', 'Student', 11, 1, NULL, 'female.png'),
(9, 'Bea Alessandra V. Sison ', 'Mason', '2002-04-16', 'Female', 'beaalessandrasison@gmail.com', '09458274616', '1a2f07ee95903f2f5384177a4ba1e468', 'Student', 7, 1, NULL, 'BI637889dccf46e5.01900987.jpg'),
(10, 'Arjay DG. Hagid ', 'Bacal 2', '2002-12-12', 'Male', 'arjayHagid@gmail.com', '09274857395', '25f9e794323b453885f5181f1b624d0b', 'Student', 9, 1, NULL, 'male.png'),
(11, 'pog c valeriano sr.', 'bantug', '2001-11-05', 'Female', 'spamuwy@gmail.com', '089534890573895', '17f23c5f3ae934b1ea173da3977e6d06', 'Faculty', NULL, NULL, 'Science Department', 'BI637adee3f2a762.25422180.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_history`
--

CREATE TABLE `user_login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login_history`
--

INSERT INTO `user_login_history` (`id`, `user_id`, `name`, `address`, `birthday`, `gender`, `contact`, `roles`, `grade`, `section`, `department`) VALUES
(1, 2, 'Marvin Nodora', 'Bantug', '2001-12-28', 'Female', '09257692851', 'Student', 7, 1, ''),
(3, 1, 'Aaron Jay N. Gabato', 'Science City of Munoz', '2002-06-01', 'Female', '09325283592', 'Student', 8, 2, ''),
(6, 2, 'Marvin Nodora', 'Bantug', '2001-12-28', 'Female', '09257692851', 'Student', 8, 1, ''),
(8, 2, 'Marvin Nodora', 'Bantug', '2001-12-28', 'Female', '09257692851', 'Student', 9, 1, ''),
(17, 2, 'Marvin Nodora', 'Bantug', '2001-12-28', 'Female', '09257692851', 'Student', 10, 1, NULL),
(18, 1, 'Aaron Jay N. Gabato', 'Science City of Munoz', '2002-06-01', 'Female', '09325283592', 'Student', 9, 2, NULL),
(19, 1, 'Aaron Jay N. Gabato', 'Science City of Munoz', '2002-06-01', 'Female', '09325283592', 'Student', 10, 2, NULL),
(20, 1, 'Aaron Jay N. Gabato', 'Science City of Munoz', '2002-06-01', 'Female', '09325283592', 'Faculty', NULL, NULL, 'MAPEH Department');

-- --------------------------------------------------------

--
-- Table structure for table `user_vaccine`
--

CREATE TABLE `user_vaccine` (
  `user_vaccine_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `philhealth` varchar(255) DEFAULT NULL,
  `category` varchar(2) DEFAULT NULL,
  `vaccineCardNumber` varchar(255) DEFAULT NULL,
  `firstDoseid` int(11) DEFAULT NULL,
  `secondDoseid` int(11) DEFAULT NULL,
  `boosterDoseid` int(11) DEFAULT NULL,
  `facilityName` varchar(255) DEFAULT NULL,
  `facilityContact` varchar(255) DEFAULT NULL,
  `vaccineCard` varchar(255) DEFAULT NULL,
  `boosterCard` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_vaccine`
--

INSERT INTO `user_vaccine` (`user_vaccine_id`, `userid`, `philhealth`, `category`, `vaccineCardNumber`, `firstDoseid`, `secondDoseid`, `boosterDoseid`, `facilityName`, `facilityContact`, `vaccineCard`, `boosterCard`) VALUES
(1, 1, '1593870285', 'A4', 'A-2753', 1, 1, NULL, 'CHO SCM', '0449506748', 'vaccineCard.jpg', NULL),
(2, 2, '469286925861', 'A3', 'C-1535', 2, 2, NULL, 'CHO Bantug', '0449285367', 'vaccineCard.jpg', NULL),
(3, 3, '39582576938', 'A4', 'A-2481', 3, 3, 2, 'HBO CAB', '04459260853', 'vaccineCard.jpg', 'boosterCard.jpg'),
(4, 4, '2968249576', 'A3', 'A-0258', 4, 4, NULL, 'SAN JOS', '0442968323', 'vaccineCard.jpg', NULL),
(5, 5, '5678495356', 'A3', 'A-5262', 5, 5, 1, 'NE GUI', '0425728475', 'vaccineCard.jpg', 'boosterCard.jpg'),
(6, 6, '12144131124124', 'A4', '92849248', 6, NULL, NULL, 'CAB SM', '09384723958', 'vaccineCard.jpg', NULL),
(7, 7, 'ABC12345', 'A5', '12346789', 10, 9, 3, 'GSW BAY', '09384738294', 'BI6375a9e9b74bb4.39660796.jpg', 'BI6375a9e9b74d70.22849316.jpg'),
(14, 8, 'ABC12345', 'A5', '12346789', 11, NULL, NULL, 'SCM Munoz', '09123456789', 'BI6375d650216686.20601338.jpg', NULL),
(15, 9, '9259823095', 'A4', '8350983475', 12, 12, 4, 'SCM Munoz', '09183759837', 'BI63765989ce8512.37560076.jpg', 'BI63765989ce86a3.56976099.jpg'),
(16, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_vaccine_history`
--

CREATE TABLE `user_vaccine_history` (
  `user_vaccine_history_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `philhealth` varchar(255) DEFAULT NULL,
  `category` varchar(2) DEFAULT NULL,
  `vaccineCardNumber` varchar(255) DEFAULT NULL,
  `firstDoseid` int(11) DEFAULT NULL,
  `secondDoseid` int(11) DEFAULT NULL,
  `boosterDoseid` int(11) DEFAULT NULL,
  `facilityName` varchar(255) DEFAULT NULL,
  `facilityContact` varchar(255) DEFAULT NULL,
  `vaccineCard` varchar(255) DEFAULT NULL,
  `boosterCard` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_vaccine_history`
--

INSERT INTO `user_vaccine_history` (`user_vaccine_history_id`, `userid`, `philhealth`, `category`, `vaccineCardNumber`, `firstDoseid`, `secondDoseid`, `boosterDoseid`, `facilityName`, `facilityContact`, `vaccineCard`, `boosterCard`) VALUES
(5, 1, '1593870285', 'A4', 'A-2753', 1, 1, NULL, 'CHO SCM', '0449506748', 'vaccineCard.jpg', NULL),
(6, 2, '469286925861', 'A3', 'C-1535', 2, 2, NULL, 'CHO Bantug', '0449285367', 'vaccineCard.jpg', NULL),
(7, 3, '39582576938', 'A4', 'A-2481', 3, 3, 2, 'HBO CAB', '0445926853', 'vaccineCard.jpg', 'boosterCard.jpg'),
(8, 4, '2968249576', 'A3', 'A-0258', 4, 4, NULL, 'SAN JOS', '0442968323', 'vaccineCard.jpg', NULL),
(9, 5, '5678495356', 'A3', 'A-5262', 5, 5, 1, 'NE GUI', '0425728475', 'vaccineCard.jpg', 'boosterCard.jpg'),
(11, 6, '12144131124124', 'A4', '92849248', 6, NULL, NULL, 'CAB SM', '09384723958', 'vaccineCard.jpg', NULL),
(12, 7, 'ABC12345', 'A5', '12346789', 10, 9, 3, 'GSW BAY', '09384738294', 'BI6375a9e9b74bb4.39660796.jpg', 'BI6375a9e9b74d70.22849316.jpg'),
(13, 8, 'ABC12345', 'A5', '12346789', 11, NULL, NULL, 'SCM Munoz', '09123456789', 'BI6375d650216686.20601338.jpg', NULL),
(14, 9, '9259823095', 'A4', '8350983475', 12, 12, 4, 'SCM Munoz', '09183759837', 'BI63765989ce8512.37560076.jpg', 'BI63765989ce86a3.56976099.jpg'),
(15, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 11, 'ABC12345', 'A3', '8350983475', 13, 13, 5, 'GSW BAY', '83595236923', 'BI637ade732cd5c1.90284155.jpg', 'BI637ade732cd714.44440732.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `firstDoseid` (`firstDoseid`),
  ADD KEY `secondDoseid` (`secondDoseid`),
  ADD KEY `boosterDoseid` (`boosterDoseid`);

--
-- Indexes for table `booster_dose`
--
ALTER TABLE `booster_dose`
  ADD PRIMARY KEY (`booster_dose_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `first_dose`
--
ALTER TABLE `first_dose`
  ADD PRIMARY KEY (`first_dose_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `second_dose`
--
ALTER TABLE `second_dose`
  ADD PRIMARY KEY (`second_dose_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`);

--
-- Indexes for table `user_login_history`
--
ALTER TABLE `user_login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_vaccine`
--
ALTER TABLE `user_vaccine`
  ADD PRIMARY KEY (`user_vaccine_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `firstDoseid` (`firstDoseid`),
  ADD KEY `secondDoseid` (`secondDoseid`),
  ADD KEY `boosterDoseid` (`boosterDoseid`);

--
-- Indexes for table `user_vaccine_history`
--
ALTER TABLE `user_vaccine_history`
  ADD PRIMARY KEY (`user_vaccine_history_id`),
  ADD KEY `firstDoseid` (`firstDoseid`),
  ADD KEY `secondDoseid` (`secondDoseid`),
  ADD KEY `boosterDoseid` (`boosterDoseid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `booster_dose`
--
ALTER TABLE `booster_dose`
  MODIFY `booster_dose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `first_dose`
--
ALTER TABLE `first_dose`
  MODIFY `first_dose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `second_dose`
--
ALTER TABLE `second_dose`
  MODIFY `second_dose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_login_history`
--
ALTER TABLE `user_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_vaccine`
--
ALTER TABLE `user_vaccine`
  MODIFY `user_vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_vaccine_history`
--
ALTER TABLE `user_vaccine_history`
  MODIFY `user_vaccine_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `archive_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_login` (`user_login_id`),
  ADD CONSTRAINT `archive_ibfk_2` FOREIGN KEY (`firstDoseid`) REFERENCES `first_dose` (`first_dose_id`),
  ADD CONSTRAINT `archive_ibfk_3` FOREIGN KEY (`secondDoseid`) REFERENCES `second_dose` (`second_dose_id`),
  ADD CONSTRAINT `archive_ibfk_4` FOREIGN KEY (`boosterDoseid`) REFERENCES `booster_dose` (`booster_dose_id`);

--
-- Constraints for table `booster_dose`
--
ALTER TABLE `booster_dose`
  ADD CONSTRAINT `booster_dose_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_login` (`user_login_id`);

--
-- Constraints for table `first_dose`
--
ALTER TABLE `first_dose`
  ADD CONSTRAINT `first_dose_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_login` (`user_login_id`);

--
-- Constraints for table `second_dose`
--
ALTER TABLE `second_dose`
  ADD CONSTRAINT `second_dose_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_login` (`user_login_id`);

--
-- Constraints for table `user_vaccine`
--
ALTER TABLE `user_vaccine`
  ADD CONSTRAINT `user_vaccine_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_login` (`user_login_id`),
  ADD CONSTRAINT `user_vaccine_ibfk_2` FOREIGN KEY (`firstDoseid`) REFERENCES `first_dose` (`first_dose_id`),
  ADD CONSTRAINT `user_vaccine_ibfk_3` FOREIGN KEY (`secondDoseid`) REFERENCES `second_dose` (`second_dose_id`),
  ADD CONSTRAINT `user_vaccine_ibfk_4` FOREIGN KEY (`boosterDoseid`) REFERENCES `booster_dose` (`booster_dose_id`);

--
-- Constraints for table `user_vaccine_history`
--
ALTER TABLE `user_vaccine_history`
  ADD CONSTRAINT `user_vaccine_history_ibfk_1` FOREIGN KEY (`firstDoseid`) REFERENCES `first_dose` (`first_dose_id`),
  ADD CONSTRAINT `user_vaccine_history_ibfk_2` FOREIGN KEY (`secondDoseid`) REFERENCES `second_dose` (`second_dose_id`),
  ADD CONSTRAINT `user_vaccine_history_ibfk_3` FOREIGN KEY (`boosterDoseid`) REFERENCES `booster_dose` (`booster_dose_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
