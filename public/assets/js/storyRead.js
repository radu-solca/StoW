var json;
var pages;
var numberOfPages;
var storyPath;

function loadPage(pageNumber){

}

function init(jsonEncoded,path){
	json = JSON.parse(jsonEncoded);
	numberOfPages = json['story']['content']['pages'].length;
	pages = json['story']['content']['pages'];
	storyPath = "/Stow" + path;
	storyPath = storyPath.replace(/'\.'/g, "")

	if(pages[0]['img']){
		var img = makeAbsolute(storyPath + '/' +  pages[0]['img']);
		var html = "<img src=" + img + ">";

		document.getElementById("leftPage").innerHTML = html;
		
	} else{
		document.getElementById("leftPage").innerHTML = pages[0]['text'];
	}

	if(pages[1]['img']){
		var img = makeAbsolute(storyPath + '/' +  pages[1]['img']);
		var html = "<img src=" + img + ">";

		document.getElementById("rightPage").innerHTML = html;
		
	} else{
		document.getElementById("rightPage").innerHTML = pages[0]['text'];
	}


}

document.getElementById("next").addEventListener("click",funtion(){

	
});

