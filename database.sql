CREATE DATABASE IF NOT EXISTS db_todo;
USE db_todo;

DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meno VARCHAR(100) NOT NULL,
    heslo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nazov VARCHAR(255) NOT NULL,
    popis TEXT,
    stav ENUM('nova', 'hotova') DEFAULT 'nova',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (meno, heslo) VALUES
('tobias', '1234'),
('samuel', 'abcd');

INSERT INTO tasks (user_id, nazov, popis, stav) VALUES
(1, 'Dokoncit PHP projekt', 'Spravit CRUD operacie pre todo list', 'nova'),
(1, 'Pripravit README', 'Dopisat popis projektu na GitHub', 'hotova'),
(2, 'Otestovat aplikaciu', 'Skusit pridanie, edit a zmazanie ulohy', 'nova');
