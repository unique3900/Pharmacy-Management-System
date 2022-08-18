-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2022 at 04:24 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temporary_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `dob`, `designation`, `permanent_address`, `temporary_address`, `password`, `gender`) VALUES
(5, 'Samyok limb', 'limbu1@gmail.com', '9803377892', '2022-08-11', 'Admin', 'Thechambu Taplejung', 'Sallaghari Bhaktapur', '$2y$10$XcHE5ALGzypYIfKulb4/Ze0ZcnIprShVwr/S6BDT1B2bmv5UGTzpC', 'male'),
(6, 'Parashar Neupane', 'gorkha3900@gmail.com', '9803377892', '2002-02-05', 'Admin', 'Neupane Gaun Duwakot', '', '$2y$10$iemA7bgLaqgD1.pv6wOJiuDWCROL.qjuQ.tj172g6nacfHFvK5WFy', 'male');

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
(1, ''),
(2, 'Bajra Suppliers'),
(3, 'Subodh Medicals Pvt Ltd'),
(4, 'Bhisma Suppliers co.');

-- --------------------------------------------------------

--
-- Table structure for table `leaverequests`
--

CREATE TABLE `leaverequests` (
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

INSERT INTO `leaverequests` (`u_id`, `leave_id`, `Name`, `Reason`, `submitted_date`, `Date`, `end_date`, `status`) VALUES
(1, 0, '', '', '', '', '', 1),
(7, 2, 'Komal Thapa', 'mamaghar janu parne kam cha mero so accept please', '', '2022-08-05', '2022-08-06', 1),
(8, 2, 'Komal Thapa', 'Upachar', '2022/08/04', '2022-08-06', '2022-08-06', 1),
(9, 2, 'Komal Thapa', 'I wanna Go Home', '2022/08/04', '2022-08-18', '2022-08-19', 1),
(10, 2, 'Komal Thapa', 'Party', '2022/08/04', '2022-08-12', '2022-08-13', 2),
(11, 2, 'Komal Thapa', 'Gaun', '2022/08/05', '2022-08-06', '2022-08-13', 1),
(12, 2, 'Komal Thapa', 'Joro aayo', '2022/08/05', '2022-08-06', '2022-08-07', 0),
(13, 7, 'Krishna Kami', 'I have my personal issue going on.please Grant me a day of leave', '2022/08/13', '2022-08-13', '2022-08-15', 1),
(14, 4, 'Krishna Kami', 'Teej Shopping', '2022/08/13', '2022-08-20', '2022-08-21', 2),
(15, 3, 'Khaldo pande', 'Daar Karyakram', '2022/08/13', '2022-08-13', '2022-08-15', 1),
(16, 5, 'Chameli Koirala', 'Corona Booster Dose Booking', '2022/08/13', '2022-08-20', '2022-08-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_record`
--

CREATE TABLE `medicine_record` (
  `id` int(11) NOT NULL,
  `med_name` varchar(255) NOT NULL,
  `med_type` varchar(255) NOT NULL,
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

INSERT INTO `medicine_record` (`id`, `med_name`, `med_type`, `date_of_purchase`, `expiry_date`, `total_purchase_amount`, `total_purchase_quantity`, `purchase_rate`, `total_payment`, `pending_payment`, `entered_by`, `seller`, `remaining_quantity`) VALUES
(11, 'Hansaplast(A350)', 'Implants', '2022-08-03', '2022-09-03', '700', '100', '7', '700', '0', 'Ramesh Koirala', 'Ram Kumar Thami', 0),
(13, 'Protogel(P009)', 'Tablet', '2022-08-04', '2022-08-06', '1000', '100', '010', '0900', '100', 'Champa Thapa', 'Ram Kumar Thami', 0),
(15, 'Beta2(B20)', 'Liquid', '2022-08-04', '2022-08-12', '1000', '10', '0100', '1000', '0', 'Champa Thapa', 'Ram', 0),
(16, 'Meta(P009)', 'Capsules', '2022-08-05', '2022-08-26', '1000', '100', '10', '600', '400', 'Komal Thapa', '', 0),
(18, 'Chwyanprash(Z001)', 'Suppliments', '2022-08-09', '2022-09-10', '2000', '10', '200', '2000', '0', 'Komal Thapa', '', 10),
(20, 'Crutch(Z001)', 'Body', '2022-08-09', '2030-11-21', '10000', '5', '2000', '10000', '0', 'Komal Thapa', '', 0),
(23, 'Horlicks(Z001)', 'Suppliments', '2022-08-10', '2022-08-20', '4000', '10', '400', '3000', '1000', 'Komal Thapa', 'Ram', 20),
(24, 'Sinex(P007)', 'Tablet', '2022-08-10', '2022-08-02', '400', '100', '4', '400', '0', 'Komal Thapa', 'Ram', 99),
(25, 'Protogel(B20)', 'Tablet', '2022-08-10', '2022-08-08', '20', '10', '2', '20', '0', 'Komal Thapa', 'Ram', 10),
(26, 'Protogel(P009)', 'Tablet', '2022-08-10', '2022-08-08', '1', '01', '01', '01', '0', 'Komal Thapa', 'Ram', 1),
(28, 'Horlicks(Z001)', 'Liquid', '2022-08-10', '2022-08-12', '121', '011', '011', '0121', '0', 'Chameli Koirala', 'Ram', 20),
(31, 'Zandu Bam(Z001)', 'Gel', '2022-08-20', '2022-08-27', '150', '10', '15', '100', '50', 'Komal Thapa', 'Ram', 10),
(32, 'VicksInhaler(P007)', 'Inhalers', '2022-08-13', '2022-08-31', '1000', '0100', '10', '1000', '0', 'Komal Thapa', 'Ram', 0);

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
(1, 'Liquid'),
(2, 'Tablet'),
(3, 'Capsules'),
(4, 'Drops'),
(5, 'Inhalers'),
(6, 'Injections'),
(7, 'Implants or patches'),
(9, 'Soluble'),
(10, 'Suppliments'),
(11, 'Injection'),
(12, 'Churan'),
(13, 'Gel'),
(14, 'Body Support'),
(15, 'Hair Care');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temporary_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `name`, `email`, `phone`, `dob`, `designation`, `permanent_address`, `temporary_address`, `password`, `gender`) VALUES
(1, 'Komal Thapa', 'komalt@gmail.com', '9803705640', '2022-08-02', 'Pharmacist', 'Bombay', '', '$2y$10$sG3deTnWRrzW9ZEf1/u9xOiqL7IHehv20JjBVEeIQhN.zvPQiMsS2', 'female'),
(2, 'Kishna Khadka', 'kdkkrishna@gmail.com', '9803377892', '2022-08-05', 'Pharmacist', 'Thechambu Taplejung', 'Sallaghari Bhaktapur', '$2y$10$b6lVQOWaYBUPV1ln6dIp.ubMgZJLB.AKx4F9NmcQwWRYpWRFeF6ia', 'male'),
(3, 'Khaldo pande', 'khaldo1@gmail.com', '9803377892', '2022-08-03', 'Pharmacist', 'Kamalbinayak', '', '$2y$10$intucBLe1NxbR6skylp76ud7z2QZ/YEFDeN/ABcUy3868iz8x5eA6', 'others'),
(4, 'Krishna Kami', 'kami12@gmail.com', '9803377892', '2022-08-09', 'Pharmacist', 'Kamalbinayak', 'Sallaghari Bhaktapur', '$2y$10$D.nb4Q5zb7Z/ZjThimSGaOcnk1NxMRDeec3HUBFX5KVcmM9gLdc7i', 'male'),
(5, 'Chameli Koirala', 'chamelio12@yahoo.co', '9803377892', '2022-08-10', 'Pharmacist', 'Neupane Gaun Duwakot', 'Koteshwor Kathmandu', '$2y$10$FWX/BirRChjE.pmDiaCaQ.WJslwqrDDtV1d6.PXBZAf3/GRD2AEUa', 'female'),
(6, 'Hari Sharan Basnet', 'basnethari69@hotmail.com', '9861488688', '2004-06-15', 'Pharmacist', 'barpak Gorkha', '', '$2y$10$ktDJuH7fiwxR6urJZ2rQWOsrgPD06j1.jRrDxs5dRZnbiK3amu0yW', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `sale_record`
--

CREATE TABLE `sale_record` (
  `id` int(11) NOT NULL,
  `Medicine_Name` varchar(255) NOT NULL,
  `total_sale` bigint(255) NOT NULL,
  `profit_on_sale` bigint(255) NOT NULL,
  `entered_by` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_record`
--

INSERT INTO `sale_record` (`id`, `Medicine_Name`, `total_sale`, `profit_on_sale`, `entered_by`, `date`) VALUES
(1, 'Citamol', 20000, 120, 'Keshab', '2022-05-31'),
(2, 'Hansaplast', 1000, 900, 'Ramesh Koirala', '2022-06-01'),
(3, 'Dcold(A300)', 150, 50, 'Ramesh Koirala', '2022-08-03'),
(4, 'Dcold(A300)', 11880, 1980, 'Ramesh Koirala', '2022-08-03'),
(5, 'Hansaplast(A4)', 120000, 70000, 'Ramesh Koirala', '2022-08-03'),
(6, 'Dcold(A300)', 120, 20, 'Ramesh Koirala', '2022-08-03'),
(7, 'Hansaplast(A350)', 1500, 800, 'Ramesh Koirala', '2022-08-03'),
(8, 'Dcold(A300)', 1650, 1540, 'Champa Thapa', '2022-08-04'),
(9, 'Dcold(A300)', 9000, -1000, 'Champa Thapa', '2022-08-04'),
(10, 'Dcold(A300)', 200, -800, 'Champa Thapa', '2022-08-04'),
(11, 'Pantop(P009)', 2500, 1250, 'Komal Thapa', '2022-08-04'),
(12, 'Protogel(P009)', 1200, 400, 'Komal Thapa', '2022-08-04'),
(13, 'Protogel(P009)', 228, 38, 'Komal Thapa', '2022-08-04'),
(14, 'Protogel(P009)', 12, 2, 'Komal Thapa', '2022-08-04'),
(15, 'Horlicks(P007)', 4800, 1200, 'Komal Thapa', '2022-08-04'),
(16, 'Beta2(B20)', 10000, 5000, 'Komal Thapa', '2022-08-05'),
(17, 'Meta(P009)', 1200, 200, 'Komal Thapa', '2022-08-05'),
(18, 'Crutch(Z001)', 4800, 800, 'Komal Thapa', '2022-08-09'),
(19, 'Crutch(Z001)', 7200, 1200, 'Komal Thapa', '2022-08-09'),
(20, 'Horlicks(Z001)', 1200, 1189, 'Komal Thapa', '2022-08-13'),
(21, 'Horlicks(Z001)', 100, 89, 'Komal Thapa', '2022-08-13'),
(22, 'Sinex(P007)', 111, 107, 'Komal Thapa', '2022-08-13'),
(23, 'VicksInhaler(P007)', 400, 300, 'Komal Thapa', '2022-08-13'),
(24, 'VicksInhaler(P007)', 80, 60, 'Komal Thapa', '2022-08-13'),
(25, 'VicksInhaler(P007)', 3872, 2992, 'Komal Thapa', '2022-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `supp_record`
--

CREATE TABLE `supp_record` (
  `supp_id` int(11) NOT NULL,
  `supp_name` varchar(255) NOT NULL,
  `com_name` varchar(255) NOT NULL,
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
(2, 'Ram Kumar Thami', '', '2022-08-23', '9803705640', '9809008765', 'himasa1291@altpano.com', 'Baneshwor Ktm', 'Madhyapur ThimiBode'),
(4, 'Hariram Dahal', 'Bhisma', '2022-08-11', '9843311118', '0156907892', 'dahalhari@subodh.co.np', 'Duwakot Bhaktapur', 'Sallaghari '),
(5, 'Bishnu Tuladhar', 'Bhisma', '2022-08-04', '9832456781', '0900876511', 'bishnut@gmail.com', 'Kupondol', ''),
(6, 'Uddhav Manandhar', 'Bhisma', '2022-08-13', '9808856765', '9809008256', 'uddhavmdr89@yahoo.com', 'Kupondol', ''),
(7, 'Utsav Kami', 'Subodh', '2022-08-13', '9803705640', '9809008256', 'utsab@hotbail.com', 'Kupondol', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_record`
--
ALTER TABLE `company_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `medicine_record`
--
ALTER TABLE `medicine_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_type`
--
ALTER TABLE `medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_record`
--
ALTER TABLE `sale_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supp_record`
--
ALTER TABLE `supp_record`
  ADD PRIMARY KEY (`supp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_record`
--
ALTER TABLE `company_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaverequests`
--
ALTER TABLE `leaverequests`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `medicine_record`
--
ALTER TABLE `medicine_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `medicine_type`
--
ALTER TABLE `medicine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_record`
--
ALTER TABLE `sale_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supp_record`
--
ALTER TABLE `supp_record`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
