-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: eatnrun
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `bddsports`
--

DROP TABLE IF EXISTS `bddsports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bddsports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kcalh` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bddsports`
--

LOCK TABLES `bddsports` WRITE;
/*!40000 ALTER TABLE `bddsports` DISABLE KEYS */;
INSERT INTO `bddsports` VALUES (1,'Aerobic, enseignement dans une classe',354),(2,'Aerobic, faible impact',295),(3,'Aerobic, fort impact',413),(4,'Aerobic, general',384),(5,'Agriculture, mise en boules de foin, nettoyage de la grange',472),(6,'Agriculture, pelleter les grains',325),(7,'Agriculture, traite a la main',177),(8,'Aquagym (aqua-aerobic)',236),(9,'Aviron, position assise, allure lente',413),(10,'Aviron, position assise, allure moderee',502),(11,'Aviron, position assise, allure vigoureuse',561),(12,'Aviron, position assise, allure tres vigoureuse',708),(13,'Badminton, hors competition',266),(14,'Badminton, en competition',413),(15,'Balle au prisonier',295),(16,'Barman, serveur',148),(17,'Baseball',295),(18,'Basket-ball, tirs aux paniers',266),(19,'Basket-ball, general',354),(20,'Basket-ball, en fauteuil roulant',384),(21,'Basket-ball, arbitrage',413),(22,'Basket-ball, en match',472),(23,'Billard',148),(24,'Bobsleigh',413),(25,'Bolo, jeu normal',354),(26,'Bolo, mode competition',590),(27,'Bowling',177),(28,'Boxe, frappant les sacs',354),(29,'Boxe, entraînement (mode sparring partner)',531),(30,'Boxe, sur le ring, general',708),(31,'Broomball, ballon-balai, ballon sur glace',413),(32,'Canoë-kayak, allure lente',177),(33,'Canoë-kayak, allure moderee',413),(34,'Canoë-kayak, en equipe, mode competition',708),(35,'Catch, lutte',354),(36,'Chasse, general',295),(37,'Club de remise en forme, exercices, general',325),(38,'Conduire un camion (position assise)',118),(39,'Construction, a l\'exterieur, remodelage',325),(40,'Corde a sauter, allure lente',472),(41,'Corde a sauter, allure moderee, general',590),(42,'Corde a sauter, allure rapide',708),(43,'Course a pied',384),(44,'Course a pied, 8 km/h',472),(45,'Course a pied, 9,5 km/h',590),(46,'Course a pied, 10,8 km/h',649),(47,'Course a pied, 11,25 km/h',679),(48,'Course a pied, 12 km/h',738),(49,'Course a pied, 13 km/h',797),(50,'Course a pied, 13,8 km/h',826),(51,'Course a pied, 14,5 km/h',885),(52,'Course a pied, 16 km/h',944),(53,'Course a pied, 17,5 km/h',1062),(54,'Course a pied, cross country',531),(55,'Course a pied, en montant les escaliers',885),(56,'Course a pied, general',472),(57,'Course a pied, sur une piste, pratique en equipe',590),(58,'Courses de chevaux, galopant',472),(59,'Course d\'orientation',531),(60,'Cricket',295),(61,'Croquet',148),(62,'Crosse',472),(63,'Cuisson ou preparation des plats',148),(64,'Curling',236),(65,'Cyclisme, < 16 km/h, loisirs',236),(66,'Cyclisme, de 16 a 19 km/h, allure lente',354),(67,'Cyclisme, 19 a 22 km/h, allure moderee',472),(68,'Cyclisme, 22 a 25 km/h, allure vigoureuse',590),(69,'Cyclisme, 25 a 30 km/h, tres rapide, en course',708),(70,'Cyclisme, > 32 km/h, courses',944),(71,'Cyclisme, VTT en montagne ou BMX',502),(72,'Cyclisme, velo d\'appartement, allure tres lente',177),(73,'Cyclisme, velo d\'appartement, allure lente',325),(74,'Cyclisme, velo d\'appartement, allure moderee',413),(75,'Cyclisme, velo d\'appartement, allure vigoureuse',620),(76,'Cyclisme, velo d\'appartement, allure tres vigoureuse',738),(77,'Cyclisme, velo d\'appartement, general',295),(78,'Danse (salle de bal, lente)',177),(79,'Danse, general',266),(80,'Danse (salle de bal, rapide)',325),(81,'Danse (aerobic, ballet ou moderne)',354),(82,'Danse de salon (en couple), lente',177),(83,'Danse de salon (en couple), rapide',325),(84,'Demenager (deballant les cartons)',207),(85,'Deplacement de meubles, dans la maison',354),(86,'Deplacement d\'objets menagers, par escalier',531),(87,'Deplacement d\'objets menagers en portant les objets',413),(88,'Descendre l\'escalier en marchant',177),(89,'Dormir',37),(90,'Poser ou enlever les tapis/carrelages du sol',266),(91,'Entraînement en circuit, general, peu de repos',472),(92,'Equitation, general',236),(93,'Equitation, marche',148),(94,'Equitation, trot',384),(95,'Escalade, varappe, descente en rappel',472),(96,'Escalade, varappe, ascension de rochers',649),(97,'Escrime',354),(98,'Etirements, leger',148),(99,'Etirements, hatha yoga',236),(100,'Exercices corporels, a la maison, allure legere ou moderee',266),(101,'Exercices corporels, a la maison, allure vigoureuse',472),(102,'Extraction du charbon (de la mine)',354),(103,'Faire la cuisine',148),(104,'Faire la queue (debout)',75),(105,'Faire les courses (avec un chariot)',207),(106,'Flechettes (mur ou pelouse)',148),(107,'Footbag',240),(108,'Football (exercices, course drapeaux, general)',472),(109,'Football, mode competition',590),(110,'Football, occasionnel, general',413),(111,'Foresterie',472),(112,'Frisbee (mode rythme)',207),(113,'Frisbee, general',177),(114,'Frisbee, ultimate',480),(115,'Gainage (sur les mains)',410),(116,'Golf (mini-serie ou frapper au loin)',177),(117,'Golf (utilisant le chariot)',207),(118,'Golf (tirant les clubs)',295),(119,'Golf (transportant des clubs)',325),(120,'Golf, general',236),(121,'Grattage, plâtrage, peinture, mettre du papier mural',266),(122,'Gymnastique, general',236),(123,'Gymnastique suedoise, maison, effort leger/modere',210),(124,'Halterophilie, allure moderee',177),(125,'Halterophilie, allure vigoureuse',354),(126,'Handball (jeu en equipe)',472),(127,'Handball, general',708),(128,'Hockey sur gazon',472),(129,'Hockey sur glace',472),(130,'Hors-bord',148),(131,'Jaï-alaï (pelote basque)',720),(132,'Jardinage, general',295),(133,'Jeu de palet, de boulingrin',177),(134,'Jogging, general',413),(135,'Jogging, dans l\'eau (aquajogging)',472),(136,'Jonglage',236),(137,'Jouer un instrument tout en marchant (ex. : parade)',236),(138,'Judo, jujitsu',590),(139,'Karate',590),(140,'Kayak',295),(141,'Kickball',420),(142,'Kick Boxing',590),(143,'Laver le chien',207),(144,'Les Mills BodyAttack',475),(145,'Les Mills BodyBalance/BodyFlow',232),(146,'Les Mills BodyCombat',481),(147,'Les Mills BodyPump',325),(148,'Les Mills BodyStep',478),(149,'Les Mills Grit',549),(150,'Les Mills RPM',449),(151,'Lire (en s\'asseyant)',67),(152,'Luge',413),(153,'Maçonnerie',413),(154,'Marche rapide (ex. : parade militaire)',384),(155,'Marcher/Courir, jouant avec enfant, allure moderee',236),(156,'Marcher/Courir, jouant avec enfant, allure vigoureuse',295),(157,'Masseur (position debout)',236),(158,'Menuiserie, charpenterie, general',207),(159,'Monocycle',295),(160,'Moto-cross',236),(161,'Motoneige',207),(162,'Musculation',354),(163,'Musique, batterie',236),(164,'Musique, guitare, classique (assis)',118),(165,'Musique, guitare, rock and roll (debout)',177),(166,'Musique, piano, orgue, violon',148),(167,'Musique, violoncelle, flûte, cor',118),(168,'Natation sychronisee',472),(169,'Natation, brasse papillon, general',660),(170,'Natation, brasse, general',590),(171,'Natation, dos, general',472),(172,'Natation, laps, allure moderee',472),(173,'Natation, laps, allure rapide',590),(174,'Natation, papillon, general',649),(175,'Natation, pour le loisir, general',354),(176,'Natation, sur place, allure moderee',236),(177,'Natation, sur place, allure rapide',590),(178,'Nettoyage du garage, du trottoir',236),(179,'Nettoyage du sol, utilisant mains et genoux',325),(180,'Nettoyage, allure lente ou modere',148),(181,'Nettoyage, dans la maison, general',207),(182,'Nettoyage (voiture, fenetres, etc.), lourd et vigoureux',266),(183,'Nettoyer les gouttieres',295),(184,'Officier de police',148),(185,'Pansage de chevaux, lent',210),(186,'Pansage de chevaux, intense',354),(187,'Parachutisme',177),(188,'Patinage sur glace, 14 km/h ou moins',325),(189,'Patinage sur glace, allure rapide (> 14 km/h)',531),(190,'Patinage sur glace, allure rapide (mode competition)',885),(191,'Patinage sur glace, general',413),(192,'Patinage, roller',413),(193,'Peche dans la riviere, dans les echassiers',354),(194,'Peche sur bateau, position assise',148),(195,'Peche sur la berge des rivieres, position debout',207),(196,'Peche, general',236),(197,'Peche, sur la glace, position assise',118),(198,'Pedalo',236),(199,'Pelleter la neige, a la main',354),(200,'Pilates',150),(201,'Plongee (sous-marine, tremplin ou plate-forme)',177),(202,'Plongee en apnee (snorkeling)',295),(203,'Plongee sous-marine, general',413),(204,'Polo',472),(205,'Pompes, intense',474),(206,'Pompier en train d\'eteindre une incendie',708),(207,'Port de charges lourdes (comme des briques)',472),(208,'Porter un sac a dos, general',413),(209,'Porter entre 7 et 11 kilos en montant l\'escalier',354),(210,'Porter entre 12 et 22 kilos en montant l\'escalier',472),(211,'Poser un double-vitrage',295),(212,'Pousser ou tirer une poussette avec enfant',148),(213,'Pousser un fauteuil roulant',236),(214,'Promenader a pied, moins de 3 km/h, allure tres lente',118),(215,'Promenade a pied, 3 km/h, allure lente',148),(216,'Promenade a pied, 5 km/h, allure moderee',207),(217,'Promenade a pied, 5,5 km/h, en montee',236),(218,'Promenade a pied, 6,5 km/h, allure tres rapide',354),(219,'Promenade a pied, a l\'aide de bequilles',236),(220,'Promenade a pied, en montant',472),(221,'Promenade a pied, piste d\'herbe',295),(222,'Promenade a pied, transportant 1 enfant ou 7 kgs',207),(223,'Promener le chien',177),(224,'Racketball, jeu normal',413),(225,'Racketball, mode competition',590),(226,'Rafting',295),(227,'Rameur; allure lente',207),(228,'Rameur; allure moderee',413),(229,'Rameur; allure rapide',502),(230,'Rameur; allure tres rapide',708),(231,'Randonnee pedestre, cross country',354),(232,'Raquette (sur neige)',472),(233,'Ratisser la pelouse',236),(234,'Redressement assis, intense',474),(235,'Regarder la TV',45),(236,'Remontee mecanique, general',420),(237,'Reparation automobile',177),(238,'Repeindre la maison a l\'exterieur',295),(239,'Rugby',590),(240,'Saut a ski (montee au lieu du saut en emportant les skis)',413),(241,'Sauts avec ecart (Jumping Jack), intense',498),(242,'Seance de jeu avec enfant, mouvements legers',148),(243,'S\'asseoir dans une reunion',96),(244,'S\'asseoir dans une classe, travail de bureau',104),(245,'Skateboard',295),(246,'Ski sur l\'eau, ski nautique',354),(247,'Ski sur neige, general',413),(248,'Ski, en descente, allure lente',295),(249,'Ski, en descente, allure moderee',354),(250,'Ski, en descente, allure vigoureuse',472),(251,'Ski, ski de fond, allure lente',413),(252,'Ski, ski de fond, allure modere',472),(253,'Ski, ski de fond, allure vigoureuse',531),(254,'Ski, ski de fond, allure course',826),(255,'Ski, ski de fond, en montee',974),(256,'Snowboard',372),(257,'Softball, lancer rapide ou lent',295),(258,'Softball, arbitrage',240),(259,'Soins des enfants (bain, nourrir, etc.), position assise',177),(260,'Soins des enfants (bain, nourrir, etc.), position debout',207),(261,'Soudage, ou travailler dans une salle de cinema',177),(262,'Sortir la poubelle',177),(263,'Spinning',420),(264,'Squash',708),(265,'Step, intense',876),(266,'Stepper, machine simulateur d\'escalier',531),(267,'Surf (couche ou debout sur la planche)',177),(268,'Tâches menageres, faire le menage, general',207),(269,'Tae Bo',606),(270,'Tae Kwon Do',590),(271,'Tai chi',236),(272,'Tennis de table, ping-pong',236),(273,'Tennis, double',354),(274,'Tennis, general',413),(275,'Tennis, simple',472),(276,'Tir a l\'arc (en tant que sport et non en situation de chasse)',207),(277,'Toilettage du cheval',354),(278,'Tondre la pelouse, assis sur la tondeuse',148),(279,'Tondre la pelouse, general',325),(280,'Tractions (exercice de musculation), intense',456),(281,'Trampoline',207),(282,'Travail (leger) dans un bureau',89),(283,'Travailler sur l\'ordinateur',81),(284,'Travaux d\'electricite, plomberie',177),(285,'Velo elliptique (allure moderee)',410),(286,'Velo elliptique (allure vigoureuse)',485),(287,'Voile, bateau, planche a voile, general',180),(288,'Voile, en mode competition',295),(289,'Voile, planche a voile, general',177),(290,'Volley-ball dans l\'eau',177),(291,'Volley-ball, a la plage',472),(292,'Volley-ball, hors competition',177),(293,'Volley-ball, mode competition, dans un gymnase',236),(294,'Wallyball, general',413),(295,'Water polo',590),(296,'Wii baseball',210),(297,'Wii bowling',174),(298,'Wii boxe',324),(299,'Wii golf',150),(300,'Wii tennis',240),(301,'Zumba',528);
/*!40000 ALTER TABLE `bddsports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `nbkcal` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_idx` (`id_user`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1,'2017-03-23',' 3270160717323 ',858,1),(2,'2017-03-24',' 7613034383808 ',759,1),(3,'2017-03-24',' 3302741967107 ',1073,1),(4,'2017-03-24',' 3302741967107 ',1073,1),(9,'2017-03-24',' 3263859496319 ',313,1);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bddsports` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `kcaltotal` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_bddsports_idx` (`id_bddsports`),
  KEY `id_user_idx` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_bddsports` FOREIGN KEY (`id_bddsports`) REFERENCES `bddsports` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (1,272,1,'2017-03-24',354,0),(2,296,1,'2017-03-24',1680,0),(3,301,1,'2017-03-24',528,0);
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'LE FLOHIC','9cf95dacd226dcf43da376cdb6cbba7035218921','lf.nicolas45@gmail.com','Nicolas');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-24  8:08:23
