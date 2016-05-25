clear screen;

--FIND STORIES BY ID--
EXPLAIN PLAN
SET STATEMENT_ID = 'st_id_select' FOR 
	SELECT st_title 
	FROM stories 
	WHERE st_id=5;

SELECT * FROM TABLE (dbms_xplan.display);
-- SELECT PLAN_TABLE_OUTPUT
-- FROM TABLE(DBMS_XPLAN.DISPLAY(NULL, 'st_id_select','BASIC'));

--GET LATEST STORIES--
EXPLAIN PLAN
SET STATEMENT_ID = 'st_date_select' FOR 
	SELECT * FROM
	(
		SELECT st_title 
		FROM stories 
		ORDER BY st_date_added
	)
	WHERE rownum <= 50;
	
SELECT * FROM TABLE (dbms_xplan.display);

--USR USERNAME SEARCH--
EXPLAIN PLAN
SET STATEMENT_ID = 'usr_username_search' FOR 
	SELECT usr_id
	FROM users
	WHERE usr_username = 'user_50';

SELECT * FROM TABLE (dbms_xplan.display);

--USR USERNAME AND PASSWORD SEARCH--
EXPLAIN PLAN
SET STATEMENT_ID = 'usr_usrn_pswd_search' FOR 
	SELECT usr_id
	FROM users
	WHERE usr_name = 'user_50'
	AND usr_surname = 'user_50';

SELECT * FROM TABLE (dbms_xplan.display);

--SEARCH ON USER ROLES TABLE--
EXPLAIN PLAN
SET STATEMENT_ID = 'usr_role_check' FOR 
	SELECT COUNT(*)
	FROM usr_role 
	WHERE usr_id = 'user_50' AND role_id = 'admin';

SELECT * FROM TABLE (dbms_xplan.display);

