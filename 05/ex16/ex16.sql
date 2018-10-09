SELECT COUNT(*) AS 'movies'
FROM `db_kmarchan`.`member_history`
WHERE DATE BETWEEN '10-30-2006' AND '07-27-2007'
OR (MONTH(DATE)) = 12 AND (DAY(DATE)) = 24