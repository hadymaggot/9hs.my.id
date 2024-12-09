(function () {
  // Utility Function for Escaping Input
  function sanitizeHTML(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Fetch Public IP Address
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("connection").innerHTML +=
        "<b>IP Publik Anda</b>&RightArrow;<i>" +
        sanitizeHTML(response.ip) +
        "</i> ";
    }
  };
  xhttp.open("GET", "https://api.ipify.org?format=json", true);
  xhttp.send();

  // Fetch ISP and Location Details
  var xhttp3 = new XMLHttpRequest();
  xhttp3.onreadystatechange = function () {
    if (xhttp3.readyState === 4 && xhttp3.status === 200) {
      var response = JSON.parse(xhttp3.responseText);
      document.getElementById("isp").innerHTML +=
        "<i>" +
        sanitizeHTML(response.isp) +
        "</i> | " +
        sanitizeHTML(response.regionName) +
        ", " +
        sanitizeHTML(response.countryCode);
    }
  };
  xhttp3.open("GET", "http://ip-api.com/json", true);
  xhttp3.send();

  // Display Referrer Information
  if (document.referrer && document.referrer !== "") {
    const safeReferrer = sanitizeHTML(document.referrer);
    document.getElementById("referrer").innerHTML =
      "<strong>Halaman Sebelumnya:</strong> " + safeReferrer;
  }

  // Get Local IP Addresses
  function getIPs(callback) {
    var ip_dups = {};
    var RTCPeerConnection =
      window.RTCPeerConnection ||
      window.mozRTCPeerConnection ||
      window.webkitRTCPeerConnection;

    if (!RTCPeerConnection) return;

    var pc = new RTCPeerConnection({
      iceServers: [{ urls: "stun:stun.services.mozilla.com" }],
    });

    pc.onicecandidate = function (ice) {
      if (ice.candidate) {
        var ip_match = ice.candidate.candidate.match(
          /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
        );
        if (ip_match) {
          var ip = ip_match[1];
          if (!ip_dups[ip]) {
            ip_dups[ip] = true;
            callback(ip);
          }
        }
      }
    };

    pc.createDataChannel("");
    pc.createOffer().then((offer) => pc.setLocalDescription(offer));
  }

  getIPs(function (ip) {
    document.getElementById("connection").innerHTML +=
      "<b>Local IP →</b> " + sanitizeHTML(ip) + "<br>";
  });
})();

// (function () {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function () {
//     if (xhttp.readyState == 4 && xhttp.status == 200) {
//       document.getElementById("connection").innerHTML +=
//         "<b>IP Publik Anda</b>&RightArrow;" +
//         "<i>" +
//         JSON.parse(xhttp.responseText).ip +
//         "</i> ";
//     }
//   };
//   xhttp.open("GET", "https://api.ipify.org?format=json", true);
//   xhttp.send();

//   var xhttp3 = new XMLHttpRequest();
//   xhttp3.onreadystatechange = function () {
//     if (xhttp3.readyState == 4 && xhttp3.status == 200) {
//       document.getElementById("isp").innerHTML +=
//         "<i>" + JSON.parse(xhttp3.responseText).isp + "</i>";
//       document.getElementById("isp").innerHTML +=
//         " | " +
//         JSON.parse(xhttp3.responseText).regionName +
//         ", " +
//         JSON.parse(xhttp3.responseText).countryCode;
//     }
//   };
//   xhttp3.open("GET", "http://ip-api.com/json", true);
//   xhttp3.send();

//   if (document.referrer && document.referrer !== "") {
//     const decodedReferrer = decodeURIComponent(document.referrer);
//     const safeReferrer = decodedReferrer
//         .replace(/&/g, "&amp;")
//         .replace(/</g, "&lt;")
//         .replace(/>/g, "&gt;")
//         .replace(/"/g, "&quot;")
//         .replace(/'/g, "&#039;");

//     document.getElementById("referrer").innerHTML =
//         "<strong>Halaman Sebelumnya:</strong> " + safeReferrer;
//   }

//   //get the IP addresses associated with an account
//   function getIPs(callback) {
//     var ip_dups = {};

//     //compatibility for firefox and chrome
//     var RTCPeerConnection =
//       window.RTCPeerConnection ||
//       window.mozRTCPeerConnection ||
//       window.webkitRTCPeerConnection;
//     var useWebKit = !!window.webkitRTCPeerConnection;

//     //bypass naive webrtc blocking using an iframe
//     if (!RTCPeerConnection) {
//       //NOTE: you need to have an iframe in the page right above the script tag
//       //
//       //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
//       //<script>...getIPs called in here...
//       //
//       var win = iframe.contentWindow;
//       RTCPeerConnection =
//         win.RTCPeerConnection ||
//         win.mozRTCPeerConnection ||
//         win.webkitRTCPeerConnection;
//       useWebKit = !!win.webkitRTCPeerConnection;
//     }

//     //minimal requirements for data connection
//     var mediaConstraints = {
//       optional: [
//         {
//           RtpDataChannels: true,
//         },
//       ],
//     };

//     var servers = {
//       iceServers: [
//         {
//           urls: "stun:stun.services.mozilla.com",
//         },
//       ],
//     };

//     //construct a new RTCPeerConnection
//     var pc = new RTCPeerConnection(servers, mediaConstraints);

//     var sentResult = false;

//     function handleCandidate(candidate) {
//       //match just the IP address
//       var ip_regex =
//         /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/;
//       var ip_addr = ip_regex.exec(candidate)[1];

//       //remove duplicates
//       if (!sentResult && ip_dups[ip_addr] === undefined) {
//         sentResult = true;
//         callback(ip_addr);
//       }

//       ip_dups[ip_addr] = true;
//     }

//     //listen for candidate events
//     pc.onicecandidate = function (ice) {
//       //skip non-candidate events
//       if (ice.candidate) handleCandidate(ice.candidate.candidate);
//     };

//     //create a bogus data channel
//     pc.createDataChannel("");

//     //create an offer sdp
//     pc.createOffer(
//       function (result) {
//         //trigger the stun server request
//         pc.setLocalDescription(
//           result,
//           function () {},
//           function () {}
//         );
//       },
//       function () {}
//     );

//     //wait for a while to let everything done
//     setTimeout(function () {
//       //read candidate info from local description
//       var lines = pc.localDescription.sdp.split("\n");

//       lines.forEach(function (line) {
//         if (line.indexOf("a=candidate:") === 0) handleCandidate(line);
//       });
//     }, 1000);
//   }

//   //Test: Print the IP addresses into the console
//   getIPs(function (ip) {
//     document.getElementById("connection").innerHTML +=
//       "<b>Local IP →</b> " + ip + "<br>";
//     window.ip = ip;
//   });
// })();
