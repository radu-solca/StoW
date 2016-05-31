function submitRegister(field, done){

	params = collectRegisterData();

	if(done == true){
		params += "&done=true";
	}
	ajaxPost(	"register", 
				params, 
				function(responseText){
					var responseJSON = JSON.parse(responseText);
					if(responseJSON["success"] == true){
						redirect("");
					}
					else{
						updateErrors(responseJSON, field);
					}
				});
}

function collectRegisterData(){
	var username=encodeURIComponent(document.querySelector("#username input").value),
		password=encodeURIComponent(document.querySelector("#password input").value),
		repeat_password=encodeURIComponent(document.querySelector("#repeat_password input").value),
		email=encodeURIComponent(document.querySelector("#email input").value),
		name=encodeURIComponent(document.querySelector("#name input").value),
		surname=encodeURIComponent(document.querySelector("#surname input").value);

	var params = "username="+username
	+ "&password="+password
	+ "&repeat_password="+repeat_password
	+ "&email="+email
	+ "&name="+name
	+ "&surname="+surname;

	return params;
}

function updateErrors(responseJSON, subject){
	switch(subject){
		case "username":
			updateError(responseJSON, "username");
			break;
		case "password":
			updateError(responseJSON, "password");
			break;
		case "repeat_password":
			updateError(responseJSON, "repeat_password");
			break;
		case "email":
			updateError(responseJSON, "email");
			break;
		case "name":
			updateError(responseJSON, "name");
			break;
		case "surname":
			updateError(responseJSON, "surname");				
			break;
		default:
			updateError(responseJSON, "username");
			updateError(responseJSON, "password");
			updateError(responseJSON, "repeat_password");
			updateError(responseJSON, "email");
			updateError(responseJSON, "name");
			updateError(responseJSON, "surname");		}	
}

function updateError(responseJSON, subject){

	document.querySelector("#"+subject+" .error").innerHTML = responseJSON.hasOwnProperty(subject) ? responseJSON[subject][0] : "";
}