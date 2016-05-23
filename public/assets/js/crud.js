function deleteStoryEntry(rowID) {
	
    var x = new XMLHttpRequest();
    var params="ST_ID="+rowID;
    x.open("POST", "deleteStory.php", false);

	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.setRequestHeader("Content-length", params.length);
	x.setRequestHeader("Connection", "close");

    x.send(params);

    location.reload();
    return false;
}

function deleteCategoryEntry(rowID, rowCatType, rowCatName) {
    
    var x = new XMLHttpRequest();
    var params="ST_ID="+rowID+"&CAT_TYPE="+rowCatType+"&CAT_NAME="+rowCatName;
    x.open("POST", "../deleteCategory.php", false);

    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.setRequestHeader("Content-length", params.length);
    x.setRequestHeader("Connection", "close");

    x.send(params);

    location.reload();
    return false;
}

function deleteCharacterEntry(rowID, rowChrName) {
    var x = new XMLHttpRequest();

    var params="ST_ID="+rowID+"&CHR_NAME="+rowChrName;

    x.open("POST", "../deleteCharacter.php", false);

    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.setRequestHeader("Content-length", params.length);
    x.setRequestHeader("Connection", "close");

    x.send(params);

    location.reload();
    return false;
}

function editEntry(rowID){

    var params="ST_ID="+rowID;

    window.location.href = 'admin_story_view.php/?'+params;
    return false;
}


// function insertCharacter(rowID, rowChrName, rowChrDesc) {
    
//     var x = new XMLHttpRequest();
//     var params="ST_ID="+rowID+"&CHR_NAME="+rowChrName+"&CHR_DESC="+rowChrDesc;
//     x.open("POST", "../insertCharacter.php", false);

//     alert(params);

//     x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     x.setRequestHeader("Content-length", params.length);
//     x.setRequestHeader("Connection", "close");

//     x.send(params);

//     alert(x.responseText);
//     location.reload();
//     return false;
// }

// function insertCategory(rowID, rowCatType, rowCatName) {
    
//     var x = new XMLHttpRequest();
//     var params="ST_ID="+rowID+"&CAT_TYPE="+rowCatType+"&CAT_NAME="+rowCatName;
//     x.open("POST", "../insertCategory.php", false);

//     x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     x.setRequestHeader("Content-length", params.length);
//     x.setRequestHeader("Connection", "close");

//     x.send(params);

//     location.reload();
//     return false;
// }


// function editEntry(rowID, rowContent, rowCover) {
    
//     var x = new XMLHttpRequest();
//     var params="ST_ID="+rowID+"&ST_CONTENT="+rowContent+"&ST_COVER="+rowCover;
//     x.open("POST", "edit.php", false);

//     x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     x.setRequestHeader("Content-length", params.length);
//     x.setRequestHeader("Connection", "close");

//     x.send(params);

//     location.reload();
//     return false;
// }

