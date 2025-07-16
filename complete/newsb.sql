-- phpMyAdmin SQL Dump
-- Version: Compatible with XAMPP, MariaDB
-- Database: online_learning

DROP DATABASE IF EXISTS online_learning;
CREATE DATABASE online_learning;
USE online_learning;

-- -----------------------------
-- Table: users
-- -----------------------------
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  role ENUM('student', 'instructor') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert demo users
INSERT INTO users (username, password, role) VALUES
('thy', '123', 'instructor'),
('shimiu', '123', 'student');

-- -----------------------------
-- Table: courses
-- -----------------------------
CREATE TABLE courses (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  video VARCHAR(255) DEFAULT NULL,
  document VARCHAR(255) DEFAULT NULL,
  instructor_id INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (instructor_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------
-- Table: subscriptions
-- -----------------------------
CREATE TABLE subscriptions (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) DEFAULT NULL,
  course_id INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (course_id) REFERENCES courses(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
