-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: shopping_cart
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vidumini Chandrasekara','viduminipavithra@gmail.com','$2y$10$ftv6Wfb.OzlF5vwukb3zpuERrl7HZ8Z1js2j40EcN6Acu9VhkPJjW'),(2,'vidu','vidu@gmail.com','$2y$10$ZoHuCVk9l5clllKCqK9C4O7xqw7BLH1bGb86uw.aEQ7pte/LvHG3G'),(3,'oshadha','osha@gmail.com','$2y$10$rmgQiAwzaH6fWgJg4zf/pOjX30/1BiCQG07SWN0zVGl/uhkQXMxpa'),(4,'saw','saw@gmail.com','$2y$10$h3efbSo3RHtezsOSkDoQ.uhtWM05OrFqO6gg8QCyml0v6jYB.U0xi'),(5,'oshada','osh@gmail.com','$2y$10$w2Rppy32bcsm25sMJ3kUpuW.rmch6BXtatWDVuSxHGdfmBGxsxT/G'),(6,'oshadha','oshadha@gmail.com','$2y$10$127G8UI8Mdr5BJUUUvQ0vuRrAHKpgrzqGshDN5hLAc6v/Le2OnFPq'),(7,'sawindi','sa@gmail.com','$2y$10$pRCZPS78BufFFbAdcVLQRuKSBrrKp/Qw0ItCPvbcn5iPtyakQrZFS'),(8,'sawindi','sawi@gmail.com','$2y$10$raGNLejyh48A/erZ7iPUW.zWjh3sz1o7widvgE/1Fz0KMHSZp.X1u');
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

-- Dump completed on 2025-03-01 16:45:39
