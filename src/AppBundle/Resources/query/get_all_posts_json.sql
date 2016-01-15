SELECT array_to_json(array_agg(row_to_json(results)))
FROM (
SELECT
	post.id, post.create_date, post.content, post.title,
	(SELECT row_to_json(author)
	FROM (
	    SELECT
		person.*,
		(
		SELECT row_to_json(role)
		FROM (
			SELECT * FROM dictionary_item di WHERE di.id = person.role_id
		) AS role
		) AS role
	    FROM person WHERE person.id = post.author_id
	) as author) AS author,
	(
		SELECT row_to_json(category)
		FROM dictionary_item category WHERE category.id = post.category_id
	) as category,
	(
		SELECT array_to_json(array_agg(row_to_json(comments)))
		FROM (
			SELECT comment.title, comment.content, (
				SELECT row_to_json(comment_author)
				FROM (
					SELECT person.*, (
						SELECT row_to_json(role)
						FROM (
							SELECT *
							FROM dictionary_item di
							WHERE di.id = person.role_id
						) AS role
					) AS role
					FROM person
					WHERE person.id = comment.author_id
				) AS comment_author
			) AS author
			FROM comment where comment.post_id = post.id
		) AS comments
	) as comments
FROM post
) AS results