/**getposts.js */
document.addEventListener("DOMContentLoaded", function () {
  $.ajax({
    url: "../actions/getposts_action.php",
    method: "get",
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;

        let result = "";

        result += "<div class='card card2'>";
        result += "<p class='close'></p>";
        result += "<p class='desc' id='desc'>" + element.review_text + "</p>";
        if (element.uid == response.user_id) {
          result +=
            "<div ><i id='deleteAction' onclick='confirmDelete(" +
            element.revid +
            "," +
            element.did +
            ") ; return false;' class='fa-solid fa-trash'></i></div>";
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
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
