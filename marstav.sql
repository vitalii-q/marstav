-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: marstav
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `creator_id` int NOT NULL,
  `rate_id` int DEFAULT NULL,
  `paid` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(512) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `board` varchar(4000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (2,1,4,'2026-12-24 04:26:25','Marstav','marstav_7cd82ced73d41e1d740d7d6d3009','Структуризация бизнеса','Пятница сокращенный день до 18:00','2022-08-31 18:10:11','2022-12-24 04:26:33'),(6,2,NULL,NULL,'getwell','_4caec7f69e269941a4e8d560d5b7',NULL,NULL,'2022-09-06 13:23:32','2022-09-06 13:23:32'),(7,13,NULL,NULL,'test','_ecbef79776386830a2b4f06a3ec7',NULL,NULL,'2022-09-28 05:58:38','2022-09-28 05:58:38'),(22,19,2,NULL,'mm','mm_7e53255a3528d4a0337e020be88c',NULL,NULL,'2022-10-07 04:12:45','2022-10-07 04:12:45'),(25,21,3,'2022-11-07 08:04:12','Company','company_cc1e41d4cdf1d08a6053b51b8d42748a',NULL,NULL,'2022-10-07 11:04:12','2022-10-07 11:04:12');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `private_email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `private_phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `born` varchar(255) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `code` varchar(1500) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,1,'Вася1','Пупкин1','Пушкович1','Губернатор1','ООО \"Электронефть\"1','test1@mail.ru','privet1@mail.ru','(524) 657-6571','(524) 657-6571','street 451','22/06/1991','Zametka1111','adminov_c8bdebdd79a104eebd3456be67cfe4bd','2022-09-21 00:55:11','2022-09-20 17:15:31'),(2,1,'Петя','Пупкин','Петрович','Губернатор 2','ООО \"Электронефть\"','test@mail.ru','private@mail.ru','(524) 657-6574','(524) 657-6574','street 45','22/06/1991','ыыы','fhfgdhglesirjcujiord','2022-09-21 01:21:37','2022-09-20 17:17:05'),(3,1,'Треска',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-20 17:18:10','2022-09-20 17:18:10'),(4,1,'Федя',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-20 17:18:54','2022-09-20 17:18:54'),(5,1,'Жора',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fhdgfhf','2022-09-21 03:45:11','2022-09-20 17:19:57'),(6,1,'Витёк',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Adminov17aee51a60a00c06fa5c8002a9b31358','2022-09-20 18:38:00','2022-09-20 18:38:00'),(7,1,'Игорь','Жданов',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Adminovcf4a7101f4505ecb1f7d1d3b94523a1a','2022-09-20 18:38:54','2022-09-20 18:38:54'),(8,1,'Август',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Adminovc70bcf1fcb4c43c797cf3ff71a022efa','2022-09-20 18:45:59','2022-09-20 18:45:59'),(9,1,'Трэш',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Adminovf044b8a751f727d96f04e763489c32f4','2022-09-20 18:46:14','2022-09-20 18:46:14'),(10,1,'Рили','Августов',NULL,NULL,NULL,NULL,NULL,'(524) 657-6574',NULL,NULL,NULL,NULL,'Adminovbcecde68626619688d98ad7e23157290','2022-09-20 18:47:50','2022-09-20 18:47:50'),(11,1,'Петя','Яшкин',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Adminov2fd7a447cffe031661bff03e82c94171','2022-09-20 18:48:08','2022-09-20 18:48:08'),(12,1,'Рубик','Яковлев',NULL,'SEO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'adminov_f60a2e6ed70dac21ba91b98967dda87d','2022-09-20 18:52:30','2022-09-20 18:52:30'),(13,6,'Новый','Конин',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Vasya_c474d24438262b2471c143321f7e58d7','2022-09-20 18:53:56','2022-09-20 18:53:56'),(14,6,'Вика','Фика',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vasya_9f8f0568fa538c7993a4b3d0501b1f84','2022-09-20 18:54:31','2022-09-20 18:54:31'),(15,6,'Даша','Букаша',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Ронов_a1f9aa98f72d2b9a662731fe913406fe','2022-09-20 18:56:10','2022-09-20 18:56:10'),(16,2,'Гена','Пукин',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'userov_07c72b5432f2a33365f36552b556fd14','2022-09-20 21:02:55','2022-09-20 21:02:55'),(17,6,'Света','Лукина',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Ronov_4d5e3a6d13419c71f641f1b6624fad4f','2022-09-20 21:03:51','2022-09-20 21:03:51'),(18,6,'Ёка','Аламин',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Ronov_b1a03eb9b01b6eda73afa39e139708c2','2022-09-20 21:06:37','2022-09-20 21:06:37'),(19,6,'Ы','Ява',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ronov_f58c89dfaa8eae99a4227a751c96d4b3','2022-09-20 21:23:15','2022-09-20 21:23:15'),(20,6,'Ёшка','Алёшка',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vasya_606d7a69c5250bc1a721e63ebaa7c3b4','2022-09-20 21:23:57','2022-09-20 21:23:57'),(22,22,NULL,'Пупкин',NULL,NULL,NULL,NULL,NULL,'(798) 506-5290',NULL,NULL,NULL,NULL,'user_beaebe109f9cb9900f91264e041c9f8d','2022-10-10 00:09:17','2022-10-10 02:46:46'),(23,2,'Вася','Пупкин','Пушкович','SEO','ООО \"Электронефть\"','Vasya27@mail.ru',NULL,'(798) 506-5290','(798) 506-5290','Пушкина 45','22/06/1991',NULL,'userov_3c6d6887d723ea773162e3d8d45a96c2','2022-12-24 04:43:45','2022-12-24 04:43:45');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deal_stages`
--

DROP TABLE IF EXISTS `deal_stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deal_stages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `position` int DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deal_stages`
--

LOCK TABLES `deal_stages` WRITE;
/*!40000 ALTER TABLE `deal_stages` DISABLE KEYS */;
INSERT INTO `deal_stages` VALUES (60,1,'Заявка','#42A5F5',1,'f3bf59b6399dbaf2','2022-09-25 23:13:22','2022-09-25 23:13:22'),(61,1,'Звонок','#32992A',5,'d502cd454c37818a','2022-09-25 23:13:22','2022-09-25 23:13:22'),(64,1,'Подбор предложения','#F542F1',6,'d7169838c73da3dc','2022-09-25 20:52:58','2022-09-25 23:44:45'),(67,1,'Предложение','#32D191',8,'9a58063a6b3f291a','2022-09-27 02:02:51','2022-09-27 05:02:14'),(70,2,'Старт','#42A5F5',5,'6ada6e45c99aa35d','2022-09-27 20:13:28','2022-09-27 23:13:15'),(72,1,'Завершение','#42A5F5',66,'fbd67d632575b7e4','2022-09-27 22:48:09','2022-09-28 01:48:01'),(73,10,'Заявка','#197ed1',1,'stage_1878923bf281dd84','2022-09-28 05:26:25','2022-09-28 05:26:25'),(74,11,'Заявка','#197ed1',1,'stage2_ab7a8f67d929afd1','2022-09-28 05:43:02','2022-09-28 05:43:02'),(75,11,'Звонок','#197ed1',2,'stage2_a2686efc6c892142','2022-09-28 05:43:02','2022-09-28 05:43:02'),(76,11,'Отправка','#197ed1',3,'stage2_554d5db291401f3e','2022-09-28 05:43:02','2022-09-28 05:43:02'),(77,12,'Заявка','#78C0FC',1,'stage2_346e5902071d43f8','2022-09-28 02:49:06','2022-09-28 05:45:23'),(78,12,'Звонок','#78C0FC',2,'stage2_19c5686323d44bd4','2022-09-28 02:49:06','2022-09-28 05:45:23'),(79,12,'Отправка','#78C0FC',3,'stage2_0f784a26acb3663c','2022-09-28 02:50:25','2022-09-28 05:45:23'),(80,13,'Заявка','#78C0FC',1,'stage4_84fcc846e2d40797','2022-09-28 05:54:22','2022-09-28 05:54:22'),(81,13,'Звонок','#78C0FC',2,'stage4_bc27540636a5b764','2022-09-28 05:54:22','2022-09-28 05:54:22'),(82,13,'Отправка','#78C0FC',3,'stage4_752824ace8140a95','2022-09-28 05:54:22','2022-09-28 05:54:22'),(83,14,'Заявка','#78C0FC',1,'stage5_2e98603c9b01c93e','2022-09-28 06:00:46','2022-09-28 06:00:46'),(84,14,'Звонок','#78C0FC',2,'stage5_4c49b3473c4518ef','2022-09-28 06:00:46','2022-09-28 06:00:46'),(85,14,'Отправка','#78C0FC',3,'stage5_06de50af4ea21b65','2022-09-28 06:00:46','2022-09-28 06:00:46'),(86,15,'Заявка','#78C0FC',1,'setting_a11e66fb6f022185','2022-09-28 21:05:37','2022-09-28 21:05:37'),(87,15,'Звонок','#78C0FC',2,'setting_5140e343bb071793','2022-09-28 21:05:37','2022-09-28 21:05:37'),(88,15,'Отправка','#78C0FC',3,'setting_f8b3c0c4a9e1ecb3','2022-09-28 21:05:37','2022-09-28 21:05:37'),(89,16,'Заявка','#78C0FC',1,'setting_95e36a7c471e867a','2022-09-30 04:02:26','2022-09-30 04:02:26'),(90,16,'Звонок','#78C0FC',2,'setting_a8ac3609e9e36314','2022-09-30 04:02:26','2022-09-30 04:02:26'),(91,16,'Отправка','#78C0FC',3,'setting_bfee3ff8e5788a8d','2022-09-30 04:02:26','2022-09-30 04:02:26'),(92,17,'Заявка','#78C0FC',1,'reg_01abfe2b0eef50d5','2022-10-02 07:43:40','2022-10-02 07:43:40'),(93,17,'Звонок','#78C0FC',2,'reg_339694352cc26640','2022-10-02 07:43:40','2022-10-02 07:43:40'),(94,17,'Отправка','#78C0FC',3,'reg_f717dfa6ebd0ac76','2022-10-02 07:43:40','2022-10-02 07:43:40'),(95,18,'Заявка','#78C0FC',1,'rate_bd45bbb9590a17bc','2022-10-03 08:15:58','2022-10-03 08:15:58'),(96,18,'Звонок','#78C0FC',2,'rate_640879f26194ab1f','2022-10-03 08:15:58','2022-10-03 08:15:58'),(97,18,'Отправка','#78C0FC',3,'rate_9f212659f1c2b3b3','2022-10-03 08:15:58','2022-10-03 08:15:58'),(98,19,'Заявка','#78C0FC',1,'vvv_22c890274f2402d0','2022-10-07 04:12:15','2022-10-07 04:12:15'),(99,19,'Звонок','#78C0FC',2,'vvv_189e8bbcb32cf7e2','2022-10-07 04:12:15','2022-10-07 04:12:15'),(100,19,'Отправка','#78C0FC',3,'vvv_f588014dd46d143c','2022-10-07 04:12:15','2022-10-07 04:12:15'),(101,20,'Заявка','#78C0FC',1,'fff_ca274f06b06366b1','2022-10-07 04:18:49','2022-10-07 04:18:49'),(102,20,'Звонок','#78C0FC',2,'fff_8d249da6844a5f4a','2022-10-07 04:18:49','2022-10-07 04:18:49'),(103,20,'Отправка','#78C0FC',3,'fff_233abad86daf08ab','2022-10-07 04:18:49','2022-10-07 04:18:49'),(104,21,'Заявка','#78C0FC',1,'vitaly_d67a421e254c110c','2022-10-07 11:03:49','2022-10-07 11:03:49'),(105,21,'Звонок','#78C0FC',2,'vitaly_46f9560fa4b8b0d9','2022-10-07 11:03:49','2022-10-07 11:03:49'),(106,21,'Отправка','#78C0FC',3,'vitaly_e3d9c9bbd55f2d09','2022-10-07 11:03:49','2022-10-07 11:03:49'),(108,22,'Заявка','#78C0FC',1,'user_9c8a967ed62a4f21','2022-10-10 02:23:00','2022-10-10 02:23:00'),(109,22,'Звонок','#78C0FC',2,'user_e6a055de6d3bb5a3','2022-10-10 02:23:00','2022-10-10 02:23:00'),(110,22,'Отправка','#78C0FC',3,'user_46b63e86aaa66ef9','2022-10-10 02:23:00','2022-10-10 02:23:00');
/*!40000 ALTER TABLE `deal_stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `stage_id` int DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `note` varchar(3000) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals`
--

LOCK TABLES `deals` WRITE;
/*!40000 ALTER TABLE `deals` DISABLE KEYS */;
INSERT INTO `deals` VALUES (1,1,61,'Новая','Маша','(524) 657-65741','test@mail.ru1','Маркетолог1','ООО \"Электронефть\"1','Изи1','25001','2022-09-30 09:00:00','Позвонить к обеду','aaa_d906aa384ec4b335ef5c0c5d','2022-09-25 23:22:26','2022-09-24 17:31:55'),(2,1,60,'Новая','Маркус Вангушев Викторович','(524) 657-65741','test@mail.ru1','Маркетолог1','ООО \"Электронефть\"1','Изи1','25001','2022-09-30 09:00:00','Позвонить к обеду','testov_4e149df49d5e84f99aa4a38e','2022-09-25 23:22:26','2022-09-24 18:20:11'),(12,1,60,'Новая','Илья','(524) 657-65741','test@mail.ru1','Маркетолог1','ООО \"Электронефть\"1','Изи1','25001','2022-09-30 09:00:00','Подумает, посоветуется с женой и братишками, норм дядька','sss_67ad4248ed28eb6054003102','2022-09-25 23:22:26','2022-09-25 00:26:36'),(15,1,61,'Звонок','Груша',NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-26 09:00:00','мерс гле','grusha_ea4418d897b1a4827bc8d717','2022-09-26 01:32:49','2022-09-25 18:58:34'),(16,1,67,'Думает','Вика','(524) 657-6574','vika@mail.ru','IT','smart','Изи','2500','2022-09-28 09:00:00','хм','vika_4978f1a2ef1ec18ed51059c0','2022-09-27 17:26:00','2022-09-25 19:11:38'),(17,1,64,NULL,'Гриша',NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-28 09:00:00',NULL,'grisha_850c4ec4d47854f8613181f1','2022-09-27 18:29:02','2022-09-25 19:19:18'),(19,1,60,NULL,'Елизавета',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Ферари','elizaveta_e10d7afef5953f83bd6f7b0c','2022-09-26 01:06:02','2022-09-26 01:06:02'),(20,1,60,'Думает','Лола',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Набрать позже','lola_7bc6ac6ac0c3120bfbd4bb0c','2022-09-26 01:06:44','2022-09-26 01:06:44'),(21,1,60,NULL,'Дядя жора','(524) 657-6574',NULL,NULL,NULL,NULL,NULL,NULL,'rytu yeveryvwrw xgdf','dyadya_zhora_34ef591451ce77a7b5de6133','2022-09-25 22:17:42','2022-09-26 01:07:59'),(25,1,60,NULL,'Валентин','(524) 657-6574',NULL,NULL,NULL,NULL,NULL,NULL,'ЛОпавщ ьдавлыпь авлды рваыщршко щшкы еырва паво павоекнкрава рек вап','valentin_84cc49efe932b4674829d530','2022-09-27 20:07:24','2022-09-27 20:07:24'),(29,1,60,'Новая','Анаталий','+79854572443','anatoly@mail.ru',NULL,NULL,NULL,NULL,'2023-12-21 09:00:00',NULL,'anataliy_deb83afc9300c24cf7ce742b','2022-12-24 01:41:08','2022-12-24 04:40:35');
/*!40000 ALTER TABLE `deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dialogs`
--

DROP TABLE IF EXISTS `dialogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dialogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  `messages` int DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dialogs`
--

LOCK TABLES `dialogs` WRITE;
/*!40000 ALTER TABLE `dialogs` DISABLE KEYS */;
INSERT INTO `dialogs` VALUES (29,2,2,1,3,'2022-12-24 01:29:32','2022-12-24 04:28:14'),(30,2,1,18,5,'2023-01-16 12:58:24','2023-01-13 16:52:29');
/*!40000 ALTER TABLE `dialogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int DEFAULT NULL,
  `comment_id` int DEFAULT NULL,
  `message_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `src` varchar(4000) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (135,67,NULL,NULL,'Going Deeper - Broken.mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/files/Going Deeper - Broken_c210e7f1.mp3',NULL,'2022-10-04 22:56:37','2022-10-04 22:56:37'),(136,68,NULL,NULL,'Going Deeper - Broken.mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/files/Going Deeper - Broken_81c48a2f.mp3',NULL,'2022-10-04 22:56:59','2022-10-04 22:56:59'),(137,NULL,18,NULL,'Результаты.docx','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/files/Результаты_bcf3bca7.docx',NULL,'2022-10-04 23:09:34','2022-10-04 23:09:34'),(163,90,NULL,NULL,'G-ZIN.mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/G-ZIN_d2394d685918.mp3',NULL,'2022-10-08 11:58:40','2022-10-08 11:58:40'),(164,NULL,27,NULL,'G-ZIN.mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/G-ZIN_861ddcfc321e.mp3',NULL,'2022-10-08 12:11:08','2022-10-08 12:11:08'),(165,NULL,28,NULL,'KOSTYAK..mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/KOSTYAK_aa11662118b8.mp3',NULL,'2022-10-08 12:16:15','2022-10-08 12:16:15'),(166,92,NULL,NULL,'KOSTYAK..mp3','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/KOSTYAK_895d7303eef9.mp3',NULL,'2022-10-08 12:16:39','2022-10-08 12:16:39'),(169,NULL,NULL,293,'2Z7MdtEFiBI.jpg','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/2Z7MdtEFiBI_fc54b8f9eb08.jpg',NULL,'2023-01-13 16:52:30','2023-01-13 16:52:30'),(170,NULL,NULL,294,'-6pozC0W0kU.jpg','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/-6pozC0W0kU_a454b6e9f109.jpg',NULL,'2023-01-13 17:21:17','2023-01-13 17:21:17'),(171,NULL,NULL,295,'les.jpg','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/les_6588a561e272.jpg',NULL,'2023-01-14 22:31:57','2023-01-14 22:31:57'),(172,NULL,NULL,296,'les.jpg','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/les_dc9e9cc58c4c.jpg',NULL,'2023-01-14 22:32:06','2023-01-14 22:32:06'),(173,NULL,NULL,297,'20120629_213131.jpg','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/20120629_213131_ac982ecca965.jpg',NULL,'2023-01-16 15:58:27','2023-01-16 15:58:27');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `from_id` int NOT NULL,
  `to_id` int NOT NULL,
  `text` varchar(4000) DEFAULT NULL,
  `view` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (290,2,1,2,'Привет',1,'2022-12-24 04:28:14','2022-12-24 01:29:24'),(291,2,1,2,'Поставил тебе задачу по лидам',1,'2022-12-24 04:28:30','2022-12-24 01:29:24'),(292,2,2,1,'ок',1,'2022-12-24 04:29:32','2022-12-24 01:29:36'),(293,2,1,18,'File',NULL,'2023-01-13 16:52:30','2023-01-13 16:52:30'),(294,2,1,18,'file',NULL,'2023-01-13 17:21:16','2023-01-13 17:21:16'),(295,2,1,18,'qwe',NULL,'2023-01-14 22:31:56','2023-01-14 22:31:56'),(296,2,1,18,'qwe',NULL,'2023-01-14 22:32:06','2023-01-14 22:32:06'),(297,2,1,18,NULL,NULL,'2023-01-16 15:58:25','2023-01-16 15:58:25');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note_folders`
--

DROP TABLE IF EXISTS `note_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `note_folders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(512) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_folders`
--

LOCK TABLES `note_folders` WRITE;
/*!40000 ALTER TABLE `note_folders` DISABLE KEYS */;
INSERT INTO `note_folders` VALUES (8,1,'Папка','papka',NULL,NULL,'2022-08-24 12:30:42','2022-08-24 12:30:42'),(10,1,'Папка 2','papka_2_c70621a5',NULL,NULL,'2022-08-24 12:31:49','2022-08-26 09:18:14'),(11,1,'Заметки','zametki_742ba5c6',NULL,NULL,'2022-08-24 12:32:02','2022-08-26 07:24:51'),(19,1,'K s df fhfgdhtmih sushroeghs dfjsgn dosghurhg scmxnbxfdgjkdfh fh','k_s_df_fhfgdhtmih_sushroeghs_dfjsgn_dosghurhg_scmxnbxfdgjkdfh_fh_b52f0cd0',NULL,NULL,'2022-08-26 07:11:11','2022-08-27 18:04:04'),(25,1,'Yes','yes_62d0b73e',NULL,NULL,'2022-08-27 17:54:54','2022-08-27 17:54:54'),(26,1,'Room','room_58780cb4',NULL,NULL,'2022-08-31 12:24:51','2022-08-31 12:24:51'),(27,1,'Stories','stories_cc41d0cf',NULL,NULL,'2022-08-31 12:25:07','2022-08-31 12:25:07'),(30,22,'er','er_70a4fb9d',NULL,NULL,'2022-10-09 23:32:16','2022-10-09 23:32:16');
/*!40000 ALTER TABLE `note_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `folder_id` varchar(32) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(512) DEFAULT NULL,
  `text` varchar(4000) DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `color` varchar(32) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,1,'8','sss','sss_f14613b2','gfhfg12\ngh',0,NULL,'2022-08-24 22:40:52','2022-08-30 18:36:34'),(2,1,'10','Заметка','zametka_b2f9c3fa','ыыыыыыыыыы',0,NULL,'2022-08-24 22:48:02','2022-08-30 18:36:35'),(3,1,'11','Записка','zapiska_22c21c36','',0,NULL,'2022-08-25 08:20:52','2022-08-30 18:36:36'),(16,1,NULL,'Ыыыыыыыы ыыы ыыыыыы ыыыы Ыыыыыыыыпаво паопр авырапр апвопаапрв пав апоукерукры','yyyyyyyy_yyy_yyyyyy_yyyy_yyyyyyyypavo_paopr_avyrapr_apvopaaprv_pav_apoukerukry_f6a23da6','64rr11123151',0,NULL,'2022-08-26 10:45:40','2022-08-29 10:04:51'),(21,1,'8','Пор.п кщшеюю Ааврвыа рваырквкпв авпыавыав авыпва','porp_kshtsheyuyu_aavrvya_rvayrkvkpv_avpyavyav_avypva_b20c12e6','fjkjjloggfh',0,NULL,'2022-08-26 13:46:42','2022-08-31 06:04:34'),(38,1,'10','nnn','nnn_1d37d755',NULL,NULL,NULL,'2022-08-28 11:09:26','2022-08-28 11:09:26'),(230,1,NULL,'Test','test_1c50e286',NULL,NULL,NULL,'2022-08-30 16:41:57','2022-08-30 16:41:57'),(231,1,'11','Test','test_94bf4964','qwe',0,NULL,'2022-08-30 16:42:20','2022-08-30 18:36:39'),(232,1,NULL,'111','111_88bf97fd','',0,NULL,'2022-08-30 16:43:07','2022-08-30 18:36:38'),(233,1,NULL,'222','222_c2835811','',0,NULL,'2022-08-30 16:43:10','2022-08-31 09:44:23'),(234,1,NULL,'111','111_1ea23da3','',0,NULL,'2022-08-30 16:53:18','2022-08-30 13:54:09'),(235,1,NULL,'111','111_27412318','',0,NULL,'2022-08-30 16:53:32','2022-08-30 13:54:11'),(236,1,NULL,'222','222_10e186a4','пппоь',0,NULL,'2022-08-30 19:22:37','2022-10-04 18:19:16'),(237,1,NULL,'333','333_c7046c98','',0,NULL,'2022-08-30 19:22:50','2022-08-30 17:56:15'),(238,1,NULL,'456','456_087af63a','',0,NULL,'2022-08-30 19:41:56','2022-08-30 16:42:08'),(239,1,'25','Jonson','jonson_900ad627','',0,NULL,'2022-08-30 21:34:14','2022-08-30 18:36:40'),(240,1,NULL,'111','111_ae975c8e','',0,NULL,'2022-08-31 09:03:04','2022-08-31 06:03:50'),(241,1,NULL,'111','111_01a9fa42','',0,NULL,'2022-08-31 09:04:14','2022-08-31 06:04:25'),(242,1,'11','Test','test_77aefd2c','111',0,NULL,'2022-08-31 09:19:37','2022-08-31 06:19:58'),(245,1,'8','qqqqqqq','qqqqqqq_7b3f685b','vcb',NULL,NULL,'2022-08-31 16:00:19','2022-08-31 16:00:19'),(246,1,'8','www','www_5e0a1abd','ww',NULL,NULL,'2022-08-31 16:12:16','2022-08-31 16:12:16'),(247,1,NULL,'cccc','cccc_e6588ef9','cccccc1',NULL,NULL,'2022-08-31 16:12:27','2022-09-19 11:26:40'),(249,22,NULL,'Aa','aa_cf14cb54','ff',1,NULL,'2022-10-10 02:31:56','2022-10-09 23:32:00'),(250,22,'30','TT','tt_2e6d3e2d','qq',1,NULL,'2022-10-10 02:32:25','2022-10-09 23:32:29'),(251,22,'30','df','df_c1eba11f','df',1,NULL,'2022-10-10 02:32:37','2022-10-09 23:32:50');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(512) DEFAULT NULL,
  `anchor` varchar(255) DEFAULT NULL,
  `view` int DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (128,9,'confirm','Уведомление','{\"siteId\":\"9hh4jb-00\",\"billId\":\"36ffa014d6162b8232532be7d80425c6\",\"amount\":{\"value\":\"2.00\",\"currency\":\"RUB\"},\"status\":{\"value\":\"PAID\",\"changedDateTime\":\"2021-01-18T15:25:18+03\"},\"customer\":{\"phone\":\"78710009999\",\"email\":\"test@example.com\",\"account\":\"95fe4','12312',NULL,'fe6a8b5d1ad20c319997026499c5','2022-10-22 10:10:17','2022-10-22 10:10:17'),(130,9,'confirm','Уведомление','{\"siteId\":\"9hh4jb-00\",\"billId\":\"601868f1dbed9326b986615eba59b46a\",\"amount\":{\"value\":\"2.00\",\"currency\":\"RUB\"},\"status\":{\"value\":\"PAID\",\"changedDateTime\":\"2021-01-18T15:25:18+03\"},\"customer\":{\"phone\":\"78710009999\",\"email\":\"test@example.com\",\"account\":\"95fe49e736ece7443a07763ff1ee60c7\"},\"customFields\":{\"paySourcesFilter\":\"qw\",\"themeCode\":\"Yvan-YKaSh\",\"yourParam1\":\"64728940\",\"yourParam2\":\"order 678\"},\"comment\":\"Text comment\",\"creationDateTime\":\"2021-01-18T15:24:53+03\",\"expirationDateTime\":\"2025-12-10T09:02:00+0','12312',NULL,'17d8620f69e287b868ae8edf91e5','2022-10-22 10:52:45','2022-10-22 10:52:45');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('admin@mail.ru','$2y$10$JivR5IdUTz87sHF7OsmnuOOT4FelnmldTUA45ee4/3kAvCGms20QO','2022-09-03 19:38:39'),('vitalicheg28@mail.ru','$2y$10$iYmM7mm.hzwjC.1Vb2vQqOCMWT8bEYFmNaEuz7h.5ZrVfkog51Er.','2022-10-08 04:31:10');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `rate_id` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `count` int NOT NULL,
  `currency` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `note` varchar(512) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (34,1,2,2,1,'RUB',NULL,'error','Оплаченная сумма не равна стоимости товара или оплата не верной валютой.','68ca6ca9182094b26fbc2408ed5a2ef2','2022-10-22 04:35:27','2022-10-22 07:34:21'),(47,1,2,2,1,'RUB',NULL,'new',NULL,'7534d2ab617f3fa24a6f317d7fdb19ce','2022-10-22 09:47:25','2022-10-22 09:47:25'),(48,1,2,2,1,'RUB',NULL,'new',NULL,'7dcb0fcd83be9aed7671b6c1ff51cf28','2022-10-22 09:47:59','2022-10-22 09:47:59'),(49,1,2,2,1,'RUB',NULL,'success','Оплата выполнена успешно.','ffc0be2290fc1dae3c41834f22a4bcb7','2022-10-22 06:51:35','2022-10-22 09:51:30'),(50,1,2,2,1,'RUB',NULL,'new',NULL,'209e3671001592cac9913ea696640e09','2022-10-22 09:52:04','2022-10-22 09:52:04'),(51,1,2,2,1,'RUB',NULL,'new',NULL,'36ffa014d6162b8232532be7d80425c6','2022-10-22 10:09:34','2022-10-22 10:09:34'),(52,1,2,2,1,'RUB',NULL,'success','Оплата выполнена успешно.','36ffa014d6162b8232532be7d80425c6','2022-10-22 07:10:18','2022-10-22 10:09:42'),(53,1,2,1,1,'RUB',NULL,'new',NULL,'4ad5bafda23b4b8defa73cb695ef182c','2022-10-22 10:37:04','2022-10-22 10:37:04'),(54,1,2,1,1,'RUB',NULL,'error','Оплаченная сумма не равна стоимости товара или оплата не верной валютой.','601868f1dbed9326b986615eba59b46a','2022-10-22 07:52:46','2022-10-22 10:52:37'),(55,1,2,1,1,'RUB',NULL,'new',NULL,'33834ad6a930849a85a941aa08062c97','2022-12-24 04:20:44','2022-12-24 04:20:44');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` int NOT NULL,
  `users` int NOT NULL,
  `space` bigint DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` VALUES (1,'Primary',0,2,200000000,NULL,'d4ebb94e4f6d1870ed8a9bfbabb4cd40','2022-10-21 17:40:46','2022-10-03 04:29:36'),(2,'Startup',1,5,1000000000,'','0f64e6f788d3055bec16716372b2b865','2022-10-22 10:12:15','2022-10-03 04:29:46'),(3,'Business',699,10,3000000000,NULL,'e53c71cc838062b8ab8f66312bea6409','2022-10-21 17:41:54','2022-10-07 07:20:06'),(4,'VIP',1999,50,10000000000,NULL,'004361b5900999c3027db56df793c6d7','2022-10-21 17:42:00','2022-10-07 07:42:07');
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `header_style` varchar(255) DEFAULT NULL,
  `header_mode` varchar(255) DEFAULT NULL,
  `sidebar_style` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,1,'default','classic','fixed','dark','2022-10-09 23:15:23','2022-09-28 17:50:14'),(2,15,'default','classic','fixed','dark','2022-09-28 19:35:46','2022-09-28 21:05:37'),(3,9,'default','classic','fixed','dark','2022-09-29 23:14:48','2022-09-29 22:41:24'),(4,10,'default','classic','fixed','dark','2022-09-29 23:14:48','2022-09-29 23:14:48'),(5,16,'default','classic','fixed','dark','2022-10-09 03:43:32','2022-09-30 04:02:25'),(6,17,'default','classic','fixed','dark','2022-10-02 07:43:39','2022-10-02 07:43:39'),(7,18,'default','classic','fixed','dark','2022-10-03 08:15:58','2022-10-03 08:15:58'),(8,2,'default','classic','fixed','dark','2022-10-05 00:59:51','2022-10-05 00:59:51'),(9,6,'default','classic','fixed','dark','2022-10-05 21:34:10','2022-10-05 21:34:10'),(10,19,'default','classic','fixed','dark','2022-10-07 04:12:15','2022-10-07 04:12:15'),(11,20,'default','classic','fixed','dark','2022-10-07 04:18:48','2022-10-07 04:18:48'),(12,21,'/css/themes/pulse.min.css','classic','fixed','dark','2022-10-07 08:04:27','2022-10-07 11:03:49'),(13,22,'/css/themes/flat.min.css','classic','fixed','dark','2022-10-10 00:11:09','2022-10-10 02:23:00');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_comments`
--

DROP TABLE IF EXISTS `task_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `user_id` int NOT NULL,
  `text` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_comments`
--

LOCK TABLES `task_comments` WRITE;
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
INSERT INTO `task_comments` VALUES (15,59,15,'Коммент мой','2022-09-29 01:35:51','2022-09-29 01:35:51'),(18,68,1,'123','2022-10-04 23:09:33','2022-10-04 23:09:33'),(27,91,1,NULL,'2022-10-08 12:11:07','2022-10-08 12:11:07'),(28,91,1,'hgj','2022-10-08 12:16:15','2022-10-08 12:16:15');
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_user`
--

DROP TABLE IF EXISTS `task_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `user_id` int NOT NULL,
  `responsibility` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_user`
--

LOCK TABLES `task_user` WRITE;
/*!40000 ALTER TABLE `task_user` DISABLE KEYS */;
INSERT INTO `task_user` VALUES (20,35,1,'performer','2022-09-09 20:37:55','2022-09-09 20:37:55'),(23,36,1,'observer','2022-09-09 20:39:01','2022-09-09 20:39:01'),(24,37,1,'performer','2022-09-09 20:40:58','2022-09-09 20:40:58'),(26,38,1,'performer','2022-09-09 22:48:36','2022-09-09 22:48:36'),(29,40,1,'performer','2022-09-11 18:09:31','2022-09-11 18:09:31'),(33,42,1,'observer','2022-09-11 18:28:22','2022-09-11 18:28:22'),(52,52,1,'performer','2022-09-14 13:42:04','2022-09-14 13:42:04'),(53,53,1,'performer','2022-09-14 13:48:24','2022-09-14 13:48:24'),(56,55,1,'performer','2022-09-14 13:54:24','2022-09-14 13:54:24'),(57,56,1,'performer','2022-09-14 14:12:55','2022-09-14 14:12:55'),(60,58,15,'performer','2022-09-28 22:00:48','2022-09-28 22:00:48'),(64,59,1,'performer','2022-09-29 03:42:57','2022-09-29 03:42:57'),(69,60,15,'performer','2022-09-29 04:07:51','2022-09-29 04:07:51'),(74,61,15,'performer','2022-09-29 23:10:53','2022-09-29 23:10:53'),(79,62,15,'performer','2022-09-30 00:16:19','2022-09-30 00:16:19'),(84,64,15,'performer','2022-09-30 03:49:31','2022-09-30 03:49:31'),(85,65,15,'performer','2022-09-30 03:49:31','2022-09-30 03:49:31'),(90,54,1,'performer','2022-10-05 21:37:32','2022-10-05 21:37:32'),(91,67,1,'performer','2022-10-05 21:37:32','2022-10-05 21:37:32'),(92,68,1,'performer','2022-10-05 21:37:33','2022-10-05 21:37:33'),(102,76,1,'performer','2022-10-06 06:26:04','2022-10-06 03:26:32'),(105,78,1,'performer','2022-10-06 06:39:03','2022-10-06 03:39:30'),(113,81,1,'performer','2022-10-06 09:12:10','2022-10-06 09:12:10'),(122,90,1,'performer','2022-10-08 11:58:40','2022-10-08 11:58:40'),(123,91,1,'performer','2022-10-08 11:59:29','2022-10-08 11:59:29'),(124,92,1,'performer','2022-10-08 12:16:39','2022-10-08 12:16:39'),(126,94,1,'performer','2022-10-13 12:01:05','2022-10-13 12:01:05'),(128,95,1,'performer','2022-10-13 12:01:57','2022-10-13 12:01:57'),(130,96,2,'performer','2022-12-24 04:37:35','2022-12-24 04:37:35'),(131,96,1,'observer','2022-12-24 04:37:36','2022-12-24 04:37:36');
/*!40000 ALTER TABLE `task_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `code` varchar(4000) DEFAULT NULL,
  `creator_id` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (52,'ЙЙЙ','ййй','1','closed',NULL,'marstav_yyy_ac20a37341ae6118b515',1,'2022-09-14 10:42:13','2022-09-14 13:42:04','2022-09-14 10:42:13'),(53,'УУУ','УУУ','1','new',NULL,'marstav_uuu_13ca4792c5853c81fc64',1,NULL,'2022-09-14 13:48:24','2022-09-14 13:48:24'),(54,'RRR','rrr','1','transmitted',NULL,'marstav_rrr_3fdc860d2fcf5580d52f',1,NULL,'2022-09-14 13:50:46','2022-09-14 10:51:48'),(55,'TTT','ttt','1','new','2022-09-12 21:00:00','marstav_ttt_b3f59e0d8a451e1ca302',1,NULL,'2022-09-14 13:54:24','2022-09-14 13:54:35'),(56,'UUU','uuu','1','work',NULL,'marstav_uuu_dc33fd088aa7292e8d97',1,NULL,'2022-09-14 14:12:55','2022-09-14 11:39:39'),(58,'Таска','Для меня','1','closed',NULL,'setting_taska_815d4a644747048338c4',15,'2022-09-28 19:04:45','2022-09-28 22:00:48','2022-09-28 19:04:45'),(59,'Для настройкина','цукнгш','1','new',NULL,'marstav_dlya_nastroykina_bf1638b20ec24a42c23e',1,NULL,'2022-09-29 01:24:46','2022-09-29 01:24:46'),(60,'Движки','йууце','1','new',NULL,'marstav_dvizhki_ebeb765a0834bb0ec6db',15,NULL,'2022-09-29 04:07:51','2022-09-29 04:07:51'),(61,'Task','fhfgh','1','closed',NULL,'company_task_c34fadc4e3318727ef57',15,'2022-09-29 21:11:59','2022-09-29 23:04:00','2022-09-29 21:11:59'),(62,'Creator','fggf','1','closed',NULL,'company_creator_029afb22ff903c77fcfc',15,'2022-09-29 21:13:34','2022-09-30 00:12:41','2022-09-29 21:13:34'),(64,'AAA','dfg','1','transmitted',NULL,'company_aaa_d06ff673a3b74f3788a2',15,NULL,'2022-09-30 03:40:47','2022-09-30 00:48:39'),(65,'RRR','fhgf','1','transmitted',NULL,'company_rrr_2678a9ac682f702f59ef',15,NULL,'2022-09-30 03:49:03','2022-09-30 00:49:31'),(67,'123','111','1','transmitted',NULL,'marstav_123_65012a4c6961adc67823',1,NULL,'2022-10-04 22:56:37','2022-10-05 18:37:33'),(68,'123','111','1','transmitted',NULL,'marstav_123_e5aa8635de947ab6a26d',1,NULL,'2022-10-04 22:56:59','2022-10-05 18:37:33'),(76,'yyy','yyy','4','new',NULL,'marstav_yyy_232b695c33dc97699efe',6,NULL,'2022-10-06 06:26:03','2022-10-06 06:26:03'),(78,'vvv','vvv','1','transmitted',NULL,'marstav_vvv_7d7ddd0b782fb7a5fde8',6,NULL,'2022-10-06 06:39:02','2022-10-06 03:39:30'),(81,'xcx','xxxxxxxx','1','new',NULL,'marstav_xcx_577f1a8c20846bd7c8ac',1,NULL,'2022-10-06 09:12:10','2022-10-06 09:12:10'),(90,'fi','fi','1','new',NULL,'marstav_fi_c0da4e66013f31d97ba2',1,NULL,'2022-10-08 11:58:40','2022-10-08 11:58:40'),(91,'ff','ff','1','new',NULL,'marstav_ff_996a241960a5dddc254e',1,NULL,'2022-10-08 11:59:29','2022-10-08 11:59:29'),(92,'vv','vv','1','new',NULL,'marstav_vv_7c9e34189ad4387c5bc4',1,NULL,'2022-10-08 12:16:38','2022-10-08 12:16:38'),(94,'QQQ','qqq','1','new',NULL,'marstav_qqq_04c7c964bbc79f3f0ca5',2,NULL,'2022-10-13 12:01:05','2022-10-13 12:01:05'),(95,'ggg','gggg','2','new',NULL,'marstav_ggg_daa8b35a81797d6f1eb1',1,NULL,'2022-10-13 12:01:57','2022-10-13 12:01:57'),(96,'Задача по лидам','лиды','1','new',NULL,'marstav_zadacha_po_lidam_f47d12873c8b98c01a3f',1,NULL,'2022-12-24 04:37:35','2022-12-24 04:37:35');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(760) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_added` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `photo` (`photo`),
  UNIQUE KEY `patronymic` (`patronymic`),
  UNIQUE KEY `surname` (`surname`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Admin','Adminov',NULL,'admin@mail.ru','(985) 065-2903',NULL,'/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/avatars/53d47fe9-6330-4a17-8147-a5eb7a912862_55ccae1c.jpg','95fe49e736ece7443a07763ff1ee60c7',NULL,'$2y$10$wSdw7RXVcpd4mo1bXVjfSOVSjTvhzZqBIYeqhvfOBVzfd3Tt6jkne','MNFjpFYC7qoWv1CudOlSJc4hUghpS4XYdiD5PICuqDyH1gOU9EWjH5VkRbJH','2022-09-01 09:32:25','2022-08-22 12:51:03','2022-09-08 16:32:20'),(2,2,'User','Userov','Userovich','user@mail.ru',NULL,NULL,'/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/478368648_c04b41d7.png','95fe49e836ece8443a04763ff1ee60c6',NULL,'$2y$10$fMud7IhYcLdmsv5NUQUKXecSgPhJhulF7mLqSOCxexaVTXf9e3LUq',NULL,'2022-10-13 13:46:13','2022-08-25 16:32:06','2022-10-13 13:46:13'),(4,NULL,'Test',NULL,NULL,'test@mail.ru',NULL,NULL,NULL,'95fe49e636ece6443a06763ff1ee60c6',NULL,'$2y$10$5uPCeArCygn5Fhju4S4JweUZuXbnlMFTXeH0k9X4/GlTtiTocAo5.',NULL,NULL,'2022-09-01 09:44:15','2022-09-01 09:44:15'),(6,NULL,'Vasya',NULL,NULL,'vasya@mail.ru',NULL,NULL,'/storage/users/7af3ed9711f6fe15588efe0a48be425a/avatars/20120624_225012_4dd9ce77.jpg','7af3ed9711f6fe15588efe0a48be425a',NULL,'$2y$10$/BSZe4CcuR/oGvLBaDbhMePbh7dx7NCnUjvaRfYZvjluoQJwHRriq',NULL,NULL,'2022-09-12 09:57:34','2022-10-06 04:19:16'),(9,NULL,'user2',NULL,NULL,'user2@mail.ru',NULL,NULL,NULL,'197a1a84f0f06499d9aa2006deac8ff2',NULL,'$2y$10$Fx1.ENzx3DcFbMkYaBfjDeHhP11wSlVUqZQcM7nGNPdu7xBnvmh8i',NULL,NULL,'2022-09-19 11:51:04','2022-09-29 21:16:19'),(10,NULL,'stage',NULL,NULL,'stage@mail.ru',NULL,NULL,NULL,'e155912894ec8c991170154f46528c5c',NULL,'$2y$10$JQnfntRAb9MciWaQyCtzTud8pL08dqg7xOdCPU3s8w5xsz0NwtNfO',NULL,NULL,NULL,'2022-09-30 01:12:22'),(11,NULL,'stage2',NULL,NULL,'stage2@mail.ru',NULL,NULL,NULL,'bad5acc67a91394eeb5b5222b0661823',NULL,'$2y$10$oT6OkT6fmFn06BKziyzTju.ADueuzKlehVQfS0gBWI5/4dTplsQsa',NULL,NULL,NULL,NULL),(12,NULL,'stage2',NULL,NULL,'stage3@mail.ru',NULL,NULL,NULL,'70e6f243a0796f7d6a383b0e2c49ce1a',NULL,'$2y$10$lqbKRrHH3PPYvVLvSGoIqe3SBXmiCKgAHwMX5wBrpFXXNJEi2RxW2',NULL,NULL,NULL,NULL),(13,7,'stage4',NULL,NULL,'stage4@mail.ru',NULL,NULL,NULL,'d334bdd8ac1ca2139a1598bed1b3d46c',NULL,'$2y$10$BujAVmTFADsjJRcbPByDhuNVGUuYf7vK4OJYTu8OL0e1ouMRr0jXO',NULL,NULL,NULL,'2022-09-28 02:58:38'),(14,NULL,'stage5',NULL,NULL,'stage5@mail.ru',NULL,NULL,NULL,'40d8c43e5f7f420d0c5df01ce891aae0',NULL,'$2y$10$j/M/h9an6aUbtefUnpO/Nu6FWnXeUDYrGYNDtBBz1kqgkmMh72V0y',NULL,NULL,NULL,'2022-09-28 04:19:26'),(16,NULL,'setting',NULL,NULL,'setting@mail.ru',NULL,NULL,NULL,'b8f3f93e5a5cc01b90919aeb7bc1f403',NULL,'$2y$10$YUWUS8907jnvprCYzPYH0e2ZtQhtnTFLNVULw7Ggm9VGV28In.yvO',NULL,NULL,NULL,'2022-10-09 03:27:14'),(17,NULL,'reg',NULL,NULL,'reg@mail.ru',NULL,NULL,NULL,'85400dcffd0302aedee0a2137b900a66',NULL,'$2y$10$PAAsiJxcwfM2stDcDVcJheP9xQ9la67PEgtK6d4UXmqyXflJ1IbbS',NULL,NULL,NULL,NULL),(18,2,'rate',NULL,NULL,'rate@mail.ru',NULL,'Менеджер','/storage/companies/marstav_7cd82ced73d41e1d740d7d6d3009/velic2_cd587146614e.jpg','e2e40aabc18994b979db5122fe28d397',NULL,'$2y$10$xanp3sRS3nJpeZOvpWdHSe1oTpMQpbVYK5tXRoEsjs2fxQVl2.54i',NULL,'2022-10-07 01:11:06',NULL,'2022-10-07 01:11:07'),(19,NULL,'vvv',NULL,NULL,'vvv@mail.ru',NULL,'Менеджер',NULL,'785c5874b77bf6b2197739651c71dc60',NULL,'$2y$10$BNZlduldnnvoEUPw.bbel./aRbZTa2hq6ZjtPlpPq0DgOSaLo1fdu',NULL,NULL,NULL,'2022-10-07 01:18:21'),(20,NULL,'fff',NULL,NULL,'fff@mail.ru',NULL,NULL,'/storage/users/aaecf5b9926f15c0a315138d03bcc493/simfport_4dc98b900e34.jpg','aaecf5b9926f15c0a315138d03bcc493',NULL,'$2y$10$iu9Yb44L6qJqLLMwaVlJC.2TgPEFLpUE4Zqa4vWVDB0frRCeceLFW',NULL,NULL,NULL,'2022-10-07 01:20:30'),(21,25,'vitaly',NULL,NULL,'vitalicheg28@mail.ru',NULL,NULL,NULL,'f49dc7ac6832133fbeb8f814c3852803',NULL,'$2y$10$LPcRYT1jtPCM6qAJDHARW.He3HRcMJyZzngxcnmSwHXGiGOnezEsa','PA1undq7z5bRdLkyhAk6uOMWA8s0z97qluUqUNGxWKVm2dCsXd9Ne92qzL6A',NULL,NULL,'2022-10-07 23:39:52'),(22,NULL,'user',NULL,NULL,'user3@mail.ru','(524) 657-6574',NULL,NULL,'8ba66125197efbd6ea64b7d150170fbf',NULL,'$2y$10$GmCIkgiZZLA5G/8HqibkH.ZvWSzqepCwgWddcParfo2cMgcLGmIsG',NULL,NULL,NULL,'2022-10-10 00:15:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-07 23:42:35
