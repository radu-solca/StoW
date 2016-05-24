begin
	DBMS_OUTPUT.PUT_LINE(usr_scripts.register('gigelu_spumos5','gigi','brunhilda@gigi.com5','GIGELU' ,'ANONIM AL DOILEA'));
end;
/
begin
	DBMS_OUTPUT.PUT_LINE(usr_scripts.login('gigelu_spumos','gigi_parolatu'));
end;
/
begin
	DBMS_OUTPUT.PUT_LINE(usr_scripts.usr_has_role(1,'admin'));
end;
/
