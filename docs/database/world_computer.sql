-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2022 a las 15:46:12
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `world_computer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modulo` varchar(45) DEFAULT NULL,
  `accion` varchar(200) DEFAULT NULL,
  `descripcion` text,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `fecha`, `modulo`, `accion`, `descripcion`, `usuario_id`) VALUES
(378, '2022-01-08 01:36:19', 'Ventas', 'Registro de Venta<br>Código: 000000009', '', 4),
(379, '2022-01-23 19:20:23', 'Clientes', 'Registro de \"V-12334444 - Anyerlin Gabriela Morillo\"', '', 1),
(380, '2022-01-23 19:20:23', 'Clientes', 'Actualización de \"OHBiK3oyZFl0MENRQVdkTlNDUDBHdz09 - JOSNERY DIAZ\"', '<b>Información Anterior:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz09<br>Nombre: JOSNERY DIAZ<br>Dirección: R1p5dlBMclVla3NTc2wrM0VFZTJyZz09<br>Teléfono: ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09<br>E-mail: eGMvY2RzcGtuZTNKcW1kTnZ0NEJuUUpzMlVIcHNhU0pIYXVrL2drc2Q3UT0=<br><br><b>Información Actual:</b><br>Documento: V-1111111<br>Nombre: Anyerlin Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: correo@gmail.com<br>', 1),
(381, '2022-01-23 19:20:23', 'Clientes', 'Eliminación de \"V-1111111 - Anyerlin Morillo\"', '', 1),
(382, '2022-02-07 17:19:12', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 6500<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 6250<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(383, '2022-02-07 18:42:34', 'Clientes', 'Actualización de \"V-1111111 - Anyerlin Morillo\"', '<b>Información Anterior:</b><br>Documento: V-1111111<br>Nombre: Anyerlin Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: correo@gmail.com<br><br><b>Información Actual:</b><br>Documento: eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0<br>Nombre: Anyerlin Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: correo@gmail.com<br>', 1),
(384, '2022-02-07 18:44:51', 'Clientes', 'Actualización de \"eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0 - Anyerlin Morillo\"', '<b>Información Anterior:</b><br>Documento: eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0<br>Nombre: Anyerlin Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: correo@gmail.com<br><br><b>Información Actual:</b><br>Documento: eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0<br>Nombre: Anyerlin Morillo<br>Dirección: N1daSE1iMVhZTTltNGFnM1lLc21xQT09<br>Teléfono: ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09<br>E-mail: UngzaVQwRzFCUk16VUJmYzIxRzRlUT0<br>', 1),
(385, '2022-02-07 18:46:37', 'Clientes', 'Actualización de \"eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0 - Anyerlin Morillo\"', '<b>Información Anterior:</b><br>Documento: eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT0<br>Nombre: Anyerlin Morillo<br>Dirección: N1daSE1iMVhZTTltNGFnM1lLc21xQT09<br>Teléfono: ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09<br>E-mail: UngzaVQwRzFCUk16VUJmYzIxRzRlUT0<br><br><b>Información Actual:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz09<br>Nombre: Anyerlin Morillo<br>Dirección: N1daSE1iMVhZTTltNGFnM1lLc21xQT09<br>Teléfono: ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09<br>E-mail: UngzaVQwRzFCUk16VUJmYzIxRzRlUT0<br>', 1),
(386, '2022-02-07 18:47:26', 'Clientes', 'Actualización de \"V-12334444 - Anyerlin Gabriela Morillo\"', '<b>Información Anterior:</b><br>Documento: V-12334444<br>Nombre: Anyerlin Gabriela Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: elcorreo@gmail.com<br><br><b>Información Actual:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0<br>Nombre: Anyerlin Gabriela Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: elcorreo@gmail.com<br>', 1),
(387, '2022-02-07 18:47:27', 'Clientes', 'Actualización de \"OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0 - Anyerlin Gabriela Morillo\"', '<b>Información Anterior:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0<br>Nombre: Anyerlin Gabriela Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: elcorreo@gmail.com<br><br><b>Información Actual:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0<br>Nombre: Anyerlin Gabriela Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: elcorreo@gmail.com<br>', 1),
(388, '2022-02-07 18:47:59', 'Clientes', 'Actualización de \"OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0 - Anyerlin Gabriela Morillo\"', '<b>Información Anterior:</b><br>Documento: OHBiK3oyZFl0MENRQVdkTlNDUDBHdz0<br>Nombre: Anyerlin Gabriela Morillo<br>Dirección: Rotario<br>Teléfono: 0000-12344444<br>E-mail: elcorreo@gmail.com<br><br><b>Información Actual:</b><br>Documento: d2Z4VjIzZC8wSTRRN0hEa0ZHdk85Zz09<br>Nombre: ANYERLIN GABRIELA MORILLO<br>Dirección: aVliZXJwcXA4S2VMQ0laZjlzRlVBQT09<br>Teléfono: RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09<br>E-mail: c3Bnc3o2M3RxR3oyZVJQdzV2NzZkcVJDdm1PSnpCaHFqcHh0RFQ2VzBpaz0=<br>', 1),
(389, '2022-02-07 18:48:14', 'Clientes', 'Actualización de \"d2Z4VjIzZC8wSTRRN0hEa0ZHdk85Zz09 - ANYERLIN GABRIELA MORILLO\"', '<b>Información Anterior:</b><br>Documento: d2Z4VjIzZC8wSTRRN0hEa0ZHdk85Zz09<br>Nombre: ANYERLIN GABRIELA MORILLO<br>Dirección: aVliZXJwcXA4S2VMQ0laZjlzRlVBQT09<br>Teléfono: RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09<br>E-mail: c3Bnc3o2M3RxR3oyZVJQdzV2NzZkcVJDdm1PSnpCaHFqcHh0RFQ2VzBpaz0=<br><br><b>Información Actual:</b><br>Documento: d2Z4VjIzZC8wSTRRN0hEa0ZHdk85Zz09<br>Nombre: ANYERLIN GABRIELA MORILLO<br>Dirección: Y3Q0MDdQdHVXL3hRQjNpNnhOQzI0Zz09<br>Teléfono: RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09<br>E-mail: c3Bnc3o2M3RxR3oyZVJQdzV2NzZkcVJDdm1PSnpCaHFqcHh0RFQ2VzBpaz0=<br>', 1),
(390, '2022-03-01 01:14:34', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 6250<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 19<br>Precio de Venta: 5950<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(391, '2022-03-01 01:14:43', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 19<br>Precio de Venta: 5950<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 6000<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(392, '2022-03-01 01:15:17', 'Compras', 'Registro de Compra<br>Código: 000000007', '', 1),
(393, '2022-03-01 01:15:17', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 6000<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 30<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(394, '2022-03-01 01:16:07', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 30<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 31.25<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(395, '2022-03-01 01:54:49', 'Productos', 'Registro de \"P5965707 - ROUTER MERCUSYS\"', '', 1),
(396, '2022-03-01 02:04:49', 'Usuarios', 'Actualización de \"WnNTM2djbkdXZEhrdEFYUVlnTk9CUT09 - CRISTIAN NOGUERA\"', '<b>Información Anterior:</b><br>Documento: WnNTM2djbkdXZEhrdEFYUVlnTk9CUT09<br>Nombre: CRISTIAN NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09<br>E-mail: MFNoYm1RNGtUcFVuUGpBcDNzUVFtaWdsOXNRdXlOTi80Z3lTRy82SG81bz0=<br>Usuario: CRISTIAN<br>Rol: Administrador<br><br><b>Información Actual:</b><br>Documento: WnNTM2djbkdXZEhrdEFYUVlnTk9CUT09<br>Nombre: CRISTIAN NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09<br>E-mail: MFNoYm1RNGtUcFVuUGpBcDNzUVFtaWdsOXNRdXlOTi80Z3lTRy82SG81bz0=<br>Usuario: CRISTIAN<br>Rol: Administrador<br>', 1),
(397, '2022-03-02 18:42:22', 'Usuarios', 'Actualización de \"a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09 - HECTOR NOGUERA\"', '<b>Información Anterior:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>', 4),
(398, '2022-03-02 18:44:09', 'Usuarios', 'Actualización de \"a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09 - HECTOR NOGUERA\"', '<b>Información Anterior:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>', 4),
(399, '2022-03-02 18:45:57', 'Usuarios', 'Actualización de \"a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09 - HECTOR NOGUERA\"', '<b>Información Anterior:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>', 4),
(403, '2022-03-02 19:00:32', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 31.25<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 30<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 4),
(404, '2022-03-02 19:02:30', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 30<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 22<br>Precio de Venta: 30.5<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 4),
(405, '2022-03-02 19:03:47', 'Servicios', 'Actualización de \"MANTENIMIENTO CAMARAS\"', '<b>Información Anterior:</b><br>Nombre: MANTENIMIENTO CAMARAS<br>Descripción: MANTENIMIENTO GENERAL<br>Precio: 6200<br><br><b>Información Actual:</b><br>Nombre: MANTENIMIENTO CAMARAS<br>Descripción: MANTENIMIENTO GENERAL<br>Precio: 6<br>', 4),
(406, '2022-03-02 19:24:55', 'Compras', 'Registro de Compra<br>Código: 000000008', '', 4),
(407, '2022-03-02 19:24:56', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 22<br>Precio de Venta: 30.5<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 22<br>Precio de Venta: 36.6<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 4),
(408, '2022-03-05 18:29:07', 'Ventas', 'Registro de Venta<br>Código: 000000010', '', 1),
(409, '2022-03-05 18:37:18', 'Compras', 'Registro de Compra<br>Código: 000000009', '', 1),
(410, '2022-03-05 18:37:19', 'Productos', 'Actualización de \"P2683862 - CORNETAS\"', '<b>Información Anterior:</b><br>Código: P2683862<br>Nombre: CORNETAS<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 0<br>Stock Min.: 5<br>Stock Max.: 0<br>Categoría: REDES<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P2683862<br>Nombre: CORNETAS<br>Descripción: N/A<br>Margén de Ganancia: 20<br>Precio de Venta: 12.636<br>Stock Min.: 5<br>Stock Max.: 0<br>Categoría: REDES<br>Unidad: PIEZA<br>', 1),
(411, '2022-03-05 18:37:20', 'Productos', 'Actualización de \"P456154 - ANTENA KE444\"', '<b>Información Anterior:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 22<br>Precio de Venta: 36.6<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456154<br>Nombre: ANTENA KE444<br>Descripción: N/A<br>Margén de Ganancia: 22<br>Precio de Venta: 43.31<br>Stock Min.: 10<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(412, '2022-03-05 18:46:35', 'Servicios Prestados', 'Registro de Servicio Prestado<br>Código: 000000006', '', 1),
(413, '2022-03-05 18:49:41', 'Servicios Prestados', 'Habilitación de \"000000004\"', '', 1),
(414, '2022-03-05 19:11:43', 'Compras', 'Registro de Compra<br>Código: 000000010', '', 1),
(415, '2022-03-05 19:11:44', 'Productos', 'Actualización de \"P456125 - ROUTER 3400\"', '<b>Información Anterior:</b><br>Código: P456125<br>Nombre: ROUTER 3400<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 17.5<br>Stock Min.: 50<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456125<br>Nombre: ROUTER 3400<br>Descripción: N/A<br>Margén de Ganancia: 25<br>Precio de Venta: 23.75<br>Stock Min.: 50<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>', 1),
(416, '2022-03-05 19:13:37', 'Ventas', 'Registro de Venta<br>Código: 000000011', '', 1),
(417, '2022-03-05 19:13:38', 'Servicios Prestados', 'Registro de Servicio Prestado<br>Código: 000000007', '', 1),
(418, '2022-03-05 19:26:58', 'Ventas', 'Registro de Venta<br>Código: 000000012', '', 1),
(419, '2022-03-06 12:48:51', 'Usuarios', 'Actualización de \"a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09 - HECTOR NOGUERA\"', '<b>Información Anterior:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>', 1),
(420, '2022-03-06 12:49:05', 'Usuarios', 'Actualización de \"a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09 - HECTOR NOGUERA\"', '<b>Información Anterior:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09<br>Nombre: HECTOR NOGUERA<br>Dirección: eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09<br>Teléfono: Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09<br>E-mail: V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'REDES', 'REDES EN GENERAL', 'ACTIVO', '2021-11-14 16:32:55', '2021-11-14 16:32:55'),
(2, 'TELEFONIA', 'TELEFONOS EN GENERAL', 'ACTIVO', '2021-11-14 16:32:55', '2021-11-14 16:32:55'),
(3, 'PC', 'PC GENERAL', 'ACTIVO', '2021-11-14 16:32:55', '2021-11-14 16:32:55');

--
-- Disparadores `categorias`
--
DELIMITER $$
CREATE TRIGGER `categorias_ai` AFTER INSERT ON `categorias` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Categorías",CONCAT('Registro de "',NEW.nombre,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `categorias_bu` BEFORE UPDATE ON `categorias` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Categorías",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Categorías",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Categorías",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `documento` varchar(35) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `documento`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'OHBiK3oyZFl0MENRQVdkTlNDUDBHdz09', 'Anyerlin', 'Morillo', 'N1daSE1iMVhZTTltNGFnM1lLc21xQT09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'UngzaVQwRzFCUk16VUJmYzIxRzRlUT0', 'ELIMINADO', '2021-11-14 16:32:50', '2021-11-14 16:32:50'),
(2, 'eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT09', 'CARLOS', 'RAMIREZ', 'N1daSE1iMVhZTTltNGFnM1lLc21xQT09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'UEQwc3c1ZE1makU1SGpQQ1pSdncraHoyNFovNUpMY1dQUEpRU0RsVEhtdz0=', 'ACTIVO', '2021-11-14 16:32:50', '2021-11-14 16:32:50'),
(3, 'OXZRMWV6TTVMaDQzOGs0K2lsMEtsUT09', 'HECTOR', 'NOGUERA', 'N1daSE1iMVhZTTltNGFnM1lLc21xQT09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'd2lGeUw3UkUxeVBwN28vUUZ6bkNuZi9CeDV3M2owSUtPMlJ4K0RIaml6cz0=', 'ACTIVO', '2021-11-14 16:32:50', '2021-11-14 16:32:50'),
(4, 'cFB3SzJwZFRRMSsrUnpHdGpwYURDQT09', 'JESUS', 'ARRIECHE', 'R0ZwV2EvMUtGQ0tzSmwrbmFYaWxBdz09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'UngzaVQwRzFCUk16VUJmYzIxRzRlUT09', 'ACTIVO', '2021-11-14 16:32:50', '2021-11-14 16:32:50'),
(5, 'bnNqYS9OSGF1Nkl4cG1QV2hzSUszZz09', 'ANYERLIN', 'MORILLO', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'SDJySEhwdUxScTQrWjA1ZE40OGFnbWdGNzVGWnhLcFRiNytiNjYvUllwTT0=', 'ACTIVO', '2021-11-14 18:46:18', '2021-11-14 18:46:18'),
(6, 'd2Z4VjIzZC8wSTRRN0hEa0ZHdk85Zz09', 'ANYERLIN GABRIELA', 'MORILLO', 'Y3Q0MDdQdHVXL3hRQjNpNnhOQzI0Zz09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'c3Bnc3o2M3RxR3oyZVJQdzV2NzZkcVJDdm1PSnpCaHFqcHh0RFQ2VzBpaz0=', 'ACTIVO', '2022-01-23 19:20:23', '2022-01-23 19:20:23');

--
-- Disparadores `clientes`
--
DELIMITER $$
CREATE TRIGGER `clientes_ai` AFTER INSERT ON `clientes` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Clientes",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `clientes_bu` BEFORE UPDATE ON `clientes` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Clientes",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Clientes",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Clientes",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `cod_ref` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impuesto` varchar(45) DEFAULT '0',
  `dolar` varchar(45) DEFAULT '1',
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `proveedor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `codigo`, `cod_ref`, `fecha`, `impuesto`, `dolar`, `estatus`, `proveedor_id`, `created_at`, `updated_at`, `usuario_id`) VALUES
(1, '000001', '', '2021-11-14 12:03:05', '12,00', '1', 'ACTIVO', 1, '2021-11-14 16:33:05', '2021-11-14 16:33:05', 1),
(2, '000002', '', '2021-11-14 12:03:05', '0', '1', 'ACTIVO', 2, '2021-11-14 16:33:05', '2021-11-14 16:33:05', 1),
(3, '000003', '', '2021-11-14 12:03:05', '10,00', '1', 'ACTIVO', 3, '2021-11-14 16:33:05', '2021-11-14 16:33:05', 1),
(4, '000000004', '342353425', '2022-01-05 19:10:37', '0', '4.51', 'ACTIVO', 1, '2022-01-05 23:40:37', '2022-01-05 23:40:37', 1),
(5, '000000005', '', '2022-01-06 12:00:25', '0', '4.97', 'ACTIVO', 1, '2022-01-06 16:30:25', '2022-01-06 16:30:25', 1),
(6, '000000006', '3620', '2022-01-06 12:02:41', '0', '4.97', 'ACTIVO', 3, '2022-01-06 16:32:41', '2022-01-06 16:32:41', 1),
(7, '000000007', '0001212233', '2022-02-28 20:45:17', '0', '4.97', 'ACTIVO', 4, '2022-03-01 01:15:17', '2022-03-01 01:15:17', 1),
(8, '000000008', '34543543', '2022-03-02 14:54:55', '0', '4.6', 'ACTIVO', 3, '2022-03-02 19:24:55', '2022-03-02 19:24:55', 4),
(9, '000000009', '1323434', '2022-03-05 14:07:18', '0', '4.97', 'ACTIVO', 1, '2022-03-05 18:37:18', '2022-03-05 18:37:18', 1),
(10, '000000010', '323423423', '2022-03-05 14:41:43', '0', '4.51', 'ACTIVO', 1, '2022-03-05 19:11:43', '2022-03-05 19:11:43', 1);

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `compras_ai` AFTER INSERT ON `compras` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Compras",CONCAT('Registro de Compra<br>Código: ',NEW.codigo))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `compras_bu` BEFORE UPDATE ON `compras` FOR EACH ROW BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Compras",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Compras",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`, `created_at`, `updated_at`) VALUES
(1, 'nombre_sistema', 'WORLD & COMPUTER', '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(2, 'dolar', '4.51', '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(3, 'iva', '12', '2021-11-14 16:32:56', '2021-11-14 16:32:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `costo` double NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `costo`, `cantidad`, `producto_id`, `compra_id`, `created_at`, `updated_at`) VALUES
(1, 2000, '5', 1, 1, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(2, 1000, '3', 2, 1, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(3, 5000, '12', 3, 1, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(4, 2000, '5', 1, 2, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(5, 1000, '3', 2, 2, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(6, 5000, '12', 3, 2, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(7, 2000, '5', 1, 3, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(8, 1000, '3', 2, 3, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(9, 5000, '12', 3, 3, '2021-11-14 16:33:06', '2021-11-14 16:33:06'),
(10, 23, '3', 1, 4, '2022-01-05 23:40:38', '2022-01-05 23:40:38'),
(11, 14, '2', 1, 5, '2022-01-06 16:30:25', '2022-01-06 16:30:25'),
(12, 9, '1', 2, 6, '2022-01-06 16:32:41', '2022-01-06 16:32:41'),
(13, 25, '1', 3, 7, '2022-03-01 01:15:17', '2022-03-01 01:15:17'),
(14, 30, '1', 3, 8, '2022-03-02 19:24:56', '2022-03-02 19:24:56'),
(15, 10.53, '2', 6, 9, '2022-03-05 18:37:19', '2022-03-05 18:37:19'),
(16, 35.5, '1', 3, 9, '2022-03-05 18:37:20', '2022-03-05 18:37:20'),
(17, 19, '1', 1, 10, '2022-03-05 19:11:44', '2022-03-05 19:11:44');

--
-- Disparadores `detalle_compra`
--
DELIMITER $$
CREATE TRIGGER `actualizar_precio_producto` AFTER INSERT ON `detalle_compra` FOR EACH ROW UPDATE productos SET precio_costo = NEW.costo, precio_venta = (NEW.costo * (precio_porcentaje / 100)+ NEW.costo) WHERE id = NEW.producto_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE `detalle_entrada` (
  `id` int(11) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `entrada_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id`, `cantidad`, `costo`, `producto_id`, `entrada_id`, `created_at`, `updated_at`) VALUES
(1, 20, 0, 1, 1, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(2, 20, 0, 1, 1, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(3, 20, 0, 1, 1, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(4, 20, 0, 2, 2, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(5, 20, 0, 2, 2, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(6, 20, 0, 2, 2, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(7, 20, 0, 3, 3, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(8, 20, 0, 3, 3, '2021-11-14 16:33:16', '2021-11-14 16:33:16'),
(9, 20, 0, 3, 3, '2021-11-14 16:33:16', '2021-11-14 16:33:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida`
--

CREATE TABLE `detalle_salida` (
  `id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `salida_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`id`, `cantidad`, `precio`, `producto_id`, `salida_id`, `created_at`, `updated_at`) VALUES
(1, 5, 0, 1, 1, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(2, 5, 0, 1, 1, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(3, 5, 0, 1, 1, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(4, 5, 0, 2, 2, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(5, 5, 0, 2, 2, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(6, 5, 0, 2, 2, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(7, 5, 0, 3, 3, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(8, 5, 0, 3, 3, '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(9, 5, 0, 3, 3, '2021-11-14 16:33:17', '2021-11-14 16:33:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE `detalle_servicio` (
  `id` int(11) NOT NULL,
  `servicio_prestado_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_servicio`
--

INSERT INTO `detalle_servicio` (`id`, `servicio_prestado_id`, `servicio_id`, `precio`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '3500', '2022-01-06 14:18:56', '2022-01-06 14:18:56'),
(2, 5, 2, '2000', '2022-01-06 14:23:13', '2022-01-06 14:23:13'),
(3, 6, 2, '2000', '2022-03-05 18:46:36', '2022-03-05 18:46:36'),
(4, 7, 1, '6', '2022-03-05 19:13:38', '2022-03-05 19:13:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `cantidad`, `precio`, `producto_id`, `venta_id`, `created_at`, `updated_at`) VALUES
(1, '12', '2500', 1, 1, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(2, '6', '500', 2, 1, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(3, '10', '200', 3, 1, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(4, '12', '2500', 1, 2, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(5, '6', '500', 2, 2, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(6, '10', '200', 3, 2, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(7, '12', '2500', 1, 3, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(8, '6', '500', 2, 3, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(9, '10', '200', 3, 3, '2021-11-14 16:33:09', '2021-11-14 16:33:09'),
(10, '1', '29.9', 1, 4, '2022-01-05 23:41:12', '2022-01-05 23:41:12'),
(11, '1', '29.9', 1, 5, '2022-01-06 14:10:41', '2022-01-06 14:10:41'),
(12, '1', '29.9', 1, 6, '2022-01-06 14:23:12', '2022-01-06 14:23:12'),
(13, '1', '17.5', 1, 7, '2022-01-07 19:20:12', '2022-01-07 19:20:12'),
(14, '1', '17.5', 1, 8, '2022-01-07 19:24:24', '2022-01-07 19:24:24'),
(15, '1', '11.7', 2, 8, '2022-01-07 19:24:25', '2022-01-07 19:24:25'),
(16, '1', '6500', 3, 9, '2022-01-08 01:36:19', '2022-01-08 01:36:19'),
(17, '1', '17.5', 1, 10, '2022-03-05 18:29:08', '2022-03-05 18:29:08'),
(18, '1', '11.7', 2, 10, '2022-03-05 18:29:09', '2022-03-05 18:29:09'),
(19, '1', '23.75', 1, 11, '2022-03-05 19:13:38', '2022-03-05 19:13:38'),
(20, '1', '12.636', 6, 12, '2022-03-05 19:26:58', '2022-03-05 19:26:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `documento` varchar(35) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `cargo` varchar(25) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `documento`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `cargo`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'OHBiK3oyZFl0MENRQVdkTlNDUDBHdz09', 'JUAN', 'DIAZ', 'R1p5dlBMclVla3NTc2wrM0VFZTJyZz09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'eGMvY2RzcGtuZTNKcW1kTnZ0NEJuUUpzMlVIcHNhU0pIYXVrL2drc2Q3UT0=', 'VENDEDOR', 'ACTIVO', '2021-11-14 16:32:51', '2021-11-14 16:32:51'),
(2, 'eXEwWkZwZWpnSnZoZkE5Y0JWS2xWQT09', 'PEDRO', 'BETANCOURT', 'VERVSHZwa3lQYUUydE5nZ1NVeFBFQT09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'WFpZQ2VEeVpnZ3BqTlNXOFV3c1ptQT09', 'TECNICO', 'ACTIVO', '2021-11-14 16:32:51', '2021-11-14 16:32:51'),
(3, 'cFB3SzJwZFRRMSsrUnpHdGpwYURDQT09', 'CARLOS', 'ARRIECHE', 'R0ZwV2EvMUtGQ0tzSmwrbmFYaWxBdz09', 'ekMzb0RYbzM5bHhMcS9zYys0eDF4Zz09', 'UngzaVQwRzFCUk16VUJmYzIxRzRlUT09', 'TECNICO', 'ACTIVO', '2021-11-14 16:32:51', '2021-11-14 16:32:51'),
(4, 'cHlraVMvcmErc1Bjci93a1p2Szl3QT09', 'CRISTIAN', 'NOGUERA', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'SDJySEhwdUxScTQrWjA1ZE40OGFnbWdGNzVGWnhLcFRiNytiNjYvUllwTT0=', 'TECNICO', 'ACTIVO', '2021-11-14 19:26:04', '2021-11-14 19:26:04');

--
-- Disparadores `empleados`
--
DELIMITER $$
CREATE TRIGGER `empleados_ai` AFTER INSERT ON `empleados` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Empleados",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `empleados_bu` BEFORE UPDATE ON `empleados` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Empleados",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Empleados",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Empleados",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            'Cargo: ',OLD.cargo,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>',
            'Cargo: ',NEW.cargo,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `observacion` varchar(45) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `codigo`, `fecha`, `tipo`, `observacion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, '000001', '2021-11-14 12:03:15', 'APORTE', 'aporte de un socio', 'ACTIVO', '2021-11-14 16:33:15', '2021-11-14 16:33:15'),
(2, '000002', '2021-11-14 12:03:15', 'PRESTAMO', 'prestamo de mercancia', 'ACTIVO', '2021-11-14 16:33:15', '2021-11-14 16:33:15'),
(3, '000003', '2021-11-14 12:03:15', 'APORTE', 'aporte de un socio', 'ACTIVO', '2021-11-14 16:33:15', '2021-11-14 16:33:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `valor` decimal(4,2) NOT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id`, `nombre`, `valor`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'iva', '12.00', 'ACTIVO', '2021-11-14 16:32:49', '2021-11-14 16:32:49'),
(2, 'iva2', '16.00', 'ACTIVO', '2021-11-14 16:32:49', '2021-11-14 16:32:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT 'SISTEMA',
  `repeticion` int(2) DEFAULT '1',
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `usuario_id`, `producto_id`, `titulo`, `mensaje`, `autor`, `repeticion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Stock', 'Producto P456125 - ROUTER 3400 tiene bajo stock.', 'SISTEMA', 1, 'INACTIVO', '2022-01-05 23:41:12', '2022-01-05 23:41:12'),
(2, 1, 1, 'Stock', 'Producto P456125 - ROUTER 3400 tiene bajo stock.', 'SISTEMA', 1, 'INACTIVO', '2022-01-07 19:20:12', '2022-01-07 19:20:12'),
(3, 1, 1, 'Stock', 'Producto P456125 - ROUTER 3400 tiene bajo stock.', 'SISTEMA', 1, 'INACTIVO', '2022-01-07 19:24:25', '2022-01-07 19:24:25'),
(4, 1, 1, 'Stock', 'Producto P456125 - ROUTER 3400 tiene bajo stock.', 'SISTEMA', 1, 'ACTIVO', '2022-03-05 18:29:09', '2022-03-05 18:29:09'),
(5, 1, 6, 'Stock', 'Producto P2683862 - CORNETAS tiene bajo stock.', 'SISTEMA', 1, 'ACTIVO', '2022-03-05 19:27:01', '2022-03-05 19:27:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'usuarios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(2, 'registrar usuarios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(3, 'editar usuarios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(4, 'eliminar usuarios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(5, 'clientes', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(6, 'registrar clientes', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(7, 'editar clientes', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(8, 'eliminar clientes', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(9, 'empleados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(10, 'registrar empleados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(11, 'editar empleados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(12, 'eliminar empleados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(13, 'proveedores', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(14, 'registrar proveedores', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(15, 'editar proveedores', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(16, 'eliminar proveedores', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(17, 'inventario', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(18, 'productos', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(19, 'registrar productos', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(20, 'editar productos', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(21, 'eliminar productos', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(22, 'categorias', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(23, 'registrar categorias', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(24, 'editar categorias', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(25, 'eliminar categorias', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(26, 'servicios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(27, 'registrar servicios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(28, 'editar servicios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(29, 'eliminar servicios', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(30, 'servicios prestados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(31, 'registrar servicios prestados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(32, 'anular servicios prestados', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(33, 'compras', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(34, 'registrar compras', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(35, 'anular compras', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(36, 'ventas', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(37, 'registrar ventas', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(38, 'anular ventas', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(39, 'roles', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(40, 'registrar roles', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(41, 'editar roles', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(42, 'eliminar roles', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00'),
(43, 'reportes', '', 'ACTIVO', '2021-11-14 16:33:00', '2021-11-14 16:33:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio_costo` double DEFAULT NULL,
  `precio_venta` double DEFAULT NULL,
  `precio_porcentaje` double DEFAULT NULL,
  `stock` int(11) DEFAULT '0',
  `stock_min` int(11) DEFAULT '0',
  `stock_max` int(11) DEFAULT '0',
  `descuento` double DEFAULT NULL,
  `impuesto` varchar(45) DEFAULT '0',
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `categoria_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio_costo`, `precio_venta`, `precio_porcentaje`, `stock`, `stock_min`, `stock_max`, `descuento`, `impuesto`, `estatus`, `categoria_id`, `unidad_id`, `created_at`, `updated_at`) VALUES
(1, 'P456125', 'ROUTER 3400', 'N/A', 19, 23.75, 25, 0, 50, 0, 0, '0', 'ACTIVO', 3, 1, '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(2, 'P456123', 'MODEM-ROUTER AJ300', 'N/A', 9, 11.7, 30, 0, 20, 0, 0, '0', 'ACTIVO', 3, 1, '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(3, 'P456154', 'ANTENA KE444', 'N/A', 35.5, 43.31, 22, 0, 10, 0, 0, '0', 'ACTIVO', 3, 1, '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(4, 'P456165', 'CAMARA AL300', '', 0, 0, 30, 0, 0, 0, 0, '0', 'ACTIVO', 2, 1, '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(5, 'P456180', 'ADAPTADOR 30K', 'N/A', 0, 0, 30, 0, 0, 0, 0, '0', 'ACTIVO', 2, 1, '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(6, 'P2683862', 'CORNETAS', 'N/A', 10.53, 12.636, 20, 0, 5, 0, 0, '0', 'ACTIVO', 1, 1, '2022-01-07 19:17:44', '2022-01-07 19:17:44'),
(7, 'P5965707', 'ROUTER MERCUSYS', '3 ANTENAS', 0, 0, 25, 0, 0, 50, 0, '0', 'ACTIVO', 1, 1, '2022-03-01 01:54:49', '2022-03-01 01:54:49');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `productos_ai` AFTER INSERT ON `productos` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Productos",CONCAT('Registro de "',NEW.codigo,' - ',NEW.nombre,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `productos_bu` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Productos",CONCAT('Habilitación de "',OLD.codigo,' - ',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Productos",CONCAT('Eliminación de "',OLD.codigo,' - ',OLD.nombre,'"'));
        END IF;
    ELSE 
        SET @categoria_name = (SELECT nombre FROM `categorias` WHERE id=OLD.categoria_id);
        SET @categoria_name_new = (SELECT nombre FROM `categorias` WHERE id=NEW.categoria_id);
        SET @unidad_name = (SELECT nombre FROM `unidades` WHERE id=OLD.unidad_id);
        SET @unidad_name_new = (SELECT nombre FROM `unidades` WHERE id=NEW.unidad_id);
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Productos",CONCAT('Actualización de "',OLD.codigo,' - ',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Código: ',OLD.codigo,'<br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            'Margén de Ganancia: ',OLD.precio_porcentaje,'<br>',
            'Precio de Venta: ',OLD.precio_venta,'<br>',
            'Stock Min.: ',OLD.stock_min,'<br>',
            'Stock Max.: ',OLD.stock_max,'<br>',
            'Categoría: ',@categoria_name,'<br>',
            'Unidad: ',@unidad_name,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Código: ',NEW.codigo,'<br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>',
            'Margén de Ganancia: ',NEW.precio_porcentaje,'<br>',
            'Precio de Venta: ',NEW.precio_venta,'<br>',
            'Stock Min.: ',NEW.stock_min,'<br>',
            'Stock Max.: ',NEW.stock_max,'<br>',
            'Categoría: ',@categoria_name_new,'<br>',
            'Unidad: ',@unidad_name_new,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `documento` varchar(35) NOT NULL,
  `razon_social` varchar(45) NOT NULL,
  `direccion` text,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `documento`, `razon_social`, `direccion`, `telefono`, `email`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'MWtuL3J4TytiVHhkY0gzbTNGYW9tZz09', 'MICROTECH', 'N1daSE1iMVhZTTltNGFnM1lLc21xQT09', 'N2RuY2dibVdzaTA3RENzYnBneXhVZz09', 'WVZSaDd3UVE5U0NOalZWTXV2MVJ3RDkxMHk0bE1QRUFUVGlGbys5clJCcz0=', 'ACTIVO', '2021-11-14 16:32:54', '2021-11-14 16:32:54'),
(2, 'Q01XcFNZVFNjdUFnU2FKSDYrVHZ4QT09', 'CARSYS', 'TzRNemtKc1ljRzRMWFNkTHJLSFV2dz09', 'N2RuY2dibVdzaTA3RENzYnBneXhVZz09', 'ZTJ2N3p6dmhzUG0vUTVlOTB1aWlvaW12YjFzQW1icjgyQWEzTnR0YXpoQT0=', 'ACTIVO', '2021-11-14 16:32:54', '2021-11-14 16:32:54'),
(3, 'cEZKbnI5NFJ3WFBmSkdRMjNxbUUwUT09', 'SUPER TECH', 'c0xhUWZ3c25WU01JRXNkNkNrRGR3Zz09', 'N2RuY2dibVdzaTA3RENzYnBneXhVZz09', 'V1hreW5YME5SYzVLZkRrUFZ6WTVOaDFHSTdVS0ZiUnMxMmF4TE04eTdJOD0=', 'ACTIVO', '2021-11-14 16:32:54', '2021-11-14 16:32:54'),
(4, 'ZlY1azlTNDlEbWNqbTBhM0ZmcUtzUT09', 'MERCABAR', 'cE03Z3Zzd0tqa0tGL3MxU1VNUC9RZ05YNGJya0ZubVY4ZDk5TnZFbDV6MD0=', 'N2RuY2dibVdzaTA3RENzYnBneXhVZz09', 'SDJySEhwdUxScTQrWjA1ZE40OGFnbWdGNzVGWnhLcFRiNytiNjYvUllwTT0=', 'ACTIVO', '2021-11-14 19:42:55', '2021-11-14 19:42:55'),
(6, 'VzB3WGJUMG5pc2JmbDlrQkpGeEExZz09', 'TODO PC', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'WmN6d1g1b3dsc1VGQmtOWGYvYTJYWU5vTFprRHJsb0F0OUN5aldLYU5Ucz0=', 'ACTIVO', '2022-01-07 17:06:30', '2022-01-07 17:06:30');

--
-- Disparadores `proveedores`
--
DELIMITER $$
CREATE TRIGGER `proveedores_ai` AFTER INSERT ON `proveedores` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Proveedores",CONCAT('Registro de "',NEW.documento,' - ',NEW.razon_social,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `proveedores_bu` BEFORE UPDATE ON `proveedores` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Proveedores",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.razon_social,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Proveedores",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.razon_social,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Proveedores",CONCAT('Actualización de "',OLD.documento,' - ',OLD.razon_social,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Razón Social: ',OLD.razon_social,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Razón Social: ',NEW.razon_social,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrador', 'Todos los permisos del sistema', 'ACTIVO', '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(2, 'Administrador', 'Permisos para la mayoría de los módulos', 'ACTIVO', '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(3, 'Asistente', 'Manejo de Inventario, Cliente y Ventas', 'ACTIVO', '2021-11-14 16:32:56', '2021-11-14 16:32:56'),
(8, 'Vendedor', 'Consulta productos y maneja ventas', 'ACTIVO', '2022-01-07 19:10:35', '2022-01-07 19:10:35');

--
-- Disparadores `roles`
--
DELIMITER $$
CREATE TRIGGER `roles_ai` AFTER INSERT ON `roles` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Roles",CONCAT('Registro de "',NEW.nombre,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `roles_bu` BEFORE UPDATE ON `roles` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Roles",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Roles",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Roles",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`rol_id`, `permiso_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 2, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 3, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 4, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 5, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 6, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 7, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 8, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 9, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 10, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 11, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 12, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 13, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 14, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 15, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 16, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 17, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 18, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 19, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 20, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 21, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 22, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 23, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 24, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 25, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 26, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 27, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 28, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 29, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 30, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 31, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 32, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 33, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 34, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 35, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 36, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 37, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 38, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 39, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 40, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 41, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 42, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(1, 43, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 5, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 6, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 7, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 8, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 9, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 10, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 11, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 12, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 13, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 14, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 15, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 16, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 18, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 19, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 20, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 21, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 22, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 23, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 24, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 25, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 26, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 27, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 28, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 29, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 30, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 31, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 32, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 33, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 34, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 35, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 36, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 37, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 38, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(2, 43, '2021-11-14 16:33:03', '2021-11-14 16:33:03'),
(3, 5, '2022-01-07 17:25:44', '2022-01-07 17:25:44'),
(3, 6, '2022-01-07 17:25:45', '2022-01-07 17:25:45'),
(3, 7, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 8, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 13, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 18, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 30, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 33, '2022-01-07 17:25:46', '2022-01-07 17:25:46'),
(3, 36, '2022-01-07 17:25:47', '2022-01-07 17:25:47'),
(8, 18, '2022-01-07 19:11:49', '2022-01-07 19:11:49'),
(8, 36, '2022-01-07 19:11:50', '2022-01-07 19:11:50'),
(8, 37, '2022-01-07 19:11:50', '2022-01-07 19:11:50'),
(8, 38, '2022-01-07 19:11:50', '2022-01-07 19:11:50'),
(8, 43, '2022-01-07 19:11:50', '2022-01-07 19:11:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `observacion` varchar(45) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `codigo`, `fecha`, `tipo`, `observacion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, '000001', '2021-11-14 12:03:17', 'RETIRO', 'retiro de un socio', 'ACTIVO', '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(2, '000002', '2021-11-14 12:03:17', 'PRESTAMO', 'prestamo de mercancia', 'ACTIVO', '2021-11-14 16:33:17', '2021-11-14 16:33:17'),
(3, '000003', '2021-11-14 12:03:17', 'RETIRO', 'retiro de un socio', 'ACTIVO', '2021-11-14 16:33:17', '2021-11-14 16:33:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'MANTENIMIENTO CAMARAS', 'MANTENIMIENTO GENERAL', '6', 'ACTIVO', '2021-11-14 16:33:13', '2021-11-14 16:33:13'),
(2, 'REPARACION UPS', 'Reparacion ', '2000', 'ACTIVO', '2021-11-14 16:33:13', '2021-11-14 16:33:13'),
(3, 'FORMATEO PC', 'Instalacion SO', '3500', 'ACTIVO', '2021-11-14 16:33:13', '2021-11-14 16:33:13');

--
-- Disparadores `servicios`
--
DELIMITER $$
CREATE TRIGGER `servicios_ai` AFTER INSERT ON `servicios` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Servicios",CONCAT('Registro de "',NEW.nombre,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `servicios_bu` BEFORE UPDATE ON `servicios` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Servicios",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Servicios",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Servicios",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            'Precio: ',OLD.precio,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            'Precio: ',NEW.precio,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_prestados`
--

CREATE TABLE `servicios_prestados` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empleado_id` int(11) NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) NOT NULL,
  `dolar` varchar(45) DEFAULT '1',
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios_prestados`
--

INSERT INTO `servicios_prestados` (`id`, `codigo`, `fecha`, `empleado_id`, `venta_id`, `cliente_id`, `dolar`, `estatus`, `created_at`, `updated_at`, `usuario_id`) VALUES
(1, '000001', '2021-11-14 12:03:14', 2, 1, 2, '1', 'ACTIVO', '2021-11-14 16:33:14', '2021-11-14 16:33:14', 1),
(2, '000002', '2021-11-14 12:03:14', 3, 2, 2, '1', 'ACTIVO', '2021-11-14 16:33:14', '2021-11-14 16:33:14', 1),
(3, '000003', '2021-11-14 12:03:14', 3, 3, 2, '1', 'ACTIVO', '2021-11-14 16:33:14', '2021-11-14 16:33:14', 1),
(4, '000000004', '2022-01-06 09:48:56', 4, 0, 5, '4.51', 'ACTIVO', '2022-01-06 14:18:56', '2022-01-06 14:18:56', 1),
(5, '000000005', '2022-01-06 09:53:13', 2, 6, 2, '4.51', 'ACTIVO', '2022-01-06 14:23:13', '2022-01-06 14:23:13', 1),
(6, '000000006', '2022-03-05 14:16:35', 4, 0, 3, '4.97', 'ACTIVO', '2022-03-05 18:46:35', '2022-03-05 18:46:35', 1),
(7, '000000007', '2022-03-05 14:43:38', 2, 11, 4, '4.51', 'ACTIVO', '2022-03-05 19:13:38', '2022-03-05 19:13:38', 1);

--
-- Disparadores `servicios_prestados`
--
DELIMITER $$
CREATE TRIGGER `servicios_prestados_ai` AFTER INSERT ON `servicios_prestados` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Servicios Prestados",CONCAT('Registro de Servicio Prestado<br>Código: ',NEW.codigo))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `servicios_prestados_bu` BEFORE UPDATE ON `servicios_prestados` FOR EACH ROW BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Servicios Prestados",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion)
        VALUES (@usuario_id,"Servicios Prestados",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `estatus` varchar(15) DEFAULT 'activo',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `abreviatura`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'PIEZA', 'pza', 'activo', '2021-11-14 16:32:54', '2021-11-14 16:32:54'),
(2, 'METRO', 'm', 'activo', '2021-11-14 16:32:54', '2021-11-14 16:32:54'),
(3, 'LITRO', 'l', 'activo', '2021-11-14 16:32:54', '2021-11-14 16:32:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `documento` varchar(35) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(60) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `seguridad_img` varchar(40) NOT NULL,
  `seguridad_pregunta` varchar(40) NOT NULL,
  `seguridad_respuesta` varchar(150) NOT NULL,
  `estatus` varchar(45) DEFAULT 'ACTIVO',
  `rol_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `documento`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `usuario`, `password`, `seguridad_img`, `seguridad_pregunta`, `seguridad_respuesta`, `estatus`, `rol_id`, `created_at`, `updated_at`) VALUES
(1, 'Z0FIbXlLMkMzY2d2TnRVM3E2bkNmQT09', 'SUPER', 'ADMINISTRADOR', 'eno1ekU5S295Yy8yTzFQQVA4V1NGUT09', 'RkovUTN2WnBhZ0ZkSWU0eXY1dVUvZz09', 'OUdoVzhNU09ZeVB1Sk5qVDUvdk5OOEUra3FyNUhiaEhMbXFyaVREcWtLND0=', 'SUPERADMINISTRADOR', '$2y$08$qCqwVwNVcF3bqFtZAke3j.qj8jNwJ7tyXNder5bILpnyRCeJt3Qna', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 1, '2021-11-14 16:33:05', '2021-11-14 16:33:05'),
(2, 'ZHQ5VnAzcUpqM2o0N1RFNzFwcDZVUT09', 'ADMINISTRADOR', 'ADMINISTRADOR', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'SXZVNjJub1BxOXBpdnNNdGtsdkNCUT09', 'ADMINISTRADOR', '$2y$14$k9kECw4XTGCgh5UPse50bO.GBGkyV1zeWxW4zTiNXT/jwhljIKP4K', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 2, '2021-11-14 16:33:05', '2021-11-14 16:33:05'),
(3, 'c2VBZDR3VjBpOFFQVnZxSXVyZWhxUT09', 'USUARIO', 'USUARIO', 'eno1ekU5S295Yy8yTzFQQVA4V1NGUT09', 'a2JSMjE2WFdnTXdLVEhDWU5MSlVVdz09', 'SDJySEhwdUxScTQrWjA1ZE40OGFnbWdGNzVGWnhLcFRiNytiNjYvUllwTT0=', 'USUARIO', '$2y$14$85yGnTS/W5awO7quwGzbSu/b788ECGy1KPGyWiTnW8D4iBCM9Nxo.', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 3, '2021-11-14 16:33:05', '2021-11-14 16:33:05'),
(4, 'a1RJR01SK0FNcUg0ZVpoeTZsUUs1dz09', 'HECTOR', 'NOGUERA', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'Nno4ZGlCV1FFb0RQSUhSSkdncDJMdz09', 'V2N4RjNMWThlSHVvazBKeGtFUUlxN2pPMzgyekZNVC9wcmxwV3Yvc2J0Zz0=', 'HECTOR10', '$2y$08$mvnmxFXmBAU2Ms/Mq7SaQulZmrL7gUjACYCgO5Bt4C.wCdbL6xJLS', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 1, '2021-11-14 18:20:25', '2021-11-14 18:20:25'),
(5, 'bStpNjNnTnhULzRxcGRpc1lkNkx4dz09', 'POCHO', 'MORILLO', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'a29YWW5HQmhSU2VpVy9nTlp1REtlZz09', 'POCHO1711', '$2y$14$Xcx4aqkH1VhH0sAciOSH6.FLnPKfWRvhu4PRRZMuEs9/EI9SeMwna', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Apodo', 'YjhOaEZNeExkWHJ6WkZGV2NPRWc4QT09', 'ACTIVO', 2, '2021-11-14 18:31:01', '2021-11-14 18:31:01'),
(8, 'aTNVUEQ3QmVIMEI0UjZLMUVleHVZUT09', 'ANYERLIN', 'MORILLO', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'c3Bnc3o2M3RxR3oyZVJQdzV2NzZkcVJDdm1PSnpCaHFqcHh0RFQ2VzBpaz0=', 'ANYERLIN', '$2y$08$bE9E5qfNtjDPobYTDEbXNu0ey8cfxpE3qC8yPLeBP46wHJkBsqLrq', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 1, '2021-12-30 20:23:55', '2021-12-30 20:23:55'),
(9, 'WUcwSzY0cUFmdlEvV3F1NGk3UUU0Zz09', 'MIGUEL ANDRES', 'PEREZ', 'TkVKR3FYU2pNN0F6ODhva1UxakJNWWRtY2x4aFhFc0hUVERSWHFhNmQ2UT0=', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'SC9kZ0ZMejBZZ1QzeElZTTFXVGJrbDkxNlF6TS9LVlFOYVl2WjJyVmgyND0=', 'MIGUEL000', '$2y$08$fY8bLx4xc0JLYcagtPqXXeGz/f987XZ.xUDqyTUVsVYj5JBs.bLAy', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 2, '2022-01-04 00:52:26', '2022-01-04 00:52:26'),
(12, 'WnNTM2djbkdXZEhrdEFYUVlnTk9CUT09', 'CRISTIAN', 'NOGUERA', 'eXV6RDhYZ2pWcEd6V0ZDWjRyYUxrQWtUTFcvQ0t5VytRRkllTkh4RHZCdWVhV3pjcHZuZ1VQVjJTL0RWZDN0ZXhzeHFRYjBiWkV2OWN6d0xrbDM4TUVqUUord21ZcnpkWi9NMjI2SGV1ck09', 'RnF0UG05Ym9ZT3ZrS2ljaG01MFF2Zz09', 'MFNoYm1RNGtUcFVuUGpBcDNzUVFtaWdsOXNRdXlOTi80Z3lTRy82SG81bz0=', 'CRISTIAN', '$2y$08$8uDZTMbugnC3/ebGXVjog.Pado.hE0mwo7aG23yDBhHJ96dxiE6oi', 'c1NsOXVXMytOcjFFcWFHbXJuQTdGdz08S', 'Ciudad Favorita', 'aFlmTHhQVUpvZk1jdFhySUsyVUNoQT09', 'ACTIVO', 2, '2022-01-07 15:52:08', '2022-01-07 15:52:08');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_ai` AFTER INSERT ON `usuarios` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Usuarios",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_bu` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Usuarios",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Usuarios",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        SET @rol_name = (SELECT nombre FROM `roles` WHERE id=OLD.rol_id);
        SET @rol_name_new = (SELECT nombre FROM `roles` WHERE id=NEW.rol_id);
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Usuarios",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            'Usuario: ',OLD.usuario,'<br>',
            'Rol: ',@rol_name,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>',
            'Usuario: ',NEW.usuario,'<br>',
            'Rol: ',@rol_name_new,'<br>'
            ));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impuesto` varchar(45) DEFAULT '0',
  `dolar` varchar(45) DEFAULT '1',
  `estatus` varchar(15) DEFAULT 'ACTIVO',
  `cliente_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `fecha`, `impuesto`, `dolar`, `estatus`, `cliente_id`, `created_at`, `updated_at`, `usuario_id`) VALUES
(1, '000001', '2021-11-14 12:03:07', '0', '1', 'ACTIVO', 1, '2021-11-14 16:33:07', '2021-11-14 16:33:07', 1),
(2, '000002', '2021-11-14 12:03:07', '0', '1', 'ACTIVO', 2, '2021-11-14 16:33:07', '2021-11-14 16:33:07', 1),
(3, '000003', '2021-11-14 12:03:07', '0', '1', 'ACTIVO', 3, '2021-11-14 16:33:07', '2021-11-14 16:33:07', 1),
(4, '000000004', '2022-01-05 19:11:12', '12', '4.51', 'ACTIVO', 1, '2022-01-05 23:41:12', '2022-01-05 23:41:12', 1),
(5, '000000005', '2022-01-06 09:40:41', '12', '4.51', 'ACTIVO', 1, '2022-01-06 14:10:41', '2022-01-06 14:10:41', 1),
(6, '000000006', '2022-01-06 09:53:12', '12', '4.51', 'ACTIVO', 2, '2022-01-06 14:23:12', '2022-01-06 14:23:12', 1),
(7, '000000007', '2022-01-07 14:50:11', '12', '4.97', 'ACTIVO', 4, '2022-01-07 19:20:11', '2022-01-07 19:20:11', 1),
(8, '000000008', '2022-01-07 14:54:24', '12', '4.97', 'ACTIVO', 4, '2022-01-07 19:24:24', '2022-01-07 19:24:24', 1),
(9, '000000009', '2022-01-07 21:06:19', '12', '4.97', 'ACTIVO', 1, '2022-01-08 01:36:19', '2022-01-08 01:36:19', 4),
(10, '000000010', '2022-03-05 13:59:07', '12', '4.97', 'ACTIVO', 3, '2022-03-05 18:29:07', '2022-03-05 18:29:07', 1),
(11, '000000011', '2022-03-05 14:43:37', '12', '4.51', 'ACTIVO', 4, '2022-03-05 19:13:37', '2022-03-05 19:13:37', 1),
(12, '000000012', '2022-03-05 14:56:58', '12', '4.51', 'ACTIVO', 2, '2022-03-05 19:26:58', '2022-03-05 19:26:58', 1);

--
-- Disparadores `ventas`
--
DELIMITER $$
CREATE TRIGGER `ventas_ai` AFTER INSERT ON `ventas` FOR EACH ROW INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Ventas",CONCAT('Registro de Venta<br>Código: ',NEW.codigo))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ventas_bu` BEFORE UPDATE ON `ventas` FOR EACH ROW BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Ventas",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Ventas",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_entradas_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_entradas_compras` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_entradas_recargo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_entradas_recargo` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_entradas_totales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_entradas_totales` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`compras` double
,`cargos` double
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_inventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_inventario` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`categoria` varchar(50)
,`precio_venta` double
,`stock` double
,`stock_min` int(11)
,`stock_max` int(11)
,`estatus` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_salidas_descargo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_salidas_descargo` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_salidas_totales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_salidas_totales` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`ventas` double
,`descargos` double
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_salidas_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_salidas_ventas` (
`id` int(11)
,`codigo` varchar(45)
,`nombre` varchar(50)
,`total` double
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_entradas_compras`
--
DROP TABLE IF EXISTS `v_entradas_compras`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_entradas_compras`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,sum(`dc`.`cantidad`) AS `total` from ((`productos` `p` left join `detalle_compra` `dc` on((`p`.`id` = `dc`.`producto_id`))) left join `compras` `c` on((`dc`.`compra_id` = `c`.`id`))) where (`c`.`estatus` = 'ACTIVO') group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_entradas_recargo`
--
DROP TABLE IF EXISTS `v_entradas_recargo`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_entradas_recargo`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,sum(`de`.`cantidad`) AS `total` from ((`productos` `p` left join `detalle_entrada` `de` on((`p`.`id` = `de`.`producto_id`))) left join `entradas` `e` on((`de`.`entrada_id` = `e`.`id`))) where (`e`.`estatus` = 'ACTIVO') group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_entradas_totales`
--
DROP TABLE IF EXISTS `v_entradas_totales`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_entradas_totales`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,ifnull(`vec`.`total`,0) AS `compras`,ifnull(`ver`.`total`,0) AS `cargos`,(ifnull(`vec`.`total`,0) + ifnull(`ver`.`total`,0)) AS `total` from ((`productos` `p` left join `v_entradas_compras` `vec` on((`vec`.`id` = `p`.`id`))) left join `v_entradas_recargo` `ver` on((`ver`.`id` = `vec`.`id`))) group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_inventario`
--
DROP TABLE IF EXISTS `v_inventario`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_inventario`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,`c`.`nombre` AS `categoria`,`p`.`precio_venta` AS `precio_venta`,ifnull(((`e`.`compras` + `e`.`cargos`) - (`s`.`ventas` + `s`.`descargos`)),0) AS `stock`,`p`.`stock_min` AS `stock_min`,`p`.`stock_max` AS `stock_max`,`p`.`estatus` AS `estatus` from (((`productos` `p` left join `v_entradas_totales` `e` on((`p`.`id` = `e`.`id`))) left join `v_salidas_totales` `s` on((`p`.`id` = `s`.`id`))) join `categorias` `c` on((`p`.`categoria_id` = `c`.`id`))) group by `p`.`id`,`p`.`codigo`,`p`.`nombre`,`p`.`precio_venta`,`p`.`stock_min`,`p`.`stock_max` order by `p`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_salidas_descargo`
--
DROP TABLE IF EXISTS `v_salidas_descargo`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_salidas_descargo`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,sum(`ds`.`cantidad`) AS `total` from ((`productos` `p` left join `detalle_salida` `ds` on((`p`.`id` = `ds`.`producto_id`))) left join `salidas` `s` on((`ds`.`salida_id` = `s`.`id`))) where (`s`.`estatus` = 'ACTIVO') group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_salidas_totales`
--
DROP TABLE IF EXISTS `v_salidas_totales`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_salidas_totales`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,ifnull(`vsv`.`total`,0) AS `ventas`,ifnull(`vsd`.`total`,0) AS `descargos`,(ifnull(`vsv`.`total`,0) + ifnull(`vsd`.`total`,0)) AS `total` from ((`productos` `p` left join `v_salidas_ventas` `vsv` on((`vsv`.`id` = `p`.`id`))) left join `v_salidas_descargo` `vsd` on((`vsd`.`id` = `vsv`.`id`))) group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_salidas_ventas`
--
DROP TABLE IF EXISTS `v_salidas_ventas`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_salidas_ventas`  AS  select `p`.`id` AS `id`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,sum(`dv`.`cantidad`) AS `total` from ((`productos` `p` left join `detalle_venta` `dv` on((`p`.`id` = `dv`.`producto_id`))) left join `ventas` `v` on((`dv`.`venta_id` = `v`.`id`))) where (`v`.`estatus` = 'ACTIVO') group by `p`.`id`,`p`.`codigo`,`p`.`nombre` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bitacora_usuarios1` (`usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_compras_proveedores1` (`proveedor_id`),
  ADD KEY `fk_compras_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_compra_productos1` (`producto_id`),
  ADD KEY `fk_detalle_compra_compras1` (`compra_id`);

--
-- Indices de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_cargo_productos1` (`producto_id`),
  ADD KEY `fk_detalle_cargo_cargos1` (`entrada_id`);

--
-- Indices de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_descargo_productos1` (`producto_id`),
  ADD KEY `fk_detalle_descargo_descargos1` (`salida_id`);

--
-- Indices de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicios_has_ventas_servicios1` (`servicio_id`),
  ADD KEY `fk_servicios_has_ventas_servicios_prestados1` (`servicio_prestado_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_venta_productos1` (`producto_id`),
  ADD KEY `fk_detalle_venta_ventas1` (`venta_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_notificaciones` (`usuario_id`),
  ADD KEY `fk_notificaciones_producto` (`producto_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_productos_categorias1` (`categoria_id`),
  ADD KEY `fk_productos_unidades1` (`unidad_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`rol_id`,`permiso_id`),
  ADD KEY `fk_roles_has_permisos_permisos1` (`permiso_id`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicios_prestados`
--
ALTER TABLE `servicios_prestados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_clientes_has_ventas_clientes1` (`cliente_id`),
  ADD KEY `fk_servicio_venta_empleados1` (`empleado_id`),
  ADD KEY `fk_servicios_prestados_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_usuarios_roles1` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_ventas_clientes1` (`cliente_id`),
  ADD KEY `fk_ventas_usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios_prestados`
--
ALTER TABLE `servicios_prestados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_bitacora_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra_compras1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compra_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD CONSTRAINT `fk_detalle_cargo_cargos1` FOREIGN KEY (`entrada_id`) REFERENCES `entradas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_cargo_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD CONSTRAINT `fk_detalle_descargo_descargos1` FOREIGN KEY (`salida_id`) REFERENCES `salidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_descargo_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD CONSTRAINT `fk_servicios_has_ventas_servicios1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicios_has_ventas_servicios_prestados1` FOREIGN KEY (`servicio_prestado_id`) REFERENCES `servicios_prestados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_ventas1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_notificaciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_productos_unidades1` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `fk_roles_has_permisos_permisos1` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_has_permisos_roles1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios_prestados`
--
ALTER TABLE `servicios_prestados`
  ADD CONSTRAINT `fk_clientes_has_ventas_clientes1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicio_venta_empleados1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicios_prestados_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_clientes1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
