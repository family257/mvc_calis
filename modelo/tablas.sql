CREATE TABLE enlaces(
    pk_enlaces INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(20) NOT NULL,
    ruta VARCHAR(100) NOT NULL,
    estado INT NOT NULL DEFAULT 1,
    hora TIME NOT NULL,
    fecha DATE NOT NULL
)

/* insertar datos en la tabla */
INSERT INTO enlaces (nombre, ruta, estado, hora, fecha) VALUES ("error", "vistas/modulos/404_notfound.php", 1, CURRENT_TIME, CURRENT_DATE)

CREATE TABLE persona(
    pk_persona INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    foto VARCHAR(100) NOT NULL,
    estado INT NOT NULL DEFAULT 1,
    hora TIME NOT NULL,
    fecha DATE NOT NULL
)

/* insertar datos en la tabla  persona*/
INSERT INTO persona (nombre, apellido, email, foto, estado, hora, fecha) VALUES ("Juan", "Perez", "juan@gmail.com", "vistas/img/juanperez.jpg", 1, CURRENT_TIME, CURRENT_DATE)

/* consulta SQL que devuelve el numero de campos de la tabla persona y el nombre de los campos de la tabla */
SELECT COUNT(*) AS numero_de_campos,
       GROUP_CONCAT(COLUMN_NAME) AS nombres_de_campos
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'mvc'
  AND TABLE_NAME = 'persona';