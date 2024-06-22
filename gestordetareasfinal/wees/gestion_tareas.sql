-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-01-2024 a las 02:32:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE `listas` (
  `id_lista` int(10) NOT NULL,
  `nombre_lista` varchar(150) NOT NULL,
  `descripcion_lista` varchar(150) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listas`
--

INSERT INTO `listas` (`id_lista`, `nombre_lista`, `descripcion_lista`, `id_usuario`) VALUES
(10, 'gbf', '                            z                        ', 4),
(11, 'QWE', 'EEE', 4),
(12, 'f', '                            q                        ', 5),
(14, 'd', 'dd', 5),
(15, 'mmmmmmm', '                            fdgd                        ', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(10) NOT NULL,
  `nombre_tarea` varchar(150) NOT NULL,
  `descripcion_tarea` text NOT NULL,
  `id_lista` int(10) DEFAULT NULL,
  `prioridad` varchar(20) NOT NULL,
  `limite` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `prioridad_valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `nombre_tarea`, `descripcion_tarea`, `id_lista`, `prioridad`, `limite`, `id_usuario`, `prioridad_valor`) VALUES
(6, 'b', '                                                         s                                                                                       ', 10, 'Alta', '2024-01-18', 4, 1),
(7, 'qweeeeee', 'qweeeeee', 10, 'Baja', '2024-01-18', 5, 3),
(10, 'fg', 'sgf', 12, 'Baja', '2024-01-18', 5, 3),
(12, 'a', '                        hhh                        ', 10, 'Baja', '2024-02-11', 4, 3),
(13, 'c', '                                                                                                                        mmmm                                                                        ', 15, 'Media', '2023-12-01', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `foto_perfil`) VALUES
(4, 'a', 'a@a.com', 'a', 'foto_usuario/165482752_1273389499724880_8882263360285183350_n.jpg'),
(5, 'z', 'z@z.com', 'z', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `listas`
--
ALTER TABLE `listas`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_lista` (`id_lista`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `listas`
--
ALTER TABLE `listas`
  MODIFY `id_lista` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listas`
--
ALTER TABLE `listas`
  ADD CONSTRAINT `listas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`id_lista`) REFERENCES `listas` (`id_lista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
