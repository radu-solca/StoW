var json;
var pages;
var numberOfPages;
var storyPath;
var leftPage = 0;
var storyId;
var bookmarkPageId;
var isAddedToFavourite;
var isBookmarked;

var charactersLeft;

function loadPage(pageNumber){
	var html = "";

	if (pages[pageNumber]) {

		if(leftPage == bookmarkPageId){
			if(leftPage!=0 && bookmarkPageId!=0){
				isBookmarked = true;
			}
			updateBookmark();
		} else{
			isBookmarked = false;
			updateBookmark();

		}


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

function init(jsonEncoded,path,Id,bookmarkId,isFavourite){
	json = JSON.parse(jsonEncoded);
	numberOfPages = json['story']['content']['pages'].length-1;
	pages = json['story']['content']['pages'];
	storyPath = path;
	storyId = Id;
	bookmarkPageId = bookmarkId;
	isAddedToFavourite = isFavourite == 1 ? true:false;
	isBookmarked = bookmarkId == 0 ? false:true;
	leftPage = bookmarkId - bookmarkId % 2;


	gotoPage(bookmarkId);

	updateFavorite();
	updateBookmark();
	
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

	//fixuit bug-ul la numarul paginilor cu 3/4 si next te mai ducea o data....fixuit cat sa stam in viata...
	if(numberOfPages % 2 != 0){
		paginationControlHtml += "/"+((numberOfPages + numberOfPages%2)/2) + "</span>";
	} else{
		paginationControlHtml += "/"+((numberOfPages + numberOfPages%2 + 2)/2) + "</span>";

	}

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
				var responseJSON = JSON.parse(responseText);

				if(responseJSON.hasOwnProperty('notLoggedIn')){
					//console.log(responseText);
					redirect("notLoggedIn");
				}
				else{
							isBookmarked = true;
							bookmarkPageId = leftPage;
							updateBookmark();
				}			
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
						html += "<li class=\"flex column\">"
									+"<div class=\"flex row center1\">"
										+"<span class=\"username\">"+comment.USERNAME+"</span>"
										+"<span class=\"date\">"+comment.TIMESTAMP+"</span>"
									+"</div>"
									+"<span class=\"content\">"+comment.CONTENT+"</span><hr>"
								+"</li>";
					});
					document.getElementById("commentSection").innerHTML = html;
				});

}


function submitComment(){

	if(charactersLeft>=0){

		var content = document.getElementById("comment").value;

		document.getElementById("comment").value = "";

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
							document.querySelector("#commentContainer .error").innerHTML = "";
						}
					});
	}
}

function validateComment(textArea){
	var MAX_CHARS = 256;

	charactersLeft = MAX_CHARS - textArea.value.length;

	var msg = "You have "+charactersLeft+"characters left.";
	document.querySelector("#commentContainer .error").innerHTML = msg;
}

/********FAVOURITES*******/

function addToFavourites(){
	var params = "storyId=" + storyId;
	//console.log(storyId);

	ajaxPost("addFavourite", 
			params, 
			function(responseText){
				var responseJSON = JSON.parse(responseText);

				if(responseJSON.hasOwnProperty('notLoggedIn')){
					//console.log(responseText);
					redirect("notLoggedIn");
				}
				else{
						if(responseJSON.hasOwnProperty('inserted')){
							isAddedToFavourite = true;
							updateFavorite();
						} else{
							if(responseJSON.hasOwnProperty('removed')){
								isAddedToFavourite = false;
								updateFavorite();
							}
						}
				}

			});
}


function updateFavorite(){

	var theHeart = document.querySelector('#storyDetails #rightSide .heart_stroke');
	var tooltip = document.querySelector('#storyDetails #rightSide .heart_stroke .tooltip');

	if(isAddedToFavourite){
		theHeart.style.boxShadow = "0 0 0 2px rgba(255,255,255,0.3)";
		tooltip.innerHTML ="un-favorite";
	}
	else
	{
		theHeart.style.boxShadow = 'none'; 
		tooltip.innerHTML ="favorite";
	}
}

/********BOOKMARKS*******/

function updateBookmark(){

	var theBookmark = document.querySelector('#storyDetails #rightSide .book_alt2');
	var tooltip = document.querySelector('#storyDetails #rightSide .book_alt2 .tooltip');

	if(isBookmarked){
		theBookmark.style.boxShadow = "0 0 0 2px rgba(255,255,255,0.3)";
		tooltip.innerHTML ="bookmarked";
	}
	else
	{
		theBookmark.style.boxShadow = 'none'; 
		tooltip.innerHTML ="bookmark";
	}
}



/********RATINGS*******/

function updateRating(value){
	var params = "ratingValue=" + value
				+"&storyId=" + storyId;

	ajaxPost("updateRating", 
			params, 
			function(responseText){
				var responseJSON = JSON.parse(responseText);
					if(responseJSON.hasOwnProperty('notLoggedIn')){
						redirect("notLoggedIn");
					}
					else{
						document.getElementById('rating').innerHTML = getRatingStars(value, true);
					}
			});
}


/********HOTKEYS*******/

window.addEventListener('keypress',check);

function check(e) {
    var code = e.which;

    if(code == 44){ // comma
		if(leftPage > 0)
			gotoPrev();
    }
    else{
    	if(code == 46){ // full stop
    		if(leftPage < (numberOfPages - numberOfPages % 2-1))
				gotoNext();
    	}
    }
}