-- Active: 1727189343099@@127.0.0.1@3306@mathez
CREATE DATABASE Mathez
DEFAULT CHARACTER SET = 'utf8mb4';

USE Mathez;

CREATE TABLE Alumnos(  
    numCta INT NOT NULL PRIMARY KEY,
    apellidoP VARCHAR(50) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passwd VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE Administradores(  
    id_admin INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    apellidoP VARCHAR(50) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passwd VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE Cursos(
    id_curso INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(50)
)ENGINE=INNODB;

CREATE TABLE Temas(
    id_tema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tema VARCHAR(100),
    id_curso INT,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
)ENGINE=INNODB;

CREATE TABLE Inscripciones(
    id_inscrip INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_curso INT,
    numCta INT,
    fecha_inicio DATE,
    progreso DECIMAL(4,1), -- Para mostrar el avance en porcentaje
    estatus ENUM("En progreso", "Terminado"),
    fecha_termino DATE,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso),
    FOREIGN KEY (numCta) REFERENCES Alumnos(numCta)
)ENGINE=INNODB;

--Tabla para guardar el estado de los temas "terminado" si ya vio el tema, y "en progreso" y aun no lo ha visto
CREATE TABLE Avances(
    id_avance INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_inscrip INT,
    estatus ENUM("En progreso", "Terminado"),
    FOREIGN KEY (id_inscrip) REFERENCES Inscripciones(id_inscrip) ON DELETE CASCADE
)ENGINE=INNODB;

--CONSULTAS SOBRE LAS TABLAS

--Llenado de la tabla cursos
INSERT INTO cursos(nombre)
VALUES("Álgebra"), ("Cálculo")

--Llenado de la tabla temas
INSERT INTO temas(tema, id_curso)
VALUES("Conjuntos", 2), ("Tipos de Funciones", 2), ("Regla de Correspondencia", 2), ("Características de la Gráfica", 2), 
("Variación a partir de un comportamiento de casos", 2), ("Polinomios", 2), ("Racionalización", 2), ("Razones Trigonométricas", 2), 
("Variabilidad", 2), ("Sucesiones", 2)

--Consulta para obtener el avance que lleva del curso un alumno
SELECT (SELECT COUNT(*) FROM avances 
WHERE estatus = 'Terminado' AND id_inscrip = 2) * 100.0 / COUNT(*) AS Avance
FROM avances
WHERE id_inscrip = 2;


--DISPARADORES

--Disparador para insertar la fecha de inicio, progreso y estatus en un curso
DROP TRIGGER IF EXISTS fecha_inicio_curso;

DELIMITER //

CREATE TRIGGER fecha_inicio_curso
BEFORE INSERT ON inscripciones
FOR EACH ROW
BEGIN
    SET NEW.fecha_inicio = CONVERT_TZ(NOW(), '+00:00', '-06:00');
    SET NEW.progreso = 0.0;
    SET NEW.estatus = "En progreso";
END //

DELIMITER ;

-- Disparador para insertar "En progreso" en la columna Estatus de la tabla avances para todos los temas del curso en 
--el que esta incrito el alumno
DROP TRIGGER IF EXISTS estatus_avances_tema;

DELIMITER //

CREATE TRIGGER estatus_avances_tema
AFTER INSERT ON inscripciones
FOR EACH ROW
BEGIN
    INSERT INTO avances (id_inscrip, estatus)
    SELECT inscripciones.id_inscrip, 'En progreso'
    FROM inscripciones 
    INNER JOIN temas ON inscripciones.id_curso = temas.id_curso
    WHERE inscripciones.numCta = NEW.numCta;
END //

DELIMITER ;

--Disparador para insertar el progreso del avance de un curso inscrito en la tabla inscripciones
DROP TRIGGER IF EXISTS progreso_curso;

DELIMITER //

CREATE TRIGGER progreso_curso
AFTER UPDATE ON avances
FOR EACH ROW
BEGIN
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
        WHERE id_inscrip = NEW.id_inscrip;  -- Agregado el WHERE aquí
    END IF;

END //

DELIMITER ;