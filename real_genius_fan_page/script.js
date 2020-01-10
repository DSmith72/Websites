/* 
   Real Genius Fan Page
   Filename: script.js

   Author:  David Smith 
   Date:    December 1, 2017 
   HTML5 and CSS3 Web project
 */
 
 
 /* create variables */
 
      window.onload = function() {
      let start = Date.now();

      let timer = setInterval(function() {
        let timePassed = Date.now() - start;

        title.style.left = timePassed / 4.2 + 'px';

        if (timePassed > 2000) clearInterval(timer);

      }, 20);
    }
	
