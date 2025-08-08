SHOW DATABASES;

CREATE DATABASE jeremiasOmonteGuia2;

USE jeremiasOmonteGuia2;

CREATE TABLE rol(
 id INT(6) AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(60) NOT NULL
);

INSERT INTO rol VALUES (default,'administrador'),(default,'empleado'),(default,'profesor');

SELECT * FROM rol;

CREATE TABLE usuario (
 id INT(6) AUTO_INCREMENT PRIMARY KEY,
 rol_id INT(6) NOT NULL,
 usuario VARCHAR(60) NOT NULL UNIQUE,
 pass VARCHAR(60) NOT NULL,
 FOREIGN KEY(rol_id) REFERENCES rol(id)
);

INSERT INTO usuario VALUES 
(default,1,'jeremias','jere123'),
(default,2,'ezequiel','eze123'),
(default,3,'omonte','omonte123');

CREATE TABLE productos (
    codigo INT(6) AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(60) NOT NULL,
    precio DECIMAL(8,2) NOT NULL
);