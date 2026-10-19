CREATE DATABASE StudentHub;
USE StudentHub;
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);
CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL
);
CREATE TABLE registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    event_id INT,
    registration_date DATE,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id)
);
INSERT INTO students (name, email)
VALUES ('Rahul Patel', 'rahul@gmail.com');
INSERT INTO events (event_name, event_date)
VALUES ('Tech Fest', '2026-11-15');
INSERT INTO registrations (student_id, event_id, registration_date)
VALUES (1, 1, '2026-10-19');