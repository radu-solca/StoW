CREATE OR REPLACE DIRECTORY CSV
AS 'C:\xampp\htdocs\StoW\DB_Output';

CREATE OR REPLACE PACKAGE csv_scripts AS

      FUNCTION load_table_from_csv(
            p_tname              IN VARCHAR2,
            p_dir                IN VARCHAR2,
            P_FILENAME           IN VARCHAR2,
            p_ignore_headerlines IN INTEGER DEFAULT 1,
            p_delimiter          IN VARCHAR2 DEFAULT ',',
            p_optional_enclosed  IN VARCHAR2 DEFAULT '"' )
      RETURN NUMBER;

      PROCEDURE dump_table_to_csv(
            p_tname    IN VARCHAR2,
            p_dir      IN VARCHAR2,
            p_filename IN VARCHAR2 );

END csv_scripts;
/

CREATE OR REPLACE PACKAGE BODY csv_scripts AS
    FUNCTION load_table_from_csv(
      p_tname              IN VARCHAR2,
      p_dir                IN VARCHAR2,
      P_FILENAME           IN VARCHAR2,
      p_ignore_headerlines IN INTEGER DEFAULT 1,
      p_delimiter          IN VARCHAR2 DEFAULT ',',
      p_optional_enclosed  IN VARCHAR2 DEFAULT '"' )
    RETURN NUMBER
    IS
      l_input utl_file.file_type;
      l_theCursor INTEGER DEFAULT dbms_sql.open_cursor;
      l_lastLine  VARCHAR2(4000);
      l_cnames    VARCHAR2(4000);
      l_bindvars  VARCHAR2(4000);
      l_status    INTEGER;
      l_cnt       NUMBER DEFAULT 0;
      l_rowCount  NUMBER DEFAULT 0;
      l_sep       CHAR(1) DEFAULT NULL;
      L_ERRMSG    VARCHAR2(4000);
      V_EOF       BOOLEAN := false;
    BEGIN
        l_cnt := 1;
        --LOOP THROUGH ALL COLUMNS IN TABLE--
        FOR TAB_COLUMNS IN 
            (
                SELECT column_name,data_type FROM user_tab_columns
                WHERE table_name=p_tname ORDER BY column_id
            )
        LOOP
            --PREPARE COLUMN NAMES--
            l_cnames   := l_cnames || tab_columns.column_name || ',';

            --PREPARE VALUES--
            l_bindvars := l_bindvars || CASE
                                        WHEN tab_columns.data_type IN ('DATE', 'TIMESTAMP(6)') 
                                        THEN
                                        'to_date(:b' || l_cnt || ',''DD-MON-YYYY HH24:MI:SS''),'
                                        ELSE
                                        ':b'|| l_cnt || ','
                                        END;
            l_cnt := l_cnt + 1;

        END LOOP;

        --REMOVE EXTRA COMMAS--
        l_cnames               := rtrim(l_cnames,',');
        L_BINDVARS             := RTRIM(L_BINDVARS,',');

        L_INPUT                := UTL_FILE.FOPEN( P_DIR, P_FILENAME, 'r' );
        IF p_ignore_headerlines > 0 THEN
            BEGIN
                --IGNORE FIRST <p_ignore_headerlines> LINES--
                FOR i IN 1 .. p_ignore_headerlines
                LOOP
                    UTL_FILE.get_line(l_input, l_lastLine);
                END LOOP;

                EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                    v_eof := TRUE;
            END;
        END IF;

        IF NOT v_eof THEN
            --PREPARE THE INSERT STATEMENT--
            -- DBMS_OUTPUT.PUT_LINE(l_cnames || ' ' || l_bindvars);
            dbms_sql.parse( l_theCursor, 'insert into ' || p_tname || '(' || l_cnames || ') values (' || l_bindvars || ')', dbms_sql.native );
            --LOOP THROUGH CSV LINES--
            LOOP
                BEGIN
                    utl_file.get_line( l_input, l_lastLine );
                    EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                    RETURN L_ROWCOUNT;
                END;
                IF LENGTH(l_lastLine) > 0 THEN
                    FOR i IN 1 .. l_cnt-1
                    LOOP
                        --BIND VARIABLES IN PREPARED STATEMENT--
                        dbms_sql.bind_variable( l_theCursor, ':b'||i, rtrim(rtrim(ltrim(ltrim( REGEXP_SUBSTR(l_lastline,'(^|,)("[^"]*"|[^",]*)',1,i),p_delimiter),p_optional_enclosed),p_delimiter),p_optional_enclosed));
                    END LOOP;
                    BEGIN
                        --EXECURE PREPARED STATEMENT--
                        l_status := dbms_sql.execute(l_theCursor);
                        l_rowCount := l_rowCount + 1;

                        EXCEPTION
                            WHEN OTHERS THEN
                            L_ERRMSG := SQLERRM;
                            RAISE_APPLICATION_ERROR(-20001,'ERROR: '||SQLERRM||' ON ROW '||(l_rowCount+1));
                            ROLLBACK;
                            RETURN -1;
                    END;
                END IF;
          END LOOP;
          dbms_sql.close_cursor(l_theCursor);
          utl_file.fclose( l_input );
          COMMIT;
      END IF;
      COMMIT;
      RETURN L_ROWCOUNT;
    END load_table_from_csv;


    PROCEDURE dump_table_to_csv(
        p_tname    IN VARCHAR2,
        p_dir      IN VARCHAR2,
        p_filename IN VARCHAR2 )
    IS
      l_output utl_file.file_type;
      l_theCursor   INTEGER DEFAULT dbms_sql.open_cursor;
      l_columnValue VARCHAR2(4000);
      l_status      INTEGER;
      l_query       VARCHAR2(1000) DEFAULT 'select * from ' || p_tname;
      l_colCnt      NUMBER := 0;
      l_separator   VARCHAR2(1);
      l_descTbl dbms_sql.desc_tab;
    BEGIN
      l_output := utl_file.fopen( p_dir, p_filename, 'w' );
      EXECUTE immediate 'alter session set nls_date_format=''dd-mon-yyyy hh24:mi:ss''';
      dbms_sql.parse( l_theCursor, l_query, dbms_sql.native );
      dbms_sql.describe_columns( l_theCursor, l_colCnt, l_descTbl );
      FOR i IN 1 .. l_colCnt
      LOOP
        utl_file.put( l_output, l_separator || '"' || l_descTbl(i).col_name || '"' );
        dbms_sql.define_column( l_theCursor, i, l_columnValue, 4000 );
        l_separator := ',';
      END LOOP;
      utl_file.new_line( l_output );
      l_status                                := dbms_sql.execute(l_theCursor);
      WHILE ( dbms_sql.fetch_rows(l_theCursor) > 0 )
      LOOP
        l_separator := '';
        FOR i IN 1 .. l_colCnt
        LOOP
          dbms_sql.column_value( l_theCursor, i, l_columnValue );
          utl_file.put( l_output, l_separator || l_columnValue );
          l_separator := ',';
        END LOOP;
        utl_file.new_line( l_output );
      END LOOP;
      dbms_sql.close_cursor(l_theCursor);
      utl_file.fclose( l_output );
      EXECUTE immediate 'alter session set nls_date_format=''dd-MON-yy'' ';
    EXCEPTION
      WHEN OTHERS THEN
        EXECUTE immediate 'alter session set nls_date_format=''dd-MON-yy'' ';
    END dump_table_to_csv;

END csv_scripts;
/