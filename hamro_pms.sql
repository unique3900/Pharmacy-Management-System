-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2022 at 02:22 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamro_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_record`
--

CREATE TABLE `company_record` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_record`
--

INSERT INTO `company_record` (`id`, `name`) VALUES
(5, 'Bhisma Suppliers co.'),
(6, 'Subodh Medicals Pvt Ltd');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `Emp_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temporary_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `Emp_id`, `name`, `email`, `phone`, `dob`, `designation`, `permanent_address`, `temporary_address`, `password`, `gender`, `profile_photo`) VALUES
(2, 1122, 'Samyok limbu', 'limbu1@gmail.com', '9803377898', '2022-09-05', 'Admin', 'Thechambu Taplejung', '', '$2y$10$Rq3ZNSsnwGLYkRwR1hGSl.gNjMbe3.Lo4cmDaNaIKgr9mP5LXd6l.', 'male', '3449-samyok.jpg'),
(3, 1144, 'Komal Thapa', 'komalt@gmail.com', '9803705640', '2022-09-05', 'Pharmacist', 'Kamalbinayak', '', '$2y$10$S4lDU8Sz4fFYbO.jNEpku.x336Z86ga2qc8unrAEQdQrpQcLtos.K', 'female', '6793-komal.jpg'),
(7, 11877, 'Ganesh Gaitonde', 'gaitondeganesh@gmail.com', '9803705640', '2022-09-06', 'Admin', 'Bombay Gopalmath', 'Kenya', '$2y$10$APm9KVvRGAeurSV9gyHZeOm018tL93mUCy3ycclZoKKgY5yA/z/Za', 'male', ''),
(9, 11234, 'Kushum Humagain', 'humagainkus@hotmail.com', '9843311112', '2022-09-06', 'Pharmacist', 'Neupane Gaun Duwakot', 'Jhaukhel', '$2y$10$yt5pbeOygGMuDBp23JK93O13IbpqqkvpeMInhM7F9XbDpsEr7gMhK', 'male', ''),
(10, 1134, 'Champa Thapa', 'champa2000@yahoo.com', '9843311115', '2022-09-07', 'Pharmacist', 'barpak Gorkha', 'Jhaukhel', '$2y$10$WDTVlhC/N.nGAty7eMypUehl8t5IUagXJHv9TpAcgAxs3Pvq.0pcm', 'female', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaverequests`
--

CREATE TABLE `leaverequests` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `submitted_date` varchar(255) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaverequests`
--

INSERT INTO `leaverequests` (`id`, `u_id`, `leave_id`, `Name`, `Reason`, `submitted_date`, `Date`, `end_date`, `status`) VALUES
(1, 1144, 3, 'Komal Thapa', 'Dashain Home Visit', '2022/09/07', '2022-09-08', '2022-09-24', 1),
(2, 1144, 3, 'Komal Thapa', 'Doctor Visit', '2022/09/07', '2022-09-24', '2022-09-24', 0),
(5, 11234, 9, 'Kushum Humagain', 'Hey', '2022/09/07', '2022-09-07', '2022-09-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_record`
--

CREATE TABLE `medicine_record` (
  `id` int(11) NOT NULL,
  `Medicine_id` int(11) NOT NULL,
  `med_name` varchar(255) NOT NULL,
  `med_type` int(255) NOT NULL,
  `date_of_purchase` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `total_purchase_amount` varchar(255) NOT NULL,
  `total_purchase_quantity` varchar(255) NOT NULL,
  `purchase_rate` varchar(255) NOT NULL,
  `total_payment` varchar(255) NOT NULL,
  `pending_payment` varchar(255) NOT NULL,
  `entered_by` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `remaining_quantity` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_record`
--

INSERT INTO `medicine_record` (`id`, `Medicine_id`, `med_name`, `med_type`, `date_of_purchase`, `expiry_date`, `total_purchase_amount`, `total_purchase_quantity`, `purchase_rate`, `total_payment`, `pending_payment`, `entered_by`, `seller`, `remaining_quantity`) VALUES
(2, 1111, 'Protogel(1111)', 4, '2022-09-07', '2022-09-24', '1221', '0111', '011', '0111', '1110', 'Komal Thapa', 'Ram', 0),
(4, 1122, 'Horlicks(1112)', 3, '2022-09-07', '2022-09-08', '1100', '011', '0100', '01000', '100', 'Komal Thapa', 'Uddhav', 0),
(5, 1134, 'Lizol(1134)', 8, '2022-09-07', '2024-12-19', '1200', '12', '100', '1000', '200', 'Komal Thapa', 'Ram', 12);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_type`
--

CREATE TABLE `medicine_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_type`
--

INSERT INTO `medicine_type` (`id`, `type`) VALUES
(1, 'Injection'),
(2, 'Hair Care'),
(3, 'Suppliments'),
(4, 'Tablets'),
(5, 'Body Support'),
(6, 'Herbal'),
(7, 'Body Gel'),
(8, 'Liquid');

-- --------------------------------------------------------

--
-- Table structure for table `sale_record`
--

CREATE TABLE `sale_record` (
  `id` int(11) NOT NULL,
  `Med_id` int(11) NOT NULL,
  `Medicine_Name` varchar(255) NOT NULL,
  `total_sale` bigint(255) NOT NULL,
  `profit_on_sale` bigint(255) NOT NULL,
  `entered_by` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_record`
--

INSERT INTO `sale_record` (`id`, `Med_id`, `Medicine_Name`, `total_sale`, `profit_on_sale`, `entered_by`, `date`) VALUES
(1, 1111, 'Protogel(1111)', 11100, 10000, 'Komal Thapa', '2022-09-07'),
(2, 1111, 'Protogel(1111)', 1221, 1100, 'Komal Thapa', '2022-09-07'),
(3, 1111, 'Protogel(1111)', 3630, 0, 'Komal Thapa', '2022-09-07'),
(4, 1111, 'Protogel(1111)', 33, 0, 'Komal Thapa', '2022-09-07'),
(5, 1122, 'Horlicks(1112)', 11110, 10110, 'Komal Thapa', '2022-09-07'),
(6, 1122, 'Horlicks(1112)', 120, 20, 'Komal Thapa', '2022-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `supp_record`
--

CREATE TABLE `supp_record` (
  `supp_id` int(11) NOT NULL,
  `supp_name` varchar(255) NOT NULL,
  `com_name` int(255) NOT NULL,
  `doe` varchar(255) NOT NULL,
  `sphone` varchar(255) NOT NULL,
  `cphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `taddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supp_record`
--

INSERT INTO `supp_record` (`supp_id`, `supp_name`, `com_name`, `doe`, `sphone`, `cphone`, `email`, `paddress`, `taddress`) VALUES
(3, 'Ram Kumar Thami', 5, '2022-09-04', '9809099868', '0156907892', 'ram13@abc.com', 'Baneshwor Ktm', 'Madhyapur Thimi'),
(5, 'Uddhav Manandhar', 6, '2022-09-07', '9809007811', '0156907892', 'uddhav33@yahoo.com', 'Kupondol', 'Sallaghari ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_record`
--
ALTER TABLE `company_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Emp_id` (`Emp_id`);

--
-- Indexes for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leavereq_fk` (`u_id`);

--
-- Indexes for table `medicine_record`
--
ALTER TABLE `medicine_record`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `med_name` (`med_name`),
  ADD UNIQUE KEY `Batch_no` (`Medicine_id`),
  ADD UNIQUE KEY `Medicine_id` (`Medicine_id`),
  ADD KEY `med_name_2` (`med_name`),
  ADD KEY `category_type_fk` (`med_type`);
ALTER TABLE `medicine_record` ADD FULLTEXT KEY `med_name_3` (`med_name`);
ALTER TABLE `medicine_record` ADD FULLTEXT KEY `med_name_4` (`med_name`);

--
-- Indexes for table `medicine_type`
--
ALTER TABLE `medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_record`
--
ALTER TABLE `sale_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salerec_fk` (`Med_id`);

--
-- Indexes for table `supp_record`
--
ALTER TABLE `supp_record`
  ADD PRIMARY KEY (`supp_id`),
  ADD KEY `company_name_fk` (`com_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_record`
--
ALTER TABLE `company_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaverequests`
--
ALTER TABLE `leaverequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicine_record`
--
ALTER TABLE `medicine_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicine_type`
--
ALTER TABLE `medicine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_record`
--
ALTER TABLE `sale_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supp_record`
--
ALTER TABLE `supp_record`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD CONSTRAINT `leavereq_fk` FOREIGN KEY (`u_id`) REFERENCES `employee` (`Emp_id`) ON DELETE CASCADE;

--
-- Constraints for table `medicine_record`
--
ALTER TABLE `medicine_record`
  ADD CONSTRAINT `category_type_fk` FOREIGN KEY (`med_type`) REFERENCES `medicine_type` (`id`);

--
-- Constraints for table `sale_record`
--
ALTER TABLE `sale_record`
  ADD CONSTRAINT `salerec_fk` FOREIGN KEY (`Med_id`) REFERENCES `medicine_record` (`Medicine_id`);

--
-- Constraints for table `supp_record`
--
ALTER TABLE `supp_record`
  ADD CONSTRAINT `company_name_fk` FOREIGN KEY (`com_name`) REFERENCES `company_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
