
    CREATE DATABASE IF NOT EXISTS `hogwarts`;
    USE `hogwarts`;

    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    SET time_zone = "+00:00";

    CREATE TABLE Escuela (
        nombreEscuela VARCHAR(50) NOT NULL,
        localizacion VARCHAR(500),
        fechaApertura date NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO Escuela VALUES ('Hogwarts', 'Colinas de Escocia', '990-01-01');

    CREATE TABLE Casa (
        codigoCasa INT,
        nombre VARCHAR(50),
        fundador VARCHAR(100),
        color VARCHAR(50),
        lema VARCHAR(200),
        emblema VARCHAR(200)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO Casa VALUES (1, 'Gryffindor', 'Godric Gryffindor', 'Dorado en fondo rojo', 'Donde van los valientes de corazón.', 'León');
    INSERT INTO Casa VALUES (2, 'Hufflepuff', 'Helga Hufflepuff', 'Negro sobre fondo amarillo', 'Donde asisten los estudiantes trabajadores, honestos, amantes de los animales y de la naturaleza.', 'Tejón');
    INSERT INTO Casa VALUES (3, 'Ravenclaw', 'Rowina Ravenclaw', 'Bronce y plata sobre fondo azul', 'Donde pertenecen los inteligentes y sabios.', 'Águila');
    INSERT INTO Casa VALUES (4, 'Slytherin', 'Salazar Slytherin', 'Plateado sobre fondo verde', 'Donde son audaces y ambiciosos.', 'Serpiente');


    CREATE TABLE Alumno (
        codigoAlumno INT,
        nombre VARCHAR(200) NOT NULL,
        apellidos VARCHAR(200) NOT NULL,
        codigoCasa INT NOT NULL,
        edad INT NOT NULL,
        curso INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO Alumno VALUES (1, 'Alison Nicole', 'Robles Heredia', '1', '11', '1');
    INSERT INTO Alumno VALUES (2, 'Alejandro', 'Aragón Rodríguez', '2', '12', '2');
    INSERT INTO Alumno VALUES (3, 'Veronika', 'Hurtado Pérez', '4', '15', '5');
    INSERT INTO Alumno VALUES (4, 'Brunilda Nelly', 'Heredia Troncoso', '2', '13', '3');
    INSERT INTO Alumno VALUES (5, 'Maria Angélica', 'Saez', '3', '16', '6');


    CREATE TABLE Asignatura (
        codigoAsignatura INT,
        nombre VARCHAR(200),
        codigoProfesor INT NOT NULL,
        curso INT NOT NULL,
        tipo VARCHAR(20)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO Asignatura VALUES (1, 'Herbología', 6, 1, 'Obligatoria');
    INSERT INTO Asignatura VALUES (2, 'Pociones', 3, 1, 'Obligatoria');
    INSERT INTO Asignatura VALUES (3, 'Encantamientos', 7, 1, 'Obligatoria');
    INSERT INTO Asignatura VALUES (4, 'Defensa contra las artes oscuras', 4, 2, 'Obligatoria');
    INSERT INTO Asignatura VALUES (5, 'Historia de la magia', 8, 1, 'Obligatoria');
    INSERT INTO Asignatura VALUES (6, 'Astronomía', 9, 3, 'Obligatoria');
    INSERT INTO Asignatura VALUES (7, 'Transformaciones', 2, 1, 'Obligatoria');
    INSERT INTO Asignatura VALUES (8, 'Vuelo', 10, 1, 'Optativa');
    INSERT INTO Asignatura VALUES (9, 'Estudios Muggles', 11, 1, 'Optativa');
    INSERT INTO Asignatura VALUES (10, 'Cuidado de criaturas mágicas', 12, 3, 'Optativa');
    INSERT INTO Asignatura VALUES (11, 'Adivinación', 13, 3, 'Optativa');
    INSERT INTO Asignatura VALUES (12, 'Runas antiguas', 14, 4, 'Optativa');
    INSERT INTO Asignatura VALUES (13, 'Aritmancia', 15, 4, 'Optativa');

    CREATE TABLE Profesor (
        codigoProfesor INT,
        nombre VARCHAR(200),
        apellidos VARCHAR(200),
        edad INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO Profesor VALUES (1, 'Albus', 'Dumbledore', 80);
    INSERT INTO Profesor VALUES (2, 'Minerva', 'McGonagall', 83);
    INSERT INTO Profesor VALUES (3, 'Severus', 'Snape', 38);
    INSERT INTO Profesor VALUES (4, 'Remus', 'Lupin', 36);
    INSERT INTO Profesor VALUES (5, 'Horace', 'Slughorn', 64);
    INSERT INTO Profesor VALUES (6, 'Pomona', 'Sprout', 62);
    INSERT INTO Profesor VALUES (7, 'Filius', 'Flitwick', 44);
    INSERT INTO Profesor VALUES (8, 'Cuthbert', 'Binns', 112);
    INSERT INTO Profesor VALUES (9, 'Aurora', 'Sinistra', 36);
    INSERT INTO Profesor VALUES (10, 'Rolanda', 'Hooch', 84);
    INSERT INTO Profesor VALUES (11, 'Charity', 'Burbage', 28);
    INSERT INTO Profesor VALUES (12, 'Rubeus', 'Hagrid', 89);
    INSERT INTO Profesor VALUES (13, 'Sybill', 'Trelawney', 39);
    INSERT INTO Profesor VALUES (14, 'Bathsheda', 'Babbling', 44);
    INSERT INTO Profesor VALUES (15, 'Séptima', 'Vector', 41);

    CREATE TABLE Usuario ( 
        usuarioID INT, 
        usuario VARCHAR(100), 
        password VARCHAR(20), 
        email VARCHAR(100) 
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

    INSERT INTO Usuario VALUES (1, 'alison', '91703', 'sirena_555_11_@hotmail.com');
    INSERT INTO Usuario VALUES (2, 'root', '1234', 'root@gmail.com');

    CREATE TABLE Token (
        usuarioID INT,
        tokenID VARCHAR(200),
        fecha DATETIME,
        fechaExpiracion DATETIME
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE Alumno ADD CONSTRAINT Pk_Alumno PRIMARY KEY (codigoAlumno);
ALTER TABLE Casa ADD CONSTRAINT Pk_Casa PRIMARY KEY (codigoCasa);
ALTER TABLE Asignatura ADD CONSTRAINT Pk_Asignatura PRIMARY KEY (codigoAsignatura);
ALTER TABLE Profesor ADD CONSTRAINT Pk_Profesor PRIMARY KEY (codigoProfesor);
ALTER TABLE Usuario ADD CONSTRAINT Pk_Usuario PRIMARY KEY (usuarioID);
ALTER TABLE Token ADD CONSTRAINT Pk_Token PRIMARY KEY (tokenID);

ALTER TABLE Alumno ADD CONSTRAINT Fk_Casa1 FOREIGN KEY (codigoCasa) REFERENCES Casa(codigoCasa) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE Asignatura ADD CONSTRAINT Fk_Profesor1 FOREIGN KEY (codigoProfesor) REFERENCES Profesor(codigoProfesor) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Alumno MODIFY codigoAlumno INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
