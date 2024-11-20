-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2024 a las 21:03:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mathez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `numCta` int(11) NOT NULL,
  `apellidoP` varchar(40) NOT NULL,
  `apellidoM` varchar(40) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`numCta`, `apellidoP`, `apellidoM`, `nombres`, `email`, `passwd`) VALUES
(123456789, 'Usuario', 'Usuario', 'Usuario', 'ezegom01@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE `avances` (
  `id_avance` int(11) NOT NULL,
  `id_inscrip` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `estatus` enum('En progreso','Terminado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `avances`
--
DELIMITER $$
CREATE TRIGGER `progreso_curso` AFTER UPDATE ON `avances` FOR EACH ROW BEGIN
    DECLARE Avance DECIMAL(5,2);

    -- Calculamos el porcentaje de avance
    SELECT COUNT(*) * 100.0 / (SELECT COUNT(*) FROM avances WHERE id_inscrip = NEW.id_inscrip)
    INTO Avance
    FROM avances 
    WHERE estatus = 'Terminado' AND id_inscrip = NEW.id_inscrip;

    -- Actualizamos el campo progreso en inscripciones
    UPDATE inscripciones 
    SET progreso = Avance
    WHERE id_inscrip = NEW.id_inscrip;

    IF Avance = 100 THEN
        UPDATE inscripciones
        SET estatus = 'Terminado', 
            fecha_termino = CONVERT_TZ(NOW(), '+00:00', '-06:00')
        WHERE id_inscrip = NEW.id_inscrip;
    ELSE
        UPDATE inscripciones
        SET estatus = 'En progreso', 
            fecha_termino = NULL
        WHERE id_inscrip = NEW.id_inscrip;
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre`) VALUES
(1, 'Cálculo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id_inscrip` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `numCta` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `progreso` decimal(4,1) NOT NULL,
  `estatus` enum('En progreso','Terminado') NOT NULL,
  `fecha_termino` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `inscripciones`
--
DELIMITER $$
CREATE TRIGGER `estatus_avances_tema` AFTER INSERT ON `inscripciones` FOR EACH ROW BEGIN
    INSERT INTO avances (id_inscrip, id_tema, estatus)
    SELECT NEW.id_inscrip, id_tema, 'En progreso'
    FROM temas
    WHERE temas.id_curso = NEW.id_curso;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `fecha_inicio_curso` BEFORE INSERT ON `inscripciones` FOR EACH ROW BEGIN
    SET NEW.fecha_inicio = CONVERT_TZ(NOW(), '+00:00', '-06:00');
    SET NEW.progreso = 0.0;
    SET NEW.estatus = "En progreso";
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `tema` varchar(100) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id_tema`, `tema`, `id_curso`) VALUES
(1, 'Conjuntos', 1),
(2, 'Tipos de Funciones', 1),
(3, 'Regla de Correspondencia', 1),
(4, 'Características de la Gráfica', 1),
(5, 'Variación a partir de un comportamiento de casos', 1),
(6, 'Polinomios', 1),
(7, 'Racionalización', 1),
(8, 'Razones Trigonométricas', 1),
(9, 'Variabilidad', 1),
(10, 'Sucesiones', 1);

--
-- Disparadores `temas`
--
DELIMITER $$
CREATE TRIGGER `elimina_tema_avance` AFTER DELETE ON `temas` FOR EACH ROW BEGIN
    DECLARE Avance DECIMAL(5,2);
    
    -- Actualizamos el progreso y el estatus de todas las inscripciones relacionadas con el curso del tema eliminado
    UPDATE inscripciones 
    SET progreso = (
        SELECT IFNULL(
            (SELECT COUNT(*) * 100.0 / NULLIF((SELECT COUNT(*) FROM avances WHERE id_inscrip = inscripciones.id_inscrip), 0)
            FROM avances
            WHERE estatus = 'Terminado'
            AND id_inscrip = inscripciones.id_inscrip), 0)
    ),
    estatus = (
        CASE
            WHEN (
                SELECT COUNT(*) * 100.0 / NULLIF((SELECT COUNT(*) FROM avances WHERE id_inscrip = inscripciones.id_inscrip), 0)
                FROM avances
                WHERE estatus = 'Terminado'
                AND id_inscrip = inscripciones.id_inscrip
            ) = 100 THEN 'Terminado'
            ELSE 'En progreso'
        END
    ),
    fecha_termino = (
        CASE
            WHEN (
                SELECT COUNT(*) * 100.0 / NULLIF((SELECT COUNT(*) FROM avances WHERE id_inscrip = inscripciones.id_inscrip), 0)
                FROM avances
                WHERE estatus = 'Terminado'
                AND id_inscrip = inscripciones.id_inscrip
            ) = 100 THEN CONVERT_TZ(NOW(), '+00:00', '-06:00')
            ELSE NULL
        END
    )
    WHERE id_curso = OLD.id_curso;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nuevo_tema_avance` AFTER INSERT ON `temas` FOR EACH ROW BEGIN
    DECLARE Avance DECIMAL(5,2);

    INSERT INTO avances (id_inscrip, id_tema, estatus)
    SELECT DISTINCT inscripciones.id_inscrip, NEW.id_tema, 'En progreso'
    FROM inscripciones INNER JOIN temas
    ON inscripciones.id_curso = temas.id_curso
    WHERE inscripciones.id_curso = NEW.id_curso;

    -- Calcular el porcentaje de avance para cada inscripcion asociada al curso
    UPDATE inscripciones
    SET progreso = (
            SELECT COUNT(*) * 100.0 / (SELECT COUNT(*) FROM avances WHERE id_inscrip = inscripciones.id_inscrip)
            FROM avances 
            WHERE estatus = 'Terminado' AND id_inscrip = inscripciones.id_inscrip
        )
    WHERE id_curso = NEW.id_curso; 

    -- Actualizar estatus y fecha de termino basado en el progreso calculado
    UPDATE inscripciones 
    SET 
        estatus = CASE 
                    WHEN progreso = 100 THEN 'Terminado' 
                    ELSE 'En progreso' 
                  END,
        fecha_termino = CASE 
                            WHEN progreso = 100 THEN CONVERT_TZ(NOW(), '+00:00', '-06:00') 
                            ELSE NULL 
                        END
    WHERE id_curso = NEW.id_curso;

END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`numCta`);

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id_avance`),
  ADD KEY `id_inscrip` (`id_inscrip`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id_inscrip`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `numCta` (`numCta`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `id_avance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id_inscrip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`id_inscrip`) REFERENCES `inscripciones` (`id_inscrip`) ON DELETE CASCADE,
  ADD CONSTRAINT `avances_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`numCta`) REFERENCES `alumnos` (`numCta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
