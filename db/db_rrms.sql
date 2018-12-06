-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 02:12 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `g_name` varchar(25) NOT NULL,
  `u_name` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `activate` tinyint(4) NOT NULL,
  `type` varchar(15) NOT NULL,
  `adviser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `g_name`, `u_name`, `password`, `activate`, `type`, `adviser`) VALUES
(1, 'Administrator', 'rrmsadmin', '1234', 1, 'admin', 0),
(2, 'loyd', 'loyd', '1234', 1, 'INSTRUCTOR', 0),
(3, 'Void Main', 'anne', 'anne', 1, 'STUDENT', 2),
(4, 'voidmain', 'himesama', '1234', 1, 'STUDENT', 2),
(5, 'Tri-JAS', 'sharah', 'sharah', 1, 'STUDENT', 2),
(6, 'voidmain', 'princess', '12345', 1, 'STUDENT', 2),
(7, 'triotech', 'princess', '1234', 1, 'STUDENT', 2),
(8, 'exhan', 'xhan', '1234', 1, 'INSTRUCTOR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `acesskey`
--

CREATE TABLE `acesskey` (
  `id` int(11) NOT NULL,
  `acesskey` varchar(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `used` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `ins_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acesskey`
--

INSERT INTO `acesskey` (`id`, `acesskey`, `type`, `used`, `date`, `ins_id`) VALUES
(1, 'FKyGpbQv', 'INSTRUCTOR', 1, '2018-08-20', 0),
(2, 'PPHbsPQh', 'INSTRUCTOR', 0, '2018-08-20', 0),
(3, 'zzoF5mKE', 'INSTRUCTOR', 0, '2018-08-20', 0),
(4, 'mmxjoICj', 'INSTRUCTOR', 0, '2018-08-20', 0),
(5, 'mwEtJuh3', 'INSTRUCTOR', 0, '2018-08-20', 0),
(6, 'AZvJayi4', 'INSTRUCTOR', 0, '2018-08-20', 0),
(7, 'PDmBqP4y', 'STUDENT', 1, '2018-08-20', 2),
(8, 'NecAp35J', 'STUDENT', 1, '2018-08-20', 2),
(9, 'axoNsEq6', 'STUDENT', 1, '2018-08-20', 2),
(10, '2jWvb5gU', 'STUDENT', 1, '2018-08-20', 2),
(11, 'NMH5OyJt', 'STUDENT', 1, '2018-08-20', 2),
(12, 'GDvmFjX3', 'STUDENT', 0, '2018-08-20', 2),
(13, 'IZCgSqn2', 'INSTRUCTOR', 0, '2018-08-24', 0),
(14, 'BADGgssC', 'INSTRUCTOR', 0, '2018-08-24', 0),
(15, 'GjPfCuSW', 'INSTRUCTOR', 0, '2018-08-24', 0),
(16, 'V0uYVkCQ', 'INSTRUCTOR', 0, '2018-08-24', 0),
(17, 'qBxGYC1m', 'INSTRUCTOR', 0, '2018-08-24', 0),
(18, 'FR1u1MFQ', 'STUDENT', 0, '2018-09-03', 2),
(19, 'n9NlywTY', 'STUDENT', 0, '2018-09-03', 2),
(20, 'Pcb5lK16', 'STUDENT', 0, '2018-09-03', 2),
(21, 'oMQzsXNV', 'STUDENT', 0, '2018-09-03', 2),
(22, '5MsSFdtc', 'STUDENT', 0, '2018-09-03', 2),
(23, 'Ev1SQlwv', 'STUDENT', 0, '2018-09-03', 2),
(24, 'FsmFRXw3', 'STUDENT', 0, '2018-09-03', 2),
(25, 'McJvaJKa', 'STUDENT', 0, '2018-09-03', 2),
(26, 'jpLVvzWo', 'STUDENT', 0, '2018-09-03', 2),
(27, 'z0Q9YyKh', 'STUDENT', 0, '2018-09-03', 2),
(28, 'mfbhYtZw', 'STUDENT', 0, '2018-09-03', 2),
(29, 'nn1GOBOC', 'STUDENT', 0, '2018-09-03', 2),
(30, '7uCn2rVz', 'STUDENT', 0, '2018-09-03', 2),
(31, 'xfTxVl22', 'STUDENT', 0, '2018-09-03', 2),
(32, 'l5A4BKzi', 'INSTRUCTOR', 0, '2018-09-10', 0),
(33, 'RztZZlif', 'INSTRUCTOR', 0, '2018-09-10', 0),
(34, '2jNXdOxC', 'INSTRUCTOR', 0, '2018-09-10', 0),
(35, 'ROJoWla2', 'INSTRUCTOR', 0, '2018-09-10', 0),
(36, 'LpwewQGl', 'INSTRUCTOR', 0, '2018-09-10', 0),
(37, 'mvbqwdG2', 'INSTRUCTOR', 0, '2018-09-10', 0),
(38, 'cTXsFm46', 'INSTRUCTOR', 0, '2018-09-10', 0),
(39, 'uhZQoGOF', 'INSTRUCTOR', 0, '2018-09-10', 0),
(40, 'OmMlSAPB', 'INSTRUCTOR', 0, '2018-09-10', 0),
(41, 'Wt2SclFQ', 'INSTRUCTOR', 0, '2018-09-10', 0),
(42, 'kRcv5fwe', 'INSTRUCTOR', 0, '2018-09-10', 0),
(43, 'ADtQU3YP', 'INSTRUCTOR', 0, '2018-09-10', 0),
(44, 'lObYUnmr', 'INSTRUCTOR', 0, '2018-09-10', 0),
(45, 'jP5GaRTl', 'INSTRUCTOR', 0, '2018-09-10', 0),
(46, 'yW65UVtU', 'INSTRUCTOR', 0, '2018-09-10', 0),
(47, '0hg6hCas', 'INSTRUCTOR', 0, '2018-09-11', 0),
(48, 'T5spMqtQ', 'INSTRUCTOR', 0, '2018-09-11', 0),
(49, '9rj62eM4', 'INSTRUCTOR', 0, '2018-09-11', 0),
(50, 'pHP8s5wX', 'INSTRUCTOR', 0, '2018-09-11', 0),
(51, 'NaZWKWPt', 'INSTRUCTOR', 0, '2018-09-11', 0),
(52, '8pvzxM94', 'STUDENT', 0, '2018-09-11', 2),
(53, '9g9lheV2', 'STUDENT', 0, '2018-09-11', 2),
(54, 'OinpQJWJ', 'STUDENT', 0, '2018-09-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
  `adv_id` smallint(6) NOT NULL,
  `adv_fname` varchar(20) NOT NULL,
  `adv_midName` varchar(20) NOT NULL,
  `adv_Lname` varchar(20) NOT NULL,
  `adv_suff` varchar(5) NOT NULL,
  `adv_email` varchar(25) NOT NULL,
  `accid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `a_id` int(11) NOT NULL,
  `a_fname` varchar(20) NOT NULL,
  `a_mname` varchar(20) NOT NULL,
  `a_lname` varchar(20) NOT NULL,
  `a_suffix` varchar(5) NOT NULL,
  `bib` text NOT NULL,
  `a_add` varchar(50) NOT NULL,
  `a_contact` varchar(15) NOT NULL,
  `a_email` varchar(25) NOT NULL,
  `a_pic` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic`) VALUES
(1, 'Sales', 'Gamponi', 'Aribe', 'JR', '', 'Malaybalay City', '097655433', 'sales_aribe@gmail.vom', ''),
(2, 'Klevie Jun', 'Roflo', 'Caseres', '', '', 'Apo Macote Malaybalay City', '09656744977', 'klevly@04@gmail.com', ''),
(3, 'Anne', 'Perlin', 'Cruz', '', '', 'Valencia City', '09864467', 'thisemail@gmail.com', ''),
(6, 'Allen Mie', 'Esguera', 'Bangud', '', '', 'Malaybalay City', '987567', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `awards` varchar(320) NOT NULL,
  `parties` varchar(320) NOT NULL,
  `location` varchar(320) NOT NULL,
  `description` varchar(320) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `book_id`, `awards`, `parties`, `location`, `description`, `date`) VALUES
(1, 2, 'Asian Awards for Oral Research Presentation', 'Asian Conference of Academic Journals and Higher Education Research', 'Pryce Plaza, Cagayan de Oro City', 'This is Description', '2011-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `bibliography`
--

CREATE TABLE `bibliography` (
  `id` int(11) NOT NULL,
  `aut_id` int(11) NOT NULL,
  `bib` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(150) NOT NULL,
  `abstract` text,
  `pub_date` date NOT NULL,
  `department` smallint(6) NOT NULL,
  `keywords` text NOT NULL,
  `rev_count` smallint(6) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `views_count` smallint(6) DEFAULT NULL,
  `cited` int(11) NOT NULL,
  `cover` tinytext NOT NULL,
  `docloc` text NOT NULL,
  `link` text NOT NULL,
  `aut_type` tinytext NOT NULL,
  `dowloadable` tinyint(4) NOT NULL,
  `refkey` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES
(1, 'Health Quality and Cost of Living in Asian Cities', '', '2018-10-29', 20, '', 0, 'Conceptualized', 0, 0, 0, '', '', '', '', 0, ''),
(2, 'Bukidnon State University Research Record Management System', 'eseh Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-10-01', 1, 'Research, Record Management System, File Tracking', 0, 'Unpublished', 1, 40, 0, 'research/2018/student/cover/5be7b0138fca74.58928824.png', 'research/2018/student/book/5b98d7af69a7e1.30073265.pdf', 'Bukidnon-State-University-Research-Record-Management-System', 'student', 1, 'Un5lAdageHbLgKUhF8aLklshoq6BjxDR'),
(6, 'The American Dream', 'This dissertation examines the role of newspaper editors in the political turmoil and strife that characterized late First Empire Rio de Janeiro (1827-1831). Newspaper editors and their journals helped change the political culture of late First Empire Rio de Janeiro by involving the people in the discussion of state. This change in political culture is apparent in Emperor Pedro Iâ€™s gradual loss of control over the mechanisms of power. As the newspapers became more numerous and powerful, the Emperor lost his legitimacy in the eyes of the people. To explore the role of the newspapers in the political events of the late First Empire, this dissertation analyzes all available newspapers published in Rio de Janeiro from 1827 to 1831. Newspapers and their editors were leading forces in the effort to remove power from the hands of the ruling elite and place it under the control of the people. In the process, newspapers helped change how politics operated in the constitutional monarchy of Brazil.', '2017-11-04', 4, 'American, News Paper', 0, 'Unpublished', 1, 40, 0, 'research/cover/5b98b3aed8a385.66287600.jpg', 'book/5be7e5992c0c19.61606326.pdf', 'The-American-Dream', 'faculty', 1, 'OkHWkquLSBNALhdMm3S2KZz8oMbEBGd5');

-- --------------------------------------------------------

--
-- Table structure for table `bookhistory`
--

CREATE TABLE `bookhistory` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_stat` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookhistory`
--

INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES
(1, 2, 'Unpublished', '2018-10-01 00:00:00'),
(5, 6, 'Unpublished', '2018-11-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) NOT NULL,
  `acc1` int(11) NOT NULL,
  `acc2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `section` varchar(15) NOT NULL,
  `description` varchar(40) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `trail_id` int(11) NOT NULL,
  `parts` varchar(100) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `page` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `trail_id`, `parts`, `comments`, `origin`, `page`) VALUES
(1, 4, 'Introduction\n                              ', 'Please make the introduction Attractive\n                              ', 'Research Committee', '5');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` smallint(6) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `cat_name`, `college`) VALUES
(1, 'I.T', 'CAS'),
(2, 'P.E', 'EDUC'),
(3, 'NURSING', 'CON'),
(4, 'AB ENGLISH', 'CAS'),
(5, 'AB SOCIO', 'CAS'),
(6, 'AB PHILO', 'CAS'),
(7, 'BS MATH', 'CAS'),
(8, 'AB SOCSCI', 'CAS'),
(9, 'BS EMC', 'CAS'),
(10, 'BEE', 'EDUC'),
(11, 'BSE', 'EDUC'),
(12, 'BSBA', 'COB'),
(13, 'PUBLIC ADMINISTRATION', 'COB'),
(14, 'HRM', 'COB'),
(15, 'ACCOUNTANCY', 'COB'),
(16, 'COMDEV', 'CSDT'),
(17, 'DEVCOM', 'CSDT'),
(18, 'BS AT', 'CSDT'),
(19, 'BS ET', 'CSDT'),
(20, 'Faculty', 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE `dictionary` (
  `id` int(20) NOT NULL,
  `word` varchar(45) NOT NULL,
  `index_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disseminated`
--

CREATE TABLE `disseminated` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `convension` varchar(160) NOT NULL,
  `location` varchar(160) NOT NULL,
  `history` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `documents` varchar(50) NOT NULL,
  `orig_name` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forwarded_sub`
--

CREATE TABLE `forwarded_sub` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupdoc`
--

CREATE TABLE `groupdoc` (
  `id` int(11) NOT NULL,
  `accid` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupdoc`
--

INSERT INTO `groupdoc` (`id`, `accid`, `book_id`) VALUES
(1, 2, 1),
(2, 5, 2),
(6, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `indexes`
--

CREATE TABLE `indexes` (
  `index_id` bigint(20) NOT NULL,
  `word_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `offset` int(11) NOT NULL,
  `end` tinyint(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `junc_advicerbook`
--

CREATE TABLE `junc_advicerbook` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `adv_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `junc_authorbook`
--

CREATE TABLE `junc_authorbook` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `aut_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `junc_authorbook`
--

INSERT INTO `junc_authorbook` (`id`, `book_id`, `aut_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5),
(8, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `junc_bookkeywords`
--

CREATE TABLE `junc_bookkeywords` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `keywords_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `junc_bookkeywords`
--

INSERT INTO `junc_bookkeywords` (`id`, `book_id`, `keywords_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 4, 4),
(9, 4, 5),
(10, 4, 6),
(11, 4, 7),
(12, 5, 4),
(13, 5, 5),
(14, 5, 6),
(15, 5, 7),
(16, 6, 8),
(17, 6, 9),
(18, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `junk_accountbook`
--

CREATE TABLE `junk_accountbook` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `junk_bookref`
--

CREATE TABLE `junk_bookref` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `webref_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `junk_bookref`
--

INSERT INTO `junk_bookref` (`id`, `book_id`, `webref_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `key_words` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `key_words`) VALUES
(1, 'BukSu'),
(6, 'China'),
(2, 'Document Management'),
(9, 'is'),
(10, 'keyword'),
(8, 'this');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `receiver` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `msg` varchar(1500) NOT NULL,
  `date` datetime NOT NULL,
  `seen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_stat`
--

CREATE TABLE `paper_stat` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `hassub` tinyint(4) NOT NULL,
  `optional` tinyint(4) NOT NULL,
  `hasrequired` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paper_stat`
--

INSERT INTO `paper_stat` (`id`, `title`, `description`, `hassub`, `optional`, `hasrequired`) VALUES
(1, 'Paper Conceptualization', 'Conceptualizaton of Research Projects.', 0, 0, ''),
(2, 'Submited for In-House Reviews', 'Paper was submitted for review by in-house personel.', 0, 0, ''),
(3, 'Paper Revision 1', 'Submission a preliminary paper.', 0, 0, 'paper'),
(4, 'Forwarded to Research and Ethics Committee ', 'Paper forwarded to Research and Ethics Committee for review.', 1, 0, ''),
(5, 'Paper Revision 2', 'Submission of second paper revision by uuthor.', 0, 0, 'paper'),
(6, 'Forwarded to Editorial Board', 'Second revision was submitted to editorial board for review.', 0, 0, ''),
(7, 'Paper Under Review', 'Final Review of the paper project.', 0, 0, ''),
(8, 'Publication', 'Paper is/are ready for publication.', 0, 0, 'pub'),
(9, 'Final Paper', 'Submission of final paper.', 0, 0, 'paper'),
(10, 'Paper Dissemination', 'The final paper was disseminated.', 0, 0, 'dis'),
(11, 'Awards Earned', 'Paper received an awards.', 0, 1, 'awards'),
(12, 'Research Utilization', 'The Paper was Utilized.', 0, 0, 'util');

-- --------------------------------------------------------

--
-- Table structure for table `paper_trail`
--

CREATE TABLE `paper_trail` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `p_sat_id` int(4) NOT NULL,
  `file_loc` varchar(100) NOT NULL,
  `requirements` tinyint(4) NOT NULL,
  `isdone` tinyint(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paper_trail`
--

INSERT INTO `paper_trail` (`id`, `book_id`, `p_sat_id`, `file_loc`, `requirements`, `isdone`, `date`) VALUES
(4, 1, 1, '', 1, 1, '2018-10-29 14:29:02'),
(5, 1, 2, '', 1, 1, '2018-10-29 14:38:45'),
(6, 1, 3, 'revision/5bd6ab3d8af973.09565975.pdf', 1, 1, '2018-10-29 14:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) NOT NULL,
  `post_tittle` text NOT NULL,
  `post_body` longtext NOT NULL,
  `post_date` datetime NOT NULL,
  `post_user` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_tittle`, `post_body`, `post_date`, `post_user`, `location`) VALUES
(1, 'Post 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-11-04 09:28:40', 'Admin', 'post/'),
(2, 'Post number 2', 'Descriptive: These paragraphs have four main aims. First of all, they naturally describe something or somebody, that is conveying the information. Secondly, such paragraphs create powerful images in the reader\'s mind. Thirdly, they appeal to the primary senses of vision, hearing, touch, taste, and smell, to get the maximum emotional response from the reader. And finally, they increase the dynamics of the text. Some grammar rules may be skipped in descriptive paragraphs, but only for the sake of imagery.', '2018-11-13 13:40:32', 'Admin', 'post/');

-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE `published` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issn` varchar(50) NOT NULL,
  `journal` varchar(160) NOT NULL,
  `type` varchar(50) NOT NULL,
  `history` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pub_option`
--

CREATE TABLE `pub_option` (
  `id` int(11) NOT NULL,
  `type` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref`
--

CREATE TABLE `ref` (
  `id` int(11) NOT NULL,
  `reftitle` varchar(500) NOT NULL,
  `link` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref`
--

INSERT INTO `ref` (`id`, `reftitle`, `link`) VALUES
(1, 'Satalkar, B. (2010, July 15). Water aerobics.', 'Http://Www.Buzzle.Com'),
(2, 'Cain, K. (2012, June 29). The Negative effects of Facebook on communication. Social Media Today RSS.', 'http://socialmediatoday.com'),
(3, 'James, H. (1937). The ambassadors. New York, NY: Scribner.', 'http://books.google.com'),
(4, 'orter, R. (1994). London, a social history', 'http://books.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `referencekey`
--

CREATE TABLE `referencekey` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `refkey` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referencekey`
--

INSERT INTO `referencekey` (`id`, `book_id`, `refkey`) VALUES
(1, 2, 'Un5lAdageHbLgKUhF8aLklshoq6BjxDR'),
(2, 3, 'y2NDBgrMP6XbgUgPJRPvpAJGm63yBpZ5'),
(3, 4, 'QkSs6MJGPyZATkhqyFTqkGP26XLCkgBZ'),
(4, 5, 'xhSjgBGpUxV4jIkrw7h7pEnupdgRiYFP'),
(5, 6, 'OkHWkquLSBNALhdMm3S2KZz8oMbEBGd5');

-- --------------------------------------------------------

--
-- Table structure for table `siteconfig`
--

CREATE TABLE `siteconfig` (
  `PROJECT_ROOT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siteconfig`
--

INSERT INTO `siteconfig` (`PROJECT_ROOT`) VALUES
('http://localhost/rrms-buksu/');

-- --------------------------------------------------------

--
-- Table structure for table `utilize`
--

CREATE TABLE `utilize` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `orgname` varchar(160) NOT NULL,
  `orgaddress` varchar(160) NOT NULL,
  `date` date NOT NULL,
  `history` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username and password unique` (`u_name`,`password`);

--
-- Indexes for table `acesskey`
--
ALTER TABLE `acesskey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`adv_id`),
  ADD UNIQUE KEY `adv_name` (`adv_fname`),
  ADD KEY `adviser_ibfk_1` (`accid`);

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `author name unique` (`a_fname`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `bibliography`
--
ALTER TABLE `bibliography`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aut_id` (`aut_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book name unique` (`book_title`),
  ADD KEY `Book Has a Category` (`department`) USING BTREE;

--
-- Indexes for table `bookhistory`
--
ALTER TABLE `bookhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookhistory_ibfk_1` (`book_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acc1` (`acc1`,`acc2`),
  ADD UNIQUE KEY `acc2` (`acc2`,`acc1`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trail_id` (`trail_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word must unique` (`word`);

--
-- Indexes for table `disseminated`
--
ALTER TABLE `disseminated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disseminated_ibfk_1` (`book_id`),
  ADD KEY `history` (`history`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `forwarded_sub`
--
ALTER TABLE `forwarded_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupdoc`
--
ALTER TABLE `groupdoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accid` (`accid`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `indexes`
--
ALTER TABLE `indexes`
  ADD PRIMARY KEY (`index_id`),
  ADD UNIQUE KEY `word id book id offset unique` (`word_id`,`book_id`,`offset`),
  ADD KEY `word_id` (`word_id`),
  ADD KEY `index_id` (`index_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `offset` (`offset`);

--
-- Indexes for table `junc_advicerbook`
--
ALTER TABLE `junc_advicerbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `adv_id` (`adv_id`);

--
-- Indexes for table `junc_authorbook`
--
ALTER TABLE `junc_authorbook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `AuthorBook` (`book_id`,`aut_id`),
  ADD KEY `Pk_author_id` (`aut_id`);

--
-- Indexes for table `junc_bookkeywords`
--
ALTER TABLE `junc_bookkeywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book have manay key words` (`book_id`),
  ADD KEY `many to many` (`keywords_id`);

--
-- Indexes for table `junk_accountbook`
--
ALTER TABLE `junk_accountbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `junction author` (`acc_id`),
  ADD KEY `junction book` (`book_id`);

--
-- Indexes for table `junk_bookref`
--
ALTER TABLE `junk_bookref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Book` (`book_id`),
  ADD KEY `WebRefence` (`webref_id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keywordsUnique` (`key_words`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `paper_stat`
--
ALTER TABLE `paper_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_trail`
--
ALTER TABLE `paper_trail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_id` (`book_id`,`p_sat_id`),
  ADD KEY `p_sat_id` (`p_sat_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `published`
--
ALTER TABLE `published`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `history` (`history`);

--
-- Indexes for table `pub_option`
--
ALTER TABLE `pub_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref`
--
ALTER TABLE `ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referencekey`
--
ALTER TABLE `referencekey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `utilize`
--
ALTER TABLE `utilize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `history` (`history`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `acesskey`
--
ALTER TABLE `acesskey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `adviser`
--
ALTER TABLE `adviser`
  MODIFY `adv_id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bibliography`
--
ALTER TABLE `bibliography`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bookhistory`
--
ALTER TABLE `bookhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `dictionary`
--
ALTER TABLE `dictionary`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disseminated`
--
ALTER TABLE `disseminated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forwarded_sub`
--
ALTER TABLE `forwarded_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groupdoc`
--
ALTER TABLE `groupdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `indexes`
--
ALTER TABLE `indexes`
  MODIFY `index_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `junc_advicerbook`
--
ALTER TABLE `junc_advicerbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `junc_authorbook`
--
ALTER TABLE `junc_authorbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `junc_bookkeywords`
--
ALTER TABLE `junc_bookkeywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `junk_accountbook`
--
ALTER TABLE `junk_accountbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `junk_bookref`
--
ALTER TABLE `junk_bookref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_stat`
--
ALTER TABLE `paper_stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `paper_trail`
--
ALTER TABLE `paper_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `published`
--
ALTER TABLE `published`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pub_option`
--
ALTER TABLE `pub_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref`
--
ALTER TABLE `ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `referencekey`
--
ALTER TABLE `referencekey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `utilize`
--
ALTER TABLE `utilize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adviser`
--
ALTER TABLE `adviser`
  ADD CONSTRAINT `adviser_ibfk_1` FOREIGN KEY (`accid`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `bibliography`
--
ALTER TABLE `bibliography`
  ADD CONSTRAINT `bibliography_ibfk_1` FOREIGN KEY (`aut_id`) REFERENCES `author` (`a_id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `Book Has a Category` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `bookhistory`
--
ALTER TABLE `bookhistory`
  ADD CONSTRAINT `bookhistory_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`acc1`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`acc2`) REFERENCES `account` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`trail_id`) REFERENCES `paper_trail` (`id`);

--
-- Constraints for table `disseminated`
--
ALTER TABLE `disseminated`
  ADD CONSTRAINT `disseminated_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `disseminated_ibfk_2` FOREIGN KEY (`history`) REFERENCES `bookhistory` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groupdoc`
--
ALTER TABLE `groupdoc`
  ADD CONSTRAINT `groupdoc_ibfk_1` FOREIGN KEY (`accid`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `groupdoc_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `indexes`
--
ALTER TABLE `indexes`
  ADD CONSTRAINT `fk book id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk word id` FOREIGN KEY (`word_id`) REFERENCES `dictionary` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `junc_advicerbook`
--
ALTER TABLE `junc_advicerbook`
  ADD CONSTRAINT `Pk_Advicer` FOREIGN KEY (`adv_id`) REFERENCES `adviser` (`adv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pk_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `junc_authorbook`
--
ALTER TABLE `junc_authorbook`
  ADD CONSTRAINT `Pk_author_id` FOREIGN KEY (`aut_id`) REFERENCES `author` (`a_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Pk_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `junc_bookkeywords`
--
ALTER TABLE `junc_bookkeywords`
  ADD CONSTRAINT `book have manay key words` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `many to many` FOREIGN KEY (`keywords_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `junk_accountbook`
--
ALTER TABLE `junk_accountbook`
  ADD CONSTRAINT `junction author` FOREIGN KEY (`acc_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `junction book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `junk_bookref`
--
ALTER TABLE `junk_bookref`
  ADD CONSTRAINT `Book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `WebRefence` FOREIGN KEY (`webref_id`) REFERENCES `ref` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `account` (`id`);

--
-- Constraints for table `paper_trail`
--
ALTER TABLE `paper_trail`
  ADD CONSTRAINT `paper_trail_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `paper_trail_ibfk_2` FOREIGN KEY (`p_sat_id`) REFERENCES `paper_stat` (`id`);

--
-- Constraints for table `published`
--
ALTER TABLE `published`
  ADD CONSTRAINT `published_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `published_ibfk_2` FOREIGN KEY (`history`) REFERENCES `bookhistory` (`id`);

--
-- Constraints for table `referencekey`
--
ALTER TABLE `referencekey`
  ADD CONSTRAINT `referencekey_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `utilize`
--
ALTER TABLE `utilize`
  ADD CONSTRAINT `utilize_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `utilize_ibfk_2` FOREIGN KEY (`history`) REFERENCES `bookhistory` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
