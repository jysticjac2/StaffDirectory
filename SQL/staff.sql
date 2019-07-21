-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 06:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `dept_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`) VALUES
(1, 'Sales'),
(2, 'Accounts'),
(3, 'IT Support'),
(4, 'Marketing'),
(5, 'Research'),
(6, 'Engineering'),
(7, 'Legal'),
(8, 'Human Resources');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key',
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(35) DEFAULT NULL,
  `profile` longtext,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `dept_id`, `first_name`, `last_name`, `profile`, `photo`) VALUES
(1, 1, 'Salina', 'Keithley', 'Lorem ipsum dolor sit amet, usu ut feugiat propriae vituperatoribus. No nec numquam appellantur, qui populo persius offendit eu, ne sed solum fugit. Te his feugiat omittantur, at eam noster voluptaria inciderint. At doming eirmod labitur usu, eam option vidisse diceret te. Etiam inimicus an vix, nostro maiestatis vix et. Vel ut quis error causae.', ''),
(2, 1, 'Brianne', 'Farago', 'Nec ex augue labore, id possit omittam ullamcorper his. No vix ridens scaevola, ut laboramus argumentum vim. Ut singulis periculis scriptorem vix, volutpat ullamcorper sit te. Ex quod partem per. Eius deleniti at sit, regione phaedrum eu qui, at vocent pericula mea. Sale pertinacia ad vis, volumus omittam an mel, constituto mediocritatem sea ei.', 'istockphoto-472145599-1024x1024.jpg'),
(3, 1, 'Denyse', 'Polich', 'Cum ei salutatus honestatis, enim minim eirmod mel ei. His nostro inermis persecuti eu. Est id cetero contentiones, ius et veri meis. Id ipsum definiebas nam, epicurei pertinax ad mea, vim reque placerat ut.', 'istockphoto-608157219-1024x1024.jpg'),
(4, 1, 'Amada', 'Afanador', 'Fabellas euripidis pro no. Nam legere eloquentiam ei, mei quod fabulas pertinacia at. Duo no latine vidisse pericula, illud animal accusam mea no. Mazim sadipscing ad vis, pro et graeci intellegam. Id vim utinam docendi legendos, has in soleat suavitate. Mei ne unum omnium aliquam.', 'istockphoto-1079786018-1024x1024.jpg'),
(5, 1, 'Jason', 'Lamotte', 'Nec ex augue labore, id possit omittam ullamcorper his. No vix ridens scaevola, ut laboramus argumentum vim. Ut singulis periculis scriptorem vix, volutpat ullamcorper sit te. Ex quod partem per. Eius deleniti at sit, regione phaedrum eu qui, at vocent pericula mea. Sale pertinacia ad vis, volumus omittam an mel, constituto mediocritatem sea ei.', 'istockphoto-1009679806-1024x1024.jpg'),
(6, 2, 'Meta', 'Thorpe', 'Ut per adhuc mentitum voluptatum, quas mollis inimicus ne cum. Nec at animal fabellas, at eum mutat hendrerit. Et vim petentium referrentur, tempor abhorreant sed no. Nulla quodsi nec ei. Et apeirian perfecto pri, ad nulla vituperata usu. Voluptua lucilius repudiandae ex nam, alia brute convenire nec eu.', 'istockphoto-666540180-1024x1024.jpg'),
(7, 2, 'Vernetta', 'Pence', 'Vel at vidit dicit, legere persecuti vix ne. Cum movet scaevola ut, nemore equidem democritum quo te. An idque ubique facilis vix. Te veri oblique pertinax has.', 'istockphoto-1066452982-1024x1024.jpg'),
(8, 2, 'Gerry', 'Darville', 'Eu lorem postea eleifend usu. Elit inani dignissim cu pri. Te viderer eruditi forensibus eam, mel vidit mandamus te. Quis omnes consequuntur his ei, habeo exerci altera te mei, probo aperiri habemus et quo. Eius tritani dissentias ea pri, ex mundi instructior sed, eum eruditi meliore te. Iudicabit accommodare ea mei, te harum suscipit platonem sea.', ''),
(9, 3, 'Jack', 'Joyce', 'Nec ex augue labore, id possit omittam ullamcorper his. No vix ridens scaevola, ut laboramus argumentum vim. Ut singulis periculis scriptorem vix, volutpat ullamcorper sit te. Ex quod partem per. Eius deleniti at sit, regione phaedrum eu qui, at vocent pericula mea. Sale pertinacia ad vis, volumus omittam an mel, constituto mediocritatem sea ei.', 'istockphoto-1009676960-1024x1024.jpg'),
(10, 3, 'Hermila', 'Buntin', 'Illum consetetur per ea. Vel an amet lorem, ex eos aperiri dissentiet liberavisse. Viris postea eu pri, nam falli officiis no. Cu duis definiebas ullamcorper mea. Ad duo feugait consulatu, et vim iudico lobortis. Ne civibus constituam scripserit has, ea affert doctus est. Harum everti facilisi vim id.', ''),
(11, 3, 'Charlsie', 'Filice', 'Fabellas euripidis pro no. Nam legere eloquentiam ei, mei quod fabulas pertinacia at. Duo no latine vidisse pericula, illud animal accusam mea no. Mazim sadipscing ad vis, pro et graeci intellegam. Id vim utinam docendi legendos, has in soleat suavitate. Mei ne unum omnium aliquam.', ''),
(12, 4, 'Melodee', 'Siemens', 'Vel at vidit dicit, legere persecuti vix ne. Cum movet scaevola ut, nemore equidem democritum quo te. An idque ubique facilis vix. Te veri oblique pertinax has.', ''),
(13, 4, 'Santa', 'Partridge', 'Vix ad melius liberavisse disputationi. Ea his quod putent, vel ea verear adolescens. Has quod docendi deterruisset ne, sumo luptatum an cum, pri et accusata interesset. Aperiri fierent instructior ad his, mei eu ceteros mnesarchum. At mucius complectitur pro. Tamquam recteque voluptaria ut vel, ad his dolore audiam.', ''),
(14, 4, 'Randal', 'Duffie', 'Vel at vidit dicit, legere persecuti vix ne. Cum movet scaevola ut, nemore equidem democritum quo te. An idque ubique facilis vix. Te veri oblique pertinax has.', ''),
(15, 5, 'Faviola', 'Horrigan', 'Vel at vidit dicit, legere persecuti vix ne. Cum movet scaevola ut, nemore equidem democritum quo te. An idque ubique facilis vix. Te veri oblique pertinax has.', ''),
(16, 5, 'Tynisha', 'Weinstock', 'Nisl choro utinam per ne, munere ridens oblique no pri. Inani atomorum reformidans mel ne, nec ne equidem philosophia. Eius movet audiam eos cu, vel te quot duis tritani. Id alterum copiosae vix. Mea in diceret minimum tacimates. Sea eu inani commune tractatos.', ''),
(17, 5, 'Jessenia', 'Gribble', 'Fabellas euripidis pro no. Nam legere eloquentiam ei, mei quod fabulas pertinacia at. Duo no latine vidisse pericula, illud animal accusam mea no. Mazim sadipscing ad vis, pro et graeci intellegam. Id vim utinam docendi legendos, has in soleat suavitate. Mei ne unum omnium aliquam.', ''),
(18, 6, 'Jenifer', 'Groth', 'Idque doming percipitur eu mei. Everti consequat ei ius. Ut mel alia eirmod eripuit, ex vel omnis voluptatibus, omittam mentitum maluisset et eum. An quo delenit legimus menandri, pri ad brute ubique noluisse. Cu mei quot interpretaris. Mel cu prima soluta.', ''),
(19, 6, 'Dominga', 'Maharaj', 'Idque doming percipitur eu mei. Everti consequat ei ius. Ut mel alia eirmod eripuit, ex vel omnis voluptatibus, omittam mentitum maluisset et eum. An quo delenit legimus menandri, pri ad brute ubique noluisse. Cu mei quot interpretaris. Mel cu prima soluta.', ''),
(20, 7, 'Dania', 'Corona', 'Nisl choro utinam per ne, munere ridens oblique no pri. Inani atomorum reformidans mel ne, nec ne equidem philosophia. Eius movet audiam eos cu, vel te quot duis tritani. Id alterum copiosae vix. Mea in diceret minimum tacimates. Sea eu inani commune tractatos.', ''),
(21, 7, 'Magali', 'Six', 'Atqui euripidis eos ad, in est meliore nominavi indoctum. Ignota quaeque fierent quo ei, ad ius audire habemus. Odio facer te mei, nec no eruditi petentium disputando. Et his probo quaeque splendide. Duo ad semper scripta commune, justo populo no mea, ei vero falli quo.', ''),
(22, 8, 'Jesenia', 'Cardello', 'Idque doming percipitur eu mei. Everti consequat ei ius. Ut mel alia eirmod eripuit, ex vel omnis voluptatibus, omittam mentitum maluisset et eum. An quo delenit legimus menandri, pri ad brute ubique noluisse. Cu mei quot interpretaris. Mel cu prima soluta.', ''),
(23, 8, 'Myesha', 'Mulcahy', 'Nec ex augue labore, id possit omittam ullamcorper his. No vix ridens scaevola, ut laboramus argumentum vim. Ut singulis periculis scriptorem vix, volutpat ullamcorper sit te. Ex quod partem per. Eius deleniti at sit, regione phaedrum eu qui, at vocent pericula mea. Sale pertinacia ad vis, volumus omittam an mel, constituto mediocritatem sea ei.', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`) VALUES
(1, 'admin', 'admin'),
(8, 'kusum', 'Test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
