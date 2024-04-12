// /**drivereviews.js */

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
        starsHtml += '<i class="fa-solid fa-star" style="color:#ff9c1a"></i>';
      } else {
        starsHtml += '<i class="fa-regular fa-star" style="color:#ff9c1a"></i>';
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
        var reviewContainer = $("#reviews");
        reviewContainer.empty();
        let buttonres = "";

        buttonres +=
          "<a style='display:flex;justify-content:center;' href='../view/pagereviewdriver.php?did=" +
          driverId +
          "'>";
        buttonres +=
          "<button style='justify-content:center;text-align:center;color:#54177c;background-color:white;margin-top:30px;'>Review Driver</button>";
        buttonres += "</a>";

        if (response.data.length === 0) {
          reviewContainer.html("<p>No results found</p>");
          //   result = "<div class='card card1'>No reviews found</div>";
        } else {
          var resultsPerRow = 2;

          for (var index = 0; index < response.data.length; index++) {
            if (index % resultsPerRow === 0) {
              reviewContainer.append('<div class="row">');
            }

            var element = response.data[index];

            result += "<div class='card card1'>";
            result += "<div class='stars'>";
            result += "<ul>";
            result += createStars(element.rating);
            result += "</ul>";
            result += "</div>";
            result += "<p class='close'></p>";
            result +=
              "<p class='desc' id='desc'>" + element.review_text + "</p>";
            if (element.uid == response.user_id) {
              result +=
                "<div ><a href='../view/editreview.php?revid=" +
                element.revid +
                "&did=" +
                element.did +
                "'><i id='actions'class='fas fa-edit'></i></a><i id='actions' class='fa-solid fa-trash' onclick='confirmDelete(" +
                element.revid +
                "," +
                element.did +
                "); return false;'></i></div>";
            }
            result += "</div>";

            if (
              (index + 1) % resultsPerRow === 0 ||
              index === response.data.length - 1
            ) {
              reviewContainer.append(result);
              reviewContainer.append("</div>");
              result = "";
            }
          }
          //
        }

        // document.getElementById("reviews").innerHTML += result;
        document.getElementById("reviewbutton").innerHTML += buttonres;
      }
    },
    error: (error) => {
      // Handle error if needed
    },
  });
});
