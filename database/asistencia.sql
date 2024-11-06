-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 02:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asistencia`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumno_bloque`
--

CREATE TABLE `alumno_bloque` (
  `alumno_id` int(11) NOT NULL,
  `bloque_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `alumno_bloque`
--

INSERT INTO `alumno_bloque` (`alumno_id`, `bloque_id`) VALUES
(53, 4),
(56, 4),
(57, 4),
(58, 4),
(58, 29),
(58, 32),
(59, 4),
(72, 4),
(72, 29),
(72, 32);

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `bloque_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `asistencias`
--

INSERT INTO `asistencias` (`id`, `alumno_id`, `bloque_id`, `fecha`, `hora`, `estado`) VALUES
(39, 53, 4, '2024-11-05', '19:45:44', 'presente'),
(40, 56, 4, '2024-11-05', '19:45:45', 'presente'),
(41, 57, 4, '2024-11-05', '19:45:51', 'presente'),
(42, 58, 4, '2024-11-05', '20:00:51', 'presente'),
(43, 72, 29, '2024-11-05', '20:00:52', 'falto'),
(44, 59, 29, '2024-11-05', '19:46:02', 'presente'),
(45, 72, 29, '2024-11-04', '20:02:30', 'falto'),
(46, 72, 29, '2024-11-01', '22:10:07', 'falto'),
(50, 72, 29, '2024-10-04', '22:10:07', 'falto');

-- --------------------------------------------------------

--
-- Table structure for table `bloques`
--

CREATE TABLE `bloques` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `horario_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bloques`
--

INSERT INTO `bloques` (`id`, `nombre`, `profesor_id`, `horario_id`) VALUES
(4, 'GESTOR DE CONTENIDOS', 5, 1),
(29, 'PHP 1', 8, 1),
(32, 'PHP 2', 8, 1),
(33, 'APLICACIONES WEB PROGRESIVAS', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `horario_inicio`, `horario_fin`) VALUES
(1, '07:00:00', '10:00:00'),
(2, '13:00:00', '17:00:00'),
(3, '18:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `justificaciones`
--

CREATE TABLE `justificaciones` (
  `id` int(11) NOT NULL,
  `asistencia_id` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'pendiente',
  `archivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `justificaciones`
--

INSERT INTO `justificaciones` (`id`, `asistencia_id`, `mensaje`, `estado`, `archivo`) VALUES
(3, 50, 'Estuve enfermo.', 'pendiente', '../../public/img/Captura de pantalla (1).png'),
(4, 46, 'No habia carro', 'pendiente', '../../public/img/Queee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'instructor'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `habilitado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `correo`, `clave`, `rol_id`, `habilitado`) VALUES
(1, 'Admin', '', 'admin@senati.pe', '123456', 1, 1),
(5, 'Arturo', 'Collado', 'arturoc@senati.pe', '123456', 2, 1),
(8, 'Jorge', 'Luque Chambi', 'jl123456@senati.pe', 'jaracorazon', 2, 1),
(53, 'Daniel Eduardo', 'Villafranqui Colquicocha', '1505049@senati.pe', '123456', 3, 1),
(56, 'Pedro Alessandro', 'Rodenas Aponte', '1506409@senati.pe', '123456', 3, 1),
(57, 'Katherine Michelle', 'Alanya Huayunga', '1525933@senati.pe', '123456', 3, 1),
(58, 'Carlos Alberto', 'Ramirez Villegas', '1515139@senati.pe', '123456', 3, 1),
(59, 'Junior Enrique', 'Ynga Minano', '1642549@senati.pe', '123456', 3, 1),
(72, 'Gabriel', 'Jara', '1265485@senati.pe', '123456', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno_bloque`
--
ALTER TABLE `alumno_bloque`
  ADD PRIMARY KEY (`alumno_id`,`bloque_id`),
  ADD KEY `bloque_id` (`bloque_id`);

--
-- Indexes for table `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asistencias_alumnos` (`alumno_id`),
  ADD KEY `fk_asistencias_bloques` (`bloque_id`);

--
-- Indexes for table `bloques`
--
ALTER TABLE `bloques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bloques_profesores` (`profesor_id`),
  ADD KEY `fk_bloques_horarios` (`horario_id`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `justificaciones`
--
ALTER TABLE `justificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_justificaciones_asistencias` (`asistencia_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_roles` (`rol_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `bloques`
--
ALTER TABLE `bloques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `justificaciones`
--
ALTER TABLE `justificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno_bloque`
--
ALTER TABLE `alumno_bloque`
  ADD CONSTRAINT `alumno_bloque_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `alumno_bloque_ibfk_2` FOREIGN KEY (`bloque_id`) REFERENCES `bloques` (`id`);

--
-- Constraints for table `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `fk_asistencias_alumnos` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_asistencias_bloques` FOREIGN KEY (`bloque_id`) REFERENCES `bloques` (`id`);

--
-- Constraints for table `bloques`
--
ALTER TABLE `bloques`
  ADD CONSTRAINT `fk_bloques_horarios` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`),
  ADD CONSTRAINT `fk_bloques_profesores` FOREIGN KEY (`profesor_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `justificaciones`
--
ALTER TABLE `justificaciones`
  ADD CONSTRAINT `fk_justificaciones_asistencias` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencias` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
