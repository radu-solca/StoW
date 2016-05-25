conn / as sysdba;

grant connect to StoW identified by StoW;

grant all privileges to StoW identified by StoW;

GRANT EXECUTE ON SYS.utl_file TO StoW;

conn StoW/StoW;
