window.addEventListener("resize", resizeNav);

var navContent = document.querySelector('#navContent');
var navContentMobile = document.querySelector('#navContentMobile');

/*========================================================*/
function resizeNav() {
    if (window.innerWidth < 500) {

        navContent.classList.add("hidden");
        navContentMobile.classList.remove("hidden");

    } else {

        navContent.classList.remove("hidden");
        navContentMobile.classList.add("hidden");
    }
}

resizeNav();