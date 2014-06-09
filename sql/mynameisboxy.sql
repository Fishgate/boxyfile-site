-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2014 at 10:23 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mynameisboxy`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` text NOT NULL,
  `name` text NOT NULL,
  `company_name` text NOT NULL,
  `contact_number` text NOT NULL,
  `email_address` text NOT NULL,
  `delivery_address` text NOT NULL,
  `order_summery` text NOT NULL,
  `total` text NOT NULL,
  `date` text NOT NULL,
  `unix` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref`, `name`, `company_name`, `contact_number`, `email_address`, `delivery_address`, `order_summery`, `total`, `date`, `unix`) VALUES
(3, '#D3D944', 'Eugene', '', '000000', 'eugene@medfin.co.za', '333ff', '10 x Small File = R100.00\n', 'R100.00', '2013-05-22', '1369212282'),
(4, '#CEDEBB', 'A Oellermann', '', '0842783504', '4oellermann@gmail.com', '42 Boog Str\r\nSt Kilda\r\nBrackenfell\r\n7561', '2 x Small File Set = R240.00\n', 'R240.00', '2013-05-24', '1369396257'),
(5, '#8D317B', 'john', '', 'barny182@hotmail.com', 'barny182@hotmail.com', 'v3MyLy http://www.c1dOvW6eef5JOp8ApWjKQy5RO5mLafkc.com', '667047 x Inside Folder = R1000570.50\n795156 x Temporary Divider = R795156.00\n', 'R1795726.50', '2013-06-20', '1371746426'),
(6, '#20AEE3', '', '', '', '', '', '', 'R0.00', '2013-06-20', '1371746427'),
(7, '#0E6597', 'matt', '', 'barny182@hotmail.com', 'barny182@hotmail.com', 'Ur58Zx http://www.c1dOvW6eef5JOp8ApWjKQy5RO5mLafkc.com', '543215 x Inside Folder = R814822.50\n5097 x Temporary Divider = R5097.00\n', 'R819919.50', '2013-06-22', '1371938094'),
(8, '#32B30A', '', '', '', '', '', '', 'R0.00', '2013-06-22', '1371938096'),
(9, '#CD0069', 'Eugene', '', '0832263459', 'Eugene@medfin.co.za', '13Bordeaux', '010 x Small File Set = R1200.00\n10 x Large File Set = R1200.00\n', 'R2400.00', '2013-07-10', '1373451274'),
(10, '#2A084E', 'horny', '', 'barny182@hotmail.com', 'barny182@hotmail.com', 'jZWHWu http://www.MHyzKpN7h4ERauvS72jUbdI0HeKxuZom.com', '75887 x Inside Folder = R113830.50\n9218 x Temporary Divider = R9218.00\n', 'R123048.50', '2013-09-17', '1379450332'),
(11, '#149E96', '', '', '', '', '', '', 'R0.00', '2013-09-17', '1379450332'),
(12, '#72B32A', 'matt', '', 'dondy228@hotmail.com', 'dondy228@hotmail.com', '7Noj7n http://www.MHyzKpN7h4ERauvS72jUbdI0HeKxuZom.com', '14500 x Inside Folder = R21750.00\n7608 x Temporary Divider = R7608.00\n', 'R29358.00', '2013-11-02', '1383364478'),
(13, '#B7892F', '', '', '', '', '', '', 'R0.00', '2013-11-02', '1383364479'),
(14, '#2BCAB9', 'FgGGCqdFDno', '', 'barny182@hotmail.com', 'barny182@hotmail.com', 'MSNty2 http://www.MHyzKpN7h4ERauvS72jUbdI0HeKxuZom.com', '5520 x Inside Folder = R8280.00\n15098 x Temporary Divider = R15098.00\n', 'R23378.00', '2013-11-16', '1384557146'),
(15, '#371BCE', '', '', '', '', '', '', 'R0.00', '2013-11-16', '1384557147'),
(16, '#98DCE8', 'ronny', '', 'barny182@hotmail.com', 'barny182@hotmail.com', 'W59vxi http://www.c1dOvW6eef5JOp8ApWjKQy5RO5mLafkc.com', '95751 x Inside Folder = R143626.50\n2901 x Temporary Divider = R2901.00\n', 'R146527.50', '2013-11-22', '1385129058'),
(17, '#6EA2EF', '', '', '', '', '', '', 'R0.00', '2013-11-22', '1385129060'),
(18, '#28F0B8', 'Albert', '', '0219791445', 'wasjo3@gmail.com', '19 Lindenberg,\r\nValmary Park,\r\nDurbanville\r\n7550', '2 x Small File Set = R240.00\n', 'R240.00', '2014-05-29', '1401365657'),
(19, '#4DAA3D', 'Test Tester', '', '0841231234', 'mail@jdmarais.co.za', '8 Hadleigh\r\nHibiscus Street\r\nGordon''s Bay\r\n7140', '5 x Small File Set = R600.00\n5 x Large File Set = R600.00\n', 'R1200.00', '2014-05-30', '1401429941'),
(20, '#1D7F7A', 'Pieter', '', '0832263459', 'eugene@medfin.co.za', '13 Bordeaux ave, everglen', '300 x Small File = R3000.00\n200 x Large File = R3200.00\n200 x Small File Set = R24000.00\n50 x Holder Box = R1000.00\n', 'R31200.00', '2014-06-06', '1402043803');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `hash` text NOT NULL,
  `salt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `salt`) VALUES
(1, 'boxyadmin', '0f49cebc2a0f95a8bda3bdc222ffa5d3e69d3', '0f49c');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
