
window.addEventListener("resize", whenResize);

var recent = document.querySelector('.recent');
var recentData = document.querySelector('.recentData');

var navContent = document.querySelector('#navContent');
var navContentMobile = document.querySelector('#navContentMobile');

/*========================================================*/
function whenResize() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
        recent.className = "recent fullWidth";

        navContent.classList.add("hidden");
        navContentMobile.classList.remove("hidden");

    } else {
        recentData.className = "flex recentData row spaceBetween center1 center2";
        recent.className = "recent fullWidth flex center1 center2";

        navContent.classList.remove("hidden");
        navContentMobile.classList.add("hidden");
    }
}

whenResize();