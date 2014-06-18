Query student information:
SELECT season_name, course_name, value_name, value_num
FROM  `table` 
LEFT JOIN  `seasons` ON  `seasons`.id =  `table`.season_id
LEFT JOIN  `course` ON  `course`.id =  `table`.course_id
LEFT JOIN  `values` ON  `values`.id =  `table`.value_id
WHERE  `table`.student_id =0
LIMIT 0 , 30
