var json;
var pages;
var numberOfPages;

function loadPage(pageNumber){

}

function init(jsonEncoded){
	json = JSON.parse(jsonEncoded);
	numberOfPages = json['story']['content']['pages'].length;
	pages = json['story']['content']['pages'];


	document.getElementById("leftPage").innerHTML = pages[0]['text'];

	if(pages[1]['img']){
		
	}


}

