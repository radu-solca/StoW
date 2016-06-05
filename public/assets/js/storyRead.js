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
			html += "<div class=\"flex row choice flexEnd\">";
			html += createInteractiveButtons(pageNumber);
			html += "</div>";
		}
	}
	return html;

}

function init(jsonEncoded,path,Id,bookmarkId){
	json = JSON.parse(jsonEncoded);
	numberOfPages = json['story']['content']['pages'].length;
	pages = json['story']['content']['pages'];
	storyPath = path;
	storyId = Id;
	//storyPath = storyPath.replace(/\./g,'');

	leftPage = bookmarkId - bookmarkId % 2;
	gotoPage(bookmarkId);

	updatePaginationControl()
	updateCommentSection();
}

function updatePaginationControl(){
	var paginationControlHtml = "";

	if(leftPage <= 0){
		paginationControlHtml += "<span>&laquo; first</span> <span>&lsaquo; prev</span>  ";
	}
	else{
		paginationControlHtml += "<span class=\"clickable brownText\" onclick=\"gotoFirst()\">&laquo; first</span> <span class=\"clickable brownText\" onclick=\"gotoPrev()\">&lsaquo; prev</span>  ";
	}

	//paginationControlHtml += "<input style=\"width:20px\" type=\"number\" min=\"1\" max=\"totalPages\" value=\""+page+"\""
	//							+"onkeydown=\"if (event.keyCode == 13) {gotoPage(this.value);}\">"
	paginationControlHtml += "<span>" +(leftPage/2+1);
	paginationControlHtml += "/"+(((numberOfPages - numberOfPages%2)/2)+1) + "</span>";

	if(leftPage >= (numberOfPages - numberOfPages % 2)){
		paginationControlHtml += "  <span>next &rsaquo;</span> <span>last &raquo;</span>";
	}
	else{
		paginationControlHtml += "  <span class=\"clickable brownText\" onclick=\"gotoNext()\">next &rsaquo;</span> <span class=\"clickable brownText\" onclick=\"gotoLast()\">last &raquo;</span>";
	}

	 // document.getElementById("pageControlTop").innerHTML = paginationControlHtml;
	 document.getElementById("pageControlBottom").innerHTML = paginationControlHtml;
}

function gotoFirst(){
	leftPage = 0;
	gotoPage(leftPage);
}

function gotoPrev(){
	leftPage -= 2;
	gotoPage(leftPage);
}

function gotoNext(){
	leftPage += 2;
	gotoPage(leftPage);
}

function gotoLast(){
	leftPage = numberOfPages - numberOfPages%2;
	gotoPage(leftPage);
}

function gotoPage(pageNo){
	if (pageNo % 2 != 0) {
		pageNo -= 1;
	}

	document.getElementById("leftPage").innerHTML = loadPage(pageNo);
 	document.getElementById("rightPage").innerHTML = loadPage(pageNo+1);
 	updatePaginationControl();
}


 function createInteractiveButtons(pageNumber){
 	var html = "";

 	pages[pageNumber].nextList.forEach(function(nextItem){
 		html += "<a class=\"overlay\"><span class=\"clickable\" onclick=\"leftPage = "+(nextItem.index - (nextItem.index % 2))+"; gotoPage(" + nextItem.index + ")\">" + nextItem.msg + "</span></a>";
 		//leftPage = nextItem.index;
 	}); 

 	return html;
 }



 document.getElementById("bookmark").addEventListener("click",function(){

 	var params = "storyId=" + storyId
 				+"&pageId=" + leftPage;

 	ajaxPost("addBookmark", 
			params, 
			function(responseText){
			});

 });



window.addEventListener("resize", resizeStoryPages);
var bothPages = document.querySelector('#bothStoryPages');


function resizeStoryPages() {
    if (window.innerWidth < 500) {

        bothPages.classList.remove("row");
        bothPages.classList.add("column");

    } else {

    	bothPages.classList.remove("column");
        bothPages.classList.add("row");

    }
}

resizeStoryPages();



/********COMMENTS********/

function updateCommentSection(){
	var params = "storyId="+storyId;
	ajaxPost(	"getComments", 
				params, 
				function(responseText){
					var html = "";

					var responseJSON = JSON.parse(responseText);
					responseJSON.forEach(function(comment){
						html += "<li>"
									+"<span class=\"username\">"+comment.USERNAME+"</span>"
									//+"<span class=\"date\">"+comment.DATE_ADDED+"</span>"
									+"</br>"
									+"<span class=\"content\">"+comment.CONTENT+"</span>"
								+"</li>";
					});
					document.getElementById("commentSection").innerHTML = html;
				});

}


function submitComment(){

	var content = document.getElementById("comment").value;

	document.getElementById("comment").value = "";

	console.log(content);

	var params = "storyId="+storyId
				+"&content="+content;

	ajaxPost(	"addComments", 
				params, 
				function(responseText){
					var responseJSON = JSON.parse(responseText);
					if(responseJSON.hasOwnProperty('notLoggedIn')){
						redirect("notLoggedIn");
					}
					else{
						updateCommentSection();
					}
				});
}


