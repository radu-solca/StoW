var categories = [];
var order = {"ordBy":"RATING","ordType":"ASC"};
var searchBarInput = null;

var page = 1;
var rowsPerPage = 12;
var totalPages = 1;

document.getElementById("searchBar").addEventListener("submit", function(event){
	event.preventDefault();
	var value = document.getElementById("searchBarInput").value;
	console.log("submitted "+value);
	searchBarInput = value;
	page = 1;
	updateStories();
});

function updateOrdBy(select){
	order.ordBy = select.value;
	page = 1;
	updateStories();
}

function updateOrdType(select){
	order.ordType = select.value;
	page = 1;
	updateStories();
}

function addCategoryFilter(type, name){
	var filter = {type:type, name:name};
	if(!containsFilter(filter,categories)){
		categories.push(filter);
	}

	page = 1;
	updateStories();
	updateRemoveButtons();
	
}

function removeCategoryFilter(type, name){

	var filter = {type:type, name:name};
	removeFilterFromList(filter,categories);

	page = 1;

	updateStories();
	updateRemoveButtons();
}

function updateRemoveButtons(){
	var buttonsHTML = "";
	for (x = 0; x < categories.length; x++) {
		buttonsHTML += "<li class=\"remove x\" onclick=\"removeCategoryFilter('"+categories[x].type+"', '"+categories[x].name+"')\">"+categories[x].name+"</li>";
    }
    document.getElementById("filterView").innerHTML = buttonsHTML;
}



function containsFilter(obj, list) {
    var x;
    for (x = 0; x < list.length; x++) {
        if (list[x].type === obj.type && list[x].name === obj.name) {
            return true;
        }
    }

    return false;
}

function removeFilterFromList(obj, list) {
    var x;
    for (x = 0; x < list.length; x++) {
        if (list[x].type === obj.type && list[x].name === obj.name) {
            list.splice(x,1);
        }
    }
}

function updatePaginationControl(){
	var paginationControlHtml = "";

	if(page <= 1){
		paginationControlHtml += "<span>&laquo; first</span> <span>&lsaquo; prev</span>  ";
	}
	else{
		paginationControlHtml += "<span class=\"clickable\" onclick=\"gotoFirst()\">&laquo; first</span> <span class=\"clickable\" onclick=\"gotoPrev()\">&lsaquo; prev</span>  ";
	}

	//paginationControlHtml += "<input style=\"width:20px\" type=\"number\" min=\"1\" max=\"totalPages\" value=\""+page+"\""
	//							+"onkeydown=\"if (event.keyCode == 13) {gotoPage(this.value);}\">"
	paginationControlHtml += page;
	paginationControlHtml += "/"+totalPages;

	if(page >= totalPages){
		paginationControlHtml += "  <span>next &rsaquo;</span> <span>last &raquo;</span>";
	}
	else{
		paginationControlHtml += "  <span class=\"clickable\" onclick=\"gotoNext()\">next &rsaquo;</span> <span class=\"clickable\" onclick=\"gotoLast()\">last &raquo;</span>";
	}

	 document.getElementById("pageControlTop").innerHTML = paginationControlHtml;
	 document.getElementById("pageControlBottom").innerHTML = paginationControlHtml;
}

function gotoFirst(){
	page = 1;
	updateStories();
	updatePaginationControl();
}

function gotoPrev(){
	page = page - 1;
	updateStories();
	updatePaginationControl();
}

function gotoNext(){
	page = page + 1;
	updateStories();
	updatePaginationControl();
}

function gotoLast(){
	page = totalPages;
	updateStories();
	updatePaginationControl();
}

function gotoPage(pageNo){
	page = parseInt(pageNo);
	console.log(page);
	updateStories();
	updatePaginationControl();
}

function updateStories(){
	var parameters = "categories="+JSON.stringify(categories)
					+"&order="+JSON.stringify(order)
					+"&searchBarInput="+JSON.stringify(searchBarInput)
					+"&page="+JSON.stringify(page)
					+"&rowsPerPage="+JSON.stringify(rowsPerPage);

	ajaxPost("browse/getFilteredStories", 
		parameters, 
		function(responseText){
			var responseJSON = JSON.parse(responseText);

			totalPages = responseJSON.totalPages;

			updatePaginationControl();

			document.getElementById("storyView").innerHTML = "";

			responseJSON.page.forEach(function(entry){
				var storyHTML = getStoryThumbnail(entry);
				document.getElementById("storyView").innerHTML += storyHTML;
			});
			

			/*FILL REMAINING SPACE*/
			document.getElementById("storyView").innerHTML += "<div class=\"storyThumbnail\" style=\"opacity: 0;\"><div class=\"container\" style=\"height: 0;\"></div></div>";
			document.getElementById("storyView").innerHTML += "<div class=\"storyThumbnail\" style=\"opacity: 0;\"><div class=\"container\" style=\"height: 0;\"></div></div>";

			assignColors();
			trailingText(".storyThumbnail .title",32);
			trailingText(".storyThumbnail .authors",18);
		}
	);
}

//updateStories();

//MOBILE VER.

window.addEventListener("resize", resizeBrowseContent);

var browseContent = document.querySelector('.browseContent');

/*========================================================*/
function resizeBrowseContent() {
    if (window.innerWidth < 500) {

        browseContent.classList.remove("row");
        browseContent.classList.add("column");

    } else {

    	browseContent.classList.remove("column");
        browseContent.classList.add("row");
    }
}

resizeBrowseContent();