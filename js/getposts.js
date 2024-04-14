/**getposts.js */
document.addEventListener("DOMContentLoaded", function () {
  $.ajax({
    url: "../actions/getposts_action.php",
    method: "get",
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 201) {
        response = data;
        let result = "";
        var reviewContainer = $("#reviews");
        reviewContainer.empty();

        var resultsPerRow = 2;

        for (var index = 0; index < response.data.length; index++) {
          var element = response.data[index];

          result += "<div class='card card2'>";
          result += "<p class='close'></p>";
          result += "<p class='desc' id='desc'>" + element.post_text + "</p>";
          result +=
            "<div style='display: flex; justify-content: space-between; align-items: center;'>"; // Flex container
          result += "<span data-posid='" + element.posid + "'>";
          result +=
            "<i class='fa-solid fa-heart' id='like-button' data-posid='" +
            element.posid +
            "'style='font-size: 20px;color:white;margin-right:20px;'></i>";
          result +=
            "<p style='font-size: 20px;color:white;margin-right:20px;display: inline-block;' id='engagement_count'></p>";
          result += "</span>";
          if (element.creator == response.user_id) {
            result += "<span>";
            result +=
              "<i id='deleteAction' onclick='confirmDelete(" +
              element.posid +
              "); return false;' class='fa-solid fa-trash' style='color:white;font-size: 20px;'></i>";
            result += "</span>";
          }
          result += "</div>";
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
      }
    },

    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
