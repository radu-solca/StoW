var json;
var pages;
var numberOfPages;
var storyPath;
var leftPage = 0;
var storyId;

function loadPage(pageNumber){
	var html = "";

	if (pages[pageNumber]) {

		if(pages[pageNumber]['img']){
		var img = makeAbsolute(storyPath + '/' +  pages[pageNumber]['img']);
		html += "<img src=" + img + ">";

		// document.getElementById("leftPage").innerHTML = html;
			
		} else{
			// document.getElementById("leftPage").innerHTML = pages[pageNumber]['text'];
			html += pages[pageNumber]['text'];
		}

		if(pages[pageNumber].hasOwnProperty("nextList")){
			html += createInteractiveButtons(pageNumber);
		}
	}
	return html;

}

function init(jsonEncoded,path,Id){
	json = JSON.parse(jsonEncoded);
	numberOfPages = json['story']['content']['pages'].length;
	pages = json['story']['content']['pages'];
	storyPath = path;
	storyId = Id;
	//storyPath = storyPath.replace(/\./g,'');

	gotoPage(0);


}

function gotoPage(pageNo){
	if (pageNo % 2 != 0) {
		pageNo -= 1;
	}

	document.getElementById("leftPage").innerHTML = loadPage(pageNo);
 	document.getElementById("rightPage").innerHTML = loadPage(pageNo+1);
}

 document.getElementById("next").addEventListener("click",function(){
 	leftPage += 2;

 	gotoPage(leftPage);
 });

 document.getElementById("prev").addEventListener("click",function(){
 	leftPage -= 2;

 	gotoPage(leftPage);
 });

 function createInteractiveButtons(pageNumber){
 	var html = "";

 	pages[pageNumber].nextList.forEach(function(nextItem){
 		html += "<span class=\"clickable\" onclick=\"gotoPage(" + nextItem.index + ")\">" + nextItem.msg + "</span>";
 		leftPage = nextItem.index;
 	}); 

 	return html;
 }

 document.getElementById("bookmark").addEventListener("click",function(){

 	var params = "storyId=" + storyId
 				+"&pageId=" + leftPage;

 	ajaxPost("addBookmark", 
			params, 
			function(responseText){
				alert(responseText);
			});

 });


