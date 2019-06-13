-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2017 at 02:44 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `secondary`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL auto_increment,
  `class_name` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`) VALUES
(1, 'JSS 1A'),
(2, 'JSS 1B'),
(3, 'JSS 2A'),
(4, 'JSS 2B'),
(5, 'JSS 3A'),
(6, 'JSS 3B'),
(7, 'SSS 1A'),
(8, 'SSS 1B'),
(9, 'SSS 2A'),
(10, 'SSS 2B'),
(11, 'SSS 3A'),
(12, 'SSS 3B'),
(13, 'SSS 3C');

-- --------------------------------------------------------

--
-- Table structure for table `junior_registered`
--

CREATE TABLE `junior_registered` (
  `id` int(11) NOT NULL auto_increment,
  `admission_no` int(11) NOT NULL,
  `student_name` varchar(20) NOT NULL,
  `class_name` varchar(11) NOT NULL,
  `subname` text NOT NULL,
  `session_yr` varchar(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `junior_registered`
--

INSERT INTO `junior_registered` (`id`, `admission_no`, `student_name`, `class_name`, `subname`, `session_yr`) VALUES
(1, 12345, 'Atekombo Anadoo', 'JSS 1A', 'English Language,Mathematics,Basic Technology,Business studies,Agric-Science,Civic education,Social studies,Creative Arts,French', '2016/2017'),
(2, 1244, 'Mbalumunga Mimidoo', 'JSS 1A', 'English Language,Mathematics,Basic Technology,Business studies,Agric-Science,Civic education,Social studies,Creative Arts,French', '2016/2017'),
(3, 22591, 'Atekombo Anadoo', 'JSS 1A', 'English Language,Mathematics,Basic Technology,Business studies,Agric-Science,Civic education,Social studies,Creative Arts,French', '2016/2017');

-- --------------------------------------------------------

--
-- Table structure for table `postion`
--

CREATE TABLE `postion` (
  `score_id` int(20) NOT NULL auto_increment,
  `admission_no` int(20) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `total` int(20) NOT NULL,
  PRIMARY KEY  (`score_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `postion`
--

INSERT INTO `postion` (`score_id`, `admission_no`, `student_name`, `class_name`, `total`) VALUES
(1, 12345, 'Kuleve Pineter', 'SSS 3A', 697),
(2, 22599, 'Ayange Msonter', 'SSS 2A', 656),
(3, 22672, 'Gagher Terpase', 'SSS 2B', 930),
(4, 23458, 'Ayange Nguubur', 'SSS 2A', 582);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(11) unsigned NOT NULL auto_increment,
  `schoolname` text NOT NULL,
  `session_yr` int(11) unsigned NOT NULL default '0',
  `term` varchar(45) NOT NULL default '',
  `lga` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`school_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `schoolname`, `session_yr`, `term`, `lga`) VALUES
(1, 'Demonstration secondary school', 2017, 'first', 'KATSINA-ALA');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) unsigned NOT NULL auto_increment,
  `admission_no` int(10) unsigned NOT NULL default '0',
  `student_name` varchar(45) NOT NULL default '',
  `class_name` varchar(10) NOT NULL default '',
  `subname` varchar(40) NOT NULL,
  `first_ca` int(20) unsigned NOT NULL default '0',
  `second_ca` int(20) unsigned NOT NULL default '0',
  `third_ca` int(20) unsigned NOT NULL default '0',
  `exam` int(20) unsigned NOT NULL default '0',
  `total` int(11) NOT NULL,
  `session_yr` varchar(20) NOT NULL,
  `term` varchar(20) NOT NULL,
  PRIMARY KEY  (`score_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `admission_no`, `student_name`, `class_name`, `subname`, `first_ca`, `second_ca`, `third_ca`, `exam`, `total`, `session_yr`, `term`) VALUES
(1, 22592, 'Ayange Msonter', 'SSS 2A', 'Mathematics', 4, 7, 10, 56, 77, '2016/2017', 'first'),
(2, 22593, 'Ayange Nguubur', 'SSS 2A', 'Mathematics', 4, 8, 2, 64, 78, '2016/2017', 'first'),
(3, 22592, 'Ayange Msonter', 'SSS 2A', 'English Language', 4, 8, 10, 64, 86, '2016/2017', 'first'),
(4, 22593, 'Ayange Nguubur', 'SSS 2A', 'English Language', 4, 8, 6, 56, 74, '2016/2017', 'first'),
(5, 22590, 'Atekombo Anadoo', 'JSS 1A', 'English Language', 2, 7, 2, 34, 45, '2016/2017', 'first'),
(6, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'English Language', 8, 10, 7, 45, 70, '2016/2017', 'first'),
(7, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Mathematics', 4, 10, 6, 64, 84, '2016/2017', 'second'),
(8, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Mathematics', 5, 8, 6, 55, 74, '2016/2017', 'second'),
(9, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Mathematics', 4, 10, 6, 34, 54, '2016/2017', 'first'),
(10, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Mathematics', 2, 10, 10, 65, 87, '2016/2017', 'first'),
(11, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Creative Arts', 5, 7, 2, 45, 59, '2016/2017', 'first'),
(12, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Creative Arts', 7, 9, 10, 67, 93, '2016/2017', 'first'),
(13, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Civic education', 3, 6, 9, 59, 77, '2016/2017', 'first'),
(14, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Civic education', 10, 5, 9, 60, 84, '2016/2017', 'first'),
(18, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Basic science and Technology', 8, 9, 5, 61, 83, '2016/2017', 'first'),
(17, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Basic science and Technology', 7, 5, 6, 60, 78, '2016/2017', 'first'),
(19, 22590, 'Atekombo Anadoo', 'JSS 1A', 'French', 9, 10, 10, 55, 84, '2016/2017', 'first'),
(20, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'French', 8, 7, 9, 59, 83, '2016/2017', 'first'),
(21, 22590, 'Atekombo Anadoo', 'JSS 1A', 'Social studies', 6, 8, 5, 49, 68, '2016/2017', 'first'),
(22, 22591, 'Mbalumunga Mimidoo', 'JSS 1A', 'Social studies', 8, 9, 4, 57, 78, '2016/2017', 'first'),
(24, 22592, 'Ayange Msonter', 'SSS 2A', 'Geography', 4, 8, 2, 45, 59, '2016/2017', 'first'),
(25, 22593, 'Ayange Nguubur', 'SSS 2A', 'Geography', 4, 10, 5, 64, 83, '2016/2017', 'first');

-- --------------------------------------------------------

--
-- Table structure for table `score_entry`
--

CREATE TABLE `score_entry` (
  `score_id` int(11) NOT NULL auto_increment,
  `admission_no` int(11) NOT NULL,
  `student_name` varchar(20) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `subname` varchar(50) NOT NULL,
  `first_ca` varchar(11) NOT NULL,
  `second_ca` varchar(11) NOT NULL,
  `third_ca` varchar(11) NOT NULL,
  `exam` varchar(11) NOT NULL,
  `total` varchar(20) NOT NULL,
  `session_yr` varchar(20) NOT NULL,
  `term` varchar(20) NOT NULL,
  PRIMARY KEY  (`score_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `score_entry`
--

INSERT INTO `score_entry` (`score_id`, `admission_no`, `student_name`, `class_name`, `subname`, `first_ca`, `second_ca`, `third_ca`, `exam`, `total`, `session_yr`, `term`) VALUES
(1, 34980, 'Mbalumunga Mimidoo', 'JSS 1A', 'English Language', '2', '7', '2', '45', '56', '2016/2017', 'first'),
(2, 22591, 'Atekombo Anadoo', 'JSS 1A', 'English Language', '4', '4', '2', '45', '55', '2016/2017', 'first'),
(3, 34980, 'Mbalumunga Mimidoo', 'JSS 1A', 'English Language', '2', '4', '2', '50', '58', '2016/2017', 'second'),
(4, 22591, 'Atekombo Anadoo', 'JSS 1A', 'English Language', '5', '7', '2', '64', '78', '2016/2017', 'second');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_yr` varchar(20) NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_yr`) VALUES
(1, '2016/2017');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) unsigned NOT NULL auto_increment,
  `student_name` varchar(45) NOT NULL default '',
  `admission_no` int(20) unsigned NOT NULL default '0',
  `class_name` varchar(10) NOT NULL default '0',
  `gender` varchar(10) NOT NULL default '',
  `dob` varchar(45) NOT NULL default '',
  `lga` varchar(45) NOT NULL default '',
  `state` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `admission_no`, `class_name`, `gender`, `dob`, `lga`, `state`) VALUES
(1, 'Atekombo Anadoo', 22590, 'JSS 1A', 'female', '2008/8/8', 'Ushongo', 'Benue'),
(2, 'Mbalumunga Mimidoo', 22591, 'JSS 1A', 'female', '2006/8/4', 'Katsina-ala', 'Benue'),
(3, 'Ayange Msonter', 22592, 'SSS 2A', 'male', '2000/4/2', 'Katsina-ala', 'Benue'),
(4, 'Ayange Nguubur', 22593, 'SSS 2A', 'female', '1999/3/6', 'Katsina-ala', 'Benue');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) unsigned NOT NULL auto_increment,
  `subname` varchar(45) NOT NULL default '',
  `subject_for` varchar(500) NOT NULL,
  PRIMARY KEY  (`subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subname`, `subject_for`) VALUES
(3, 'Basic science', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D'),
(4, 'Basic Technology', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D'),
(28, 'English Language', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D,SSS 1A,SSS 1B,SSS 1C,SSS 1D,SSS 2A,SSS 2B,SSS 2C,SSS 2D,SSS 3A,SSS 3B,SSS 3C,SSS 3D'),
(6, 'Business studies', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D'),
(8, 'Civic education', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D,SSS 1A,SSS 1B,SS'),
(9, 'Social studies', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D'),
(10, 'French', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D'),
(11, 'Physics', 'SSS 1A,SSS 1B,SSS 2A,SSS 2B,SSS 3A,SSS 3B'),
(12, 'Chemistry', 'SSS 1A,SSS 1B,SSS 2A,SSS 2B,SSS 3A,SSS 3B'),
(13, 'Geography', 'SSS 1A,SSS 1C,SSS 2A,SSS 2C,SSS 3A,SSS 3C'),
(14, 'Economics', 'SSS 1A,SSS 1C,SSS 1D,SSS 2A,SSS 2C,SSS 2D,SSS 3A,SSS 3C,SSS 3D'),
(15, 'Biology', 'SSS 1A,SSS 1B,SSS 1C,SSS 1D,SSS 2A,SSS 2B,SSS 2C,SSS 2D,SSS 3A,SSS 3B,SSS 3C,SSS 3D'),
(16, 'Further-Mathematics', 'SSS 1A,SSS 1B,SSS 2A,SSS 2B,SSS 3A,SSS 3B'),
(17, 'Government', 'SSS 1C,SSS 1D,SSS 2C,SSS 2D,SSS 3C,SSS 3D'),
(18, 'Literature-in-English', 'SSS 1C,SSS 2C,SSS 3C'),
(19, 'Commence', 'SSS 1D,SSS 2D,SSS 3D'),
(20, 'Accounting', 'SSS 1D,SSS 2D,SSS 3D'),
(21, 'Applied electricity', 'SSS 1B,SSS 2B,SSS 3B'),
(22, 'wood work', 'SSS 1B,SSS 2B,SSS 3B'),
(23, 'Technical drawing', 'SSS 1B,SSS 2B,SSS 3B'),
(24, 'Auto-mechanics', 'SSS 1B,SSS 2B,SSS 3B'),
(30, 'Agric-Science', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D,SSS 1A,SSS 1B,SSS 1C,SSS 1D,SSS 2A,SSS 2B,SSS 2C,SSS 2D,SSS 3A,SSS 3B,SSS 3C,SSS 3D'),
(29, 'Mathematics', 'JSS 1A,JSS 1B,JSS 1C,JSS 1D,JSS 2A,JSS 2B,JSS 2C,JSS 2D,JSS 3A,JSS 3B,JSS 3C,JSS 3D,SSS 1A,SSS 1B,SSS 1C,SSS 1D,SSS 2A,SSS 2B,SSS 2C,SSS 2D,SSS 3A,SSS 3B,SSS 3C,SSS 3D'),
(33, 'Civic education', 'SSS 1A,SSS 1B,SSS 1C,SSS 1D,SSS 2A,SSS 2B,SSS 2C,SSS 2D,SSS 3A,SSS 3B,SSS 3C,SSS 3D');

-- --------------------------------------------------------

--
-- Table structure for table `subject_registered`
--

CREATE TABLE `subject_registered` (
  `id` int(11) NOT NULL auto_increment,
  `admission_no` int(11) NOT NULL,
  `student_name` varchar(20) NOT NULL,
  `class_name` varchar(11) NOT NULL,
  `subname` text NOT NULL,
  `session_yr` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subject_registered`
--

INSERT INTO `subject_registered` (`id`, `admission_no`, `student_name`, `class_name`, `subname`, `session_yr`) VALUES
(1, 22592, 'Ayange Msonter', 'SSS 2A', 'English Language,Mathematics,Geography,Economics,Biology,Chemistry,Further-Mathematics,Physics,Civic education,Agric-Science', '2016/2017'),
(2, 22593, 'Ayange Nguubur', 'SSS 2A', 'English Language,Mathematics,Geography,Economics,Biology,Chemistry,Physics,Civic education,Agric-Science', '2016/2017');

-- --------------------------------------------------------

--
-- Table structure for table `sub_junior`
--

CREATE TABLE `sub_junior` (
  `id` int(11) NOT NULL auto_increment,
  `subname` varchar(40) NOT NULL,
  `subject_for` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sub_junior`
--

INSERT INTO `sub_junior` (`id`, `subname`, `subject_for`) VALUES
(1, 'English Language', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(2, 'Mathematics', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(3, 'Creative Arts', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(4, 'Civic education', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(5, 'Basic science and Technology', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(6, 'French', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B'),
(7, 'Social studies', 'JSS 1A,JSS 1B,JSS 2A,JSS 2B,JSS 3A,JSS 3B');

-- --------------------------------------------------------

--
-- Table structure for table `sub_senior`
--

CREATE TABLE `sub_senior` (
  `id` int(11) NOT NULL auto_increment,
  `subname` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sub_senior`
--

INSERT INTO `sub_senior` (`id`, `subname`) VALUES
(1, 'English Language'),
(2, 'Mathematics'),
(3, 'Geography'),
(4, 'Economics'),
(5, 'Accounting'),
(6, 'Biology'),
(7, 'Chemistry'),
(8, 'Further-Mathematics'),
(9, 'Physics'),
(10, 'Commence'),
(11, 'Literature-in-English'),
(12, 'Technical drawing'),
(13, 'Applied electricity'),
(14, 'Civic education'),
(15, 'Agric-Science');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(45) NOT NULL default '',
  `username` varchar(45) NOT NULL default '',
  `password` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `email`, `username`, `password`) VALUES
(1, 'gagherterpase@gmail.com', 'theophicz', 'theo'),
(2, 'ayangefelix8@gmail.com', 'felix123', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `test1`
--

CREATE TABLE `test1` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(45) NOT NULL default '',
  `firstname` varchar(45) NOT NULL default '',
  `lastname` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `test1`
--

INSERT INTO `test1` (`id`, `username`, `firstname`, `lastname`) VALUES
(1, 'theophicz', '', ''),
(2, 'felix123', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `test3`
--

CREATE TABLE `test3` (
  `score_id` int(11) unsigned NOT NULL auto_increment,
  `student_id` int(11) unsigned NOT NULL default '0',
  `class_name` varchar(45) NOT NULL default '',
  `subname` varchar(45) NOT NULL default '',
  `first_ca` int(11) unsigned NOT NULL default '0',
  `second_ca` int(11) unsigned NOT NULL default '0',
  `third_ca` int(11) unsigned NOT NULL default '0',
  `exam` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`score_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `test3`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(45) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'Felix', '12345');
