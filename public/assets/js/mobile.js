
window.addEventListener("resize", whenResize);
var recentData = document.querySelector('.recentData');


//== BROWSERS THAT DON'T TRIGGER RESIZING
function whenMobileOnly() {
    if(window.innerWidth < 500)
    {
        recentData.className = "recentData scrollH";
    }
}
whenMobileOnly();


//== LISTEN TO RESIZING
//== ACCIDENTALY WORKS IN BROWSERS WITH NAV BAR
function whenResize() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
    } else {
        recentData.className = "flex recentData row centerV flexStart";
    }
}
