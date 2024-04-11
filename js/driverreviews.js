/**drivereviews.js */
document.addEventListener("DOMContentLoaded", function () {
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  var driverId = getUrlParameter("did");

  $.ajax({
    url: "../actions/driverreviews_action.php",
    method: "post",
    data: JSON.stringify({ driverId: driverId }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;

        let result = "";

        // response.data.forEach((element) => {
        //   result += "<tr>";
        //   result += "<td class='rhcname'>" + element.company_name + "</td>";
        //   result +=
        //     "<td class='contactnum'>" + element.contact_number + "</td>";
        //   result += "<td class='email'>" + element.email + "</td>";
        //   result += "<td class='location'>" + element.location + "</td>";
        //   result += "</tr>";
        // });

        document.getElementById("reviews").innerHTML += result;
      }
    },
    error: (error) => {
      console.log("error");
      //   var responseData = JSON.parse(error.responseText);
      //   document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
