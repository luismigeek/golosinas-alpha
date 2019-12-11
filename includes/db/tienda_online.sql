-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-12-2019 a las 18:09:55
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLE_PEDIDO`
--

CREATE TABLE `DETALLE_PEDIDO` (
  `DEPE_ID` bigint(10) UNSIGNED NOT NULL COMMENT 'PK - Identificador unico',
  `DEPE_PE_ID` bigint(10) UNSIGNED NOT NULL COMMENT 'FK - Id del pedido al que pertenece el item',
  `DEPE_GO_ID` bigint(10) UNSIGNED NOT NULL COMMENT 'FK - Id de la golosina'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPLEADO`
--

CREATE TABLE `EMPLEADO` (
  `EM_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador único ',
  `EM_NOMBRE` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del empleado',
  `EM_APELLIDO` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido del empleado',
  `EM_TELEFONO` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Telefono del empleado',
  `EM_SALARIO` double NOT NULL COMMENT 'Salario del empleado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `EMPLEADO`
--

INSERT INTO `EMPLEADO` (`EM_ID`, `EM_NOMBRE`, `EM_APELLIDO`, `EM_TELEFONO`, `EM_SALARIO`) VALUES
(1, 'Luis ', 'Naranjo', '3166201947', 1500000),
(2, 'Mario Ivan', 'Naranjo B.', '3157651423', 1200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GOLOSINA`
--

CREATE TABLE `GOLOSINA` (
  `GO_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador unico',
  `GO_DESC` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripción de la golosina ',
  `GO_PRECIO` double NOT NULL COMMENT 'Precio de la unidad',
  `GO_STOCK` int(11) NOT NULL COMMENT 'Cantidad en existencia ',
  `GO_GOPR_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id del proveedor de la golosina',
  `GO_GOCA_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id de la categoría a la que pertenece la golosina',
  `GO_GOPRE_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id de la presentación de la golosina'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GO_CATEGORIAS`
--

CREATE TABLE `GO_CATEGORIAS` (
  `GOCA_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador unico',
  `GOCA_DESC` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripción de la categoría',
  `GOCA_ESTADO` int(11) NOT NULL COMMENT 'Disponible o no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla que contiene las categorías de las golosinas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GO_PRESENTACIONES`
--

CREATE TABLE `GO_PRESENTACIONES` (
  `GOPRE_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador único',
  `GOPRE_DESC` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripción de la presentación ',
  `GOPRE_ESTADO` int(11) NOT NULL COMMENT 'Disponible o no disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla que contiene las presentaciones de las golosinas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GO_PROVEEDOR`
--

CREATE TABLE `GO_PROVEEDOR` (
  `PR_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador único',
  `PR_NOMBRE` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del proveedor',
  `PR_ORIGEN` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'El proveedor puede ser nacional o extranjero',
  `PR_SUCURSAL` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sucursal del proveedor',
  `PR_TELEFONO` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Telefono del proveedor',
  `PR_URL` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Url del proveedor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `GO_PROVEEDOR`
--

INSERT INTO `GO_PROVEEDOR` (`PR_ID`, `PR_NOMBRE`, `PR_ORIGEN`, `PR_SUCURSAL`, `PR_TELEFONO`, `PR_URL`) VALUES
(16, '7767', '5765765', '676755', '6765', 'https://jkahej.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PEDIDO`
--

CREATE TABLE `PEDIDO` (
  `PE_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador unico',
  `PE_FECHA` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Fecha del pedido',
  `PE_US_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id del usuario que arma el pedido',
  `PE_EM_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id del empleado que hará el domicilio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER_AUTH`
--

CREATE TABLE `USER_AUTH` (
  `USAU_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identidicador unico',
  `USAU_EMAIL` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email para iniciar sesion',
  `USAU_PASSWORD` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Contraseña para iniciar sesion',
  `USAU_USTI_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - Id del tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Esta tabla contiene los datos de autenticación de los usuarios';

--
-- Volcado de datos para la tabla `USER_AUTH`
--

INSERT INTO `USER_AUTH` (`USAU_ID`, `USAU_EMAIL`, `USAU_PASSWORD`, `USAU_USTI_ID`) VALUES
(1, 'luismigeek@gmail.com', 'luismigeek', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER_TIPO`
--

CREATE TABLE `USER_TIPO` (
  `USTI_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'PK - Identificador único',
  `USTI_DESC` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripción del tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `USER_TIPO`
--

INSERT INTO `USER_TIPO` (`USTI_ID`, `USTI_DESC`) VALUES
(1, 'ADMIN'),
(2, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `US_ID` bigint(10) UNSIGNED NOT NULL COMMENT 'PK - Identificador unico',
  `US_NOMBRE` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre de usuario',
  `US_APELLIDO` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido del usuario',
  `US_TELEFONO` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Telefono del usuario',
  `US_DIRECCION` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Dirección del usuario',
  `USAU_ID` bigint(20) UNSIGNED NOT NULL COMMENT 'FK - ID de los datos de autenticacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `DETALLE_PEDIDO`
--
ALTER TABLE `DETALLE_PEDIDO`
  ADD PRIMARY KEY (`DEPE_ID`),
  ADD KEY `DEPE_GO_ID` (`DEPE_GO_ID`),
  ADD KEY `DEPE_PE_ID` (`DEPE_PE_ID`);

--
-- Indices de la tabla `EMPLEADO`
--
ALTER TABLE `EMPLEADO`
  ADD PRIMARY KEY (`EM_ID`);

--
-- Indices de la tabla `GOLOSINA`
--
ALTER TABLE `GOLOSINA`
  ADD PRIMARY KEY (`GO_ID`),
  ADD KEY `GOCA_ID` (`GO_GOCA_ID`),
  ADD KEY `GOPR_ID` (`GO_GOPR_ID`),
  ADD KEY `GOPRE_ID` (`GO_GOPRE_ID`);

--
-- Indices de la tabla `GO_CATEGORIAS`
--
ALTER TABLE `GO_CATEGORIAS`
  ADD PRIMARY KEY (`GOCA_ID`);

--
-- Indices de la tabla `GO_PRESENTACIONES`
--
ALTER TABLE `GO_PRESENTACIONES`
  ADD PRIMARY KEY (`GOPRE_ID`);

--
-- Indices de la tabla `GO_PROVEEDOR`
--
ALTER TABLE `GO_PROVEEDOR`
  ADD PRIMARY KEY (`PR_ID`);

--
-- Indices de la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  ADD PRIMARY KEY (`PE_ID`),
  ADD KEY `PE_EM_ID` (`PE_EM_ID`),
  ADD KEY `PE_US_ID` (`PE_US_ID`);

--
-- Indices de la tabla `USER_AUTH`
--
ALTER TABLE `USER_AUTH`
  ADD PRIMARY KEY (`USAU_ID`),
  ADD KEY `USTI_ID` (`USAU_USTI_ID`);

--
-- Indices de la tabla `USER_TIPO`
--
ALTER TABLE `USER_TIPO`
  ADD PRIMARY KEY (`USTI_ID`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`US_ID`),
  ADD KEY `USAU_ID` (`USAU_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `EMPLEADO`
--
ALTER TABLE `EMPLEADO`
  MODIFY `EM_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador único ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `GOLOSINA`
--
ALTER TABLE `GOLOSINA`
  MODIFY `GO_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador unico';

--
-- AUTO_INCREMENT de la tabla `GO_CATEGORIAS`
--
ALTER TABLE `GO_CATEGORIAS`
  MODIFY `GOCA_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador unico';

--
-- AUTO_INCREMENT de la tabla `GO_PRESENTACIONES`
--
ALTER TABLE `GO_PRESENTACIONES`
  MODIFY `GOPRE_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador único';

--
-- AUTO_INCREMENT de la tabla `GO_PROVEEDOR`
--
ALTER TABLE `GO_PROVEEDOR`
  MODIFY `PR_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador único', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  MODIFY `PE_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador unico';

--
-- AUTO_INCREMENT de la tabla `USER_AUTH`
--
ALTER TABLE `USER_AUTH`
  MODIFY `USAU_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identidicador unico', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `USER_TIPO`
--
ALTER TABLE `USER_TIPO`
  MODIFY `USTI_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador único', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `US_ID` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK - Identificador unico';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DETALLE_PEDIDO`
--
ALTER TABLE `DETALLE_PEDIDO`
  ADD CONSTRAINT `DETALLE_PEDIDO_ibfk_1` FOREIGN KEY (`DEPE_GO_ID`) REFERENCES `GOLOSINA` (`GO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DETALLE_PEDIDO_ibfk_2` FOREIGN KEY (`DEPE_PE_ID`) REFERENCES `PEDIDO` (`PE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `GOLOSINA`
--
ALTER TABLE `GOLOSINA`
  ADD CONSTRAINT `GOLOSINA_ibfk_1` FOREIGN KEY (`GO_GOCA_ID`) REFERENCES `GO_CATEGORIAS` (`GOCA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `GOLOSINA_ibfk_2` FOREIGN KEY (`GO_GOPR_ID`) REFERENCES `GO_PROVEEDOR` (`PR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `GOLOSINA_ibfk_3` FOREIGN KEY (`GO_GOPRE_ID`) REFERENCES `GO_PRESENTACIONES` (`GOPRE_ID`);

--
-- Filtros para la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  ADD CONSTRAINT `PEDIDO_ibfk_1` FOREIGN KEY (`PE_EM_ID`) REFERENCES `EMPLEADO` (`EM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PEDIDO_ibfk_2` FOREIGN KEY (`PE_US_ID`) REFERENCES `USUARIO` (`US_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `USER_AUTH`
--
ALTER TABLE `USER_AUTH`
  ADD CONSTRAINT `USER_AUTH_ibfk_1` FOREIGN KEY (`USAU_USTI_ID`) REFERENCES `USER_TIPO` (`USTI_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `USUARIO_ibfk_2` FOREIGN KEY (`USAU_ID`) REFERENCES `USER_AUTH` (`USAU_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
