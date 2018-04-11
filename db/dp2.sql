-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dp2
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Sale`
--

DROP TABLE IF EXISTS `Sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sale` (
  `Sale_ID` int(11) NOT NULL AUTO_INCREMENT,
  `saletime` datetime NOT NULL,
  PRIMARY KEY (`Sale_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sale`
--

LOCK TABLES `Sale` WRITE;
/*!40000 ALTER TABLE `Sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `Sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SaleItem`
--

DROP TABLE IF EXISTS `SaleItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SaleItem` (
  `Sale_ID` int(11) DEFAULT NULL,
  `SI_ID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  KEY `Sale_ID` (`Sale_ID`),
  KEY `SI_ID` (`SI_ID`),
  CONSTRAINT `SaleItem_ibfk_1` FOREIGN KEY (`Sale_ID`) REFERENCES `Sale` (`Sale_ID`),
  CONSTRAINT `SaleItem_ibfk_2` FOREIGN KEY (`SI_ID`) REFERENCES `StockItem` (`SI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SaleItem`
--

LOCK TABLES `SaleItem` WRITE;
/*!40000 ALTER TABLE `SaleItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `SaleItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StockItem`
--

DROP TABLE IF EXISTS `StockItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StockItem` (
  `SI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`SI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StockItem`
--

LOCK TABLES `StockItem` WRITE;
/*!40000 ALTER TABLE `StockItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `StockItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StockItemOrder`
--

DROP TABLE IF EXISTS `StockItemOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StockItemOrder` (
  `SI_ID` int(11) DEFAULT NULL,
  `SO_ID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  KEY `SI_ID` (`SI_ID`),
  KEY `SO_ID` (`SO_ID`),
  CONSTRAINT `StockItemOrder_ibfk_1` FOREIGN KEY (`SI_ID`) REFERENCES `StockItem` (`SI_ID`),
  CONSTRAINT `StockItemOrder_ibfk_2` FOREIGN KEY (`SO_ID`) REFERENCES `StockOrder` (`SO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StockItemOrder`
--

LOCK TABLES `StockItemOrder` WRITE;
/*!40000 ALTER TABLE `StockItemOrder` DISABLE KEYS */;
/*!40000 ALTER TABLE `StockItemOrder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StockOrder`
--

DROP TABLE IF EXISTS `StockOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StockOrder` (
  `SO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `orderdate` datetime NOT NULL,
  PRIMARY KEY (`SO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StockOrder`
--

LOCK TABLES `StockOrder` WRITE;
/*!40000 ALTER TABLE `StockOrder` DISABLE KEYS */;
/*!40000 ALTER TABLE `StockOrder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-11 16:03:43
