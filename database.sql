/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.14-MariaDB : Database - crud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crud` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `crud`;

/*Table structure for table `networks` */

DROP TABLE IF EXISTS `networks`;

CREATE TABLE `networks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parentId` bigint(20) DEFAULT NULL,
  `childId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`),
  KEY `childId` (`childId`),
  CONSTRAINT `networks_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `users` (`id`),
  CONSTRAINT `networks_ibfk_2` FOREIGN KEY (`childId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `networks` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`FirstName`,`LastName`,`UserName`,`Password`) values (21,'admin','admin','admin2','$2y$10$t6Dd0rPv6BYHxSXX0133Q./X8fb4dNlu2eBXqZ7rWPyKhCYK/aOMG'),(22,'test','test','test','$2y$10$.QhJUL51CejDQTlAxul0Cu/ItFL5rOZW35Ert33dtT/jmhGWcGLhW'),(24,'celso','laggui','celso','$2y$10$ZConikAt3KYemLFfgCS63upV218rOkAAqKozo8Ka3Hhqxk45aXb6K'),(25,'aldrien','martinez','mahal','$2y$10$KJlJY0Sb42y.abVW/j9gaujVVNlWDdzbs1K0GOcjzGUhxuTds8YZ2'),(26,'janine','laggui','sample','$2y$10$1EExWzu911XmDHoR.uM1z.dDnLyUTZ0oU7.1F/X7QeKszKyOwRZIW');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
