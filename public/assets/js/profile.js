window.addEventListener("resize", resizeProfileTiles);


var profileTiles1 = document.querySelector('.formContent #firstHalf');
var profileTiles2 = document.querySelector('.formContent #secondHalf');

/*========================================================*/
function resizeProfileTiles() {
    if (window.innerWidth < 700) {

        profileTiles1.classList.remove("row");
        profileTiles1.classList.add("column");

        profileTiles2.classList.remove("row");
        profileTiles2.classList.add("column");

    } else {

    	profileTiles1.classList.remove("column");
        profileTiles1.classList.add("row");

        profileTiles2.classList.remove("column");
        profileTiles2.classList.add("row");
    }
}

resizeProfileTiles();

function setRatingStars(ratingValue,storyId){
    document.getElementById(storyId).innerHTML = getRatingStars(ratingValue);
}