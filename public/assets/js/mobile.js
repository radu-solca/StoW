window.addEventListener("resize", resize);

  var recentOutput = document.querySelector('.recentContent');

  function resize() { 
    recentOutput.textContent = window.innerWidth;

    if(window.innerWidth < 500)
    {
    	recentOutput.textContent = 'MOBILE';
    } else {
    	recentOutput.textContent = 'DESKTOP';
    }
   
  }
