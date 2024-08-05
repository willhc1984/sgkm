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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultores`
--

LOCK TABLES `consultores` WRITE;
/*!40000 ALTER TABLE `consultores` DISABLE KEYS */;
INSERT INTO `consultores` VALUES (1,'Evelin Eufrásio','15991768338'),(3,'Iane da Silva Xavier','15981002350'),(4,'Karen Martins','15996465977');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_reset_tokens_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1),(11,'2024_07_24_154412_create_table_consultor',1),(12,'2024_07_24_155612_create_table_produtos',1),(13,'2024_07_30_120949_alter_table_produtos',2),(14,'2024_08_01_173840_create_permission_tables',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (16,'App\\Models\\User',1),(17,'App\\Models\\User',1),(18,'App\\Models\\User',1),(19,'App\\Models\\User',1),(20,'App\\Models\\User',1),(21,'App\\Models\\User',1),(22,'App\\Models\\User',1),(23,'App\\Models\\User',1),(24,'App\\Models\\User',1),(25,'App\\Models\\User',1),(26,'App\\Models\\User',1),(27,'App\\Models\\User',1),(28,'App\\Models\\User',1),(29,'App\\Models\\User',1),(30,'App\\Models\\User',1),(16,'App\\Models\\User',2),(17,'App\\Models\\User',2),(18,'App\\Models\\User',2),(19,'App\\Models\\User',2),(20,'App\\Models\\User',2),(21,'App\\Models\\User',2),(22,'App\\Models\\User',2),(23,'App\\Models\\User',2),(24,'App\\Models\\User',2),(25,'App\\Models\\User',2),(26,'App\\Models\\User',2),(27,'App\\Models\\User',2),(28,'App\\Models\\User',2),(29,'App\\Models\\User',2),(30,'App\\Models\\User',2),(21,'App\\Models\\User',3),(22,'App\\Models\\User',3),(26,'App\\Models\\User',3),(27,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (3,'App\\Models\\User',1),(3,'App\\Models\\User',2),(4,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (16,'index-user','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(17,'show-user','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(18,'create-user','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(19,'edit-user','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(20,'destroy-user','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(21,'index-produtos','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(22,'show-produtos','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(23,'create-produtos','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(24,'edit-produtos','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(25,'destroy-produtos','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(26,'index-consultores','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(27,'show-consultores','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(28,'create-consultores','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(29,'edit-consultores','web','2024-08-05 15:10:23','2024-08-05 15:10:23'),(30,'destroy-consultores','web','2024-08-05 15:10:23','2024-08-05 15:10:23');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (4,'Brinco Gota Dourada',29.50,79.90,35.00,27.96,22.43,'Vendido','2024-07-31 03:00:00',1),(5,'Brinco Gota Prata',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(6,'Argola Gigante Prata',49.50,109.90,30.00,32.97,27.43,'Em estoque',NULL,1),(7,'Conjunto Coração',39.50,99.90,35.00,34.97,25.43,'Vendido','2024-07-31 03:00:00',1),(8,'Brinco Coração Gordinho',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(9,'Pulseira Cordão Baiano Prata',29.50,79.90,35.00,27.96,22.43,'Vendido','2024-08-03 03:00:00',1),(10,'Brinco com Ovais Dourado',34.50,89.00,30.00,26.70,27.80,'Em estoque',NULL,1),(11,'Brinco Pizza Prata',39.50,89.90,35.00,31.46,18.93,'Vendido','2024-07-31 03:00:00',1),(12,'Brinco 6 Voltas cravejado',24.50,79.90,35.00,27.96,27.43,'Vendido','2024-07-31 03:00:00',1),(13,'Argola Retangular Prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(14,'Conjunto Prata Ponto e Luz',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(15,'Brinco olho grego',14.50,49.90,35.00,17.46,17.93,'Vendido','2024-07-31 03:00:00',1),(16,'Corrente pingente cruz',44.50,109.90,35.00,38.47,26.93,'Vendido','2024-07-30 03:00:00',1),(17,'Tornozeleira em malha dourada',19.50,49.90,30.00,14.97,15.43,'Em estoque',NULL,1),(18,'Colar malha esteira dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(19,'Cola malha esteira prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(20,'Argola cravejada vazada coração',29.50,89.90,30.00,26.97,33.43,'Em estoque',NULL,1),(21,'Colar pingente pizza dourado',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(22,'Colar pingente pizza prata',39.50,99.90,35.00,34.97,25.43,'Vendido','2024-07-31 03:00:00',1),(23,'Brinco pizza dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(24,'Colar menina prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(25,'Colar menino prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(26,'Corrente menina dourada',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(27,'Corrente menino dourada',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(28,'Argola Navete Prata',44.50,99.90,30.00,29.97,25.43,'Em estoque',NULL,1),(29,'Argola de estrela com zirconia',54.50,119.90,35.00,35.97,29.43,'Vendido','2024-08-01 03:00:00',1),(30,'Brinco ear hook',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(31,'Brinco coração gordinho prata',39.50,99.90,35.00,29.97,30.43,'Vendido','2024-07-31 03:00:00',1),(32,'Argola gota dourada',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,1),(33,'Meia argola dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(34,'Anel de corações vazado',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(35,'Argola retangular texturizada',39.50,89.90,35.00,26.97,23.43,'Vendido','2024-08-01 03:00:00',1),(36,'Anel curvo dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(37,'Anel 3 curvas dourado',34.50,79.90,35.00,23.97,21.43,'Vendido','2024-07-31 03:00:00',1),(38,'Anel de cruz',19.50,59.90,35.00,20.96,19.43,'Vendido','2024-08-03 03:00:00',1),(39,'Argola quadrada pequena',34.50,69.90,35.00,20.97,14.43,'Vendido','2024-07-31 03:00:00',1),(40,'Brinco em leque',54.50,119.90,30.00,35.97,29.43,'Em estoque',NULL,1),(41,'Brinco cristal para pequeno',19.90,49.90,35.00,14.97,15.03,'Vendido','2024-08-01 03:00:00',1),(42,'Anel coração pequeno',24.50,69.90,30.00,20.97,24.43,'Em estoque',NULL,1),(43,'Anel com cristal de coração',24.50,69.90,30.00,20.97,24.43,'Em estoque',NULL,1),(44,'Anel com flor cravejado',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,1),(46,'Brinco coração dourado magrinho',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,1),(47,'Argola trançada dourada',44.50,99.90,35.00,29.97,25.43,'Vendido','2024-07-31 03:00:00',1),(48,'Argola oval 1 lado zirconia',34.50,89.90,35.00,26.97,28.43,'Vendido','2024-08-01 03:00:00',1),(49,'Argola simples gigante',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,1),(50,'Argola retangular prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,1),(51,'Argola retangular dourada',34.50,89.90,35.00,26.97,28.43,'Vendido','2024-08-01 03:00:00',1),(52,'Argola oval dourada',44.50,99.90,35.00,34.97,20.43,'Vendido','2024-08-03 03:00:00',1),(53,'Brinco zirconia colorida',24.90,49.90,30.00,14.97,10.03,'Em estoque',NULL,1),(54,'Brinco cristalverde',29.90,54.90,30.00,16.47,8.53,'Em estoque',NULL,1),(55,'Argola 3 corações',44.50,99.00,35.00,29.70,24.80,'Vendido','2024-07-31 03:00:00',1),(56,'Anel texturizado cristal',54.50,109.90,30.00,32.97,22.43,'Em estoque',NULL,1),(57,'Brinco cleo cristal',49.50,99.90,30.00,29.97,20.43,'Em estoque',NULL,1),(58,'Brinco anzol',24.50,59.90,30.00,17.97,17.43,'Em estoque',NULL,1),(59,'Argola de gota',39.50,69.90,30.00,20.97,9.43,'Em estoque',NULL,1),(60,'Meia argola fina',19.90,49.90,30.00,14.97,15.03,'Em estoque',NULL,1),(61,'Anel triangulo e cristais',54.50,99.00,30.00,29.70,14.80,'Em estoque',NULL,1),(62,'Brinco cobra prata',54.50,99.00,30.00,29.70,14.80,'Em estoque',NULL,1),(63,'Anel prata bela anel',29.90,59.90,35.00,20.96,9.04,'Vendido','2024-08-03 03:00:00',1),(64,'Argola bambu',36.50,79.90,30.00,23.97,19.43,'Em estoque',NULL,1),(65,'Colar coração',63.60,99.90,30.00,29.97,6.33,'Em estoque',NULL,1),(66,'Brinco Redondo Bela Anel',53.90,89.90,35.00,26.97,9.03,'Vendido','2024-07-31 03:00:00',1),(67,'Colar Oval',91.00,159.90,30.00,47.97,20.93,'Em estoque',NULL,1),(68,'Meia Argola Gde',29.90,69.90,30.00,20.97,19.03,'Em estoque',NULL,1),(100,'Cordão baiano 4mm',89.50,149.90,35.00,52.47,7.93,'Vendido','2024-08-01 03:00:00',1),(101,'ANEL DE CORAÇÃO VAZADO E LISO BANHADO A OURO',14.50,39.90,0.00,0.00,25.40,'Em estoque',NULL,4),(102,'ANEL DE CORAÇÃO VAZADO CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',24.50,49.90,0.00,0.00,25.40,'Em estoque','2024-08-03 03:00:00',4),(103,'ANEL DUAS VOLTAS COM CORAÇÃO E ZIRCÔNIAS BRANCAS BANHADO A OURO',24.50,49.90,0.00,0.00,25.40,'Em estoque',NULL,4),(104,'ANEL SOLITÁRIO COM ZIRCÔNIAS BRANCAS BANHADO A OURO',24.50,49.90,0.00,0.00,25.40,'Em estoque',NULL,4),(105,'ANEL COM TRÊS ZIRCÔNIAS DE CORAÇÃO BRANCO BANHADO A OURO',24.50,59.90,0.00,0.00,35.40,'Em estoque',NULL,4),(106,'ANEL DE CORAÇÃO CRAVEJADO BANHADO A OURO',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(107,'ANEL DE CORAÇÕES VAZADOS E ZIRCÔNIAS BRANCAS BANHADO A OURO',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(108,'ANEL REDONDO CRAVEJADO DE ZIRCÔNIAS PRATA LISA',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(109,'ANEL CURVO CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',34.50,69.90,0.00,0.00,35.40,'Em estoque',NULL,4),(110,'ANEL DE CORAÇÃO VAZADO PRATA LISA',39.50,79.90,0.00,0.00,40.40,'Em estoque',NULL,4),(111,'ANEL NÓ COM ZIRCÔNIAS BRANCAS BANHADO A',84.50,159.90,0.00,0.00,75.40,'Em estoque',NULL,4),(112,'CORRENTE COM PINGENTE DE MENINO ZIRCÔNIAS BANHADA A OURO',29.50,69.90,0.00,0.00,40.40,'Em estoque',NULL,4),(113,'CHOKER COM FOLHAS LISAS BANHADA A OURO',39.50,79.90,0.00,0.00,40.40,'Em estoque',NULL,4),(114,'COLAR COM PINGENTE MENINA LISO BANHADO A OURO',26.55,69.90,0.00,0.00,43.35,'Vendido','2024-08-05 03:00:00',4),(115,'CORRENTE COM PINGENTE DE CRUZ BRANCA BANHADA A OURO',44.50,89.90,0.00,0.00,45.40,'Em estoque',NULL,4),(116,'CHOKER LAMINADA COM CRISTAIS DEGRADÊ ROSA BANHADA A OURO',64.50,109.90,0.00,0.00,45.40,'Em estoque',NULL,4),(117,'COLAR COM PINGENTE DE GOTA GEOMETRICO BANHADO A OURO',69.50,119.90,0.00,0.00,50.40,'Em estoque',NULL,4),(118,'CORRENTE COM PINGENTE DE CORAÇÃO E ZIRCÔNIAS BANHADA A OURO',64.50,129.90,0.00,0.00,65.40,'Em estoque',NULL,4),(119,'COLAR GRAVATA COM CORAÇÃO LISO E CRISTAL ROSA BANHADO A OURO',89.50,149.90,0.00,0.00,60.40,'Em estoque',NULL,4),(120,'CORRENTE COM PINGENTE BRANCO BANHADA A RÓDIO',44.50,89.90,0.00,0.00,45.40,'Em estoque','2024-08-03 03:00:00',4),(121,'PULSEIRA RIVIERA COM CRISTAL DE CORAÇÃO BANHADA A RÓDIO',49.50,99.90,0.00,0.00,50.40,'Em estoque',NULL,4),(122,'BRACELETE ALGEMA COM ARO QUADRADO E LISO BANHADO A OURO',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(123,'TORNOZELEIRA COM BOLINHAS LISAS BANHADA A OURO',19.50,69.90,0.00,0.00,50.40,'Em estoque',NULL,4),(124,'BRINCO DE CAVALO LISO BANHADO A OURO',9.50,24.50,0.00,0.00,15.00,'Em estoque',NULL,4),(125,'ARGOLA DE CORAÇÃO LISA BANHADA A OURO',14.50,39.90,0.00,0.00,25.40,'Em estoque',NULL,4),(126,'BRINCO DE OLHO GREGO VAZADO E CRAVEJADO BANHADO A OURO',14.50,39.90,0.00,0.00,25.40,'Em estoque',NULL,4),(127,'ARGOLA CRAVEJADA DE ZIRCÔNIAS BANHADA A OURO',44.50,89.90,0.00,0.00,45.40,'Em estoque',NULL,4),(128,'ARGOLA COM PINGENTE DE CRUZ E ZIRCÔNIAS BANHADA A RÓDIO',19.50,49.90,0.00,0.00,30.40,'Em estoque',NULL,4),(129,'BRINCO COM CRISTAL E PÉROLA SHELL BANHADO A RÓDIO',24.50,49.90,0.00,0.00,25.40,'Em estoque',NULL,4),(130,'BRINCO DE CORAÇÃO VAZADO TORCIDO BANHADO A OURO',19.50,49.90,0.00,0.00,30.40,'Vendido','2024-08-05 03:00:00',4),(131,'BRINCO SIMBOLO DO INFINITO CRAVEJADO PRATA RODINADA',29.50,49.90,0.00,0.00,20.40,'Em estoque',NULL,4),(133,'BRINCO DE CORAÇÃO COM ZIRCÔNIAS BAGUETES BRANCAS',29.50,54.90,0.00,0.00,25.40,'Em estoque',NULL,4),(134,'BRINCO REDONDO COM CORAÇÃO VAZADO E COLORIDO BANHADO A OURO',24.50,54.90,0.00,0.00,30.40,'Em estoque',NULL,4),(135,'BRINCO DE CORAÇÃO VAZADO CRAVEJADO BANHADO A OURO',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(136,'BRINCO DE GOTA CURVO LISO DOURADO',24.50,59.90,0.00,0.00,35.40,'Em estoque',NULL,4),(137,'BRINCO DE GOTA CURVO LISO PRATA',24.50,59.90,0.00,0.00,35.40,'Em estoque',NULL,4),(138,'MEIA ARGOLA TRANÇADA LISA BANHADA A OURO',29.50,59.90,0.00,0.00,30.40,'Em estoque',NULL,4),(139,'BRINCO DE CORAÇÃO CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',29.50,69.90,0.00,0.00,40.40,'Em estoque',NULL,4),(140,'BRINCO REDONDO PÊNDULO CRAVEJADO BANHADO A OURO',34.50,69.90,0.00,0.00,35.40,'Em estoque',NULL,4),(141,'BRINCO SEIS VOLTAS CRAVEJADO BANHADO A OURO',24.50,69.90,0.00,0.00,45.40,'Vendido','2024-08-05 03:00:00',4),(142,'COLAR COM PINGENTE DE CACHORRO VAZADO BANHADO A OURO',34.50,69.90,0.00,0.00,35.40,'Em estoque',NULL,4),(143,'ARGOLA DE GOTA CRAVEJADA DE ZIRCÔNIAS BANHADA A OURO',34.50,79.90,0.00,0.00,45.40,'Em estoque',NULL,4),(144,'BRINCO DE CORAÇÃO COM ZIRCÔNIAS BAGUETES BRANCAS BANHADO A RÓDIO',39.50,79.90,0.00,0.00,40.40,'Em estoque',NULL,4),(145,'BRINCO DE CORAÇÃO CRAVEJADO BANHADO A OURO',34.50,79.90,0.00,0.00,45.40,'Em estoque',NULL,4),(146,'BRINCO DE FLOR E PÉROLA SHELL BANHADO A RÓDIO',39.50,79.90,0.00,0.00,40.40,'Em estoque',NULL,4),(147,'BRINCO PIZZA COM ZIRCÔNIAS BAGUETES BRANCAS',39.50,79.90,0.00,0.00,40.40,'Em estoque',NULL,4),(148,'ARGOLA PÊNDULO COM ELOS E ZIRCÔNIAS BRANCAS BANHADA A OURO',49.50,89.90,0.00,0.00,40.40,'Em estoque',NULL,4),(149,'BRINCO COM LAÇO CRAVEJADO E PÉROLA BANHADO A RÓDIO',54.50,89.90,0.00,0.00,35.40,'Em estoque',NULL,4),(150,'BRINCO DE FLOR COM CRISTAIS E ZIRCÔNIAS PRATA RODINADA',49.50,89.90,0.00,0.00,40.40,'Em estoque',NULL,4),(151,'BRINCO DE GOTA 2 EM 1 GEOMETRICO BANHADO A OURO',39.50,89.90,0.00,0.00,50.40,'Em estoque',NULL,4),(152,'BRINCO QUADRADO COM CRISTAL E ZIRCÔNIAS PRATA LISA',49.50,89.90,0.00,0.00,40.40,'Em estoque',NULL,4),(153,'MEIA ARGOLA DUAS VOLTAS LISA',49.50,89.90,0.00,0.00,40.40,'Em estoque',NULL,4),(154,'ARGOLA DE ESTRELA COM ZIRCÔNIAS BRANCAS BANHADA A OURO',54.50,99.90,0.00,0.00,45.40,'Em estoque',NULL,4),(155,'ARGOLA QUATRO FILEIRA CRAVEJADAS DE ZIRCÔNIAS BANHADA A OURO',49.50,99.90,0.00,0.00,50.40,'Em estoque',NULL,4),(156,'ARGOLA REDONDA CRAVEJADA DE ZIRCÔNIAS BANHADA A OURO',54.50,99.90,0.00,0.00,45.40,'Em estoque',NULL,4),(157,'BRINCO REDONDO VAZADO E CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',49.50,99.90,0.00,0.00,50.40,'Em estoque',NULL,4),(158,'BRINCO DE FLOR TEXTURIZADO CURVO E LISO',69.50,119.90,0.00,0.00,50.40,'Em estoque',NULL,4),(159,'ARGOLA 2 EM 1 COM PINGENTE DE CORAÇÃO CRAVEJADA DE ZIRCÔNIAS',64.50,129.90,0.00,0.00,65.40,'Em estoque',NULL,4),(160,'BRINCO PÊNDULO COM ELOS TRANÇADOS CRAVEJADOS BANHADO A OURO',89.50,139.90,0.00,0.00,50.40,'Em estoque',NULL,4),(161,'Argola com madre perola',59.90,109.90,35.00,38.47,11.54,'Em estoque',NULL,1),(162,'Brinco Ted',59.90,109.90,35.00,38.47,11.54,'Em estoque',NULL,1),(163,'Argola Lisa Gordinha',39.50,89.90,35.00,31.46,18.93,'Em estoque',NULL,1),(164,'Argola Lisa Gordinha gde',49.50,109.90,35.00,38.47,21.93,'Em estoque',NULL,1),(165,'Argola 3 voltas',49.50,109.90,35.00,38.47,21.93,'Em estoque',NULL,1),(166,'BRINCO DE GOTA CURVO LISO',24.50,79.90,35.00,27.96,27.43,'Em estoque',NULL,1),(167,'Brinco curvo cravejado',44.50,109.90,35.00,38.47,26.93,'Em estoque',NULL,1),(168,'Meia argola bundudinho',34.50,89.90,35.00,31.46,23.93,'Em estoque',NULL,1),(169,'MEIA ARGOLA TRANÇADA LISA BANHADA A OURO',29.50,79.90,35.00,27.96,22.43,'Em estoque',NULL,1),(170,'Brinco estrela com zirconia',19.50,59.90,35.00,20.96,19.43,'Em estoque',NULL,1),(171,'CORRENTE EM MALHA CORDÃO BAIANO LISA BANHADA A OURO',34.50,89.90,35.00,31.46,23.93,'Em estoque',NULL,1),(172,'CORRENTE COM PINGENTE DE CRUZ BRANCA BANHADA A OURO',44.50,109.90,35.00,38.47,26.93,'Em estoque',NULL,1),(173,'MEIA ARGOLA QUADRADA LISA',29.50,69.90,35.00,24.46,15.94,'Em estoque',NULL,1),(174,'CONJUNTO BRINCO E CORRENTE COM PINGENTE REDONDO BANHADO A OURO',49.50,119.50,35.00,41.83,28.18,'Em estoque',NULL,1),(175,'BRINCO DE CORAÇÃO CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',29.50,69.90,35.00,24.46,15.94,'Em estoque',NULL,1),(176,'ARGOLA UMA FILEIRA COM ZIRCÔNIAS BRANCAS BANHADA A OURO',34.50,89.90,35.00,31.46,23.93,'Em estoque',NULL,1),(177,'ARGOLA OVAL CRAVEJADA DE ZIRCÔNIAS BANHADA A OURO',29.50,69.90,0.00,0.00,40.40,'Em estoque',NULL,4),(178,'Conjunto coração em ródio',89.90,179.90,30.00,53.97,36.03,'Em estoque',NULL,3),(179,'Brinco Coração prata gordo',53.90,99.90,30.00,29.97,16.03,'Em estoque',NULL,3),(180,'Anel prata coração belanel',19.90,59.90,30.00,17.97,22.03,'Em estoque',NULL,3),(181,'Anel pedras coloridas',54.50,119.90,30.00,35.97,29.43,'Em estoque',NULL,3),(182,'Brinco ear cuff dourado',68.15,129.90,30.00,38.97,22.78,'Em estoque',NULL,3),(183,'Brinco gota prata',24.50,89.90,30.00,26.97,38.43,'Em estoque',NULL,3),(184,'Brinco gota dourado',24.50,89.90,30.00,26.97,38.43,'Em estoque',NULL,3),(185,'Argola estrela',54.50,119.90,30.00,35.97,29.43,'Em estoque',NULL,3),(186,'Corrente nossa senhora prata',63.60,129.90,30.00,38.97,27.33,'Em estoque',NULL,3),(187,'Corrente cruz dourada',44.50,119.90,30.00,35.97,39.43,'Em estoque',NULL,3),(188,'Corrente pizza',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,3),(189,'Brinco pizza prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(190,'Brinco coração baguete prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(191,'Brinco coração baguete dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(192,'Argola oval dourada cravejada',54.50,109.90,30.00,32.97,22.43,'Em estoque',NULL,3),(193,'Brinco elefante dourado',6.00,29.90,30.00,8.97,14.93,'Em estoque',NULL,3),(194,'Choker com cristais',64.50,149.90,30.00,44.97,40.43,'Em estoque',NULL,3),(195,'Cordão baiano fino',34.50,99.90,30.00,29.97,35.43,'Em estoque',NULL,3),(196,'Anel coração vazado dourado 18',14.50,49.90,30.00,14.97,20.43,'Em estoque',NULL,3),(198,'Anel coração grande cravejado 18',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,3),(199,'Brinco coração gigante',34.50,99.90,30.00,29.97,35.43,'Em estoque',NULL,3),(200,'Anel cruz dourado 14',19.50,49.90,30.00,14.97,15.43,'Em estoque',NULL,3),(201,'Corrente menina dourado',36.50,89.90,30.00,26.97,26.43,'Em estoque',NULL,3),(202,'Corrente menino dourado',36.50,89.90,30.00,26.97,26.43,'Em estoque',NULL,3),(203,'Brinco com ovais',34.50,79.90,30.00,23.97,21.43,'Em estoque',NULL,3),(204,'Brinco coração gordinho prata',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,3),(205,'Brinco Pizza dourado',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(206,'Colar menino prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,3),(207,'Colar menina prata',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,3),(208,'Cola malha esteira prata',34.50,99.90,30.00,29.97,35.43,'Em estoque',NULL,3),(209,'Argola dourada cravejada 1 lado',29.50,89.90,30.00,26.97,33.43,'Em estoque',NULL,3),(210,'Pulseira malha dourada',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,3),(211,'Argola simples gigante',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,3),(212,'Colar gravata coração',64.50,149.90,30.00,44.97,40.43,'Em estoque',NULL,3),(213,'Pulseira Cordão Baiano Prata',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,3),(214,'Pulseira coração prata',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(215,'Brinco ear cuff dourado',39.50,79.90,30.00,23.97,16.43,'Em estoque',NULL,3),(216,'Argola pequena dourada',24.50,69.90,30.00,20.97,24.43,'Em estoque',NULL,3),(217,'Argola prata redonda',39.50,89.90,30.00,26.97,23.43,'Em estoque',NULL,3),(218,'ARGOLA PÊNDULO COM ELOS E ZIRCÔNIAS BRANCAS BANHADA A OURO',49.50,119.90,30.00,35.97,34.43,'Em estoque',NULL,3),(219,'Anel coração cravejado 20',24.50,59.90,0.00,0.00,35.40,'Em estoque',NULL,4),(220,'Brinco estrela com zirconia',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,3),(221,'CHOKER COM RAQUETES LISAS BANHADA A OURO',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,3),(222,'BRINCO DE GOTA VAZADO BANHADO A OURO',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,3),(223,'BRINCO DE GOTA TEXTURIZADO VAZADO LISO',19.50,59.90,30.00,17.97,22.43,'Em estoque',NULL,3),(224,'ANEL CURVO TRABALHADO COM ZIRCÔNIAS BRANCAS BANHADO A OURO',34.50,79.90,30.00,23.97,21.43,'Em estoque',NULL,3),(225,'ANEL VAZADO E CRAVEJADO DE ZIRCÔNIAS BANHADO A OURO',34.50,79.90,35.00,27.96,17.43,'Em estoque',NULL,1),(226,'ARGOLA COM ARO QUADRADO LISO BANHADA A OURO',12.50,49.90,30.00,14.97,22.43,'Em estoque',NULL,3),(227,'MEIA ARGOLA COM QUADRADOS E ZIRCÔNIAS BANHADA A OURO',39.50,99.90,30.00,29.97,30.43,'Em estoque',NULL,3),(228,'MEIA ARGOLA TEXTURIZADA VAZADA BANHADA A OURO',39.50,99.00,30.00,29.70,29.80,'Em estoque',NULL,3),(229,'ARGOLA CURVA CRAVEJADA DE ZIRCÔNIAS BANHADA A OURO',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,3),(230,'ARGOLA RETANGULAR COM TRÊS FILEIRAS DE ZIRCÔNIAS BANHADA A OURO',29.50,79.90,30.00,23.97,26.43,'Em estoque',NULL,3),(231,'ARGOLA RETANGULAR COM TRÊS FILEIRAS ZIRCÔNIAS',34.50,89.90,30.00,26.97,28.43,'Em estoque',NULL,3);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (21,4),(22,4),(26,4),(27,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (3,'Super Admin','web','2024-08-05 15:10:33','2024-08-05 15:10:33'),(4,'Consultor','web','2024-08-05 15:10:33','2024-08-05 15:10:33');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'William Henrique','will-hc-1984@hotmail.com',NULL,'$2y$10$lvmedygpBSjBeJb39hdhPe1AluGdyhRkyDu5n0viJ1B3kbOQHY5wy',NULL,'2024-08-02 04:23:36','2024-08-02 04:23:36'),(2,'Karen Daiane Martins Gonçalves','karen-daiane@hotmail.com',NULL,'$2y$10$Lp6hBbqu1byQ0GuM7.kGJ.JACFmENm7N4kJznzSIhO0oupaLWesHa',NULL,'2024-08-02 04:23:36','2024-08-02 04:23:36'),(3,'Evelin Eufrásio','evelin@hotmail.com',NULL,'$2y$10$2ahmWRtF4cftmczkV42dMumKHRC6QHYWxVzdlSiLDXIALIWIwfRjm',NULL,'2024-08-02 04:23:36','2024-08-02 04:23:36');
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

-- Dump completed on 2024-08-05 16:09:16
