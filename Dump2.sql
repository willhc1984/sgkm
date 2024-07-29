-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sgkm
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `consultores`
--

DROP TABLE IF EXISTS `consultores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultores`
--

LOCK TABLES `consultores` WRITE;
/*!40000 ALTER TABLE `consultores` DISABLE KEYS */;
INSERT INTO `consultores` VALUES (1,'Evelin Eufrásio','233443434');
/*!40000 ALTER TABLE `consultores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_reset_tokens_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1),(11,'2024_07_24_154412_create_table_consultor',1),(12,'2024_07_24_155612_create_table_produtos',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `preco_fornecedor` double(8,2) NOT NULL,
  `preco_final` double(8,2) NOT NULL,
  `comissao_consultor` double(8,2) NOT NULL,
  `situacao` varchar(255) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `consultor_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_consultor_id_foreign` (`consultor_id`),
  CONSTRAINT `produtos_consultor_id_foreign` FOREIGN KEY (`consultor_id`) REFERENCES `consultores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (4,'Brinco Gota Dourada',29.50,79.90,30.00,'Em estoque','2024-07-26 23:52:30',1),(5,'Brinco Gota Prata',29.50,79.90,30.00,'Em estoque','2024-07-26 23:54:27',1),(6,'Argola Gigante Prata',49.50,109.90,30.00,'Em estoque','2024-07-26 23:55:18',1),(7,'Conjunto Coração',39.50,99.90,30.00,'Em estoque','2024-07-26 23:56:04',1),(8,'Brinco Coração Gordinho',34.50,89.90,30.00,'Em estoque','2024-07-26 23:57:19',1),(9,'Pulseira Cordão Baiano Prata',29.50,79.90,30.00,'Em estoque','2024-07-26 23:58:50',1),(10,'Brinco com Ovais Dourado',34.50,89.00,30.00,'Em estoque','2024-07-27 00:01:20',1),(11,'Brinco Pizza Prata',39.50,89.90,30.00,'Em estoque','2024-07-27 00:01:59',1),(12,'Brinco 6 Voltas cravejado',24.50,79.90,30.00,'Em estoque','2024-07-27 00:03:23',1),(13,'Argola Retangular Prata',39.50,89.90,30.00,'Em estoque','2024-07-27 00:04:47',1),(14,'Conjunto Prata Ponto e Luz',44.50,99.90,30.00,'Em estoque','2024-07-27 00:05:42',1),(15,'Brinco olho grego',14.50,49.90,30.00,'Em estoque','2024-07-27 00:07:35',1),(16,'Corrente pingente cruz',44.50,109.90,30.00,'Em estoque','2024-07-27 00:08:12',1),(17,'Tornozeleira em malha dourada',19.50,49.90,30.00,'Em estoque','2024-07-27 00:09:10',1),(18,'Colar malha esteira dourada',34.50,89.90,30.00,'Em estoque','2024-07-27 00:10:01',1),(19,'Cola malha esteira prata',34.50,89.90,30.00,'Em estoque','2024-07-27 00:11:14',1),(20,'Argola cravejada vazada coração',29.50,89.90,30.00,'Em estoque','2024-07-27 00:12:26',1),(21,'Colar pingente pizza dourado',39.50,99.90,30.00,'Em estoque','2024-07-27 00:13:06',1),(22,'Colar pingente pizza prata',39.50,99.90,30.00,'Em estoque','2024-07-27 00:13:59',1),(23,'Brinco pizza dourado',39.50,89.90,30.00,'Em estoque','2024-07-27 00:14:59',1),(24,'Colar menina prata',34.50,89.90,30.00,'Em estoque','2024-07-27 00:15:37',1),(25,'Colar menino prata',34.50,89.90,30.00,'Em estoque','2024-07-27 00:16:37',1),(26,'Corrente menina dourada',39.50,89.90,30.00,'Em estoque','2024-07-27 00:18:00',1),(27,'Corrente menino dourada',39.50,89.90,30.00,'Em estoque','2024-07-27 00:18:31',1),(28,'Argola Navete Prata',44.50,99.90,30.00,'Em estoque','2024-07-27 00:19:30',1),(29,'Argola de estrela com zirconia',54.50,119.90,30.00,'Em estoque','2024-07-27 00:20:11',1),(30,'Brinco ear hook',39.50,89.90,30.00,'Em estoque','2024-07-27 00:21:09',1),(31,'Brinco coração gordinho prata',39.50,99.90,30.00,'Em estoque','2024-07-27 00:21:59',1),(32,'Argola gota dourada',39.50,99.90,30.00,'Em estoque','2024-07-27 00:22:46',1),(33,'Meia argola dourada',34.50,89.90,30.00,'Em estoque','2024-07-27 00:23:12',1),(34,'Anel de corações vazado',29.50,79.90,30.00,'Em estoque','2024-07-27 00:24:12',1),(35,'Argola retangular texturizada',39.50,89.90,30.00,'Em estoque','2024-07-27 00:24:47',1),(36,'Anel curvo dourado',39.50,89.90,30.00,'Em estoque','2024-07-27 00:25:26',1),(37,'Anel 3 curvas dourado',34.50,79.90,30.00,'Em estoque','2024-07-27 00:25:49',1),(38,'Anel de cruz',19.50,59.90,30.00,'Em estoque','2024-07-27 00:28:02',1),(39,'Argola quadrada pequena',34.50,69.90,30.00,'Em estoque','2024-07-27 00:28:44',1),(40,'Brinco em leque',54.50,119.90,30.00,'Em estoque','2024-07-27 00:29:11',1),(41,'Brinco cristal para pequeno',19.90,49.90,30.00,'Em estoque','2024-07-27 00:29:57',1),(42,'Anel coração pequeno',24.50,69.90,30.00,'Em estoque','2024-07-27 00:30:25',1),(43,'Anel com cristal de coração',24.50,69.90,30.00,'Em estoque','2024-07-27 00:30:58',1),(44,'Anel com flor cravejado',29.50,79.90,30.00,'Em estoque','2024-07-27 00:31:33',1),(45,'Brinco de estrela',19.50,59.90,30.00,'Em estoque','2024-07-27 00:32:18',1),(46,'Brinco coração dourado magrinho',39.50,89.90,30.00,'Em estoque','2024-07-27 00:33:15',1),(47,'Argola trançada dourada',44.50,99.90,30.00,'Em estoque','2024-07-27 00:33:52',1),(48,'Argola oval 1 lado zirconia',34.50,89.90,30.00,'Em estoque','2024-07-27 00:34:19',1),(49,'Argola simples gigante',19.50,59.90,30.00,'Em estoque','2024-07-27 00:34:49',1),(50,'Argola retangular prata',34.50,89.90,30.00,'Em estoque','2024-07-27 00:35:33',1),(51,'Argola retangular dourada',34.50,89.90,30.00,'Em estoque','2024-07-27 00:35:59',1),(52,'Argola oval dourada',44.50,99.90,30.00,'Em estoque','2024-07-27 00:36:31',1),(53,'Brinco zirconia colorida',24.90,49.90,30.00,'Em estoque','2024-07-27 00:38:17',1),(54,'Brinco cristalverde',29.90,54.90,30.00,'Em estoque','2024-07-27 00:39:18',1),(55,'Argola 3 corações',44.50,99.00,30.00,'Em estoque','2024-07-27 00:40:09',1),(56,'Anel texturizado cristal',54.50,109.90,30.00,'Em estoque','2024-07-27 00:40:58',1),(57,'Brinco cleo cristal',49.50,99.90,30.00,'Em estoque','2024-07-27 00:41:43',1),(58,'Brinco anzol',24.50,59.90,30.00,'Em estoque','2024-07-27 00:42:47',1),(59,'Argola de gota',39.50,69.90,30.00,'Em estoque','2024-07-29 00:34:29',1),(60,'Meia argola fina',19.90,49.90,30.00,'Em estoque','2024-07-27 00:45:24',1),(61,'Anel triangulo e cristais',54.50,99.00,30.00,'Em estoque','2024-07-27 00:48:21',1),(62,'Brinco cobra prata',54.50,99.00,30.00,'Em estoque','2024-07-27 00:49:13',1),(63,'Anel prata bela anel',29.90,59.90,30.00,'Em estoque','2024-07-27 00:50:17',1),(64,'Argola bambu',36.50,79.90,30.00,'Em estoque','2024-07-29 00:28:24',1),(65,'Colar coração',63.60,99.90,30.00,'Em estoque','2024-07-29 00:28:55',1),(66,'Brinco Redondo Bela Anel',53.90,89.90,30.00,'Em estoque','2024-07-29 00:29:53',1),(67,'Colar Oval',91.00,159.90,30.00,'Em estoque','2024-07-29 00:30:29',1),(68,'Meia Argola Gde',29.90,69.90,30.00,'Em estoque','2024-07-29 00:31:11',1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2024-07-28 21:54:07
