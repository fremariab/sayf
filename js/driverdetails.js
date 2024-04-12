/**driverdetails.js */
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
    url: "../actions/driverdetail_action.php",
    method: "post",
    data: JSON.stringify({ driverId: driverId }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;

        document.getElementById("drivername").innerHTML =
          response.data.driver_fname + " " + response.data.driver_lname;
        document.getElementById("carplate").innerHTML =
          response.data.plate_number;
        document.getElementById("contact").innerHTML = response.data.driver_tel;
        document.getElementById("numreviews").innerHTML =
          response.data.review_count;
        document.getElementById("rhcomp").innerHTML =
          response.data.company_name;
        if (!response.data.average_rating) {
          response.data.average_rating = 0;
        }
        document.getElementById("avgrating").innerHTML =
          response.data.average_rating;
        document.getElementById("cardetails").innerHTML =
          response.data.car_color +
          " " +
          response.data.car_make +
          " " +
          response.data.car_model;
        if (response.data.gender == 1) {
          document.getElementById("gender").innerHTML = "Male";
        } else {
          document.getElementById("gender").innerHTML = "Female";
        }
      }
    },
    error: (error) => {
      //   var responseData = JSON.parse(error.responseText);
      //   document.getElementById("error").innerHTML = responseData.message;
      console.log(error);
    },
  });
});
