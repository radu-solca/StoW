
window.addEventListener("resize", whenResize);
var recent = document.querySelector('.recent');
var recentData = document.querySelector('.recentData');


//== BROWSERS THAT DON'T TRIGGER RESIZING
function whenMobileOnly() {
    if(window.innerWidth < 500)
    {
        recentData.className = "recentData scrollH";
        recent.className = "recent fullWidth";
    }
}
whenMobileOnly();


//== LISTEN TO RESIZING
//== ACCIDENTALY WORKS IN BROWSERS WITH NAV BAR
function whenResize() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
        recent.className = "recent fullWidth";
    } else {
        recentData.className = "flex recentData row spaceBetween center1 center2";
        recent.className = "recent fullWidth flex center1 center2";
    }
}