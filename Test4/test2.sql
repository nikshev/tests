SELECT students.id, students.first_name, students.last_name, majors.major_name
FROM students
JOIN majors ON majors.id = students.major
LIMIT 0 , 30
