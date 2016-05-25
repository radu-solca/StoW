BEGIN
	DBMS_OUTPUT.PUT_LINE(
		st_scripts.insert_story(1,'gigi','gigi','gigi')
	);
END;
/

BEGIN
	DBMS_OUTPUT.PUT_LINE(
		st_scripts.insert_story(1,'gigi1','gigi1',NULL)
	);
END;
/

BEGIN
	DBMS_OUTPUT.PUT_LINE(
		st_scripts.insert_story(1,'gigi1','gigi',NULL)
	);
END;
/

BEGIN
	DBMS_OUTPUT.PUT_LINE(
		st_scripts.insert_story(10,'gigi10','gigi10',NULL)
	);
END;
/