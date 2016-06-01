var categories = [];
var order = {"ordBy":"RATING","ordType":"ASC"};

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
		buttonsHTML += "<a class=\"remove\" href=\"#\" style=\"color:black\" onclick=\"removeCategoryFilter('"+categories[x].type+"', '"+categories[x].name+"')\">"+categories[x].name+"</a></br>";
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
					+"&order="+JSON.stringify(order);

	ajaxPost("browse", 
		parameters, 
		function(responseText){
			var responseJSON = JSON.parse(responseText);

			var storyHTML = "";
			for (var i = 0; i < responseJSON.length; i++) {
			    var story = responseJSON[i];
			    storyHTML += "<div class=\"title\">"+story.TITLE+"</div>"
			}

			document.getElementById("storyView").innerHTML = storyHTML;
		}
	);
}

updateStories();