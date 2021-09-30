-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2020 a las 21:08:13
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlsalud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliados`
--

CREATE TABLE `afiliados` (
  `id_afiliado` int(8) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `tipoAfiliado` varchar(10) NOT NULL,
  `sistema` varchar(18) NOT NULL,
  `carrera` varchar(30) NOT NULL,
  `tipoP` varchar(8) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `curp` varchar(20) NOT NULL,
  `nss` varchar(13) NOT NULL,
  `fechaN` date NOT NULL,
  `telefono` varchar(18) NOT NULL,
  `sangre` varchar(4) NOT NULL,
  `alergias` varchar(400) NOT NULL,
  `enfermedades` varchar(400) NOT NULL,
  `antescedentes` varchar(400) NOT NULL,
  `estatura` varchar(8) NOT NULL,
  `peso` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `afiliados`
--

INSERT INTO `afiliados` (`id_afiliado`, `matricula`, `tipoAfiliado`, `sistema`, `carrera`, `tipoP`, `nombre`, `apellidos`, `gender`, `direccion`, `correo`, `curp`, `nss`, `fechaN`, `telefono`, `sangre`, `alergias`, `enfermedades`, `antescedentes`, `estatura`, `peso`) VALUES
(16, '15050014', 'alumno', 'semiescolarizado', 'Informática', '', 'Jorge', 'Gonzalez', 'hombre', 'Tenextepec. Perote', 'jor123490@gmail.com', 'GOBJ880507HVZNNR05', '46127209461', '1995-03-03', '2821023465', 'O-', '', '', '', '1.66', '67 kg'),
(17, '18070081', 'alumno', 'escolarizado', 'Forestal', '', 'Abad ', 'Sanchez Jose', 'hombre', 'PRIMERA SECCION DE CHAMPOLCO, SAN MIGUEL TLALPOALAN, ALTOTON', 'aaa_1_1000@live.com.mx', 'AASJ971130HVZBNS01', '23169459346', '1997-02-06', '28210977654', '', 'ninguna', 'ninguna', 'ninguna', '1.72', '60 kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(9) NOT NULL,
  `id_afiliado` int(8) NOT NULL,
  `id_medicamento` int(6) NOT NULL,
  `fecha_consulta` date NOT NULL,
  `hora` time NOT NULL,
  `presion` varchar(6) NOT NULL,
  `temperatura` varchar(8) NOT NULL,
  `frecCardiaca` varchar(5) NOT NULL,
  `frecR` varchar(5) NOT NULL,
  `enfermedad` varchar(100) NOT NULL,
  `indicaciones` varchar(300) NOT NULL,
  `id_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_afiliado`, `id_medicamento`, `fecha_consulta`, `hora`, `presion`, `temperatura`, `frecCardiaca`, `frecR`, `enfermedad`, `indicaciones`, `id_usuario`) VALUES
(125, 17, 13, '2020-06-24', '20:35:20', '70/100', '24°C', '70-10', '70-10', 'Dolor de cabeza', 'tomar una capsula por la noche', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosgenerales`
--

CREATE TABLE `datosgenerales` (
  `id_datos` int(5) NOT NULL,
  `nombreInstitucion` varchar(100) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `ciudad` varchar(40) NOT NULL,
  `codigopostal` varchar(8) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `sitioweb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datosgenerales`
--

INSERT INTO `datosgenerales` (`id_datos`, `nombreInstitucion`, `direccion`, `ciudad`, `codigopostal`, `correo`, `telefono`, `fax`, `sitioweb`) VALUES
(3, 'Instituto Tecnológico superior de Perote', 'Km. 2.7 Carretera Federal Perote - México', 'Perote', '91270', 'contacto@itsperote.edu.mx', '01 (282) 8-25-31-50', '8 25 36 68', 'https://www.itsperote.edu.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_medicamento` int(6) NOT NULL,
  `lote` varchar(20) NOT NULL,
  `nombrem` varchar(40) NOT NULL,
  `concentracion` varchar(20) NOT NULL,
  `presentacion` varchar(40) NOT NULL,
  `fechaCad` date NOT NULL,
  `cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id_medicamento`, `lote`, `nombrem`, `concentracion`, `presentacion`, `fechaCad`, `cantidad`) VALUES
(13, '190616', 'Rosel', '50 mg', 'capsulas', '2022-07-07', 5),
(14, '19240065', 'GIMALXINA', '500 mg', 'capsulas', '2022-01-24', 14),
(15, '231', 'paracetamol', '50o mg', 'capsulas', '2020-08-29', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mis_eventos`
--

CREATE TABLE `mis_eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mis_eventos`
--

INSERT INTO `mis_eventos` (`id`, `titulo`, `color`, `inicio`, `fin`) VALUES
(32, 'cita  medica', '#228B22', '2020-06-20 00:00:00', '2020-06-21 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `genero` varchar(8) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `contrasenia` varchar(250) NOT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `genero`, `telefono`, `correo`, `direccion`, `contrasenia`, `usuario`) VALUES
(48, 'jorge', 'gonzalez', 'hombre', '423324', 'jor9487@gmail.com', 'TENEXTEPEC', 'd2aa79f1724095e16d6c5349c48a2540', 'jorge56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  ADD PRIMARY KEY (`id_afiliado`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Indices de la tabla `datosgenerales`
--
ALTER TABLE `datosgenerales`
  ADD PRIMARY KEY (`id_datos`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `mis_eventos`
--
ALTER TABLE `mis_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  MODIFY `id_afiliado` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `datosgenerales`
--
ALTER TABLE `datosgenerales`
  MODIFY `id_datos` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_medicamento` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mis_eventos`
--
ALTER TABLE `mis_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
