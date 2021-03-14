-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 08:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `Employee_ID` varchar(25) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `User_Type` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`Employee_ID`, `Fullname`, `User_Type`, `Password`, `Status`) VALUES
('192-168-3006', 'Renuel Rocela', 'Professor', '$2y$10$Xhtl9OcqLdeF/kOhg8KN6u93ucnHMxNCRpfJ.T.lWBjchFxeyJZaa', 'INACTIVE'),
('192-168-3469', 'Ralph Estiller', 'Dean', '$2y$10$Xhtl9OcqLdeF/kOhg8KN6u93ucnHMxNCRpfJ.T.lWBjchFxeyJZaa', 'ACTIVE'),
('192-168-3471', 'Roi Kagawad Vasquez', 'Professor', '$2y$10$opgzW55e/nXAs54gcbrhHevmnsI64AahakTrzFB.ANviGuDvVFdTy', 'ACTIVE'),
('192-168-3574', 'Jojie Zepeda', 'Professor', '$2y$10$Xhtl9OcqLdeF/kOhg8KN6u93ucnHMxNCRpfJ.T.lWBjchFxeyJZaa', 'ACTIVE'),
('192-168-4574', 'Anjeline N. Legaspi', 'Admin', '$2y$10$nP09Ph0F7FKlsFgiWui0fekzc4FqFvyFQ3JtqvxHSfOY.sCC5Ks6m', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `Faculty_ID` int(11) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Dean` varchar(50) NOT NULL,
  `School_Year` varchar(50) NOT NULL,
  `Semester` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`Faculty_ID`, `Fullname`, `Dean`, `School_Year`, `Semester`) VALUES
(1, 'Roi Kagawad Vasquez', 'Ralph Estiller', '2020-2021', 'Second'),
(3, 'Jojie Zepeda', 'Ralph Estiller', '2020-2021', 'Second'),
(4, 'Renuel Rocela', 'Ralph Estiller', '2020-2021', 'Second'),
(5, 'Jojie Zepeda', 'Ralph Estiller', '2021-2022', 'First'),
(6, 'Renuel Rocela', 'Ralph Estiller', '2021-2022', 'First'),
(7, 'Roi Kagawad Vasquez', 'Ralph Estiller', '2021-2022', 'First'),
(8, 'Renuel Rocela', 'Ralph Estiller', '2020-2021', 'First'),
(9, 'Roi Kagawad Vasquez', 'Ralph Estiller', '2021-2022', 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles`
--

CREATE TABLE `tblfiles` (
  `File_ID` int(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Course` varchar(25) NOT NULL,
  `School_Year` varchar(25) NOT NULL,
  `Semester` varchar(25) NOT NULL,
  `Dean` varchar(25) NOT NULL,
  `Date_Scheduled` date NOT NULL,
  `Date_Submitted` date DEFAULT NULL,
  `Status` varchar(25) NOT NULL,
  `Path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfiles`
--

INSERT INTO `tblfiles` (`File_ID`, `File`, `Author`, `Course`, `School_Year`, `Semester`, `Dean`, `Date_Scheduled`, `Date_Submitted`, `Status`, `Path`) VALUES
(8, 'Final Exam', 'Jojie Zepeda', 'ITE 7', '2020-2021', 'Second', 'Ralph Estiller', '2021-01-21', '2021-01-22', 'OVERDUE', 'qoutastion.xlsx'),
(9, 'Prelim Exam', 'Roi Kagawad Vasquez', 'PE 3', '2020-2021', 'First', 'Ralph Estiller', '2021-01-21', '2021-01-20', 'OVERDUE', 'qoutastion.xlsx'),
(19, 'Prelim Exam', 'Ralph Estiller', 'PE 1', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-05', '2021-02-05', 'ON TIME', 'Ralph DalisayPE 1Prelim Exam2020-2021Second2021-02-05.pdf'),
(21, 'Finals Exam', 'Ralph Estiller', 'PE 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-05', '2021-02-05', 'ON TIME', 'Exam-Ralph Dalisay-PE 4-2020-2021-Second-2021/02/05-6168.png'),
(25, 'Final Grades', 'Ralph Estiller', 'PE 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-10', '2021-02-10', 'ON TIME', 'This-Ralph Dalisay-PE 4-2020-2021-Second Semester-584867.png'),
(26, 'Certificate', 'Jojie Zepeda', 'MATH 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-05', '2021-02-05', 'ON TIME', 'Certificate-Jojie Zepeda-MATH 4-2020-2021-Second Semester-100000.png'),
(27, 'Grades', 'Jojie Zepeda', 'FIL 5', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-06', '2021-02-06', 'ON TIME', 'Grades-Jojie Zepeda-FIL 5-2020-2021-Second Semester-100000.png'),
(28, 'Prelim Exam', 'Jojie Zepeda', 'MATH 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-06', '2021-02-06', 'ON TIME', 'Exam-Jojie Zepeda-MATH 4-2020-2021-Second Semester-100000.jpg'),
(29, 'Prelim Exam', 'Renuel Rocela', 'MATH 4', '2020-2021', 'First', 'Ralph Estiller', '2021-02-09', '0000-00-00', 'IN PROGRESS', ''),
(30, 'Certificate', 'Roi Kagawad Vasquez', 'MATH 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-11', '2021-02-08', 'ON TIME', 'Certificate-Roi Vasquez-MATH 4-2020-2021-Second Semester-100000.png'),
(31, 'Syllabus', 'Roi Kagawad Vasquez', 'FIL 5', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-10', '2021-03-09', 'OVERDUE', 'Syllabus-Roi Kagawad Vasquez-FIL 5-2020-2021-Second Semester-100000.srt'),
(32, 'Syllabus', 'Jojie Zepeda', 'MATH 4', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-10', '0000-00-00', 'IN PROGRESS', ''),
(33, 'Prelim Exam', 'Roi Kagawad Vasquez', 'MATH 2', '2020-2021', 'Second', 'Ralph Estiller', '2021-02-09', '2021-03-11', 'OVERDUE', 'Prelim Exam-Roi Kagawad Vasquez-MATH 2-2020-2021-Second Semester-100000.srt');

-- --------------------------------------------------------

--
-- Table structure for table `tblprofiles`
--

CREATE TABLE `tblprofiles` (
  `Employee_ID` varchar(25) NOT NULL,
  `Fullname` varchar(25) NOT NULL,
  `Position` varchar(25) NOT NULL,
  `Sex` varchar(25) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `ContactNo` varchar(25) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Date_Created` date NOT NULL,
  `Last_Updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprofiles`
--

INSERT INTO `tblprofiles` (`Employee_ID`, `Fullname`, `Position`, `Sex`, `Birthdate`, `ContactNo`, `Email`, `Date_Created`, `Last_Updated`) VALUES
('192-168-3006', 'Renuel Rocela', 'Professor', 'Male', '0000-00-00', '09558249190', 'renuelpogi@gmail.com', '2021-02-02', '2021-02-02'),
('192-168-3469', 'Ralph Estiller', 'Dean', 'Male', '1998-10-25', '09558249184', 'rralph@gmail.com', '2021-01-31', '2021-02-12'),
('192-168-3471', 'Roi Kagawad Vasquez', 'Professor', 'Male', '2021-02-09', '09236545243', 'roikwg@gmail.com', '2021-02-02', '2021-02-08'),
('192-168-3574', 'Jojie Zepeda', 'Professor', 'Male', '2000-06-20', '09346157549', 'jietarist@gmail.com', '2021-02-02', '2021-02-05'),
('192-168-4574', 'Anjeline N. Legaspi', 'Admin', 'Female', NULL, '09123456789', 'anj@gmail.com', '2021-02-05', '2021-03-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`Faculty_ID`);

--
-- Indexes for table `tblfiles`
--
ALTER TABLE `tblfiles`
  ADD PRIMARY KEY (`File_ID`);

--
-- Indexes for table `tblprofiles`
--
ALTER TABLE `tblprofiles`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `Faculty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblfiles`
--
ALTER TABLE `tblfiles`
  MODIFY `File_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
