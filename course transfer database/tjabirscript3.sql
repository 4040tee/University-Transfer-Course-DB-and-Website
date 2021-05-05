-- Queries
use tjabirassign2db
-- Query 1
SELECT * FROM WesternCourses;
-- Query 2
SELECT CourseNumber FROM OutsideCourses GROUP BY CourseNumber;
-- Query 3
SELECT * FROM WesternCourses ORDER BY CourseName;
-- Query 4
SELECT CourseNumber,CourseName FROM WesternCourses WHERE Weight=0.5;
-- Query 5
SELECT CourseNumber,CourseName FROM OutsideCourses,Universities WHERE OutsideCourses.UniversityNumber=Universities.Number and UniversityName = 'University of Toronto'; 
-- Query 6
SELECT CourseName,Nickname FROM OutsideCourses,Universities WHERE OutsideCourses.UniversityNumber = Universities.Number AND CourseName LIKE '%Introduction%';
-- Query 7
SELECT * FROM EqualTo WHERE DecisionDate > NOW() - INTERVAL 5 YEAR;
-- Query 8
SELECT CourseName,Nickname FROM WesternCourses,EqualTo,Universities WHERE WesternCourse = 'cs1026' AND WesternCourse=CourseNumber AND EqualTo.OutsideUniversity=Universities.Number;
-- Query 9
SELECT COUNT(WesternCourse) AS CS1026Count FROM EqualTo WHERE WesternCourse='cs1026';
-- Query 10
SELECT WesternCourses.CourseName AS WesternCourse,OutsideCourses.CourseName AS OutsideCourse,Nickname FROM EqualTo,WesternCourses,OutsideCourses,Universities WHERE OutsideUniversity=4 AND WesternCourse = WesternCourses.CourseNumber AND OutsideCourse=OutsideCourses.CourseNumber AND OutsideUniversity=Universities.Number;
-- Query 11
SELECT UniversityName FROM Universities WHERE Number NOT IN(SELECT OutsideUniversity FROM EqualTo);
-- Query 12
SELECT CourseName,CourseNumber FROM WesternCourses,EqualTo WHERE WesternCourse=CourseNumber AND OutsideCourse IN(SELECT CourseNumber FROM OutsideCourses WHERE Year>2);
-- Query 13
SELECT WesternCourse,CourseName FROM WesternCourses,EqualTo WHERE WesternCourse=CourseNumber AND  WesternCourse IN(SELECT WesternCourse FROM EqualTo GROUP BY WesternCourse HAVING COUNT(WesternCourse)>1) GROUP BY WesternCourse;
-- Query 14
SELECT WesternCourses.CourseName AS WesternCourseName,WesternCourses.CourseNumber AS WesternCourseNumber,WesternCourses.Weight AS WesternCourseWeight,OutsideCourses.CourseName AS OutsideCourseName,UniversityName AS OutsideCourseUniversity,OutsideCourses.Weight AS OutsideCourseWeight FROM Universities,WesternCourses,OutsideCourses,EqualTo WHERE WesternCourse=WesternCourses.CourseNumber AND OutsideCourse=OutsideCourses.CourseNumber AND OutsideUniversity=OutsideCourses.UniversityNumber AND OutsideCourses.UniversityNumber = Universities.Number AND WesternCourses.Weight!=OutsideCourses.Weight;
-- finished



