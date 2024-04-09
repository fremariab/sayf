/**search.js */
$("#submit").click(function (event) {
  event.preventDefault();
  var keyword = $("#input_search").val();
  if (keyword == null || keyword == "") {
    window.location.href = "../view/userdash.php";
  }

  $.ajax({
    url: "../actions/searchdriver_action.php",
    method: "post",
    data: JSON.stringify({
      keyword: keyword,
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;

        let result = "";

        response.data.forEach((element) => {
          result += '<div class="searchresult">';
          result += '<div class="rating">';
          result += '<div class="heading"><p>RATING</p></div>';
          result +=
            '<div class="ratingbox"><p>' +
            element.average_rating +
            "</p></div>";
          result +=
            '<div class="text"><p>' +
            element.rating_count +
            " ratings</p></div>";
          result += "</div>";
          result += '<div class="details">';
          result +=
            '<div class="dname"><p>' +
            element.driver_fname +
            " " +
            element.driver_lname +
            "</p></div>";
          result +=
            '<div class="dcplate"><p>' + element.plate_number + "</p></div>";
          result +=
            '<div class="dcomps"><p>' + element.company_name + "</p></div>";
          result += "</div>";
          result += "</div>";
        });
        window.location.href =
          "../view/searchresults.php?data=" + encodeURIComponent(result);
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
