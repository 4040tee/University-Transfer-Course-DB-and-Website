use tjabirassign2db;
SELECT * FROM Universities;
-- Load Data from File
LOAD DATA LOCAL INFILE 'loaddatafall2020.txt' INTO TABLE Universities FIELDS TERMINATED BY ',' (Number,UniversityName,City,ProvinceCode,Nickname);
SELECT * FROM Universities;

SELECT * FROM WesternCourses;
-- Add Western Courses;
INSERT INTO WesternCourses VALUES('cs1026','Computer Science Fundamentals I',0.5,"A/B");
INSERT INTO WesternCourses VALUES('cs1027', 'Computer Science Fundamentals II', '0.5', "A/B");
INSERT INTO WesternCourses VALUES('cs2210', 'Algorithms and Data Structures', 1.0, "A/B");
INSERT INTO WesternCourses VALUES('cs3319', 'Databases I', 0.5, "A/B");
INSERT INTO WesternCourses VALUES('cs2120', 'Modern Survival Skills I: Coding Essentials', 0.5, "A/B");
INSERT INTO WesternCourses VALUES('cs4490', 'Thesis', 0.5, "Z");
INSERT INTO WesternCourses VALUES('cs0020', 'Intro to Coding using Pascal and Fortran', 1.0,'');
SELECT * FROM WesternCourses;

-- Add Fictitious University;
INSERT INTO Universities VALUES('Hogwarts','Toronto','ON','HW','0');
SELECT * FROM Universities;

SELECT * FROM OutsideCourses;
-- Add Outside Courses;
-- -Courses at UofT: 2
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci022', 'Introduction to Programming', 1, 0.5, 2);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci033', 'Intro to Programming for Med students', 3, 0.5,2);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci021', 'Packages', 1, 0.5,2);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci222', 'Introduction to Databases', 2, 1.0,2);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci023', 'Advanced Programming', 1, 0.5,2);
-- -Courses at Waterloo: 4
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci011', 'Intro to Computer Science', 2, 0.5,4);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci123', 'Using UNIX', 2, 0.5,4);
-- -Courses at UBC: 66
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci021', 'Intro Programming', 1, 1.0,66);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci022', 'Advanced Programming', 1, 0.5,66);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci319', 'Using Databases', 3, 0.5,66);
-- -Courses at Mac: 55
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci333', 'Graphics', 3, 0.5,55);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci444', 'Networks', 4, 0.5,55);
-- -Courses at Laurier: 77
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci022', 'Using Packages', 1, 0.5,77);
INSERT INTO OutsideCourses(CourseNumber,CourseName,Year,Weight,UniversityNumber) VALUES('CompSci101', 'Introduction to Using Data Structures', 2, 0.5,77);
-- -Courses at Fake University:
INSERT INTO OutsideCourses VALUES('CompSci999','How to light a computer on fire',0,4,0.5);
INSERT INTO OutsideCourses VALUES('CompSci998','How to put out a fire',0,4,0.5);
SELECT * FROM OutsideCourses;

SELECT * FROM EqualTo;
-- Add Equivalences;
INSERT INTO EqualTo Values('cs1026','CompSci022',2,'2015-05-12');
INSERT INTO EqualTo Values('cs1026','CompSci033',2,'2013-01-02');
INSERT INTO EqualTo Values('cs1026','CompSci011',4,'1997-02-09');
INSERT INTO EqualTo Values('cs1026','CompSci021',66,'2010-01-12');
INSERT INTO EqualTo Values('cs1027','CompSci023',2,'2017-06-22');
INSERT INTO EqualTo Values('cs1027','CompSci022',66,'2019-09-01');
INSERT INTO EqualTo Values('cs2210','CompSci101',77,'1998-07-12');
INSERT INTO EqualTo Values('cs3319','CompSci222',2,'1990-09-13');
INSERT INTO EqualTo Values('cs3319','CompSci319',66,'1987-09-21');
INSERT INTO EqualTo Values('cs2120','CompSci022',2,'2018-12-10');
INSERT INTO EqualTo Values('cs0020','CompSci022',2,'1999-09-17');
SELECT * FROM EqualTo;

SELECT * FROM EqualTo;
UPDATE EqualTo SET DecisionDate='2018-09-19' WHERE WesternCourse='cs0020' AND OutsideCourse='Compsci022' AND OutsideUniversity=2;
SELECT * FROM EqualTo;

SELECT * FROM OutsideCourses;
UPDATE OutsideCourses SET Year=1 WHERE CourseName LIKE "Intro%";
SELECT * FROM OutsideCourses;
-- finished


