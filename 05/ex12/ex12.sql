SELECT last_name, first_name 
    FROM `db_kmarchan`.`user_card`
    INNER JOIN db_kmarchan.member ON user_card.id_user=member.member_id 
    WHERE `last_name` LIKE '%-%' OR `first_name` LIKE '%-%' 
    ORDER BY `last_name` ASC, `first_name`; 
