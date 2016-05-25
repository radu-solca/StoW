CREATE OR REPLACE PACKAGE usr_exceptions AS

    wrong_username EXCEPTION;
    PRAGMA EXCEPTION_INIT(wrong_username, -20001);

    wrong_password EXCEPTION;
    PRAGMA EXCEPTION_INIT(wrong_password, -20002);

    preexisting_username EXCEPTION;
    PRAGMA EXCEPTION_INIT(preexisting_username, -20003);

    preexisting_email EXCEPTION;
    PRAGMA EXCEPTION_INIT(preexisting_email, -20004);

    username_too_short EXCEPTION;
    PRAGMA EXCEPTION_INIT(preexisting_email, -20005);

    password_too_short EXCEPTION;
    PRAGMA EXCEPTION_INIT(preexisting_email, -20006);

    role_not_found EXCEPTION;
    PRAGMA EXCEPTION_INIT(role_not_found, -20007);

END usr_exceptions;
/

CREATE OR REPLACE PACKAGE usr_utils IS

	FUNCTION register 
	( 	
		p_username users.usr_username%type,
		p_password users.usr_password%type,
		p_email users.usr_email%type,
		p_name users.usr_name%type,
		p_surname users.usr_name%type
	)
	RETURN users.usr_id%type;

	FUNCTION login 
	( 	
		p_username users.usr_username%type,
		p_password users.usr_password%type
	)
	RETURN users.usr_id%type;

	FUNCTION usr_has_role
	(
		p_usr_id users.usr_id%type,
		p_role_name roles.role_name%type
	)
	RETURN INTEGER;

END usr_utils;
/

CREATE OR REPLACE PACKAGE BODY usr_utils IS
	
	FUNCTION register 
	( 	
		p_username users.usr_username%type,
		p_password users.usr_password%type,
		p_email users.usr_email%type,
		p_name users.usr_name%type,
		p_surname users.usr_name%type
	)
	RETURN users.usr_id%type 
	AS

		v_new_usr_id users.usr_id%type;
    BEGIN
    	INSERT INTO users 	(usr_username, usr_password, usr_email, usr_name, usr_surname)
    	VALUES	(p_username, p_password, p_email, p_name, p_surname);

    	SELECT usr_id
    	INTO v_new_usr_id
    	FROM users
    	WHERE usr_username = p_username;

    	RETURN v_new_usr_id;

    	EXCEPTION
		    WHEN OTHERS THEN
		    	CASE
		    		WHEN sqlerrm LIKE '%(STOW.USERS_UNQ_USR_USERNAME)%'
		    		THEN RAISE_APPLICATION_ERROR(-20003,'The username '||p_username||' is already in use');

		    		WHEN sqlerrm LIKE '%(STOW.USERS_UNQ_USR_EMAIL)%'
		    		THEN RAISE_APPLICATION_ERROR(-20004,'The email '||p_email||' is already in use');

		    		WHEN sqlerrm LIKE '%(STOW.USERS_USR_USERNAME_LEN)%'
		    		THEN RAISE_APPLICATION_ERROR(-20005,'The username must have at least 6 characters');

		    		WHEN sqlerrm LIKE '%(STOW.USERS_USR_PASSWORD_LEN)%'
		    		THEN RAISE_APPLICATION_ERROR(-20006,'The password must have at least 6 characters');

		    		ELSE RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
		    	END CASE;
    END;



    FUNCTION login 
	( 	
		p_username users.usr_username%type,
		p_password users.usr_password%type
	)
	RETURN users.usr_id%type
	AS
		v_usr_id users.usr_id%type;
		v_username_check INTEGER;
		v_password_check INTEGER;
    BEGIN

    	SELECT COUNT(*)
    	INTO v_username_check
    	FROM users
    	WHERE usr_username = p_username;

    	IF v_username_check = 0
    	THEN 
    		raise usr_exceptions.wrong_username;
    	END IF;
    	
    	SELECT usr_id
    	INTO v_usr_id
    	FROM users
    	WHERE usr_username = p_username
    	AND usr_password = p_password;

    	RETURN v_usr_id;

    	EXCEPTION
		    WHEN usr_exceptions.wrong_username 
		    THEN RAISE_APPLICATION_ERROR(-20001,'The username is incorrect');

		    WHEN no_data_found
		    THEN RAISE_APPLICATION_ERROR(-20002,'The password is incorrect');

		    WHEN OTHERS 
		    THEN RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
    END;



    FUNCTION usr_has_role
	(
		p_usr_id users.usr_id%type,
		p_role_name roles.role_name%type
	)
	RETURN INTEGER
	AS
		v_role_id NUMBER;
		v_success NUMBER;
	BEGIN

		SELECT role_id 
		INTO v_role_id
		FROM roles
		WHERE role_name = p_role_name;

		SELECT COUNT(*)
		INTO v_success
		FROM usr_role 
		WHERE usr_id = p_usr_id AND role_id = v_role_id;

		IF v_success >= 1
		THEN
			RETURN 1;
		ELSE
			RETURN -1;
		END IF;
	EXCEPTION
		WHEN NO_DATA_FOUND 
		THEN
			RAISE_APPLICATION_ERROR(-20007,'role not found');
	    	RETURN -1;
	    WHEN OTHERS 
		THEN
	        RAISE_APPLICATION_ERROR(-20099,'ERROR: '||SQLERRM);
	        RETURN -1;

	END usr_has_role;

END usr_utils;    
/
