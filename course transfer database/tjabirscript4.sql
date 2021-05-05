-- Deletions / Views
use tjabirassign2db
-- Create view
CREATE VIEW VIEW AS SELECT WesternCourses.CourseName AS WesternCourseName,OutsideCourses.CourseName AS OutsideCourseName,UniversityName,Nickname,City FROM EqualTo,WesternCourses,OutsideCourses,Universities WHERE OutsideCourse=OutsideCourses.CourseNumber AND OutsideUniversity=OutsideCourses.UniversityNumber AND OutsideUniversity=Universities.Number AND OutsideCourses.Year=1 AND WesternCourse=WesternCourses.CourseNumber;  
SELECT * FROM VIEW;
SELECT * FROM VIEW WHERE Nickname='UofT' ORDER BY WesternCourseName;
-- Delete from universities
SELECT * FROM Universities;
DELETE FROM Universities WHERE Nickname LIKE '%cord%';
SELECT * FROM Universities;
-- I am able to delete all universities from Ontario using: DELETE FROM Universities WHERE ProvinceCode='ON'
-- I haven't executed the delete because it will remove almost all the items from the database
-- Also, Western, an Ontario university, cannot be removed except by emptying or deleting the database
-- ----------------
-- Delete OutsideCourses in the city of Waterloo
SELECT * FROM OutsideCourses,Universities WHERE OutsideCourses.UniversityNumber = Universities.Number;
DELETE FROM OutsideCourses WHERE UniversityNumber IN(SELECT Number FROM Universities WHERE City='Waterloo');
SELECT * FROM OutsideCourses,Universities WHERE OutsideCourses.UniversityNumber = Universities.Number;
-- View once again
SELECT * FROM VIEW;
-- finished

