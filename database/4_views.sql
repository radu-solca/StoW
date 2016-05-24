CREATE OR REPLACE VIEW stories_with_ratings AS
	SELECT 	s.st_id		 		AS "ID", 
			s.st_title	 		AS "TITLE", 
			s.st_content	 	AS "CONTENT", 
			s.st_cover	 		AS "COVER", 
			s.st_date_added	 	AS "DATE_ADDED", 
			AVG(r.rat_value) 	AS "RATING"
	FROM stories s
	LEFT OUTER JOIN ratings r ON s.st_id = r.st_id
	GROUP BY s.st_id, s.st_title, s.st_content, s.st_cover, s.st_date_added
/


CREATE OR REPLACE VIEW categories_view AS
	SELECT s.st_id, c.cat_type, c.cat_name 
	FROM stories s 
	JOIN st_cat sc ON s.st_id = sc.st_id
	JOIN categories c ON sc.cat_id = c.cat_id
	ORDER BY s.st_id;

CREATE OR REPLACE TRIGGER categories_view_insert 
INSTEAD OF INSERT
ON categories_view
FOR EACH ROW
DECLARE

	v_cat_id categories.cat_id%type;
BEGIN
	SELECT c.cat_id
	INTO v_cat_id
	FROM categories c
	WHERE :new.cat_type = c.cat_type
	AND :new.cat_name = c.cat_name;

	INSERT INTO st_cat VALUES (:new.st_id, v_cat_id);
EXCEPTION
	WHEN OTHERS THEN 
		CASE
    		WHEN sqlerrm LIKE '%(STOW.ST_CAT_FK_ST_ID)%'
    		THEN RAISE_APPLICATION_ERROR(-20001,'There is no story with that ID');

    		WHEN sqlerrm LIKE '%(STOW.ST_CAT_PK_CAT_ID_ST_ID)%'
    		THEN RAISE_APPLICATION_ERROR(-20002,'This story already is in that category');

    		WHEN sqlerrm LIKE '%no data found%'
    		THEN RAISE_APPLICATION_ERROR(-20003,'Inexistent cat_type or cat_name');

    		ELSE RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
    	END CASE;
	
END;
/


CREATE OR REPLACE VIEW characters_view AS
	SELECT s.st_id, c.chr_name, c.chr_desc 
	FROM stories s 
	JOIN characters c ON s.st_id = c.st_id
	ORDER BY s.st_id;