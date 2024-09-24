-- Active: 1727143697253@@127.0.0.1@3306
CREATE DATABASE Mathez
DEFAULT CHARACTER SET = 'utf8mb4';

USE Mathez;

CREATE TABLE usuarios(  
    numCta int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    apellidoP VARCHAR(50) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    passwd VARCHAR(50) NOT NULL,
    administrador BOOLEAN
);


SELECT * FROM usuarios;