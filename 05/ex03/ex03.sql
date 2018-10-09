INSERT INTO ft_table (`login`, `grup`, `creation_date`)
	SELECT last_name AS login, birthdate AS creation_date, 'other' AS grup
	FROM user_card
	WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
	ORDER BY last_name
	LIMIT 10