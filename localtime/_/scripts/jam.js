function AjaxFunction() {
  let httpxml;

  // Create XMLHttpRequest Object
  try {
    httpxml = new XMLHttpRequest();
  } catch (e) {
    alert("Your browser does not support AJAX!");
    return false;
  }

  // Utility Function for Escaping Input
  const sanitizeHTML = (str) => {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  };

  // Define the state change handler
  const stateChangeHandler = () => {
    if (httpxml.readyState === 4) {
      if (httpxml.status === 200) {
        // Successfully fetched content
        const msgElement = document.getElementById("msg");
        msgElement.innerHTML = sanitizeHTML(httpxml.responseText); // Sanitize response
        msgElement.style.background = "#f1f1f1";
      } else {
        console.error("Failed to fetch data. Status:", httpxml.status);
      }
    }
  };

  const url = `/localtime/_/jm/jam.php?sid=${Math.random()}`; // Prevent caching
  httpxml.onreadystatechange = stateChangeHandler;
  httpxml.open("GET", url, true);
  httpxml.send();

  // Call timer function for periodic updates
  timerFunction();
}

function timerFunction() {
  const refreshRate = 1000; // Refresh rate in milliseconds
  setTimeout(AjaxFunction, refreshRate);
}


// function AjaxFunction() {
//   var httpxml;

//   try {
//     // Firefox, Opera 8.0+, Safari
//     httpxml = new XMLHttpRequest();
//   } catch (e) {
//     // Internet Explorer
//     try {
//       httpxml = new ActiveXObject("Msxml2.XMLHTTP");
//     } catch (e) {
//       try {
//         httpxml = new ActiveXObject("Microsoft.XMLHTTP");
//       } catch (e) {
//         alert("Your browser does not support AJAX!");
//         return false;
//       }
//     }
//   }

//   function stateck() {
//     if (httpxml.readyState == 4) {
//       document.getElementById("msg").innerHTML = httpxml.responseText;
//       document.getElementById("msg").style.background = "#f1f1f1";
//     }
//   }

//   var url = "/localtime/_/jm/jam.php";
//   url = url + "?sid=" + Math.random();
//   httpxml.onreadystatechange = stateck;
//   httpxml.open("GET", url, true);
//   httpxml.send(null);
//   tt = timer_function();
// }

// function timer_function() {
//   var refresh = 1000; // Refresh rate in milli seconds
//   mytime = setTimeout("AjaxFunction();", refresh);
// }
