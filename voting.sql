-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 12:50 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `candidate_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `party_id` int(11) NOT NULL,
  `candidate_photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `electoral_position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `candidates`
--

TRUNCATE TABLE `candidates`;
--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `candidate_name`, `party_id`, `candidate_photo`, `electoral_position_id`) VALUES
(1, 'Uhuru Muigai Kenyatta', 1, 'c94ab-uhuru-tna-poster.jpg', 1),
(2, 'Raila Amolo Odinga', 3, '7b221-dsc_0185.jpg', 1),
(3, 'Juliet Cheng', 1, '77025-4.png', 1),
(4, 'Carol Radul', 2, 'f35a0-win.png', 2),
(5, 'Martin Shirandula', 1, 'aefbf-edu.png', 3),
(6, 'John Namu', 3, '4402e-3.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `ci_sessions`
--

TRUNCATE TABLE `ci_sessions`;
-- --------------------------------------------------------

--
-- Table structure for table `electoral_positions`
--

DROP TABLE IF EXISTS `electoral_positions`;
CREATE TABLE `electoral_positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `position_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `electoral_positions`
--

TRUNCATE TABLE `electoral_positions`;
--
-- Dumping data for table `electoral_positions`
--

INSERT INTO `electoral_positions` (`position_id`, `position_name`, `position_details`) VALUES
(1, 'Chairman', '<p>\r\n	The overall foreseer of all activities</p>\r\n'),
(2, 'Organising Secretary', '<p>\r\n	Cordinate all activities and organise meetings</p>\r\n'),
(3, 'Treasurer', '<p>\r\n	Manages all financial records</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

DROP TABLE IF EXISTS `parties`;
CREATE TABLE `parties` (
  `party_id` int(11) NOT NULL,
  `party_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `party_initials` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `party_symbol` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `parties`
--

TRUNCATE TABLE `parties`;
--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`party_id`, `party_name`, `party_initials`, `party_symbol`) VALUES
(1, 'Kanu', 'Kanu', 'cc0ad-despicableme.jpg'),
(2, 'Party of National Unity', 'PNU', 'a7376-millers.jpg'),
(3, 'Orange Democratic Party', 'ODM', 'cc9dd-orange.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE `user_accounts` (
  `uacc_id` int(11) UNSIGNED NOT NULL,
  `uacc_group_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_email` varchar(100) NOT NULL DEFAULT '',
  `uacc_username` varchar(15) NOT NULL DEFAULT '',
  `uacc_password` varchar(60) NOT NULL DEFAULT '',
  `uacc_ip_address` varchar(40) NOT NULL DEFAULT '',
  `uacc_salt` varchar(40) NOT NULL DEFAULT '',
  `uacc_activation_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_forgotten_password_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_forgotten_password_expire` datetime ,
  `uacc_update_email_token` varchar(40) NOT NULL DEFAULT '',
  `uacc_update_email` varchar(100) NOT NULL DEFAULT '',
  `uacc_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_suspend` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `uacc_fail_login_attempts` smallint(5) NOT NULL DEFAULT '0',
  `uacc_fail_login_ip_address` varchar(40) NOT NULL DEFAULT '',
  `uacc_date_fail_login_ban` datetime  COMMENT 'Time user is banned until due to repeated failed logins',
  `uacc_date_last_login` datetime ,
  `uacc_date_added` datetime 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_accounts`
--

TRUNCATE TABLE `user_accounts`;
--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`uacc_id`, `uacc_group_fk`, `uacc_email`, `uacc_username`, `uacc_password`, `uacc_ip_address`, `uacc_salt`, `uacc_activation_token`, `uacc_forgotten_password_token`, `uacc_forgotten_password_expire`, `uacc_update_email_token`, `uacc_update_email`, `uacc_active`, `uacc_suspend`, `uacc_fail_login_attempts`, `uacc_fail_login_ip_address`, `uacc_date_fail_login_ban`, `uacc_date_last_login`, `uacc_date_added`) VALUES
(1, 1, 'morrismukiri@gmail.com', 'morris', '$2a$08$x.00afPjz9j3ygG32GGcauqBQSNdSUtXutiKnjyAbxV4MibqVQ2K6', '::1', 'fYmFgq9pd2', 'f78be2c13abb36a0d8cb6a143ae431f57a94759c', '', NULL, '', '', 1, 0, 0, '', NULL, '2017-02-28 21:11:07', '2013-08-31 13:29:54'),
(2, 1, 'jreno@gmail.com', 'jreno', '$2a$08$W9J0kE0uxAYJouUCpWni1eEuw.i8iGv9YPqWJ5hU9vOOGkYHfsvNe', '127.0.0.1', 'yvfnQr6yPf', '36155ad6b7cca372ebbd5d0ac1e4a1fa16c468c2', '', NULL, '', '', 0, 0, 0, '', NULL, '2013-08-31 14:56:07', '2013-08-31 14:56:07'),
(3, 1, 'joereno@gmail.com', 'joereno', '$2a$08$T8n7nE7bQOmcsJ5xse0VIezM8UZ08pqsw12VCTIL3lL2qpvbaml22', '127.0.0.1', '3PT9YGM2JP', '', '', NULL, '', '', 1, 0, 1, '127.0.0.1', NULL, '2013-09-18 12:04:43', '2013-08-31 15:07:41'),
(4, 1, 'psimon@aol.com', 'psimon', '$2a$08$glO.dgQesdDbl2PN9MXaNeHlw.kleCHGmcc/TU/jDLNbcMGUoatXG', '127.0.0.1', '2k3whPbtcw', '', '', NULL, '', '', 1, 0, 0, '', NULL, '2013-09-03 12:13:24', '2013-09-01 00:26:58'),
(5, 1, 'macmuga@gmail.com', 'macmuga', '$2a$08$PSvXCeTr6ynHLPLbPGCS3e4tXi7mQ/VT/sB4YW9pwKAl/g.kGTkK6', '127.0.0.1', '3MmbMMRZVF', '', '', NULL, '', '', 1, 0, 0, '', NULL, '2013-11-29 16:38:09', '2013-10-17 07:37:23'),
(6, 1, 'joan@gmail.com', 'joanw', '$2a$08$UBJz8hwrJwTrn2E4lYR79eEnQiechxSU77LXnAzu5BEx20vxGOe2S', '127.0.0.1', 'WnbnW2bzWM', '', '', NULL, '', '', 1, 0, 0, '', NULL, '2013-11-24 08:28:30', '2013-11-23 16:35:59'),
(7, 1, 'morrismukiri@hotmail.com', 'morrismukiri', '$2a$08$biGF0SF2CUDVzxGKkJtoju.kx0i1.ePNX4ifi9pqdI2rbyXowY6A.', '::1', 'ggMFBDF4xp', '', '', NULL, '', '', 1, 0, 0, '', NULL, '2016-08-14 18:06:12', '2016-08-14 18:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `ugrp_id` smallint(5) NOT NULL,
  `ugrp_name` varchar(20) NOT NULL DEFAULT '',
  `ugrp_desc` varchar(100) NOT NULL DEFAULT '',
  `ugrp_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_groups`
--

TRUNCATE TABLE `user_groups`;
-- --------------------------------------------------------

--
-- Table structure for table `user_login_sessions`
--

DROP TABLE IF EXISTS `user_login_sessions`;
CREATE TABLE `user_login_sessions` (
  `usess_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `usess_series` varchar(40) NOT NULL DEFAULT '',
  `usess_token` varchar(40) NOT NULL DEFAULT '',
  `usess_login_date` datetime 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_login_sessions`
--

TRUNCATE TABLE `user_login_sessions`;
--
-- Dumping data for table `user_login_sessions`
--

INSERT INTO `user_login_sessions` (`usess_uacc_fk`, `usess_series`, `usess_token`, `usess_login_date`) VALUES
(1, '', '15dda5d8103410a3d562ee949c7c1b62e90ace50', '2017-02-28 21:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

DROP TABLE IF EXISTS `user_privileges`;
CREATE TABLE `user_privileges` (
  `upriv_id` smallint(5) NOT NULL,
  `upriv_name` varchar(20) NOT NULL DEFAULT '',
  `upriv_desc` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_privileges`
--

TRUNCATE TABLE `user_privileges`;
-- --------------------------------------------------------

--
-- Table structure for table `user_privilege_groups`
--

DROP TABLE IF EXISTS `user_privilege_groups`;
CREATE TABLE `user_privilege_groups` (
  `upriv_groups_id` smallint(5) UNSIGNED NOT NULL,
  `upriv_groups_ugrp_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `upriv_groups_upriv_fk` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_privilege_groups`
--

TRUNCATE TABLE `user_privilege_groups`;
-- --------------------------------------------------------

--
-- Table structure for table `user_privilege_users`
--

DROP TABLE IF EXISTS `user_privilege_users`;
CREATE TABLE `user_privilege_users` (
  `upriv_users_id` smallint(5) NOT NULL,
  `upriv_users_uacc_fk` int(11) NOT NULL DEFAULT '0',
  `upriv_users_upriv_fk` smallint(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user_privilege_users`
--

TRUNCATE TABLE `user_privilege_users`;
-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

DROP TABLE IF EXISTS `voters`;
CREATE TABLE `voters` (
  `voter_id` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `names` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `voters`
--

TRUNCATE TABLE `voters`;
--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`voter_id`, `phone`, `confirmation_code`, `national_id`, `names`) VALUES
(2, '+254712312415', 'EqQBN', '2787173922', 'Joan Wairimu'),
(3, '+254716043576', 'CIB5B', '28164430', 'Martin Igechu'),
(4, '+254724649978', 'c3tAf', '283847192', 'John Mbaka'),
(5, '+254732959166', 'ffekG', '3923892', 'Another Voter'),
(6, '+254722892242', 'USomN', '3923323838', 'Mercy Katela'),
(7, '+254714224451', 'eSay9', '234134123', 'Martin Mwenda'),
(8, '+254701564702', 'v1QbZ', '31686839', 'Faith Mwende');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voting_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `votes`
--

TRUNCATE TABLE `votes`;
--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `voter_id`, `position_id`, `candidate_id`, `voting_time`) VALUES
(7, 6, 1, 3, '2013-11-29 13:47:01'),
(8, 4, 1, 3, '2013-11-29 14:08:52'),
(22, 5, 1, 3, '2016-08-22 08:39:36'),
(23, 5, 2, 4, '2016-08-22 08:39:36'),
(32, 7, 1, 2, '2016-08-29 18:23:43'),
(33, 7, 3, 6, '2016-08-29 18:23:47'),
(36, 3, 3, 5, '2016-08-29 19:29:59'),
(37, 7, 2, 4, '2016-08-29 19:32:36'),
(38, 3, 1, 1, '2016-09-15 14:24:28'),
(39, 3, 2, 4, '2016-09-15 14:24:28'),
(40, 8, 3, 5, '2016-12-04 18:46:26'),
(41, 8, 1, 2, '2016-12-04 18:46:51'),
(42, 8, 2, 4, '2016-12-04 18:46:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity` (`last_activity`);

--
-- Indexes for table `electoral_positions`
--
ALTER TABLE `electoral_positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`uacc_id`),
  ADD UNIQUE KEY `uacc_id` (`uacc_id`),
  ADD KEY `uacc_group_fk` (`uacc_group_fk`),
  ADD KEY `uacc_email` (`uacc_email`),
  ADD KEY `uacc_username` (`uacc_username`),
  ADD KEY `uacc_fail_login_ip_address` (`uacc_fail_login_ip_address`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`ugrp_id`),
  ADD UNIQUE KEY `ugrp_id` (`ugrp_id`) USING BTREE;

--
-- Indexes for table `user_login_sessions`
--
ALTER TABLE `user_login_sessions`
  ADD PRIMARY KEY (`usess_token`),
  ADD UNIQUE KEY `usess_token` (`usess_token`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`upriv_id`),
  ADD UNIQUE KEY `upriv_id` (`upriv_id`) USING BTREE;

--
-- Indexes for table `user_privilege_groups`
--
ALTER TABLE `user_privilege_groups`
  ADD PRIMARY KEY (`upriv_groups_id`),
  ADD UNIQUE KEY `upriv_groups_id` (`upriv_groups_id`) USING BTREE,
  ADD KEY `upriv_groups_ugrp_fk` (`upriv_groups_ugrp_fk`),
  ADD KEY `upriv_groups_upriv_fk` (`upriv_groups_upriv_fk`);

--
-- Indexes for table `user_privilege_users`
--
ALTER TABLE `user_privilege_users`
  ADD PRIMARY KEY (`upriv_users_id`),
  ADD UNIQUE KEY `upriv_users_id` (`upriv_users_id`) USING BTREE,
  ADD KEY `upriv_users_uacc_fk` (`upriv_users_uacc_fk`),
  ADD KEY `upriv_users_upriv_fk` (`upriv_users_upriv_fk`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`voter_id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `electoral_positions`
--
ALTER TABLE `electoral_positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `uacc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ugrp_id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `upriv_id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_privilege_groups`
--
ALTER TABLE `user_privilege_groups`
  MODIFY `upriv_groups_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_privilege_users`
--
ALTER TABLE `user_privilege_users`
  MODIFY `upriv_users_id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `voter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
