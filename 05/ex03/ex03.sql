INSERT INTO ft_table (`login`, `creation_date`, `grup`)
	SELECT last_name AS login, birthdate AS creation_date, 'other' AS grup
	FROM db_kmarchan.user_card
	WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
	ORDER BY last_name
	LIMIT 10