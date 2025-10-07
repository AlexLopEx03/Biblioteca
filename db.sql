DROP DATABASE IF EXISTS biblioteca;

CREATE DATABASE IF NOT EXISTS biblioteca;

USE biblioteca;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_email VARCHAR(255) UNIQUE NOT NULL,
    user_name VARCHAR(20) UNIQUE NOT NULL,
    user_password VARCHAR(64) NOT NULL
);

CREATE TABLE books(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,

    title VARCHAR(50) NOT NULL,
    description VARCHAR(200),
    author VARCHAR(40),
    image VARCHAR(200) DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/3/36/Open_bible_01_01.svg',
    category VARCHAR(40),
    url VARCHAR(255),
    year YEAR DEFAULT,

    CONSTRAINT boo_id_fk FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Example data

INSERT INTO users (user_email, user_name, user_password)
VALUES 
    ('example@example.es', 'example', '12345678'),
    ('paco@example.es', 'paco', '12345678')
;

INSERT INTO books (user_id, title, description, author, category, url, year)
VALUES
    (1, 'Introducción a MySQL', 'Guía práctica para principiantes sobre el uso de MySQL y bases de datos relacionales.', 'Carlos Pérez', 'Bases de datos', 'https://example.com/mysql', 2021),
    (1, 'Python para Todos', 'Manual completo para aprender Python desde cero.', 'Laura Fernández', 'Programación', 'https://example.com/python', 2020),
    (2, 'Algoritmos Modernos', 'Análisis detallado de algoritmos eficientes y estructuras de datos avanzadas.', 'Robert Sedgewick', 'Informática', 'https://example.com/algoritmos', 2019),
    (2, 'Diseño de Software', 'Buenas prácticas de diseño y patrones de arquitectura.', 'Martin Fowler', 'Ingeniería de software', 'https://example.com/diseno', 2022)
;