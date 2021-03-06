
window.redirect = function redirect(path){
	window.location = "/StoW/"+path;
}

window.makeAbsolute = function makeAbsolute(path){
	var absPath = window.location.protocol + "//" + window.location.host;
	absPath += "/Stow/public/"+path;
	return absPath;
}

var colorList = [
"presetColorRed",
"presetColorOrange",
"presetColorYellow",
"presetColorGreen",
"presetColorBlue"
]; 

function getColor(){
	var random = Math.round(Math.random() * (colorList.length-1));
	
	return colorList[random];
}

function assignColors(target){

	var targets = document.getElementsByClassName(target);

	for(var i=0; i< targets.length; i++){

		// alert(i);
    	var className = getColor();		
	    targets[i].classList.add(className);
	}
}

function add3Dots(string, limit)
{
  var dots = "...";
  if(string.length > limit)
  {
    string = string.substring(0,limit) + dots;
  }

    return string;
}

function trailingText(selectorPath, limit){

	var vector = document.querySelectorAll(selectorPath);

		for(var i=0; i< vector.length; i++){

			var text = vector[i].innerHTML;		
		    vector[i].innerHTML=add3Dots(text,limit);
		}
}

