CREATE DATABASE `votaciones` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

-- votaciones.regions definition

CREATE TABLE `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- votaciones.communes definition

CREATE TABLE `communes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `region_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `communes_FK` (`region_id`),
  CONSTRAINT `communes_FK` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- votaciones.candidates definition

CREATE TABLE `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- votaciones.votes definition

CREATE TABLE `votes` (
  `rut` varchar(100) NOT NULL,
  `name` varchar(190) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `commune_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `conocer` varchar(190) NOT NULL,
  PRIMARY KEY (`rut`),
  KEY `votes_FK` (`region_id`),
  KEY `votes_FK_1` (`commune_id`),
  KEY `votes_FK_2` (`candidate_id`),
  CONSTRAINT `votes_FK` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  CONSTRAINT `votes_FK_1` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`),
  CONSTRAINT `votes_FK_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO votaciones.regions
(id, name)
VALUES(1, 'Metropolitana');
INSERT INTO votaciones.regions
(id, name)
VALUES(2, 'Valparaiso');

INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(1, 'Santiago', 1);
INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(2, 'Maipú', 1);
INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(3, 'San Miguel', 1);
INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(4, 'Quillota', 2);
INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(5, 'Viña del Mar', 2);
INSERT INTO votaciones.communes
(id, name, region_id)
VALUES(6, 'Valparaiso', 2);

INSERT INTO votaciones.candidates
(id, name)
VALUES(1, 'Juan Perez');
INSERT INTO votaciones.candidates
(id, name)
VALUES(2, 'Pepe Muijica');
INSERT INTO votaciones.candidates
(id, name)
VALUES(3, 'Palomo Volador');
INSERT INTO votaciones.candidates
(id, name)
VALUES(4, 'Ronaldo Soccer');