var categories = [];
var order = {"ordBy":"RATING","ordType":"ASC"};
var searchBarInput = null;
var page = 1;
var rowsPerPage = 10;

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
		buttonsHTML += "<li class=\"remove x\" style=\"color:black\" onclick=\"removeCategoryFilter('"+categories[x].type+"', '"+categories[x].name+"')\">"+categories[x].name+"</li>";
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

function updateStories(){
	var parameters = "categories="+JSON.stringify(categories)
					+"&order="+JSON.stringify(order)
					+"&searchBarInput="+JSON.stringify(searchBarInput)
					+"&page="+JSON.stringify(page)
					+"&rowsPerPage="+JSON.stringify(rowsPerPage);

	ajaxPost("browse/getFilteredStories", 
		parameters, 
		function(responseText){
			//console.log(responseText);
			// var responseJSON = JSON.parse(responseText);

			var storyHTML = responseText;
			// for (var i = 0; i < responseJSON.length; i++) {
			//     var story = responseJSON[i];
			//     storyHTML += "<div class=\"title\">"+story.TITLE+"</div>"
			// }

			document.getElementById("storyView").innerHTML = storyHTML;

			assignColors();
			trailingText(".storyThumbnail .title",32);
			trailingText(".storyThumbnail .authors",18);
		}
	);
}

//updateStories();