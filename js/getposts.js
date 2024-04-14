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
            "<span data-posid='" +
            element.posid +
            "'><i class='fa-solid fa-heart' style='font-size: 20px;color:white;margin-right:20px;'></i></span>";
          result +=
            "<span><p style='font-size: 20px;color:white;margin-right:20px;'>" +
            1 +
            "</p></span>";
          if (element.creator == response.user_id) {
            result +=
              "<span><i id='deleteAction' onclick='confirmDelete(" +
              element.posid +
              "); return false;' class='fa-solid fa-trash' style='color:white;font-size: 20px;'></i></span>";
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
      }
    },

    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
