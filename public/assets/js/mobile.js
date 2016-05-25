window.addEventListener("resize", resize);
var recentData = document.querySelector('.recentData');

// function resize() {
//     recentOutput.textContent = window.innerWidth;
//     if (window.innerWidth < 500) {
//         recentOutput.textContent = 'MOBILE';
//     } else {
//         recentOutput.textContent = 'DESKTOP';
//     }
// }

function resize() {
    if (window.innerWidth < 500) {
        recentData.className = "recentData scrollH";
    } else {
        recentData.className = "flex recentData row centerV spaceBetween";
    }
}
