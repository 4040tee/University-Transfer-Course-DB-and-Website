SHOW DATABASES;
DROP DATABASE tjabirassign2db;
CREATE DATABASE tjabirassign2db;
use tjabirassign2db;

GRANT USAGE ON *.* TO 'ta'@'localhost';
DROP USER 'ta'@'localhost';
CREATE USER 'ta'@'localhost' IDENTIFIED BY 'cs3319';
GRANT ALL PRIVILEGES ON tjabirassign2db.* TO 'ta'@'localhost';
FLUSH PRIVILEGES;

SHOW TABLES;
-- Create Tables
CREATE TABLE WesternCourses(CourseNumber CHAR(6) NOT NULL,CourseName VARCHAR(50) NOT NULL,Weight FLOAT NOT NULL,Suffix VARCHAR(3),PRIMARY KEY(CourseNumber));
CREATE TABLE Universities(UniversityName VARCHAR(50) NOT NULL,City VARCHAR(50) NOT NULL,ProvinceCode CHAR(2) NOT NULL,Nickname VARCHAR(20) NOT NULL,Number INT NOT NULL,PRIMARY KEY(Number));
CREATE TABLE OutsideCourses(CourseNumber CHAR(10) NOT NULL,CourseName VARCHAR(50) NOT NULL,UniversityNumber INT NOT NULL,Year INT NOT NULL,Weight FLOAT NOT NULL,PRIMARY KEY(CourseNumber,UniversityNumber),FOREIGN KEY(UniversityNumber) REFERENCES Universities(Number) ON DELETE CASCADE);
CREATE TABLE EqualTo(WesternCourse CHAR(6) NOT NULL, OutsideCourse CHAR(10) NOT NULL, OutsideUniversity INT NOT NULL, DecisionDate VARCHAR(20) NOT NULL,FOREIGN KEY(WesternCourse) REFERENCES WesternCourses(CourseNumber) ON DELETE CASCADE,FOREIGN KEY(OutsideCourse,OutsideUniversity) REFERENCES OutsideCourses(CourseNumber,UniversityNumber) ON DELETE CASCADE);
SHOW TABLES;
-- finished
