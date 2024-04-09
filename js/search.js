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

        searchResults.forEach(function (result) {
          result += '<div class="searchresult">';
          result += '<div class="rating">';
          result += '<div class="heading"><p>RATING</p></div>';
          result += '<div class="ratingbox"><p>' + result.rating + "</p></div>";
          result +=
            '<div class="text"><p>' +
            result.ratingsCount +
            " ratings</p></div>";
          result += "</div>";
          result += '<div class="details">';
          result += '<div class="dname"><p>' + result.name + "</p></div>";
          result += '<div class="dcplate"><p>' + result.plate + "</p></div>";
          result += '<div class="dcomps"><p>' + result.companies + "</p></div>";
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
