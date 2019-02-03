-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2019 at 04:09 PM
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
  `password` varchar(50) NOT NULL,
  `activate` tinyint(4) NOT NULL,
  `type` varchar(15) NOT NULL,
  `adviser` int(11) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `g_name`, `u_name`, `password`, `activate`, `type`, `adviser`, `alias`, `date`) VALUES
(1, 'Administrator', 'rrmsadmin', 'klevly@04', 1, 'admin', 0, '', '2019-01-22 23:35:51'),
(2, 'loyd', 'loyd', '1234', 1, 'INSTRUCTOR', 0, '', '2019-01-22 23:35:51'),
(3, 'Void Main', 'anne', 'anne', 1, 'STUDENT', 2, '', '2019-01-22 23:35:51'),
(4, 'voidmain', 'himesama', '1234', 1, 'STUDENT', 2, '', '2019-01-22 23:35:51'),
(5, 'Tri-JAS', 'sharah', 'sharah', 1, 'STUDENT', 2, '', '2019-01-22 23:35:51'),
(6, 'voidmain', 'princess', '12345', 1, 'STUDENT', 2, '', '2019-01-22 23:35:51'),
(7, 'triotech', 'princess', '1234', 1, 'STUDENT', 2, '', '2019-01-22 23:35:51'),
(8, 'exhan', 'xhan', '1234', 1, 'INSTRUCTOR', 0, '', '2019-01-22 23:35:51'),
(9, '', 'Aribe2018', 'aribe1234', 1, 'INSTRUCTOR', 0, '', '2019-01-22 23:35:51'),
(10, 'VoidMain', 'klevly', 'newnew04', 1, 'INSTRUCTOR', 0, 'Klevie-jun-Roflo-Caseres', '2019-01-22 23:35:51'),
(11, '', 'allen', '1234', 1, 'STUDENT', 0, '', '2019-01-22 23:35:51'),
(12, 'Dummy', 'dummy', '1234', 1, 'STUDENT', 0, '', '2019-01-22 23:35:51'),
(23, '', 'momheko', 'klevly@04', 1, 'INSTRUCTOR', 0, 'Flordeliza-Semillano-Petilo-I', '2019-01-23 14:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `acesskey`
--

CREATE TABLE `acesskey` (
  `id` int(11) NOT NULL,
  `acesskey` varchar(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `used` tinyint(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ins_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acesskey`
--

INSERT INTO `acesskey` (`id`, `acesskey`, `type`, `used`, `date`, `ins_id`) VALUES
(94, 'Byrb0g6g', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(95, 'jlDRDlhM', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(96, 'Ze7sSlAj', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(97, 'SqaIf2h5', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(98, 'trQkfgaB', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(99, 'xjibp1Y3', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(100, 'rMT23Zgn', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(101, 'gLtC4Peb', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(102, '8urx9ab1', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(103, 'sY5SKbPj', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(104, 'd68CZ7o1', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(105, 'kjB5kaHj', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(106, 'N8cMzRn4', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(107, 'Nq43ccuZ', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(108, 'mrh8MqVK', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(109, 'Mr9PD6VH', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(110, '4pXb2X0j', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(111, 'FgbZakxx', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(112, 'tP1lpQMl', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(113, 'J1iecK5e', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(114, 'UFJ4RFYY', 'STUDENT', 0, '2019-01-17 00:00:00', 10),
(115, 'gkzV2sC4', 'INSTRUCTOR', 0, '2019-01-21 00:00:00', 0),
(116, 'AVmVXCXk', 'INSTRUCTOR', 0, '2019-01-21 00:00:00', 0),
(117, 'gqJanYuy', 'INSTRUCTOR', 0, '2019-01-21 00:00:00', 0),
(120, 'SBMhxfEy', 'INSTRUCTOR', 0, '2019-01-22 00:00:00', 0),
(121, 'LLntNmw7', 'INSTRUCTOR', 0, '2019-01-22 00:00:00', 0),
(122, 'SSXsxiBG', 'INSTRUCTOR', 0, '2019-01-22 00:00:00', 0),
(123, 'QEHsZMTH', 'INSTRUCTOR', 0, '2019-01-22 00:00:00', 0),
(124, 'KPzlah8A', 'INSTRUCTOR', 0, '2019-01-22 00:00:00', 0);

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
  `a_fname` varchar(40) NOT NULL,
  `a_mname` varchar(40) NOT NULL,
  `a_lname` varchar(40) NOT NULL,
  `a_suffix` varchar(5) NOT NULL,
  `bib` text NOT NULL,
  `a_add` varchar(50) NOT NULL,
  `a_contact` varchar(15) NOT NULL,
  `a_email` varchar(25) NOT NULL,
  `a_pic` varchar(40) NOT NULL,
  `login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`a_id`, `a_fname`, `a_mname`, `a_lname`, `a_suffix`, `bib`, `a_add`, `a_contact`, `a_email`, `a_pic`, `login`) VALUES
(1, 'Sales', 'Gamponi', 'Aribe', 'JR', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Malaybalay City', '097655433', 'sales_aribe@gmail.com', '', 9),
(2, 'Klevie', 'Roflo', 'Caseres', '', 'Bibiliography', 'Apo Macote, Malaybalay City, Bukidnon Philippines', '09656744976', 'klevly044@gmail.com', '', 10),
(3, 'Anne', 'Perlin', 'Cruz', '', '', 'Valencia City', '09757689126', 'thisemail@gmail.com', '', 3),
(6, 'Allen Mie', 'Esguera', 'Bangud', '', '', 'Malaybalay City', '987567', '', '', 11),
(7, 'Dummy', 'S.', 'Dummy', '', '', 'Malayblay CIty', '09656744977', 'thisise@mail.com', '', 12),
(8, 'AllenJhon', 'Bartolome', 'Cruz', '', '', '', '', '', '', 1),
(15, 'Flordeliza', 'Semillano', 'Petilo', 'I', 'About the Author', 'Sinanglanan, Malaybalay City', '09676644649', 'flordeliza@gmail.com', '', 23);

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
(1, 2, 'Asian Awards for Oral Research Presentation', 'Asian Conference of Academic Journals and Higher Education Research', 'Pryce Plaza, Cagayan de Oro City', 'This is Description', '2011-08-17'),
(2, 147, 'Best Paper', 'International Research Organization', 'Asian Conference for Ecological Research', 'This is Description', '2019-01-05');

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
  `book_title` varchar(150) NOT NULL DEFAULT '',
  `abstract` text NOT NULL,
  `pub_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `department` smallint(6) DEFAULT '0',
  `keywords` text NOT NULL,
  `refrences` longtext NOT NULL,
  `rev_count` smallint(6) DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT 'Unpublished',
  `enabled` tinyint(4) NOT NULL DEFAULT '0',
  `views_count` smallint(6) DEFAULT '0',
  `cited` int(11) NOT NULL DEFAULT '0',
  `cover` tinytext NOT NULL,
  `docloc` text NOT NULL,
  `link` text NOT NULL,
  `aut_type` tinytext NOT NULL,
  `dowloadable` tinyint(4) NOT NULL DEFAULT '0',
  `refkey` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `abstract`, `pub_date`, `department`, `keywords`, `refrences`, `rev_count`, `status`, `enabled`, `views_count`, `cited`, `cover`, `docloc`, `link`, `aut_type`, `dowloadable`, `refkey`) VALUES
(145, 'Bukidnon State University Research Record Management System', 'Most students in every university and colleges come in a point that they write their own research as requirements to their degree. As time pass by, tracking and managing those files becomes an issue. At the same time real time collaboration between faculty researchers and Research Unit in tracking research documents status, research created documents and comments should be implemented. \n	The purpose of this study is to identify the best and suitable methodology, components and algorithm that will aid the problem. In addition, to produce record management system for research made by the students of Bukidnon State University (BukSU) with real time collaboration tools between faculty and the Research Unit.', '2019-01-09 00:00:00', 1, 'Research Record Management System, Document Tracking, Real-Time Collaboration Tools f\n', 'Abourizk S., (2000). Application Framework for Development of\r\nSimulation Tools. Retrieved on July 2000 from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n	\r\nAdam, A., (2008). Implementing electronic document and record \r\nManagement systems. Retrieved from http://dergipark.gov.tr/download/article-file/358089.\r\n\r\nArmstrong, JS., (2001). Modeling the Theory: Philosophical Basis. \r\nRetrieved from http://shodhganga.inflibnet.ac.in/bitstream/10603/2707/17/17_chapter%206.pdf\r\n\r\nBigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the \r\nEffectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/281332642_An_Assessment_of_the_Effectiveness_of_Electronic_Records_Management_at_Africa_University_Mutare_Zimbabwe.\r\n\r\nBongor et al., (2009). Cognitive Computing: Where Big Data Is Driving \r\nUs. Retrieved from https://www.researchgate.net/figure/SUS-scale-from-Bangor-et-al-2009_fig8_314119509\r\n\r\nBunawan, A., (2013). Enhancing the Efficiency of Managing Electronic \r\nRecords among the Record Management Practitioner by Using an Appropriate Electronic Records Management System (ERMS). Retrieved from http://www.academia.edu/10630737/Enhancing_the_Efficiency_of_Managing_Electronic_Records_among_the_Record_Management_Practitioner_by_Using_an_Appropriate_Electronic_Records_Management_System_ERMS_\r\n\r\nGiandon, A., Junior R., & Scheer, S., (2002). Implementing Electronic \r\nDocument Management System for a Lean Design Process. Retrieved from https://www.researchgate.net/publication/228789828_Implementing_electronic_document_management_system_for_the_Lean_design_process.\r\n\r\nJohnston G.P. & Bowen D.V., (2005). The benefits of electronic records \r\nmanagement systems: a general review of published and some unpublished cases, Records Management Journal, Vol. 15 (3), 131-140.\r\n\r\nKelemen, R., & Mekovec, R., (2007). Document Management System-A \r\nCase Study of Varaždin County. Retrieved from https://bib.irb.hr/datoteka/345603.Kelemen-Mekovec_-_DMS_-_A_Case_Study_of_Varazdin_Counti_pp41-46s.pdf\r\n\r\nLavrakas, P., (2008). Random Sampling. Retrieved from http://methods.sagepub.com/reference/encyclopedia-of-survey-research-methods/n440.xml\r\n\r\nRichey, R., (1996). Developmental Research: The Definition and Scope. \r\nRetrieved from https://eric.ed.gov/?id=ED373753\r\n', 0, 'Unpublished', 1, 47, 0, 'research/2019/student/cover/5c39a45bb0dda8.29311318.jpg', 'book/student/2019/5c360a7ee6b814.81189560.pdf', 'Bukidnon-State-University-Research-Record-Management-System', 'student', 1, ''),
(147, 'Daan Ni', 'The HIV virus is currently destroying all facets of African life. It therefore is imperative that a new holistic form of health education and accessible treatment be implemented in African public health policy which improves dissemination of prevention and treatment programs, while maintaining the cultural infrastructure. Drawing on government and NGO reports, as well as other documentary sources, this paper examines the nature of current efforts and the state of health care practices in Africa. I review access to modern health care and factors which inhibit local utilization of these resources, as well as traditional African beliefs about medicine, disease, and healthcare. This review indicates that a collaboration of western and traditional medical care and philosophy can help slow the spread of HIV in Africa. This paper encourages the acceptance and financial support of traditional health practitioners in this effort owing to their accessibility and affordability and their cultural compatibility with the community.', '2019-01-15 00:00:00', 20, 'HIV, Africa, Healers', 'Abourizk S., (2000). Application Framework for Development of\r\nSimulation Tools. Retrieved on July 2000 from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nAdam, A., (2008). Implementing electronic document and record \r\nManagement systems. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nArmstrong, JS., (2001). Modeling the Theory: Philosophical Basis. \r\nRetrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nBigirimana S., Jagero N., & Chizema P., (2015). An Assessment of the \r\nEffectiveness of Electronic Records Management. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nBongor et al., (2009). Cognitive Computing: Where Big Data Is Driving \r\nUs. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nBunawan, A., (2013). Enhancing the Efficiency of Managing Electronic \r\nRecords among the Record Management Practitioner by Using an Appropriate Electronic Records Management System (ERMS). Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nGiandon, A., Junior R., & Scheer, S., (2002). Implementing Electronic \r\nDocument Management System for a Lean Design Process. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nJohnston G.P. & Bowen D.V., (2005). The benefits of electronic records \r\nmanagement systems: a general review of published and some unpublished cases, Records Management Journal, Vol. 15 (3), 131-140.\r\n\r\nKelemen, R., & Mekovec, R., (2007). Document Management System-A \r\nCase Study of Varaždin County. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nLavrakas, P., (2008). Random Sampling. Retrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools\r\n\r\nRichey, R., (1996). Developmental Research: The Definition and Scope. \r\nRetrieved from https://www.researchgate.net/publication/245282203_Application_Framework_for_Development_of_Simulation_Tools', 0, 'Published', 1, 39, 0, 'research/2019/instructor/cover/5c49e9bfce8cc5.40503433.jpg', 'book/instructor/2019/5c49e9bfd65652.84438439.pdf', 'Daan-Ni', 'instructor', 1, ''),
(169, 'New Title', '', '2019-01-22 14:53:49', 20, '', '', 0, 'Conceptualized', 0, 0, 0, '', '', '', 'instructor', 0, ''),
(170, 'Flordeliza Research', '', '2019-01-23 14:27:03', 20, '', '', 0, 'Conceptualized', 0, 1, 0, '', '', '', 'instructor', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `bookhistory`
--

CREATE TABLE `bookhistory` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_stat` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookhistory`
--

INSERT INTO `bookhistory` (`id`, `book_id`, `book_stat`, `date`) VALUES
(26, 145, 'Unpublished', '2019-01-09 22:51:42'),
(27, 145, 'Utilized', '2019-01-09 22:51:42'),
(29, 147, 'Published', '2019-01-16 11:25:46'),
(30, 147, 'Disseminated', '2019-01-16 13:07:21'),
(31, 147, 'Utilized', '2019-01-16 15:06:22'),
(32, 147, 'Utilized', '2019-01-21 13:10:25'),
(36, 169, 'Conceptualized', '2019-01-22 14:53:49'),
(37, 170, 'Conceptualized', '2019-01-23 14:27:03'),
(38, 147, 'Completed', '2019-01-25 00:37:19');

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
  `page` varchar(30) NOT NULL,
  `adjustment` tinytext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `trail_id`, `parts`, `comments`, `origin`, `page`, `adjustment`, `date`) VALUES
(1, 4, 'Introduction\n                              ', 'Please make the introduction Attractive\n                              ', 'Research Committee', '5', '', '2019-01-17 11:56:38'),
(2, 1, 'Introduction\n                              ', 'It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.', 'Research Committee', '5', '9', '2019-01-17 11:56:38'),
(3, 2, 'Chapter 4', 'Give more explanation on the data', 'Internal Reviewers', '46', '', '2019-01-17 11:56:38'),
(4, 1, 'fffffff\n                              \n                              ', 'It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.\n                              \n                              ', 'Research Committee', '7', '52', '2019-01-17 14:13:25'),
(6, 1, 'awdawd', 'It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.', 'Research Committee', '', '', '2019-01-17 14:13:53'),
(7, 1, 'drgdgr', 'It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence.', 'Research Committee', '', '', '2019-01-17 14:14:31'),
(8, 1, 'dfseghnf rdrhyr\n                              ', 'It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence. It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence. It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, and did his best to conceal an unofficial smile. Brains, purpose, will,â€”all are needed by these unofficial statesmen. The periodical was unofficial and had a difficult struggle for existence. It is only necessary to refer briefly to the unofficial Boer attempts at peace. Captain Erskine nodded, an', 'Research Committee', '', '', '2019-01-17 14:14:51'),
(9, 1, 'New Comments', 'This is Comments', 'Research Committee', '', '', '2019-01-22 09:47:06'),
(10, 1, 'Comments Two', 'Comments Two', 'Research Committee', '6', '', '2019-01-22 09:48:25');

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
(0, 'Uncategorized', 'Uncategorized'),
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

--
-- Dumping data for table `disseminated`
--

INSERT INTO `disseminated` (`id`, `book_id`, `type`, `convension`, `location`, `history`, `date`) VALUES
(1, 147, 'Institutional', 'Ecological Research Conference', 'Madaluyong Philippines', 30, '2019-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `documents` text NOT NULL,
  `orig_name` varchar(350) NOT NULL,
  `submitted_by` tinytext NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `book_id`, `documents`, `orig_name`, `submitted_by`, `description`, `date`) VALUES
(10, 147, 'revisions/2019/Klevie-jun-Roflo-Caseres/5c482859b4c6c1.85715247.pdf', 'sample reports firefox.pdf', 'klevly', 'Submitted for Paper Revision', '2019-01-25 02:25:26');

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
(6, 3, 6),
(7, 10, 147);

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
(125, 145, 2),
(131, 145, 3),
(132, 147, 2),
(149, 169, 2),
(150, 169, 3),
(151, 169, 6),
(153, 170, 2),
(152, 170, 15);

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
(10, 2, 3),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(21, 6, 22),
(24, 6, 25);

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
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `isShow`, `author_id`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `on_update_author`
--

CREATE TABLE `on_update_author` (
  `id` int(11) NOT NULL,
  `action` varchar(15) NOT NULL,
  `author` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `referer` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `p_sat_id` int(4) NOT NULL DEFAULT '1',
  `file_loc` text NOT NULL,
  `file_alias` tinytext NOT NULL,
  `requirements` tinyint(4) NOT NULL,
  `isdone` tinyint(4) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paper_trail`
--

INSERT INTO `paper_trail` (`id`, `book_id`, `p_sat_id`, `file_loc`, `file_alias`, `requirements`, `isdone`, `date`) VALUES
(1, 147, 1, '', '', 1, 1, '2019-01-15 10:21:23'),
(2, 147, 2, '', '', 1, 1, '2019-01-15 14:01:35'),
(3, 147, 3, 'revisions/2019/Klevie-jun-Roflo-Caseres/5c482859b4c6c1.85715247.pdf', 'sample reports firefox.pdf', 1, 1, '2019-01-15 14:03:48'),
(4, 147, 4, '', '', 1, 1, '2019-01-16 10:55:53'),
(5, 147, 5, 'revisions/2019/Klevie-jun-Roflo-Caseres/5c480cee5e7162.26778695.pdf', '3-Frame-Relay.pdf', 1, 1, '2019-01-16 10:56:00'),
(6, 147, 6, '', '', 1, 1, '2019-01-16 10:56:06'),
(7, 147, 7, '', '', 1, 1, '2019-01-16 10:56:12'),
(8, 147, 8, '', '', 1, 1, '2019-01-16 10:56:17'),
(9, 147, 9, 'book/instructor/2019/5c49e9bfd65652.84438439.pdf', 'VoidMain-Questionnaire.pdf', 1, 1, '2019-01-16 10:56:31'),
(10, 147, 10, '', '', 1, 1, '2019-01-16 10:56:43'),
(11, 147, 11, '', '', 1, 1, '2019-01-16 10:56:49'),
(12, 147, 12, '', '', 1, 1, '2019-01-16 10:56:59'),
(13, 169, 1, '', '', 1, 1, '2019-01-22 14:53:49'),
(14, 170, 1, '', '', 1, 1, '2019-01-23 14:27:03'),
(15, 170, 2, '', '', 1, 1, '2019-01-23 14:29:41'),
(16, 170, 3, 'revisions/2019/Klevie-jun-Roflo-Caseres/5c480b3d12b695.07920947.pdf', 'sample reports firefox.pdf', 1, 1, '2019-01-23 14:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) NOT NULL,
  `post_tittle` text NOT NULL,
  `post_body` longtext NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_user` varchar(50) NOT NULL,
  `feautured` tinyint(4) NOT NULL DEFAULT '0',
  `cover` text NOT NULL,
  `location` varchar(100) NOT NULL DEFAULT 'post/',
  `views_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_tittle`, `post_body`, `post_date`, `post_user`, `feautured`, `cover`, `location`, `views_count`) VALUES
(2, 'Post number 2', 'Descriptive: These paragraphs have four main aims. First of all, they naturally describe something or somebody, that is conveying the information. Secondly, such paragraphs create powerful images in the reader\'s mind. Thirdly, they appeal to the primary senses of vision, hearing, touch, taste, and smell, to get the maximum emotional response from the reader. And finally, they increase the dynamics of the text. Some grammar rules may be skipped in descriptive paragraphs, but only for the sake of imagery.', '2018-11-13 13:40:32', 'Admin', 0, '', 'post/', 0),
(3, 'Research Record Management System is Now ONLINE', 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-01-31 11:36:26', 'Admin', 1, 'post/Feautured_Cover/2019/5c526d3a6e1472.77029604.png', 'post/', 0),
(4, 'Research Record Management System is Now ONLINE 2', '<h2><strong>Lorem Ipsum</strong></h2><p>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2019-01-31 11:38:01', 'Admin', 1, 'post/Feautured_Cover/2019/5c526d99528b31.56418894.png', 'post/', 1),
(5, 'Hellow World', '<strong>Hellow World!</strong>', '2019-01-31 15:06:56', 'Admin', 0, '', 'post/', 1),
(6, 'Asia Pacific Journal Accepted as One of the Asian Index', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-02-01 15:31:14', 'Admin', 1, 'post/Feautured_Cover/2019/5c53f5c2282ea3.15186853.png', 'post/', 1),
(7, 'Sales Aribe Won the Best Best Presenter for the paper titled \"Emojie: Changing the Traditional Way of Communication\"', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-02-01 15:33:40', 'Admin', 0, '', 'post/', 6),
(9, 'Beverly Bicar Won the RAFI Best Paper Award', '<p style=\"text-align: justify;\"><img src=\"http://buksu.edu.ph/wp-content/uploads/2016/08/Bicar-Beverly-2017.jpg\" style=\"width: 179px; height: 240px; margin-right: 15px; float: left;\"><strong><span style=\"font-size: 30px;\">L</span><span style=\"font-size: 18px;\">orem Ipsum</span></strong><span style=\"font-size: 18px;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2019-02-03 17:00:51', 'Admin', 1, 'post/Feautured_Cover/2019/5c5702b53e2863.36646002.png', 'post/', 25);

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

--
-- Dumping data for table `published`
--

INSERT INTO `published` (`id`, `book_id`, `issn`, `journal`, `type`, `history`, `date`) VALUES
(1, 147, 'ISBN-90768-789-67', 'Journal of Information Technology', 'CHED Accredited Journal', 29, '2019-01-26');

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
(3, 'James, H. (1936). The ambassadors. New York, NY: Scribner.', 'http://books.google.com'),
(22, 'Refrence Tittle', 'http://google.com'),
(25, 'ffff', 'http://google.com');

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
-- Dumping data for table `utilize`
--

INSERT INTO `utilize` (`id`, `book_id`, `orgname`, `orgaddress`, `date`, `history`) VALUES
(8, 145, 'Research Unit', 'Bukidnon State University [Main Campus], Malaybalay City Bukidnon', '2019-03-20', 26),
(9, 147, 'Organization Name', 'Address', '2019-01-04', 31),
(10, 147, 'Bukidnon State University', 'malaybalay CIty Bukidnon', '2019-09-20', 32);

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
  ADD UNIQUE KEY `author name unique` (`a_fname`),
  ADD KEY `login` (`login`);

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
  ADD UNIQUE KEY `one entry only` (`book_id`,`webref_id`),
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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `author_id` (`author_id`);

--
-- Indexes for table `on_update_author`
--
ALTER TABLE `on_update_author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notified once` (`action`,`author`,`book_id`),
  ADD KEY `author` (`author`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `referer` (`referer`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `acesskey`
--
ALTER TABLE `acesskey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
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
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bibliography`
--
ALTER TABLE `bibliography`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `bookhistory`
--
ALTER TABLE `bookhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `forwarded_sub`
--
ALTER TABLE `forwarded_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groupdoc`
--
ALTER TABLE `groupdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `on_update_author`
--
ALTER TABLE `on_update_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_stat`
--
ALTER TABLE `paper_stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `paper_trail`
--
ALTER TABLE `paper_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `published`
--
ALTER TABLE `published`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pub_option`
--
ALTER TABLE `pub_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref`
--
ALTER TABLE `ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `referencekey`
--
ALTER TABLE `referencekey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `utilize`
--
ALTER TABLE `utilize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adviser`
--
ALTER TABLE `adviser`
  ADD CONSTRAINT `adviser_ibfk_1` FOREIGN KEY (`accid`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`login`) REFERENCES `account` (`id`);

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
  ADD CONSTRAINT `Book Has a Category` FOREIGN KEY (`department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`a_id`);

--
-- Constraints for table `on_update_author`
--
ALTER TABLE `on_update_author`
  ADD CONSTRAINT `on_update_author_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`a_id`),
  ADD CONSTRAINT `on_update_author_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `on_update_author_ibfk_3` FOREIGN KEY (`referer`) REFERENCES `author` (`a_id`);

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
  ADD CONSTRAINT `utilize_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilize_ibfk_2` FOREIGN KEY (`history`) REFERENCES `bookhistory` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
