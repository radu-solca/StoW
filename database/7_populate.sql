DECLARE
	v_usr_count INTEGER := 500;
	v_st_count INTEGER := 500;
BEGIN
	
	DELETE FROM USR_ROLE WHERE 1=1;

	DELETE FROM STORIES WHERE 1=1;
	DELETE FROM USERS WHERE 1=1;
	
	DELETE FROM ROLES WHERE 1=1;
	DELETE FROM CATEGORIES WHERE 1=1;


	insert into users (usr_username, usr_password, usr_email, usr_name, usr_surname)
		
			select 	'user_'||rownum, 
					'user_'||rownum, 
					'user_'||rownum||'@example.com',
					'John',
					'Smith'||rownum
			from dual
		
	connect by rownum<=v_usr_count;


	insert into stories (st_title, st_content, st_cover)
		
			select 	'story_'||rownum, 
					'stories/'||rownum||'/content.xml',
					'stories/'||rownum||'/cover.jpg'
			from dual
		
	connect by rownum<=v_st_count;

	--Categories--
	INSERT ALL
	   INTO categories (cat_type, cat_name) VALUES ('approval', 'pending')
	   INTO categories (cat_type, cat_name) VALUES ('approval', 'approved')

	   INTO categories (cat_type, cat_name) VALUES ('age_group', '0-3')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '3-5')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '5-7')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '7-12')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '12-15')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '15-18')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '18+')

	   INTO categories (cat_type, cat_name) VALUES ('genre', 'horror')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fiction')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fantasy')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fairy-tale')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'porno')
	SELECT 1 FROM DUAL;

	--Roles--
	INSERT ALL
	   INTO roles (role_name) VALUES ('admin')
	SELECT 1 FROM DUAL;

	--USR-ROLE--
	INSERT ALL
		INTO usr_role (usr_id,role_id) VALUES (1,1)
	SELECT 1 FROM DUAL;

	INSERT ALL
		INTO st_cat VALUES (1,1)
		INTO st_cat VALUES (2,1)
		INTO st_cat VALUES (3,1)
		INTO st_cat VALUES (4,2)
		INTO st_cat VALUES (5,1)
		INTO st_cat VALUES (6,1)
		INTO st_cat VALUES (7,2)
		INTO st_cat VALUES (8,1)
		INTO st_cat VALUES (9,2)
		INTO st_cat VALUES (10,1)

		INTO st_cat VALUES (1,5)
		INTO st_cat VALUES (1,3)
		INTO st_cat VALUES (1,4)
		INTO st_cat VALUES (1,10)
		INTO st_cat VALUES (1,11)
		INTO st_cat VALUES (1,14)

		INTO st_cat VALUES (2,5)
		INTO st_cat VALUES (2,3)
		INTO st_cat VALUES (2,4)
		INTO st_cat VALUES (2,10)
		INTO st_cat VALUES (2,11)
		INTO st_cat VALUES (2,14)

		INTO st_cat VALUES (3,5)
		INTO st_cat VALUES (3,3)
		INTO st_cat VALUES (3,4)
		INTO st_cat VALUES (3,10)
		INTO st_cat VALUES (3,11)
		INTO st_cat VALUES (3,14)
	SELECT 1 FROM DUAL;

	INSERT ALL
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigi','chars/gigi.xml')
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigielu','chars/gigi.xml')
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigicu','chars/gigi.xml')
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigiceanu','chars/gigi.xml')
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigicanosul','chars/gigi.xml')
		INTO characters (st_id, chr_name, chr_desc) VALUES (1,'gigianu','chars/gigi.xml')
	SELECT 1 FROM DUAL;

	COMMIT;
END;
/