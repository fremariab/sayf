// /**search.js */
// $("#submit").click(function (event) {
//   event.preventDefault();
//   var keyword = $("#input_search").val();
//   if (keyword == null || keyword == "") {
//     window.location.href = "../view/finddriver.php";
//   }

//   $.ajax({
//     url: "../actions/searchdriver_action.php",
//     method: "post",
//     data: JSON.stringify({
//       keyword: keyword,
//     }),
//     dataType: "json",
//     success: (data, status) => {
//       console.log(data, status);
//       if (data.status == 200) {
//         response = data;
//         var resultContainer = $("#results");
//         resultContainer.empty();

//         let result = "";

//         var resultsCount = searchResults.length;
//         var resultsPerRow = 2;

//         if (index % resultsPerRow === 0) {
//           resultContainer.append('<div class="row">');
//         }
//         response.data.forEach((element) => {
//           result += '<div class="searchresult">';
//           result += '<div class="rating">';
//           result += '<div class="heading"><p>RATING</p></div>';
//           result +=
//             '<div class="ratingbox"><p>' +
//             element.average_rating +
//             "</p></div>";
//           result +=
//             '<div class="text"><p>' +
//             element.rating_count +
//             " ratings</p></div>";
//           result += "</div>";
//           result += '<div class="details">';
//           result +=
//             '<div class="dname"><p>' +
//             element.driver_fname +
//             " " +
//             element.driver_lname +
//             "</p></div>";
//           result +=
//             '<div class="dcplate"><p>' + element.plate_number + "</p></div>";
//           result +=
//             '<div class="dcomps"><p>' + element.company_name + "</p></div>";
//           result += "</div>";
//           result += "</div>";
//           resultContainer.append(result);
//           if ((index + 1) % resultsPerRow === 0 || index === resultsCount - 1) {
//             resultContainer.append("</div>");
//           }
//         });
//       }
//     },
//     error: (error) => {
//       var responseData = JSON.parse(error.responseText);
//       document.getElementById("error").innerHTML = responseData.message;
//     },
//   });
// });
$("#submit").click(function (event) {
  event.preventDefault();
  var keyword = $("#input_search").val();
  if (keyword == null || keyword == "") {
    window.location.href = "../view/finddriver.php";
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
        var response = data;
        var resultContainer = $("#results");
        resultContainer.empty();

        var results = response.data;
        if (results.length === 0) {
          resultContainer.html("<p>No results found</p>");
        } else {
          var resultsPerRow = 2;
          var result = "";

          for (var index = 0; index < results.length; index++) {
            if (index % resultsPerRow === 0) {
              resultContainer.append('<div class="row">');
            }

            var element = results[index];
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

            if (
              (index + 1) % resultsPerRow === 0 ||
              index === results.length - 1
            ) {
              resultContainer.append(result);
              resultContainer.append("</div>");
              result = "";
            }
          }
        }
      }
    },
    error: (error) => {
      // var responseData = JSON.parse(error.responseText);
      // document.getElementById("error").innerHTML = responseData.message;
      console.log(error);
    },
  });
});
