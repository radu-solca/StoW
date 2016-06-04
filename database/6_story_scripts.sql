CREATE OR REPLACE PACKAGE st_scripts IS

    FUNCTION insert_story(
        p_usr_id    IN users.usr_id%type,

        p_title     IN stories.st_title%type,
        p_authors   IN stories.st_authors%type,
        p_content   IN stories.st_content%type,
        p_cover     IN stories.st_cover%type
    )
    RETURN stories.st_id%type;

    FUNCTION add_cat_to_st(
        p_st_id     IN stories.st_id%type,

        p_cat_type  IN categories.cat_type%type,
        p_cat_name  IN categories.cat_name%type
    )
    RETURN categories.cat_id%type;

    -- FUNCTION add_chr_to_st(
    --     p_st_id     IN stories.st_id%type,

    --     p_chr_name  IN characters.chr_name%type,
    --     p_chr_desc  IN characters.chr_desc%type
    -- )
    -- RETURN characters.chr_id%type;

    FUNCTION st_in_category(
        p_st_id     IN stories.st_id%type,

        p_cat_type  IN categories.cat_type%type,
        p_cat_name  IN categories.cat_name%type
    )
    RETURN INTEGER;

    PROCEDURE bookmark(
        p_st_id     IN stories.st_id%type,

        p_usr_id  IN users.usr_id%type,
        p_page_id IN INTEGER
    );

END st_scripts;
/

CREATE OR REPLACE PACKAGE BODY st_scripts IS

    FUNCTION insert_story(
        p_usr_id    IN users.usr_id%type,

        p_title     IN stories.st_title%type,
        p_authors   IN stories.st_authors%type,
        p_content   IN stories.st_content%type,
        p_cover     IN stories.st_cover%type
    ) 
    RETURN stories.st_id%type
    IS
        v_new_st_id NUMBER(5);
        v_approval_id NUMBER(5);
    BEGIN

        --INSERT STORY AND GET ITS GENERATED ID--
        INSERT INTO stories (st_title, st_authors, st_content, st_cover)
                    VALUES  (p_title, p_authors, p_content, p_cover);

        SELECT st_id 
        INTO v_new_st_id
        FROM stories
        WHERE st_title = p_title;

        --CHECK WHO UPLOADED IT AND SET IT'S APPROVAL VALUE CORRESPONDINGLY--
        IF usr_utils.usr_has_role(p_usr_id, 'admin') = 1
        THEN
            SELECT cat_id 
            INTO v_approval_id
            FROM categories
            WHERE cat_type = 'approval' 
            AND cat_name = 'approved';
        ELSE
            SELECT cat_id 
            INTO v_approval_id
            FROM categories
            WHERE cat_type = 'approval' 
            AND cat_name = 'pending';
        END IF;
        
        INSERT INTO st_cat (st_id, cat_id) 
                    VALUES (v_new_st_id, v_approval_id);

        RETURN v_new_st_id;
    EXCEPTION
        WHEN OTHERS THEN
            CASE
                WHEN sqlerrm LIKE '%(STOW.STORIES_UNQ_ST_TITLE)%'
                THEN RAISE_APPLICATION_ERROR(-20001,'There is already a story with this title');

                WHEN sqlerrm LIKE '%(STOW.STORIES_UNQ_ST_CONTENT)%'
                THEN RAISE_APPLICATION_ERROR(-20002,'There is already a story with this content');

                ELSE RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
            END CASE;
    END;



    FUNCTION add_cat_to_st(
        p_st_id    IN stories.st_id%type,

        p_cat_type     IN categories.cat_type%type,
        p_cat_name     IN categories.cat_name%type
    )
    RETURN categories.cat_id%type
    IS
        v_cat_id categories.cat_id%type;
    BEGIN
        SELECT cat_id
        INTO v_cat_id
        FROM categories
        WHERE cat_type = p_cat_type 
        AND cat_name = p_cat_name;

        INSERT INTO st_cat VALUES (p_st_id, v_cat_id);

        RETURN v_cat_id;

    EXCEPTION
        WHEN OTHERS 
        THEN RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
    END;



    -- FUNCTION add_chr_to_st(
    --     p_st_id    IN stories.st_id%type,

    --     p_chr_name     IN characters.chr_name%type,
    --     p_chr_desc     IN characters.chr_desc%type
    -- )
    -- RETURN characters.chr_id%type
    -- IS
    --     v_chr_id characters.chr_id%type;
    -- BEGIN
    --     INSERT INTO characters (st_id, chr_name, chr_desc) 
    --     VALUES (p_st_id, p_chr_name, p_chr_desc);

    --     SELECT chr_id
    --     INTO v_chr_id
    --     FROM characters
    --     WHERE st_id = p_st_id
    --     AND chr_name = p_chr_name;

    -- EXCEPTION
    --     WHEN OTHERS 
    --     THEN RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
    -- END;



    FUNCTION st_in_category(
        p_st_id     IN stories.st_id%type,

        p_cat_type  IN categories.cat_type%type,
        p_cat_name  IN categories.cat_name%type
    )
    RETURN INTEGER
    IS
        v_check INTEGER;
    BEGIN
        SELECT COUNT(*)
        INTO v_check
        FROM categories_view
        WHERE st_id = p_st_id
        AND cat_type = p_cat_type
        AND cat_name = p_cat_name;

        IF v_check = 0
        THEN
            RETURN 0;
        ELSE
            RETURN 1;
        END IF;

    EXCEPTION
        WHEN OTHERS 
        THEN RAISE_APPLICATION_ERROR(-20099,'An error occured: '||sqlerrm);
    END;

    PROCEDURE bookmark(
        p_st_id     IN stories.st_id%type,

        p_usr_id  IN users.usr_id%type,
        p_page_id IN INTEGER
    )
    IS
        v_exists INTEGER;
    BEGIN
        SELECT COUNT(*)
        INTO v_exists
        FROM bookmarks b
        WHERE usr_id = p_usr_id
        AND st_id = p_st_id;

        IF v_exists >=1
        THEN
            UPDATE bookmarks
            SET page_id = p_page_id
            WHERE usr_id = p_usr_id
            AND st_id = p_st_id;
        ELSE
            INSERT INTO bookmarks VALUES (p_usr_id,p_st_id,p_page_id);
        END IF;
    END;


END st_scripts;
/