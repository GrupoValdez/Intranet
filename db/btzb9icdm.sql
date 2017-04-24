-- phpMyAdmin SQL Dump
-- version 4.6.0-dev
-- http://www.phpmyadmin.net
--
-- Host: btzb9icdm-mysql.services.clever-cloud.com:3306
-- Generation Time: Mar 20, 2017 at 05:45 PM
-- Server version: 5.5.28-0ubuntu0.12.04.3-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btzb9icdm`
--

-- --------------------------------------------------------

--
-- Table structure for table `adps`
--

CREATE TABLE `adps` (
  `id` int(11) NOT NULL,
  `tipo_adp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adps`
--

INSERT INTO `adps` (`id`, `tipo_adp`, `created_at`, `updated_at`) VALUES
(1, 'Ascenso', '2017-03-12 19:04:42', '0000-00-00 00:00:00'),
(2, 'Aumento de Sueldo', '2017-03-12 19:04:42', '0000-00-00 00:00:00'),
(3, 'Trabajo Extraordinario', '2017-03-12 19:04:59', '0000-00-00 00:00:00'),
(4, 'Horas Extras', '2017-03-12 19:04:59', '0000-00-00 00:00:00'),
(5, 'Falsedad material', '2017-03-12 19:05:35', '0000-00-00 00:00:00'),
(6, 'Amonestación escrita', '2017-03-12 19:05:35', '0000-00-00 00:00:00'),
(7, 'Llegadas tarde', '2017-03-12 19:05:56', '0000-00-00 00:00:00'),
(8, 'Ausencia sin permiso', '2017-03-12 19:05:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area`, `created_at`, `updated_at`) VALUES
(1, 'Administrativo', '2017-03-12 21:52:49', '0000-00-00 00:00:00'),
(2, 'Tecnicos', '2017-03-12 21:52:49', '0000-00-00 00:00:00'),
(3, 'Ventas', '2017-03-12 21:53:09', '0000-00-00 00:00:00'),
(4, 'Bodega', '2017-03-12 21:53:09', '0000-00-00 00:00:00'),
(5, 'Preventa', '2017-03-12 21:53:46', '0000-00-00 00:00:00'),
(6, 'Contabilidad', '2017-03-12 21:53:46', '0000-00-00 00:00:00'),
(7, 'Seguridad', '2017-03-12 21:54:20', '0000-00-00 00:00:00'),
(8, 'Gerencia', '2017-03-12 21:54:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asistencia_usuarios`
--

CREATE TABLE `asistencia_usuarios` (
  `id` int(11) NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chats_users`
--

CREATE TABLE `chats_users` (
  `id` int(11) NOT NULL,
  `conversations` varchar(20000) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_user_conversation` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats_users`
--

INSERT INTO `chats_users` (`id`, `conversations`, `id_user`, `id_user_conversation`, `created_at`, `updated_at`) VALUES
(1, 'Hola Administrador!', 3, 2, '2017-03-13 17:31:08', '0000-00-00 00:00:00'),
(2, 'Hola Jessi!! un gusto!', 2, 3, '2017-03-13 17:48:06', '0000-00-00 00:00:00'),
(3, 'Hola! que tenga un buen dia!', 3, 2, '2017-03-17 22:04:53', '0000-00-00 00:00:00'),
(4, 'ha recibido noticias??', 3, 2, '2017-03-17 22:11:09', '0000-00-00 00:00:00'),
(5, 'o todavia no sabe de todos?', 3, 2, '2017-03-17 22:11:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_post`
--

CREATE TABLE `comentarios_post` (
  `id` int(11) NOT NULL,
  `comentarios` varchar(10000) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentarios_post`
--

INSERT INTO `comentarios_post` (`id`, `comentarios`, `id_usuario`, `id_publicacion`, `created_at`, `updated_at`) VALUES
(1, 'Hola viejo', 1, 2, '2017-03-15 18:37:40', '2017-03-15 18:37:40'),
(2, 'Hola viejo', 1, 2, '2017-03-15 18:38:23', '2017-03-15 18:38:23'),
(3, 'Hola viejo', 1, 2, '2017-03-15 18:39:11', '2017-03-15 18:39:11'),
(4, 'Excelente!', 3, 2, '2017-03-15 19:24:52', '2017-03-15 19:24:52'),
(5, 'que bien!', 3, 2, '2017-03-15 19:25:55', '2017-03-15 19:25:55'),
(6, 'dvleoper', 3, 2, '2017-03-15 19:26:26', '2017-03-15 19:26:26'),
(7, 'Me encata lo que hago!', 3, 2, '2017-03-15 19:37:43', '2017-03-15 19:37:43'),
(8, 'que dices tu?', 3, 2, '2017-03-15 19:37:57', '2017-03-15 19:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_solicitudes`
--

CREATE TABLE `comentarios_solicitudes` (
  `id` int(11) NOT NULL,
  `conversation` varchar(5000) DEFAULT NULL,
  `documentos_adjuntos` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_detalle_solicitud` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `datos_empleados`
--

CREATE TABLE `datos_empleados` (
  `id` int(11) NOT NULL,
  `area_departamento` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `jefe_inmediato` int(11) DEFAULT NULL,
  `correo_corporativo` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `extencion` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datos_empleados`
--

INSERT INTO `datos_empleados` (`id`, `area_departamento`, `cargo`, `jefe_inmediato`, `correo_corporativo`, `celular`, `extencion`, `fecha_ingreso`, `id_usuario`, `id_marca`, `id_sucursal`, `created_at`, `updated_at`) VALUES
(1, 'Gerencia', 'Gerente', 1, 'administrador@admin.com', '78797888', '12', '2000-01-01', 2, 1, 1, '2017-03-17 23:52:18', '2017-03-13 16:23:35'),
(2, 'Contabilidad', 'Contabilidad', 2, 'jesi@valdez.com', '78797888', '44', '2015-03-01', 3, 2, 5, '2017-03-17 23:51:58', '2017-03-13 16:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `estado_civil` varchar(255) DEFAULT NULL,
  `direccion` varchar(555) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `correo_personal` varchar(255) DEFAULT NULL,
  `cumpleanos` date DEFAULT NULL,
  `foto` text,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `nombre`, `last_name`, `apellidos`, `genero`, `estado_civil`, `direccion`, `departamento`, `municipio`, `correo_personal`, `cumpleanos`, `foto`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin', '--', 'Masculino', 'Casado/a', 'Merliot', 'La libertad', 'Anitguo cuscatlan', 'ad@ad.com', '1980-01-01', '60865.jpg', 2, '2017-03-13 16:23:34', '2017-03-13 16:23:34'),
(2, 'Jessica', 'Lisbeth', 'Ramirez', 'Femenino', 'Casado/a', 'Colonia', 'Contabilidad', 'Municipio', 'jesi@jes.com', '1999-02-07', '27028.jpg', 3, '2017-03-19 01:30:17', '2017-03-13 16:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `detalles_solicitudes`
--

CREATE TABLE `detalles_solicitudes` (
  `id` int(11) NOT NULL,
  `motivo_descripcion` varchar(1500) DEFAULT NULL,
  `fecha_permiso` date DEFAULT NULL,
  `hora_permiso` varchar(200) DEFAULT NULL,
  `solicitud_aceptada` int(11) DEFAULT NULL,
  `solicitud_denegada` int(11) DEFAULT NULL,
  `solicitud_espera` int(11) DEFAULT NULL,
  `documentos_adjunto` varchar(255) DEFAULT NULL,
  `img_adjunta` varchar(255) DEFAULT NULL,
  `solicitud_vista` int(11) DEFAULT NULL,
  `solicitud_compartida` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalles_solicitudes`
--

INSERT INTO `detalles_solicitudes` (`id`, `motivo_descripcion`, `fecha_permiso`, `hora_permiso`, `solicitud_aceptada`, `solicitud_denegada`, `solicitud_espera`, `documentos_adjunto`, `img_adjunta`, `solicitud_vista`, `solicitud_compartida`, `id_usuario`, `id_tipo_solicitud`, `created_at`, `updated_at`) VALUES
(1, 'Salida Familiar!', '2017-03-31', 'Dia_completo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2017-03-20 03:47:21', '2017-03-20 03:47:21'),
(2, 'Trabason', NULL, NULL, NULL, NULL, 1, '', '68234.jpg', NULL, NULL, 3, 2, '2017-03-20 15:31:18', '2017-03-20 15:31:18'),
(3, 'Les sugiero mucha atencion', NULL, NULL, NULL, NULL, 1, '', '58741.jpg', NULL, NULL, 3, 3, '2017-03-20 15:52:01', '2017-03-20 15:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `ubicacion_archivo` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventos_calendario`
--

CREATE TABLE `eventos_calendario` (
  `id` int(11) NOT NULL,
  `descripcion_evento` varchar(10000) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventos_calendario`
--

INSERT INTO `eventos_calendario` (`id`, `descripcion_evento`, `fecha_evento`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Pronto las vacaciones!!!!', '2017-03-31', 3, '2017-03-17 15:43:51', '2017-03-16 16:15:27'),
(2, 'Hoy salida con amigos!!', '2017-03-17', 3, '2017-03-17 14:50:13', '2017-03-17 14:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `formacion_acedemica`
--

CREATE TABLE `formacion_acedemica` (
  `id` int(11) NOT NULL,
  `bachillerato` varchar(400) DEFAULT NULL,
  `tecnico` varchar(400) DEFAULT NULL,
  `superior` varchar(400) DEFAULT NULL,
  `postgrado` varchar(400) DEFAULT NULL,
  `diplomado` varchar(400) DEFAULT NULL,
  `other_conocimiento` varchar(700) DEFAULT NULL,
  `habilidades` varchar(400) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formacion_acedemica`
--

INSERT INTO `formacion_acedemica` (`id`, `bachillerato`, `tecnico`, `superior`, `postgrado`, `diplomado`, `other_conocimiento`, `habilidades`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Colegio', '', 'Universidad', '', '', '', 'Gerencia', 2, '2017-03-13 16:23:34', '2017-03-13 16:23:34'),
(2, 'colegio', '  --    ', 'Universidad', '  --    ', '  --    ', '  --    ', 'Amigables, Atenta', 3, '2017-03-19 01:30:18', '2017-03-13 16:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `get_users_online`
--

CREATE TABLE `get_users_online` (
  `id` int(11) NOT NULL,
  `id_user_login` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `get_users_online`
--

INSERT INTO `get_users_online` (`id`, `id_user_login`, `created_at`, `updated_at`) VALUES
(24, 3, '2017-03-20 16:26:30', '2017-03-20 16:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `historial_actividades_recientes`
--

CREATE TABLE `historial_actividades_recientes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_actividad` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `historial_adps_users`
--

CREATE TABLE `historial_adps_users` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_adp` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `bloq_horario1` varchar(255) DEFAULT NULL,
  `bloq_horario1Time` varchar(255) DEFAULT NULL,
  `bloq_horario2` varchar(255) DEFAULT NULL,
  `bloq_horario2Time` varchar(255) DEFAULT NULL,
  `bloq_horario3` varchar(255) DEFAULT NULL,
  `bloq_horario3Time` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio1` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio1Time` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio2` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio2Time` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio3` varchar(255) DEFAULT NULL,
  `bloq_horarioMedio3Time` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `bloq_horario1`, `bloq_horario1Time`, `bloq_horario2`, `bloq_horario2Time`, `bloq_horario3`, `bloq_horario3Time`, `bloq_horarioMedio1`, `bloq_horarioMedio1Time`, `bloq_horarioMedio2`, `bloq_horarioMedio2Time`, `bloq_horarioMedio3`, `bloq_horarioMedio3Time`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Domingo, Lunes', '13:10,03:15', 'Martes', '14:15,02:20', NULL, NULL, 'Miercoles, Jueves', '03:20,04:20', 'Viernes, Sabado', '15:20,17:25', NULL, NULL, 2, '2017-03-20 01:27:12', '2017-03-13 16:23:35'),
(2, 'Domingo, Lunes', '13:10,03:15', 'Martes', '14:15,02:20', NULL, NULL, 'Miercoles, Jueves', '03:20,04:20', 'Viernes, Sabado', '15:20,17:25', NULL, NULL, 3, '2017-03-20 01:27:14', '2017-03-13 16:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `likes_posts`
--

CREATE TABLE `likes_posts` (
  `id` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuarios_likes` varchar(500) NOT NULL,
  `total_likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes_posts`
--

INSERT INTO `likes_posts` (`id`, `id_publicacion`, `id_usuarios_likes`, `total_likes`, `created_at`, `updated_at`) VALUES
(1, 2, '3,1', 2, '2017-03-16 14:13:48', '2017-03-14 20:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id`, `marca`, `created_at`, `updated_at`) VALUES
(1, 'Laptops Valdez', '2017-03-12 21:02:52', '0000-00-00 00:00:00'),
(2, 'Valdez Mobile', '2017-03-12 21:02:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones_eventos`
--

CREATE TABLE `notificaciones_eventos` (
  `id` int(11) NOT NULL,
  `titulo_evento` varchar(255) NOT NULL,
  `descripcion_evento` varchar(2000) DEFAULT NULL,
  `color_evento` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20000) DEFAULT NULL,
  `imagen` text,
  `documentos` varchar(450) DEFAULT NULL,
  `id_tipo_publicacion` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `descripcion`, `imagen`, `documentos`, `id_tipo_publicacion`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Primer Post', '19433.jpg,22133.jpg', '', 1, 3, '2017-03-13 22:51:14', '2017-03-13 22:51:14'),
(2, 'Adjunto documento', '', '46206.docx', 1, 3, '2017-03-13 22:53:17', '2017-03-13 22:53:17'),
(3, 'Esto esta genial! me llega lo que crearon', '', '', 1, 1, '2017-03-14 16:00:52', '2017-03-14 16:00:52'),
(4, 'Bienvenido al nuevo Sistema!', '', '', 1, 3, '2017-03-15 20:05:18', '2017-03-15 20:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `post_personalizados`
--

CREATE TABLE `post_personalizados` (
  `id` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_personalizados`
--

INSERT INTO `post_personalizados` (`id`, `id_posts`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '2017-03-16 14:37:58', '2017-03-16 14:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `recordatorios_admin`
--

CREATE TABLE `recordatorios_admin` (
  `id` int(11) NOT NULL,
  `descripcion_recordatorio` varchar(10000) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `tipo_rol` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `tipo_rol`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2017-03-12 22:02:43', '0000-00-00 00:00:00'),
(2, 'user', '2017-03-12 22:02:43', '0000-00-00 00:00:00'),
(3, 'administrativo', '2017-03-12 22:03:02', '0000-00-00 00:00:00'),
(4, 'editor', '2017-03-12 22:03:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `geocalizacion` text,
  `id_marca` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucursal`, `geocalizacion`, `id_marca`, `created_at`, `updated_at`) VALUES
(1, 'Laptops Valdez Merliot', NULL, 1, '2017-03-12 21:03:09', '0000-00-00 00:00:00'),
(2, 'Laptops Valdez Escalon', NULL, 1, '2017-03-12 21:03:12', '0000-00-00 00:00:00'),
(3, 'Laptops Valdez San Miguel', NULL, 1, '2017-03-12 21:03:47', '0000-00-00 00:00:00'),
(4, 'Valdez Mobile Merliot', NULL, 2, '2017-03-12 21:03:51', '0000-00-00 00:00:00'),
(5, 'Valdez Mobile Escalon', NULL, 2, '2017-03-12 21:04:20', '0000-00-00 00:00:00'),
(6, 'Valdez Mobile San Miguel', NULL, 2, '2017-03-12 21:04:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_actividades`
--

CREATE TABLE `tipos_actividades` (
  `id` int(11) NOT NULL,
  `tipo_actividad` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipos_actividades`
--

INSERT INTO `tipos_actividades` (`id`, `tipo_actividad`, `created_at`, `updated_at`) VALUES
(1, 'eventos', '2017-03-12 18:37:30', '0000-00-00 00:00:00'),
(2, 'proyectos', '2017-03-12 18:37:30', '0000-00-00 00:00:00'),
(3, 'oportunidades_empleo', '2017-03-12 18:38:40', '0000-00-00 00:00:00'),
(4, 'posts', '2017-03-12 18:38:40', '0000-00-00 00:00:00'),
(5, 'post_urgentes', '2017-03-12 18:38:59', '0000-00-00 00:00:00'),
(6, 'vacaciones_post', '2017-03-12 18:38:59', '0000-00-00 00:00:00'),
(7, 'pago', '2017-03-12 18:39:15', '0000-00-00 00:00:00'),
(8, 'documentos', '2017-03-12 18:39:15', '0000-00-00 00:00:00'),
(9, 'politicas', '2017-03-12 18:39:44', '0000-00-00 00:00:00'),
(10, 'actualizacion_perfil', '2017-03-12 18:39:34', '0000-00-00 00:00:00'),
(11, 'likes', '2017-03-12 18:39:59', '0000-00-00 00:00:00'),
(12, 'comentarios', '2017-03-12 18:39:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_descuentos`
--

CREATE TABLE `tipos_descuentos` (
  `id` int(11) NOT NULL,
  `vacaciones` int(11) DEFAULT NULL,
  `dia_septimo` int(11) DEFAULT NULL,
  `sin_descuento` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_detalles_solicitud` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipos_descuentos`
--

INSERT INTO `tipos_descuentos` (`id`, `vacaciones`, `dia_septimo`, `sin_descuento`, `id_usuario`, `id_detalles_solicitud`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 3, 1, '2017-03-20 03:47:22', '2017-03-20 03:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_solicitudes`
--

CREATE TABLE `tipos_solicitudes` (
  `id` int(11) NOT NULL,
  `tipo_solicitud` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipos_solicitudes`
--

INSERT INTO `tipos_solicitudes` (`id`, `tipo_solicitud`, `created_at`, `updated_at`) VALUES
(1, 'Solicitud de permiso', '2017-03-12 03:54:43', '0000-00-00 00:00:00'),
(2, 'Solicitud de emergencia', '2017-03-12 03:54:43', '0000-00-00 00:00:00'),
(3, 'Sugerencias', '2017-03-12 03:56:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_posts`
--

CREATE TABLE `tipo_posts` (
  `id` int(11) NOT NULL,
  `tipos_post` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_posts`
--

INSERT INTO `tipo_posts` (`id`, `tipos_post`, `created_at`, `updated_at`) VALUES
(1, 'post_normal', '2017-03-12 18:35:28', '0000-00-00 00:00:00'),
(2, 'post_caracter_urgente', '2017-03-12 18:35:28', '0000-00-00 00:00:00'),
(3, 'post_personalizados', '2017-03-12 18:35:59', '0000-00-00 00:00:00'),
(4, 'post_vacaciones', '2017-03-12 18:35:59', '0000-00-00 00:00:00'),
(5, 'post_cumpleanos', '2017-03-12 18:36:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_respal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `password_respal`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin2@admin.com', '$2y$10$2XkOxFNQwljapKyxJohfau7XnZdWBOpPIQqiIw2BpuVcICG7vzsPa', 'admin', 'sWDbTqZ5SZPSKYu2c3XKjV45dNeh8sz6Z0woQbFS0FcY8ujuHz0muz6wUfp4', NULL, '2017-03-13 16:10:55', '2017-03-20 16:22:55'),
(2, 'Administrador', 'administrador@admin.com', '$2y$10$c3AY67VAsHiQ4.MD/loyZuRrxrrqvepQHC44yZIcgL4cT.qfxIFLC', 'admin', 'eNmqgs286pXC10KWO3ZvU1SyNlu6DaIupxNOdE0ifw14uv6Et4azDlnWfksU', NULL, '2017-03-13 16:23:34', '2017-03-13 16:49:11'),
(3, 'Jessica', 'jesi@valdez.com', '$2y$10$uePaEdbiu0.RuHd8rhJDMeCDlv2ErDLRycnR11zLguJgGOM9vD83K', 'user', 'liho6ym9Yh3AzgDdHy3byKiaaRboVQJ8NxDHm8qAUoRrjj4hvy4nEVFMi0yb', 'jes123', '2017-03-13 16:29:48', '2017-03-20 16:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `vacaciones_user`
--

CREATE TABLE `vacaciones_user` (
  `id` int(11) NOT NULL,
  `dias` int(11) DEFAULT NULL,
  `fecha_vacaciones` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adps`
--
ALTER TABLE `adps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asistencia_usuarios`
--
ALTER TABLE `asistencia_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_users`
--
ALTER TABLE `chats_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios_post`
--
ALTER TABLE `comentarios_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios_solicitudes`
--
ALTER TABLE `comentarios_solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datos_empleados`
--
ALTER TABLE `datos_empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalles_solicitudes`
--
ALTER TABLE `detalles_solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formacion_acedemica`
--
ALTER TABLE `formacion_acedemica`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_users_online`
--
ALTER TABLE `get_users_online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_actividades_recientes`
--
ALTER TABLE `historial_actividades_recientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_adps_users`
--
ALTER TABLE `historial_adps_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes_posts`
--
ALTER TABLE `likes_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificaciones_eventos`
--
ALTER TABLE `notificaciones_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_personalizados`
--
ALTER TABLE `post_personalizados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recordatorios_admin`
--
ALTER TABLE `recordatorios_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_actividades`
--
ALTER TABLE `tipos_actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_descuentos`
--
ALTER TABLE `tipos_descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_solicitudes`
--
ALTER TABLE `tipos_solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_posts`
--
ALTER TABLE `tipo_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vacaciones_user`
--
ALTER TABLE `vacaciones_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adps`
--
ALTER TABLE `adps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `asistencia_usuarios`
--
ALTER TABLE `asistencia_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chats_users`
--
ALTER TABLE `chats_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comentarios_post`
--
ALTER TABLE `comentarios_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comentarios_solicitudes`
--
ALTER TABLE `comentarios_solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `datos_empleados`
--
ALTER TABLE `datos_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detalles_solicitudes`
--
ALTER TABLE `detalles_solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `formacion_acedemica`
--
ALTER TABLE `formacion_acedemica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `get_users_online`
--
ALTER TABLE `get_users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `historial_actividades_recientes`
--
ALTER TABLE `historial_actividades_recientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historial_adps_users`
--
ALTER TABLE `historial_adps_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `likes_posts`
--
ALTER TABLE `likes_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notificaciones_eventos`
--
ALTER TABLE `notificaciones_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `post_personalizados`
--
ALTER TABLE `post_personalizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recordatorios_admin`
--
ALTER TABLE `recordatorios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipos_actividades`
--
ALTER TABLE `tipos_actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tipos_descuentos`
--
ALTER TABLE `tipos_descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipos_solicitudes`
--
ALTER TABLE `tipos_solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_posts`
--
ALTER TABLE `tipo_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vacaciones_user`
--
ALTER TABLE `vacaciones_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
