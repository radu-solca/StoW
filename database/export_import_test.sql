BEGIN

csv_scripts.dump_table_to_csv('USERS','CSV','exported.csv');

END;
/

-- BEGIN

-- DBMS_OUTPUT.PUT_LINE(csv_scripts.load_table_from_csv('USERS','CSV','exported.csv'));

-- END;
-- /