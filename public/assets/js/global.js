
function redirect(path){
	window.location = "/StoW/"+path;
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

// document.onreadystatechange = function() { 
//     if (document.readyState == "interactive") { 
//         alert("results"); 
//     }
// }


function assignColors(){

	// var storyThumbnails = document.querySelector(".storyThumbnail");

	// for (var i in storyThumbnails) {
	// 	alert(i);
 //    	var className = getColor();

 //    	storyThumbnails[i].classList.add(className);
	// }

	var storyThumbnails = document.getElementsByClassName('storyThumbnail');

	for(var i=0; i< storyThumbnails.length; i++){

		// alert(i);
    	var className = getColor();		
	    storyThumbnails[i].classList.add(className);
	}
}