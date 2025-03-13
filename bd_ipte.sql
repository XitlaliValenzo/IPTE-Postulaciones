-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-02-2024 a las 18:07:56
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id21134804_bd_ipte_empleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratacion`
--

CREATE TABLE `contratacion` (
  `id` int(10) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `info_empleo` varchar(1000) NOT NULL,
  `acta_nacimiento` varchar(60) DEFAULT NULL,
  `curp` varchar(60) DEFAULT NULL,
  `com_domicilio` varchar(50) DEFAULT NULL,
  `ine` varchar(60) DEFAULT NULL,
  `nss` varchar(60) DEFAULT NULL,
  `fiscal_sat` varchar(60) DEFAULT NULL,
  `titulo` varchar(60) DEFAULT NULL,
  `cedula` varchar(60) DEFAULT NULL,
  `id_postulante` int(10) NOT NULL,
  `id_vacante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contratacion`
--

INSERT INTO `contratacion` (`id`, `puesto`, `fecha_contratacion`, `info_empleo`, `acta_nacimiento`, `curp`, `com_domicilio`, `ine`, `nss`, `fiscal_sat`, `titulo`, `cedula`, `id_postulante`, `id_vacante`) VALUES
(1, 'Vacante 1', '2023-08-13', 'Presentarse el día 16', NULL, '4-curp.pdf', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1),
(2, 'Soporte Técnico', '2023-08-13', 'Presentarse el día 16 de agosto para recorger los uniformes.', '5-nss.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2),
(3, 'Soporte Técnico', '2023-08-13', 'Presentarse el día 18 de agosto', '6-cuadro sinoptico Cancino Leyva Carlos.pdf', NULL, NULL, NULL, '6-proyecto final (1).pdf', NULL, NULL, NULL, 6, 2),
(4, 'Soporte Técnico', '2023-08-13', 'Presentarse el día viernes 18 de agosto', NULL, '7-curp.pdf', NULL, NULL, NULL, NULL, NULL, NULL, 7, 2),
(5, 'Soporte Técnico', '2023-08-14', 'Presentarse el dia 25 de agosto', '8-IT IPTE ORGANIGRAMA JUNIO 2023.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 2),
(6, 'Soporte Técnico', '2023-08-15', 'asistir el dia de mañana', '9-Calendario UTCGG 2022-2023.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevistas`
--

CREATE TABLE `entrevistas` (
  `id_entrevista` int(10) NOT NULL,
  `fecha_entrevista` date NOT NULL,
  `hora_entrevista` time NOT NULL,
  `modalidad_entrevista` varchar(15) NOT NULL,
  `ubicacion_entrevista` varchar(100) DEFAULT NULL,
  `link_teams` varchar(50) DEFAULT NULL,
  `estatus_entrevista` varchar(40) NOT NULL,
  `cancelacion_entrevista` varchar(1000) DEFAULT NULL,
  `asistencia_entrevista` varchar(2) DEFAULT NULL,
  `id_postulante` int(10) NOT NULL,
  `activo_entrevista` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entrevistas`
--

INSERT INTO `entrevistas` (`id_entrevista`, `fecha_entrevista`, `hora_entrevista`, `modalidad_entrevista`, `ubicacion_entrevista`, `link_teams`, `estatus_entrevista`, `cancelacion_entrevista`, `asistencia_entrevista`, `id_postulante`, `activo_entrevista`) VALUES
(1, '2023-08-15', '12:30:00', 'Presencial', 'Aeropuerto, calle 6', NULL, 'Cancelada', 'Prueba', 'Sí', 2, 2),
(2, '2023-08-14', '14:13:00', 'Online', NULL, 'https://utcgg.edu.mx/', 'Realizada', NULL, 'Sí', 4, 1),
(3, '2023-08-15', '14:46:00', 'Online', NULL, 'https://utcgg.edu.mx/', 'Realizada', NULL, 'Sí', 4, 1),
(4, '2023-08-14', '08:26:00', 'Presencial', 'Aeropuerto calle 6', NULL, 'Realizada', NULL, 'Sí', 5, 1),
(5, '2023-08-14', '08:16:00', 'Presencial', 'Aeropuerto calle 6', NULL, 'Realizada', NULL, 'Sí', 6, 1),
(6, '2023-08-14', '09:30:00', 'Presencial', 'Aeropuerto calle 6, Zihuatanejo', NULL, 'Realizada', NULL, 'Sí', 7, 1),
(7, '2023-08-16', '10:00:00', 'Presencial', 'Aeropuerto calle 6', NULL, 'Realizada', NULL, 'Sí', 7, 1),
(8, '2023-08-17', '08:10:00', 'Presencial', 'Aeropuerto', NULL, 'Realizada', NULL, 'Sí', 8, 1),
(9, '2023-08-21', '10:00:00', 'Presencial', 'Aeropuerto', NULL, 'Realizada', NULL, 'Sí', 8, 1),
(10, '2023-08-16', '10:00:00', 'Presencial', 'Aeropuerto', NULL, 'Realizada', NULL, 'Sí', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `edad` int(3) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `image` longblob DEFAULT NULL,
  `puesto` varchar(50) DEFAULT NULL,
  `curriculum` varchar(100) DEFAULT NULL,
  `fecha_postulacion` date DEFAULT NULL,
  `estatus` varchar(40) DEFAULT NULL,
  `entrevista` varchar(10) DEFAULT NULL,
  `role` varchar(15) NOT NULL,
  `id_vacante` int(10) DEFAULT NULL,
  `activo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `telefono`, `edad`, `genero`, `direccion`, `image`, `puesto`, `curriculum`, `fecha_postulacion`, `estatus`, `entrevista`, `role`, `id_vacante`, `activo`) VALUES
(1, 'Ixzama Yaena Oregón García', 'ioregon@ipte.com.mx', 'b685384b959445da13ba916fcdd0e690', '7773272805', 30, 'Femenino', 'Zihuatanejo', 0x666f6e646f2e706e67, 'Gerente de Gestión de Capital Humano', NULL, NULL, NULL, NULL, 'administrador', NULL, 1),
(2, 'Alex Dayren Valenzo Serna', 'alex@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7551206819', 23, 'Femenino', 'Agua de Correa, Zihuatanejo', 0x496dc3a167656e6573206465204c696c6f20792053746963685f2e6a7067, NULL, '2-Calendario UTCGG 2022-2023.pdf', '2023-08-11', 'Entrevista cancelada', 'Presencial', 'postulante', 1, 1),
(3, 'Gabriela López Alvarado', 'glopez@ipte.com.mx', '25d55ad283aa400af464c76d713c07ad', '7551569683', 25, 'Femenino', 'Zihuatanejo', NULL, 'Ejecutiva de recursos humanos', NULL, NULL, NULL, NULL, 'administrador', NULL, 1),
(4, 'Emily Nazaret Valenzo Serna', 'emily@gmail.com', '50b4dcb78f2030b76592ba7301b8b209', '7551286016', 25, 'Femenino', 'Coacoyul, Zihuatanejo', 0x70726f796563746f732d697074652d6465736172726f6c6c6f732e6a7067, NULL, '4-carta_presentacion.pdf', '2023-08-13', 'Contratado', 'Online', 'postulante', 1, 2),
(5, 'Eva Alejandra Serna', 'alejandra@gmail.com', '5bf8cae6707c0856e729b1b3f625b86d', '7555590967', 47, 'Femenino', 'Coacoyul', 0x6c6f676f2e706e67, NULL, '5-Calendario UTCGG 2022-2023.pdf', '2023-08-13', 'Contratado', 'Presencial', 'postulante', 2, 1),
(6, 'Carlos Raul Cancino Leyva', '123@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7551434538', 27, 'Masculino', 'tu corazon', 0x50686f746f477269645f506c75735f313539373631323739343035302e706e67, NULL, '6-cuadro sinoptico Cancino Leyva Carlos.pdf', '2023-08-13', 'Contratado', 'Presencial', 'postulante', 2, 1),
(7, 'Jaime Valenzo Moreno', 'jaime@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7551297594', 50, 'Masculino', 'Coacoyul, colonia Morelos', 0x6573746163696f6e2d6d6574656f726f6c6f676963612e6a7067, NULL, '7-Calendario UTCGG 2022-2023.pdf', '2023-08-13', 'Contratado', 'Presencial', 'postulante', 2, 1),
(8, 'Benjamin ', 'benjamin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '7551298565', 39, 'Masculino', 'Zihuatanejo', 0x6572726f722e706e67, NULL, '8-Calendario UTCGG 2022-2023.pdf', '2023-08-14', 'Contratado', 'Presencial', 'postulante', 2, 1),
(9, 'Eduardo Hernandez ', 'eduardo@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7551201444', 19, 'Masculino', 'El cayuco, petatlán', 0x70657266696c202831292e706e67, NULL, '9-curriculum.pdf', '2023-08-15', 'Contratado', 'Presencial', 'postulante', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacante`
--

CREATE TABLE `vacante` (
  `id_vacante` int(11) NOT NULL,
  `puesto_vacante` varchar(100) NOT NULL,
  `descripcion_vacante` varchar(200) NOT NULL,
  `perfil_vacante` varchar(1000) NOT NULL,
  `sueldo_vacante` int(5) NOT NULL,
  `ubicacion_vacante` varchar(80) NOT NULL,
  `modalidad_vacante` varchar(25) NOT NULL,
  `modalidad_entrevista` varchar(20) NOT NULL,
  `comentarios_vacante` varchar(1000) DEFAULT NULL,
  `fecha_vacante` date NOT NULL,
  `activo_vacante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vacante`
--

INSERT INTO `vacante` (`id_vacante`, `puesto_vacante`, `descripcion_vacante`, `perfil_vacante`, `sueldo_vacante`, `ubicacion_vacante`, `modalidad_vacante`, `modalidad_entrevista`, `comentarios_vacante`, `fecha_vacante`, `activo_vacante`) VALUES
(1, 'Vacante 1', 'Descripcion', 'Perfil', 8000, 'Zihuatanejo', 'Empleo presencial', 'Presencial y online', 'Comentarios', '2023-08-11', 2),
(2, 'Soporte Técnico', 'Realizar soporte técnico.', 'Ser ingeniero en sistemas o carrera a fin.<br />\r\nExperiencia.<br />\r\nResolver problemas.', 8000, 'Aeropuerto calle 6', 'Empleo presencial', 'Presencial', 'Prestaciones de ley.<br />\r\nUniformes.', '2023-08-13', 1),
(3, 'Almacen', 'Llevar a cabo el orden del almacen.<br />\r\nRecibir compras.', 'Nivel de estudios: Universidad<br />\r\nSer organizado.', 8000, 'Aeropuerto, Zihuatanejo, Gro', 'Empleo presencial', 'Presencial', 'Prestaciones de ley.<br />\r\nUniformes', '2023-08-13', 2),
(4, 'Mantenimiento', 'Dar mantenimiento.<br />\r\nDar mantenimiento.', 'Carrera afín al puesto.<br />\r\nExperiencia laboral.', 8000, 'Zihuatanejo', 'Empleo presencial', 'Presencial', 'Prestaciones de ley.<br />\r\nUniformes.', '2023-08-13', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_vacante_contratacion` (`id_vacante`),
  ADD KEY `FK_postulante_contratacion` (`id_postulante`);

--
-- Indices de la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  ADD PRIMARY KEY (`id_entrevista`),
  ADD KEY `FK_postulante_entrevista` (`id_postulante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_vacante` (`id_vacante`);

--
-- Indices de la tabla `vacante`
--
ALTER TABLE `vacante`
  ADD PRIMARY KEY (`id_vacante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  MODIFY `id_entrevista` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `vacante`
--
ALTER TABLE `vacante`
  MODIFY `id_vacante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contratacion`
--
ALTER TABLE `contratacion`
  ADD CONSTRAINT `FK_postulante_contratacion` FOREIGN KEY (`id_postulante`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `FK_vacante_contratacion` FOREIGN KEY (`id_vacante`) REFERENCES `vacante` (`id_vacante`);

--
-- Filtros para la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  ADD CONSTRAINT `FK_postulante_entrevista` FOREIGN KEY (`id_postulante`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_id_vacante` FOREIGN KEY (`id_vacante`) REFERENCES `vacante` (`id_vacante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
