-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: *.dev
-- Generation Time: Apr 30, 2015 at 08:12 AM
-- Server version: 5.6.23
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `picpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `commentText` longtext NOT NULL,
  `imageID` int(11) NOT NULL,
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `commentText`, `imageID`, `commentDate`) VALUES
(19, 4, 'what do you think about my castle? pls reply', 33, '2015-04-29 10:39:04'),
(20, 4, 'I dont like this picture pls reply', 30, '2015-04-29 10:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `folderName` varchar(256) NOT NULL,
  `folderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`folderName`, `folderDate`) VALUES
('cats', '2015-04-29 07:06:12'),
('nature', '2015-04-29 11:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `imageID` int(11) NOT NULL,
  `imageFilename` text NOT NULL,
  `imageText` longtext NOT NULL,
  `folderName` text NOT NULL,
  `imageDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `imageFilename`, `imageText`, `folderName`, `imageDate`, `userID`) VALUES
(24, 'kGDE2ej4e7.jpg', 'This is kinnekulle', 'nature', '2015-04-29 06:59:35', 2),
(25, 'jSeTsHtKzu.jpg', 'This is a place where the train will come', 'nature', '2015-04-29 07:02:04', 2),
(26, 'hame1bglHv.jpg', 'The tower is big', 'nature', '2015-04-29 07:02:29', 2),
(27, '1aWbxXUshW.jpg', 'It is a watch!', 'nature', '2015-04-29 07:03:18', 2),
(28, 'Z3Bv5YN3to.jpg', 'A tree with a stick nailed to it', 'nature', '2015-04-29 07:03:47', 2),
(29, 'ngp1bq5bFL.jpg', 'This is a cool flower! I like this pic. I took it myself and it is a flower! Hello pls reply', 'nature', '2015-04-29 07:04:36', 2),
(30, 'oDK8ukPhHR.jpg', 'This is a scooter', 'nature', '2015-04-29 07:05:08', 2),
(31, '4KHnp2wPI9.gif', 'This cat is pretty cute', 'cats', '2015-04-29 07:06:12', 2),
(32, 'JkXkpXthQ0.gif', 'Black and white sea', 'nature', '2015-04-29 07:07:04', 2),
(33, 'NuOo8ucINc.jpg', 'hello this is castle', 'nature', '2015-04-29 10:38:43', 4),
(34, 'e1PQXyUTrw.jpg', 'hello', 'nature', '2015-04-29 11:11:03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL,
  `userName` text NOT NULL,
  `userEmail` text NOT NULL,
  `userPassword` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`folderName`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
