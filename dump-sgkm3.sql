-- MySQL dump 10.13  Distrib 5.7.35, for Win64 (x86_64)
--
-- Host: localhost    Database: sgkm
-- ------------------------------------------------------
-- Server version	5.7.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contato` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultores`
--

LOCK TABLES `consultores` WRITE;
/*!40000 ALTER TABLE `consultores` DISABLE KEYS */;
INSERT INTO `consultores` VALUES (1,'Evelin Eufrásio','233443434'),(3,'Leisiane','6666666');
/*!40000 ALTER TABLE `consultores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_reset_tokens_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1),(11,'2024_07_24_154412_create_table_consultor',1),(12,'2024_07_24_155612_create_table_produtos',1),(13,'2024_07_30_120949_alter_table_produtos',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_fornecedor` double(8,2) NOT NULL,
  `preco_final` double(8,2) NOT NULL,
  `comissao_consultor` double(8,2) NOT NULL,
  `lucro_consultor` double(8,2) NOT NULL DEFAULT '0.00',
  `lucro_loja` double(8,2) NOT NULL DEFAULT '0.00',
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_venda` timestamp NULL DEFAULT NULL,
  `consultor_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_consultor_id_foreign` (`consultor_id`),
  CONSTRAINT `produtos_consultor_id_foreign` FOREIGN KEY (`consultor_id`) REFERENCES `consultores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (4,'Brinco Gota Dourada',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(5,'Brinco Gota Prata',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(6,'Argola Gigante Prata',49.50,109.90,30.00,32.97,27.43,'Em estoque',NULL,1),(7,'Conjunto Coração',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(8,'Brinco Coração Gordinho',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(9,'Pulseira Cordão Baiano Prata',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(10,'Brinco com Ovais Dourado',34.50,89.00,30.00,26.70,27.80,'Em estoque',NULL,1),(11,'Brinco Pizza Prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(12,'Brinco 6 Voltas cravejado',24.50,79.90,30.00,23.97,31.43,'Em estoque',NULL,1),(13,'Argola Retangular Prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(14,'Conjunto Prata Ponto e Luz',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(15,'Brinco olho grego',14.50,49.90,30.00,14.97,20.43,'Em estoque',NULL,1),(16,'Corrente pingente cruz',44.50,109.90,30.00,32.97,32.43,'Em estoque',NULL,1),(17,'Tornozeleira em malha dourada',19.50,49.90,30.00,14.97,15.43,'Em estoque',NULL,1),(18,'Colar malha esteira dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(19,'Cola malha esteira prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(20,'Argola cravejada vazada coração',29.50,89.90,30.00,26.97,33.43,'Em estoque',NULL,1),(21,'Colar pingente pizza dourado',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(22,'Colar pingente pizza prata',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(23,'Brinco pizza dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(24,'Colar menina prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(25,'Colar menino prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(26,'Corrente menina dourada',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(27,'Corrente menino dourada',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(28,'Argola Navete Prata',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(29,'Argola de estrela com zirconia',54.50,119.90,30.00,35.97,29.43,'Em estoque',NULL,1),(30,'Brinco ear hook',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(31,'Brinco coração gordinho prata',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(32,'Argola gota dourada',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(33,'Meia argola dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(34,'Anel de corações vazado',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(35,'Argola retangular texturizada',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(36,'Anel curvo dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(37,'Anel 3 curvas dourado',34.50,79.90,30.00,23.97,21.43,'Em estoque',NULL,1),(38,'Anel de cruz',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,1),(39,'Argola quadrada pequena',34.50,69.90,30.00,20.97,14.43,'Em estoque',NULL,1),(40,'Brinco em leque',54.50,119.90,30.00,35.97,29.43,'Em estoque',NULL,1),(41,'Brinco cristal para pequeno',19.90,49.90,30.00,14.97,15.03,'Em estoque',NULL,1),(42,'Anel coração pequeno',24.50,69.90,30.00,20.97,24.43,'Em estoque',NULL,1),(43,'Anel com cristal de coração',24.50,69.90,30.00,20.97,24.43,'Em estoque',NULL,1),(44,'Anel com flor cravejado',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(45,'Brinco de estrela',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,1),(46,'Brinco coração dourado magrinho',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(47,'Argola trançada dourada',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(48,'Argola oval 1 lado zirconia',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(49,'Argola simples gigante',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,1),(50,'Argola retangular prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(51,'Argola retangular dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(52,'Argola oval dourada',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(53,'Brinco zirconia colorida',24.90,49.90,30.00,14.97,10.03,'Em estoque',NULL,1),(54,'Brinco cristalverde',29.90,54.90,30.00,16.47,8.53,'Em estoque',NULL,1),(55,'Argola 3 corações',44.50,99.00,30.00,29.70,24.80,'Em estoque',NULL,1),(56,'Anel texturizado cristal',54.50,109.90,30.00,32.97,22.43,'Em estoque',NULL,1),(57,'Brinco cleo cristal',49.50,99.90,30.00,29.97,20.43,'Em estoque',NULL,1),(58,'Brinco anzol',24.50,59.90,30.00,17.97,17.43,'Em estoque',NULL,1),(59,'Argola de gota',39.50,69.90,30.00,20.97,9.43,'Em estoque',NULL,1),(60,'Meia argola fina',19.90,49.90,30.00,14.97,15.03,'Em estoque',NULL,1),(61,'Anel triangulo e cristais',54.50,99.00,30.00,29.70,14.80,'Em estoque',NULL,1),(62,'Brinco cobra prata',54.50,99.00,30.00,29.70,14.80,'Em estoque',NULL,1),(63,'Anel prata bela anel',29.90,59.90,30.00,17.97,12.03,'Em estoque',NULL,1),(64,'Argola bambu',36.50,79.90,30.00,23.97,19.43,'Em estoque',NULL,1),(65,'Colar coração',63.60,99.90,30.00,29.97,6.33,'Em estoque',NULL,1),(66,'Brinco Redondo Bela Anel',53.90,89.90,30.00,26.97,9.03,'Em estoque',NULL,1),(67,'Colar Oval',91.00,159.90,30.00,47.97,20.93,'Em estoque',NULL,1),(68,'Meia Argola Gde',29.90,69.90,30.00,20.97,19.03,'Em estoque',NULL,1),(97,'teste1',150.00,300.00,40.00,120.00,30.00,'Em estoque',NULL,3),(98,'TESTE2',410.00,680.00,10.00,68.00,202.00,'Vendido',NULL,3),(99,'teste3',90.00,220.00,10.00,22.00,108.00,'Em estoque',NULL,3);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping routines for database 'sgkm'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-30 16:25:58
