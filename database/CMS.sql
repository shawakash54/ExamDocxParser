/*
SQLyog Ultimate v8.5 
MySQL - 5.6.17 : Database - cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cms`;

/*Table structure for table `cms_chapter` */

DROP TABLE IF EXISTS `cms_chapter`;

CREATE TABLE `cms_chapter` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `chapter_id` varchar(255) DEFAULT NULL,
  `chapter_name` varchar(255) DEFAULT NULL,
  `parent_section_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cms_chapter` */

insert  into `cms_chapter`(`id`,`chapter_id`,`chapter_name`,`parent_section_id`) values (1,'CH_10','FOR LOOP',4),(2,'CH_11','WHILE LOOP',4),(3,'CH_12','FOR LOOP',4),(4,'CH_13','FOR EACH',4),(5,'CH_21','Arrays - Linear',5),(6,'CH_22','Arrays - 2D',5),(7,'CH_23','Arrays - Linked List',5),(8,'CH_24','Arrays - Basics',5);

/*Table structure for table `cms_course` */

DROP TABLE IF EXISTS `cms_course`;

CREATE TABLE `cms_course` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cms_course` */

insert  into `cms_course`(`id`,`course_id`,`course_name`) values (1,'CSEN_1102','Introduction To Computing'),(2,'CSEN_1103','Introduction To C'),(3,'CSEN_3254','Introduction to Data Structures'),(4,'CSEN_3225','Algorithms'),(5,'CSEN_1452','Computer Architecture'),(6,'CSEN_1450','Java Programming'),(7,'CSEN_1542','Micro Controllers');

/*Table structure for table `cms_section` */

DROP TABLE IF EXISTS `cms_section`;

CREATE TABLE `cms_section` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `section_id` varchar(255) DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `parent_course_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `cms_section` */

insert  into `cms_section`(`id`,`section_id`,`section_name`,`parent_course_id`) values (1,'SEC_125','Linked List',3),(2,'SEC_126','Tree',3),(3,'SEC_127','Hashing',3),(4,'SEC_225','C - Loops',2),(5,'SEC_226','C - Arrays',2),(6,'SEC_227','C - Functions',2),(8,'SEC_228','C - Pointers',2),(9,'SEC_229','C - Strings',2),(10,'SEC_230','C - Recursion',2);

/*Table structure for table `cms_topics` */

DROP TABLE IF EXISTS `cms_topics`;

CREATE TABLE `cms_topics` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `topic_id` varchar(255) DEFAULT NULL,
  `topic_name` varchar(255) DEFAULT NULL,
  `parent_chapter_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cms_topics` */

insert  into `cms_topics`(`id`,`topic_id`,`topic_name`,`parent_chapter_id`) values (1,'TOP_10','FOR Loops Basics',1),(2,'TOP_11','FOR Loops Examples',1),(3,'TOP_12','FOR Loops Special Cases',1),(4,'TOP_20','WHILE Loops Basics',2),(5,'TOP_21','WHILE Loops Examples',2),(6,'TOP_22','WHILE Loops Special Cases',2),(7,'TOP_13','FOR Loops with Array',1),(8,'TOP_23','WHILE Loops Infinite',2);

/*Table structure for table `cms_user_details` */

DROP TABLE IF EXISTS `cms_user_details`;

CREATE TABLE `cms_user_details` (
  `user_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(200) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_mob` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cms_user_details` */

insert  into `cms_user_details`(`user_id`,`user_email`,`user_name`,`user_pass`,`user_dob`,`user_mob`) values (1,'akshay12@gmail.com','Akshay Khanna','AKSHAY','1990-05-20','9014536596'),(2,'aman11@gmail.com','Aman Kumar','AMAN','1985-02-18','9785426355'),(3,'amankumar@gmail.com','Aman Kumar','AMAN','2017-02-09','9856523659');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
