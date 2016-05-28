window.addEventListener("resize", resizeHome);

var recent = document.querySelector('.recent');
var recentData = document.querySelector('.recentData');

/*========================================================*/
function resizeHome() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
        recent.className = "recent fullWidth";


    } else {
        recentData.className = "flex recentData row spaceBetween center1 center2";
        recent.className = "recent fullWidth flex center1 center2";

    }
}

resizeHome();