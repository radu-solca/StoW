conn / as sysdba;

grant connect to stow identified by stow;

grant all privileges to stow identified by stow;

GRANT EXECUTE ON SYS.utl_file TO stow;

conn stow/stow;
