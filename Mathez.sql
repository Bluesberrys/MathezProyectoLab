CREATE DATABASE IF NOT EXISTS Mathez 
DEFAULT CHARACTER SET = 'utf8mb4';

USE Mathez;

CREATE TABLE IF NOT EXISTS Alumnos (  
    numCta INT NOT NULL PRIMARY KEY,
    apellidoP VARCHAR(50) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passwd VARCHAR(255) NOT NULL
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Cursos (
    id_curso INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(50)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Temas (
    id_tema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tema VARCHAR(100),
    id_curso INT,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Inscripciones (
    id_inscrip INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_curso INT,
    numCta INT,
    fecha_inicio DATE,
    progreso DECIMAL(4,1),
    estatus ENUM("En progreso", "Terminado"),
    fecha_termino DATE,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso),
    FOREIGN KEY (numCta) REFERENCES Alumnos(numCta)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Avances (
    id_avance INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_inscrip INT,
    id_tema INT,
    estatus ENUM("En progreso", "Terminado"),
    FOREIGN KEY (id_inscrip) REFERENCES Inscripciones(id_inscrip) ON DELETE CASCADE,
    FOREIGN KEY (id_tema) REFERENCES Temas(id_tema) ON DELETE CASCADE
) ENGINE=INNODB;

-- Insert initial data if not exists
INSERT IGNORE INTO Cursos (id_curso, nombre) VALUES 
(1, 'Álgebra'), 
(2, 'Cálculo');

INSERT IGNORE INTO Temas (tema, id_curso) 
VALUES 
("Expresiones Algebraicas", 1), 
("Ecuaciones", 1);

INSERT IGNORE INTO Temas (tema, id_curso) VALUES
('Conjuntos', 2), 
('Tipos de Funciones', 2), 
('Regla de Correspondencia', 2), 
('Características de la Gráfica', 2), 
('Variación a partir de un comportamiento de casos', 2), 
('Polinomios', 2), 
('Racionalización', 2), 
('Razones Trigonométricas', 2), 
('Variabilidad', 2), 
('Sucesiones', 2);

SELECT (
    SELECT COUNT(*) 
    FROM Avances 
    WHERE estatus = 'Terminado' AND id_inscrip = 2
) * 100.0 / COUNT(*) AS Avance
FROM Avances
WHERE id_inscrip = 2;

SELECT Cursos.nombre, Temas.tema, Avances.estatus
FROM Cursos 
INNER JOIN Temas ON Cursos.id_curso = Temas.id_curso
INNER JOIN Avances ON Temas.id_tema = Avances.id_tema
INNER JOIN Inscripciones ON Inscripciones.id_inscrip = Avances.id_inscrip
WHERE Cursos.id_curso = 2 AND Inscripciones.numCta = 123456789;

SELECT Alumnos.apellidoP, Alumnos.apellidoM, Alumnos.nombres, 
       Cursos.nombre, Inscripciones.progreso 
FROM Inscripciones 
INNER JOIN Cursos ON Inscripciones.id_curso = Cursos.id_curso 
INNER JOIN Alumnos ON Inscripciones.numCta = Alumnos.numCta 
WHERE Inscripciones.id_inscrip = 1 
  AND Inscripciones.id_curso = 2 
  AND Inscripciones.numCta = 123456789;

DELIMITER //

DROP TRIGGER IF EXISTS fecha_inicio_curso//
DROP TRIGGER IF EXISTS estatus_avances_tema//
DROP TRIGGER IF EXISTS progreso_curso//
DROP TRIGGER IF EXISTS nuevo_tema_avance//
DROP TRIGGER IF EXISTS elimina_tema_avance//

-- Create triggers
CREATE TRIGGER fecha_inicio_curso
BEFORE INSERT ON Inscripciones
FOR EACH ROW
BEGIN
    SET NEW.fecha_inicio = CONVERT_TZ(NOW(), '+00:00', '-06:00');
    SET NEW.progreso = 0.0;
    SET NEW.estatus = "En progreso";
END//

CREATE TRIGGER estatus_avances_tema
AFTER INSERT ON Inscripciones
FOR EACH ROW
BEGIN
    INSERT INTO Avances (id_inscrip, id_tema, estatus)
    SELECT NEW.id_inscrip, id_tema, 'En progreso'
    FROM Temas
    WHERE Temas.id_curso = NEW.id_curso;
END//

CREATE TRIGGER progreso_curso
AFTER UPDATE ON Avances
FOR EACH ROW
BEGIN
    DECLARE Avance DECIMAL(5,2);

    SELECT COUNT(*) * 100.0 / (SELECT COUNT(*) FROM Avances WHERE id_inscrip = NEW.id_inscrip)
    INTO Avance
    FROM Avances 
    WHERE estatus = 'Terminado' AND id_inscrip = NEW.id_inscrip;

    UPDATE Inscripciones 
    SET progreso = Avance
    WHERE id_inscrip = NEW.id_inscrip;

    IF Avance = 100 THEN
        UPDATE Inscripciones
        SET estatus = 'Terminado', 
            fecha_termino = CONVERT_TZ(NOW(), '+00:00', '-06:00')
        WHERE id_inscrip = NEW.id_inscrip;
    ELSE
        UPDATE Inscripciones
        SET estatus = 'En progreso', 
            fecha_termino = NULL
        WHERE id_inscrip = NEW.id_inscrip;
    END IF;
END//

CREATE TRIGGER nuevo_tema_avance
AFTER INSERT ON Temas
FOR EACH ROW
BEGIN
    DECLARE Avance DECIMAL(5,2);

    INSERT INTO Avances (id_inscrip, id_tema, estatus)
    SELECT DISTINCT Inscripciones.id_inscrip, NEW.id_tema, 'En progreso'
    FROM Inscripciones
    WHERE Inscripciones.id_curso = NEW.id_curso;

    -- Update progress for affected courses
    UPDATE Inscripciones
    SET progreso = (
        SELECT COUNT(*) * 100.0 / (
            SELECT COUNT(*) 
            FROM Avances 
            WHERE id_inscrip = Inscripciones.id_inscrip
        )
        FROM Avances 
        WHERE estatus = 'Terminado' 
          AND id_inscrip = Inscripciones.id_inscrip
    )
    WHERE id_curso = NEW.id_curso;

    -- Update status and completion date
    UPDATE Inscripciones 
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
END//

CREATE TRIGGER elimina_tema_avance
AFTER DELETE ON Temas
FOR EACH ROW
BEGIN
    -- Update progress and status for affected courses
    UPDATE Inscripciones 
    SET progreso = (
        SELECT IFNULL(
            (SELECT COUNT(*) * 100.0 / NULLIF(
                (SELECT COUNT(*) FROM Avances WHERE id_inscrip = Inscripciones.id_inscrip),
                0
            )
            FROM Avances
            WHERE estatus = 'Terminado'
              AND id_inscrip = Inscripciones.id_inscrip
            ), 0)
    ),
    estatus = CASE
        WHEN (
            SELECT COUNT(*) * 100.0 / NULLIF(
                (SELECT COUNT(*) FROM Avances WHERE id_inscrip = Inscripciones.id_inscrip),
                0
            )
            FROM Avances
            WHERE estatus = 'Terminado'
              AND id_inscrip = Inscripciones.id_inscrip
        ) = 100 THEN 'Terminado'
        ELSE 'En progreso'
    END,
    fecha_termino = CASE
        WHEN (
            SELECT COUNT(*) * 100.0 / NULLIF(
                (SELECT COUNT(*) FROM Avances WHERE id_inscrip = Inscripciones.id_inscrip),
                0
            )
            FROM Avances
            WHERE estatus = 'Terminado'
              AND id_inscrip = Inscripciones.id_inscrip
        ) = 100 THEN CONVERT_TZ(NOW(), '+00:00', '-06:00')
        ELSE NULL
    END
    WHERE id_curso = OLD.id_curso;
END//

DELIMITER ;