-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 10:44 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agro`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pcode` varchar(5) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `price` int(8) NOT NULL,
  `quantity` int(3) NOT NULL,
  `type` varchar(10) NOT NULL,
  `brand` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pcode`, `pname`, `price`, `quantity`, `type`, `brand`) VALUES
('17001', 'Agrimin', 1, 78, 'Fertilizer', 'Ferto'),
('17002', 'CFC', 5000, 100, 'Pesticide', 'Biofit'),
('17003', 'CFCP', 300, 90, 'Seeds', 'Gertyi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `agri_card` varchar(15) DEFAULT NULL,
  `contact_us` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `password`, `address`, `email`, `phone_no`, `agri_card`, `contact_us`) VALUES
('Chandra', 'Chandra', 'Chandra1234', 'k block ,mens hostel,vit', 'chandra@gmail.com', '9133094099', '1234-5678-5678', ''),
('Charan', 'Charan8', 'Charan8901', 'Vellore Institute of Technology', 'charan@gmail.com', '8948283983', '9423-4234-3431', ''),
('niha Moturu', 'Motu', 'MNiha81234', 'P and T colony 3, Back of high school road', 'moturu.niharika2017@vitstudent', '9182908783', '', ''),
('SaranyaSome', 'Saranya', 'Saranya890', 'Guntur,AP,India', 'saru@gmail.com', '8921321222', '7667-6565-6767', ''),
('SaiSathvic', 'Sathvic', 'Sathvic890', 'VIT University,Vellore', 'saisathvic@gmail.com', '7937293722', '4783-4224-4321', ''),
('Teja', 'Teja', 'Saiteja12', 'l block,mens hostel,vit', 'saiteja@gmail.com', '9876543210', '1234-1234-1234', ''),
('Vaishnavi Balaji', 'Vaishu', 'Vaishu123', 'Mani street,Kanchipuram,Tamil Nadu', 'vaish@gmail.com', '7010510834', '8594-5323-4355', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pcode`),
  ADD UNIQUE KEY `UNIPRONAME` (`pname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `UNIMAIL` (`email`),
  ADD UNIQUE KEY `UNIPHNO` (`phone_no`),
  ADD UNIQUE KEY `UNICARD` (`agri_card`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
