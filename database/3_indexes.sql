DROP INDEX st_date_index;
DROP INDEX usr_usrn_pswd;

CREATE INDEX st_date_index ON stories(st_date_added);

CREATE INDEX usr_name_surname ON users(usr_name, usr_surname);

