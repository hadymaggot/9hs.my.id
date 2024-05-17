function AjaxFunction() {
  var httpxml;

  try {
    // Firefox, Opera 8.0+, Safari
    httpxml = new XMLHttpRequest();
  } catch (e) {
    // Internet Explorer
    try {
      httpxml = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        httpxml = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        alert("Your browser does not support AJAX!");
        return false;
      }
    }
  }

  function stateck() {
    if (httpxml.readyState == 4) {
      document.getElementById("msg").innerHTML = httpxml.responseText;
      document.getElementById("msg").style.background = "#f1f1f1";
    }
  }

  var url = "/localtime/_/jm/jam.php";
  url = url + "?sid=" + Math.random();
  httpxml.onreadystatechange = stateck;
  httpxml.open("GET", url, true);
  httpxml.send(null);
  tt = timer_function();
}

function timer_function() {
  var refresh = 1000; // Refresh rate in milli seconds
  mytime = setTimeout("AjaxFunction();", refresh);
}
