(function () {
  var bagiDonx = new XMLHttpRequest();

  bagiDonx.open(
    "GET",
    "https://api.ipdata.co/?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f"
  );

  bagiDonx.setRequestHeader("Accept", "application/json");

  bagiDonx.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      try {
        var response = JSON.parse(bagiDonx.responseText);

        document.getElementById("koneksi").innerHTML +=
          "<strong>IP Publik Anda </strong>&RightArrow; " +
          sanitizeHTML(response.ip);

        document.getElementById("bendera").innerHTML +=
          "&nbsp; <img src='" +
          sanitizeHTML(response.flag) +
          "' width='20px' height='13px'>";

        document.getElementById("isp").innerHTML +=
          sanitizeHTML(response.asn.name) +
          " | " +
          sanitizeHTML(response.city);

        document.getElementById("kodeNegara").innerHTML +=
          " " + sanitizeHTML(response.country_code);
      } catch (error) {
        console.error("Error parsing API response:", error);
      }
    }
  };

  bagiDonx.send();

  function sanitizeHTML(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }
})();


// (function () {
//   var bagiDonx = new XMLHttpRequest();

//   bagiDonx.open(
//     "GET",
//     "https://api.ipdata.co/?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f"
//   );

//   bagiDonx.setRequestHeader("Accept", "application/json");

//   bagiDonx.onreadystatechange = function () {
//     if (this.readyState === 4) {
//       document.getElementById("koneksi").innerHTML +=
//         "<strong>IP Publik Anda </strong>&RightArrow;" +
//         JSON.parse(bagiDonx.responseText).ip;

//       document.getElementById("bendera").innerHTML +=
//         "&nbsp; <img src='" +
//         JSON.parse(bagiDonx.responseText).flag +
//         "' width='20px' height='13px'>";

//       document.getElementById("isp").innerHTML +=
//         JSON.parse(bagiDonx.responseText).asn.name +
//         " | " +
//         JSON.parse(bagiDonx.responseText).city;

//       document.getElementById("kodeNegara").innerHTML +=
//         " " + JSON.parse(bagiDonx.responseText).country_code;
//     }
//   };

//   bagiDonx.send();
// })();
