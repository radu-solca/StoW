var filters = [];


function addFilter(type, name){
	//alert(type+" "+name);

	var filter = {type:type, name:name};
	if(!containsFilter(filter,filters)){
		filters.push(filter);
	}

	updateStories();
	updateRemoveButtons();
	
}

function removeFilter(type, name){

	var filter = {type:type, name:name};
	removeFilterFromList(filter,filters);

	updateStories();
	updateRemoveButtons();
}

function updateRemoveButtons(){
	var buttonsHTML = "";
	for (x = 0; x < filters.length; x++) {
		buttonsHTML += "<a class=\"remove\" href=\"#\" style=\"color:black\" onclick=\"removeFilter('"+filters[x].type+"', '"+filters[x].name+"')\">"+filters[x].name+"</a></br>";
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
	var parameters = "filters="+JSON.stringify(filters);

	ajaxPost("browse", 
		parameters, 
		function(responseText){
			alert(responseText);
			var responseJSON = JSON.parse(responseText);

			var storyHTML = "";
			for (var i = 0; i < responseJSON.length; i++) {
			    var story = responseJSON[i];
			    storyHTML += "<div class=\"title\">"+story.TITLE+"</div>"
				storyHTML += "<div class=\"authors\">"+story.AUTHORS+"</div>"

			}

			document.getElementById("storyView").innerHTML = storyHTML;
		}
	);
}