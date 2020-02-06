-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 11:32 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `info_book`
--

CREATE TABLE `info_book` (
  `bookId` int(11) NOT NULL,
  `bookNo` varchar(32) NOT NULL,
  `bookName` varchar(64) NOT NULL,
  `bookISBN` varchar(32) NOT NULL,
  `bookPlace` varchar(255) NOT NULL,
  `bookCopy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_book`
--

INSERT INTO `info_book` (`bookId`, `bookNo`, `bookName`, `bookISBN`, `bookPlace`, `bookCopy`) VALUES
(1, 'D-2018-001', 'Love Me Right', '978-3-16-168510-11', 'Seoul', 4),
(2, 'D-2018-002', 'Plane Trigonometry', '978-3-16-168510-13', 'Marikina,Manila', 5),
(3, 'D-2018-003', 'English Language', '978-3-16-168510-8', 'Mandaluyong, Manila', 6),
(4, 'D-2018-004', 'English Reading', '978-3-16-168510-9', 'Mandaluyong Manila', 2),
(5, 'D-2018-005', 'Pagsulat', '978-3-16-168510-12', 'Quezon', 6),
(6, 'D-2018-006', 'Science and Health', '978-3-16-168510-15', 'Quezon', 6),
(7, 'D-2018-007', 'System Integration', '978-3-16-168510-2', 'San Jose, Bulacan', 5),
(8, 'D-2018-008', 'Web Development', '978-3-16-168510-3', 'San Jose, Bulacan', 4),
(9, 'D-2018-009', 'Logic 1', '978-3-16-168510-10', 'San Jose, Bulacan', 4),
(10, 'D-2018-010', 'Araling Panlipunan', '978-3-16-168510-6', 'Laguna', 1),
(11, '76', 'Dangerously', '978-3-16-168510-7', 'San Jose', 3),
(12, '123', 'Algebra', '978-3-16-168510-5', 'Zamboanga City', 3),
(13, '421', 'Princess and I', '978-3-16-168510-14', 'Manila', 3),
(14, '0909', 'sdkjfsdafagfwe444', '978-3-16-168510-4', 'retre', 2),
(15, '32432', 'sdf', '978-3-16-168510-16', 'dsfds', 3),
(16, 'D-2018-001', 'The Show', '978-3-16-168510-1', 'USA', 2),
(17, '38419', 'Science in our Daily Lives', '978-2-76-76242-15', 'Sampalok', 6),
(18, '9876', 'Science in our Daily Lives', '978-2-76-76242-15', 'Sampalok', 6),
(19, 'D-7648', 'Science in our Daily Lives', '978-2-76-76242-15', 'Sampalok', 6),
(20, 'DR-0067', 'Science in our Daily life', '978-3-16-168510-8', 'Sampalok', 3),
(21, 'DR-767373', 'science 2', '978-3-16-168510-26', 'Sampalok', 3),
(22, '88', 'science 2', '978-3-16-168510-86', 'dakfnadfn', 4),
(23, '98798', 'science 2', '42oy514u0591u3', 'dakfnadfn', 4),
(24, '8275', 'kjhgjgnld', '978-3-16-168510-87', 'dkjgndlgnad;', 3),
(25, '83759135', 'alfnlkenfkw', '318571385', 'amfnlasf', 4);

-- --------------------------------------------------------

--
-- Table structure for table `info_bookaut`
--

CREATE TABLE `info_bookaut` (
  `bookAutId` int(11) NOT NULL,
  `bookAut` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookaut`
--

INSERT INTO `info_bookaut` (`bookAutId`, `bookAut`) VALUES
(1, 'EXO'),
(2, 'John Deep'),
(3, 'Rocky Da Rock'),
(4, 'Ian Joy Sand'),
(5, 'John Myler'),
(6, 'Lina Luna'),
(7, 'Jerson Maneja'),
(8, 'RJ Lagang'),
(9, 'Janeth Marzan'),
(10, 'Bebith Glico'),
(11, 'MiniiMickkii'),
(12, 'Marimar G. Siglor'),
(13, 'Mackie Lamasan'),
(14, 'dsf'),
(15, 'dsfds'),
(16, 'erewrwe'),
(17, 'John Weather'),
(18, 'Jay Layo'),
(19, 'lekfknalkfn'),
(20, 'adkgnkjg'),
(21, 'kdjafnlsnfslkf');

-- --------------------------------------------------------

--
-- Table structure for table `info_bookcat`
--

CREATE TABLE `info_bookcat` (
  `bookCatId` int(11) NOT NULL,
  `bookCat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookcat`
--

INSERT INTO `info_bookcat` (`bookCatId`, `bookCat`) VALUES
(1, 'English'),
(2, 'Science'),
(3, 'Mathematics'),
(4, 'Filipino'),
(5, 'Drama'),
(6, 'History'),
(7, 'Novel'),
(8, 'Technology'),
(9, 'Engineering'),
(10, 'Philosophy'),
(11, 'Logic'),
(12, 'Programming'),
(13, 'Physical Fitness'),
(14, 'Humanities and Society'),
(15, 'Agriculture');

-- --------------------------------------------------------

--
-- Table structure for table `info_bookjunc`
--

CREATE TABLE `info_bookjunc` (
  `juncId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `bookAutId` int(11) NOT NULL,
  `bookCatId` int(11) NOT NULL,
  `bookLostId` int(11) NOT NULL,
  `bookPubId` int(11) NOT NULL,
  `bookStatId` int(11) NOT NULL,
  `bookYearId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookjunc`
--

INSERT INTO `info_bookjunc` (`juncId`, `bookId`, `bookAutId`, `bookCatId`, `bookLostId`, `bookPubId`, `bookStatId`, `bookYearId`) VALUES
(1, 1, 1, 7, 0, 1, 2, 1),
(2, 2, 2, 9, 0, 2, 2, 2),
(3, 3, 3, 1, 0, 3, 2, 3),
(4, 4, 4, 1, 0, 3, 2, 4),
(5, 5, 5, 4, 0, 3, 2, 3),
(6, 6, 6, 2, 0, 3, 2, 5),
(7, 7, 7, 8, 0, 3, 2, 6),
(8, 8, 8, 12, 0, 3, 2, 7),
(9, 9, 9, 11, 0, 3, 2, 5),
(10, 10, 10, 6, 0, 3, 2, 3),
(11, 11, 11, 7, 0, 4, 2, 5),
(12, 12, 12, 3, 0, 5, 2, 8),
(13, 13, 13, 7, 0, 6, 2, 9),
(14, 14, 14, 1, 0, 7, 2, 10),
(15, 15, 15, 1, 0, 8, 2, 11),
(16, 16, 17, 7, 0, 10, 2, 5),
(17, 24, 20, 2, 0, 15, 2, 9),
(18, 25, 21, 2, 0, 16, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `info_booklost`
--

CREATE TABLE `info_booklost` (
  `bookLostid` int(11) NOT NULL,
  `bookLost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_bookpub`
--

CREATE TABLE `info_bookpub` (
  `bookPubId` int(11) NOT NULL,
  `bookPub` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookpub`
--

INSERT INTO `info_bookpub` (`bookPubId`, `bookPub`) VALUES
(1, 'SM Ent.'),
(2, 'Cherry Blossom'),
(3, 'DepEd'),
(4, 'Cherry'),
(5, 'Zamboanga City'),
(6, 'ABS CBN'),
(7, 'dsfds'),
(8, 'sdf'),
(9, 'wer'),
(10, 'Harmony Pub.'),
(11, 'Hanger'),
(12, 'Hammer Pub'),
(13, 'Hanner Pub'),
(14, 'kgnskgns'),
(15, 'ldkgnldg'),
(16, 'dlknfak');

-- --------------------------------------------------------

--
-- Table structure for table `info_bookstat`
--

CREATE TABLE `info_bookstat` (
  `bookStatId` int(11) NOT NULL,
  `bookStat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookstat`
--

INSERT INTO `info_bookstat` (`bookStatId`, `bookStat`) VALUES
(1, 'Old'),
(2, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `info_bookyear`
--

CREATE TABLE `info_bookyear` (
  `bookYearId` int(11) NOT NULL,
  `bookYear` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_bookyear`
--

INSERT INTO `info_bookyear` (`bookYearId`, `bookYear`) VALUES
(1, '2013'),
(2, '2016'),
(3, '2001'),
(4, '2000'),
(5, '2015'),
(6, '2018'),
(7, '2017'),
(8, '2014'),
(9, '2011'),
(10, '454'),
(11, 'sdf'),
(12, 'ewr'),
(13, '2010'),
(14, '291');

-- --------------------------------------------------------

--
-- Table structure for table `info_borrowed`
--

CREATE TABLE `info_borrowed` (
  `borrowedId` int(11) NOT NULL,
  `borrowedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_borrowed`
--

INSERT INTO `info_borrowed` (`borrowedId`, `borrowedDate`) VALUES
(1, '2018-11-13'),
(2, '2018-11-16'),
(3, '2018-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `info_borrowedjunc`
--

CREATE TABLE `info_borrowedjunc` (
  `borrowedjuncId` int(11) NOT NULL,
  `borrowerId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `borrowedId` int(11) NOT NULL,
  `returnId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_borrowedjunc`
--

INSERT INTO `info_borrowedjunc` (`borrowedjuncId`, `borrowerId`, `bookId`, `borrowedId`, `returnId`) VALUES
(1, 9, 1, 1, 1),
(2, 9, 3, 1, 1),
(3, 9, 4, 1, 1),
(4, 9, 6, 1, 1),
(5, 9, 3, 1, 1),
(6, 9, 1, 1, 1),
(7, 9, 2, 1, 1),
(8, 9, 1, 1, 1),
(9, 9, 2, 1, 2),
(10, 9, 6, 1, 3),
(11, 9, 8, 1, 3),
(12, 10, 1, 2, 3),
(13, 10, 2, 2, 3),
(14, 10, 1, 2, 3),
(15, 10, 2, 2, 3),
(16, 10, 1, 2, 3),
(17, 10, 9, 2, 4),
(18, 10, 1, 2, 3),
(19, 13, 1, 2, 3),
(20, 13, 2, 2, 4),
(21, 13, 3, 2, 4),
(22, 22, 11, 2, 4),
(23, 22, 10, 2, 4),
(24, 22, 9, 2, 3),
(25, 9, 2, 3, 4),
(26, 9, 4, 3, 4),
(27, 9, 9, 3, 4),
(28, 9, 11, 3, 4),
(29, 9, 6, 3, 4),
(30, 9, 16, 3, 4),
(31, 9, 12, 3, 4),
(32, 9, 10, 3, 4),
(33, 9, 11, 3, 4),
(34, 9, 3, 3, 4),
(35, 9, 16, 3, 4),
(36, 9, 12, 3, 4),
(37, 9, 6, 3, 4),
(38, 9, 1, 3, 4),
(39, 9, 1, 3, 4),
(40, 9, 6, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `info_borrower`
--

CREATE TABLE `info_borrower` (
  `borrowerId` int(11) NOT NULL,
  `studentid` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `middlename` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_borrower`
--

INSERT INTO `info_borrower` (`borrowerId`, `studentid`, `firstname`, `middlename`, `lastname`, `phone`, `address`) VALUES
(9, 'c-2018-118', 'James Bryan', 'dsfdsf', 'fgfd', '09468498435', 'P-3 Aurelio san Dinagat Island'),
(10, 'c-2018-119', 'Jhunmar', 'C', 'Baguhin', '09126466464', 'P-3 Aurelio San Jose Dinagat Island'),
(11, 'c-2018-120', 'clark', 'O', 'Acevedo', '09126746469', 'P-6 Poblacion San Jose Dinagat Island'),
(12, 'c-121', 'Jerlyn', 'C', 'Olivan', '09107472431', 'P-1 St. Cruz San Jose Dinagat Island'),
(13, 'c-2018-122', 'Reszil', 'T.', 'Rusiana', '09124746745', 'P-5 ferdinand Basilisa Dinagat Island'),
(14, 'c-2018-123', 'Russelle', 'D', 'Biare', '09126676786', 'P-5 Aurelio San Jose Dinagat Island'),
(15, 'c-2018-124', 'Alexandri', 'O', 'Maneja', '09127737440', 'P-5 Aurelio San Jose Dinagat Island'),
(16, 'c-2018-125', 'Sm', 'G', 'Acain', '09126486840', 'P-1 Poblacion San Jose Dinagat Island'),
(17, 'c-2018-126', 'Cloudine', 'N', 'Salac', '09103748449', 'P-5Aurelio San Jose Dinagat Island'),
(18, 'c-2018-127', 'Milgen', 'H', 'Rico', '09103474774', 'P-1 Don Ruben San Jose Dinagat Island'),
(19, 'c-2018-300', 'Sarah Jane', 'O', 'Gumolon', '09107773483', 'P-5 JUstiniana Edera San jose Dinagat Island'),
(20, 'C-2016-145', 'Marimar ', 'G. ', 'Siglor', '09461898755', 'P-7 Mabini San Jose Dinagat Islands'),
(21, 'c-2018-001', 'Jae', 'D,', 'Curay', '092615372', 'Poblacion'),
(22, 'c-2016-102', 'Marimar', 'G', 'Siglor', '09461898755', 'P-7 Mabini San Jose Dinagat Islands'),
(23, 'C-2016-254', 'Rogelio ', 'T', 'Canete', '09346576848', 'P-4 Aurelio San Jose Dinagat Islands'),
(24, 'C-2016-085', 'Marimar', 'Gamo', 'Siglor', '09461898755', 'P-7 Mabini San Jose Dinagat Islands'),
(25, 'wr32', 'ew', 'ewr', 'wer', 'wer', 'wr23423'),
(26, 'ewr', 'wer', 'wer', 'wer324234', 'ewrwerwe', 'erewrwer');

-- --------------------------------------------------------

--
-- Table structure for table `info_borrowerjunc`
--

CREATE TABLE `info_borrowerjunc` (
  `borrowerjuncId` int(11) NOT NULL,
  `borrowerId` int(11) NOT NULL,
  `levelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_borrowerjunc`
--

INSERT INTO `info_borrowerjunc` (`borrowerjuncId`, `borrowerId`, `levelId`) VALUES
(9, 9, 1),
(10, 10, 6),
(11, 11, 6),
(12, 12, 6),
(13, 13, 1),
(14, 14, 6),
(15, 15, 1),
(16, 16, 6),
(17, 17, 6),
(18, 18, 6),
(19, 19, 1),
(20, 20, 6),
(21, 21, 6),
(22, 22, 1),
(23, 23, 6),
(24, 24, 4),
(25, 25, 1),
(26, 26, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_level`
--

CREATE TABLE `info_level` (
  `levelId` int(11) NOT NULL,
  `levelName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_level`
--

INSERT INTO `info_level` (`levelId`, `levelName`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10'),
(5, 'Grade 11'),
(6, 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `info_return`
--

CREATE TABLE `info_return` (
  `returnId` int(11) NOT NULL,
  `returnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_return`
--

INSERT INTO `info_return` (`returnId`, `returnDate`) VALUES
(1, '2018-11-13'),
(2, '2018-11-15'),
(3, '2018-11-16'),
(4, '2018-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `info_stat`
--

CREATE TABLE `info_stat` (
  `statId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_tmp`
--

CREATE TABLE `info_tmp` (
  `tmpId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_user`
--

CREATE TABLE `info_user` (
  `userId` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `userfull` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_user`
--

INSERT INTO `info_user` (`userId`, `username`, `userpass`, `userfull`) VALUES
(1, 'admin', 'admin', 'SyrnujS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_book`
--
ALTER TABLE `info_book`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `info_bookaut`
--
ALTER TABLE `info_bookaut`
  ADD PRIMARY KEY (`bookAutId`);

--
-- Indexes for table `info_bookcat`
--
ALTER TABLE `info_bookcat`
  ADD PRIMARY KEY (`bookCatId`);

--
-- Indexes for table `info_bookjunc`
--
ALTER TABLE `info_bookjunc`
  ADD PRIMARY KEY (`juncId`);

--
-- Indexes for table `info_booklost`
--
ALTER TABLE `info_booklost`
  ADD PRIMARY KEY (`bookLostid`);

--
-- Indexes for table `info_bookpub`
--
ALTER TABLE `info_bookpub`
  ADD PRIMARY KEY (`bookPubId`);

--
-- Indexes for table `info_bookstat`
--
ALTER TABLE `info_bookstat`
  ADD PRIMARY KEY (`bookStatId`);

--
-- Indexes for table `info_bookyear`
--
ALTER TABLE `info_bookyear`
  ADD PRIMARY KEY (`bookYearId`);

--
-- Indexes for table `info_borrowed`
--
ALTER TABLE `info_borrowed`
  ADD PRIMARY KEY (`borrowedId`);

--
-- Indexes for table `info_borrowedjunc`
--
ALTER TABLE `info_borrowedjunc`
  ADD PRIMARY KEY (`borrowedjuncId`);

--
-- Indexes for table `info_borrower`
--
ALTER TABLE `info_borrower`
  ADD PRIMARY KEY (`borrowerId`);

--
-- Indexes for table `info_borrowerjunc`
--
ALTER TABLE `info_borrowerjunc`
  ADD PRIMARY KEY (`borrowerjuncId`);

--
-- Indexes for table `info_level`
--
ALTER TABLE `info_level`
  ADD PRIMARY KEY (`levelId`);

--
-- Indexes for table `info_return`
--
ALTER TABLE `info_return`
  ADD PRIMARY KEY (`returnId`);

--
-- Indexes for table `info_stat`
--
ALTER TABLE `info_stat`
  ADD PRIMARY KEY (`statId`);

--
-- Indexes for table `info_tmp`
--
ALTER TABLE `info_tmp`
  ADD PRIMARY KEY (`tmpId`);

--
-- Indexes for table `info_user`
--
ALTER TABLE `info_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_book`
--
ALTER TABLE `info_book`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `info_bookaut`
--
ALTER TABLE `info_bookaut`
  MODIFY `bookAutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `info_bookcat`
--
ALTER TABLE `info_bookcat`
  MODIFY `bookCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `info_bookjunc`
--
ALTER TABLE `info_bookjunc`
  MODIFY `juncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `info_booklost`
--
ALTER TABLE `info_booklost`
  MODIFY `bookLostid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_bookpub`
--
ALTER TABLE `info_bookpub`
  MODIFY `bookPubId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `info_bookstat`
--
ALTER TABLE `info_bookstat`
  MODIFY `bookStatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `info_bookyear`
--
ALTER TABLE `info_bookyear`
  MODIFY `bookYearId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `info_borrowed`
--
ALTER TABLE `info_borrowed`
  MODIFY `borrowedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `info_borrowedjunc`
--
ALTER TABLE `info_borrowedjunc`
  MODIFY `borrowedjuncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `info_borrower`
--
ALTER TABLE `info_borrower`
  MODIFY `borrowerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `info_borrowerjunc`
--
ALTER TABLE `info_borrowerjunc`
  MODIFY `borrowerjuncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `info_level`
--
ALTER TABLE `info_level`
  MODIFY `levelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `info_return`
--
ALTER TABLE `info_return`
  MODIFY `returnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `info_stat`
--
ALTER TABLE `info_stat`
  MODIFY `statId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_tmp`
--
ALTER TABLE `info_tmp`
  MODIFY `tmpId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_user`
--
ALTER TABLE `info_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
