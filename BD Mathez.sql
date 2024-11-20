CREATE DATABASE Mathez
DEFAULT CHARACTER SET = 'utf8mb4';

USE Mathez;

CREATE TABLE Alumnos(  
    numCta INT NOT NULL PRIMARY KEY,
    apellidoP VARCHAR(40) NOT NULL,
    apellidoM VARCHAR(40) NOT NULL,
    nombres VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passwd VARCHAR(20) NOT NULL
)ENGINE=INNODB;

CREATE TABLE Cursos(
    id_curso INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE Temas(
    id_tema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tema VARCHAR(100) NOT NULL,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Inscripciones(
    id_inscrip INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_curso INT NOT NULL,
    numCta INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    progreso DECIMAL(4,1) NOT NULL, -- Para mostrar el avance en porcentaje
    estatus ENUM("En progreso", "Terminado") NOT NULL,
    fecha_termino DATE,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso) ON DELETE CASCADE,
    FOREIGN KEY (numCta) REFERENCES Alumnos(numCta) ON DELETE CASCADE
)ENGINE=INNODB;

-- Tabla para guardar el estado de los temas "terminado" si ya vio el tema, y "en progreso" y aun no lo ha visto
CREATE TABLE Avances(
    id_avance INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_inscrip INT NOT NULL,
    id_tema INT NOT NULL,
    estatus ENUM("En progreso", "Terminado") NOT NULL,
    FOREIGN KEY (id_inscrip) REFERENCES Inscripciones(id_inscrip) ON DELETE CASCADE,
    FOREIGN KEY (id_tema) REFERENCES Temas(id_tema) ON DELETE CASCADE
)ENGINE=INNODB;

-- CONSULTAS SOBRE LAS TABLAS

-- Llenado de la tabla alumnos
INSERT INTO alumnos (numCta, apellidoP, apellidoM, nombres, email, passwd) 
VALUES ('123456789', 'Gomez', 'Trejo', 'Ezequiel', 'correo123@gmail.com', '1234'), 
('987654321', 'Artiaga', 'Martinez', 'Maria Fernanda', 'correo321@gmail.com', '4321');

-- Llenado de la tabla cursos
INSERT INTO cursos(nombre)
VALUES("Cálculo");

-- Llenado de la tabla temas
INSERT INTO temas(tema, id_curso)
VALUES("Conjuntos", 1), ("Tipos de Funciones", 1), ("Regla de Correspondencia", 1), ("Características de la Gráfica", 1), 
("Variación a partir de un comportamiento de casos", 1), ("Polinomios", 1), ("Racionalización", 1), ("Razones Trigonométricas", 1), 
("Variabilidad", 1), ("Sucesiones", 1);


-- Consulta para obtener el avance que lleva del curso un alumno
SELECT (SELECT COUNT(*) FROM avances 
WHERE estatus = 'Terminado' AND id_inscrip = 2) * 100.0 / COUNT(*) AS Avance
FROM avances
WHERE id_inscrip = 2;

-- Consulta para obtener el estatus de los temas de un curso en especifico
SELECT cursos.nombre, temas.tema, avances.estatus
FROM cursos INNER JOIN temas
ON cursos.id_curso = temas.id_curso
INNER JOIN avances
ON temas.id_tema = avances.id_tema
INNER JOIN inscripciones
ON inscripciones.id_inscrip = avances.id_inscrip
WHERE cursos.id_curso = 2 AND inscripciones.numCta = 123456789

-- Consulta para obtener el progreso de un curso en el que esta inscrito un alumno
SELECT alumnos.apellidoP, alumnos.apellidoM, alumnos.nombres, cursos.nombre, inscripciones.progreso 
FROM inscripciones INNER JOIN cursos 
ON inscripciones.id_curso = cursos.id_curso 
INNER JOIN alumnos ON inscripciones.numCta = alumnos.numCta 
WHERE inscripciones.id_inscrip = 1 AND inscripciones.id_curso = 2 AND inscripciones.numCta = 123456789


-- DISPARADORES

-- Disparador para insertar la fecha de inicio, progreso y estatus en un curso
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
-- el que esta incrito el alumno
DROP TRIGGER IF EXISTS estatus_avances_tema;

DELIMITER //

CREATE TRIGGER estatus_avances_tema
AFTER INSERT ON inscripciones
FOR EACH ROW
BEGIN
    INSERT INTO avances (id_inscrip, id_tema, estatus)
    SELECT NEW.id_inscrip, id_tema, 'En progreso'
    FROM temas
    WHERE temas.id_curso = NEW.id_curso;
END //

DELIMITER ;

-- Disparador para insertar el progreso del avance de un curso inscrito en la tabla inscripciones
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
        WHERE id_inscrip = NEW.id_inscrip;
    END IF;

END //

DELIMITER ;

-- Disparador para insertar un nuevo avance en Avances al insertar un nuevo tema y actualizar progreso del curso
DROP TRIGGER IF EXISTS nuevo_tema_avance;

DELIMITER //

CREATE TRIGGER nuevo_tema_avance
AFTER INSERT ON temas
FOR EACH ROW
BEGIN
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

END //

DELIMITER ;

-- Disparador para actualizar progreso del curso al momento de eliminar un tema
DROP TRIGGER IF EXISTS elimina_tema_avance;

DELIMITER //

CREATE TRIGGER elimina_tema_avance
AFTER DELETE ON temas
FOR EACH ROW
BEGIN
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

END //

DELIMITER ;