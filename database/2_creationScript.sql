DROP TABLE favourites;
DROP TABLE bookmarks;
DROP TABLE comments;
DROP TABLE ratings;

DROP TABLE st_cat;
DROP TABLE characters;
DROP TABLE stories;
DROP TABLE categories;

DROP TABLE usr_role;
DROP TABLE users;
DROP TABLE roles;

-----------
--STORIES--
-----------
CREATE TABLE stories(
	st_id NUMBER(10) NOT NULL,
	st_title VARCHAR2(32) NOT NULL,
	st_content VARCHAR2(2083) NOT NULL, 
	--^URL
	st_cover VARCHAR2(2083),
	--^URL
	st_date_added DATE NOT NULL,
	CONSTRAINT stories_pk_st_id PRIMARY KEY (st_id),
	CONSTRAINT stories_unq_st_title UNIQUE (st_title)
);

--auto-increment on st_id--
DROP SEQUENCE stories_id_seq;
CREATE SEQUENCE stories_id_seq;

CREATE OR REPLACE TRIGGER stories_id_auto_inc
BEFORE INSERT ON stories 
FOR EACH ROW
BEGIN
  SELECT stories_id_seq.NEXTVAL
  INTO   :new.st_id
  FROM   dual;
END;
/

--auto-completion for st_date_added--
CREATE OR REPLACE TRIGGER stories_date_added
BEFORE INSERT ON stories 
FOR EACH ROW
BEGIN
  SELECT sysdate
  INTO   :new.st_date_added
  FROM   dual;
END;
/



-----------------------
--STORIES::CATEGORIES--
-----------------------
CREATE TABLE categories(
	cat_id NUMBER(10) NOT NULL,
	cat_type VARCHAR2(32) NOT NULL,
	cat_name VARCHAR2(32) NOT NULL,
	CONSTRAINT categories_pk_cat_id PRIMARY KEY (cat_id),
	CONSTRAINT categories_unq_type_name UNIQUE (cat_type,cat_name)
);

--auto-increment on cat_id--
DROP SEQUENCE categories_id_seq;
CREATE SEQUENCE categories_id_seq;

CREATE OR REPLACE TRIGGER categories_id_auto_inc
BEFORE INSERT ON categories 
FOR EACH ROW
BEGIN
  SELECT categories_id_seq.NEXTVAL
  INTO   :new.cat_id
  FROM   dual;
END;
/



-------------------
--STORIES::ST_CAT--
-------------------
CREATE TABLE st_cat(
	st_id NUMBER(10) NOT NULL,
	cat_id NUMBER(10) NOT NULL,
	CONSTRAINT st_cat_pk_cat_id_st_id PRIMARY KEY (st_id, cat_id),
	CONSTRAINT st_cat_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id),
	CONSTRAINT st_cat_fk_cat_id FOREIGN KEY (cat_id) REFERENCES categories (cat_id)
);

-----------------------
--STORIES::CHARACTERS--
-----------------------
CREATE TABLE characters(
	chr_id NUMBER(10) NOT NULL,
	st_id NUMBER(10) NOT NULL,
	chr_name VARCHAR2(32),
	chr_desc VARCHAR2(2083) NOT NULL,
	CONSTRAINT chr_pk_chr_id PRIMARY KEY (chr_id),
	CONSTRAINT chr_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id),
	CONSTRAINT chr_unq_st_name UNIQUE (st_id, chr_name)
);


--auto-increment on chr_id--
DROP SEQUENCE characters_id_seq;
CREATE SEQUENCE characters_id_seq;

CREATE OR REPLACE TRIGGER characters_id_auto_inc
BEFORE INSERT ON characters 
FOR EACH ROW
BEGIN
  SELECT characters_id_seq.NEXTVAL
  INTO   :new.chr_id
  FROM   dual;
END;
/

---------
--USERS--
---------
CREATE TABLE users(
	usr_id NUMBER(10) NOT NULL,
	usr_username VARCHAR2(32) NOT NULL,
	usr_password VARCHAR2(32) NOT NULL,
	usr_email VARCHAR2(255) NOT NULL,
	usr_name VARCHAR2(32),
	usr_surname VARCHAR2(32),
	CONSTRAINT users_pk_usr_id PRIMARY KEY (usr_id),
	CONSTRAINT users_unq_usr_username UNIQUE (usr_username),
	CONSTRAINT users_unq_usr_email UNIQUE (usr_email),
	CONSTRAINT users_usr_username_len CHECK (LENGTH(usr_username)>=3),
	CONSTRAINT users_usr_password_len CHECK (LENGTH(usr_password)>=6)
);


--auto-increment on usr_id--
DROP SEQUENCE users_id_seq;
CREATE SEQUENCE users_id_seq;

CREATE OR REPLACE TRIGGER users_id_auto_inc
BEFORE INSERT ON users 
FOR EACH ROW
BEGIN
  SELECT users_id_seq.NEXTVAL
  INTO   :new.usr_id
  FROM   dual;
END;
/


----------------
--USERS::ROLES--
----------------
CREATE TABLE roles(
	role_id NUMBER(10) NOT NULL,
	role_name VARCHAR2(32) NOT NULL,
	CONSTRAINT roles_pk_role_id PRIMARY KEY (role_id),
	CONSTRAINT roles_unq_role_name UNIQUE (role_name)
);


--auto-increment on role_id--
DROP SEQUENCE roles_id_seq;
CREATE SEQUENCE roles_id_seq;

CREATE OR REPLACE TRIGGER roles_id_auto_inc
BEFORE INSERT ON roles 
FOR EACH ROW
BEGIN
  SELECT roles_id_seq.NEXTVAL
  INTO   :new.role_id
  FROM   dual;
END;
/

-------------------
--USERS::USR_ROLE--
-------------------
CREATE TABLE usr_role(
	usr_id NUMBER(10) NOT NULL,
	role_id NUMBER(10) NOT NULL,
	CONSTRAINT usr_role_pk_usr_id_role_id PRIMARY KEY (usr_id, role_id),
	CONSTRAINT usr_role_fk_usr_id FOREIGN KEY (usr_id) REFERENCES users (usr_id),
	CONSTRAINT usr_role_fk_role_id FOREIGN KEY (role_id) REFERENCES roles (role_id)
);

-----------------
--USERSxSTORIES--
-----------------
CREATE TABLE favourites(
	usr_id NUMBER(10) NOT NULL,
	st_id NUMBER(10) NOT NULL,
	CONSTRAINT favs_pk_usr_id_st_id PRIMARY KEY (usr_id, st_id),
	CONSTRAINT favs_fk_usr_id FOREIGN KEY (usr_id) REFERENCES users (usr_id),
	CONSTRAINT favs_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id)
);

CREATE TABLE bookmarks(
	usr_id NUMBER(10) NOT NULL,
	st_id NUMBER(10) NOT NULL,
	page_id VARCHAR(32) NOT NULL,
	CONSTRAINT bkmarks_pk_usr_id_st_id PRIMARY KEY (usr_id, st_id),
	CONSTRAINT bkmarks_fk_usr_id FOREIGN KEY (usr_id) REFERENCES users (usr_id),
	CONSTRAINT bkmarks_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id)
);

CREATE TABLE comments(
	cmt_id NUMBER(10) NOT NULL,
	usr_id NUMBER(10) NOT NULL,
	st_id NUMBER(10) NOT NULL,
	cmt_content VARCHAR2(256) NOT NULL,
	cmt_date_added DATE NOT NULL,
	CONSTRAINT comments_pk_cmt_id PRIMARY KEY (cmt_id),
	CONSTRAINT comments_fk_usr_id FOREIGN KEY (usr_id) REFERENCES users (usr_id),
	CONSTRAINT comments_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id)
);

--auto-increment on cmt_id--
DROP SEQUENCE comments_id_seq;
CREATE SEQUENCE comments_id_seq;

CREATE OR REPLACE TRIGGER comments_id_auto_inc
BEFORE INSERT ON comments 
FOR EACH ROW
BEGIN
  SELECT roles_id_seq.NEXTVAL
  INTO   :new.cmt_id
  FROM   dual;
END;
/

--auto-completion for cmt_date_added--
CREATE OR REPLACE TRIGGER comments_date_added
BEFORE INSERT ON comments 
FOR EACH ROW
BEGIN
  SELECT sysdate
  INTO   :new.cmt_date_added
  FROM   dual;
END;
/

CREATE TABLE ratings(
	usr_id NUMBER(10) NOT NULL,
	st_id NUMBER(10) NOT NULL,
	rat_value NUMBER(1) NOT NULL,
	CONSTRAINT ratings_pk_usr_id_st_id PRIMARY KEY (usr_id, st_id),
	CONSTRAINT ratings_fk_usr_id FOREIGN KEY (usr_id) REFERENCES users (usr_id),
	CONSTRAINT ratings_fk_st_id FOREIGN KEY (st_id) REFERENCES stories (st_id),
	CONSTRAINT ratings_val_check CHECK ((rat_value >= 1) AND (rat_value <= 5))
);

----------------------
--ON DELETE TRIGGERS--
----------------------

CREATE OR REPLACE TRIGGER stories_delete
BEFORE DELETE
   ON stories
   FOR EACH ROW
DECLARE
BEGIN
	DELETE FROM st_cat
	WHERE st_id = :old.st_id;

	DELETE FROM characters
	WHERE st_id = :old.st_id;

	DELETE FROM favourites
	WHERE st_id = :old.st_id;

	DELETE FROM bookmarks
	WHERE st_id = :old.st_id;

	DELETE FROM comments
	WHERE st_id = :old.st_id;

	DELETE FROM ratings
	WHERE st_id = :old.st_id;
END;
/

CREATE OR REPLACE TRIGGER categories_delete
BEFORE DELETE
   ON categories
   FOR EACH ROW
DECLARE
BEGIN
	DELETE FROM st_cat
	WHERE cat_id = :old.cat_id;
END;
/

CREATE OR REPLACE TRIGGER users_delete
BEFORE DELETE
   ON users
   FOR EACH ROW
DECLARE
BEGIN
	DELETE FROM usr_role
	WHERE usr_id = :old.usr_id;

	DELETE FROM favourites
	WHERE usr_id = :old.usr_id;

	DELETE FROM bookmarks
	WHERE usr_id = :old.usr_id;

	DELETE FROM comments
	WHERE usr_id = :old.usr_id;

	DELETE FROM ratings
	WHERE usr_id = :old.usr_id;
END;
/

CREATE OR REPLACE TRIGGER roles_delete
BEFORE DELETE
   ON roles
   FOR EACH ROW
DECLARE
BEGIN
	DELETE FROM usr_role
	WHERE role_id = :old.role_id;
END;
/