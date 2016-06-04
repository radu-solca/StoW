
window.redirect = function redirect(path){
	window.location = "/StoW/"+path;
}

window.makeAbsolute = function makeAbsolute(path){
	var absPath = window.location.protocol + "//" + window.location.host;
	absPath += "/"+path;
	return absPath;
}

window.fileExists = function fileExists(url){

    var http = new XMLHttpRequest();

    http.open('HEAD', url, false);
    http.send();

    return http.status != 404;

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

function assignColors(){

	var storyThumbnails = document.getElementsByClassName('storyThumbnail');

	for(var i=0; i< storyThumbnails.length; i++){

		// alert(i);
    	var className = getColor();		
	    storyThumbnails[i].classList.add(className);
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

