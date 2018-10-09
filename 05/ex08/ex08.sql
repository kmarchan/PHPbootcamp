SELECT `last_name`, `first_name`, CAST(`birthdate` AS date) AS 'birthdate'
FROM db_kmarchan.user_card 
WHERE year(`birthdate`) = 1989
ORDER BY `last_name` ASC