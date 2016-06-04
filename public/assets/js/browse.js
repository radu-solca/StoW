var categories = [];
var order = {"ordBy":"RATING","ordType":"ASC"};
var searchBarInput = null;

var page = 1;
var rowsPerPage = 10;
var totalPages = null;

document.getElementById("searchBar").addEventListener("submit", function(event){
	event.preventDefault();
	var value = document.getElementById("searchBarInput").value;
	console.log("submitted "+value);
	searchBarInput = value;
	updateStories();
});

function updateOrdBy(select){
	order.ordBy = select.value;
	updateStories();
}

function updateOrdType(select){
	order.ordType = select.value;
	updateStories();
}

function addCategoryFilter(type, name){
	var filter = {type:type, name:name};
	if(!containsFilter(filter,categories)){
		categories.push(filter);
	}

	updateStories();
	updateRemoveButtons();
	
}

function removeCategoryFilter(type, name){

	var filter = {type:type, name:name};
	removeFilterFromList(filter,categories);

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
	// # first page

	var paginationControlHtml = "";
	// if($currentPageNumber <= 1)
	// 	echo "<span>&laquo; first</span> <span>&lsaquo; prev</span> | <span class=\"clickable\" onclick=\"gotoNext()\">next &rsaquo;</span> <span class=\"clickable\" onclick=\"gotoLast()\">last &raquo;</span>";

	// // # last page
	// elseif($currentPageNumber >= $pages)
	// 	echo "<span class=\"clickable\" onclick=\"gotoFirst()\">&laquo; first</span> <span class=\"clickable\" onclick=\"gotoPrev()\">&lsaquo; prev</span> | <span>next &rsaquo;</span> <span>last &raquo;</span>";

	// // # in lastRowNumberInPage
	paginationControlHtml += "<span class=\"clickable\" onclick=\"gotoFirst()\">&laquo; first</span> <span class=\"clickable\" onclick=\"gotoPrev()\">&lsaquo; prev</span> |  "+page+"/"+totalPages+"  | <span class=\"clickable\" onclick=\"gotoNext()\">next &rsaquo;</span> <span class=\"clickable\" onclick=\"gotoLast()\">last &raquo;</span>";
	 document.getElementById("pageControl").innerHTML = paginationControlHtml;
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
	page = 1;
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
			var storyHTML = responseText;

			document.getElementById("storyView").innerHTML = storyHTML;
			

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