-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2018 at 04:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '3677b23baa08f74c28aba07f0cb6554e');

-- --------------------------------------------------------

--
-- Table structure for table `cdetails`
--

CREATE TABLE IF NOT EXISTS `cdetails` (
`ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `uimg` varchar(100) NOT NULL,
  `plan` varchar(20) NOT NULL,
  `pprice` int(11) NOT NULL,
  `proofno` varchar(30) NOT NULL,
  `proof1` varchar(30) NOT NULL,
  `proof2` varchar(30) NOT NULL,
  `caddress` varchar(200) NOT NULL,
  `haddress` varchar(200) NOT NULL,
  `rdate` date NOT NULL,
  `bdate` date NOT NULL,
  `multiLine` varchar(500) NOT NULL,
  `depatment` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cdetails`
--

INSERT INTO `cdetails` (`ID`, `fname`, `lname`, `uname`, `email`, `phone`, `uimg`, `plan`, `pprice`, `proofno`, `proof1`, `proof2`, `caddress`, `haddress`, `rdate`, `bdate`, `multiLine`, `depatment`) VALUES
(14, 'Bruno', 'Den', 'brunoden', 'bruno@mail.com', 2147483647, 'personal-user-illustration-@2x.png', 'Demo', 56000, '8505552', 'sample.pdf', 'sample.pdf', 'espp', 'Calfrn', '2018-10-03', '2018-10-31', 'THIS IS A DEMO TEXT', 'D'),
(15, 'John', 'Doe', 'johndoe', 'johndoe@mail.com', 2147483647, 'personal-user-illustration-@2x.png', 'Demo', 76000, '7805552', 'sample.pdf', 'sample.pdf', 'Demo Adr', 'Np', '2017-09-12', '2018-10-16', 'This is a demo text', 'D'),
(16, 'Tony', 'Stark', 'mrstark', 'tonystark@mail.com', 2147483647, 'personal-user-illustration-@2x.png', 'Plan B', 125600, '9200550', 'sample.pdf', 'sample.pdf', 'NYC', 'Malibu', '2016-05-11', '2018-10-01', 'This is a demo text', 'A'),
(17, 'Gwen ', 'Stacy', 'gwenn', 'gwenstacyn@mail.com', 2147483647, '41721329-female-user-icon-with-long-shadow-on-white-background.jpg', 'Platinum', 99999, '6900520', 'sample.pdf', 'sample.pdf', 'Demo comp', 'KML', '2018-10-04', '2019-10-05', 'Demo Demo Demo', 'C'),
(18, 'Harry', 'Den', 'harryden', 'harryden@mail.com', 236691353, 'personal-user-illustration-@2x.png', 'Premium', 199999, '1305035', 'sample.pdf', 'sample.pdf', 'Demo Address', 'Espnn', '2018-10-01', '2019-10-02', 'DEMO DEMO', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `contactno` varchar(11) NOT NULL,
  `posting_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `contactno`, `posting_date`) VALUES
(14, 'Christine', 'Gray', 'christt@ourmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '4545454554', '2018-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdetails`
--
ALTER TABLE `cdetails`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cdetails`
--
ALTER TABLE `cdetails`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
