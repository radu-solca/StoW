DECLARE
	v_usr_count INTEGER := 50;
	v_st_count INTEGER := 50;
BEGIN
	
	DELETE FROM USR_ROLE WHERE 1=1;

	DELETE FROM STORIES WHERE 1=1;
	DELETE FROM USERS WHERE 1=1;
	
	DELETE FROM ROLES WHERE 1=1;
	DELETE FROM CATEGORIES WHERE 1=1;

	--Users--
	INSERT ALL
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','superadmin@test.com',null,null)

	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('radu.solca','21232f297a57a5a743894a0e4a801fc3','admin1@test.com','Radu','Solca')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('cristian.ionesi','21232f297a57a5a743894a0e4a801fc3','admin2@test.com','Cristi','Ionesi')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('bogdan.ciobanu','21232f297a57a5a743894a0e4a801fc3','admin3@test.com','Bogdan','Ciobanu')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('elena.chiosa','21232f297a57a5a743894a0e4a801fc3','admin4@test.com','Teo','Chiosa')

	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('bugs.bunny','21232f297a57a5a743894a0e4a801fc3','user1@test.com','Bugs','Bunny')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('jerry.mouse','21232f297a57a5a743894a0e4a801fc3','user2@test.com','Jerry','Mouse')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('donald.duck','21232f297a57a5a743894a0e4a801fc3','user3@test.com','Donald','Duck')
	   INTO users (usr_username, usr_password, usr_email, usr_name, usr_surname) VALUES ('tom.cat','21232f297a57a5a743894a0e4a801fc3','user4@test.com','Thomas','Cat')
	SELECT 1 FROM DUAL;

	insert into users (usr_username, usr_password, usr_email, usr_name, usr_surname)
		
			select 	'johnS_'||rownum, 
					'21232f297a57a5a743894a0e4a801fc3', 
					'js_'||rownum||'@example.com',
					'John',
					'Smith'
			from dual
		
	connect by rownum<=v_usr_count;

	--Roles--
	INSERT ALL
	   INTO roles (role_name) VALUES ('admin')
	SELECT 1 FROM DUAL;

	--USR-ROLE--
	INSERT ALL
		--super-admins--
		INTO usr_role (usr_id,role_id) VALUES (1,1)

		--admins--
		INTO usr_role (usr_id,role_id) VALUES (2,1)
		INTO usr_role (usr_id,role_id) VALUES (3,1)
		INTO usr_role (usr_id,role_id) VALUES (4,1)
		INTO usr_role (usr_id,role_id) VALUES (5,1)
	SELECT 1 FROM DUAL;



	INSERT ALL
	   INTO stories (st_title, st_content, st_cover) VALUES ('Little Red Riding Hood', '../stories/LittleRedRidingHood', '../stories/LittleRedRidingHood/images/cover.jpg')
	   INTO stories (st_title, st_content, st_cover) VALUES ('The Little Mermaid', '../stories/TheLittleMermaid', '../stories/TheLittleMermaid/images/cover.jpg')
	   INTO stories (st_title, st_content, st_cover) VALUES ('The Boy Who Cried Wolf', '../stories/TheBoyWhoCriedWolf', '../stories/TheBoyWhoCriedWolf/images/cover.jpg')
	   INTO stories (st_title, st_content, st_cover) VALUES ('Alladin', '../stories/Alladin', '../stories/Alladin/images/cover.jpg')
	   INTO stories (st_title, st_content, st_cover) VALUES ('Ali baba and the Forty Thieves', '../stories/AliBabaAndTheFortyThieves', '../stories/AliBabaAndTheFortyThieves/images/cover.jpg')
	SELECT 1 FROM DUAL;

	insert into stories (st_title, st_content, st_cover)
		
			select 	rownum || ' story', 
					'placeholder',
					'placeholder'
			from dual
		
	connect by rownum<=v_st_count;

	--Categories--
	INSERT ALL
	   INTO categories (cat_type, cat_name) VALUES ('approval', 'pending')
	   INTO categories (cat_type, cat_name) VALUES ('approval', 'approved')

	   INTO categories (cat_type, cat_name) VALUES ('age_group', '3+')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '5+')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '7+')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '12+')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '15+')
	   INTO categories (cat_type, cat_name) VALUES ('age_group', '18+')

	   INTO categories (cat_type, cat_name) VALUES ('genre', 'drama')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'classic')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'comic')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'crime')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fable')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fairy tale')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'biography')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'autobiography')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'memoir')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'fantasy')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'folklore')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'historical')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'poetry')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'horror')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'legend')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'mystery')
	   INTO categories (cat_type, cat_name) VALUES ('genre', 'mythology')
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
		INTO st_cat VALUES (1,13)

		INTO st_cat VALUES (2,5)
		INTO st_cat VALUES (2,3)
		INTO st_cat VALUES (2,4)
		INTO st_cat VALUES (2,10)
		INTO st_cat VALUES (2,11)
		INTO st_cat VALUES (2,13)

		INTO st_cat VALUES (3,5)
		INTO st_cat VALUES (3,3)
		INTO st_cat VALUES (3,4)
		INTO st_cat VALUES (3,10)
		INTO st_cat VALUES (3,11)
		INTO st_cat VALUES (3,13)
	SELECT 1 FROM DUAL;

	INSERT ALL
		INTO ratings VALUES (1,1,5)
		INTO ratings VALUES (1,2,5)
		INTO ratings VALUES (5,3,4)
		INTO ratings VALUES (3,3,5)
		INTO ratings VALUES (2,4,3)
		INTO ratings VALUES (3,5,2)
	SELECT 1 FROM DUAL;


	-- INSERT ALL
	--    INTO comments (usr_id, st_id, cmt_content) VALUES (1, 1, 'nice story')
	--    INTO comments (usr_id, st_id, cmt_content) VALUES (1, 1, '10/10')
	--    INTO comments (usr_id, st_id, cmt_content) VALUES (2, 1, 'Hitler brought people together')
	--    INTO comments (usr_id, st_id, cmt_content) VALUES (5, 1, 'Anusii sunt scumpi')
	--    INTO comments (usr_id, st_id, cmt_content) VALUES (6, 1, 'Whats up doc?')
	-- SELECT 1 FROM DUAL;

	COMMIT;
END;
/