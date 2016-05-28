
window.addEventListener("resize", whenResize);

var navContent = document.querySelector('#navContent');

var recent = document.querySelector('.recent');
var recentData = document.querySelector('.recentData');

/*========================================================*/
function whenResize() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
        recent.className = "recent fullWidth";

        navContent.innerHTML = "";

        var menuItem = []; 

        for (var i = 0; i < 5; i++) {
            menuItem[i] = document.createElement("a");
        } 

        menuItem[0].setAttribute("href","#");
        menuItem[0].setAttribute("class","iconic home");

        menuItem[1].setAttribute("href","#");
        menuItem[1].setAttribute("class","iconic book");

        menuItem[2].setAttribute("href","#");
        menuItem[2].setAttribute("class","iconic upload");

        menuItem[3].setAttribute("href","#");
        menuItem[3].setAttribute("class","iconic magnifying_glass");

        
        menuItem[4].setAttribute("href","#");
        menuItem[4].setAttribute("class","iconic user");

        for (i = 0; i < 5; i++) {
            navContent.appendChild(menuItem[i]);
        } 

    } else {
        recentData.className = "flex recentData row spaceBetween center1 center2";
        recent.className = "recent fullWidth flex center1 center2";

        navContent.innerHTML = "";

        var left = document.createElement("div");
        left.setAttribute("id","left");

        var right = document.createElement("div");
        right.setAttribute("id","right");

        left.setAttribute("class","flex centerV flexStart");
        right.setAttribute("class","flex centerV flexEnd");

        var menuItem = []; 

        for (var i = 0; i < 5; i++) {
            menuItem[i] = document.createElement("a");
        } 

        menuItem[0].setAttribute("href","#");
        menuItem[0].setAttribute("class","iconic home");

        menuItem[1].setAttribute("href","#");
        menuItem[1].setAttribute("class","iconic book");

        menuItem[2].setAttribute("href","#");
        menuItem[2].setAttribute("class","iconic upload");

        for (i = 0; i < 3; i++) {
            left.appendChild(menuItem[i]);
        }

        menuItem[3].setAttribute("href","#");
        menuItem[3].setAttribute("class","iconic magnifying_glass");

        
        menuItem[4].setAttribute("href","#");
        menuItem[4].setAttribute("class","iconic user");

        for (i = 3; i < 5; i++) {
            right.appendChild(menuItem[i]);
        }

        navContent.appendChild(left);
        navContent.appendChild(right);

    }
}

whenResize();