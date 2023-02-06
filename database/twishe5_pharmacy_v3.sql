-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 09:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twishe5_pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `doctor_name` varchar(20) NOT NULL,
  `doctor_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `contact_number`, `address`, `doctor_name`, `doctor_address`) VALUES
(4, 'Kiran Suthar', '1234567690', 'Andheri East', 'Anshari', 'Andheri East'),
(6, 'Aditya', '7365687269', 'Virar West', 'Xyz', 'Virar West'),
(11, 'Shivam Tiwari', '6862369896', 'Dadar West', 'Dr Kapoor', 'Dadar East'),
(13, 'Varsha Suthar', '7622369694', 'Rani Station', 'Dr Ramesh', 'Rani Station'),
(14, 'Prakash Bhattarai', '9802851472', 'Pokhara-16, Dhikidada', 'Hari Bahadur', 'Matepani-12'),
(15, 'Michael Sinkolongo', '0979474203', 'Plot No. 1, Julia Chikamoneka, Kitwe, Zambia', 'Teddy Kajimoto', 'Plot No. 2, Julia Chikamoneka, Kitwe, Zambia');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(10) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_procedure`
--

CREATE TABLE `hospital_procedure` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `feeId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_provider`
--

CREATE TABLE `insurance_provider` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contactNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(50) NOT NULL,
  `invoiceNo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `invoiceDate` date NOT NULL,
  `patientId` int(50) NOT NULL,
  `taxAmount` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `isPaid` int(10) NOT NULL,
  `patientSchemeId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `feeId` int(10) DEFAULT NULL,
  `medicineId` int(10) DEFAULT NULL,
  `item` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `net_total` double NOT NULL DEFAULT 0,
  `invoice_date` date NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) DEFAULT NULL,
  `total_amount` double NOT NULL,
  `total_discount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `feeId`, `medicineId`, `item`, `description`, `unitPrice`, `quantity`, `net_total`, `invoice_date`, `customer_id`, `total_amount`, `total_discount`) VALUES
(2, NULL, NULL, '', '', '0.00', 0, 2626, '2021-10-19', 6, 2626, 0),
(3, NULL, NULL, '', '', '0.00', 0, 5282, '2023-01-03', 15, 5282, 0),
(4, NULL, NULL, '', '', '0.00', 0, 30, '2023-01-03', 15, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `invoiceId` int(50) NOT NULL,
  `feeId` int(10) DEFAULT NULL,
  `medicineId` int(10) DEFAULT NULL,
  `item` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `totalAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `job_position`
--

CREATE TABLE `job_position` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_position`
--

INSERT INTO `job_position` (`id`, `name`, `description`) VALUES
(1, 'Doctor', NULL),
(2, 'Lab Technician', NULL),
(3, 'Nurse', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `packing` varchar(20) NOT NULL,
  `generic_name` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `packing`, `generic_name`, `supplier_name`) VALUES
(0, 'None', '', '', ''),
(1, 'Nicip Plus', '10tab', 'Paracetamole', 'BDPL PHARMA'),
(2, 'Crosin', '10tab', 'Hdsgvkvajkcbja', 'Kiran Pharma'),
(4, 'Dolo 650', '15tab', 'paracetamole', 'BDPL PHARMA'),
(5, 'Gelusil', '10tab', 'mint fla', 'Desai Pharma'),
(6, 'Pandol', 'BOTTLE', 'Panadol', 'Kundananji Creations Limited');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `id` int(11) NOT NULL,
  `medicineId` int(10) NOT NULL,
  `batch_id` varchar(20) NOT NULL,
  `expiry_date` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mrp` double DEFAULT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`id`, `medicineId`, `batch_id`, `expiry_date`, `quantity`, `mrp`, `rate`) VALUES
(1, 2, 'CROS12', '12/34', 0, 2626, 26),
(2, 0, 'G327', '12/42', 0, 15, 12),
(3, 0, 'DOLO327', '01/23', 1, 30, 24),
(4, 0, 'NI325', '05/22', 3, 32.65, 28);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` int(10) DEFAULT NULL,
  `parentId` int(10) DEFAULT NULL,
  `profileId` int(10) NOT NULL,
  `idName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `icon`, `name`, `label`, `url`, `target`, `parentId`, `profileId`, `idName`) VALUES
(1, 'invoice', 'manage Invoice', 'Invoice', 'maange-invoice.php', 1, NULL, 19, NULL),
(2, 'fa fa-users', 'Customers', 'Customers', NULL, NULL, NULL, 17, NULL),
(3, 'fa fa-user-plus', 'Add Customer', 'Add Customer', 'add_customer', 1, 2, 17, NULL),
(4, 'fa fa-tablets', 'Medicines', 'Medicines', NULL, NULL, NULL, 18, NULL),
(5, 'fa fa-arrow-left', 'Manage Medicine', 'Manage Medicine', 'javascript:Medicines.viewMedicines()', 1, 4, 18, NULL),
(6, 'fa fa-plus', 'Manage Medicine Stock', 'Manage Medicine Stock', 'javascript:MedicinesStock.viewMedicinesStock()', 1, 4, 18, NULL),
(8, 'fa fa-arrow-down', 'Despense Medicine', 'Despense Medicine', NULL, NULL, NULL, 18, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_target`
--

CREATE TABLE `menu_target` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_target`
--

INSERT INTO `menu_target` (`id`, `name`) VALUES
(1, '_SELF'),
(2, '_BLANK');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(50) NOT NULL,
  `fileId` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `otherNames` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `contactNumber` varchar(20) DEFAULT NULL,
  `dateOfBirth` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `patient_scheme`
--

CREATE TABLE `patient_scheme` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `patientId` int(50) NOT NULL,
  `insuranceProviderId` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profileId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `profileId`) VALUES
(1, 'PRINT_INVOICE', 19);

-- --------------------------------------------------------

--
-- Table structure for table `procedures_taken`
--

CREATE TABLE `procedures_taken` (
  `id` int(11) NOT NULL,
  `patientId` int(10) NOT NULL,
  `procedureId` int(10) NOT NULL,
  `doctorId` int(10) DEFAULT NULL,
  `conductedBy` int(10) NOT NULL,
  `resultsDetails` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `dateConducted` date NOT NULL,
  `timeConducted` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `supplier_name` varchar(100) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `voucher_number` int(11) NOT NULL,
  `purchase_date` varchar(10) NOT NULL,
  `total_amount` double NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`supplier_name`, `invoice_number`, `voucher_number`, `purchase_date`, `total_amount`, `payment_status`) VALUES
('Kundananji Creations Limited', 11, 1, '2023-01-03', 180, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `patientId` int(50) NOT NULL,
  `receiptNo` varchar(1000) NOT NULL,
  `receiptDate` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `id` int(50) NOT NULL,
  `receiptId` int(50) NOT NULL,
  `item` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `invoiceDetailId` int(50) DEFAULT NULL,
  `feeId` int(10) DEFAULT NULL,
  `medicineId` int(50) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regular_checkups`
--

CREATE TABLE `regular_checkups` (
  `id` int(11) NOT NULL,
  `patientId` int(10) NOT NULL,
  `conductedBy` int(10) NOT NULL,
  `temperature` varchar(50) NOT NULL,
  `bloodPressure` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `other` text DEFAULT NULL,
  `dateTaken` date NOT NULL,
  `timeTaken` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `customer_id` int(11) NOT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `batch_id` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `mrp` double DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`customer_id`, `invoice_number`, `medicine_name`, `batch_id`, `expiry_date`, `quantity`, `mrp`, `discount`, `total`) VALUES
(15, '4', 'Dolo 650', 'DOLO327', '01/23', 1, 30, '0.00', '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(15) NOT NULL,
  `position` int(10) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `nationaility` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `manNo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(0, 'Inactive'),
(1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `name`, `email`, `contact_number`, `address`) VALUES
(1, 'Desai Pharma', 'desai@gmail.com', '9948724242', 'Mahim East'),
(2, 'BDPL PHARMA', 'bdpl@gmail.com', '8645632963', 'Santacruz West'),
(9, 'Kiran Pharma', 'kiranpharma@gmail.com', '7638683637', 'Andheri East'),
(10, 'Rsrnrnrndnn', 'ydj', '3737355538', '3fndfndfndndfnfdndfn'),
(11, 'Dfnsfndfndf', 'fnsn', '5475734385', 'Ndnss4yrhrhdhrdhrh'),
(12, 'SS Distributors', 'ssdis@gamil.com', '3867868752', 'Matunga West'),
(13, 'Avceve', 'ehh', '3466626226', 'Eteh266266262'),
(14, 'Hrshrhrjher', 'dzgdg', '4636347335', 'Rhrswjrnswjn'),
(15, 'Hmrxfmgtmt', 'trmtrm gm tr', '6553838835', '38ejtdjtdxetjdt'),
(20, 'Dtdxtkmtdshrrhhsrjrs', 'trmtrm gm tr', '6553838835', '38ejtdjtdxetjdt'),
(23, 'Fndn', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(24, 'Fndnbrwh', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(25, 'Jnentjrtj', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(26, 'Jerthjrtjtjr', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(30, 'Kundananji Creations Limited', 'info@kundananjicreations.com', '9794747203', 'MC 28PHI CHAINAMA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contactNumber` varchar(20) DEFAULT NULL,
  `isLoggedIn` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL,
  `profile` int(11) DEFAULT 17
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `password`, `address`, `email`, `contactNumber`, `isLoggedIn`, `status`, `profile`) VALUES
(1, 'admin', '', '', '$2y$10$e/G50.nC.a8cId1EBpJ77OvRE.pQdFBjeV0LwIHq76vSrYouUxQ8a', 'Plot No. 24, Riverside Extension, KITWE', 'info@pharmacy.com', '095323124', 0, 0, 17),
(2, 'michaelsinkolongo@gmail.com', 'Michael', 'Sinkolongo', '$2y$10$e/G50.nC.a8cId1EBpJ77OvRE.pQdFBjeV0LwIHq76vSrYouUxQ8a', 'MC 28\nPHI CHAINAMA', 'michaelsinkolongo@gmail.com', '0979474203', NULL, 0, 17),
(3, 'chanda', 'Chanda', 'Mulawisha', '$2y$10$e/G50.nC.a8cId1EBpJ77OvRE.pQdFBjeV0LwIHq76vSrYouUxQ8a', 'Lusaka', 'cmulawisha@gmail.com', '0979580238', 0, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `yesno`
--

CREATE TABLE `yesno` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yesno`
--

INSERT INTO `yesno` (`id`, `name`) VALUES
(0, 'No'),
(1, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `_alternative_profile`
--

CREATE TABLE `_alternative_profile` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `profileId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_alternative_profile`
--

INSERT INTO `_alternative_profile` (`id`, `userId`, `profileId`) VALUES
(1, 2, 18),
(2, 3, 17);

-- --------------------------------------------------------

--
-- Table structure for table `_profile`
--

CREATE TABLE `_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL,
  `isDefault` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_profile`
--

INSERT INTO `_profile` (`id`, `name`, `description`, `isActive`, `isDefault`) VALUES
(17, 'Admin', 'Default Administrator profile', 1, 1),
(18, 'Pharamacy User', 'User who dispenses medicine', 1, 0),
(19, 'Cashier', 'Issues Reciepts Upon Payment', 1, 0),
(20, 'Laboratory User', 'Use that carries out tests and Enters them into the system', 1, 0),
(21, 'Stock Management User', 'Managing the Stock  of drugs, equipment, etc.', 1, 0),
(22, 'Accountant', 'Manages the acounts of the hospital', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_user_tokens`
--

CREATE TABLE `_user_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_user_tokens`
--

INSERT INTO `_user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(12, '567f452ea94d1e9aabe53e0177724ac0', '663a624f1baacfce7b40a14f8103d27dde3e741585e710015edd232ad0db090b', 3, '2023-02-20 10:30:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hospital_procedure`
--
ALTER TABLE `hospital_procedure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feeId` (`feeId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `insurance_provider`
--
ALTER TABLE `insurance_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoiceNo` (`invoiceNo`),
  ADD KEY `isPaid` (`isPaid`),
  ADD KEY `patientSchemeId` (`patientSchemeId`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoiceId` (`invoiceId`),
  ADD KEY `feeId` (`feeId`),
  ADD KEY `medicineId` (`medicineId`);

--
-- Indexes for table `job_position`
--
ALTER TABLE `job_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batch_id` (`batch_id`),
  ADD KEY `medicineId` (`medicineId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentId` (`parentId`),
  ADD KEY `profileId` (`profileId`),
  ADD KEY `target` (`target`);

--
-- Indexes for table `menu_target`
--
ALTER TABLE `menu_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fileId` (`fileId`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `patient_scheme`
--
ALTER TABLE `patient_scheme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insuranceProviderId` (`insuranceProviderId`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profileId` (`profileId`);

--
-- Indexes for table `procedures_taken`
--
ALTER TABLE `procedures_taken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `procedureId` (`procedureId`),
  ADD KEY `doctorId` (`doctorId`),
  ADD KEY `conductedBy` (`conductedBy`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`voucher_number`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiptId` (`receiptId`),
  ADD KEY `invoiceDetailId` (`invoiceDetailId`),
  ADD KEY `feeId` (`feeId`),
  ADD KEY `medicineId` (`medicineId`);

--
-- Indexes for table `regular_checkups`
--
ALTER TABLE `regular_checkups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `conductedBy` (`conductedBy`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position` (`position`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `USERNAME` (`username`),
  ADD KEY `profile` (`profile`),
  ADD KEY `status` (`status`),
  ADD KEY `isLoggedIn` (`isLoggedIn`);

--
-- Indexes for table `yesno`
--
ALTER TABLE `yesno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_alternative_profile`
--
ALTER TABLE `_alternative_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_altprof_usrid` (`userId`),
  ADD KEY `fk_altprof_profid` (`profileId`);

--
-- Indexes for table `_profile`
--
ALTER TABLE `_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isActive` (`isActive`),
  ADD KEY `isDefault` (`isDefault`);

--
-- Indexes for table `_user_tokens`
--
ALTER TABLE `_user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tknsusr_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_provider`
--
ALTER TABLE `insurance_provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_position`
--
ALTER TABLE `job_position`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_target`
--
ALTER TABLE `menu_target`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_scheme`
--
ALTER TABLE `patient_scheme`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `voucher_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yesno`
--
ALTER TABLE `yesno`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_alternative_profile`
--
ALTER TABLE `_alternative_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_user_tokens`
--
ALTER TABLE `_user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fee`
--
ALTER TABLE `fee`
  ADD CONSTRAINT `fee_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `hospital_procedure`
--
ALTER TABLE `hospital_procedure`
  ADD CONSTRAINT `hospital_procedure_ibfk_1` FOREIGN KEY (`feeId`) REFERENCES `fee` (`id`),
  ADD CONSTRAINT `hospital_procedure_ibfk_2` FOREIGN KEY (`departmentId`) REFERENCES `department` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`isPaid`) REFERENCES `yesno` (`id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`patientSchemeId`) REFERENCES `patient_scheme` (`id`);

--
-- Constraints for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD CONSTRAINT `invoice_detail_ibfk_1` FOREIGN KEY (`invoiceId`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `invoice_detail_ibfk_2` FOREIGN KEY (`feeId`) REFERENCES `fee` (`id`),
  ADD CONSTRAINT `invoice_detail_ibfk_3` FOREIGN KEY (`medicineId`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD CONSTRAINT `medicines_stock_ibfk_1` FOREIGN KEY (`medicineId`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`parentId`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_ibfk_3` FOREIGN KEY (`profileId`) REFERENCES `_profile` (`id`),
  ADD CONSTRAINT `menu_ibfk_4` FOREIGN KEY (`target`) REFERENCES `menu_target` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `patient_scheme`
--
ALTER TABLE `patient_scheme`
  ADD CONSTRAINT `patient_scheme_ibfk_1` FOREIGN KEY (`insuranceProviderId`) REFERENCES `insurance_provider` (`id`),
  ADD CONSTRAINT `patient_scheme_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`profileId`) REFERENCES `_profile` (`id`);

--
-- Constraints for table `procedures_taken`
--
ALTER TABLE `procedures_taken`
  ADD CONSTRAINT `procedures_taken_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `procedures_taken_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `procedures_taken_ibfk_3` FOREIGN KEY (`procedureId`) REFERENCES `hospital_procedure` (`id`),
  ADD CONSTRAINT `procedures_taken_ibfk_4` FOREIGN KEY (`doctorId`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `procedures_taken_ibfk_5` FOREIGN KEY (`conductedBy`) REFERENCES `staff` (`id`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD CONSTRAINT `receipt_detail_ibfk_1` FOREIGN KEY (`receiptId`) REFERENCES `receipt` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_2` FOREIGN KEY (`invoiceDetailId`) REFERENCES `invoice_detail` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_3` FOREIGN KEY (`feeId`) REFERENCES `fee` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_4` FOREIGN KEY (`receiptId`) REFERENCES `receipt` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_5` FOREIGN KEY (`invoiceDetailId`) REFERENCES `invoice_detail` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_6` FOREIGN KEY (`feeId`) REFERENCES `fee` (`id`),
  ADD CONSTRAINT `receipt_detail_ibfk_7` FOREIGN KEY (`medicineId`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `regular_checkups`
--
ALTER TABLE `regular_checkups`
  ADD CONSTRAINT `regular_checkups_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `regular_checkups_ibfk_2` FOREIGN KEY (`conductedBy`) REFERENCES `staff` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`position`) REFERENCES `job_position` (`id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`profile`) REFERENCES `_profile` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`isLoggedIn`) REFERENCES `yesno` (`id`);

--
-- Constraints for table `_alternative_profile`
--
ALTER TABLE `_alternative_profile`
  ADD CONSTRAINT `fk_altprof_profid` FOREIGN KEY (`profileId`) REFERENCES `_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_altprof_usrid` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `_profile`
--
ALTER TABLE `_profile`
  ADD CONSTRAINT `_profile_ibfk_1` FOREIGN KEY (`isActive`) REFERENCES `yesno` (`id`),
  ADD CONSTRAINT `_profile_ibfk_2` FOREIGN KEY (`isDefault`) REFERENCES `yesno` (`id`);

--
-- Constraints for table `_user_tokens`
--
ALTER TABLE `_user_tokens`
  ADD CONSTRAINT `fk_tknsusr_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
