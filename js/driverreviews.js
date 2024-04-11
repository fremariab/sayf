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

  function createStars(rating) {
    var starsHtml = "";
    for (var i = 1; i <= 5; i++) {
      if (i <= rating) {
        starsHtml += '<i class="fa-solid fa-star" style="color:ff9c1a"></i>';
      } else {
        starsHtml += '<i class="fa-regular fa-star"></i>';
      }
    }
    return starsHtml;
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

        response.data.forEach((element) => {
          result += "<div class='card card1'>";
          result += "<div>";
          result += "<ul>";
          result += createStars(element.rating);
          result += "</ul>";
          result += "</div>";
          result += "<p class='close'></p>";
          result += "<p class='desc' id='desc'>" + element.review_text + "</p>";
          result += "</div>";
        });

        document.getElementById("reviews").innerHTML += result;
      }
    },
    error: (error) => {
      //   console.log("error");
      //   var responseData = JSON.parse(error.responseText);
      //   document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
